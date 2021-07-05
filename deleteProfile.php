

<?php

session_start();

include_once("db.php");

$conn = DB::connect();

$username = $_SESSION['username'];  //gets the current username

$query = $conn ->prepare( "DELETE FROM users WHERE username= :username");

$query->bindParam(":username", $username); //bind username to the actual usename, which is logged in
$query->execute(); 
session_unset();

header("Location: index"); //redirects the user to index.php

