#!/bin/sh

#################################################################
# Shell monitoring Custom Deamon  "Monitoring script"           #
# Most be run using the "." notation. Example:                  #
# ". shell_monitor.sh"                                          #
#                                                               #
#################################################################

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export arrayLimit="non"
export false=1
export true=0
export secondsWaiting=15

# =============================================================================
# Script Functions
# =============================================================================


checkOnlineAll (){
    declare -i index=0

    while[ ${jobsPIDs[$index]} != $arrayLimit ];do
	if [ ! (jobs | grep ${jobPIDs[$index]}" Running") -o (jobs | grep ${jobPIDs[$index]}" Done") ]; then #Checks if the jobs is on the "jobs" list
	    delateDoneJobs $index
	fi
	index=$(expr $index + 1 )
    done	
}

delateDoneJobs() {
    index=$1
    
    while[ ${jobsPIDs[$index]} != $arrayLimit ]; do
	
	jobsPIDs[$index]=${jobsPIDs[$(expr $index + 1)]}
	jobsNames[$index]=${jobsNames[$(expr $index + 1)]}
	
	index=$(expr $index + 1)
    done
}

# =============================================================================
# Script Main
# =============================================================================

while true; do
    checkOnlineAll
    sleep $secondsWaiting
done

# End of File
