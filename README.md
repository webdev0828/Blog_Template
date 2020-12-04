// create database : blog
// You can change .env.example to .env and use it.

1) php artisan migrate
2) php artisan db:seed --class=UserTableSeeder

3) php artisan config:cache
4) php artisan route:cache
5) composer install --optimize-autoloader --no-dev

6) php artisan serve
7) php artisan schedule:run