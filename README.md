ansible-galaxy install -r requirements.yml
ansible-galaxy list


curl -o vagrant_insecure_key https://raw.githubusercontent.com/hashicorp/vagrant/main/keys/vagrant
chmod 600 vagrant_insecure_key

ssh -i vagrant_insecure_key vagrant@192.168.56.5

vagrant up
vagrant ssh app1

## **1. Criar e Ativar o Ambiente Virtual**
Crie um ambiente virtual Python para isolar as dependências do projeto:

```bash
python3 -m venv venv
source venv/bin/activate
```

Para desativar o ambiente virtual:
```bash
deactivate
```

---

## **2. Instalar Dependências**
Instale as dependências listadas no arquivo `requirements.txt`:

```bash
pip install -r requirements.txt
```

ansible all -i inventories/production/hosts -m ping