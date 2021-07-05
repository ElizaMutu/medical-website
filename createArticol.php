<?php

session_start();
require_once ("db.php");
$conn = DB::connect();

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$query = "SELECT * FROM categorii";
try{
    $data=$conn ->prepare($query);
    $data->execute();
    $results = $data-> fetchAll();
}
catch(Exception $e){
    echo ($e-> getMessage());
}

    include 'header.php';
    include 'navbar.php';  ?>

    <div class="container-fluid">
        <div class="container">
        <form id="postForm" method="POST" action="functionsArt.php" enctype="multipart/form-data" onsubmit="return postForm()"> 
        
            <fieldset class="form-group border-rounded">
                <legend>Adaugare Articol<br><br></legend>
                <div class="form-group">
                    <label>Nr. Articol:</label>
                    <input class="form-control" type="number" name="id_articol" placeholder="Nr. Articol" required="required" oninvalid="this.setCustomValidity('Introduceți numărul articolului!')"  oninput="setCustomValidity('')">
                </div> <!--form-group-->

                <div class="form-group">
                    <label>Titlu:</label>
                    <input class="form-control" type="text" name="titlu" placeholder="Titlu" required="required" oninvalid="this.setCustomValidity('Introduceți titlul articolului!')"  oninput="setCustomValidity('')">
                </div> <!--form-group-->
                
                <div class="form-group">
                    <label>Imagine:</label>
                        <input type="file" class="form-control-file" name="img" required oninvalid="this.setCustomValidity('Introduceți o imagine!')"  oninput="setCustomValidity('')">
                </div>
                
                <div class="checkbox">
                    <label>Categorii:</label><br>
                    <?php foreach ($results as $output){ ?>
                    <input type="checkbox" name="categ[]" value="<?php echo $output['id_categ'] ?>" > <?php echo $output['id_categ'] .' - '. $output['nume']; ?><br>
                    <?php  } ?>
                </div> <!--ckeckbox-->
                    
                <br>
                <div class="form-group">
                    <label>Text articol:</label>
                    <textarea id='editor' class="form-control ckeditor" name="editor" required="required"></textarea>  
                </div> <br>

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