<?php 
  ob_start();  // Output Buffer    
$db["db_host"]='localhost';
$db["db_username"]='root';
$db["db_password"]='';
$db["db_name"]='cms';

foreach($db as $key => $value)
define(strtoupper($key),$value);  // covert to constants;




$connection =mysqli_connect($db["db_host"],DB_USERNAME,DB_PASSWORD,DB_NAME);


if(!$connection)
   die("Not Connected!");





?>