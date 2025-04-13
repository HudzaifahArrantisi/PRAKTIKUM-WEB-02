<?php
require 'dbkoneksi.php';

// Ambil data prodi dari database
$stmt = $dbh->query("SELECT * FROM prodi");
$prodi = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Prodi</title>
</head>
<body>
    <h1>Daftar Prodi</h1>
    <a href="form_prodi.php">Tambah Prodi</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prodi as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama_prodi']; ?></td>
                    <td>
                        <a href="form_prodi.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="proses_prodi.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>