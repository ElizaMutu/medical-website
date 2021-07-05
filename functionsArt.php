<?php

session_start();
require_once ("db.php");

if(isset($_POST['submit'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection
    if(isset($_POST['editor'])&& !empty($_POST['editor'])){
        $id_articol = $_POST['id_articol'];
        $titlu = $_POST['titlu'];
        $text = $_POST['editor'];

        $target = "images/".basename($_FILES['img']['name']);//the path to store the uploaded image
        $img = $_FILES['img']['name'];
        if(move_uploaded_file($_FILES['img']['tmp_name'], $target)){
            $msg="";
        } else {
            $msg="";
        }

        $id_categ = $_POST['categ'];
        $chk ="";
        
        if(empty($_POST['editor']) || empty($_POST['categ'])){
            echo ('Toate câmpurile sunt obligatorii!'); //it will stop executing the code
            return;
        }

        if(insertArticole($conn, $id_articol, $titlu, $img, $text)){//if query returns true
            $_SESSION['id_articol'] = $id_articol;
            $_SESSION['titlu'] = $titlu;
            $_SESSION['img'] = $img;
            $_SESSION['text'] = $text;
        }
        if(insertCateg($conn, $id_articol, $id_categ)){
            $_SESSION['id_articol'] = $id_articol;
            $_SESSION['id_categ'] = $id_categ;
        }
        $_SESSION['status'] = "Articolul a fost introdus cu succes!";
        header("Location: articoleAdmin"); 
    }
}

if(isset($_POST['update'])){
    $conn = DB::connect(); 
    $id_articol = $_POST['id_articol'];
    $titlu = $_POST['titlu'];
    $text = $_POST['editor'];
    $img = $_FILES['img']['name'];

    $target = "images/".basename($_FILES['img']['name']);//the path to store the uploaded image
  
    $id_categ = $_POST['categ'];
    $chk ="";
    
    if($id_articol =="" || $titlu =="" || $text == "" || $id_categ ==""){
        die('All fields are required.'); //it will stop executing the code
    }

    if(updateArticole($conn, $id_articol, $titlu, $img, $text)){//if query returns true
        $_SESSION['id_articol'] = $id_articol;
        $_SESSION['titlu'] = $titlu;
        $_SESSION['img'] = $img;
        $_SESSION['text'] = $text;
        //header("Location: adminpanel.php");  
    }
   
    if(updateCateg($conn, $id_articol, $id_categ)){
        $_SESSION['id_articol'] = $id_articol;
        $_SESSION['id_categ'] = $id_categ;
         
    }
    $_SESSION['status'] = "Articolul a fost modificat cu succes!";
    header("Location: articoleAdmin"); 
} 

function insertArticole($conn, $id_articol, $titlu, $img, $text) {
    $query = $conn ->prepare("INSERT INTO articole (id_articol, titlu, img, text) VALUES (:id_articol, :titlu, :img, :text)"); 
    $query->bindParam(":id_articol", $id_articol);
    $query->bindParam(":titlu", $titlu); 
    $query->bindParam(":img", $img);
    $query->bindParam(":text", $text);
     $query->execute(); 
}

function insertCateg($conn, $id_articol, $id_categ){
    foreach($id_categ as $chk1){  
        $chk = $chk1;
        $query = $conn ->prepare("INSERT INTO articole_categ (id_articol, id_categ) VALUES (:id_articol, :id_categ)");
        $query->bindParam(":id_articol", $id_articol);
        $query->bindParam(":id_categ", $chk);
        $query->execute(); 
    }
}

function updateArticole($conn, $id_articol, $titlu, $img, $text){

    $query = $conn ->prepare("UPDATE articole SET titlu=:titlu, text=:text WHERE id_articol=:id_articol");
    $query->bindParam(":titlu", $titlu); 
    $query->bindParam(":img", $img);
    $query->bindParam(":text", $text);
    $query->bindParam(":id_articol", $id_articol);
    return $query ->execute();
}

function updateCateg($conn, $id_articol, $id_categ){
    foreach($id_categ as $chk1){  
        $chk = $chk1;
    
    $query = $conn ->prepare("UPDATE articole_categ SET id_categ=:id_categ WHERE id_articol=:id_articol");
    $query->bindParam(":id_categ", $chk);
    $query->bindParam(":id_articol", $id_articol);

    $query->execute(); 
} 
}