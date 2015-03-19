#!/bin/sh

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export bufferPID="0000"
export gitPID="0000"
export fioPID="0000"
export powertopPID="0000"

# =============================================================================
# Script Functions
# =============================================================================

startJob () {
    command=$1
    name=$2
    
    $command&
    bufferPID=$!

    if [ $name == "git" ]; then
	gitPID=$bufferPID
    fi
    if [ $name == "fio" ];then
	fioPID=$bufferPID
    fi
    if [ $name == "powertop" ];then
	powertopPID=$bufferPID
    fi
}
# =============================================================================
# Script Main
# =============================================================================

startjob $1 $2

# End of File
