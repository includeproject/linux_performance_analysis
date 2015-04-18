#!/usr/bin/expect -f

set timeout 10
set user [lindex $argv 0]
set password [lindex $argv 1]
set command [lindex $argv 2]

spawn su $user -c $command
expect "Password:"
send "$password\r";
interact