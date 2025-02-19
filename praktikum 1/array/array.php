<?php
$ar_buah = ["mangga", "semangka", "duren", "apel"];

echo "<h3>buah ke2 adalah $ar_buah[2] :</h3>";
echo "<h3>jumlah buah adalah ".count($ar_buah)."</h3>";
echo '<br> seluruh buah : <ol>';
foreach ($ar_buah as $_buah) {
    echo '<li>'.$_buah.'</li>';
}

echo '</ol>';

$ar_buah[] = "nanas";
unset($ar_buah[1]);

$ar_buah[3] = "apel";

echo '<ul>';
foreach ($ar_buah as $_ak => $_buah) {
    echo '<li>index: '.$_ak.' -nama buah: '.$_buah.'</li>';
}
echo'</ul>';
?>