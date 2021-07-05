<?php

session_start();
require_once ("db.php");
$conn = DB::connect();
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);//disables emulation mode, for limit to work

if(isset($_GET['page'])){
    $page = $_GET['page'];
} else {
    $page = 1;
}
$numperpage = 5; //number of links per page
$start = ($page-1)*$numperpage;

$query = "SELECT * FROM boli ORDER BY denumire limit $start, $numperpage"; 
try{
    $res=$conn ->prepare($query);
    $res->execute();
    $result = $res-> fetchAll();
}
catch(Exception $e){
    echo ($e-> getMessage());
}
$count = $conn->prepare("SELECT COUNT(id_boala) FROM boli");
$count->execute();
$row = $count->fetch();
$numrecords = $row[0]; //find out how many total records
$numlinks = ceil($numrecords/$numperpage); //ceil-rounds numbers up to the nearest integer

include 'header.php';  
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container">

        <h1 class="dictionar">Boli și afecțiuni</h1>
        <div class="articol_text">
            <p>În această secțiune vă prezentăm detaliat peste 2000 de boli, afecțiuni și tulburări de sănătate. Citiți despre: cauze și factori de risc, patogenie, semne și simptome, diagnostic, tratament și sfaturi utile.</p>
        </div>
    
        <div id="box-search">
            <p>Căutați o afecțiune după denumire: </p>
            <form id="frm" name="frm" method="POST" action="">
                <div class="form-inline" id="cautare">
                    <input class="form-control" type="text" name="keyword"  placeholder="ex: gripa">   
                <button class="btn btn-primary btn-success"  type="search" value="search" name="search">Search</button></div>
            </form>
        </div>
        
        <div id="result">
            <ul class="list-group">
                <?php
                    if(isset($_POST['keyword'])){
                        include 'searchBoli.php';
                    } else {
                        foreach ($result as $item){ ?>
                            <li class="list-group-item"><a href="<?php echo ('boli/'.$item['id_boala']); ?>"><?php echo $item['denumire']; ?></a>
                            </li>
                <?php   }
                } ?>
            </ul>
        </div>
        <br><br>

        <div class="pagination">
        <?php //page numbers
            if($page >1) {
            echo '<a href="boli.php?page=' .($page-1). ' " class="btn btn-light">'.'<'. '</a> ';
            }
            for ($i=1; $i<=$numlinks; $i++){
                if($i==$page){ //actual link
                    echo '<a href="boli.php?page=' .$i. ' " class="btn btn-info active">' .$i. '</a>';
                    
                } else {  
                echo '<a href="boli.php?page=' .$i. ' " class="btn btn-light">' .$i. '</a> ';
                }
            }
            if($i>$page) {
                echo '<a href="boli.php?page=' .($page+1). ' " class="btn btn-light">'.'>'. '</a> ';
            }
        ?> 
        </div><!--pagination-->
        <br>
    </div>
</div>
<?php require 'footer.php'; ?>