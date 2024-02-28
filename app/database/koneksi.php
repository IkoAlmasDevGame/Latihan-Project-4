<?php 
error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

try{
    $configs = new PDO("mysql:host=localhost; dbname=db_toko;", "root","");
}catch (Exception $e){
    echo "error : ". $e->getMessage();;
}
 
$view = "../controller/controller.php";
$models = "../model/model.php";

?>