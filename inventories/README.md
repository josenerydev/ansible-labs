ansible -i inventories/production/hosts rocky9 -m ping


ansible-playbook -i inventories/production/hosts playbooks/docker/install-docker.yml -l rocky9
