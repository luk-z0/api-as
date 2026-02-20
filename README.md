API-AS

API para cadastro de formulários de usuários — responsável por receber, validar e salvar formulários no banco de dados, com autenticação, autorização e testes automatizados usando PHPUnit.

**Principais responsabilidades**
- Receber submissões de formulários de usuário via endpoints REST.
- Validar e persistir dados em banco relacional (Eloquent + migrations).
- Autenticação de usuários (API tokens / Sanctum / Passport).
- Autorização por políticas ou gates para proteger recursos.
- Testes unitários e de integração com PHPUnit.

**Stack principal**
- PHP 8+
- Laravel (estrutura do projeto presente neste repositório)
- MySQL / MariaDB ou SQLite (para testes)
- PHPUnit para testes

**Estrutura relevante**
- Código da API: [app/Http/Controllers](app/Http/Controllers)
- Models: [app/Models](app/Models)
- Requests (validação): [app/Http/Requests](app/Http/Requests)
- Rotas API: [routes/api.php](routes/api.php)
- Tests: [tests](tests)

## Requisitos
- PHP >= 8.0
- Composer
- Banco de dados (MySQL / MariaDB / SQLite)

## Instalação rápida
1. Instale dependências:

```bash
composer install
```

2. Copie o arquivo de ambiente e gere a chave:

```bash
cp .env.example .env
php artisan key:generate
```

3. Configure a conexão com o banco em `.env` (ex.: `DB_CONNECTION`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. Rode as migrations:

```bash
php artisan migrate
```

5. (Opcional) Seeders para dados iniciais:

```bash
php artisan db:seed
```

## Autenticação
Este projeto usa autenticação via API tokens (recomendado: Laravel Sanctum). Fluxo básico:
- Usuário realiza login em `POST /api/auth/login` e recebe token.
- Token enviado via header `Authorization: Bearer <token>` nas requisições subsequentes.

Implemente ou verifique em `app/Http/Controllers/Auth` as rotas de login/registro e a configuração em `config/sanctum.php` quando usar Sanctum.

## Autorização
Use Policies (`php artisan make:policy`) ou Gates para controlar quem pode criar, ler, atualizar ou apagar formulários. Exemplo: `FormPolicy` em `app/Policies` e registro em `AuthServiceProvider`.

## Endpoints sugeridos
- `POST /api/forms` — Criar novo formulário (autenticado)
- `GET /api/forms` — Listar formulários do usuário (autenticado)
- `GET /api/forms/{id}` — Obter formulário específico (autorizado)
- `PUT /api/forms/{id}` — Atualizar formulário (autorizado)
- `DELETE /api/forms/{id}` — Excluir formulário (autorizado)

TODO: Detalhar os campos e contratos na documentação da API, usando OpenAPI/Swagger para gerar specs.

## Testes (PHPUnit)
1. Configure um banco de testes (ex.: SQLite in-memory) em `phpunit.xml` ou `.env.testing`.
2. Rodar testes:

```bash
./vendor/bin/phpunit
```

Boas práticas de testes neste projeto:
- Testes de unidade para validações e regras de negócio em `tests/Unit`.
- Testes de integração / HTTP para endpoints em `tests/Feature`, usando `RefreshDatabase` e factories (`database/factories`).

## Executando localmente
```bash
php artisan serve
```

Endpoints ficarão disponíveis em `http://127.0.0.1:8000`.

## Contribuição
- Abra issues descrevendo problemas ou melhorias.
- Para mudanças maiores, abra um pull request com descrição clara e testes cobrindo o comportamento novo.

## Próximos passos
- Scaffold de autenticação (Sanctum) e endpoints de `auth`.
- Implementar `Form` model, migrations e requests de validação.
- Escrever testes de Feature cobrindo fluxos principais (criar, listar, visualizar, atualizar, deletar).
- Adicionar CI para rodar `composer install` e `phpunit` em PRs.

## Licença
Licença MIT.
