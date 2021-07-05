<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$id = @$_GET['id'];
$med = $conn ->prepare("SELECT * FROM medicamente WHERE cod_med='$id'");
// $cod_med = @$_SESSION['id'];
$nume_med = @$_POST['nume_med'];
$prospect = @$_POST['prospect'];
$med->execute();
$row = $med-> fetch(PDO::FETCH_ASSOC);
$cod_med = $row['cod_med'];

if(isset($_POST['nume_med']) && isset($_POST['editor'])) {
    $conn = DB::connect();
    $nume_med = $_POST['nume_med'];
    $prospect = $_POST['editor'];
    // print_r($id); print_r($usernume_med);

    $stmt = "UPDATE medicamente SET nume_med=:nume_med,  prospect=:prospect WHERE cod_med=:cod_med";
    $query1 = $conn ->prepare($stmt);
    $param_new = array(':nume_med' => $nume_med, ':prospect' => $prospect, ':cod_med' => $cod_med);
    if($query1 ->execute($param_new))
    {
        $_SESSION['status'] = "Medicamentul a fost modificat cu succes!";  
        header("Location:medAdmin"); 
    }  else {
        $_SESSION['status'] = "Eroare! Medicamentul nu a fost modificat!";  
        header("Location:medAdmin"); 
    }  
}

include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container">
    <form id="postForm" method="POST" action="" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend><br>Modificare medicament<br><br></legend>
        <div class="form-group">
            <label>Denumire medicament:</label>
            <input class="form-control" type="text"  value="<?php echo $row['nume_med']; ?>" name="nume_med">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Prospect:</label>
            <textarea class="form-control ckeditor" id='editor' name="editor" type="text" value="<?php echo $row['prospect'];?>"><?php echo $row['prospect']; ?></textarea>  
        </div>
        <input type="hidden" name="cod_med" value="<?php $row['cod_med']; ?>">
        <button class="btn btn-success"  type="submit" value="Modifică" name="update">Modifică</button>
        <a href="medAdmin.php" class="btn border-primary text-primary"  type="cancel" value="Cancel" name="cancel">Cancel</a>
    </fieldset> <!--fieldset-->
    </form>

    </div>
</div>

    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor( editor );
    </script> 

<?php require 'footer.php'; ?>