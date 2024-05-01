<p align="center"><a href="https://bluepundit.eu" target="_blank"><img src="https://bluepundit.eu/img/bluepundit-logo-pundit.png?1" width="100"></a></p>

# hsdemo project 
Example project for the BKK class

## Authors
- [bluePundit](https://bluepundit.eu) - Nico Deblauwe ([@ndeblauw](https://www.github.com/ndeblauw))

## Requirements
This project uses
- [Laravel 11](https://laravel.com/docs/11.x/releases)

## Environment Variables
Nothing but the normal ones

## Dev Installation instructions 
- create a directory for the project 
- clone the project into this directoy
- run `composer install`
- create a configuration .env file: `cp .env.example .env`
- you need to set a key in the .env: `php artisan key:generate`
- if using sqlite: do execute `touch database/database.sqlite`
- and then migrate the tables: `php artisan migrate` 
- and then seed date: `php artisan db:seed`.
