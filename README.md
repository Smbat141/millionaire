<p align="center">
    <img src="https://steamcdn-a.akamaihd.net/steam/apps/1356240/capsule_616x353.jpg?t=1604589055" width="400">
</p>


# Millionaire
This project runs with Laravel version 8.12, PHP version 7.3* and MySql version 8.0.22

## Install
### Steps

Install dependencies
```
    composer install
```

Setup environment
```
    customize your environment (create .env file and set Database credentials)
```

Generate app key
```
    php artisan key:generate
```

Migrate db tables
```
    php artisan migrate
```

Create users(admin and user)

```
    passwords for both users (1-9) numbers

    php artisan db:seed
```
Run server
```
    php artisan serve
```
