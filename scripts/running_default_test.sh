#!/bin/bash

########################################
# This is the default case provided to #
# test the package fio. It should be   #
# used to verifie the correct          #
# installation of fio, but can be used #
# to define a default test on the      #
# project                              #
########################################

#Variables
DEFAULT_JOB='default.ini'
BANDWIDTH_OUT='bandwidth_test.out'
LATENCY_OUT='latency_test.out'
CPUCLOCK_OUT='cpuclock_test.out'
DEBUG='debug_test.out'

#Doing the standard tests

fio --output=$DEBUG --debug=all $DEFAULT_JOB
fio --output=$BANDWIDTH_OUT --bandwidth-log $DEFAULT_JOB
fio --output=$LATENCY_OUT $DEFAULT_JOB
fio --cpuclock-test --output=$CPUCLOCK_OUT

#Accesing the output directory

cd ..
export DIR=$(pwd)
mkdir output
cd $DIR/scripts

#Coping the files to the output directory

mv $DEBUG $DIR/output
mv $BANDWIDTH_OUT $DIR/output
mv $CPUCLOCK_OUT $DIR/output
mv $LATENCY_OUT $DIR/output
echo "Test were succesful, the outputs are in the output directory located on the linux_perfomance directory."
