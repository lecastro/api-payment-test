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

### Migrar database
```
docker compose exec -it web php artisan migrate
```

### instalação passport
```
docker compose exec -it web php artisan passport:install
```