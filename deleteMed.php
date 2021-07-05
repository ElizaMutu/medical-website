<?php

session_start();

include "db.php";

$conn = DB::connect();

$id = @$_GET['id'];  

$query = $conn ->prepare( "DELETE FROM medicamente WHERE cod_med=$id");
$query->execute(); 
$_SESSION['status'] = "Medicamentul a fost șters cu succes!";
header("Location: medAdmin"); 
