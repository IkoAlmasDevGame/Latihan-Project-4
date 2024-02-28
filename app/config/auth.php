<?php 
if(isset($_SESSION['status'])){
    if(isset($_SESSION['id_pengguna'])){
        if(isset($_SESSION['nama_pengguna'])){
            if(isset($_SESSION['email_pengguna'])){
                if(isset($_SESSION['user_level'])){
                    if(isset($_SESSION['username'])){

                    }
                }
            }
        }
    }
}else{
    header("location:../index.php");
    exit(0);
}
?>