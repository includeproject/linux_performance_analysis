#!/bin/sh

set -x

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
    
    if [ (jobs | grep $jobPID" Running") ]; then
	return 0
    else
	return 1
    fi   
}

checkOnlineAll (){
    declare -i index=0

    while[ ${jobsPIDs[$index]} != $arrayLimit ];do
	jobsActive=${checkOnlineJob ${jobsPIDs[$index]}}
	index=$(expr $index + 1 )
    done	
}

initializeJobsPIDs (){
    if [ ${jobsPIDs[0]} != $arrayLimit ]; then
	jobsPIDs[0]=$arrayLimit
    fi
}

saveJobsStatus (){
    declare -i index=0
    "" > /vagrant/status.log
    while[ ${jobsPIDs[$index]} != $arrayLimit ];do
	"${jobsName[$index]} ${jobsActive[$index]}" >> /vagrant/status.log
	index=$(expr $index + 1 )
    done
}

# =============================================================================
# Script Main
# =============================================================================

initializeJobsPIDs

while true; do
    checkOnlineAll
    saveJobsStatus
    sleep $secondsWaiting
done

# End of File
