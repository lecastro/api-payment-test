# Sobre

Aplicação Teste Técnico.

# Conteúdo da Imagem Docker

- <b>PHP</b>, e diversas extensões e Libs do PHP, incluindo php-redis, pgsql, mysql, entre outras.

- <b>Nginx</b>, como proxy reverso/servidor. Por fim de testes é que o Nginx está presente nesta imagem, em um momento de otimização está imagem deixará de ter o Nginx.

- <b>Supervisor</b>, indispensal para executarmos a aplicação PHP e permitir por exemplo a execução de filas e jobs.

- <b>Composer</b>, afinal de contas é preciso baixar as dependências mais atuais toda vez que fomos crontruir uma imagem Docker.

# Passo a Passo

## Certifique-se de estar com o Docker em execução.

```sh
docker ps
```

## Certifique-se de ter o Docker Compose instalado.

```sh
docker compose version
```

## Contruir a imagem Docker, execute:

```sh
docker compose build
```

## Caso não queira utilizar o cache da imagem presente no seu ambiente Docker, então execute:

```sh
docker compose build --no-cache
```

## Para subir a aplicação, execute:

```sh
docker compose up
```

- Para rodar o ambiente sem precisar manter o terminar aberto, execute:

```sh
docker compose up -d
```

## Para derrubar a aplicação, execute:

```sh
docker compose down
```

## Para entrar dentro do Container da Aplicação, execute:

```sh
docker exec -it web bash
```

# Solução de Problemas

## Problema de permissão

- Quando for criado novos arquivos, ou quando for a primeira inicialização do container com a aplicação, pode então haver um erro de permissão de acesso as pastas, neste caso, entre dentro do container da aplicação e execeute.

```sh
cd /var/www && \
chown -R www-data:www-data * && \
chmod -R o+w app
```

## Configurando o projeto

Entre na pasta app faça uma cópia do arquivo `.env.example` para `.env`

```
cp .env.example .env
```

### Instalar dependências
```
docker compose exec -it web composer install
```

### Gerar key um (Opcional)

```
docker compose exec -it web php artisan key:generate
```

### Gerar key um (Opcional)

```
docker compose exec -it web php artisan passport:install
```

### Migrar database
```
docker compose exec -it web php artisan migrate
```

### instalação passport
```
docker compose exec -it web php artisan passport:install
```

### instalação passport
```
docker compose exec -it web php artisan test
```

### endpoint Registrar um novo usuário

#### localhost/api/register
```
{
	"name": "de123v",
	"email": "dessqqw1d2w34@teste.com",
	"password": "123456789",
	"document": "819.143.160-29",
	"type": "customer"
}

```

response
```
{
	"id": "c9c647df-0fd6-4519-9125-48515a5e00b4",
	"name": "de123v",
	"email": "dessqqw1d2w34@teste.com",
	"document": "819.143.160-29",
	"password": "$2y$12$2m2n6cIenZGttZZD6pDGrefuhvb4kmGHCLmy4SD4Wwkh1RsEp.rlO",
	"type": "customer",
	"createdAt": "2024-05-13 09:14:34"
}
```

### endpoint depositar saldo

#### localhost/api/deposit
```
{
	"walletId": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
	"amount": 100.00,
}

```

response
```
{
	"walletId": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
	"amount": 100.00,
}
```

#### localhost/api/transfer

### endpoint depositar transferência

```
{
  "value": 100.0,
  "payerId": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
  "payeeId": "c9c647df-0fd6-4519-9125-48515a5e00b4"
}

```

response
```
{
	"id": "87468751-857e-4c45-bb10-e7713dbedaf1",
	"value": "100",
	"payer": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
	"payee": "c9c647df-0fd6-4519-9125-48515a5e00b4",
	"status": "completed",
	"createdAt": "2024-05-13 09:43:25"
}
