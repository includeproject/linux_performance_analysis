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

export declare -a jobsPIDs
export declare -a jobsNames
export declare -i globalIndex=0
export bufferName=""

# =============================================================================
# Script Functions
# =============================================================================

startJob () {
    command=$1

    jobsNames[$globalIndex]=$command
    $command > $name.log 2>&1 &
    jobsPIDs[$globalIndex]=$!
    jobPIDs[&(expr $globalIndex + 1)]="non"
    
    globalIndex=$(expr $globalIndex + 1)
}


# =============================================================================
# Script Main
# =============================================================================

startjob $1

# End of File
