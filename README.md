# Laravel 5 RESTful API
Good sample of a RESTful API built with Laravel

## Instructions
Download or clone this repository

    git clone https://github.com/matPK/restfulapi.git

In the folder of the project, install the dependencies

    composer install

Copy and rename the ``.env.example`` file to ``.env`` and set into it your database configurations

    DB_CONNECTION=mysql
    DB_HOST=host
    DB_PORT=port
    DB_DATABASE=database
    DB_USERNAME=username
    DB_PASSWORD=password

Generate an encryption key for the application

    php artisan key:generate

Migrate and seed the database

    php artisan migrate:fresh --seed

Run local server

    php artisan serve

Access ``http://localhost:8000`` and test it.

## Authorship
Repo by ``Matheus Adorni Dardenne``.
