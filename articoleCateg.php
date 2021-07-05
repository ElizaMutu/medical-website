<?php

session_start();
require_once ("db.php");
$conn = DB::connect();
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//disables emulation mode, for limit to work

$id_categ = $_GET['id_categ'];
$query2 = $conn->prepare("SELECT * FROM articole_categ AS x INNER JOIN categorii AS y ON x.id_categ=y.id_categ  INNER JOIN articole AS z ON x.id_articol=z.id_articol WHERE x.id_categ= $id_categ ");
$query2 -> execute();
$result = $query2 ->fetchAll(PDO::FETCH_ASSOC); //fetch all the results in associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="/medical/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/medical/style.css">
    <title>Jurnalul tău medical</title>
</head>
<body>

    
    <?php include 'navbar.php';  ?>
    <div class="container-fluid">
        <div class="container">
            <br>
            <?php foreach($result as $res) { ?>
            <h2><?php echo $res['nume']; 
                $rows = $query2 -> rowCount();   
                if($rows>1)
                break;           
                ?></h2>
            <?php } ?>

            <br><br>
            <?php foreach($result as $res) { ?>
                <h3><a href="<?php echo ('/medical/articole/'.$res['id_articol']); ?>"><?php echo $res['titlu']; ?></a></h3>
                <div class="row">
                    <div class="col-md-3">
                    <a href="<?php echo ('/medical/articole/'.$res['id_articol']); ?>"><?php echo "<img src='/medical/images/".$res['img']."' alt='Image' width='272' height='140'>"; ?></a>
                    </div>
                    <div class="col-md-9">
                        <small class="">Publicat la data de: <?php echo $res['data']; ?></small>
                        <?php echo '<p><strong>'.substr($res['text'], 0, 220).' . . .</p></strong>'; ?><p><a href="<?php echo ('/medical/articole/'.$res['id_articol']); ?>">Citește mai mult</a></p>
                    </div>
                </div><br><br>
            <?php } ?>

        
            <br><br>
        </div>
    </div>

<?php require 'footer.php'; ?>