
## About The Project

  

This project is basically a customer service API application built using PHP 8.4, Laravel 12, MySQL. This project contains backend API endpoints like admin/customer authentication including both login and registration, creating service, booking a specific service etc.

  

## Tech Stack used for this project

  

1. PHP 8.4.5

2. MySQL 8.4.5

3. phpMyadmin 5.2

4. Laravel 12.x

5. PHP Unit for feature testing

6. REST API using SOLID Design Pattern

7. Ubuntu 25.04 LTS as OS

8. Postman for API testing and documentation

  

## Necessary Softwares to Download

  

Since I am a Ubuntu OS user, I used Ubuntu 25.04 LTS for development. You can use windows if you want. But apart from that, a few kinds of softwares need to be installed and running into your system.

  

For Linux we need to install and configure **PHP >= 8.3**, **MySQL 8.4**, **PhpMyAdmin 5.2** and [Composer](https://getcomposer.org/download/) for PHP package management in your local system as well.After installation, you can check it by `composer --version`, `php --version`, `mysql --version` commands.

**You can download XAMPP for Windows from [apachefriends.org](https://www.apachefriends.org/) and install. This way you can install both PHP , MySQL and PHPMyAdmin. Make sure you start the apache, mysql, phpmyadmin by opening the xampp application**

After the successful installation and configuration of all the softwares, you are good to go.  

## How to get the project live 

To get the application up and running you need to follow couple of steps. Lets go with the steps one by one  

### STEP #1: Clone the github repository and installing dependencies  

First you need to clone the Github repository from the link given below 

`git clone https://github.com/tanvirasifkhan/laravel-service-booking-app.git`  

and `cd /laravel-service-booking-app` . Then  `touch .env` and `cp .env.example .env` (You can manually create .env file and copy .env.example content to .env file)

***Configure database credentials***

Now its time to configure backend `.env` file. Configure your database credentials according to your database name, username, password. 

```

DB_CONNECTION=mysql

DB_HOST=127.0.0.1

DB_PORT=3306

DB_DATABASE=service_booking_app

DB_USERNAME=root

DB_PASSWORD=

```

**Than run the following commands**

  `composer install`

 `php artisan key:generate`
  

### STEP #2: Running The Application  

Now access your `phpMyadmin` panel inside your browser on port `localhost/phpmyadmin` and create a database called `service_booking_app`. By the way you can create database with any name. You just need to configure your `.env` accordingly. Now guess what, you are good to access the whole application in the browser.  

**Follow the commands**

 Run `php artisan migrate` to run the database migration and then run `php artisan optimize:clear` to clear all the cache. Finally run `php artisan serve` command to run the server at `localhost:8000`.

Run this command `php artisan db:seed`. There will be an admin created with the following credentials.
  * Email : admin@gmail.com and Password: admin

and there will be 2 bookings, 5 services created.There will also 2 customers be created with the following credentials
  * Email : asif@gmail.com and Password: asifkhan
  * Email: tanvir@gmail.com and Password: tanvir
  
You can login using as admin/customer to perform respective API tasks.

### Features including permission

Some of the endpoints require admin specific bearer token, like service crud, all booking list and some of them require customer specific bearer token, like booking a service, authenticated customer specific booking list etc. You can run `php artisan route:list` to view all the routes available in this application.

You can now play around with the application.  

Hope, all the API endpoints run smoothly. Enjoy and thanks. If you have any query, then send an email to `asifkhan.github@gmail.com`. Thanks