###################################################
# autoconf installation script                    #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variables definitions
AUTOCONF_PATH="ftp://ftp.gnu.org/gnu/autoconf/"
AUTOCONF_VERSION="autoconf-2.61.tar.bz2"
PACKAGE_PATH="$AUTOCONF_PATH$AUTOCONF_VERSION"

#Getting files and uncompressing
wget -O $AUTOCONF_VERSION $PACKAGE_PATH
tar xvjf $AUTOCONF_VERSION
cd autoconf*

#Configure autoconf
./configure
make

#Install the package
sudo make install
