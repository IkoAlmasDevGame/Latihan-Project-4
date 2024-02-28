<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Account</title>
    <?php 
        if($_SESSION['user_level'] == "admin"){
            require_once("../ui/header.php");
        }else{
            require_once("../dashboard/index.php");
        }
    ?>
</head>

<body>
    <?php 
        require_once("../ui/navbar.php");
    ?>

    <?php 
        require_once("../ui/footer.php");
    ?>