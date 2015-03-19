#!/bin/sh

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export gitActive=1
export fioActive=1
export powertopActive=1
export activeBuffer=1
export secondsWaiting=15

# =============================================================================
# Script Functions
# =============================================================================



checkOnlineJob (){
    jobPID=$1
    
    if [ (jobs | grep $jobPID" Running") ]; then
	activeBuffer=0
    else
	activeBuffer=1
    fi   
}

checkOnlineAll (){
    checkOnlineJob $gitPID
    gitActive=$activeBuffer
    
    checkOnlineJob $fioPID
    fioActive=$activeBuffer

    checkOnlineJob $powertopPID
    powertopActive=$activeBuffer
}


# =============================================================================
# Script Main
# =============================================================================

while true; do
    checkOnlineAll
    sleep $secondsWaiting
done

# End of File
