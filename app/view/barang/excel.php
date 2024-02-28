<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Data Barang To Excel</title>
    <?php 
        require_once("../ui/header.php");
        require_once("../ui/footer.php");    
        require_once("../../database/koneksi.php");    

        if($_SESSION['user_level'] == "admin"){
        }else{
            header("location:../ui/header.php?aksi=keluar");
        }
        
        header("Content-Type: application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=data-laporan-".date('Y-m-d').".xls");  //File name extension was wrong
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private",false);
    ?>
</head>

<body>
    <div class="col-md-12 col-lg-12">
        <div class="container-fluid">
            <div class="row">
                <table class="table-striped">
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
                            <th class="fs-6 fw-normal">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $stok = 0;
                        $hb = 0;
                        $hj = 0;
                        $no = 1;
                        
                        $hasil = $lihat -> BarangLihat();
                        foreach ($hasil as $isi) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["nama_barang"]; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["nama_kategori"]; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["merk_barang"]; ?></td>
                            <td class="text-start fw-normal">
                                <?php echo "Rp. ".number_format($isi["harga_beli"]).",-"; ?>
                            </td>
                            <td class="text-start fw-normal">
                                <?php echo "Rp. ".number_format($isi["harga_jual"]).",-"; ?>
                            </td>
                            <td class="text-start fw-normal"><?php echo $isi["stok_awal"]; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["sisa_stok"]; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["restok"]; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["satuan"]; ?></td>
                            <td class="text-start fw-normal"><?php echo $isi["tanggal_input"]; ?></td>
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
</body>

</html>