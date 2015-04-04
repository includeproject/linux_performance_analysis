#!/bin/sh

#################################################################
# Shell monitoring Custom Deamon  "Starting script"             #
# Most be run using the "." notation. Example:                  #
# 'start_job.sh "git clone"&                                    #
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


readVariablesFromFile() {
    while [[ -e shell_monitor.lock ]]; do
	sleep 1
    done
    
    lockfile -r 0 start_job.lock
    . variable.file
    rm -f start_job.lock
}

saveVariablesOnFile (){
    declare -i index=0
    buffer=''

    while [[ -e shell_monitor.lock ]]; do
	sleep 1
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

readVariablesFromFile
startjob $1
saveVariablesOnFile

# End of File
