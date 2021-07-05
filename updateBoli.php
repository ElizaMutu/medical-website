<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$id = @$_GET['id'];
$boli = $conn ->prepare("SELECT * FROM boli WHERE id_boala='$id'");
// $id_boala = @$_SESSION['id'];
$denumire = @$_POST['denumire'];
$descriere_boala = @$_POST['descriere_boala'];
$boli->execute();
$row = $boli-> fetch(PDO::FETCH_ASSOC);
$id_boala = $row['id_boala'];

if(isset($_POST['denumire']) && isset($_POST['editor'])) {
    $conn = DB::connect();
    $denumire = $_POST['denumire'];
    $descriere_boala = $_POST['editor'];
    // print_r($id); print_r($userdenumire);

    $stmt = "UPDATE boli SET denumire=:denumire,  descriere_boala=:descriere_boala WHERE id_boala=:id_boala";
    $query1 = $conn ->prepare($stmt);
    $param_new = array(':denumire' => $denumire, ':descriere_boala' => $descriere_boala, ':id_boala' => $id_boala);
    if($query1 ->execute($param_new))
    {
        $_SESSION['status'] = "Boala a fost modificată cu succes!";  
        header("Location:boliAdmin"); 
    }  else {
        $_SESSION['status'] = "Eroare! Boala nu a fost modificată!";  
        header("Location:boliAdmin"); 
    }  
}

include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container">
    <form id="postForm" method="POST" action="" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend><br>Modificare boli<br><br></legend>
        <div class="form-group">
            <label>Denumire:</label>
            <input class="form-control" type="text"  value="<?php echo $row['denumire']; ?>" name="denumire">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Descriere boală:</label>
            <textarea class="form-control ckeditor" id='editor' name="editor" type="text" value="<?php echo $row['descriere_boala'];?>"><?php echo $row['descriere_boala']; ?></textarea>  
        </div>
        <input type="hidden" name="id_boala" value="<?php $row['id_boala']; ?>">
        <button class="btn btn-success"  type="submit" value="Modifică" name="update">Modifică</button>
        <a href="boliAdmin.php" class="btn border-primary text-primary"  type="cancel" value="Cancel" name="cancel">Cancel</a>
    </fieldset> <!--fieldset-->
    </form>

    </div>
</div>

    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor( editor );
    </script> 

<?php require 'footer.php'; ?>