<?php

require_once ("db.php");
include_once ("functionsForum.php");

if(!isset($_SESSION['username'])){ 
    header("Location:forum");
}

$conn = DB::connect();
$query = "SELECT * FROM categorii_forum";

try{
    $data=$conn ->prepare($query);
    $data->execute();
    $results = $data-> fetchAll();
}
catch(Exception $e){
    echo ($e-> getMessage());
}

include 'header.php';
include 'navbar.php';   ?>

    <div class="container-fluid">    
        <div class="container"> 
            <form id="postForm" method="POST" action="" onsubmit="return postForm()">

                <fieldset class="form-group border-rounded">
                    <div class="form-group"><br>
                        <label>Titlu Postare</label>
                        <input class="form-control" type="text" name="titlu" placeholder="Titlu Postare" required oninvalid="this.setCustomValidity('Introduceți titlul postarii!')"  oninput="setCustomValidity('')">    
                    </div>

                    <div class="form-group mt-5 mb-5">
                        <label>Descriere</label>
                        <textarea id='editor' class="form-control ckeditor" name="editor"  placeholder="" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Categorii:</label><br>
                           
                        <!-- <input type="checkbox" name="id_categ" value="<?php echo $output['id'] ?>" > <?php echo $output['id'] .' - '. $output['nume_categ']; ?><br> -->
                        <select name="id_categ" class="form-control">
                        <?php foreach ($results as $output){ ?>
                            <option  value="<?php echo $output['id'] ?>" > <?php echo $output['id'] .' - '. $output['nume_categ']; ?></option>
                            <?php  } ?>
                        </select>
                        
                    </div> <!--dropdown-->
                    <br> 
                    <button class="btn btn-primary"  type="submit" value="Afișează" name="submit">Afișează</button>

                </fieldset> <!--fieldset-->
            </form>
        </div>
    </div>

<script>
    var editor = CKEDITOR.replace( 'editor' );
    CKFinder.setupCKEditor( editor );
</script> 


<?php require 'footer.php'; ?>