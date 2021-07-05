<?php

session_start();
require_once ("db.php");


if(isset($_POST['submit'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection
    
    $cod_planta = $_POST['cod_planta'];
    $nume_planta = $_POST['nume_planta'];
    $beneficii = $_POST['editor'];    

    if($cod_planta =="" || $nume_planta =="" || $beneficii == ""){
        die('Toate câmpurile sunt obligatorii.'); //it will stop executing the code
    }

    if(checkCodeExist($conn, $cod_planta)){
        echo "Codul există deja în baza de date.";
        return; //stops the execution of the code
    }

    if(checkNumePlantaExist($conn, $nume_planta)){
        echo "Această plantă există deja în baza de date.";
        return; //stops the execution of the code
    }

    if(insertPlante($conn, $cod_planta, $nume_planta, $beneficii)){//if query returns true
        $_SESSION['cod_planta'] = $cod_planta;
        $_SESSION['nume_planta'] = $nume_planta;
        $_SESSION['beneficii'] = $beneficii;
    }
    $_SESSION['status'] = "Planta medicinală a fost introdusă cu succes!";  
    header("Location:planteAdmin"); 
}

    function insertPlante($conn, $cod_planta, $nume_planta, $beneficii) {
   
        $query = $conn ->prepare("INSERT INTO plantemedicinale (cod_planta, nume_planta, beneficii) VALUES (:cod_planta, :nume_planta, :beneficii)"); //query for inserting articles into database
        $query->bindParam(":cod_planta", $cod_planta); 
        $query->bindParam(":nume_planta", $nume_planta); 
        $query->bindParam(":beneficii", $beneficii);
    
         $query->execute(); 
    }

    function checkCodeExist($conn, $cod_planta){ //to prevent the same entry being duplicated
        $query = $conn ->prepare("SELECT * FROM plantemedicinale WHERE cod_planta=:cod_planta");
        $query ->bindParam(":cod_planta", $cod_planta);
        $query ->execute();
    
        //check
        if($query -> rowCount()== 1 ){ 
            return true;
        }
        else{
            return false;
        }
    
    }

    function checkNumePlantaExist($conn, $nume_planta){ //to prevent the same entry being duplicated
        $query = $conn ->prepare("SELECT * FROM plantemedicinale WHERE nume_planta=:nume_planta");
        $query ->bindParam(":nume_planta", $nume_planta);
        $query ->execute();
    
        //check
        if($query -> rowCount()== 1 ){ 
            return true;
        }
        else{
            return false;
        }
    
    }