#!/bin/sh
echo "*****************************************"
echo "** Welcome to the installation of LTP  **"
echo "*****************************************"

LTP_PATH="http://sourceforge.net/projects/ltp/files/latest/download?source=typ_redirect"
LTP_VERSION="ltp-full-20150119.tar.bz2"
DEPENDENCIES='make bison byacc flex automake autoconf m4'

#Dependencies
make_install(){
MAKE_VERSION=make-3.81.tar.bz2
wget -O "http://ftp.gnu.org/gnu/make/$MAKE_VERSION"
tar xvjf $MAKE_VERSION
cd make*
./configure
make
sudo make install
}

bison_install(){
BISON_VERSION=bison-2.4.1.tar.gz
wget -O "http://ftp.gnu.org/gnu/bison/$BISON_VERSION"
tar xvfz $BISON_VERSION
cd bison*
./configure
make
sudo make install
}

byacc_installation(){
BYACC_VERSION="byacc.tar.gz"
wget -O "ftp://invisible-island.net/byacc/$BYACC_VERSION"
tar xvfz $BYACC_VERSION
cd byacc*
./configure
make
sudo make install
}

flex_installation(){
FLEX_VERSION="flex-2.5.39.tar.bz2"
wget -O "http://sourceforge.net/projects/flex/files/$FLEX_VERSION"
tar xvjf $FLEX_VERSION
cd flex*
./configure
make
sudo make install
}

automake_installation(){
AUTOMAKE_VERSION="automake-1.10.2.tar.bz2"
wget -O "ftp://ftp.gnu.org/gnu/automake/$AUTOMAKE_VERSION"
tar xvjf $AUTOMAKE_VERSION
cd automake*
./configure
make
sudo make  install
}

autoconf_install(){
AUTOCONF_VERSION="autoconf-2.61.tar.bz2"
wget -O "ftp://ftp.gnu.org/gnu/autoconf/$AUTOCONF_VERSION"
tar xvjf $AUTOCONF_VERSION
cd autoconf*
./configure
make
sudo make install
}

m4_install(){
M4_VERSION="m4-1.4.7.tar.bz2"
wget -O "http://ftp.gnu.org/gnu/m4/$M4_VERSION"
tar xvjf $M4_VERSION
cd m4*
./configure
make
sudo make install
}

tarball_installation () {
    if [ ! sudo hash $1 2>/dev/null ] ; then
	if [ ! $1_install ]; then
	    echo *****Installation of $1 failed. Quitting...
	    exit 1
	fi
    fi
}

# Find the package manager
if [ which apt-get 2>/dev/null]; then
    sudo apt-get install $DEPENDENCIES
elif [ which yum 2>/dev/null]; then
    sudo yum install $DEPENDENCIES
elif [ which portage  2>/dev/null]; then
    sudo portage install $DEPENDENCIES
elif [ which pacman 2>/dev/null]; then
    sudo pacman install $DEPENDENCIES
elif [which zypper 2>/dev/null]; then
   sudo zypper install $DEPENDENCIES
else
   echo "The tarballs will be installed" >&2
tarball_installation make
tarball_installation bison
tarball_installation byacc
tarball_installation flex
tarball_installation automake
tarball_installation autoconf
tarball_installation m4
   exit 1
fi

ltp_install(){
sudo wget wget -O $LTP_PATH$LTP_VERSION
sudo tar xvjf $LTP_VERSION
cd ltp*
make autotools
./configure
if [ ! $? ] ; then
    exit 1
fi
sudo make all
sudo make SKIP_IDCHECK=1 install
echo "The installation has been succesfull, try \"runalltest\" script which is located in /opt/ltp directory. Have fun!!!"
}

ltp_install