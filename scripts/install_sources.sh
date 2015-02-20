#!/bin/sh

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`
export directorySource=$directoryRoot"/sources"

export gitRepositoryLtp="https://github.com/linux-test-project/ltp.git"
export gitRepositoryLinuxKernel="https://git.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git"
export gitRepositoryFio="git://git.kernel.dk/fio.git"
export gitRepositoryFioVisualizer="https://github.com/01org/fiovisualizer.git"

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
	make distclean
	./configure
	make
	#su root -c "make install"
	cd ../
}

compileLtp() {
	directory=$1
	cd $directory
	make distclean
	make autotools
	./configure
	make all
	#su root -c "make install"
	cd ../
}

compileLinuxKernel() {
	directory=$1
	cd $directory
	make oldconfig
	make -j3
	#su root -c "make modules_install"
	#su root -c "make install"
	cd ../
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
#compileLtp "ltp"
compileLinuxKernel "linux"

cd $directoryRoot

# End of File
