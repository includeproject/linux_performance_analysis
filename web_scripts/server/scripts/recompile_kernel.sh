#/bin/bash
#The manual will contain info about parameters
#-o oldconfig
#-d defconfig
#-s silentoldconfig
function usage
{
    script_name="$(basename "$(test -L "$0" && readlink "$0" || echo "$0")")"
#    echo "usage: $script_name [[-config_type <oldconfig | defconfig | silentoldconfig> ] | [-o|-d|-s]]"
    echo "usage: $script_name vagrant_directory [ -o | -d | -s ]"
    echo "where vagrant_directory must contain an existing Vagrantfile"
    echo "otherwise it will ask if you want to create a new vm from scratch"
    exit 0
}
recursive(){
    echo "There is no virtual machine created, create a new one from scratch (y/n)"
        read ans
        if [[ $ans = n || $ans = N ]]
            then
            echo "quiting..."
        elif [[ $ans = y || $ans = Y ]]
            then
                echo "Creating new virtual machine from scratch"
#Be careful if you want to rename any file
                wdir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
                "$wdir"/kernel_from_scratch.sh
        else
            echo "Invalid answer"
            recursive
        fi
}
if [[ $# -gt 2 ]]
    then
    echo "Error, this script only accepts two arguments"
    usage
    exit 1
elif [[ ! -d $1 ]] 
    then
    echo "Bad argument provided, the first argument must be a directory"
    exit 1
fi
if [[ "$1" = "-h" ]]
    then
    usage
    exit 1
elif [[ "$2" = "-o" ]]
    then
    export kernel_config_type="oldconfig"
elif [[ "$2" = "-s" ]]
    then
    export kernel_config_type="silentoldconfig"
else
    export kernel_config_type="defconfig"
fi
compile(){
    echo "making configuration by $kernel_config_type method" >> ./logs/vm/vm_status
    vagrant ssh -c "cd ~/linux && sudo make $kernel_config_type >> /vagrant/logs/kernel/make_$kernel_config_type"
    echo "Preparing the kernel to make" >> ./logs/vm/vm_status
    vagrant ssh -c "cd ~/linux && sudo make prepare >> /vagrant/logs/kernel/make_prepare"
    echo "Compiling the kernel" >> ./logs/vm/vm_status
    vagrant ssh -c "cd ~/linux && sudo make >> /vagrant/logs/kernel/make"
    echo "installing modules" >> ./logs/vm/vm_status
    vagrant ssh -c "cd ~/linux && sudo make modules_install >> /vagrant/logs/kernel/make_modules_install"
    echo "installing headers" >> ./logs/vm/vm_status
    vagrant ssh -c "cd ~/linux && sudo make headers_install >> /vagrant/logs/kernel/make_headers_install"
    echo "installing kernel" >> ./logs/vm/vm_status
    vagrant ssh -c "cd ~/linux && sudo make install >> /vagrant/logs/kernel/make_install"
    echo "Restarting machine ..." >> ./logs/vm/vm_status
#    vagrant ssh -c "sudo init 6 && echo $(date) >> /vagrant/restart_log"
    
#    sleep 5m
    vagrant vbguest --do rebuild >> ./logs/vm/rebuild
    vagrant reload >> ./logs/vm/reload
    echo "The machine is ready" >> ./logs/vm/vm_status
}

cd "$1"
vagrant_status="$(vagrant status | grep default | cut -c 27- | cut -d'(' -f1  | xargs)"
if [ "$vagrant_status" = "running" ] 
    then 
        echo "Your virtual machine is running"
        compile
    elif [ "$vagrant_status" = "poweroff" ]
        then
            echo "Your virtual machine is halted, running vagrant up"
            vagrant up
    elif [ "$vagrant_status" = "saved" ]
        then
            echo "Your virtual machine is suspended, resuming session..."
            vagrant resume
    else
        recursive
fi