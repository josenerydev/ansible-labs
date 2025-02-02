ansible-playbook -i inventories/production/hosts playbooks/docker/install-docker.yml -l rocky9

ansible-playbook -i inventories/production/hosts playbooks/docker/uninstall-docker.yml -l rocky9

ansible-playbook -i inventories/production/hosts playbooks/docker/init-swarm.yml -l rocky9

ansible-playbook -i inventories/production/hosts playbooks/docker/install-docker-deps.yml -l rocky9

ansible-playbook -i inventories/production/hosts playbooks/docker/join-workers.yml -l rocky9

ansible-playbook -i inventories/production/hosts playbooks/docker/configure-firewalld.yml -l rocky9
