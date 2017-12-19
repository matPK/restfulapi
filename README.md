# Laravel 5 RESTful API
Good sample of a RESTful API built with Laravel

## Instructions
Download or clone this repository

    git clone https://github.com/matPK/restfulapi.git

In the folder of the project, install the dependencies

    composer update

Copy and rename the ``.env.example`` file to ``.env`` and set into it your database configurations

    DB_CONNECTION=mysql
    DB_HOST=host
    DB_PORT=porta
    DB_DATABASE=banco
    DB_USERNAME=usuário
    DB_PASSWORD=senha

Generate an encryption key for the application

    php artisan key:generate

Migrate the database

    php artisan migrate

Seed the database

    php artisan db:seed

Run local server

    php artisan serve

Access ``http://localhost:8000`` and test it.

## Authorship
Repo by ``Matheus Adorni Dardenne``.
