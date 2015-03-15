#!/bin/bash
########Apply method1 (uncompressed form)
#patch -p1 < ../patch-x.y.z
#patch -R -p1 < ../patch-x.y.z

########Apply method2 (compressed with gz and bz2)
#gunzip patch-x.y.z.gz
#bunzip2 patch-x.y.z.bz2

########Apply method3 (if you have an xz compressed patch)
#xz -dc patch-x.y.z.xz | patch -p1

########Apply method4 (git from formatted patches)
#git apply patch-x.y.z.patch
#git apply patch-x.y.z.diff

########Apply method5 (git from mailbox)
#git am -s 0001-patch.x.y.z.patch
#git am <Path to mailbox>

# A few other nice arguments for patch are -s which causes patch to be silent
# except for errors which is nice to prevent errors from scrolling out of the
# screen too fast, and --dry-run which causes patch to just print a listing of
# what would happen, but doesn't actually make any changes. Finally --verbose
# tells patch to print more information about the work being done.

# Type man patch for more information about patching

################################################################################################
export USER_PATCH_DIR=$1;
sudo export USER_PATCH_DIR=$1;

for file in $USER_PATCH_DIR; do
      if [ -d $file ]
      then
              echo 'This is a directory, fatal error:';
	      exit 0;
      else
              if [[ $file == *.patch ]]
              then
                     export APPLY_PATCH='git apply $file';
                     sudo export APPLY_PATCH='git apply $file';
              fi
	      if [[ $file == *.xz ]]
              then
                     export APPLY_PATCH='sudo xz -dc $file | sudo patch -p1';
                     sudo export APPLY_PATCH='sudo xz -dc $file | sudo patch -p1';
              fi
      fi
done;

sudo cp $USER_PATCH_DIR /home/kernel/vm/ 
sudo vagrant ssh -c "cd /home/vagrant/linux-stable && $APPLY_PATCH > patch_application.log"
sudo vagrant ssh -c 'cd /home/vagrant/linux-stable && yes "" | sudo make oldconfig > make_config.log'
sudo vagrant ssh -c 'cd /home/vagrant/linux-stable && sudo make prepare > prepare.log'
sudo vagrant ssh -c 'cd /home/vagrant/linux-stable && sudo make > make.log'
sudo vagrant ssh -c 'cd /home/vagrant/linux-stable && sudo make modules_install > make_modules_install.log'
sudo vagrant ssh -c 'cd /home/vagrant/linux-stable && sudo make headers_install > make_headers_install.log'
sudo vagrant ssh -c 'cd /home/vagrant/linux-stable && sudo make install > make_install.log'
sudo vagrant ssh -c 'sudo init 6'

sudo vagrant --do rebuild
sudo vagrant reload


