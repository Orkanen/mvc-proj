[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Orkanen/mvc-proj/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/Orkanen/mvc-proj/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/Orkanen/mvc-proj/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/Orkanen/mvc-proj/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/Orkanen/mvc-proj/badges/build.png?b=main)](https://scrutinizer-ci.com/g/Orkanen/mvc-proj/build-status/main)
[![Build Status](https://travis-ci.org/Orkanen/mvc-proj.svg?branch=main)](https://travis-ci.org/Orkanen/mvc-proj)

This is my project for course MVC @BTH.
In this project I am using Laravels framework to create a website
for playing 21 and creating bets.

Php artisan migrate will generate your database in sqlite.
In order for the website to function do:
php artisan route:cache
php -S localhost:8080 -t app/public

Now in order to have the website work you will also need to generate
a table in the database.
You can do this by simply going to /bet/create
This will give you an empty page but in the background it will fill your
database table with values.
