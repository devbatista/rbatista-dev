# rbatista-dev

Repositório com o projeto **rbatista-dev**, desenvolvido com Laravel para currículo web.

## Tecnologias Utilizadas

- Backend: Laravel (PHP)
- Banco de Dados: [inserir banco, ex: MySQL, PostgreSQL]
- Gerenciamento de dependências: Composer, NPM (se aplicável)
- [Outras tecnologias ou ferramentas relevantes]

## Instalação

### Pré-requisitos

- PHP >= 8.0
- Composer
- [Node.js e NPM, se houver frontend com assets a compilar]
- Banco de dados configurado (MySQL, PostgreSQL, etc.)

### Passos para instalação

```bash
# Clone o repositório
git clone https://github.com/devbatista/rbatista-dev.git
cd rbatista-dev

# Instale as dependências PHP
composer install

# Copie o arquivo de ambiente
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Configure o banco de dados no arquivo .env

# Execute as migrações do banco
php artisan migrate

# Se usar frontend com assets, instale dependências e compile
npm install
npm run dev

# Inicie o servidor de desenvolvimento
php artisan serve
