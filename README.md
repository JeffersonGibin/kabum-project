# Projeto KaBuM

### O que é ?

O Projeto KaBuM é um projeto desenvolvido para participação do processo selectivo **KaBuM!**.

### Especificações

* Uma área administrativa onde o(s) usuário(s) devem acessar através de login e senha
* Criar um gerenciador de clientes (Listar, Incluir, Editar e Excluir)
* O cadastro do Cliente deve conter: Nome; Data Nascimento; CPF; RG; Telefone.
* O Cliente pode ter 1 ou N endereços.

### 1 - Configuração


#### 1.1 - Softwares necessários

Antes de mais nada, baixe todos os programas a seguir:

* PHP >= 7.1.21
* NPM  >= 6.8.0
* MySQL >= 5.7.23

#### 1.2 - Diretório remoto

Certifique-se de que você já tenha feito um clone do repositório. Caso não tenha feito, escolha um diretório de seu preferência e utilize o seguinte comando em seu terminal.

```bash
git clone https://github.com/JeffersonGibin/kabum-project.git
```

O projeto KaBuM utiliza vue.js e o source de seus arquivos estão em '.vue.js' para testar em ambiente local utilize os seguintes comandos:
```bash
npm install vue
```

Agora vamos baixar todas dependências que o projeto vue utiliza:

```bash
npm install
```

#### 1.3 Webservice PHP

O Webservice é quem prove toda massa de dados necessárias para o painel administrativo funcionar. Nesse Projeto o webservice foi construido do zero, mais a frente dessa leitura você vai encontrar as rotas que ele disponibiliza.

Para que o webservice funcione é necessário copiar a pasta webservice dentro do diretório htdocs do seu servidor local.

#### 1.3.1 Configuração do WebService

Acesse o diretório kabum-project/webservice/config/src/settings/ e edite o arquivo config.php

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

## Sistema



## Documentação API

#### Token

Para gerar um token você precisa enviar login e senha para o endpoint de login. O token, id e nome do usuário são salvos no localStorage. Para recuperar utilize a função


Para cadastrar um usuário no sistema utilize a seguinte Query.

```sql
  INSERT INTO usuario (nome, login, senha, permissao) VALUES ('Jefferson', 'Teste', md5('123'), 'ADMIN');
```

**Retorno**
```javascript
{
  localStorage.get("SESSION_KABUM")
}
```

#### HEADER
Em todas as rotas é necessário enviar o token(Authorization) no header da requisição exceto na rota **login**.
**Nota**: O token não expira;


| Parâmetros     | tipo       | Descrição                       |
| -------------  |------------|---------------------------------|
| Authorization  | String     | Token da sessão do usuário      |


#### Cliente


* Parâmetros necessários para cadastrar um cliente
* POST - http://localhost/api/cadCliente/

| Parâmetros     | tipo       | Descrição                                      |
| -------------  |------------|------------------------------------------------|
| nome           | String     | nome do cliente **(Required)**                 |
| ativo          | bigInt     | 0 / 1                                          |
| cpf            | String     | CPF do cliente                                 |
| dataNascimento | Date       | data de nascimento do cliente                  |
| numero         | String     | número do cliente                              |
| telefone       | String     | Telefone do cliente do cliente                 |
| celular        | String     | Celular do cliente                             |
| usuarioid      | int        | usuário que cadastrou o cliente **(Required)** |

**Cadastrar**
*  Os parâmetros necessários para editar um cliente é muito parecido com o cadastro de cliente. Todos os campos da entidade Cliente pode ser passados exceto, id e clienteid;
*  PUT - http://localhost/api/cadCliente/[clienteID]

**Edtar**
*  Obrigatório informar o clienteID.
*  PUT - http://localhost/api/editCliente/[clienteID]

**Listar**
*  Obrigatório informar o clienteID.
*  GET - http://localhost/api/removeCliente/[clienteID]


#### Retorno de Erros

| Status                      | Code | message                                                  |
| ----------------------------|------|----------------------------------------------------------|
| ERRO                        | 500  | Você não está logado no sistema!                         |
| REQUIRED_VALUE              | 200  | Campos obrigatórios                                      |
| CLIENTE_EXISTS              | 200  | O cliente já está cadastrado!                            |
| CLIENTE_NOT_EXISTS          | 200  | O cliente que você está tentando editar não existe.      |
| CLIENTE_ENDERECO_NOT_EXISTS | 200  | O endereço que você está tentando editar não existe.     |
| NOT_FOUND                   | 200  | Retornado quando algo não foi encontrado                 |





### Tecnologias utilizadas
* PHP
* MySQL
* Vue.js, Vuetify
* HTML, CSS

