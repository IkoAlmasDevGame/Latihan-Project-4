<?php 
require_once("../ui/header.php");
require_once("../ui/navbar.php");
?>

<div class="col-md-12 col-lg-12">
    <div class="d-flex justify-content-center align-items-center flex-wrap mt-5 mt-lg-5 pt-4 pt-lg-4">
        <div class="p-5 container-md container-lg bg-secondary rounded-2 mt-5 pt-5 pb-5 mb-5"
            style="min-height: 80dvh; height:100%;">
            <?php 
                    require_once("../../database/koneksi.php");
                    $sql = "select * from tbl_barang where restok <= 3 and sisa_stok <= 3";
                    $row = $configs->prepare($sql);
                    $row->execute();
                    $r = $row->rowCount();
                    if($r > 0){
                        echo "
                        <div class='alert alert-warning fs-5 mt-5 mt-lg-5 pt-4 pt-lg-4'>
                            <span class='glyphicon glyphicon-info-sign'></span> Ada <span style='color:red'>$r</span>
                             barang yang Stok tersisa sudah kurang dari 3 items. silahkan pesan lagi !! <span class='pull-right'>
                             <a href='../ui/header.php?page=barang&stok=yes'>Cek Barang <i class='fa fa-angle-double-right'></i></a></span>
                        </div>
                        ";
                    }
                    // Ketika restok dan sisa stok barang sisa 3 maka akan muncul alert dialog untuk kasih informasi bahwa restok dan sisa stok hampir
                    // habis dan harus di isi ulang ....
                ?>
            <h4 class="text-center text-decoration-none fw-normal text-white fs-2"
                style="margin-top: 7rem; padding-top: 8rem;">
                Selamat Datang, <?php echo ucfirst(ucwords($_SESSION['nama_pengguna'])) ?>
            </h4>
        </div>
    </div>
</div>

<?php 
require_once("../ui/footer.php");
?>