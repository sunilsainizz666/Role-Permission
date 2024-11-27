# Laravel Role Permission Management System - Laravel `11.x`

A project which manage Role, Permissions and every actions of your Laravel application. A complete solution for Role based Access Control in Laravel.

**Demo:** http://localhost:8000/users

## Project Setup
Git clone -
```console
git clone https://github.com/sunilsainizz666/Role-Permission.git
```

Go to project folder -
```console
cd Role-Permission
```

Install Laravel Dependencies -
```console
composer install
```

Create database called - `Role-Permission`

Create `.env` file by copying `.env.example` file

Generate Artisan Key (If needed) -
```console
php artisan key:generate
```

Migrate Database with seeder -
```console
php artisan migrate --seed
```

Link the Storage folder-
```console
php artisan Storage:link
```

Run Project -
```php
php artisan serve
```