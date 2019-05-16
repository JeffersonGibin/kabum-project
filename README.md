# Projeto KaBuM

### O que é ?

O Projeto KaBuM é um projeto desenvolvido para a participação do processo selectivo **KaBuM!**.

#### Especificações

* Uma área administrativa onde o(s) usuário(s) devem acessar através de login e senha
* Criar um gerenciador de clientes (Listar, Incluir, Editar e Excluir)
* O cadastro do Cliente deve conter: Nome; Data Nascimento; CPF; RG; Telefone.
* O Cliente pode ter 1 ou N endereços.

#### Configuração


##### 1 - Softwares necessários

Antes de mais nada, baixe todos os programas a seguir:

* PHP >= 7.1.21
* NPM  >= 6.8.0
* MySQL >= 5.7.23

##### 2 - Diretório remoto

Certifique-se de que você já tenha feito um clone do repositório. Caso não tenha feito, escolha um diretório de seu preferência e utilize o seguinte comando em seu terminal.

```
git clone https://github.com/JeffersonGibin/kabum-project.git
```

O projeto KaBuM utiliza vue.js e o source de seus arquivos estão em '.vue.js' para testar em ambiente local utilize os seguintes comandos:
```
npm install vue
```

Agora vamos baixar todas dependências que o projeto vue utiliza:

```
npm install
```

## WebSerivce

O Webservice é quem prove toda massa de dados necessárias para o painel administrativo funcionar.

Acesse o diretório webservice/config/src/settings/ e edite o arquivo config.php

```php
<?php

/*
 * Define se o ambiente é produção ou desenvolvimento.
 */
$environment = "DEV";

/*
 * Diretório raiz.
 */
$dirName = "kabum";

/*
 * Host da onde está o banco de dados.
 */
$host = "localhost";

/*
 * Nome do banco de dados.
 */
$dbname = "";

/*
 * Usuário do banco de dados.
 */
$user = "";

/*
 * Senha do banco de dados.
 */
$password = "";

```

#### Tecnologias utilizadas
* PHP
* Vue.js
* Vuetify
* HTML
* CSS
* JavaScript
* MySQL
