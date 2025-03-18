<?php 
/**
 * class Lingkaran
 */
class Lingkaran {
  /**
   * property jari-jari
   * @var float
   */
  public $jari;
  /**
   * property PHI
   * @var float
   */
  public const PHI = 3.14;

    /**
     * constructor
     * @param float $jari
     */
  public function __construct($jari) {
    $this->jari = $jari;
  }

  /**
   * method menghitung luas lingkaran
   * @return float
   */
  public function getLuas(){
    $luas = self::PHI * $this->jari * $this->jari;
    return $luas;
  }

  /**
   * method menghitung keliling lingkaran
   * @return float
   */
  public function getKeliling(){
    $keliling = 2.0 * self::PHI * $this->jari;
    return $keliling;
  }

  public function cetak(){
    echo "Lingkaran dengan jari-jari ". $this->jari;
    echo "<br>Luas = ". $this->getLuas();
    echo "<br>Keliling = ". $this->getKeliling();
  }

}