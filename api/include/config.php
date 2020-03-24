<?php

################## Smarty Config ##################
// SITE_ROOT contains the full path to the eshop folder
define('SITE_ROOT', dirname(dirname(__FILE__)));
define('DIRECT', DIRECTORY_SEPARATOR);
if(!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']))
{
    $uri = 'https://' . $_SERVER['HTTP_HOST'];
}
else
{
    $uri = 'http://' . $_SERVER['HTTP_HOST'];
}
define('SITE_URL', $uri . '/yasna-smart/');
################## Smarty Config ##################

################## Database Config ##################
//define('DB_PERSISTENCY', 'true');
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_DATABASE', 'yasna-smart');
//define('PDO_DSN', 'mysql:host=' . DB_SERVER . ';dbname=' . DB_DATABASE . ';charset=UTF-8;array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")');
################## Database Config ##################

################## Include utility files ##################
require_once 'db.class.php';
DB::$user = 'root';
DB::$password = '';
DB::$dbName = 'yasna-smart';
//require_once 'database_handler.php';
################## Include utility files ##################

?>
