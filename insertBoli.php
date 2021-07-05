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
    <form id="postForm" method="POST" action="functionsBoli.php" onsubmit="return postForm()">
    <fieldset class="form-group border-rounded">
        <legend>Adăugare boli<br><br></legend>
        <div class="form-group">
            <label>Denumire:</label>
            <input class="form-control" type="text" name="denumire" required="required" oninvalid="this.setCustomValidity('Introduceți denumirea bolii!')"  oninput="setCustomValidity('')">
        </div> <!--form-group-->

        <div class="form-group">
            <label>Descriere boală:</label>
            <textarea id='editor' class="form-control ckeditor" name="editor" required="required" oninvalid="this.setCustomValidity('Introduceți descrierea bolii!')"  oninput="setCustomValidity('')"></textarea>  
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