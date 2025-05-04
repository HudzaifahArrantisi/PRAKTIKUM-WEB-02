<?php
include 'koneksi.php';

// Proses simpan
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $gender = $_POST['gender'];
    $tmp = $_POST['tmp_lahir'];
    $tgl = $_POST['tgl_lahir'];
    $kategori = $_POST['kategori'];
    $telpon = $_POST['telpon'];
    $alamat = $_POST['alamat'];
    $unit_id = $_POST['unitkerja_id'];
    $conn->query("INSERT INTO paramedik (nama,gender,tmp_lahir,tgl_lahir,kategori,telpon,alamat,unitkerja_id) 
                  VALUES ('$nama', '$gender', '$tmp', '$tgl', '$kategori', '$telpon', '$alamat', '$unit_id')");
    header("Location: paramedik.php");
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM paramedik WHERE id=" . $_GET['hapus']);
    header("Location: paramedik.php");
}

// Ambil data unit kerja
$unitkerja = $conn->query("SELECT * FROM unit_kerja");

// Edit data
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM paramedik WHERE id=$id")->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Paramedik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Paramedik</h2>
    <form method="post" class="mb-3">
        <input name="nama" value="<?= isset($editData) ? $editData['nama'] : '' ?>" class="form-control mb-2" placeholder="Nama" required>
        <select name="gender" class="form-control mb-2">
            <option value="L" <?= (isset($editData) && $editData['gender'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
            <option value="P" <?= (isset($editData) && $editData['gender'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
        </select>
        <input name="tmp_lahir" value="<?= isset($editData) ? $editData['tmp_lahir'] : '' ?>" class="form-control mb-2" placeholder="Tempat Lahir" required>
        <input type="date" name="tgl_lahir" value="<?= isset($editData) ? $editData['tgl_lahir'] : '' ?>" class="form-control mb-2" required>
        <select name="kategori" class="form-control mb-2">
            <option value="Dokter" <?= (isset($editData) && $editData['kategori'] == 'Dokter') ? 'selected' : '' ?>>Dokter</option>
            <option value="Perawat" <?= (isset($editData) && $editData['kategori'] == 'Perawat') ? 'selected' : '' ?>>Perawat</option>
            <option value="Bidan" <?= (isset($editData) && $editData['kategori'] == 'Bidan') ? 'selected' : '' ?>>Bidan</option>
        </select>
        <input name="telpon" value="<?= isset($editData) ? $editData['telpon'] : '' ?>" class="form-control mb-2" placeholder="Telepon">
        <input name="alamat" value="<?= isset($editData) ? $editData['alamat'] : '' ?>" class="form-control mb-2" placeholder="Alamat">
        <select name="unitkerja_id" class="form-control mb-2">
            <option value="">--Pilih Unit Kerja--</option>
            <?php while ($u = $unitkerja->fetch_assoc()) { ?>
                <option value="<?= $u['id'] ?>" <?= isset($editData) && $editData['unitkerja_id'] == $u['id'] ? 'selected' : '' ?>><?= $u['nama_unit'] ?></option>
            <?php } ?>
        </select>
        <button name="simpan" class="btn btn-success"><?= isset($editData) ? 'Update' : 'Tambah' ?></button>
        <a href="paramedik.php" class="btn btn-secondary">Kembali</a>
    </form>
    <table class="table table-bordered">
        <thead><tr><th>ID</th><th>Nama</th><th>Gender</th><th>Kategori</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php
        $data = $conn->query("SELECT * FROM paramedik");
        while ($d = $data->fetch_assoc()) {
            echo "<tr>
                <td>{$d['id']}</td><td>{$d['nama']}</td><td>{$d['gender']}</td><td>{$d['kategori']}</td>
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
