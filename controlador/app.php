<?php
if(!isset($_SESSION)) 
{ 
    ini_set("session.cookie_lifetime","10800");
    ini_set("session.gc_maxlifetime","10800");
    session_start(); 
}else{
    header('location: /panel/login.php');
}
?>