cp .env.base .env
composer install
php artisan key:generate
php artisan migrate:refresh
chmod -R 777 storage
chmod -R 777 bootstrap/cache
php artisan storage:link
wget https://github.com/homing-job/laravel-spa/files/6542800/seeder_images.zip
unzip seeder_images.zip -d storage/app/public/images
rm -f seeder_images.zip
php artisan jwt:secret

php artisan key:generate --env=testing
php artisan jwt:secret --env=testing
