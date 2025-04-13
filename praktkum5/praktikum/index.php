<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Example</title>
</head>
<body>
    <h1>Form CRUD</h1>
    <form action="dbkoneksi.php" method="post">
        <input type="hidden" name="action" value="create">
        <input type="hidden" name="table" value="pasien"> <!-- Ganti dengan tabel yang diinginkan -->
        Nama: <input type="text" name="data[nama]"><br>
        Alamat: <input type="text" name="data[alamat]"><br>
        Telepon: <input type="text" name="data[telepon]"><br>
        <input type="submit" value="Tambah Data">
    </form>

    <h2>Update Data</h2>
    <form action="dbkoneksi.php" method="post">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="table" value="pasien"> <!-- Ganti dengan tabel yang diinginkan -->
        ID: <input type="text" name="conditions[id]"><br>
        Nama: <input type="text" name="data[nama]"><br>
        Alamat: <input type="text" name="data[alamat]"><br>
        Telepon: <input type="text" name="data[telepon]"><br>
        <input type="submit" value="Update Data">
    </form>

    <h2>Hapus Data</h2>
    <form action="dbkoneksi.php" method="post">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="table" value="pasien"> <!-- Ganti dengan tabel yang diinginkan -->
        ID: <input type="text" name="conditions[id]"><br>
        <input type="submit" value="Hapus Data">
    </form>

    <h2>Baca Data</h2>
    <form action="dbkoneksi.php" method="post">
        <input type="hidden" name="action" value="read">
        <input type="hidden" name="table" value="pasien"> <!-- Ganti dengan tabel yang diinginkan -->
        ID (opsional): <input type="text" name="conditions[id]"><br>
        <input type="submit" value="Baca Data">
    </form>
</body>
</html>