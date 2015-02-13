###################################################
# flex installation script                        #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variables definitions
FLEX_PATH="http://sourceforge.net/projects/flex/files/"
FLEX_VERSION_FILE="flex-2.5.39.tar.bz2"
PACKAGE_PATH="$FLEX_PATH$FLEX_VERSION_FILE"

#Getting files and uncompressing
wget -O $FLEX_VERSION_FILE $PACKAGE_PATH
tar xvjf $FLEX_VERSION_FILE
cd flex*

#Configure flex
./configure
make

#Install the package
sudo make  install
