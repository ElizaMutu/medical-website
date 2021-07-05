<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$id = @$_GET['id'];
$simpt = $conn ->prepare("SELECT * FROM simptome WHERE id_simptom='$id'");
// $id_simptom = @$_SESSION['id'];
$nume_simptom = @$_POST['nume_simptom'];
$descriere_simptom = @$_POST['descriere_simptom'];
$simpt->execute();
$row = $simpt-> fetch(PDO::FETCH_ASSOC);
$id_simptom = $row['id_simptom'];

if(isset($_POST['nume_simptom']) && isset($_POST['editor'])) {
    $conn = DB::connect();
    $nume_simptom = $_POST['nume_simptom'];
    $descriere_simptom = $_POST['editor'];
    // print_r($id); print_r($usernume_simptom);

    $stmt = "UPDATE simptome SET nume_simptom=:nume_simptom,  descriere_simptom=:descriere_simptom WHERE id_simptom=:id_simptom";
    $query1 = $conn ->prepare($stmt);
    $param_new = array(':nume_simptom' => $nume_simptom, ':descriere_simptom' => $descriere_simptom, ':id_simptom' => $id_simptom);
    if($query1 ->execute($param_new))
    {
        $_SESSION['status'] = "Simptomul a fost modificat cu succes!";  
        header("Location:simptAdmin"); 
    }  else {
        $_SESSION['status'] = "Eroare! Simptomul nu a fost modificat!";  
        header("Location:simptAdmin"); 
    }  
}

include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container">
    <form id="postForm" method="POST" action="" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend><br>Modificare simptom<br><br></legend>
        <div class="form-group">
            <label>Nume simptom:</label>
            <input class="form-control" type="text"  value="<?php echo $row['nume_simptom']; ?>" name="nume_simptom">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Descriere simptom:</label>
            <textarea class="form-control ckeditor" id='editor' name="editor" type="text" value="<?php echo $row['descriere_simptom'];?>"><?php echo $row['descriere_simptom']; ?></textarea>  
        </div>
        <input type="hidden" name="id_simptom" value="<?php $row['id_simptom']; ?>">
        <button class="btn btn-success"  type="submit" value="Modifică" name="update">Modifică</button>
        <a href="simptAdmin.php" class="btn border-primary text-primary"  type="cancel" value="Cancel" name="cancel">Cancel</a>
    </fieldset> <!--fieldset-->
    </form>

    </div>
</div>

    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor( editor );
    </script> 

<?php require 'footer.php'; ?>