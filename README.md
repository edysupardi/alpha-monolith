## Running Application via docker

To running this application from docker, just run this code in the terminal `./vendor/bin/sail up` and don't forget to install the dependencies via composer with code `./vendor/bin/sail composer update`.

You can open that application from localhost with port 8001 or check APP_PORT in the .env file.To running PHP script, you can use code like this `./vendor/bin/sail php -v` or `./vendor/bin/sail php artisan queue:work`.

For more information about sail, you can read this [documentation](https://laravel.com/docs/9.x/sail)

sail alias you can use this code `alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'` and use can use sail as this `sail php -v`

To runnning composer when after first clonning this project, you can use this code `docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/opt -w /opt laravelsail/php81-composer:latest composer install --ignore-platform-reqs` or you u can visit this link for [detail](https://laravel.com/docs/9.x/sail#installing-composer-dependencies-for-existing-projects)

if you have error to connect to mysql like "access denied for user@hostname", just run this code `./vendor/bin/sail down --rmi all -v` to remove all images and volume and then just rerun `sail up`
