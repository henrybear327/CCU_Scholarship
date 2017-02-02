# CCU Scholarship Application System

國立中正大學軟體工程課程作業。課程已經結束，有興趣 維護 或 開發者 歡迎對此專案進行fork或是pull request。

## Requirement 

This project uses `Laravel 5.3`. The minimal requirements are:

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension

## Work to be done

* Send out email notification to applicants after registration and the release of the review result
* Implement language center review interface
* Add edit, rejection, etc. functionality for reviewer
* Use pagination for lists to eliminate scrolling
* Implement cap check for reviewer
* Implement change profile data, such as change password
* Auto apply for scholarship for all freshmen
* Export data in excel file format
* Fix UI and JS bug (Use bootstrap CDN)
* Implement basic checks, such as date settings must be set in increasing order, etc.

## Collaboration Workflow

The only way for adding features and code into the master branch is by pull requests! No direct commit on master branch is allowed, because master branch is suppose to be the always-ready demo product branch.

## Instruction for installing the project

1. `chmod -R 777 storage && chmod -R 777 bootstrap/cache`
    * SQLite will be a perfect DB if you don't want install MariaDB at first. Run `touch database/database.sqlite` at project root , and make sure the folder that the database file is residing in [also has write permission](http://stackoverflow.com/questions/3319112/sqlite-read-only-database).
2. run `composer install`
3. make a `.env` file by copying `.env.example`
   * update `APP_URL`
   * use `DB_CONNECTION=sqlite`
   * add `#` before `DB_DATABASE=homestead`
   * setup mail server credentials, and add two new fields `MAIL_ADDRESS` and `MAIL_NAME` (optional for local testing)
4. generate an app key (`php artisan key:generate`)
5. run `php artisan migrate`
6. setup [ide helper](https://github.com/barryvdh/laravel-ide-helper) if you are using phpstorm. [Reference](http://oomusou.io/phpstorm/phpstorm-ide-helper/)
    * `composer require --dev barryvdh/laravel-ide-helper`
    * After updating composer, add the service provider to the providers array in `config/app.php`, `Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class`
7. run `php artisan ide-helper:generate` and `php artisan ide-helper:meta`
8. run `php artisan storage:link`

## Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


## Install on Mac

* Run in terminal to install composer
```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'aa96f26c2b67226a324c27919f1eb05f21c248b987e6195cad9690d5c1ff713d53020a02ac8c217dbf90a7eacc9d141d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
mv composer.phar /usr/local/bin/composer
```
* Use homebrew to install php7
   `brew install homebrew/php/php70`
* Install valet
   1. `composer global require laravel/valet`
   2. Create `.bashrc` and add `export PATH=$PATH:$HOME/.composer/vendor/bin`
   3. `source ~/.bashrc`
   4. `valet install`
   5. For more instructions, read [Serving Sites](https://laravel.com/docs/5.3/valet#serving-sites)

## System notes

This section is not being maintained anymore. 

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
* 11/20/2016
    * Populate database tables with some data after migration
