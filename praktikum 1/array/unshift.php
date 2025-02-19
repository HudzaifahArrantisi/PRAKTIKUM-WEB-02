<?php
$laptop = ["asus", "acer", "lenovo", "hp"];
array_unshift($laptop, "dell", "toshiba");  
echo "array setelah di tambah :";
foreach ($laptop as $p) {
    echo "<br> . $p;";
}
?>