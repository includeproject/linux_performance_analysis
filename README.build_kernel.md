Build and install the linux kernel
==================================
Please read ando follow the next steps in order to build and install the linux kernel on your machine.

>**WARNING:** Before you install a kernel, backup all of the important data. Be sure to make a copy of /boot/ onto a FAT32 memory card. This helps to repair the system if the installation fails. FAT32 does not store permissions, so it will be easier to use a live disk to copy the files back. Remember to set the original file permissions and executable bits.

If you want to know the current kernel version on your host OS, please type on a terminal 
```uname -r```

##Prerrequisites
You must have these libraries and dependencies installed on your system
- tar 
- wget
- make
- gcc
- gcc-c++
- binutils
- ncurses
- ncurses-devel
- bc

## Download the kernel source
Here you have two options to get the source
##### 1. From Kernel.org
You can get the source code from [kernel.org](https://www.kernel.org/). For example for the v3.19.1 stable release.
```sh
$ wget -c https://www.kernel.org/pub/linux/kernel/v3.x/linux-3.19.1.tar.xz
$ tar -xJf linux-3.19.3.tar.xz
$ cd linux-3.19.1
```
The kernel comes as a 20 to 50 MB tar.xz file depending of the version. It will decompress to about 200 MB and during the later compilation you will need additional space.
##### 2. From git tags
In the other hand you can get the source from git and select the latest stable tag. Following the example for v3.19.1
```sh
$ git clone git://git.kernel.org/pub/scm/linux/kernel/git/stable/linux-stable.git
$ cd linux-stable
$ git checkout -b stable v3.19.3
```

You can check all the stable tags available with:
```
$ git tag -l | less
```

##Configure the kernel options

Change to the linux kernel source directory. You'll now need to configure the kernel to select the features you want or need. There are several ways to do this..

*. ```make config```
* Command line questions.

*. ```make oldconfig```
* (Useful only if you kept a .config from a previous kernel build. With the newest kernels, the .config of the currently-running kernel is used by default if it's available, so you usually won't need this feature.)

*. ```make silentoldconfig```
* The same as oldconfig but without getting messages on the command line, excepting the errors.

*. ```make menuconfig```
* (ncurses required)

*. ```make gconfig```
* (GTK+ based X-Windows configuration)

*. ```make xconfig```
* (QT based X-Windows configuration) 

##Make dependencies

(Only for older kernel than 2.4.x)After saving your configuration above (it is stored in the ".config" file) you have to build the dependencies for your chosen configuration.

```make dep```

##Build the kernel

You can now compile the actual kernel by using the next command.

```make bzImage```

The resulting kernel file is "arch/*i386*/boot/bzImage"

##Install the modules

Modules are parts of the kernel that are loaded on the fly, as they are needed. They are stored in individual files. The more modules you have, the longer this will take to compile:
* ```make modules```
* ```make modules_install```

This will copy all the modules to a new directory, "/lib/modules/a.b.c" where a.b.c is the kernel version

##Configure your boot loader
If your distribution uses **lilo(Linux loader is for older distributions)**:

* Edit /etc/lilo.conf, and add these lines... 
```
image = /boot/vmlinuz-2.6.0
label = 2.6.0
```
Also copy your *root=/dev/* line here too. 
Run ```/sbin/lilo```. 

If your distribution uses **grub**: 
* Edit /boot/grub/grub.conf:
```
title=Linux 2.6.0
root (hd0,1) #  or whatever your current root is 
kernel /boot/vmlinuz-2.6.0 root=/dev/hda1 # or whatever... 
```
* Most distributions have an installation routine that links a new ```/boot/vmlinuz-[version]``` to simply vmlinuz, so you may want to add a stanza like this to grub.conf: 
```
title=My very latest kernel install
root (hd0,1) #  or whatever your current root is 
kernel /boot/vmlinuz root=/dev/hda1 # or whatever...
```

Reboot your system and enjoy.
####Note: In case you want to re-compile...
>If you want to re-configure the kernel from scratch and re-compile it, you must also issue a couple "make" commands that clean intermediate files. Note that "make mrproper" deletes your .config file. The complete process is:

* ```make mrproper```
* ```make menuconfig```
* ```make dep```
* ```make clean```
* ```make bzImage```
* ```make modules```
* ```make modules_install```
* ```make headers_install```


##References
This info was taken from 
[berkes.ca](http://www.berkes.ca/guides/linux_kernel.html), 
[kernel.org](http://www.linux.org/threads/the-linux-kernel-compiling-and-installing.5208/) and [kernelnewbies.org](http://kernelnewbies.org/FAQ/KernelCompilation)
