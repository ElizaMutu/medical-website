<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$id = @$_GET['id'];
$plantemed = $conn ->prepare("SELECT * FROM plantemedicinale WHERE cod_planta='$id'");
$nume_planta = @$_POST['nume_planta'];
$beneficii = @$_POST['beneficii'];
$plantemed->execute();
$row = $plantemed-> fetch(PDO::FETCH_ASSOC);
$cod_planta = $row['cod_planta'];

if(isset($_POST['nume_planta']) && isset($_POST['editor'])) {
    $conn = DB::connect();
    $nume_planta = $_POST['nume_planta'];
    $beneficii = $_POST['editor'];
    // print_r($id); print_r($usernume_planta);

    $stmt = "UPDATE plantemedicinale SET nume_planta=:nume_planta,  beneficii=:beneficii WHERE cod_planta=:cod_planta";
    $query1 = $conn ->prepare($stmt);
    $param_new = array(':nume_planta' => $nume_planta, ':beneficii' => $beneficii, ':cod_planta' => $cod_planta);
    if($query1 ->execute($param_new))
    {
        $_SESSION['status'] = "Planta medicinală a fost modificată cu succes!";  
        header("Location:planteAdmin"); 
    }  else {
        $_SESSION['status'] = "Eroare! Planta medicinală nu a fost modificată!";  
        header("Location:planteAdmin"); 
    }  
}

include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container">
    <form id="postForm" method="POST" action="" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend><br>Modificare plantă medicinală<br><br></legend>
        <div class="form-group">
            <label>Denumire:</label>
            <input class="form-control" type="text"  value="<?php echo $row['nume_planta']; ?>" name="nume_planta">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Descriere:</label>
            <textarea class="form-control ckeditor" id='editor' name="editor" type="text" value="<?php echo $row['beneficii'];?>"><?php echo $row['beneficii']; ?></textarea>  
        </div>
        <input type="hidden" name="cod_planta" value="<?php $row['cod_planta']; ?>">
        <button class="btn btn-success"  type="submit" value="Modifică" name="update">Modifică</button>
        <a href="planteAdmin.php" class="btn border-primary text-primary"  type="cancel" value="Cancel" name="cancel">Cancel</a>
    </fieldset> <!--fieldset-->
    </form>

    </div>
</div>

    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor( editor );
    </script> 

<?php require 'footer.php'; ?>