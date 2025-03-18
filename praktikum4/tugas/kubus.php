<?php
class Kubus {
    public $sisi;

    // Constructor
    public function __construct($sisi) {
        $this->sisi = $sisi;
    }

    // Method menghitung volume
    public function getVolume() {
        return pow($this->sisi, 3);
    }

    // Method menghitung luas permukaan
    public function getLuasPermukaan() {
        return 6 * pow($this->sisi, 2);
    }

    // Method untuk mencetak informasi
    public function cetak() {
        echo "Kubus dengan sisi = $this->sisi <br>";
        echo "Volume Kubus = " . $this->getVolume() . "<br>";
        echo "Luas Permukaan Kubus = " . $this->getLuasPermukaan() . "<br>";
    }
}
?>