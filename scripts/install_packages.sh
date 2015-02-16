#!/bin/sh

# =============================================================================
# Scripts Variables
# =============================================================================

export directoryRoot=`pwd`

export aptGetName=apt-get
export aptGetPackages="autoconf automake bison byacc flex m4 make"

# =============================================================================
# Script Functions
# =============================================================================

aptGet() {
	su root -c "$aptGetName update"
	su root -c "$aptGetName install $aptGetPackages"
}



# =============================================================================
# Script Main
# =============================================================================

if apt-get > /dev/null; then
	aptGet
fi

# End of File
