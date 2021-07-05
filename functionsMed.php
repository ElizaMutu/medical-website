<?php

session_start();
require_once ("db.php");


if(isset($_POST['submit'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection
    
    $cod_med = $_POST['cod_med'];
    $nume_med = $_POST['nume_med'];
    $prospect = $_POST['editor'];
    if($cod_med =="" || $nume_med =="" || $prospect == ""){
        die('Toate câmpurile sunt obligatorii.'); //it will stop executing the code
    }

    if(checkCodeExist($conn, $cod_med)){
        echo "Codul exista deja in baza de date.";
        return; //stops the execution of the code
    }

    if(checkNumeMedExist($conn, $nume_med)){
        echo "Acest medicament exista deja in baza de date.";
        return; //stops the execution of the code
    }

    if(insertMedicamente($conn, $cod_med, $nume_med, $prospect)){//if query returns true
        $_SESSION['cod_med']= $cod_med;
        $_SESSION['nume_med'] = $nume_med;
        $_SESSION['prospect'] = $prospect;
    }
    $_SESSION['status'] = "Medicamentul a fost introdus cu succes!";  
    header("Location:medAdmin");   
}

    function insertMedicamente($conn, $cod_med, $nume_med, $prospect) {
   
        $query = $conn ->prepare("INSERT INTO medicamente (cod_med, nume_med, prospect) VALUES (:cod_med, :nume_med, :prospect)"); //query for inserting articles into database
        $query->bindParam(":cod_med", $cod_med); 
        $query->bindParam(":nume_med", $nume_med); 
        $query->bindParam(":prospect", $prospect);
    
         $query->execute(); 
    }

    function checkCodeExist($conn, $cod_med){ //to prevent the same entry being duplicated
        $query = $conn ->prepare("SELECT * FROM medicamente WHERE cod_med=:cod_med");
        $query ->bindParam(":cod_med", $cod_med);
        $query ->execute();
    
        //check
        if($query -> rowCount()== 1 ){ 
            return true;
        }
        else{
            return false;
        }
    
    }

    function checkNumeMedExist($conn, $nume_med){ //to prevent the same entry being duplicated
        $query = $conn ->prepare("SELECT * FROM medicamente WHERE nume_med=:nume_med");
        $query ->bindParam(":nume_med", $nume_med);
        $query ->execute();
    
        //check
        if($query -> rowCount()== 1 ){ 
            return true;
        }
        else {
            return false;
        }
    }