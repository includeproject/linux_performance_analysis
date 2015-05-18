# Setting Vagrant Virtual machine manager

In order to avoid messing with the actual server, the linux performance proyect works using virtual machines for the performance tests.

### Version
0.1

### Requirements

This packages are required to mount the linux_performance box

* [Vagrant] - Virtual machine manager
* [Virtual Box] - awesome web-based text editor
* [Linux headers or build files] - 
* [linux_performance box]

### Installation

First you have to download the box file

```sh
$ wget ftp://189.254.249.182/pub/linux_performance.box
```

Now, move the box on the vagrant directory

```sh
$ mv linux_performance.box /home/$USER/.vagrant.d/boxes
```

TODO: Script for auto intallation