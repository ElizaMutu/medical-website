<?php

session_start();
require_once ("db.php");

//$editorContent = $statusMsg = '';

if(isset($_POST['submit'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection
    if(isset($_POST['editor'])&& !empty($_POST['editor'])){
        $forum_user = $_SESSION['username'];
        $titlu = $_POST['titlu'];
        $text = $_POST['editor'];
        $id_categ = $_POST['id_categ'];
        
        
        if($forum_user =="" || $titlu =="" || $text == ""){
            die('All fields are required.'); //it will stop executing the code
        }

        if(insertPostForum($conn, $forum_user, $titlu, $text, $id_categ)){//if query returns true
            $_SESSION['forum_user'] = $forum_user;
            $_SESSION['titlu'] = $titlu;
            $_SESSION['text'] = $text;
            $_SESSION['id_categ'] = $id_categ;   
        }
        $_SESSION['status'] = "Întrebarea a fost postată cu succes!";  
        header("Location:/medical/forum"); 
    }
}

if(isset($_POST['comment'])){
    $conn = DB::connect();

    if(!isset($_SESSION['username'])){ 
    header("Location:/medical/login"); 
    }

    $id_forum = $_GET['id_forum'];
    $username = $_SESSION['username'];
    $text = $_POST['text'];

    if(insertComment($conn, $id_forum, $username, $text)){
        $_SESSION['id_forum'] = $id_forum;
        $_SESSION['username'] = $username;
        $_SESSION['text'] = $text;
    }
    $_SESSION['status'] = "Comentariul a fost postat cu succes!";  
    header("Location:/medical/forum/$id_forum"); 
}

function insertPostForum($conn, $forum_user, $titlu, $text, $id_categ) {
   
    $query = $conn ->prepare("INSERT INTO forum(forum_user, titlu, text, id_categ) VALUES (:forum_user, :titlu, :text, :id_categ)"); //query for inserting articles into database
    $query->bindParam(":forum_user", $_SESSION['username']);
    $query->bindParam(":titlu", $titlu); 
    $query->bindParam(":text",$_POST['editor']);
    $query->bindParam(":id_categ", $id_categ);
    $query->execute(); 

}

function insertComment($conn, $id_forum, $username, $text) {
   
    $query = $conn ->prepare("INSERT INTO comments(id_forum, username, text) VALUES (:id_forum, :username, :text)"); //query for inserting articles into database
    $query->bindParam(":id_forum", $_GET['id_forum']);
    $query->bindParam(":username",  $_SESSION['username']); 
    $query->bindParam(":text",$_POST['text']);
    $query->execute(); 

}