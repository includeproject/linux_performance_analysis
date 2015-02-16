#!/bin/sh

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`
export directorySource=$directoryRoot"/source"

export gitRepositoryLtp="https://github.com/linux-test-project/ltp.git"
export gitRepositoryLinuxKernel="https://git.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git"
export gitRepositoryFio="git://git.kernel.dk/fio.git"

export packageGit=git

# =============================================================================
# Script Functions
# =============================================================================

gitClone() {
	$packageGit clone $1
}

gitPull() {
	find . -maxdepth 1 -type d \( ! -name . \) -exec bash -c "cd '{}' && git pull" \;
}

# =============================================================================
# Script Main
# =============================================================================

# Source Code Git Repositories #

test -d $directorySource || mkdir $directorySource 
cd $directorySource
gitClone $gitRepositoryLtp
gitClone $gitRepositoryLinuxKernel
gitClone $gitRepositoryFio
gitPull
cd $directoryRoot

# End of File
