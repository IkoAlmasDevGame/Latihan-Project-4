<?php 
require_once("../database/koneksi.php");
session_start();
if(isset($_POST['submited'])){
    $userEmail = htmlspecialchars($_POST['userEmail']);
    $passEmail = htmlspecialchars($_POST['password']);
    password_verify($passEmail, PASSWORD_DEFAULT);

    if($userEmail == "" || $passEmail == ""){
        header("location:index.php");
        exit(0);
    }

    $table = "tbl_pengguna";
    $sql = "SELECT * FROM $table WHERE email = '$userEmail' and password = '$passEmail' || username = '$userEmail' and password = '$passEmail'";
    $row = $configs->prepare($sql);
    $row->execute();
    $cek = $row->rowCount();

    if($cek > 0){
        $response = array($userEmail,$passEmail);
        $response["tbl_pengguna"] = array($userEmail,$passEmail);
        if($db = $row->fetch()){
            if($db["user_level"] == "admin"){
                $_SESSION["id_pengguna"] = $db["id"];
                $_SESSION["username"] = $db["username"];
                $_SESSION["email_pengguna"] = $db["email"];
                $_SESSION["nama_pengguna"] = $db["nama"];
                $_SESSION["user_level"] = "admin";
                header("location:dashboard/index.php");
            }
            $_SESSION['status'] = true;
            array_push($response["tbl_pengguna"], $db);
            exit(0);
        }else{
            $_SESSION['status'] = false;
            header("location:index.php");
            exit(0);
        }
    }
}
?>