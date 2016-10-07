# hair-salon-php

#### An application for a hair salon that helps with the management of stylists and their clients. 10.06.2016

#### By [Lisa MacCarrigan](https://github.com/lisamaccarrigan)

![screenshot of project main page](web-app.png)

## Description

This is a web application that allows a hair salon owner to add stylists and for each stylist, add a list of clients. This demonstrates a one-to-many relationship.

## Specifications:
| _Behavior_ | _Input_ | _Output_ |
|:---------------------------------------------------------------------:|:---------------------------------------------------------------------------:|:-------------------------------------------------------------------------------------------------------------------:|
| Add/Save New Stylist | Enter Name: Kyle Krieger | Stylists: Kyle Krieger |
| Get/View All Stylists | n/a | list of stylists |
| Delete All Stylists | select 'Delete All' | There are currently no stylists |
| Update/Edit Stylist | Kyle Krieger Hair | Kyle Krieger Hair |
| Delete Stylist | select 'Delete' | There are currently no stylists |
| View All Clients For Given Stylist | select Stylists: Kyle Krieger | Clients: Ali Krieger |
| Add/Save New Client | Enter Name: Ali Krieger | Clients: Ali Krieger |
| Get/View All Clients | n/a | list of clients |
| Delete All Clients | select 'Delete All' | There are currently no clients |
| Update/Edit Client | Ali Krieger!! | Ali Krieger!! |

## Setup/Installation Requirements

If editing:
* Clone this repository: https://github.com/LisaMacCarrigan/hair-salon-php.git
* OPEN project folder ('hair-salon-php') in Code Editor of choice

SQL Commands:
* mysql> CREATE DATABASE hair_salon;
* mysql> USE hair_salon;
* mysql> SHOW DATABASES;
* CREATE TABLE stylists (id serial PRIMARY KEY, name varchar (255));
mysql> SHOW TABLES;
* mysql> CREATE TABLE clients (id serial PRIMARY KEY, name varchar (255), stylist_id int);
mysql> DESCRIBE client;

* Install and Configure PHP development environment - Please visit http://goo.gl/JDBJ0p for easy-to-follow instructions by Epicodus. In general, you will need to:
    * Download and Install 'MAMP' by visiting: https://www.mamp.info/en/downloads/.
    * Download and Install PHP package manager called 'Composer'
    * Inside of Terminal window, from the top level of your project folder, RUN the install command: > composer install
    * Inside of Terminal window, within the project's "web" folder, RUN the command: > php -S localhost:8000. Then, in a web browser, visit: http://localhost:8000/

## Known Bugs

No known bugs.

## Support and contact details

For comments or questions, please email Lisa.MacCarrigan@gmail.com

## Technologies Used

* HTML
* PHP
* MAMP Version 3.5.2
* MySQL Server
* phpMyAdmin Version 4.4.10
* Silex (PHP micro-framework)
* Twig (PHP template engine)
* Bootstrap CDN

### License

*This application is licensed under the MIT license*

Copyright (c) 2016 [Lisa MacCarrigan](https://github.com/lisamaccarrigan)
