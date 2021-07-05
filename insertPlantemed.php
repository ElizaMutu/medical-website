<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}
include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container">
    <form method="POST" action="functionsPlantemed.php" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend>Adaugare planta medicinala<br><br></legend>
        <div class="form-group">
            <label>Cod planta medicinala:</label>
            <input class="form-control" type="number" name="cod_planta" placeholder="Cod planta medicinala" required="required" oninvalid="this.setCustomValidity('Introduceți codul plantei medicinale!')"  oninput="setCustomValidity('')">
        </div> <!--form-group-->
        <div class="form-group">
            <label>Nume planta medicinala:</label>
            <input class="form-control" type="text" name="nume_planta" placeholder="Nume planta medicinala" required="required" oninvalid="this.setCustomValidity('Introduceți denumirea plantei medicinale!')"  oninput="setCustomValidity('')">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Beneficii:</label>
            <textarea class="form-control ckeditor" id="editor" name="editor" placeholder="Enter text here..." required></textarea>  
        </div>
        <button class="btn btn-primary"  type="submit" value="Submit" name="submit">Submit</button>
    
    </fieldset> <!--fieldset-->
    </form>
    </div>
    </div>

    <script>
        var editor = CKEDITOR.replace( 'editor' );
        CKFinder.setupCKEditor( editor );
    </script> 

<?php require 'footer.php'; ?>