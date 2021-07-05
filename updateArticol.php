<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

$id = @$_GET['id'];
$query = "SELECT * FROM articole_categ AS x INNER JOIN categorii AS y ON x.id_categ=y.id_categ  INNER JOIN articole AS z ON x.id_articol=z.id_articol GROUP BY x.id_categ";

//try{
    $results=$conn ->prepare($query);
    $results->execute();
    //$results = $data-> fetchAll();
// }
// catch(Exception $e){
//     echo ($e-> getMessage());
// }

// $stmt = $conn ->prepare("SELECT * FROM articole AS T1 JOIN articole_categ AS T2 JOIN categorii AS T3 WHERE T1.id_articol=T2.id_articol AND T1.id_articol=$id AND T2.id_categ=T3.id_categ");
$stmt = $conn->prepare("SELECT * FROM articole_categ AS x INNER JOIN categorii AS y ON x.id_categ=y.id_categ  INNER JOIN articole AS z ON x.id_articol=z.id_articol WHERE x.id_articol= $id");
$stmt->execute();

// $count = $conn ->prepare("SELECT COUNT('id_categ') FROM categorii");
// $count->execute();

$art = $conn ->prepare("SELECT * FROM articole WHERE id_articol=$id");
$titlu = @$_POST['titlu'];
$img = @$_POST['img'];
$text = @$_POST['text'];
$id_categ = @$_POST['categ'];
$art->execute();
$row = $art-> fetch(PDO::FETCH_ASSOC);
extract($row);
// $row = $stmt-> fetch(PDO::FETCH_ASSOC);
// extract($row);
//$arr = array('1', '2', '3', '4', '5','6','7');

// function select_checked_categ(){
//     foreach($id_categ as $id_result){
//         if($stmt['id_categ'])
//         return true;
//         else
//         return false;
//         }  
//     } 
if(isset($_POST['titlu']) && isset($_POST['img']) && isset($_POST['editor']) && isset($_POST['categ'])) {
    $conn = DB::connect();
    $titlu = $_POST['titlu'];
    $img = $_POST['img'];
    $text = $_POST['editor'];
    $id_categ = $_POST['categ'];

    // print_r($id); print_r($usernume_planta);

    $stmt = "UPDATE articole SET titlu=:titlu, img=:img, text=:text WHERE id_articol=:id_articol";    
    $query1 = $conn ->prepare($stmt);
    $param_new = array(':titlu' => $titlu, ':img' => $img, ':text' => $text, ':id_categ' => $id_categ, ':id_articol' => $id_articol);
    $stmt2 = "UPDATE articole_categ SET id_categ=:id_categ WHERE id_articol=:id_articol";
    $query2 = $conn ->prepare($stmt2);
    $param_new2 = array(':titlu' => $titlu,':id_articol' => $id_articol);
    if($query1 ->execute($param_new))
    {
        if( $query2 ->execute($param_new2)) {
        $_SESSION['status'] = "Articolul a fost modificat cu succes!";  
        header("Location:articoleAdmin"); 
        }
    }  else {
        $_SESSION['status'] = "Eroare! Articolul nu a fost modificat!";  
        header("Location:articoleAdmin"); 
    }  
}




include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
        <br><br>
        <div class="container">
        <form id="postForm" method="POST" action="" enctype="multipart/form-data" onsubmit="return postForm()">
        
        <fieldset class="form-group border-rounded">
            <legend>Modificare Articol<br><br></legend>
            <div class="form-group">
                <label>Nr. Articol:</label>
                <input class="form-control" type="number" value="<?php echo $id; ?>" name="id_articol">
            </div> <!--form-group-->
            <div class="form-group">
                <label>Titlu:</label>
                <input class="form-control" type="text" value="<?php echo $titlu; ?>" name="titlu">
            </div> <!--form-group-->
            
            <label>Imagine:</label>
            <div class="form-group">
                    <img src="images/<?php echo $img; ?>" class="img-fluid">
                    <input type="file" class="form-control-file" accept="*/image" value="<?php echo $img; ?>" name="img">
            </div>


            <div class="checkbox">
            <label>Categorii:</label><br>
                <?php  while($res = $results ->fetch(PDO::FETCH_ASSOC)){ ?>
                    <?php if(($output = $stmt ->fetch(PDO::FETCH_ASSOC)) && $output['id_categ'] = $res['id_categ']){ ?>
                    <input checked="checked" type="checkbox" value="<?php echo $res['id_categ']; ?>" name="categ[]">&nbsp;<?php echo $res['id_categ'] .' - '. $res['nume']; ?><br>
                <?php } else {?>
                    <input type="checkbox" name="categ[]">&nbsp;<?php echo $res['id_categ'] .' - '. $res['nume']; ?><br>

               <?php } }?>
            </div> <!--ckeckbox-->
                <br>

            <div class="form-group">
            <label>Text articol:</label>
                <textarea class="form-control ckeditor" id="editor" name="editor" type="text" value="<?php echo $text; ?>"><?php echo $text; ?></textarea>  
            </div><br>    

            <button class="btn btn-success"  type="update" value="Modifică" name="update">Modifică</button>
            <a href="articoleAdmin.php" class="btn border-primary text-primary"  type="cancel" value="Cancel" name="cancel">Cancel</a>
        </fieldset> <!--fieldset-->
        </form>  <?php //} ?>
        </div>
    </div>

    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor( editor );
    </script>

<?php require 'footer.php'; ?>