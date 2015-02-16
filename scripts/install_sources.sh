#!/bin/sh

set -x

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

compileCommon() {
	directory=$1
	cd $directory
	./configure
	make
	su root -c "echo"
	cd ../
}

compileLtp() {
	directory=$1
	cd $directory
	make autotools
	./configure
	make all
	su root -c "echo"
	cd ../
}

compileKernel() {
	echo "Tbd"
}

# =============================================================================
# Script Main
# =============================================================================

# Source Code Git Repositories Clone & Update #

test -d $directorySource || mkdir $directorySource 

cd $directorySource

gitClone $gitRepositoryLtp
gitClone $gitRepositoryLinuxKernel
gitClone $gitRepositoryFio
gitPull

# Source Code Git Repositories Compilation #

compileCommon "fio"
compileLtp "ltp"

cd $directoryRoot

# End of File
