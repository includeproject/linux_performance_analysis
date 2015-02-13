###################################################
# make actualization script                       #
# This will only execute if the current system    #
# do not have bison. Is pretty simple, if the     #
# installation fails, the script will return an $?#
# equal to 1 to stop the LTP installation.        #
###################################################

#Variables definitions
$MAKE_PATH='http://ftp.gnu.org/gnu/make'
$MAKE_VERSION_FILE='make-3.81.tar.bz2'

#Getting files and uncompressing
wget -O $MAKE_PATH/$MAKE_VERSION_FILE
tar xvjf $MAKE_VERSION_FILE
cd make*

#Configure make
./configure
make

#Install the package
sudo make install
