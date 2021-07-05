<?php

session_start();

include "db.php";

$conn = DB::connect();

$id = @$_GET['id'];  

$query = $conn ->prepare( "DELETE FROM plantemedicinale WHERE cod_planta=$id");
$query->execute(); 
$_SESSION['status'] = "Planta medicinală a fost ștearsă cu succes!";
header("Location: planteAdmin"); 
