<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Barang</title>
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
    <div class="col-md-12 col-lg-12">
        <div class="container-fluid p-1 py-4 bg-secondary" style="min-height: 99dvh; height: 100%;">
            <div class="container-fluid p-1 py-5 bg-light" style="min-height: 90dvh; height: 100%;">
                <div class="panel panel-defualt">
                    <div class="panel-body">
                        <div class="fs-5 fw-normal panel-title">
                            <i class="fa fa-briefcase"></i>
                            <span>Data Barang</span>
                        </div>
                        <div class="breadcumb">
                            <div class="d-flex justify-content-end align-items-end flex-wrap">
                                <li class="breadcrumb breadcrumb-item">
                                    <a href="../dashboard/index.php"
                                        class="text-decoration-none text-primary">Beranda</a>
                                </li>
                                <li class="breadcrumb breadcrumb-item">
                                    <a href="../ui/header.php?page=barang"
                                        class="text-decoration-none text-primary">Data Barang</a>
                                </li>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-1 justify-content-between align-items-start flex-wrap">
                    <?php 
                        if(isset($_GET['edit'])){
                            $id = $_GET['edit'];
                            $table = "tbl_barang";
                            $sql = "SELECT * FROM $table WHERE id_barang = ?";
                            $row = $configs->prepare($sql);
                            $row->execute(array($id));
                            $hasil = $row->fetchAll();
                        foreach ($hasil as $isi) {
                    ?>
                    <div class="card" style="min-width: 22.5%; width:325px;">
                        <div class="card-header">
                            <div class="card-headef-form">
                                <h3 class="card-title fs-5 fw-normal">
                                    <i class="fa fa-edit"></i>
                                    Edit Barang
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="../ui/header.php?act=edit-barang" enctype="multipart/form-data" method="post">
                                <table class="table table-striped">
                                    <input type="hidden" name="id_barang" value="<?=$isi['id_barang']?>">
                                    <tr>
                                        <td class="fs-6">Nama Barang</td>
                                        <td>
                                            <input type="text" name="nama_barang" value="<?=$isi['nama_barang']?>"
                                                class="form-control" placeholder="masukkan nama barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Kategori Barang</td>
                                        <td>
                                            <select name="id_kategori" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php 
                                                    $hasil = $lihat->KategoriLihat();
                                                    foreach ($hasil as $row) {
                                                ?>
                                                <option <?php if($row['id_kategori'] == $isi['id_kategori']){?>
                                                    value="<?=$row['id_kategori']?>" selected <?php } ?>>
                                                    <?php echo $row['nama_kategori'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Merk Barang</td>
                                        <td>
                                            <input type="text" name="merk_barang" value="<?=$isi["merk_barang"]?>"
                                                class="form-control" placeholder="masukkan merk barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Harga Beli</td>
                                        <td>
                                            <input type="number" name="harga_beli" value="<?=$isi["harga_beli"]?>"
                                                class="form-control" placeholder="masukkan harga beli barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Harga Jual</td>
                                        <td>
                                            <input type="number" name="harga_jual" value="<?=$isi["harga_jual"]?>"
                                                class="form-control" placeholder="masukkan harga jual barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Stok Awal</td>
                                        <td>
                                            <input type="number" name="stok_awal" value="<?=$isi["stok_awal"]?>"
                                                class="form-control" placeholder="masukkan stok awal barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Sisa Stok</td>
                                        <td>
                                            <input type="number" name="sisa_stok" value="<?=$isi["sisa_stok"]?>"
                                                class="form-control" placeholder="masukkan sisa stok barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Restok</td>
                                        <td>
                                            <input type="number" name="restok" class="form-control"
                                                placeholder="masukkan restok barang" value="<?=$isi['restok']?>"
                                                readonly required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Satuan Barang</td>
                                        <td>
                                            <select name="satuan" class="form-control" required>
                                                <option value="">Pilih Satuan</option>
                                                <option <?php if($isi['satuan'] == "pcs"){?> value="pcs" selected
                                                    <?php } ?>><?php echo $isi['satuan']; ?></option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">File Foto</td>
                                        <td>
                                            <input type="file" accept="image/*" value="<?=$isi['FileImage']?>"
                                                name="FileImage" class="form-control" placeholder="" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Tanggal Input</td>
                                        <td>
                                            <input type="text" name="tanggal_input" value="<?php echo date('d/m/Y')?>"
                                                class="form-control" placeholder="" required>
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <p class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i>
                                            <span>Simpan Barang</span>
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fa fa-eraser"></i>
                                            <span>Hapus Barang</span>
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <?php        
                        }else{
                    ?>
                    <div class="card" style="min-width: 22.5%; width:325px;">
                        <div class="card-header">
                            <div class="card-headef-form">
                                <h3 class="card-title fs-5 fw-normal">
                                    <i class="fa fa-plus"></i>
                                    Tambah Barang
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="../ui/header.php?act=tambah-barang" enctype="multipart/form-data"
                                method="post">
                                <table class="table table-striped">
                                    <tr>
                                        <td class="fs-6">Nama Barang</td>
                                        <td>
                                            <input type="text" name="nama_barang" class="form-control"
                                                placeholder="masukkan nama barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Kategori Barang</td>
                                        <td>
                                            <select name="id_kategori" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php 
                                                    $hasil = $lihat -> KategoriLihat();
                                                    foreach ($hasil as $isi) {
                                                ?>
                                                <option value="<?=$isi['id_kategori']?>">
                                                    <?php echo $isi['nama_kategori'] ?></option>
                                                <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Merk Barang</td>
                                        <td>
                                            <input type="text" name="merk_barang" class="form-control"
                                                placeholder="masukkan merk barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Harga Beli</td>
                                        <td>
                                            <input type="number" name="harga_beli" class="form-control"
                                                placeholder="masukkan harga beli barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Harga Jual</td>
                                        <td>
                                            <input type="number" name="harga_jual" class="form-control"
                                                placeholder="masukkan harga jual barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Stok Awal</td>
                                        <td>
                                            <input type="number" name="stok_awal" class="form-control"
                                                placeholder="masukkan stok awal barang" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Satuan Barang</td>
                                        <td>
                                            <select name="satuan" class="form-control" required>
                                                <option value="">Pilih Satuan</option>
                                                <option value="pcs">Pcs</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">File Foto</td>
                                        <td>
                                            <input type="file" name="FileImage" class="form-control" placeholder=""
                                                required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fs-6">Tanggal Input</td>
                                        <td>
                                            <input type="text" name="tanggal_input" value="<?php echo date('d/m/Y')?>"
                                                class="form-control" placeholder="" required>
                                        </td>
                                    </tr>
                                </table>
                                <div class="card-footer">
                                    <p class="text-end">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-save"></i>
                                            <span>Simpan Barang</span>
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fa fa-eraser"></i>
                                            <span>Hapus Barang</span>
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <div class="card" style="min-width: 74.2%; width:786px;">
                        <div class="card-header">
                            <h4 class="card-title fs-5"><i class="fa fa-briefcase"></i> Data Barang</h4>
                            <div class="card-headef-form">
                                <a href="../ui/header.php?page=barang" class="btn btn-outline-primary">
                                    <i class="fa fa-refresh"></i>
                                    <span>Refresh Halaman</span>
                                </a>
                                <a href="../ui/header.php?page=barang&sisa=yes" class="btn btn-outline-warning">
                                    <i class="fa fa-list"></i>
                                    <span>Stok Barang</span>
                                </a>
                                <p class="text-end">
                                    <a href="../barang/excel.php" class="btn btn-warning">
                                        <i class="fa fa-file-import"></i>
                                        <span>Impor Data Barang</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive-lg table-responsive-md">
                                <table class="table table-striped" id="example1">
                                    <thead>
                                        <tr>
                                            <th class="fs-6 fw-normal">No</th>
                                            <th class="fs-6 fw-normal">Nama Barang</th>
                                            <th class="fs-6 fw-normal">Kategori</th>
                                            <th class="fs-6 fw-normal">Merk Barang</th>
                                            <th class="fs-6 fw-normal">Harga Beli</th>
                                            <th class="fs-6 fw-normal">Harga Jual</th>
                                            <th class="fs-6 fw-normal">Stok Awal</th>
                                            <th class="fs-6 fw-normal">Sisa</th>
                                            <th class="fs-6 fw-normal">Restok</th>
                                            <th class="fs-6 fw-normal">Satuan</th>
                                            <th class="fs-6 fw-normal">Gambar</th>
                                            <th class="fs-6 fw-normal">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $stok = 0;
                                            $hb = 0;
                                            $hj = 0;
                                            $no = 1;

                                            if(!empty($_GET['sisa']=="yes")){
                                                $hasil = $lihat -> SisaBarang();
                                                $hasil = $lihat -> BarangRestok();
                                            }else{
                                                $hasil = $lihat -> BarangLihat();
                                            }

                                            foreach ($hasil as $isi) {
                                        ?>
                                        <tr>
                                            <td class="text-start fw-normal"><?php echo $no; ?></td>
                                            <td class="text-start fw-normal"><?php echo $isi["nama_barang"]; ?>
                                            </td>
                                            <td class="text-start fw-normal">
                                                <?php echo $isi["nama_kategori"]; ?></td>
                                            <td class="text-start fw-normal"><?php echo $isi["merk_barang"]; ?>
                                            </td>
                                            <td class="text-start fw-normal">
                                                <?php echo "Rp. ".number_format($isi["harga_beli"]).",-"; ?></td>
                                            <td class="text-start fw-normal">
                                                <?php echo "Rp. ".number_format($isi["harga_jual"]).",-"; ?></td>
                                            <td class="text-start fw-normal"><?php echo $isi["stok_awal"]; ?></td>
                                            <?php 
                                                if($isi['sisa_stok'] <= '3'){
                                            ?>
                                            <td>
                                                <form action="../ui/header.php?act=edit-sisa" method="post"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="id_barang"
                                                        value="<?php echo $isi['id_barang'];?>" class="form-control">
                                                    <input type="number" name="sisa_stok" class="form-control" required>
                                                    <button class="btn btn-secondary" type="submit">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                    <a href="../ui/header.php?act=hapus-barang&id_barang=<?=$isi["id_barang"]?>"
                                                        class="btn btn-danger"
                                                        onclick="javascript:return confirm('Apakah anda ingin menghapus data ini ?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </form>
                                            </td>
                                            <?php }else if($isi['sisa_stok'] == '0'){ 
                                            ?>
                                            <button class="btn btn-danger">Habis</button>
                                            <?php 
                                                }else{ 
                                            ?>
                                            <td class="text-start fw-normal"><?php echo $isi["sisa_stok"]; ?></td>
                                            <?php 
                                                } 
                                            ?>
                                            <?php 
                                                if($isi["restok"] <= '3'){
                                            ?>
                                            <td>
                                                <form action="../ui/header.php?act=edit-restok"
                                                    enctype="multipart/form-data" method="post">
                                                    <input type="hidden" name="id_barang"
                                                        value="<?php echo $isi['id_barang'];?>" class="form-control">
                                                    <input type="number" name="restok" class="form-control" required>
                                                    <button class="btn btn-secondary" type="submit">
                                                        <i class="fa fa-save"></i>
                                                    </button>
                                                    <a href="../ui/header.php?act=hapus-barang&id_barang=<?=$isi["id_barang"]?>"
                                                        class="btn btn-danger"
                                                        onclick="javascript:return confirm('Apakah anda ingin menghapus data ini ?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </form>
                                                <?php
                                                }elseif($isi["restok"] == '0'){
                                            ?>
                                                <button class="btn btn-danger">Habis</button>
                                                <?php
                                                }else{
                                            ?>
                                            <td class="text-start fw-normal"><?php echo $isi["restok"]; ?></td>
                                            <?php
                                                }
                                            ?>
                                            <td class="text-start fw-normal">
                                                <?php echo $isi["satuan"]; ?></td>
                                            <td class="text-md-start fs-6 fw-normal">
                                                <img src="../../../assets/image/<?=$isi["FileImage"]?>"
                                                    alt="<?=$isi["FileImage"]?>" width="32" class="img-rounded">
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="" role="button" class="dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-list">
                                                            <a href="../ui/header.php?page=barang&edit=<?=$isi['id_barang']?>"
                                                                class="dropdown-item"
                                                                onclick="javascript:return confirm('Apakah anda ingin melihat data ini ?');">
                                                                <i class="fa fa-edit"></i>
                                                                <span>Edit Barang</span>
                                                            </a>
                                                        </li>
                                                        <li class="dropdown-list">
                                                            <a href="../ui/header.php?act=hapus-barang&id_barang=<?=$isi["id_barang"]?>"
                                                                class="dropdown-item"
                                                                onclick="javascript:return confirm('Apakah anda ingin menghapus data ini ?');">
                                                                <i class="fa fa-trash"></i>
                                                                <span>Hapus Barang</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                        $hb += $isi["stok_awal"] * $isi["harga_beli"];
                                        $hj += $isi["stok_awal"] * $isi["harga_jual"];
                                        $stok += $isi["stok_awal"];
                                        $sisa += $isi["sisa_stok"];
                                        $restok += $isi["restok"];
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <th colspan="4" class="bg-success text-white">Total Semua</th>
                                        <th class="text-start"><?php echo "Rp. ".number_format($hb).",-" ?></th>
                                        <th class="text-start"><?php echo "Rp. ".number_format($hj).",-" ?></th>
                                        <th class="text-start"><?php echo number_format($stok) ?></th>
                                        <th class="text-start"><?php echo number_format($sisa) ?></th>
                                        <th class="text-start"><?php echo number_format($restok) ?></th>
                                        <th colspan="3" class="bg-secondary"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
        require_once("../ui/footer.php");
    ?>