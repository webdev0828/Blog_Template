// create database : blog

php artisan migrate
php artisan db:seed --class=UserTableSeeder

php artisan config:cache
php artisan route:cache
composer install --optimize-autoloader --no-dev