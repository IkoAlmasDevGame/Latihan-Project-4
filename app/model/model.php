<?php 
namespace model;

class View {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    /* Barang */ 

    public function TambahBarang(){
        $nama = $_POST['nama_barang'];
        $kategori = $_POST['id_kategori'];
        $merk = $_POST['merk_barang'];
        $beli = $_POST['harga_beli'];
        $jual = $_POST['harga_jual'];
        $stok = $_POST['stok_awal'];
        $restok = 100;
        $sisa = $stok - $restok;
        $satuan = $_POST['satuan'];
        /* Gambar */
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif');
        $image = $_FILES['FileImage']['name'];
        $x_foto = explode('.', $image);
        $ekstensi_foto = strtolower(end($x_foto));
        $ukuran_foto = $_FILES['FileImage']['size'];
        $file_tmp_foto = $_FILES['FileImage']['tmp_name']; 
        /* ----- */
        $tanggal = $_POST['tanggal_input'];

        if(in_array($ekstensi_foto, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_foto < 10440070){
                $barang = array($nama,$kategori,$merk,$beli,$jual,$stok,$sisa,$restok,$satuan,$image,$tanggal);
                move_uploaded_file($file_tmp_foto, "../../../assets/image/".$image);
                $table = "tbl_barang";
                $sqlTable = "INSERT INTO $table (nama_barang,id_kategori,merk_barang,harga_beli,harga_jual,stok_awal,sisa_stok,restok,satuan,FileImage,tanggal_input) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                $rowTable = $this->db->prepare($sqlTable);
                $rowTable->execute($barang);
                header("location:../ui/header.php?page=barang");
            }else{
                echo "GAGAL MENGUPLOAD FILE FOTO";
            }
        }else{
            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
    }

    public function EditBarang(){
        $id = $_POST['id_barang'];
        $nama = $_POST['nama_barang'];
        $kategori = $_POST['id_kategori'];
        $merk = $_POST['merk_barang'];
        $beli = $_POST['harga_beli'];
        $jual = $_POST['harga_jual'];
        $stok = $_POST['stok_awal'];
        $restok = $_POST['restok'];
        $sisa = $_POST['sisa_stok'];
        $satuan = $_POST['satuan'];
        /* Gambar */
        $ekstensi_diperbolehkan_foto = array('png', 'jpg', 'jpeg', 'jfif');
        $image = $_FILES['FileImage']['name'];
        $x_foto = explode('.', $image);
        $ekstensi_foto = strtolower(end($x_foto));
        $ukuran_foto = $_FILES['FileImage']['size'];
        $file_tmp_foto = $_FILES['FileImage']['tmp_name']; 
        /* ----- */
        $tanggal = $_POST['tanggal_input'];

        if(in_array($ekstensi_foto, $ekstensi_diperbolehkan_foto) === true){
            if($ukuran_foto < 10440070){
                $barang = array($nama,$kategori,$merk,$beli,$jual,$stok,$sisa,$restok,$satuan,$image,$tanggal,$id);
                move_uploaded_file($file_tmp_foto, "../../../assets/image/".$image);
                $table = "tbl_barang";
                $sqlTable = "UPDATE $table SET nama_barang = ?, id_kategori = ?, merk_barang = ?, harga_beli = ?, harga_jual = ?, stok_awal = ?, sisa_stok = ?, restok = ?, satuan = ?, FileImage = ?, tanggal_input = ? WHERE id_barang = ?";
                $rowTable = $this->db->prepare($sqlTable);
                $rowTable->execute($barang);
                header("location:../ui/header.php?page=barang");
            }else{
                echo "GAGAL MENGUPLOAD FILE FOTO";
            }
        }else{
            echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN";
        }
    }

    public function editRestok(){
        $table = "tbl_barang";
        $id = $_POST['id_barang'];
        $restok = $_POST['restok'];

        $sql = "SELECT * FROM $table WHERE id_barang = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        $total = $hasil['sisa_stok'] - $restok;
        $rowTable = $this->db->prepare("UPDATE $table SET stok_awal='$hasil[stok_awal]', sisa_stok='$total', restok='$restok' WHERE id_barang='$id'");
        $rowTable->execute();
        header("location:../ui/header.php?page=barang");
    }

    public function HapusBarang(){
        $table = "tbl_barang";
        $id = $_POST['id_barang'];
        $sql = "DELETE FROM $table WHERE id_barang = ?";
        $row = $this->db->prepapre($sql);
        $row->execute(array($id));
        header("location:../ui/header.php?page=barang");
    }

    public function editSisa(){
        $table = "tbl_barang";
        $id = $_POST['id_barang'];
        $sisa = $_POST['sisa_stok'];

        $sql = "SELECT * FROM $table WHERE id_barang = ?";
        $row = $this->db->prepare($sql);
        $row->execute(array($id));
        $hasil = $row->fetch();
        $rowTable = $this->db->prepare("UPDATE $table SET stok_awal='$hasil[stok_awal]', sisa_stok='$sisa', restok='$hasil[restok]' WHERE id_barang='$id'");
        $rowTable->execute();
        header("location:../ui/header.php?page=barang");
    }

    public function LihatBarang(){
        $table = "tbl_barang";
        $sqlTable = "SELECT tbl_barang.*, tbl_kategori.id_kategori, tbl_kategori.nama_kategori FROM $table 
        inner join tbl_kategori on tbl_barang.id_kategori = tbl_kategori.id_kategori ORDER BY id_barang ASC";
        $rowTable = $this->db->prepare($sqlTable);
        $rowTable->execute();
        return $rowTable;
    }

    public function SisaStok(){
        $table = "tbl_barang";
        $sqlTable = "SELECT tbl_barang.*, tbl_kategori.id_kategori, tbl_kategori.nama_kategori from $table 
        inner join tbl_kategori on tbl_barang.id_kategori = tbl_kategori.id_kategori where sisa_stok <= 3 ORDER BY id_barang ASC";
        $rowTable = $this->db->prepare($sqlTable);
        $rowTable->execute();
        return $rowTable;
    }
    
    public function RestokBarang(){
        $table = "tbl_barang";
        $sqlTable = "SELECT tbl_barang.*, tbl_kategori.id_kategori, tbl_kategori.nama_kategori from $table 
        inner join tbl_kategori on tbl_barang.id_kategori = tbl_kategori.id_kategori where restok <= 3 ORDER BY id_barang ASC";
        $rowTable = $this->db->prepare($sqlTable);
        $rowTable->execute();
        return $rowTable;
    }

    /* Kategori */ 
    public function TambahKategori(){
        $kategori = $_POST['nama_kategori'];
        $kat = array($kategori);
        $table = "tbl_kategori";
        $sqlTable = "INSERT INTO $table (nama_kategori) VALUES (?)";
        $rowTable = $this->db->prepare($sqlTable);
        $rowTable->execute($kat);
        header("location:../ui/header.php?page=kategori");
    }

    public function LihatKategori(){
        $table = "tbl_kategori";
        $sqlTable = "SELECT * FROM $table ORDER BY id_kategori ASC";
        $rowTable = $this->db->prepare($sqlTable);
        $rowTable->execute();
        return $rowTable;
    }

    public function EditKategori(){
        $id = $_POST['id_kategori'];
        $kategori = $_POST['nama_kategori'];
        $kat = array($kategori,$id);
        $table = "tbl_kategori";
        $sqlTable = "UPDATE $table SET nama_kategori = ? WHERE id_kategori = ?";
        $rowTable = $this->db->prepare($sqlTable);
        $rowTable->execute($kat);
        header("location:../ui/header.php?page=kategori");
    }

    public function HapusKategori(){
        $table = "tbl_kategori";
        $id = $_POST['id_kategori'];
        $sql = "DELETE FROM $table WHERE id_kategori = ?";
        $row = $this->db->prepapre($sql);
        $row->execute(array($id));
        header("location:../ui/header.php?page=kategori");
    }

}
?>