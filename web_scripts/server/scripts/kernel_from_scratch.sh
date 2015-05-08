#!/bin/bash
# usage: kernel_from_scratch.sh directory
# the directory must not contain any Vagrantfile since it will be created with
# this script.
if [[ $# -lt 1 ]];
    then
    echo "Error, an argument is expected. Check the manual for more information."
    exit 1
    else
        if [[ ! -d $1 ]];
            then
            echo "Bad argument privided, it must be an existing directory"
            exit 1
        fi
fi
export wdir="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
export user_dir=$1 
export kernel_config_type=defconfig
export error=0
#export kernel_config_type=oldconfig

cd "$user_dir"
echo ""
echo ">>>>>>>> executing vagrant init"
echo ""
vagrant init
sed -i "s/config.vm.box = \"base\"/config.vm.box = \"lpa\/v0.3\"/g" Vagrantfile 
echo ""
echo ">>>>>>>> executing vagrant up"
echo ""
vagrant up
mkdir -p ./logs/vm
mkdir -p ./logs/kernel
mkdir -p ./logs/results

echo "Virtual machine successfuly created" >> ./logs/vm/vm_status
echo "Cloning kernel from github" >> ./logs/vm/vm_status
# You can modify the number of attempts
for i in {1..3}
do
    export success_flag=$(vagrant ssh -c "if [[ -d ~/linux ]]  ;then  echo 'true' ; else  echo 'false' ; fi")
    if [[ "$success_flag" = "false" ]]
        then
    echo ""
    echo ">>>>>>>> executing git clone trying $i of 3"
    echo ""
        vagrant ssh -c "cd ~ && git clone https://www.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git ~/linux --depth 1 >> /vagrant/logs/kernel/git_clone"
    else
        export success_flag="true"
        break
    fi
done
echo "$success_flag"
if [[ "$success_flag" -eq "true" ]]
    then
    echo "latest kernel downloaded" >> ./logs/vm/vm_status
    #We need to compile the latest kernel version, take care if you rename the scripts
    "$wdir"/recompile_kernel.sh $1 -o
else
    echo 'There was an error downloading the kernel from git'
    exit 1
fi