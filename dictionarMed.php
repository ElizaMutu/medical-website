<?php
session_start();

require_once ("db.php");
$conn = DB::connect();
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);//disables emulation mode, for limit to work

$character = '';
if(isset($_GET['character'])){
    $character = $_GET['character'];
    $character = preg_replace('#[^a-z]#i', '', $character); //removes non-alphabetic chars to prevent injection
    $query = "SELECT * FROM medicamente WHERE nume_med LIKE '$character%'"; 
} 
else {
    $query = "SELECT * FROM medicamente WHERE nume_med LIKE 'A%'";
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
    <style>
        body {
            background: url(images/medicines.jpg);
            height: 100%; 
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>  
    <div class="container-fluid">
    <div class="container">

    <h1 class="dictionar">Dicționar medical | Dicționar medicamente</h1>
    
    <form id="frm" name="frm" method="POST" action="">
    	<div class="form-inline" id="cautare">
            <input class="form-control" type="text" name="keyword" id="keyword"  placeholder="ex: paracetamol" >   
        <button class="btn btn-primary btn-success"  type="search" id="search" value="search" name="search" >Search</button></div>
    </form>
    <br>

    <div class="table-responsive"> <!--alphabetical pagination-->
        <?php
        $character = range('A','Z');
        echo '<ul class="pagination">';
        foreach ($character as $alphabet){
            echo '<li class="page-item"> <a class="page-link" href="dictionarMed.php?character='.$alphabet.'">'.$alphabet.'</a> </li>';
        }
        echo '</ul>';
        ?>
    </div> 

    <div id="result">
        <ul class="list-group">
            <?php
                if(isset($_POST['keyword'])){
                    include 'searchMed.php';
                } else {
                    foreach ($result as $item){ ?>
                        <li class="list-group-item"><a href="<?php echo ('medicamente/'.$item['cod_med']); ?>"><?php echo $item['nume_med']; ?></a>
                        </li>
            <?php   }
            } ?>
        </ul>
    </div>
    <br><br>

    </div>
    </div>

<?php require 'footer.php'; ?>