#!/bin/sh

#set -x

##############################################################################
#           shell_monitor.sh                                                 #
#    Monitors all the process send by the script start_jo.sh                 #
#    In order to start the daemon run this script  before start a job        #
#    Execute the script as follows: ". shell_monitor.sh &""                  #
#                                                                            #
##############################################################################

# =============================================================================
# Scripts Variables
# =============================================================================

declare -a jobsActive
export jobsActive
declare -a jobsNames
export jobsNames
declare -a jobsPIDs
export jobsPIDs

export arrayLimit="non"
export false=1
export true=0
export secondsWaiting=15

# =============================================================================
# Script Functions
# =============================================================================

#checkOnlineJob function
#Checks if the PID is active using the "ps ax" program. If the PID is active, returns 0 else returns 1.
checkOnlineJob (){
    jobPID=$1
    
    if [ ps ax | grep '$jobPID' | grep -v grep ]; then
	return 0
    else
	return 1
    fi   
}

#checkOnlineAll function
#Uses while loop to test all the PIDs using the "checkOnlineJob" function, the value returned by this function ->
#-> is stored on the corresponding slot on the "jobsActive" function.
checkOnlineAll (){
    declare -i index=0

    while [[ ${jobsPIDs[$index]} != $arrayLimit ]] 
    do
	jobsActive[$index]=$(checkOnlineJob ${jobsPIDs[$index]})
	index=$(expr $index + 1 )
    done	
}

#initializeJobsPIDs functions
#Sets on the index "0" the value "arraLimit"
initializeJobsPIDs (){
    if [[ ${jobsPIDs[0]} != $arrayLimit ]]; then
	jobsPIDs[0]=$arrayLimit
    fi
}

#saveJobsStatus function
#Using a while loop, saves the values of the "jobsActive" and "jobsName" vaiables -> 
#-> on the file until the "jobsPIDs" reaches the "arrayLimit" value. 
saveJobsStatus (){
    declare -i index=0
    rm /vagrant/status.log
    while [[ ${jobsPIDs[$index]} != $arrayLimit ]]
    do
	"${jobsName[$index]} ${jobsActive[$index]}" >> /vagrant/status.log
	index=$(expr $index + 1 )
    done
}

#saveVariablesOnFile function
#Does not wait for another lock file to terminate because the function only runs once on the begining of the script.
#Sets a lock file. Saves the "jobsNames" and "jobsPIDs" variables to a file called "variable.file"
#Delates the lock file.
saveVariablesOnFile (){
    lockfile -r 0 shell_monitor.lock
    echo 'jobsNames=()' >> variable.file
    echo 'jobsPIDs=('${jobsPIDs[0]}')' >> variable.file

    rm -f shell_monitor.lock
}

#readVariablesFromFile function
#Waits for the star_job lock file to end. Set a lock file. 
#Reads the file containing the variables. Delates the file lock. 
readVariablesFromFile() { 
    while [[ -e start_job.lock ]]; do
    done
    
    lockfile -r 0 shell_monitor.lock
    . variable.file
    rm -f shell_monitor.lock
}



# =============================================================================
# Script Main
# =============================================================================

#Main
#disown the script so it's terminal session can be closed. Saves the variables already initialized.
#Using a wile loop repets the following; read variables from file, checks the PIDs stored on "jobsPIDs" using "px ax", ->
#-> Save the status of each application to "status.log"
disown $!
initializeJobsPIDs
saveVariablesOnFile

while true; do
    readVariablesFromFile
    checkOnlineAll
    saveJobsStatus
    sleep $secondsWaiting
done

# End of File
