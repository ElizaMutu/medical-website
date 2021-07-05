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
    <form method="POST" action="functionsMed.php" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend>Adaugare medicament<br><br></legend>
        <div class="form-group">
            <label>Cod medicament:</label>
            <input class="form-control" type="number" name="cod_med" placeholder="Cod medicament" required="required" oninvalid="this.setCustomValidity('Introduceți codul medicamentului!')"  oninput="setCustomValidity('')">
        </div> <!--form-group-->
        <div class="form-group">
            <label>Nume medicament:</label>
            <input class="form-control" type="text" name="nume_med" placeholder="Nume medicament" required="required" oninvalid="this.setCustomValidity('Introduceți denumirea medicamentului!')"  oninput="setCustomValidity('')">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Prospect medicament:</label>
            <textarea class="form-control ckeditor" id="editor" name="editor" placeholder="Enter text here..." required="required"></textarea>  
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
