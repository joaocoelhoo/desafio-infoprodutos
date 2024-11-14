# Sistema de Loja de Infoprodutos

Esta é uma API desenvolvida com Laravel 11 para um sistema de loja de infoprodutos.

## Requisitos

- **PHP** >= 8.3
- **Composer** >= 2.7
- **MySQL**

## Instalação

1. **Clone o repositório:**
   ```bash
   git clone git@github.com:joaocoelhoo/desafio-infoprodutos.git
   cd desafio-infoprodutos
   ```

2. **Instale as dependências do PHP com o Composer:**
   ```bash
   composer install
   ```

3. **Configure o arquivo `.env`:**
   - Copie o conteúdo do arquivo `.env.example` para `.env`.
   - Atualize as variáveis de ambiente no `.env` com suas configurações.
   ```bash
   cp .env.example .env
   ```

4. **Gere a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

5. **Gere a chave JWT:**
   ```bash
   php artisan jwt:secret
   ```
   Esse comando irá adicionar `JWT_SECRET` ao seu arquivo `.env`.

6. **Configure o banco de dados:**
   - Crie um banco de dados no MySQL.
   - Configure as credenciais do banco de dados no arquivo `.env`.

7. **Execute as migrações e seeders:**
   ```bash
   php artisan migrate --seed
   ```

## Iniciar o servidor local

Para iniciar o servidor local, execute:

```bash
php artisan serve
```

A API estará acessível em `http://localhost:8000`.


## Documentação da API

Esta API permite gerenciar categorias, itens, compras e usuários em uma loja de infoprodutos. A autenticação é feita com JWT (JSON Web Token).

## Autenticação e Autorização

Para acessar as rotas, é necessário estar autenticado com um token JWT. Utilize as rotas de login e registro para obter o token.

Para rotas de gerenciamento de Roles, Categories, Items e para remover User, é preciso ser um usuário admin.

---

### Autenticação de Usuários

- **POST** `api/login`  
  Autentica um usuário e retorna o token JWT.  
  **Body:** `{ "email": "string", "password": "string" }`

- **POST** `api/logout`  
  Encerra a sessão do usuário autenticado, invalidando o token JWT.

- **POST** `api/register`  
  Cadastra um novo usuário.  
  **Body:** `{ "name": "string", "email": "string", "password": "string" }`

- **GET** `api/user`  
  Retorna os detalhes do usuário autenticado.

---

### Gerenciamento de Categorias

- **GET** `api/categories`  
  Lista todas as categorias de infoprodutos.

- **POST** `api/categories`  
  Cria uma nova categoria.  
  **Body:** `{ "name": "string" }`

- **GET** `api/categories/{id}`  
  Retorna os detalhes de uma categoria específica.

- **PUT** `api/categories/{id}`  
  Atualiza uma categoria específica.  
  **Body:** `{ "name": "string" }`

- **DELETE** `api/categories/{id}`  
  Exclui uma categoria específica.

---

### Gerenciamento de Itens

- **GET** `api/items`  
  Lista todos os itens de infoprodutos, com suporte para filtros por categoria.

- **POST** `api/items`  
  Cria um novo item de infoproduto.  
  **Body:** `{ "name": "string", "description": "string", "price": "decimal", "category_id": "integer" }`

- **GET** `api/items/{id}`  
  Retorna os detalhes de um item específico.

- **PUT** `api/items/{id}`  
  Atualiza um item específico.  
  **Body:** `{ "name": "string", "description": "string", "price": "decimal", "category_id": "integer" }`

- **DELETE** `api/items/{id}`  
  Exclui um item específico.

---

### Gerenciamento de Compras

- **GET** `api/purchases`  
  Lista todas as compras feitas pelo usuário autenticado.

- **POST** `api/purchases`  
  Cria uma nova compra com itens associados.  
  **Body:** `{ "user_id": "integer", "items": [ "integer", "integer", ... ] }`

- **GET** `api/purchases/{id}`  
  Retorna os detalhes de uma compra específica.

---

### Gerenciamento de Usuários e Roles

- **POST** `api/assign-role`  
  Atribui uma role a um usuário.  
  **Body:** `{ "id": "integer", "roleId": "integer" }`

- **GET** `api/users`  
  Lista todos os usuários.

- **PUT** `api/users/{id}`  
  Atualiza as informações de um usuário específico.  
  **Body:** `{ "name": "string", "email": "string", "password": "string" }`

- **DELETE** `api/users/{id}`  
  Exclui um usuário específico.

---

### Gerenciamento de Roles

- **GET** `api/roles`  
  Lista todas as roles disponíveis no sistema.

- **POST** `api/roles`  
  Cria uma nova role.  
  **Body:** `{ "name": "string" }`

- **GET** `api/roles/{id}`  
  Retorna os detalhes de uma role específica.

- **PUT** `api/roles/{id}`  
  Atualiza uma role específica.  
  **Body:** `{ "name": "string" }`

- **DELETE** `api/roles/{id}`  
  Exclui uma role específica.

---

## Observações

- Todas as rotas protegidas por JWT requerem o envio do token no header `Authorization: Bearer {token}`.


## Referências

https://medium.com/@a3rxander/how-to-implement-jwt-authentication-in-laravel-11-26e6d7be5a41
https://dev.to/leanm/laravel-rest-api-with-jwt-authentication-for-login-and-role-based-permissions-2p56
https://medium.com/@sehouli.hamza/building-a-restful-api-with-laravel-11-a-complete-guide-20db5dd41ac1
https://medium.com/@shaillydixit999/restful-apis-with-crud-operations-in-laravel-11-2024-33db3bf88f7e
https://umarfarooquekhan.medium.com/laravel-11-crud-application-example-tutorial-42f0c2d3b13d
https://dev.to/leanm/laravel-rest-api-with-jwt-authentication-for-login-and-role-based-permissions-2p56
https://laracasts.com/discuss/channels/laravel/validation-rule-digits-requires-at-least-1-parameters
https://www.devmedia.com.br/mer-e-der-modelagem-de-bancos-de-dados/14332
https://wpwebinfotech.com/blog/laravel-many-to-many-relationship/
https://medium.com/@joshuaadedoyin2/mastering-role-based-access-control-with-laravel-permissions-6cb2ceafa9c2
https://laracasts.com/discuss/channels/laravel/call-to-undefined-method-appmodelsuserassignrole