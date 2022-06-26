## Brainster Library - 2nd project

**NOTE:** _this project is using fancy url (domain/path/webpage) and etc.._

## To run this project first you need to set up a few things..

#### First of all you need to create database, then from `source/database.sql` you need to run the SQL queries into your database.
##### After settign up the database, open consts.php and fill the PATH with your location of the project, fill DB_NAME with the same name as you created the database, then fill the DB_USERNAME and DB_PASSWORD with your database credentials and at the end change DH_HOST to your server address. 

For example:

```
define("PATH", "https://codepreneur.mk/brainsterlibrary/");
define("DB_HOST", "localhost");
define("DB_NAME", "database_name");
define("DB_USER", "root");
define("DB_PASSWORD", "password");
```

### If there is any problems with server connection you will be redirected to a 'broken' view and present with a specific message.
