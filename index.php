<?php

require_once ("db.php");
session_start();
$conn = DB::connect();

$q = $conn->prepare("SELECT * FROM articole");
$q->execute();
$stmt = $q ->fetchAll();

$categ = $conn->prepare("SELECT id_categ, nume FROM categorii");
// $categ->bindParam(":id_categ", $id_categ);
$categ->execute();
$c = $categ ->fetchAll(PDO::FETCH_ASSOC);




    // while($art = $results ->fetch(PDO::FETCH_ASSOC)){ 

// $query2 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=2 LIMIT 3");
// $query2->execute();
// $articole2 = $query2 ->fetchAll();

// $query3 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=3 LIMIT 3");
// $query3->execute();
// $articole3 = $query3 ->fetchAll();

// $query4 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=4 LIMIT 3");
// $query4->execute();
// $articole4 = $query4 ->fetchAll();

// $query5 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=5 LIMIT 3");
// $query5->execute();
// $articole5 = $query5 ->fetchAll();

// $query6 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=6 LIMIT 3");
// $query6->execute();
// $articole6 = $query6 ->fetchAll();

// $query7 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=7 LIMIT 3");
// $query7->execute();
// $articole7 = $query7 ->fetchAll();

include 'header.php';  
include 'navbar.php';  
?>

<div class="container-fluid">
    <?php
        if(isset($_SESSION['status'])){ ?>
            <div class="registermessage"><?php echo $_SESSION['status']; ?></div>
            <?php unset($_SESSION["status"]);
        }  ?>
       <div class="row justify-content-center mb-2">
        <div class="col-lg-10">
            <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">
                <ul class="carousel-indicators">
                    <?php
                      $i=0;
                      foreach($stmt as $stmt1){ 
                          $actives = '';
                          if($i == 0){
                              $actives = 'active';
                          } ?>
                    <li data-target="#demo" data-slide-to="<?= $i; ?>" class="<?= $actives; ?>"></li>
                    <?php $i++;
                    } ?>
                </ul>
                <div class="carousel-inner">
                    <!--the slideshow-->
                    <?php
                        $i=0;
                        foreach($stmt as $stmt1){ 
                            $actives = '';
                            if($i == 0){
                                $actives = 'active';
                            } 
                    ?>
                    <div class="carousel-item <?= $actives; ?>"><a
                            href="<?php echo ('articole/'.$stmt1['id_articol']); ?>"><img class="d-block w-100 img-fluid"
                                src="images/<?= $stmt1['img']; ?>"></a>
                        <div class="carousel-caption d-none d-block">
                            <h3 class="display-2"><?php echo $stmt1['titlu']; ?> </h3>
                        </div>
                    </div>
                    <?php $i++; 
                      }?>
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <?php //} ?>
        </div>
    </div>
    <!--Carousel-->
    <br>    <br>
    
  
    <?php 
        foreach($c as $cat) { 
        $query1 = $conn->prepare("SELECT * FROM articole AS a INNER JOIN articole_categ AS b ON a.id_articol=b.id_articol WHERE b.id_categ=" . $cat['id_categ']);
        $query1->execute();
        $articole = $query1 ->fetchAll();
        ?>
        <table class="col-md-2">
        <tr style="width:150pt;">
            <td style="padding-right:1px; padding-left:1px; height: 25rem; text-align: center;width:1rem;">
                <a href="<?php echo ('articole-categorii/'.$cat['id_categ']); ?>"><p class="textorientation"><strong><?php echo $cat['nume']; ?></strong></p></a>
            </td>
        <?php// } ?> 
        

            <?php         
            $count=0;
            foreach($articole as $art) {?>
                <td style="height: 18rem; width: 14rem; padding-right:10px; padding-left:10px;">
                <table><tr style="height:;width:26rem;">
                <a href="<?php echo ('articole/'.$art['id_articol']); ?>"><?php echo "<img src='images/" .$art['img']."' alt='Article Image' style='height: 13rem;width: 26rem; '>"; ?></a></tr>
                    <tr style="height:1rem;width:26rem;"><a href="<?php echo ('articole/'.$art['id_articol']); ?>" style="height: 18rem; width: 15rem;"><?php echo $art['titlu']; ?> </a></tr>
                    <tr style="height:4rem;width:26rem;"><?php echo '<p>'.substr($art['text'], 0, 220).' . . .</p>'; ?> </tr>   
                </table> 
                </td>

        <?php 
        $count++;
        if($count>2){
            break;
        }
    }?>
    </tr>
    <?php } ?>
    </table><br/>

    <br><br>

</div>

<?php require 'footer.php'; ?>