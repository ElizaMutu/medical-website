<?php

class DB {  //connect to the db
 
    public static function connect(){  
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPassword = "";
        $dbName = "medicaldb";
        

        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPassword);  //set the connection variable $conn to new PDO object
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//set warning error mode in PDO
        } 
        catch(PDOException $e) {
            die ("DB Connection failed: " . $e ->getMessage());
        }
        return $conn; //return connection object
    }
    
}