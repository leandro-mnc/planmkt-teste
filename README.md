# Teste Plan Mkt

### Extensões necessárias

* [Docker](https://docs.docker.com/engine/install/)
* Docker Compose
* [Composer](https://getcomposer.org/download/)
* PHP

### Configuração da aplicação

Primeiro passo é instalar as dependências do projeto, execute o comando abaixo na raiz do projeto.

```
composer install
```

Caso você não tenha o composer em sua máquina, pode ser instalado via imagem do composer.

```
docker run --rm -v $(pwd):/app -w /app composer composer install
# Para quem é do ambiente unix, pode ser executado com as permissões do seu usuário local
docker run --rm -v $(pwd):/app -w /app --user $(id -u):$(id -g) composer composer install
```

Segundo passo é instalar as dependências npm:

```
docker exec planmkt-server npm install
```

Terceiro passo é fazer uma cópia do arquivo **.env.example** para **.env**, que se encontra na raíz do projeto.

Feito a cópia do arquivo .env, é necessário gerar a APP_KEY. Execute o comando abaixo na raiz do projeto:

```
php artisan key:generate
```

Caso você não tenha o PHP 8.2 instalado em sua máquina, gere direto da imagem do PHP.
```
docker run --rm -v $(pwd):/var/www/html -w /var/www/html php:8.2-cli php artisan key:generate
```

Quarto passo é executar o docker-compose:

```
docker-compose up -d
docker-compose logs --follow
```

Quinto passo é executar as migrations:

```
docker exec planmkt-server php artisan migrate --seed
```

Sexto passo é iniciar o servidor vite:

```
docker exec planmkt-server npm run dev
```

Pronto, o projeto estará disponível no endereço [http://127.0.0.1](http://127.0.0.1).

### Tests

Para rodar os testes, execute o comando abaixo:

```
php artisan test
# ou
docker exec planmkt-server php artisan test
```