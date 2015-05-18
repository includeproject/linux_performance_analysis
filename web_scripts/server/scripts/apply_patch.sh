#!/bin/bash
usage(){
    script_name="$(basename "$(test -L "$0" && readlink "$0" || echo "$0")")"
    echo "usage: $script_name vagrant_directory local_patch_directory"
    echo "@arg vagrant_directory: must contain the Vagrantfile"
    echo "@arg local_patch_directory: must be besides the Vagrantfile in order to be shared with the guest machine"
}
if [[ $# -lt 2 ]];
    then
    echo "Error, two arguments are expected. Check the manual for more information."
    usage
    exit 1
    else
        if [[ ! -d $1 || ! -d $2 ]];
            then
            echo "Bad argument type privided"
            usage
            exit 1
        fi
fi
export USER_PATCH_DIR="$2";
sudo export USER_PATCH_DIR="$2";

for file in $USER_PATCH_DIR; do
      if [ -d "$file" ]
      then
              echo "This is a subdirectory. This feature is not supported yet";
	      continue
      else
              if [[ $file == *.patch ]]
              then
                     export APPLY_PATCH="git apply $file";
                     sudo export APPLY_PATCH="git apply $file";
	      elif [[ $file == *.xz ]]
              then
                     export APPLY_PATCH="sudo xz -dc $file | $(sudo patch -p1 || sudo patch -p0)";
                     sudo export APPLY_PATCH="sudo xz -dc $file | $(sudo patch -p1 || sudo patch -p0)";
              elif [[ $file == *.gz ]]
              then
                     export APPLY_PATCH="sudo gunzip $file | $(sudo patch -p1 || sudo patch -p0)";
                     sudo export APPLY_PATCH="sudo xz -dc $file | $(sudo patch -p1 || sudo patch -p0)";
              elif [[ $file == *.bz2 ]]
              then
                     export APPLY_PATCH="sudo bunzip2 $file | $(sudo patch -p1 || sudo patch -p0)";
                     sudo export APPLY_PATCH="sudo xz -dc $file | $(sudo patch -p1 || sudo patch -p0)";
              fi
      fi
      echo "Trying to apply your patches" >> ./logs/vm/vm_status
      vagrant ssh -c "cd ~/linux && $APPLY_PATCH >> /vagrant/kernel/apply_patch"
done;