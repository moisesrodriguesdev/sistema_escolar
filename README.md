### Teste técnico para vaga Backend Developer - PC4

### Ambiente

-   PHP 7.4
-   MySQL 8

### API

-   HTTP Rest
-   Laravel 8

### Web

-  Blade Template
-  HTML
-  CSS
-  Jquery

# Instalação local - Windows 🚀🚀

**Você precisa ter o PHP na versão 7.4 e Composer instalado para iniciar o servidor. Após configuração do ambiente, siga os passos abaixo:**

Clonando o projeto

```
git clone https://github.com/moisesrodriguesdev/sistema_escolar.git
```

Entrar o diretório

```
cd sistema_escolar
```

Instale as dependências

```
composer install
```

Configurar os parametros no arquivo .env (banco, token) https://laravel.com/docs/7.x#configuration

```
cp .env.example .env
```

Gerar Application Keys

```
php artisan key:generate
```

# Execução 🚀🚀

**Crie o banco no servidor MySQL, em seguida execute este comando:**

Rode as migrations
```
php artisan migrate:fresh
```

Rode as seeds
```
php artisan db:seed
```

Incie o servidor de desenvolvimento
```
php artisan serve
```

Para executar os testes, execute os passos abaixo:
 * Habilite a extensão SQLite nas configurações do PHP 
 * Crie o arquivo database.sqlite dentro do diretório /database
 * Execute a suite de testes através do comando ```php artisan test```
