<?php
include 'koneksi.php';

// Proses simpan
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $kec_id = $_POST['kec_id'];
    $conn->query("INSERT INTO kelurahan (nama_kelurahan, kec_id) VALUES ('$nama', '$kec_id')");
    header("Location: kelurahan.php");
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM kelurahan WHERE id = $id");
    header("Location: kelurahan.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kelurahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Kelurahan</h2>
    <form method="post" class="mb-3">
        <input type="text" name="nama" placeholder="Nama Kelurahan" required class="form-control mb-2">
        <input type="number" name="kec_id" placeholder="ID Kecamatan" class="form-control mb-2">
        <button type="submit" name="simpan" class="btn btn-success">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
    <table class="table table-bordered table-striped">
        <thead><tr><th>ID</th><th>Nama Kelurahan</th><th>Kec ID</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php
        $data = $conn->query("SELECT * FROM kelurahan");
        while ($d = $data->fetch_assoc()) {
            echo "<tr>
                <td>{$d['id']}</td>
                <td>{$d['nama_kelurahan']}</td>
                <td>{$d['kec_id']}</td>
                <td><a href='?hapus={$d['id']}' class='btn btn-danger btn-sm'>Hapus</a></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
