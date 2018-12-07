To get started run: git clone https://github.com/grantdwoods/SchoolCashRewards_php

The easiest way to intall the dependancies is with composer: https://getcomposer.org/

Once composer is installed go to the project directory and type: composer require firebase/php-jwt

Under the sql directory are sql text files that can help you import the tables used in this project.
Database credentials can be found in: 
  sp_auth/authDBconn.php
  sp_app/appDBconn.php

If you wish to use test calls to the API I maintain, import the sp_app.postman_collection file into postman. 
The calls assume that the project lives in the main directory of where your files are being served (xampp/htdocs for xampp by default).
