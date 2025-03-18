<?php
class Balok {
    public $panjang;
    public $lebar;
    public $tinggi;

    // Constructor
    public function __construct($panjang, $lebar, $tinggi) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
        $this->tinggi = $tinggi;
    }

    // Method menghitung volume
    public function getVolume() {
        return $this->panjang * $this->lebar * $this->tinggi;
    }

    // Method menghitung luas permukaan
    public function getLuasPermukaan() {
        return 2 * ($this->panjang * $this->lebar + $this->panjang * $this->tinggi + $this->lebar * $this->tinggi);
    }

    // Method untuk mencetak informasi
    public function cetak() {
        echo "Balok dengan panjang = $this->panjang, lebar = $this->lebar, tinggi = $this->tinggi <br>";
        echo "Volume Balok = " . $this->getVolume() . "<br>";
        echo "Luas Permukaan Balok = " . $this->getLuasPermukaan() . "<br>";
    }
}
?>