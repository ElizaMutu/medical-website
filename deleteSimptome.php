<?php

session_start();

include "db.php";

$conn = DB::connect();

$id = @$_GET['id'];  

$query = $conn ->prepare( "DELETE FROM simptome WHERE id_simptom=$id");
$query->execute(); 
$_SESSION['status'] = "Simptomul a fost șters cu succes!";
header("Location: simptAdmin"); 
