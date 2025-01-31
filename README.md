ansible-galaxy install -r requirements.yml
ansible-galaxy list


curl -o vagrant_insecure_key https://raw.githubusercontent.com/hashicorp/vagrant/main/keys/vagrant
chmod 600 vagrant_insecure_key

ssh -i vagrant_insecure_key vagrant@192.168.56.5

vagrant up
