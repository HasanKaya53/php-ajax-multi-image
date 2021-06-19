<?php
require_once("image.class.php");

$imageClass = new imageClass;
$images = $_FILES["img"];
$imageName = date("His"); //optional


$imgReturn = $imageClass->uploadFile($images,$imageName);


if(!$imgReturn[0]){
    echo "All Image Add !";
}else{
    echo "Error:".$imgReturn[0]." Error Code:".$imgReturn[1]." Image not upload";
}

// print_r($_POST);






 ?>
