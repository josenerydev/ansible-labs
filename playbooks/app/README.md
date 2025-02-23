docker stack deploy -c app/app.stack.yml app

docker build -t app:1.0.0 .

docker build -t app:2.0.2 ./app

chmod -R 777 app/logs

ansible-playbook playbooks/app/build_push.yml

ansible-playbook playbooks/app/deploy_stack.yml

ansible-playbook -i inventories/production/hosts playbooks/app/deploy_stack.yml  -l rocky9