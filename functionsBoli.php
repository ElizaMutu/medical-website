<?php

session_start();
require_once ("db.php");


if(isset($_POST['submit'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection

    $denumire = $_POST['denumire'];
    $descriere_boala = $_POST['editor'];   

    if($denumire =="" || $descriere_boala == ""){
        die('Toate câmpurile sunt obligatorii.'); //it will stop executing the code
    }

    if(checkBoalaExist($conn, $denumire)){
        echo "Această boală exista deja in baza de date.";
        return; //stops the execution of the code
    }

    if(insertBoli($conn, $denumire, $descriere_boala)){//if query returns true
        $_SESSION['denumire'] = $denumire;
        $_SESSION['descriere_boala'] = $descriere_boala;     
    }
    $_SESSION['status'] = "Boala a fost introdusă cu succes!";  
    header("Location:boliAdmin"); 
}

function insertBoli($conn, $denumire, $descriere_boala) {
   
    $query = $conn ->prepare("INSERT INTO boli (denumire, descriere_boala) VALUES (:denumire, :descriere_boala)"); 
    $query->bindParam(":denumire", $denumire); 
    $query->bindParam(":descriere_boala", $descriere_boala);    
    $query->execute(); 
}

function checkBoalaExist($conn, $denumire){ //to prevent the same entry being duplicated
    $query = $conn ->prepare("SELECT * FROM boli WHERE denumire=:denumire");
    $query ->bindParam(":denumire", $denumire);
    $query ->execute();

    //check
    if($query -> rowCount()== 1 ){ 
        return true;
    }
    else {
        return false;
    }
}