<?php
include 'koneksi.php';

// Tambah
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tmp = $_POST['tmp_lahir'];
    $tgl = $_POST['tgl_lahir'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $kel_id = $_POST['kelurahan_id'];
    $conn->query("INSERT INTO pasien (kode,nama,tmp_lahir,tgl_lahir,gender,email,alamat,kelurahan_id)
                  VALUES ('$kode','$nama','$tmp','$tgl','$gender','$email','$alamat',$kel_id)");
    header("Location: pasien.php");
}

// Hapus
if (isset($_GET['hapus'])) {
    $conn->query("DELETE FROM pasien WHERE id=" . $_GET['hapus']);
    header("Location: pasien.php");
}

// Ambil data kelurahan
$kelurahans = $conn->query("SELECT * FROM kelurahan");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Pasien</h2>
    <form method="post" class="mb-3">
        <input name="kode" class="form-control mb-2" placeholder="Kode Pasien" required>
        <input name="nama" class="form-control mb-2" placeholder="Nama" required>
        <input name="tmp_lahir" class="form-control mb-2" placeholder="Tempat Lahir" required>
        <input type="date" name="tgl_lahir" class="form-control mb-2" required>
        <select name="gender" class="form-control mb-2">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
        <input name="email" class="form-control mb-2" placeholder="Email">
        <input name="alamat" class="form-control mb-2" placeholder="Alamat">
        <select name="kelurahan_id" class="form-control mb-2" required>
            <option value="">--Pilih Kelurahan--</option>
            <?php while ($k = $kelurahans->fetch_assoc()) {
                echo "<option value='{$k['id']}'>{$k['nama_kelurahan']}</option>";
            } ?>
        </select>
        <button name="simpan" class="btn btn-success">Tambah</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
    <table class="table table-bordered">
        <thead><tr><th>Kode</th><th>Nama</th><th>Gender</th><th>Email</th><th>Aksi</th></tr></thead>
        <tbody>
        <?php
        $data = $conn->query("SELECT * FROM pasien");
        while ($d = $data->fetch_assoc()) {
            echo "<tr>
                <td>{$d['kode']}</td><td>{$d['nama']}</td><td>{$d['gender']}</td><td>{$d['email']}</td>
                <td><a href='?hapus={$d['id']}' class='btn btn-danger btn-sm'>Hapus</a></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
