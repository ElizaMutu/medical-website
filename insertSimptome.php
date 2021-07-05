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
    <form id="postForm" method="POST" action="functionsSimptome.php" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend>Adaugare simptome<br><br></legend>
        <div class="form-group">
            <label>Nume simptom:</label>
            <input class="form-control" type="text" name="nume_simptom" placeholder="Nume simptom" required="required" oninvalid="this.setCustomValidity('Introduceți denumire simptom!')"  oninput="setCustomValidity('')">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Descriere simptom:</label>
            <textarea class="form-control ckeditor" id="editor" name="editor" required="required"></textarea>  
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