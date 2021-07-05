<?php

session_start();

include "db.php";

$conn = DB::connect();

$id = @$_GET['id'];  

$query = $conn ->prepare( "DELETE FROM boli WHERE id_boala=$id");
$query->execute(); 
$_SESSION['status'] = "Boala a fost ștearsă cu succes!";
header("Location: boliAdmin"); 
