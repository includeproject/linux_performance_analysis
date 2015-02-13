###################################################
# m4 installation script                          #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variable definitions
M4_PATH="http://ftp.gnu.org/gnu/m4/"
M4_VERSION="m4-1.4.7.tar.bz2"
PACKAGE_PATH="$M4_PATH$M4_VERSION"

#Getting files and uncompressing
wget -O $M4_VERSION $PACKAGE_PATH
tar xvjf $M4_VERSION
cd m4*

#Configure m4
./configure
make

#Install the package
sudo make install
