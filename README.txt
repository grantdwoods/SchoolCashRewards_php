To get started run: git clone https://github.com/grantdwoods/SchoolCashRewards_php

The easiest way to intall the dependancies is with composer: https://getcomposer.org/

Once composer is installed go to the project directory and type: composer install

Under the sql directory are sql text files that can help you import the tables used in this project.
Database credentials can be found in: 
  sp_auth/authDBconn.php
  sp_app/appDBconn.php

There are Postman json files that you may use to import API calls into Postman. However, they were poorly established and easily broken.
Therefore, they have not been maintained. Mostly due to the change in database information, a majority of the calls require a new JWT.
This token can be created by using the login credentials "admin1"(both username and password) in a POST request to sp_auth/log_in.php.
The calls assume that the project lives in the main directory of where your files are being served (xampp/htdocs for xampp by default) and through port 80.
