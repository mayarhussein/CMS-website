
<?php  include "db.php"; 
include "../admin/functions.php";   ?>
<?php
if (session_status() === PHP_SESSION_NONE)
session_start(); ?>




<?php 
if(isset($_POST['login'])){
    

        $username= $_POST['username'];
        $password= $_POST['password'];

login($username,$password);
}
?>