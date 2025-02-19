<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Sederhana</title>
</head>
<body>
    <h2>Kalkulator Sederhana</h2>
    <form method="post" action="">
        <label for="angka1">Angka Pertama:</label>
        <input type="number" name="angka1" id="angka1" required>
        <br><br>
        
        <label for="angka2">Angka Kedua:</label>
        <input type="number" name="angka2" id="angka2" required>
        <br><br>
        
        <label for="operasi">Operasi:</label>
        <select name="operasi" id="operasi" required>
            <option value="tambah">+ (Tambah)</option>
            <option value="kurang">- (Kurang)</option>
            <option value="kali">* (Kali)</option>
            <option value="bagi">/ (Bagi)</option>
        </select>
        <br><br>
        
        <button type="submit" name="hitung">Hitung</button>
    </form>

    <?php
    if (isset($_GET['hitung'])) {
        $angka1 = $_GET['angka1'];
        $angka2 = $_GET['angka2'];
        $operasi = $_GET['operasi'];
        $hasil = 0;

        switch ($operasi) {
            case 'tambah':
                $hasil = $angka1 + $angka2;
                break;
            case 'kurang':
                $hasil = $angka1 - $angka2;
                break;
            case 'kali':
                $hasil = $angka1 * $angka2;
                break;
            case 'bagi':
                if ($angka2 != 0) {
                    $hasil = $angka1 / $angka2;
                } else {
                    echo "<p style='color: red;'>Error: gaboleh di bagi nol.</p>";
                    exit;
                }
                break;
            default:
                echo "<p style='color: red;'>Error: ga palidasi.</p>";
                exit;
        }

        echo "<h3>Hasil: $hasil</h3>";

        define('PI', 3.14);
    $jari_jari = 8;
    $luas_pi * $jari_jari * $jari_jari;
    $kll = 2 * PI * $jari_jari;
    }
    ?>
</body>
</html>