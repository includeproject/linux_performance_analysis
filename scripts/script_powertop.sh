#!/bin/sh

# Installar Power TOP.
echo "****************************************"
echo "* Welcome to the installation of Power TOP   *"
echo "****************************************"


#Note: For Android (running Intel Architecture ) there is a Android.mk 
#that was provided by community members, and at this time is supported
# mostly by community members.

#in addition, PowerTOP requires the following components:

#pciutils-devel (is only required if you have PCI) 
#ncurses-devel  (required) 
#libnl-devel    (required)



#set -x

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`
export directorySource=$directoryRoot/sources/
export powerTopPackage="https://01.org/sites/default/files/downloads/powertop/powertop-2.7.tar.gz"
export powertop_version="powertop-2.7"

# =============================================================================
# Script Functions
# =============================================================================


#download the powertop source
aptGetPowerTop() {
	cd $directorySource
	wget $powerTopPackage
	tar xzvf $powertop_version".tar.gz"
}

buildingPowerTop() {
	
	cd $directorySource$powertop_version
	
	./configure 
	make
	sudo make install
	cd ../
}
# =============================================================================
# Script Main
# =============================================================================

test -d $directorySource || mkdir $directorySource 
aptGetPowerTop
buildingPowerTop

exit

