#!/usr/bin/expect -f
# usage: ./execute_command.sh user password command
# @param user: must have the right permissions to execute the command
# @param password: is the password of the user specified
# @param command: this parameter must be in double quotes 
# Command example
# ./execute_command.sh kernel LinuxPerformance "fdisk -l > list_disks.txt"

set timeout 10
set user [lindex $argv 0]
set password [lindex $argv 1]
set command [lindex $argv 2]

spawn su $user -c $command
expect "Password:"
send "$password\r";
interact