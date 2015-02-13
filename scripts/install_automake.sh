###################################################
# automake installation script                    #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variables definitions
AUTOMAKE_PATH="ftp://ftp.gnu.org/gnu/automake/"
AUTOMAKE_VERSION="automake-1.10.2.tar.bz2"
PACKAGE_PATH="$AUTOMAKE_PATH$AUTOMAKE_VERSION"

#Getting files and uncompressing
wget -O $AUTOMAKE_VERSION $PACKAGE_PATH
tar xvjf automake-1.10.2.tar.bz2
cd automake*

#Configure automake
./configure
make

#Install the package
sudo make  install
