<?php

session_start();
require_once ("db.php");
$conn = DB::connect();
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//disables emulation mode, for limit to work


if(isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 1;
}
$numperpage = 3; //number of links per page
$start = ($page-1)*$numperpage;

$query2 = $conn->prepare("SELECT * FROM categorii_forum AS x INNER JOIN forum AS y ON x.id=y.id_categ limit $start, $numperpage");
$query2 -> execute();
$forum = $query2 ->fetchAll();

$count = $conn->prepare("SELECT COUNT(id_forum) FROM forum");
$count->execute();
$row = $count->fetch();
$numrecords = $row[0]; //find out how many total records
$numlinks = ceil($numrecords/$numperpage); //ceil-rounds numbers up to the nearest integer

include 'header.php';
include 'navbar.php'; 
?>
<style>
    body {
        background: linear-gradient(to right, rgb(102, 255, 255) , rgb(51, 204, 255));
    }
</style>      

<div class="container-fluid forumpage">
<?php
        if(isset($_SESSION['status'])){ ?>
            <div class="registermessage"><?php echo $_SESSION['status']; ?></div>
            <?php unset($_SESSION["status"]);
        }  ?>
    <div class="container">
        <h2 class="h2forum">Bine ai venit în comunitatea Jurnalul tău medical!</h2> 
        <p class="paragraphforum">Alatură-te grupurilor de discuții dedicate celor mai importante și diverse afecțiuni, împartășește-ți experiența și află răspunsurile pe care le cauți direct de la medici sau de la alte persoane care se confruntă cu aceleași probleme de sănătate ca și tine. Beneficiază de asistența membrilor comunității în soluționarea problemelor tale medicale. </p>

        <div class="col-lg-12 columnPad">
            <div class="pullLeft">
            <?php if(!isset($_SESSION['username'])){  ?>
            <a href="login" class="btn btn-info">Scrie pe forum!</a>
            <?php } else { ?>
                <a href="createPostForum" class="btn btn-info">Scrie pe forum!</a>
            <?php } ?>

            </div>
            <div class="pullRight"> <?php echo $numrecords; ?> Discutii</div>  
        </div> 
        <br>

        <div class="discutions">
            <?php foreach($forum as $forumPosts){  ?>
            <h5><?php echo $forumPosts['titlu']; ?></h5>
            <span style="background:white;">&nbsp; Publicat la: <?php echo $forumPosts['data']; ?> în <b><?php echo $forumPosts['nume_categ']; ?></b>&nbsp; </span>
            <?php echo '<p>'.substr($forumPosts['text'], 0, 150).' . . .</p>'; ?>
            <a href="<?php echo ('forum/'.$forumPosts['id_forum']); ?>">Citește mai mult</a><br><br>
            <?php } ?>
            
        </div>
        <br>

        <div class="pagination">
            <?php //page numbers
                if($page >1) {
                echo '<a href="forum.php?page='.($page-1).'" class="btn btn-light">'.'<'. '</a> ';
                }
                for ($i=1; $i<=$numlinks; $i++){
                    if($i==$page){ //actual link
                        echo '<a href="forum.php?page='.$i.'" class="btn btn-info active">' .$i. '</a>';
                        
                    } else {  
                    echo '<a href="forum.php?page='.$i.'" class="btn btn-light">' .$i. '</a> ';
                    }
                }
                if($i>$page) {
                    echo '<a href="forum.php?page='.($page+1).'" class="btn btn-light">'.'>'. '</a> ';
                }
            ?> 
        </div><!--pagination-->
        <br><br>
    </div>
</div>

<?php require 'footer.php'; ?>