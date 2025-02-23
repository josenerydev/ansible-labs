docker stack deploy -c app/app.stack.yml app

docker build -t app:1.0.0 .

docker build -t app:2.0.2 ./app

chmod -R 777 app/logs

ansible-playbook playbooks/app/build_push.ansible.yml

ansible-playbook -i inventories/production/hosts playbooks/app/deploy_stack.ansible.yml -l rocky9

http://192.168.56.4:8080/

http://192.168.56.4:8080/nfs_test.php

http://app.local/