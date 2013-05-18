# GLOTR Sync
## Introduction
GLOTR Sync server is intented to use on free webhosting services to synchronize updates among localhost installations of GLOTR you have. However it could also be used for other services, so if you are interested in using it for your tool and need some advice on how it works, contact me on origin board. It is intended to be as simple as possible and all the processing, validation, etc is done on client servers.

## Installation
I suppose you already have some webhosting for it, so just download the archive with the latest version and unpack it tou your server. Then go to config/conf.php and set the variables properly.  
```
$dbname = "glotr_sync";  
$host = "127.0.0.1";  
$usrname = "root";  
$passwd = "";  
$max_transfer_items = 100;  
```  
$dbname - name of your database  
$usrname - username to your database  
$passwd - password to your database  
$max_transfer_items - max items transfered in each request  
Once you have the config ready, go to phpMyAdmin or whatever database tool are you using and import glotr_sync.sql to your database.  
Visit index.php in your browser and register, the first user account is activated automatically.  
Thats it.  
