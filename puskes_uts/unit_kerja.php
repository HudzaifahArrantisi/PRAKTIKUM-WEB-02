<?php include 'koneksi.php';

// Simpan
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $ket = $_POST['keterangan'];
    $conn->query("INSERT INTO unit_kerja (kode_unit, nama_unit, keterangan) VALUES ('$kode','$nama','$ket')");
    header("Location: unit_kerja.php");
}

// Hapus
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM unit_kerja WHERE id=" . $_GET['hapus']);
    header("Location: unit_kerja.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Unit Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Unit Kerja</h2>
    <form method="post" class="mb-3">
        <input name="kode" class="form-control mb-2" placeholder="Kode Unit" required>
        <input name="nama" class="form-control mb-2" placeholder="Nama
