<?php
class Bola {
    public $jariJari;

    // Constructor
    public function __construct($jariJari) {
        $this->jariJari = $jariJari;
    }

    // Method menghitung volume
    public function getVolume() {
        return (4/3) * pi() * pow($this->jariJari, 3);
    }

    // Method menghitung luas permukaan
    public function getLuasPermukaan() {
        return 4 * pi() * pow($this->jariJari, 2);
    }

    // Method untuk mencetak informasi
    public function cetak() {
        echo "Bola dengan jari-jari = $this->jariJari <br>";
        echo "Volume Bola = " . $this->getVolume() . "<br>";
        echo "Luas Permukaan Bola = " . $this->getLuasPermukaan() . "<br>";
    }
}
?>