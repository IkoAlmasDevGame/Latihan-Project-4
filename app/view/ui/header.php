<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko</title>
    <?php 
        session_start();
        use controller\Controller;
        use model\View;

        require_once("../../config/auth.php");
        require_once("../../config/config.php");
        require_once("../../database/koneksi.php");
        require_once("../../controller/controller.php");
        require_once("../../model/model.php");

        $model = new View($configs);
        $lihat = new Controller($configs);
        
        if(isset($_GET['aksi'])){
            $aksi = $_GET['aksi'];
            if($aksi == "keluar"){
                if(isset($_SESSION['status'])){
                    unset($_SESSION['status']);
                    session_unset();
                    session_destroy();
                    $_SESSION = array();
                }
                header("location:../index.php");
                exit(0);
            }
        }

        if(!isset($_GET['act'])){

        }else{
            switch ($_GET['act']) {
                /*Barang*/ 
                case 'tambah-barang':
                    $model->TambahBarang();
                    break;

                case 'edit-barang':
                    $model->EditBarang();
                    break;

                case 'edit-restok':
                    $model->editRestok();
                    break;

                case 'edit-sisa':
                    $model->editSisa();
                    break;

                case 'hapus-barang':
                    $model->HapusBarang();
                    break;
                
                /*Kategori*/
                case 'tambah-kategori':
                    $model->TambahKategori();
                    break;

                case 'edit-kategori':
                    $model->EditKategori();
                    break;

                case 'hapus-kategori':
                    $model->HapusKategori();
                    break;

                default:
                    require_once("../dashboard/index.php");
                    break;
            }
        }

        if(!isset($_GET['page'])){
        }else{
            switch ($_GET['page']) {
                case 'kategori':
                    require_once("../kategori/index.php");
                    break;
                    
                case 'barang':
                    require_once("../barang/index.php");
                    break;
                                                        
                default:
                    require_once("../dashboard/index.php");
                    break;
            }
        }
    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>

<body>