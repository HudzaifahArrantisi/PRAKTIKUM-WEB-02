<?php
include 'koneksi.php';

// Simpan
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $berat = $_POST['berat'];
    $tinggi = $_POST['tinggi'];
    $tensi = $_POST['tensi'];
    $keterangan = $_POST['keterangan'];
    $pasien_id = $_POST['pasien_id'];
    $dokter_id = $_POST['dokter_id'];
    $conn->query("INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id)
                  VALUES ('$tanggal', '$berat', '$tinggi', '$tensi', '$keterangan', '$pasien_id', '$dokter_id')");
    header("Location: periksa.php");
}

// Hapus
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM periksa WHERE id=" . $_GET['hapus']);
    header("Location: periksa.php");
}

// Ambil data pasien dan paramedik
$pasien = $conn->query("SELECT * FROM pasien");
$dokter = $conn->query("SELECT * FROM paramedik WHERE kategori = 'Dokter'");

// Edit data
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM periksa WHERE id=$id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Periksa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Periksa</h2>
    <form method="post" class="mb-3">
        <input type="date" name="tanggal" value="<?= isset($editData) ? $editData['tanggal'] : '' ?>" class="form-control mb-2" required>
        <input name="berat" value="<?= isset($editData) ? $editData['berat'] : '' ?>" class="form-control mb-2" placeholder="Berat (kg)" required>
        <input name="tinggi" value="<?= isset($editData) ? $editData['tinggi'] : '' ?>" class="form-control mb-2" placeholder="Tinggi (cm)" required>
        <input name="tensi" value="<?= isset($editData) ? $editData['tensi'] : '' ?>" class="form-control mb-2" placeholder="Tensi">
        <textarea name="keterangan" class="form-control mb-2" placeholder="Keterangan"><?= isset($editData) ? $editData['keterangan'] : '' ?></textarea>
        <select name="pasien_id" class="form-control mb-2">
            <option value="">--Pilih Pasien--</option>
            <?php while ($p = $pasien->fetch_assoc()) { ?>
                <option value="<?= $p['id'] ?>" <?= isset($editData) && $editData['pasien_id'] == $p['id'] ? 'selected' : '' ?>><?= $p['nama'] ?></option>
            <?php } ?>
        </select>
        <select name="dokter_id" class="form-control mb-2">
            <option value="">--Pilih Dokter--</option>
            <?php while ($d = $dokter->fetch_assoc()) { ?>
                <option value="<?= $d['id'] ?>" <?= isset($editData) && $editData['dokter_id'] == $d['id'] ? 'selected' : '' ?>><?= $d['nama'] ?></option>
            <?php } ?>
        </select>
        <button name="simpan" class="btn btn-success"><?= isset($editData) ? 'Update' : 'Tambah' ?></button>
        <a href="periksa.php" class="btn btn-secondary">Kembali</a>
    </form>
    <table class="table table-bordered">
        <thead><tr><th>Tanggal</th><th>Pasien</th><th>Dokter</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php
        $data = $conn->query("SELECT * FROM periksa");
        while ($d = $data->fetch_assoc()) {
            echo "<tr>
                <td>{$d['tanggal']}</td>
                <td>" . $conn->query("SELECT nama FROM pasien WHERE id = {$d['pasien_id']}")->fetch_assoc()['nama'] . "</td>
                <td>" . $conn->query("SELECT nama FROM paramedik WHERE id = {$d['dokter_id']}")->fetch_assoc()['nama'] . "</td>
                <td>
                    <a href='?edit={$d['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='?hapus={$d['id']}' class='btn btn-danger btn-sm'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
