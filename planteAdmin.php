<?php

session_start();
require_once ("db.php");
require 'footer.php'; 

if(isset($_SESSION['rolecode'])){
    if($_SESSION['rolecode'] !='ADMIN'){
    header("Location:index");
    }
} else {
    header("Location:index");
}

$conn = DB::connect();
$query = $conn->prepare("SELECT * FROM plantemedicinale");
$query->bindParam(":cod_planta", $cod_planta);
$query->execute();
$plantemed = $query ->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <!--icon library-->

    <title>Jurnalul tău medical</title>
    <script type="text/javascript">
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('#scroll').fadeIn();
            } else {
                $('#scroll').fadeOut();
            }
        });

        $('#scroll').click(function() {
            $("html,body").animate({
                scrollTop: 0
            }, 600);
            return false;
        });
    });
    </script>
    <style>
    #scroll {
        position: fixed;
        right: 10px;
        bottom: 10px;
        height: 50px;
        width: 50px;
        background-color: #33d6ff;
        border-radius: 60px;
        -webkit-border-radius: 60px;
        -moz-border-radius: 60px;
    }

    #scroll span {
        position: absolute;
        top: 50%;
        left: 50%;
        margin-left: -11px;
        margin-top: -12px;
        font-size: 26px;
        /* border:8px solid transparent;*/
        /*triangle */
        border-bottom-color: white;
    }

    #scroll:hover {
        background-color: cyan;
        opacity: 1;
        filter: "alpha(opacity=100)";
        -ms-filter: "alpha(opacity=100)";
    }
    </style>
</head>

<body>

    <?php  include 'navbar.php';   ?>
    <div class="container-fluid">
        <?php
        if(isset($_SESSION['status'])){ ?>
            <div class="registermessage"><?php echo $_SESSION['status']; ?></div>
            <?php unset($_SESSION["status"]);
        }  ?>
        <br>
        <h2>Admin Panel Plante medicinale</h2>
        <br>
        <div class="addbutton">
            <a href="insertPlantemed">Adaugă Plantă medicinală</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Id plantă medicinală</th>
                            <th>Denumire plantă medicinală</th>
                            <th>Descriere plantă medicinală</th>
                            <th>Modifică</th>
                            <th>Șterge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($plantemed as $plante){  ?>
                        <tr>
                            <td><?php echo $plante['cod_planta'];?> </td>
                            <td><?php echo $plante['nume_planta']; ?> </td>
                            <td><?php echo '<p>'.substr($plante['beneficii'], 0, 200).' . . .</p>'; ?></td>
                            <td>
                                <a href="updatePlante.php?id=<?php echo $plante['cod_planta'];?>" class="btn btn-success"
                                    name="update"> Modifică
                                </a>
                            </td>
                            <td>
                                <a onclick="return confirm('Esti sigur că vrei să ștergi această plantă medicinală?')"
                                    href="deletePlante.php?id=<?php echo $plante['cod_planta'];?>" class="btn btn-danger">
                                    Șterge </a>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <br><br><br><br>
        <a href="javascript:void(0);" title="Go To Top" id="scroll" style="display:none;">
            <span><i class='fas fa-arrow-up'></i></span>
        </a>
    </div>


    <?php require 'footer.php'; ?>