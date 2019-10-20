set -eux;
cd /var/www/html/app-tu-van-tam-ly-phap-ly;
git pull;
php artisan migrate;
composer install;
