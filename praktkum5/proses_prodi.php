<?php
require 'dbkoneksi.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;
$nama_prodi = isset($_POST['nama_prodi']) ? $_POST['nama_prodi'] : null;

if ($action == 'delete') {
    // Hapus data prodi
    $stmt = $dbh->prepare("DELETE FROM prodi WHERE id = ?");
    $stmt->execute([$_GET['id']]);
} else {
    if ($id) {
        // Update data prodi
        $stmt = $dbh->prepare("UPDATE prodi SET nama_prodi = ? WHERE id = ?");
        $stmt->execute([$nama_prodi, $id]);
    } else {
        // Tambah data prodi
        $stmt = $dbh->prepare("INSERT INTO prodi (nama_prodi) VALUES (?)");
        $stmt->execute([$nama_prodi]);
    }
}

header("Location: list_prodi.php");
exit();