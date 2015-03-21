#!/bin/sh

#################################################################
# Shell monitoring Custom Deamon  "Starting script"             #
# Most be run using the "." notation. Example:                  #
# '. start_job.sh "git clone"                                   #
#                                                               #
#################################################################

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

declare -i globalIndex
export globalIndex
declare -i firstIndex=0
export firstIndex
export bufferName=""

# =============================================================================
# Script Functions
# =============================================================================

startJob () {
    command=$1

    jobsNames[$globalIndex]=$command
    $command > $name.log 2>&1 &
    jobsPIDs[$globalIndex]=$!
    jobPIDs[$(expr $globalIndex + 1)]="non"
    
    globalIndex=$(expr $globalIndex + 1)
}

initializeGlobalIndex (){
    if [ ! ( $globalIndex -eq $firstIndex ) ]; then
	globalIndex=0
    fi
}

# =============================================================================
# Script Main
# =============================================================================

initializeGlobalIndex
startjob $1

# End of File
