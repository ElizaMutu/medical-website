<?php
require_once ("db.php");
include_once ("functionsForum.php");

$conn = DB::connect();

$id_forum = $_GET['id_forum'];
$query = $conn -> prepare("SELECT * FROM categorii_forum AS x INNER JOIN forum AS y ON x.id=y.id_categ WHERE id_forum = ?");
$query -> bindParam(1, $id_forum, PDO::PARAM_INT);
$query -> execute();
$result = $query ->fetch(PDO::FETCH_ASSOC); //fetch all the results in associative array

$query2 = $conn->prepare("SELECT * FROM comments WHERE id_forum = ?");
$query2 -> bindParam(1, $id_forum, PDO::PARAM_INT);
$query2 -> execute();
// $commforum = $query2 ->fetch(PDO::FETCH_ASSOC);
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
        <?php
        if(isset($_SESSION['status'])){ ?>
            <div class="registermessage"><?php echo $_SESSION['status']; ?></div>
            <?php unset($_SESSION["status"]);
        }  ?>
        <div class="container">

            <div class="discutions">
                <h5><?php echo $result['titlu']; ?></h5>
                <p>Publicat la: <?php echo $result['data']; ?> în <b><?php echo $result['nume_categ']; ?></b></p>
                <p><?php echo $result['text']; ?></p>
            </div>
            <hr>

            <h3>Comentarii</h3>
            <?php 
            $row = $query2 -> rowCount();              
            if($row > 0 ){
            foreach($query2 as $comms) { ?>
            <div class="card">
                <p>&nbsp;<?php echo $comms['text'];?><b><?php echo" ~";echo $comms['username']; ?></b></p>
            </div><br>
            <?php }
            } ?>
            <hr>
            <h3>Adaugă un comentariu</h3>
            <p><a href="/medical/login">Loghează-te</a> sau <a href="/medical/register">Înregistrează-te</a> pentru a putea comunica cu pacienții și medicii din cadrul comunității.</p>
            <form action="" method="POST" accept-charset="utf-8">
            <div class="form-group">
                <label>Comentariul tău:</label>
                <textarea name="text" class="form-control"></textarea>
            </div>
            <!-- <input type="hidden" name="slug" value="Rezultate-Analize"> -->
            <button class="btn btn-primary" name="comment" type="submit">Adaugă</button>
            </form>
            <br><br>
        </div>
    </div>

<?php require 'footer.php'; ?>