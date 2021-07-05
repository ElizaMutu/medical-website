
<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$username = @$_SESSION['username'];
$query = $conn->prepare("SELECT * FROM users WHERE username='$username' ");
$id = @$_SESSION['id'];
$name = @$_SESSION['name'];
$username = @$_SESSION['username'];
$email = @$_SESSION['email'];
$password = @$_SESSION['password'];
$query->execute();
$row = $query-> fetch(PDO::FETCH_ASSOC);
//print_r($row);
include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">            
<?php
        if(isset($_SESSION['status'])){ ?>
            <div class="registermessage"><?php echo $_SESSION['status']; ?></div>
            <?php unset($_SESSION["status"]);
        } ?><br><br>
            
            <p><b>Nume:</b> <?php echo $row['name'];?></p>
            <p><b>Username:</b> <?php echo $row['username'];?></p>
            <p><b>Email:</b> <?php echo $row['email'];?></p>
            <p type="password"><b>Password:</b> <?php echo '***********';?></p>
            <p><b>Data inregistrării:</b> <?php echo $row['register_date'];?></p>
        <div>
            <br>
            <?php //foreach ($user as $res){ ?>
            <a href='updateProfile?id=<?php echo $row['id'];?>' class='btn btn-success'> Modifică</a>
            <a onclick="return confirm('Ești sigur că vrei să ștergi acest profil?')" href='deleteProfile.php?id=<?php echo $row['id'];?>' class='btn btn-danger'> Șterge </a>
            <?php //} ?>
        </div>

            <a href='logout'> Logout</a>             
           
           
        </div>
             
<?php require 'footer.php'; ?>
