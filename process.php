<?php

session_start();
require_once ("db.php");

if(isset($_POST['register'])){
    $conn = DB::connect(); /*instantiate class*///calling the method connect from class DB and storing the reference of the connection
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = sanitizePassword($_POST['password']);

    if(checkUsernameExist($conn, $username)){
        echo "Numele utilizatorului există deja în baza de date.";
        return;//stops the execution of the code
    }

    if(checkEmailExist($conn, $email)){
        echo "Acest email există deja în baza de date.";
        return; //stops the execution of the code
    } 

    if(insertDetails($conn, $name, $username, $email, $password)){//if query returns true
        $_SESSION['name'] = $name;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['status'] = "Te-ai înregistrat!!!";
        if(isset($_SESSION['username'])){
                header("Location:profile");
            }
        }
}

if(isset($_POST['login'])){
    $conn = DB::connect();
    $username = $_POST['username'];
    $password = sanitizePassword($_POST['password']);
    $error="Numele utilizatorului sau parola sunt incorecte!";
    
    $query = $conn ->prepare("SELECT * FROM users WHERE username=:username AND password=:password "); 
    $query->bindParam(":username", $username); //bind username to the actual usename, which is logged in
    $query->bindParam(":password", $password);
    $query->execute();
    
    $row = $query -> rowCount();              
    if($row > 0 ){ //check how many rows are returned
        while($row = $query ->fetch(PDO::FETCH_ASSOC)){
            if($row['rolecode'] =='ADMIN'){
                $_SESSION['username'] = $username;
                $_SESSION['rolecode'] = $row['rolecode'];
                $_SESSION['status'] = "Te-ai logat!!!";
                header("Location:adminpanel");
            } 
            else {
                $_SESSION['username'] = $username;
                $_SESSION['rolecode'] = $row['rolecode'];
                $_SESSION['status'] = "Te-ai logat!!!";
                header("Location:index");
            }
        }
    }        
    else{
        $_SESSION['error'] = $error;
        header("Location:login");
    }
}

function insertDetails($conn, $name, $username, $email, $password){

    $query = $conn ->prepare("INSERT INTO users (name, username, email, password) VALUES (:name, :username, :email, :password)"); 
    $query->bindParam(":name", $name);
    $query->bindParam(":username", $username);
    $query->bindParam(":email", $email);  
    $query->bindParam(":password", $password);

    return $query->execute(); 
}


function sanitizePassword($string) {
    $string = md5($string); //hashes the password
    return $string;
}

function checkNameExist($conn, $name){ //to prevent the same entry being duplicated
    $query = $conn ->prepare("SELECT * FROM users WHERE name=:name");
    $query ->bindParam(":name", $name);
    $query ->execute();

    //check
    if($query -> rowCount()== 1 ){ 
        return true;
    }
    else{
        return false;
    }

}

function checkUsernameExist($conn, $username){ //to prevent the same entry being duplicated
    $query = $conn ->prepare("SELECT * FROM users WHERE username=:username");
    $query ->bindParam(":username", $username);
    $query ->execute();

    //check
    if($query -> rowCount()== 1 ){ 
        return true;
    }
    else{
        return false;
    }
}

function checkEmailExist($conn, $email){
    $query = $conn ->prepare("SELECT * FROM users WHERE email=:email");
    $query ->bindParam(":email", $email);
    $query ->execute();

    //check
    if($query -> rowCount()== 1 ){ 
        return true;
    }
    else{
        return false;
    }
}