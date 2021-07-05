<?php
if(empty($_FILES['img']))
{
    exit();
}
$errorImgFile = "./img/img_upload_error.jpg";
$temp = explode(".", $_FILES["img"]["name"]);
$newfilename = round(microtime(true)) . '.' . end($temp);
$destinationFilePath = './images/'.$newfilename ;
if(!move_uploaded_file($_FILES['img']['tmp_name'], $destinationFilePath)){
    echo $errorImgFile;
}
else{
    echo $destinationFilePath;
}
 
?>