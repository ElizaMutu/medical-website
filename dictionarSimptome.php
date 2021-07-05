<?php

session_start();
require_once ("db.php");
$conn = DB::connect();
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//disables emulation mode, for limit to work

$character = '';
if(isset($_GET['character'])){
    $character = $_GET['character'];
    $character = preg_replace('#[^a-z]#i', '', $character); //removes non-alphabetic chars to prevent injection
    $query = "SELECT * FROM simptome WHERE nume_simptom LIKE '$character%'"; 
} 
else {
    $query = "SELECT * FROM simptome WHERE nume_simptom LIKE 'A%'";
}
try{
    $res=$conn ->prepare($query);
    $res->execute();
    $result = $res-> fetchAll();
}
catch(Exception $e){
    echo ($e-> getMessage());
}

include 'header.php';  
include 'navbar.php';   ?>

    <div class="container-fluid">
    <div class="container">
   
    <h1 class="dictionar">Dicționar medical | Semne și simptome</h1>
    <div class="articol_text">
    <p>Evaluarea semnelor si simptomelor este foarte importanta in diagnosticarea problemelor de sanatate si in monitorizarea evolutiei bolilor diagnosticate. In plus, evaluarea semnelor si simptomelor are o deosebita importanta in tratamentele medicamentoase in vederea determinarii eficacitatii tratamentului si in aparitia efectelor secundare.</p><br><br>
    </div>
    <form id="frm" name="frm" method="POST" action="">
    	<div class="form-inline" id="cautare">
            <input class="form-control" type="text" name="keyword"  placeholder="ex: acondroplazie">   
        <button class="btn btn-primary btn-success"  type="search" value="search" name="search">Search</button></div>
    </form>
    <br>
    
    <div class="table-responsive"> <!--alphabetical pagination-->
        <?php
        $character = range('A','Z');
        echo '<ul class="pagination">';

        foreach ($character as $alphabet){
            echo '<li class="page-item"> <a class="page-link" href="dictionarSimptome.php?character='.$alphabet.'">'.$alphabet.'</a> </li>';
        }
        echo '</ul>';
        ?>
    </div> 

    <div id="result">
        <ul class="list-group">
            <?php
            if(isset($_POST['keyword'])){
                include 'searchSimpt.php';
            } else {
            foreach ($result as $item){ ?>
                <li class="list-group-item"><a href="<?php echo ('simptome/'.$item['id_simptom']); ?>"><?php echo $item['nume_simptom']; ?></a>
                </li>
            <?php }
            } ?>
        </ul>
    </div>
    <br><br>

    </div>
    </div>
    <br><br>

<?php require 'footer.php'; ?>