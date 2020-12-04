// create database : blog
// You can change .env.example to .env and use it.

1) php artisan migrate
2) php artisan db:seed --class=UserTableSeeder

3) php artisan config:cache
4) php artisan route:cache
5) composer install --optimize-autoloader --no-dev

6) php artisan serve
7) php artisan schedule:run

~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To minimise the strain put on our system during traffic peaks

1) Should use server with high-volumn CPU and RAM or use several normal servers.
2) Should use cache.
3) Should use CDN (for instance, images).
4) Should optimize css and js files (we can use mix).
5) Should use well-optimized query. We can use rare query instead of Eloquent in laravel.
6) Should be familiar with Queue, for instance for sending the emails to lots of clients.