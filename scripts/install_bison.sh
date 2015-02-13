###################################################
# bison installation script                       #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variables definitions
BISON_PATH="http://ftp.gnu.org/gnu/bison/"
BISON_VERSION="bison-2.4.1.tar.gz"
PACKAGE_PATH="$BISON_PATH$BISON_VERSION"

#Getting files and uncompressing
wget -O $BISON_VERSION $PACKAGE_PATH
tar xvfz $BISON_VERSION
cd bison*

#Configure Bison
./configure
make


#Install the package

sudo make  install
