<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <title>Jurnalul tău medical</title>
        <style>
            body{
            background: url(images/med.jpg) no-repeat center center fixed; !important;
            background-size: cover;}
        </style>
    </head>

    <body>
        <?php include 'navbar.php';   ?>
        <div class="container-fluid">
            
            <div class="modal-dialog text-center">
                <div class="col-sm-8 main-section">
                    <div class="modal-content">
                        <div class="col-12 user-img">
                            <img src="images/person.png">
                        </div>
                    <div class="col-12 form-input">
                        <form method="POST" action="process.php">
                            <fieldset class="form-group">
                            <legend>Login</legend>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="username" placeholder="Username" required="required" oninvalid="this.setCustomValidity('Introduceți username!')"  oninput="setCustomValidity('')">
                                </div> <!--form-group-->
                                <div class="form-group">
                                    <input class="form-control" type="password" autocomplete="current-password" name="password" placeholder="Password" required="required" oninvalid="this.setCustomValidity('Introduceți parola!')"  oninput="setCustomValidity('')">
                                </div> <!--form-group-->
                                <button class="btn btn-primary" type="submit" value="Login" name="login">Login</button>
                                <?php
                                    if(isset($_SESSION["error"])){
                                        $error = $_SESSION["error"]; ?>
                                        <br><span style="color: red;"><?php echo $error; ?></span>
                                    <?php } else {
                                        echo "";
                                    }
                                ?>  
                            </fieldset> <!--fieldset-->
                            
                        </form>
                    </div>
                        <br>
                        <div class="col-12 link-part">
                            <p>Not a member? <a href="register">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php require 'footer.php'; 

unset($_SESSION["error"]);

?>