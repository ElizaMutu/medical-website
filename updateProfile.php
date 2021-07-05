<?php

session_start();
require_once ("db.php");

if(!isset($_SESSION['username'])){ 
    header("Location:index");
}

$conn = DB::connect();
$id = @$_SESSION['id'];
$username = @$_SESSION['username'];
$query = $conn->prepare("SELECT * FROM users WHERE username='$username' ");
//$id = @$_SESSION['id'];
$name = @$_SESSION['name'];
$username = @$_SESSION['username'];
$email = @$_SESSION['email'];
$password = @$_SESSION['password'];

$query->execute();
$row = $query-> fetch(PDO::FETCH_ASSOC);
$id = $row['id'];
//print_r($id);

if(isset($_POST['name']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $conn = DB::connect();
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // print_r($id); print_r($username);

    $stmt = "UPDATE users SET name=:name, username=:username, email=:email, password=:password WHERE id=:id";
    $query1 = $conn ->prepare($stmt);
    $param_new = array(':name' => $name, ':username' => $username, ':email' => $email, ':password' => $password, ':id' => $id);
  
    if($query1 ->execute($param_new))
    {
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['status'] = "Profilul a fost modificat cu succes!";  
        header("Location:profile"); 
    }  else {
        $_SESSION['status'] = "Eroare! Profilul nu a fost modificat!";  
        header("Location:profile"); 
    }     
}
include 'header.php';
include 'navbar.php'; 
?>

<div class="container-fluid">
    <div class="container col-md-6">
    <a href='logout'> Logout</a> 
    <br><br>
    
    <form method="POST" action="">
    <fieldset class="form-group">
        <label>Name:</label>
        <input class="form-control" type="text" name="name"  value="<?php echo $row['name']; ?>"><br>
        <label>Username:</label>
        <input class="form-control" type="text" name="username" value="<?php echo $row['username']; ?>"><br>
        <label>Email:</label>
        <input class="form-control" type="email" name="email"  value="<?php echo $row['email']; ?>"><br>
        <label>Password:</label>
        <input class="form-control" type="password" autocomplete="new-password" name="password" value="<?php echo $row['password']; ?>"><br>
        <input type="hidden" name="id" value="<?php $row['id']; ?>">
        <button class="btn btn-success" type="submit" value="Modifică" name="update">Modifică</button>
    </fieldset> <!--fieldset-->
    </form>

    </div>
    </div>

<?php require 'footer.php'; ?>