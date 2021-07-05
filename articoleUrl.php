<?php

session_start();
require_once ("db.php");
$conn = DB::connect();

$id_articol = $_GET['id_articol'];
$query = $conn -> prepare("SELECT * FROM articole WHERE id_articol = ?");
$query -> bindParam(1, $id_articol, PDO::PARAM_INT);
$query -> execute();
$result = $query ->fetch(PDO::FETCH_ASSOC); //fetch all the results in associative array

$q = $conn->prepare("SELECT nume FROM articole_categ AS x INNER JOIN categorii AS y ON x.id_categ=y.id_categ  INNER JOIN articole AS z ON x.id_articol=z.id_articol WHERE x.id_articol= ?");
$q -> bindParam(1, $id_articol, PDO::PARAM_INT);
$q -> execute();
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
    <div class="container-fluid">
        <div class="container">

            <h2 class="articletitle"><?php echo $result['titlu']; ?> </h2> 
            <p class="datapubl">Publicat la data de: <?php echo $result['data']; ?> </p>
            
            <?php while($cat = $q ->fetch(PDO::PARAM_STR))
            {  ?>
                <span class="articlecateg">&nbsp;<?php echo implode(", ", $cat); ?>&nbsp;</span> 
                <?php echo " "; 
            }?> 
            <br><br>
            <?php echo "<img src='../images/".$result['img']."' alt='Image'>"; ?> <br><br>
            <?php echo $result['text']; ?> <br>
        </div>
    </div>

<?php require 'footer.php'; ?>