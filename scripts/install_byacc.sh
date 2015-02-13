###################################################
# byacc installation script                       #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variables definitions
BYACC_PATH="ftp://invisible-island.net/byacc/"
BYACC_VERSION="byacc.tar.gz"
PACKAGE_PATH="$BYACC_PATH$BYACC_VERSION"

#Getting files and uncompressing
wget -O $BYACC_VERSION $PACKAGE_PATH
tar xvfz $BYACC_VERSION
cd byacc*

#Configure byacc
./configure
make

#Install the package
sudo make  install
