#!/bin/sh

#set -x

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

checkOnlineJob (){
    jobPID=$1
    
    if [ ps ax | grep '$jobPID' | grep -v grep ]; then
	return 0
    else
	return 1
    fi   
}


checkOnlineAll (){
    declare -i index=0

    while [[ ${jobsPIDs[$index]} != $arrayLimit ]] 
    do
	jobsActive[$index]=$(checkOnlineJob ${jobsPIDs[$index]})
	index=$(expr $index + 1 )
    done	
}

initializeJobsPIDs (){
    if [[ ${jobsPIDs[0]} != $arrayLimit ]]; then
	jobsPIDs[0]=$arrayLimit
    fi
}

saveJobsStatus (){
    declare -i index=0
    rm /vagrant/status.log
    while [[ ${jobsPIDs[$index]} != $arrayLimit ]]
    do
	"${jobsName[$index]} ${jobsActive[$index]}" >> /vagrant/status.log
	index=$(expr $index + 1 )
    done
}

saveVariablesOnFile (){
    lockfile -r 0 shell_monitor.lock
    echo 'jobsNames=()' >> variable.file
    echo 'jobsPIDs=('${jobsPIDs[0]}')' >> variable.file

    rm -f shell_monitor.lock
}

readVariablesFromFile() {
    while [[ -e start_job.lock ]]; do
	sleep 1
    done
    
    lockfile -r 0 shell_monitor.lock
    . variable.file
    rm -f shell_monitor.lock
}



# =============================================================================
# Script Main
# =============================================================================

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
