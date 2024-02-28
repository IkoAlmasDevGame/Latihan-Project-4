<?php 
namespace controller;
use model\View;

class Controller {
    protected $sdb;
    public function __construct($db){
        $this->sdb = new view($db);
    }

    /* Barang */
    public function BarangLihat(){
        $rowTable = $this->sdb->LihatBarang();
        $hasil = $rowTable->fetchAll();
        return $hasil;
    }

    public function SisaBarang(){
        $rowTable = $this->sdb->SisaStok();
        $hasil = $rowTable->fetchAll();
        return $hasil;
    }

    public function BarangRestok(){
        $rowTable = $this->sdb->RestokBarang();
        $hasil = $rowTable->fetchAll();
        return $hasil;
    }

    /* Kategori */
    public function KategoriLihat(){
        $rowTable = $this->sdb->LihatKategori();
        $hasil = $rowTable->fetchAll();
        return $hasil;
    }
}
?>