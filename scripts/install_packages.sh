#!/bin/sh

set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`
export directoryScripts=$directoryRoot/scripts/
export directorySource=$directoryRoot/source/

export aptGetName=apt-get
export aptGetPackages="autoconf automake bison byacc flex m4 make"

export autoconfName=autoconf
export autoconfVersion="2.61"
export autoconfPackage=$autoconfName"-"$autoconfVersion".tar.bz2"
export autoconfPath="ftp://ftp.gnu.org/gnu/autoconf/"$autoconfName"-"$autoconfVersion".tar.bz2"

export automakeName=automake
export automakeVersion="1.10.2"
export automakePackage=$automakeName"-"$automakeVersion".tar.bz2"
export automakePath="ftp://ftp.gnu.org/gnu/automake/"$automakeName"-"$automakeVersion".tar.bz2"

# =============================================================================
# Script Functions
# =============================================================================

aptGet() {
	su root -c "$aptGetName update"
	su root -c "$aptGetName install $aptGetPackages"
}

tarBall() {
	name=$1
	version=$2
	package=$3
	path=$4
	wget -P $directorySource $path
	cd $directorySource
	tar xf $package
	cd $name"-"$version
	./configure
	make
	cd $directoryRoot
}

tarBallAll() {
	tarBall $autoconfName $autoconfVersion $autoconfPackage $autoconfPath
	tarBall $automakeName $automakeVersion $automakePackage $automakePath
}

# =============================================================================
# Script Main
# =============================================================================

if apt-get > /dev/null; then
	aptGet
else
	tarBallAll
fi

# End of File
