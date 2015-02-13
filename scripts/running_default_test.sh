#!/bin/bash

########################################
# This is the default case provided to #
# test the package fio. It should be   #
# used to verifie the correct          #
# installation of fio, but can be used #
# to define a default test on the      #
# project                              #
########################################

#Doing the standard tests

fio --output=debug_test.out --debug=all default.ini

fio --output=bandwidth_test.out --bandwidth-log default.ini

fio --output=latency_test.out default.ini

fio --cpuclock-test --output=cpuclock_test.out

#Accesing the output directory

cd ..

export DIR=$(pwd)

mkdir output

cd $DIR/scripts

#Coping the files to the output directory

mv debug_test.out $DIR/output

mv bandwidth_test.out $DIR/output

mv cpuclock_test.out $DIR/output

mv latency_test.out $DIR/output

echo "Test were succesful, the outputs are in the output directory located on the linux_perfomance directory."
