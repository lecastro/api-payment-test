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
docker compose exec -it web php artisan test
```

![Alt text](2.png)

### executando php codesniffer
```
docker compose exec -it web composer psr
```
![Alt text](1.png)

### Endpoint registrar um novo usuário

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

Response:
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


### Endpoint autenticar usuário

#### localhost/api/login
```
{
	"email": "dessqqw1d2w34@teste.com",
	"password": "123456789"
}

```

Response:
```
{
	"status": "success",
	"message": "User is logged in successfully.",
	"token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5YzA5MDY2ZS1iZjg1LTQwZDktYThhNy01NmE2MWNmYmNjZTIiLCJqdGkiOiI1MzU4NjU3OTY4ZDY1ZDNkYTRhMzhmOTU3ZTg0OWJkMTVjZDBlM2JhNTk0NmExNzFhMzVmMGM2YmI2ZGZlZTEwYmIxODVjNTQ0Mzk4MDAzOCIsImlhdCI6MTcxNTYyNzM3MS44MjE3MDksIm5iZiI6MTcxNTYyNzM3MS44MjE3MTEsImV4cCI6MTc0NzE2MzM3MS43NzgyOTIsInN1YiI6ImVjNjVlMGNhLWEyZjUtNDY5YS05YWYxLTU3NjFhZjYwODExMCIsInNjb3BlcyI6W119.Hd3yJ803HJuN38V_YLczwl-7ArLSeCkln3qfnDcyeTLg88z7YnnhkQ6TXjVUB2biCozAfHX48y10HuiWCsNOvvku-pLPDndqpZV7zMergBBzQn7HkWefMwWG7TY1Y6nru9KUZ1e22tW6SY4gafZK4Q0aEJdLSWQ1tBRyGv6sD_yqxR8xX-GDRmQmT8-6IFmYGIbCWmRtOsxVQCuSkAOwUsuCkjg1XdO7pArtwX_wG5O3WGU6UBW8cTBvhTnxGkqbwNgWE57h4LNfcvPZXRSsNZavlrRb76ORfPbwiSkEkYO3Jyy_s3-j3lGgX2f1bR-325WiDS9ERWFVzq07FPSOb9D2mwk6SotCxAyJd99ovJOXtgdrC44eKpx2W-oZbrsLeAH3pZIXMHBoRaBNBN7Rop_XmHdBX-CBW8c1I0fZ4KxOA7dNQuDwdVO4FnPAfjaC20t7GecNXLQPy5NU_ZwW3mj55p3LXP-nF4DuwSaKG2YMhvMYChcOeDoKYrlrF70-LhN2F8a_Sf1pgBsRGh9BYV6j--n4RyXSQ-MWNBGc-kkN0p_YOPFMKULVmdIty8E4cv3VEO0BCnnskIh1Ydji2asAY8bInkMISyT6Y299OxxF1yWxuSFcawfddh0d3ovx3TaYjaBKHRrXNbGpTciGD2m7-7CzbiRco8IZthV27gc"
}
```

### Endpoint logout usuário

#### localhost/api/logout

reponse
```
{
	"status": "success",
	"message": "User is logged out successfully"
}
```

### Endpoint depositar saldo

#### localhost/api/deposit
```
{
	"walletId": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
	"amount": 100.00,
}

```

Response:
```
{
	"walletId": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
	"amount": 100.00,
}
```

#### localhost/api/transfer

### Endpoint transferência

```
{
  "value": 100.0,
  "payerId": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
  "payeeId": "c9c647df-0fd6-4519-9125-48515a5e00b4"
}

```

Response:
```
{
	"id": "87468751-857e-4c45-bb10-e7713dbedaf1",
	"value": "100",
	"payer": "5e164b9c-09a9-4f6c-bffa-45e7b897c1ec",
	"payee": "c9c647df-0fd6-4519-9125-48515a5e00b4",
	"status": "completed",
	"createdAt": "2024-05-13 09:43:25"
}
