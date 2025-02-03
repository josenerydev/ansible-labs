ansible-playbook -i inventories/production/hosts playbooks/portainer/install-portainer.yml -l rocky9
ansible-playbook -i inventories/production/hosts playbooks/portainer/uninstall-portainer.yml -l rocky9
