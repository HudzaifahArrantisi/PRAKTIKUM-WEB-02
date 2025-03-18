<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangun Ruang 3D</title>
</head>
<body>
    <h1>Contoh Bangun Ruang 3D</h1>

    <?php
    require_once 'Balok.php';
    require_once 'Kubus.php';
    require_once 'Bola.php';
    require_once 'Tabung.php';

    echo "<h2>Balok</h2>";
    $balok = new Balok(10, 5, 4);
    $balok->cetak();
    echo "<hr>";

    echo "<h2>Kubus</h2>";
    $kubus = new Kubus(6);
    $kubus->cetak();
    echo "<hr>";

    echo "<h2>Bola</h2>";
    $bola = new Bola(7);
    $bola->cetak();
    echo "<hr>";

    echo "<h2>Tabung</h2>";
    $tabung = new Tabung(5, 10);
    $tabung->cetak();
    echo "<hr>";
    ?>
</body>
</html>