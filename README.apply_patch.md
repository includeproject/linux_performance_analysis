#What is a patch?
**Patch** is a Unix command line program that updates text files according to 
instructions contained in a separate file, called a patch file. The patch file is a text file that consists of a list of differences and is produced by running the related **diff** program with the original and updated 
file as arguments. Updating files with patch is often referred to as applying the 
patch or simply patching the files.[[1]]

---------------------------------------------

##Creating patches
There are sevaral ways to create a patch file. 

###Using diff unix program
It is necessary that you have two copies of the code, one with your changes, and one without. Suppose these two copies are in folders called 'standard_moodle' and 'my_moodle' which are subdirectories of the current folder. Then to create the patch, type:
```
$ diff -Naur standard_moodle my_moodle > patch.txt
```
Now your patch file will be the patch.txt file.
### Using git from a single commit
If you fix a bug or create a new feature in your git repository, please do it in a separate branch.

You can use the git command line program to create a patch from an specific commit. Please make sure that you have already commited all your changes.
```sh
$ git format-patch -1 <commit_hash>
```
But if you have not commited the changes, then:
```sh
$ git diff --cached > mypatch.patch
```
The ```--cached``` parameter is optional in case you have untracked changes.

For more information check the [git-format-patch] documentation.
### Using git from an entire branch
You can create series of patches comparing a branch against another one.
```
$ git format-patch master
```
In this case you are creating a patch file from any commit you have in your current branch and is missed in the master branch. The name of the patch files created will have the next format. 
```
0001_name_of_first_commit.patch
0002_name_of_second_commit.patch
...
xxxx_name_of_latest_commit.patch
```

###Using git to send a patch as e-mail
By default, git creates the patches with a standard mailbox format, so you can copy the content of the file and send it via e-mail.
However you can send the patch with the ```git send-email``` command. But this is not part of the git command options.Follow the next steps to create and send the patch(es).

##### 1. Install dependencies
You shall install an extra package named **git-email** from your linux repositories.
e.g.```yum install git-email```

##### 2. Configure your email on git
Here is an example in case you are using gmail as your e-mail server.
Open the file .git/.config and add next lines:
```
[sendemail]
	smtpencryption = tls
	smtpserver = smtp.gmail.com
	smtpuser = youremailaddress@gmail.com
	smtpserverport = 587
```
Do not forget to configure the file with your real settings.
##### 3. Create your patch file
Check the [git-format-patch] documentation.
```
$ git format-patch --to [mail@destination.domain] HEAD~..HEAD
```
##### 4. Send the patch(es)
```sh
$ git send-email --smtp-server=smtp.gmail.com *.patch
```
For more information check the [git-send-email] documentation.

####Note: 
>It is probably that your e-mail service provider do not allow you to execute third party programs such as ```git send-email```.

Example - For GMail
* Click this link: [configure_gmail]
* Make sure that the 'access of applications less safe' option is set as 'active'

####Note:
> Please have git setup with consistent user information before sending a patch. Preferably with your real name and a
working email address (the one you use to send the patches to the mailing list, for example).
```
$ git config --global user.name "Your Name or Username"
$ git config --global user.email your@email.domain
```
----------------------------------------------------------

##How to apply a patch?
In this case we are refering to apply patches to the kernel source code. We are going to explain two ways to apply patches.
1. Go to the kernel source directory.
```sh
$ cd <path_to_kernel_source_directory>
```
2. Once inside the source directory, copy the current kernel's configuration, with:
```sh 
$ sudo cp /boot/config-`uname -r`* .config
```
3. Apply the patch(es): 
For normal patch file.(Uncompressed form)
```
$ patch -p1 < patch_name.patch
``` 
Depending of the patch file format (Compressed form) 
```sh
$ gunzip patch-x.y.z.gz | patch -p1
$ bunzip2 patch-x.y.z.bz2 | patch -p1
$ xz -dc patch-x.y.z.xz | patch -p1
``` 
If you have formatted patches from git
```sh
$ git apply patch-x.y.z.patch
$ git apply patch-x.y.z.diff
```
If the format is a mailbox, use the next options.
```sh
$ git am -s patch.x.y.z.patch
$ git am <Path to mailbox>
```
If you use the second option you can apply full series of patches sent to a mailbox.
If the mailbox way to patch fails, you can run:
```
$ git am --abort
$ git reset --hard HEAD
$ git am -3 patchfile
```
Check [git-am] documentation for more information.

4. Compile the kernel:
In order to compile and recompile the kernel, please check the [README.build_kernel] file.

##How to revert a patch?
##### If applied with patch unix command
Depending of the parameter -p you used to apply the patch, the command will be
```
$ patch -R -p1 < <path_to_patch-x.y.z>
$ patch -R -p0 < <path_to_patch-x.y.z>
```
##### If applied via git
If a maintainer wants you to revert a patch you have applied, and try a different patch, you can use git to reset the history to the point before the patch was applied.

If git log shows the patch to be removed is the first log entry, you can run
```
git reset --hard HEAD^
```
If you need to revert several patches, you can use git log to find the commit ID of the first commit before those patches. For instance, say you have applied two patches to the stable tree 3.4.17, and you want to revert those patches. git log will look like this:
```
    git log --pretty=oneline --abbrev-commit
    8901234 Testing patch 2
    1234567 Testing patch 1
    5390967 Linux 3.4.17
    1f94bd4 drm/i915: no lvds quirk for Zotac ZDBOX SD ID12/ID13
    0187c24 x86, mm: Use memblock memory loop instead of e820_RAM
    a0419ca staging: comedi: amplc_pc236: fix invalid register access during detach
```
To reset your tree to 3.4.17, you can run:
```sh
$ git reset --hard 5390967
```
If you look at the commits with git you will notice that the 3.4.17 commit is also tagged as v3.4.17. You can reset by tag as well:
```sh
git reset --hard v3.4.17
```
[1]:http://en.wikipedia.org/wiki/Patch_(Unix)
[git-format-patch]:http://git-scm.com/docs/git-format-patch
[git-send-email]:http://git-scm.com/docs/git-send-email
[git-am]:http://git-scm.com/docs/git-am
[configure_gmail]:https://accounts.google.com/ServiceLogin?sarp=1
[kernel.org]:https://www.kernel.org/
[README.build_kernel]:https://github.com/includeproject/linux_performance_analysis/blob/master/README.build_kernel.md
[kernelnewbies]:http://kernelnewbies.org/KernelBuild