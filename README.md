# 🚀 API-AS

![PHP](https://img.shields.io/badge/PHP-8%2B-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-Framework-FF2D20?logo=laravel&logoColor=white)
![Tests](https://img.shields.io/badge/Tests-Pest-22C55E)
![Architecture](https://img.shields.io/badge/Architecture-Layered%20%7C%20SOLID-blue)
![License](https://img.shields.io/badge/license-MIT-black)
![Status](https://img.shields.io/badge/status-Active%20Development-brightgreen)

API para cadastro de formulários de usuários --- responsável por
receber, validar e salvar formulários no banco de dados, com
autenticação, autorização e **testes automatizados modernos com Pest**.

Projeto focado em **boas práticas de arquitetura, organização de código,
testabilidade e escalabilidade**, simulando um ambiente de produção
real.

------------------------------------------------------------------------

## 🚀 Principais responsabilidades

-   Receber submissões de formulários via endpoints REST
-   Validar dados com Form Requests
-   Persistir dados em banco relacional (Eloquent + migrations)
-   Autenticação baseada em tokens
-   Autorização com Policies/Gates
-   Testes automatizados (unitários e integração)
-   Estrutura preparada para crescimento e manutenção

------------------------------------------------------------------------

## 🧰 Stack principal

-   PHP 8+
-   Laravel
-   MySQL / MariaDB / SQLite
-   Pest (testes)
-   Eloquent ORM

------------------------------------------------------------------------

## 📁 Estrutura relevante

-   Código da API: `app/Http/Controllers`
-   Models: `app/Models`
-   Requests (validação): `app/Http/Requests`
-   Rotas API: `routes/api.php`
-   Testes: `tests`

------------------------------------------------------------------------

## 📋 Requisitos

-   PHP \>= 8.0
-   Composer
-   Banco de dados (MySQL / MariaDB / SQLite)

------------------------------------------------------------------------

## ⚙️ Instalação rápida

### 1. Instale dependências

``` bash
composer install
```

### 2. Configure ambiente

``` bash
cp .env.example .env
php artisan key:generate
```

### 3. Configure banco no `.env`

    DB_CONNECTION=
    DB_DATABASE=
    DB_USERNAME=
    DB_PASSWORD=

### 4. Rode migrations

``` bash
php artisan migrate
```

### 5. (Opcional) Seeders

``` bash
php artisan db:seed
```

------------------------------------------------------------------------

## 🔐 Autenticação

Autenticação baseada em **API Tokens com Sanctum**.

Fluxo:

1.  Login → `POST /api/auth/login`
2.  Recebe token
3.  Envia token:

```bash
Authorization: Bearer <token>
```

------------------------------------------------------------------------

## 🛡️ Autorização

Controle de acesso com:

-   Policies
-   Gates

Exemplo:

-   `FormPolicy`
-   Registro no `AuthServiceProvider`

Garante que cada usuário acesse apenas seus próprios formulários.

------------------------------------------------------------------------

## 🌐 Endpoints

  Método   Endpoint          Descrição
  -------- ----------------- -------------------------------
  POST     /api/forms        Criar formulário
  GET      /api/forms        Listar formulários do usuário
  GET      /api/forms/{id}   Visualizar formulário
  PUT      /api/forms/{id}   Atualizar
  DELETE   /api/forms/{id}   Excluir

------------------------------------------------------------------------

# 🧪 Testes automatizados (Pest)

O projeto utiliza **Pest**, uma alternativa moderna ao PHPUnit com
sintaxe mais expressiva e legível.

### Rodar testes

``` bash
./vendor/bin/pest
```

### Boas práticas adotadas

-   Testes de unidade → regras de negócio
-   Testes de integração/HTTP → endpoints
-   `RefreshDatabase`
-   Factories
-   Banco SQLite in-memory

Benefícios:

-   Feedback rápido
-   Código mais seguro
-   Facilidade de manutenção
-   Cobertura de fluxos críticos da API

------------------------------------------------------------------------

# 🧱 Arquitetura em Camadas (Layered Architecture)

Este projeto possui uma **feature branch demonstrando arquitetura em
camadas**, separando responsabilidades de forma clara e escalável:

👉
https://github.com/luk-z0/api-as/tree/feature/layered-archtecture-example

### Organização

    Controllers  → entrada HTTP
    Services     → regras de negócio
    Repositories → acesso a dados
    Models       → entidades

### Objetivos

-   Baixo acoplamento
-   Alta coesão
-   Facilidade de testes
-   Código mais limpo
-   Manutenção simplificada
-   Pronto para crescer sem virar "monolito bagunçado"

Padrões aplicados:

-   Clean Architecture
-   SOLID
-   Service Layer
-   Repository Pattern

------------------------------------------------------------------------

## ▶️ Executando localmente

``` bash
php artisan serve
```

Disponível em:

    http://127.0.0.1:8000

------------------------------------------------------------------------

## 🤝 Contribuição

-   Abra issues para melhorias
-   Pull requests com testes
-   Código limpo e padronizado

------------------------------------------------------------------------

## 🗺️ Próximos passos

-   Documentação OpenAPI/Swagger
-   Cobertura de testes 100%
-   CI (GitHub Actions)
-   Rate limiting
-   Logs estruturados
-   Cache

------------------------------------------------------------------------

## 📄 Licença

MIT
