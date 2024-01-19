Sobre o projeto:

Este projeto foi baseado no projeto de acl da EspecializaTI, com algumas melhorias feitas por mim, este projeto tem apenas o objetivo de ser uma base de ACL para projetos futuros.

Este projeto está utilizando o Laravel na versão 10, utlizamos o docker para montar todo o ambiente então se atente as portas que estão sendo utilizadas no docker-compose.yml para não ter conflito em seu projeto.

## Passo a passo para rodar o projeto
Clone o projeto
```sh
git clone git@github.com:especializati/laravel-api-acl.git api-acl
```
```sh
cd api-acl
```

Crie o Arquivo .env
```sh
cp .env.e✔ample .env
```

Atualize essas variáveis de ambiente no arquivo .env
```dosini
APP_NAME="API ACL"
APP_URL=http://localhost:8989

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=nome_usuario
DB_PASSWORD=senha_aqui

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container
```sh
docker-compose e✔ec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```

Acesse o projeto
[http://localhost:8881](http://localhost:8881)

após isso você poderá utilizar o arquivo do postman que será disponibilizado! ele terá algumas rotas: 
# Rotas 

| Rota |Método| Usuário precisa estar autenticado  | Requer Parametros no Body  |       Descrição     | 
| ------------------- | ------------------- | ---------------------  | -------------------------- |  -------------------|
|||Auth|||
|/login| POST  | X | email, password, device_name | Rota para criação de usuário|
|/logout| POST  | ✔ | - | Rota para Leslogar usuário|
|/me| GET  | ✔ |  | Rota ver as informações do usuário|
|||Permissions|||
|/permissions| GET  | ✔ | - | Rota visualizar todas as permissões|
|/permissions| POST  | ✔ | name, description | Rota visualizar todas as permissões|
|/permissions/:id| PUT  | ✔ | name, Description, ID da permissão | Rota para atualiazar as permissões|
|/permissions/:id| DEL  | ✔ | id da permissão | Rota para deletar as permissões|
|/permissions/:id| GET  | ✔ | - | Rota visualizar uma permissão específica através do ID|
|||Profiles|||
|/profiles| GET  | ✔ | - | Rota visualizar todos os perfis|
|/profiles| POST  | ✔ | name, description | Rota visualizar todos os perfis|
|/profiles/:id| PUT  | ✔ | name, Description, ID do perfil | Rota para atualiazar os perfis|
|/profiles/:id| DEL  | ✔ | id da permissão | Rota para deletar as permissões|
|||Profile X Permissions|||
|/profiles/:id/sync-permissions| POST  | ✔ | id do perfil, e array de permissões | Rota para sincronizar permissões com perfis|
|||Profile X Users|||
|/users/:id/sync-profiles| POST  | ✔ | id do usuário, e array de perfis | Rota para sincronizar os usuários  com os perfis|
|||Users|||
|/users| GET  | ✔ | - | Rota visualizar todos os perfis|
|/users| POST  | ✔ | name,email,password | Rota criar usuário|
|/users/:id| PUT  | ✔ | name, password, ID do usuário | Rota para atualiazar o usuário|
|/users/:id| DEL  | ✔ | id do usuário | Rota para deletar o usuário|