cd /var/www/html/lpa_files/kernel
vagrant init
sed -i "s/config.vm.box = \"base\"/config.vm.box = \"lpa\/v0.3\"/g" Vagrantfile 
vagrant up

vagrant ssh -c "git clone https://www.kernel.org/pub/scm/linux/kernel/git/torvalds/linux.git ~/linux --depth 1"

vagrant ssh -c "cd ~/linux && git am /vagrant/mailbox/*.patch"

vagrant ssh -c 'cd ~/linux && sudo make defconfig'
vagrant ssh -c 'cd ~/linux && sudo make prepare'
vagrant ssh -c 'cd ~/linux && sudo make'
vagrant ssh -c 'cd ~/linux && sudo make modules_install'
vagrant ssh -c 'cd ~/linux && sudo make headers_install'
vagrant ssh -c 'cd ~/linux && sudo make install'
vagrant ssh -c 'sudo init 6'