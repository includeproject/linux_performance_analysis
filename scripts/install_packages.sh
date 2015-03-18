#!/bin/sh

#set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`
export directoryScripts=$directoryRoot/scripts/
export directorySource=$directoryRoot/source/

export aptGetName=apt-get
export aptGetPackages="autoconf automake bison byacc flex m4 make powertop"

export autoconfName=autoconf
export autoconfVersion="2.61"
export autoconfPackage=$autoconfName"-"$autoconfVersion".tar.bz2"
export autoconfPath="ftp://ftp.gnu.org/gnu/autoconf/"$autoconfName"-"$autoconfVersion".tar.bz2"

export automakeName=automake
export automakeVersion="1.10.2"
export automakePackage=$automakeName"-"$automakeVersion".tar.bz2"
export automakePath="ftp://ftp.gnu.org/gnu/automake/"$automakeName"-"$automakeVersion".tar.bz2"

export bisonName=bison
export bisonVersion="2.4.1"
export bisonPackage=$bisonName"-"$bisonVersion".tar.gz"
export bisonPath="http://ftp.gnu.org/gnu/"$bisonName"/"$bisonPackage

export byaccName=byacc
export byaccPackage="$bisonName.tar.gz"
export byaccPath="ftp://invisible-island.net/"$byaccName"/"$byaccPackage

export flexName=flex
export flexVersion="2.5.39"
export flexPackage=$flexName"-"$flexVersion".tar.bz2"
export flexPath="http://sourceforge.net/projects/"$flexName"/files/"$flexPackage

export m4Name=m4
export m4Version="1.4.7"
export m4Package=$m4Name"-"$m4Version".tar.bz2"
export m4Path="http://ftp.gnu.org/gnu/"$m4Name"/"$m4Package

export makeName=make
export makeVersion="3.81"
export makePackage=$makeName"-"$makeVersion".tar.bz2"
export makePath="http://ftp.gnu.org/gnu/"$makeName"/"$makePackage

export powertopName=powertop
export powertopVersion="2.7"
export powertopPackage=$powertopName"-"$powertopVersion"tar.gz"
export powertopPath="https://01.org/sites/default/files/downloads/"$powertopName"/"$powertopPackage

# =============================================================================
# Script Functions
# =============================================================================

aptGet() {
	sudo $aptGetName update
	sudo $aptGetName install $aptGetPackages
}

yum(){
    sudo yum update
    sudo yum install $1 $aptGetPackages
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
	tarBall $bisonName    $bisonVersion    $bisonPackage    $bisonPath
	tarBall $byaccName    $byaccVersion    $byaccPackage    $byaccPath
	tarBall $flexName     $flexVersion     $flexPackage     $flexPath
	tarBall $m4Name       $m4Version       $m4Package       $m4Path
	tarBall $makeName     $makeVersion     $makePackage     $makePath
	tarBall $powertopName $powertopVersion $powertopPackage $powertopPath
}

# =============================================================================
# Script Main
# =============================================================================

if type apt-get &>/dev/null; then
        aptGet
elif type yum &>/dev/null; then
        yum -y
else
	tarBallAll

fi


# End of File
