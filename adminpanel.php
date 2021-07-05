<?php

session_start();
require_once ("db.php");

if(isset($_SESSION['rolecode'])){
    if($_SESSION['rolecode'] !='ADMIN'){
    header("Location:index");
    }
} else {
    header("Location:index");
}

    include 'header.php';
    include 'navbar.php'; ?>
    <style>
    body {
        background: url(images/headergif.gif);
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
    }
</style>
    <div class="container-fluid">
    
        <?php
            if(isset($_SESSION['status'])){ ?>
                <div class="registermessage"><?php echo $_SESSION['status']; ?></div>
                <?php unset($_SESSION["status"]);
            } ?><br>

        <h1>Admin Panel</h1>
        <br>
        <div class="row">
        <div class="col-lg-6">
            <div class="box1">
                <a href="articoleAdmin">Articole</a>
            </div>
            <div class="box2">
                <a href="boliAdmin">Boli</a>
            </div>
            <div class="box3">
                <a href="medAdmin">Medicamente</a>
            </div>
            <div class="box4">
                <a href="simptAdmin">Simptome</a>
            </div>
            <div class="box5">
                <a href="planteAdmin">Plante medicinale</a>
            </div>
            <div class="box6">
                <a href="forum">Forum</a>
            </div>
        </div>
        </div>
    </div>
    
<?php require 'footer.php'; ?>