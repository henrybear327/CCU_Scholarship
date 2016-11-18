# CCU Scholarship Application System

Using `Laravel 5.3`, minimal requirements:

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

# Workflow

The only way for adding features and code into the master branch is by pull requests! No direct commit on master branch is allowed, because master branch is suppose to be the always-ready demo product branch.

Here are some instructions that you can follow after cloning the repository locally:

1. `chmod -R 777 storage && chmod -R bootstrap/cache`
    * We are currently using SQLite as DB backend. So run `touch database/database.sqlite` at project root , and make sure the folder that the database file is residing in [also has write permission](http://stackoverflow.com/questions/3319112/sqlite-read-only-database).
2. make a `.env` file
    * update `APP_URL`
    * use `DB_CONNECTION=sqlite`
    * setup mail server credentials, and add two new fields `MAIL_ADDRESS` and `MAIL_NAME`
3. generate an app key (`php artisan key:generate`)
4. run `composer install`
5. run `php artisan migrate`
6. setup [ide helper](https://github.com/barryvdh/laravel-ide-helper) if you are using phpstorm. [Reference](http://oomusou.io/phpstorm/phpstorm-ide-helper/)
    * `composer require --dev barryvdh/laravel-ide-helper`
    * After updating composer, add the service provider to the providers array in `config/app.php`, `Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class`
7. run `php artisan ide-helper:generate` and `php artisan ide-helper:meta`

# System notes

* 10/21/2016
    * `.env` file on production server is set to production mode, and debug mode off
    * 404 Page added
    * Google Analytics script added
    * mod_rewrite and virtual host is set up properly
* 11/11/2016
    * [Install sqlite on server](https://laracasts.com/discuss/channels/laravel/connecting-laravel-to-sqlite-in-laravel-52) `sudo apt-get install sqlite3 libsqlite3-dev php7.0-sqlite3`
* 11/12/2016
    * Add [sendgrid](https://sendgrid.com/docs/Integrate/Frameworks/laravel.html) for forget password!
      * `composer require guzzlehttp/guzzle`
    * Allow updating columns in DB
      * `composer require doctrine/dbal`
    * Set timezone to `Asia/Taipei`
* 11/18/2016
    * Tweak `app/mail.php` to get data from `.env`

# Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
