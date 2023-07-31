# Teste para empresa [Grupo Plan Marketing](https://planmkt.com.br)

[![CI](https://github.com/leandro-mnc/planmkt-teste/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/leandro-mnc/planmkt-teste/actions/workflows/ci.yml)

### Extensões necessárias

* [Docker](https://docs.docker.com/engine/install/)
* Docker Compose

### Configuração da aplicação

Faça uma cópia do arquivo **.env.example** para **.env**, que se encontra na raíz do projeto.

Inicie os containers:

```
docker-compose up -d
```

É necessário gerar a APP_KEY. Execute o comando abaixo na raiz do projeto:

```
docker-compose exec server php artisan key:generate
```

Instale as dependências do projeto, executando o comando abaixo na raiz do projeto.

```
docker-compose exec server composer install
```

Instalar as dependências npm:

```
docker-compose exec server npm install
```

Execute as migrations:

```
docker-compose exec server php artisan migrate --seed
```

Inicie o servidor vite:

```
docker-compose exec server npm run dev
```

Pronto, o projeto estará disponível no endereço [http://127.0.0.1](http://127.0.0.1).

### Tests

Para rodar os testes, execute o comando abaixo:

```
docker-compose exec server php artisan test
```