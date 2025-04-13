<?php
require 'dbkoneksi.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nama_prodi = '';

if ($id) {
    // Ambil data prodi untuk diedit
    $stmt = $dbh->prepare("SELECT * FROM prodi WHERE id = ?");
    $stmt->execute([$id]);
    $prodi = $stmt->fetch();
    $nama_prodi = $prodi['nama_prodi'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Prodi</title>
</head>
<body>
    <h1><?= $id ? 'Edit' : 'Tambah'; ?> Prodi</h1>
    <form action="proses_prodi.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <label for="nama_prodi">Nama Prodi:</label>
        <input type="text" id="nama_prodi" name="nama_prodi" value="<?= $nama_prodi; ?>" required>
        <button type="submit">Simpan</button>
    </form>
    <a href="list_prodi.php">Kembali ke Daftar Prodi</a>
</body>
</html>