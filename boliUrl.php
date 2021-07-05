<?php

session_start();
require_once ("db.php");
$conn = DB::connect();

$id_boala = $_GET['id_boala'];
$query = $conn -> prepare("SELECT * FROM boli WHERE id_boala = ?");
$query -> bindParam(1, $id_boala, PDO::PARAM_INT);
$query -> execute();
$result = $query ->fetch(PDO::FETCH_ASSOC); //fetch all the results in associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Jurnalul tău medical</title>
</head>
<body>

    
    <?php include 'navbar.php';  ?>
    <div class="container-fluid"><br>
        <div>
            <nav id="nav">
            <a href="/medical/boli">< Boli și afecțiuni</a>
        </div>
        <div class="container">

            <h2 class="articletitle"><?php echo $result['denumire']; ?> </h2> <br>
            
            <?php echo $result['descriere_boala']; ?> <br>
        </div>
    </div>

<?php require 'footer.php'; ?>