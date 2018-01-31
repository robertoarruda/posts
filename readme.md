# SBTEST

## Instalação

`git clone git@github.com:robertoarruda/sbtest.git`

Entre no diretório do projeto `cd sbtest`

Levante o docker do projeto `docker-compose up -d`

Entre no container `docker exec -it php.docker bash`

Execute o composer `composer install`

Setar permissão no dir storage `chmod -R 777 storage`

Copiar o .env `cp .env.example .env`

Gerar a chave do projeto `php artisan key:generate`

Execute o migrate `php artisan migrate`

Rode os testes unitários `vendor/bin/phpunit`

Instale o passport `php artisan passport:install`

Copie o `Client secret` do `Passport grant client`

Cadastre um usuário
```
curl --request POST \
  --url http://localhost/api/user \
  --header 'content-type: application/json' \
  --data '{
      "name": <nome>,
      "email": <email>,
      "password": <senha>
}'
```

Resgate o access token
```
curl --request POST \
  --url http://localhost/oauth/token \
  --header 'content-type: application/json' \
  --data '{
	"grant_type": "password",
      "client_id": 2,
      "client_secret": <passport-grant-client-secret>,
      "username": <usuario-email>,
      "password": <usuario-senha>,
      "scope": ""
}'
```

Crie seu primeiro post com o seu novo usuário
```
curl --request POST \
  --url http://localhost/api/post \
  --header 'authorization: Bearer <access-token>' \
  --header 'content-type: application/json' \
  --data '{
	    "post": <post>
}'
```

Liste os post na V1
```
curl --request GET \
  --url http://localhost/api/posts
```

Liste os post na V2
```
curl --request GET \
  --url http://localhost/api/posts \
  --header 'accept: application/x.sbtest.v2+json'
```

## APIs públicas
* `POST http://localhost/oauth/token`
* `POST http://localhost/api/user`
* `GET http://localhost/api/posts`
* `GET http://localhost/api/post/<id>`
* `POST http://localhost/api/posts`


## APIs privadas
* `PUT http://localhost/api/user`
* `DELETE http://localhost/api/user`
* `POST http://localhost/api/post`
* `PUT http://localhost/api/post/<id>`
* `DELETE http://localhost/api/post/<id>`
