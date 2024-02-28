<?php 
if($_SESSION["user_level"] == ""){
    header("location:../index.php");
    exit();
}
?>

<?php 
if($_SESSION["user_level"] == "admin"){
?>
<div class="col-md-12 col-lg-12">
    <nav class="navbar navbar-expand-lg fixed-top bg-body-secondary">
        <div class="container-fluid">
            <a href="../dashboard/index.php" class="navbar-brand">
                Dashboard Penyimpanan Barang
            </a>

            <button type="button" class="navbar-toggler" data-bs-target="#navbarToggler" data-bs-toggle="collapse"
                aria-controls="navbarToggler" aria-hidden="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav mx-3 ms-auto mb-lg-0 mb-2">
                    <li class="nav-item">
                        <a aria-current="page" href="../dashboard/index.php" class="hover nav-link">
                            Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a aria-current="page" href="../ui/header.php?page=kategori" class="hover nav-link">
                            Kategori Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a aria-current="page" href="../ui/header.php?page=barang" class="hover nav-link">
                            Data Barang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a aria-current="page"
                            onclick="javascript:return confirm('Apakah anda ingin keluar dari website ini ?')"
                            href="../ui/header.php?aksi=keluar" class="hover nav-link">
                            Log Out
                        </a>
                    </li>
                    <li class="nav-item list-unstyled mx-5">
                        <div class="dropdown">
                            <a href="" role="button" class="hover nav-link dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php echo $_SESSION['email_pengguna'] ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-item bg-light">
                                    <span class="dropdown-item-text text-decoration-none text-dark fw-normal">
                                        nama : <?php echo $_SESSION['nama_pengguna'] ?>
                                    </span>
                                </li>
                                <li class="dropdown-item bg-light">
                                    <span class="dropdown-item-text text-decoration-none text-dark fw-normal">
                                        jabatan : <?php echo $_SESSION['user_level'] ?>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?php
}else{
    header("location:../index.php");
    exit();
}
?>