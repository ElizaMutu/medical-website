<?php

session_start();

include "db.php";

$conn = DB::connect();

$id = @$_GET['id']; 

$query = $conn ->prepare( "DELETE FROM articole WHERE id_articol=$id");
$query->execute(); 
$_SESSION['status'] = "Articolul a fost șters cu succes!";
header("Location: articoleAdmin");

