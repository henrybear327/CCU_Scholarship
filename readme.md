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
1. make a `.env` file
2. generate an app key (`php artisan key:generate`)
3. run `composer install`
4. setup database credentials
5. run migration

# System notes

* 10/21/2016
    * `.env` file on server is set to production mode, and debug mode off
    * 404 Page added
    * Google Analytics script added
    * mod_rewrite and virtual host is set up properly

# Laravel License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
