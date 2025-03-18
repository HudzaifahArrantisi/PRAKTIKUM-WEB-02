<?php
class Tabung {
    public $jariJari;
    public $tinggi;

    // Constructor
    public function __construct($jariJari, $tinggi) {
        $this->jariJari = $jariJari;
        $this->tinggi = $tinggi;
    }

    // Method menghitung volume
    public function getVolume() {
        return pi() * pow($this->jariJari, 2) * $this->tinggi;
    }

    // Method menghitung luas permukaan
    public function getLuasPermukaan() {
        return 2 * pi() * $this->jariJari * ($this->jariJari + $this->tinggi);
    }

    // Method untuk mencetak informasi
    public function cetak() {
        echo "Tabung dengan jari-jari = $this->jariJari, tinggi = $this->tinggi <br>";
        echo "Volume Tabung = " . $this->getVolume() . "<br>";
        echo "Luas Permukaan Tabung = " . $this->getLuasPermukaan() . "<br>";
    }
}
?>