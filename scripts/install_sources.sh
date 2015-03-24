#!/bin/sh

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`
export directorySource=$directoryRoot"/sources"

export gitRepositoryLtp="https://github.com/linux-test-project/ltp.git"
export gitRepositoryLinuxKernel="https://git.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git"
export gitRepositoryFio="git://git.kernel.dk/fio.git"
export gitRepositoryFioVisualizer="https://github.com/01org/fiovisualizer.git"

export gitLocalLtp="ltp"
export gitLocalLinuxKernel="linux"
export gitLocalFio="fio"
export gitLocalFioVisualizer="fiovisualizer"

export packageGit=git

# =============================================================================
# Script Functions
# =============================================================================

checkLocal() {
	repolocal=$1
	test -d $repolocal
}

gitClone() {
	repolocal=$1
	reporemote=$2
	checkLocal $repolocal
	isLocal=$?
	if [ $isLocal = "1" ]
	then
		$packageGit clone $reporemote
	fi
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
	sudo make install
	cd ../
}

compileLtp() {
	directory=$1
	cd $directory
	make distclean
	make autotools
	./configure
	make all
	sudo make install
	cd ../
}

compileLinuxKernel() {
	directory=$1
	cd $directory
	git checkout -b v3.19 v3.19
	yes "" | make oldconfig
	sudo make prepare
	make -j3
	sudo make modules_install
	sudo make headers_install
	sudo make install
	cd ../
}

# =============================================================================
# Script Main
# =============================================================================

# Source Code Git Repositories Clone & Update #

test -d $directorySource || mkdir $directorySource 

cd $directorySource

gitClone $gitLocalLtp 		$gitRepositoryLtp
gitClone $gitLocalLinuxKernel	$gitRepositoryLinuxKernel
gitClone $gitLocalFio		$gitRepositoryFio
gitClone $gitLocalFioVisualizer	$gitRepositoryFioVisualizer

gitPull

# Source Code Git Repositories Compilation #
compileLtp $gitLocalLtp
compileLinuxKernel $gitLocalLinuxKernel
compileCommon $gitLocalFio

cd $directoryRoot

# End of File
