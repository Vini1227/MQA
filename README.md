# MQA - Mãos que ajudam 
Sistema para intermediar a comunicação entre doadores e ONGs. Criado com o intuito de facilitar a comunicação entre o usuário e instituições sociais. 


## Funcionalidades ⚙


* Login de Usuários (ONGs, doadores e administrador)
* Cadastro de Usuários (ONGs, doadores e administrador)
* Recuperação de Senha (para os usuários que perderam sua senha não perderem acesso ao sistema)
* Opções de Doação (Usuário vai poder escolher o que doar)
* Perfil (para ONGs e Usuários conseguirem criar uma identidade na aplicação)
* Sistema de filtragem (necessidade da ONG e desejo do usuário)
* Geolocalização (com recomendação de proximidade)
* Sistema de Chat (para forma de contato entre usuário e ONG)
* Sistema de Validação (para o administrador qualificar as ONGs confiáveis)


## Tecnologias ⚛

* HTML
* CSS
* PHP
* MYSQL
* JAVASCRIPT
* REACT


## Como rodar o MQA na sua máquina local 🚀

Siga os passos abaixo para configurar e rodar o MQA localmente.

### 1. Verifique os pré-requisitos
Certifique-se de que o **PHP** e o **MySQL** estão instalados em sua máquina.

- Caso não tenha essas ferramentas, você pode baixá-las nos seguintes links:
  - [Baixar PHP](https://www.php.net/downloads.php)
  - [Baixar MySQL](https://dev.mysql.com/downloads/)

### 2. Habilitar a extensão PDO no PHP
- Abra o arquivo `php.ini` do seu PHP (geralmente localizado na pasta de instalação do PHP).
- Localize a linha `;extension=pdo_mysql` e remova o ponto e vírgula (`;`) no início dela para habilitar a extensão.

### 3. Configuração do banco de dados
- Abra o arquivo `config.php` na pasta do projeto.
- Verifique e, se necessário, altere a porta do banco de dados. Por padrão, o MySQL usa a porta `3306`, mas se você estiver usando uma porta diferente, altere a linha correspondente.

### 4. Criando o banco de dados
O banco de dados necessário para o funcionamento do MQA está definido no arquivo `banco.sql`.

### 5. Rodando o servidor
- Acesse a pasta `MQA` via terminal.
- Execute o comando:
  ```bash
  php -S localhost:8000


## Desenvolvedores 👨🏽‍💻


* [Ryon](https://github.com/Ryonxl)
* [Guilherme](https://github.com/Guilhermemth)
* [Paulo](https://github.com/Paulorc0)
* [Felipe](https://github.com/Feliperasilva)
* [Caio](https://github.com/Vini1227)
* [Kaua](https://github.com/Kaua17742)
