# Ecommerce laravel 8
Uma loja virtual feita com Laravel, Inertia.js e Vue.js.

# Requerimentos
* Node.js v14.*+
* Composer

# Instalação 
```
laravel new project
git clone https://github.com/ilanzgx/ecommerce-laravel.git ou git pull
composer install
npm install
php artisan migrate
```

# Configuração

Mude as chaves do banco de dados
* DB_CONNECTION
* DB_HOST
* DB_PORT
* DB_DATABASE
* DB_USERNAME
* DB_PASSWORD

Abra o arquivo .env e mude as chaves de ``MP_PUBLIC_KEY`` e ``MP_PUBLIC_TOKEN`` para sincronizar a conta de recebimento de pagamentos

E mude as chaves de email também
* MAIL_MAILER
* MAIL_HOST
* MAIL_PORT
* MAIL_USERNAME
* MAIL_PASSWORD
* MAIL_ENCRYPTION
* MAIL_FROM_ADDRESS
* MAIL_FROM_NAME