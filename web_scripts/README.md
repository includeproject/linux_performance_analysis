Linux performance tests page
============================

Is a web page that allow you to upload series of patches to test them
and get the results on the same page. You can compare your changes against 
the latest stable release of the linux kernel.

##Application flow
1. The user needs to sign up in order to create a space on the server and assign 
him a virtualmachine with all performance tools already installed.
2. Once the user is signed in, he is be able to upload a patch or series of 
patches from the user panel.
3. If the user has one or more patch files uploaded, he will track the status 
of them. The status could be "Standby|Running|Rejected|Tested"

    **Standby:** Is the patch uploaded but not tested yet.
    
    **Running:** If you send a signal to test one patch, the results will not 
be available immediatly, so the status will change to Running.

    **Rejected:** If you send a patch that can not be applied to the latest stable 
kernel source it will be rejected and banned to test.  

    **Tested:** Once the server has finished to test the patch.
4. The user must wait until the test finish on server's side because he only can
 use one virtual machine at a time. Meanwhile he can check and analyze previous 
tests.
5. The user will be notified when a test finished and the virtual machine will 
revert all changes.
6. The results will generate logs to see the shell output of patch(es) application. 
And will be stored on user's directory, besides the patch.

#Instalation

##Prerrequisites

You have to downlad and install the next packages and dependencies
- apache2(http-server)
- php5
- mysql mysql-server
- apache-mod-php
- mysql-mod-php

###Note:
A makefile will be made for ease the installation of this tool

### Installation

You need to open a shell prompt and put the next sentence

$ git clone https://github.com/includeproject/linux_performance_analysis.git

###Initialize the services

$ sudo /etc/init.d/mysql start
$ sudo /etc/init.d/apache2 restart
$ apachectl -t -D php5_module

###Load database

$ mysql -u <mysqluser> -p<password> < <path_to_linux_performance_analysis>/web_scripts/server/databases/linuxPerformanceAnalysis.sql>

$ sudo cp -r linux_performance_analysis/ /var/www/html/

###NOTE 
This location could vary depending your linux distribution

###To acces and use the web_page in your machine
access to http://<your_host_address>/Linux_performance_tests_page 