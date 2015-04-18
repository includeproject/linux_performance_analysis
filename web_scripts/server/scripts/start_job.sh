#!/bin/sh

#################################################################
# Shell monitoring Custom Deamon  "Starting script"             #
# Most be run using the "." notation. Example:                  #
# '. start_job.sh "powertop"'                                   #
#                                                               #
#################################################################

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

declare -i globalIndex=0
export globalIndex
export arrayLimit="non"

# =============================================================================
# Script Functions
# =============================================================================

#startJob function
#(All Using the globalIndex variable) Saves the commands names on the "jobsNames" variable.
#Moves the arraylimit to the next slot. Executes the commands reirecting the stdout to a file called $name.log.
#Saves the PID on the variable "jobsPIDs". Executes diown on the job's PID.
startJob () {
    command=$1

    jobsNames[$globalIndex]=$command
    jobsNames[$(expr $globalIndex + 1)]=$arrayLimit
    $command > $name.log 2>&1 &
    jobsPIDs[$globalIndex]=$!
    disown ${jobsPIDs[$globalIndex]}
    jobPIDs[$(expr $globalIndex + 1)]=$arrayLimit
    
    globalIndex=$(expr $globalIndex + 1)
}

#readVariablesFromFile function
#Waits for the shell_monitor.lock to be removed. Creates a lock file.
#Reads the "variable.file" Removes the lock file.
readVariablesFromFile() {
    while [[ -e shell_monitor.lock ]]; do
    done
    
    lockfile -r 0 start_job.lock
    . variable.file
    rm -f start_job.lock
}

#saveVariablesOnFile function
# Waits to the shell_monitor lock file to be removed. Creates a lock file.
#Using a "buffer" Variable and a while loop, saves the "jobsNames" and "jobsPIDs" variables as arrays using ->
#-> the following format: "jobsNames=( $name $name $name $name non )" ending each loop on the $arraylimit, ->
#-> Proceds to save it to the "variable.file" file using an echo. Removes the lock file
saveVariablesOnFile (){
    declare -i index=0
    buffer=''

    while [[ -e shell_monitor.lock ]]; do
    done
    
    lockfile -r 0 start_job.lock
    rm -f variable.file
    
    buffer='jobsNames=('
    while [[ ${jobsNames[$index]} != $arrayLimit ]]
    do
	buffer=$buffer' '${jobsNames[$index]}
	index=$(expr $index + 1 )
    done
    buffer=$buffer' non )'
    echo $buffer >> variable.file

    index=0
    buffer='jobsPIDs=('
    while [[ ${jobsPIDs[$index]} != $arrayLimit ]]
    do
	buffer=$buffer' '${jobsPIDs[$index]}
	index=$(expr $index + 1 )
    done
    buffer=$buffer' non )'
    echo $buffer >> variable.file
    
    echo 'globalIndex='$globalIndex >> variable.file
    
    rm -f start_job.lock
}

# =============================================================================
# Script Main
# =============================================================================

#Main
#Reads the variable, starts the jobs and save it's variables to the "variable.file" file.
readVariablesFromFile
startjob $1
saveVariablesOnFile

# End of File
