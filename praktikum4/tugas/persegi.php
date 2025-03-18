<?php
// class PersegiPanjang
class PersegiPanjang{
    public $panjang;
    public $lebar;

    // constructor
    function __construct($panjang, $lebar){
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    // method menghitung luas
    function getluas(){
        $luaspp = $this->panjang * $this->lebar;
        return $luaspp;
    }
// method menghitung keliling
    function getkeliling(){
        $kelilingpp = 2 * ($this->panjang + $this->lebar);
        return $kelilingpp;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class=section>
        <h2>contoh pneggunaan persegi</h2>
        <?php
        $pp = new PersegiPanjang(10, 8);
        echo "Panjang = $pp->panjang <br>";
        echo "Lebar= $pp->lebar <br>";
        echo '<hr>';
        echo  "luas" . $pp->getluas() ."<br>";
        echo  "keliling".$pp->getkeliling(). '<br>';    
        ?>
    </div>


    
</body>
</html>