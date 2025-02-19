<?php
$komponen = ["cpu", "ram", "vga", "psu"];
array_push($komponen, "ssd", "hdd");

echo "array setelah di tambah : <br>";
foreach ($komponen as $_komp) {
    echo $_komp . "<br>";

}
?>