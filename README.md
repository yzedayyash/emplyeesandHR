## Api for Laravel 8 with Multi-auth (employee and HR)

This base application will be a starting point in creating an api from scratch with multiple authentication - (employee and HR).

Requirements:
- [Laravel 8 requirements](https://laravel.com/docs/8.x/installation)
- [Composer](https://getcomposer.org/download/)

How to install
- Clone this project. `git clone git@github.com:yzedayyash/emplyeesandHR.git`
- Run `composer install`
- Copy .env.example and save as .env on the same directory
- Run `php artisan key:generate`
- [IMPORTANT] Create you local DB and change the database settings in the .env with your database settings
- Run `php artisan migrate --seed` 
- this command will create the database for you with 2 customers 
- 1 -> email: user@user.com password: password
- 2 -> email: hr@hr.com password: password
- Run `php artisan serve` and go to [localhost:8000](http://localhost:8000)
