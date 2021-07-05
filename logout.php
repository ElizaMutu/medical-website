<?php
 
session_start();

unset($_SESSION['username']);
session_unset();
$_SESSION['status'] = "Te-ai delogat!!!";
header("Location: index");

?>