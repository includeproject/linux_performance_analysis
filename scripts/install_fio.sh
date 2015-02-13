#!/bin/bash

echo "****************************************"
echo "* Welcome to the installation of fio   *"
echo "* Make sure than you already have      *"
echo "* installed FTP and powertop. Have Fun!*"
echo "****************************************"

sleep 4

#Command used to acces the fio sources directory

cd ..

export DIR=$(pwd)

cd $DIR/fio-2.1.10

#Configuring the source code

./configure

#Compiling

make

#Installing

sudo make install

export OUT=$?

#Running a preleminary test

cd ..

cd $DIR/scripts



if [ $OUT > 0 ]; then

    echo "The installation was seccesful."
    ./running_default_test.sh

else

    echo "Installation faild. Quitting ..."
    exit 1

fi

