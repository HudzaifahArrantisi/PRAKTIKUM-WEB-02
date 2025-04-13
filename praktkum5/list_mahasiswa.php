<?php
require 'dbkoneksi.php';

// Ambil data mahasiswa dari database
$stmt = $dbh->query("SELECT * FROM mahasiswa");
$mahasiswa = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa</title>
</head>
<body>
    <h1>Daftar Mahasiswa</h1>
    <a href="form_mahasiswa.php">Tambah Mahasiswa</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Prodi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mahasiswa as $row): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['prodi_id']; ?></td>
                    <td>
                        <a href="form_mahasiswa.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="proses_mahasiswa.php?action=delete&id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>