<?php
$siswa = ["budi", "susi", "agus", "dewi"];
 echo "array awal :\n";
    print_r($siswa);
$orang_terakhir = array_pop($siswa);

echo "<br>elemen yang akan  di hapus" .$orang_terakhir. "";

echo "<br>array setelah di hapus : <br>";
print_r($siswa);

?>