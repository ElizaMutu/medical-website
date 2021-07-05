<?php
session_start();
require_once ("db.php");


if(isset($_POST['submit'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection
    $nume_simptom = $_POST['nume_simptom'];
    $descriere_simptom = $_POST['editor'];
  
    if($id_simptom="" || $nume_simptom =="" || $descriere_simptom == ""){
        die('Toate câmpurile sunt obligatorii.'); //it will stop executing the code
    }

    if(checkCodeExist($conn, $id_simptom)){
        echo "Codul există deja în baza de date.";
        return; //stops the execution of the code
    }

    if(checkNumeSimptExist($conn, $nume_simptom)){
        echo "Acest simptom există deja în baza de date.";
        return; //stops the execution of the code
    }

    if(insertSimptome($conn, $nume_simptom, $descriere_simptom)){//if query returns true
        $_SESSION['nume_simptom'] = $nume_simptom;
        $_SESSION['descriere_simptom'] = $descriere_simptom; 
    }
    $_SESSION['status'] = "Simptomul a fost introdus cu succes!"; 
    header("Location:simptAdmin");

}

    function insertSimptome($conn, $nume_simptom, $descriere_simptom) {
   
        $query = $conn ->prepare("INSERT INTO simptome (nume_simptom, descriere_simptom) VALUES (:nume_simptom, :descriere_simptom)"); 
        $query->bindParam(":nume_simptom", $nume_simptom); 
        $query->bindParam(":descriere_simptom", $descriere_simptom);
         $query->execute(); 
    }

    function checkCodeExist($conn, $id_simptom){ //to prevent the same entry being duplicated
        $query = $conn ->prepare("SELECT * FROM simptome WHERE id_simptom=:id_simptom");
        $query ->bindParam(":id_simptom", $id_simptom);
        $query ->execute();
    
        //check
        if($query -> rowCount()== 1 ){ 
            return true;
        }
        else{
            return false;
        }
    
    }

    function checkNumeSimptExist($conn, $nume_simptom){ //to prevent the same entry being duplicated
        $query = $conn ->prepare("SELECT * FROM simptome WHERE nume_simptom=:nume_simptom");
        $query ->bindParam(":nume_simptom", $nume_simptom);
        $query ->execute();
    
        //check
        if($query -> rowCount()== 1 ){ 
            return true;
        }
        else{
            return false;
        }
    
    }
