# Simple ERP

Simple ERP - Utilising Laravel and AdminLTE

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

You will need to have below installed on your machine
```
npm
composer
```

### Installing

Please follow the below instructions to get a copy up and running

```
Run 'cp .env.example .env'
Prepeare your .env - Edit and set mysql host, database and password etc
Run - 'composer install' - This will install all your composer dependencies
Run 'php artisan migrate --seed' - This will seed the sample database, especially important for creating the first admin for you to log in
Run 'php artisan key:generate' to generate app_key
Run 'npm install' to install all npm dependencies
Run 'npm run dev' to prepare build
Run 'php artisan serve' to serve the application

Thats all folks!

Now you can visit 'http://127.0.0.1:8000' or 'http://localhost:8000'

Login with these credentials

Username: admin@admin.com
Password: password

```

## Running the tests
```
Run 'vendor/bin/phpunit' to execute tests
```
If you have phpunit installed globally, then running 'phpunit' will also execute the tests

## Built With

* [Laravel](https://laravel.com/) - The PHP Framework For Web Artisans
* [AdminLTE](https://adminlte.io/) - Free Bootstrap Admin Template
* [Bootstrap](https://getbootstrap.com/) - Very popular HTMl, CSS and JS Library


## Author

* **Mehmet Enis** - [Linked In](https://www.linkedin.com/in/mehmetenis)

## License

This project is licensed under the MIT License - see the [LICENSE](https://opensource.org/licenses/MIT) page for details

## Acknowledgments

* Hat tip to anyone whose code was used
