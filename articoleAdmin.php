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
$query = $conn->prepare("SELECT * FROM articole");
$query->bindParam(":id_articol", $id_articol);
$query->execute();
$articole = $query ->fetchAll();
                           
//$query1 = $conn->prepare("SELECT id_articol, GROUP_CONCAT(id_categ SEPARATOR ', ') as id_categ FROM articole_categ GROUP BY id_articol");
// $query1->bindParam(":id_categ", $id_categ);
// $query1->bindParam(":id_articol", $id_articol);
// $query1->execute();
// $categ = $query1 ->fetchAll();      
// $conn = DB::connect();
$q = $conn->prepare("SELECT nume FROM articole_categ AS x INNER JOIN categorii AS y ON x.id_categ=y.id_categ  INNER JOIN articole AS z ON x.id_articol=z.id_articol WHERE x.id_articol= ?");
 //$q->bindParam(":nume", $nume);
 //$q->bindParam(":id_articol", $id_articol);
$q -> bindParam(1, $id_articol, PDO::PARAM_INT);
$q->execute();

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
        <h2>Admin Panel Articole</h2>
        <br>
        <div class="addbutton">
        <a href="createArticol">Adaugă Articol</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nr. articol</th>
                            <th>Titlu articol</th>
                            <th>Imagine</th>
                            <th>Text articol</th>
                            <th>Modifică</th>
                            <th>Șterge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($articole as $art){  ?>
                        <tr>
                            <td><?php echo $art['id_articol'];?> </td>
                            <td><?php echo $art['titlu']; ?> </td>
                            <td><?php echo "<img src='images/" .$art['img']."' alt='Image' class='img-fluid'>";?> </td>
                            <td><?php echo '<p>'.substr($art['text'], 0, 150).' . . .</p>'; ?></td>
                            <td>
                                <a href="updateArticol.php?id=<?php echo $art['id_articol'];?>" class="btn btn-success"
                                    name="update"> Modifică
                                </a>
                            </td>
                            <td>
                                <a onclick="return confirm('Esti sigur că vrei să ștergi acest articol?')"
                                    href="deleteArticol.php?id=<?php echo $art['id_articol'];?>" class="btn btn-danger">
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