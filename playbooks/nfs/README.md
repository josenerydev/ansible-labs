# Playbook NFS para AIX

Este playbook configura um sistema de arquivos NFS utilizando o módulo
`community.general.aix_filesystem` para sistemas AIX.

## Estrutura

- **main.yml**: Playbook principal que inclui tasks para servidor e cliente.
- **tasks/**
  - **server.yml**: Tarefas para configurar o NFS no nó _manager_ (servidor).
  - **client.yml**: Tarefas para configurar a montagem NFS nos nós _workers_ (clientes).
- **handlers/**
  - **main.yml**: Handler para reiniciar o serviço NFS (comando `refresh -s nfsd`).

## Uso

Execute o playbook com:

```bash
ansible-playbook -i inventories/production/hosts playbooks/nfs/main.ansible.yml -l rocky9


sudo ls -l /var/lib/docker/volumes/nfs_download/_data
