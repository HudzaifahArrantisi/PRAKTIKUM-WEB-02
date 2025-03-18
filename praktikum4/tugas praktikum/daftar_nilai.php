<?php 
require_once 'nilai_mahasiswa.php';
$data_mhs=[];

$data_mhs[] = new NilaiMahasiswa("gibran", "Pemrograman Web", 20, 25, 20);
$data_mhs[] = new NilaiMahasiswa("rojul", "Pemrograman Web", 90, 15, 50);
$data_mhs[] = new NilaiMahasiswa("munir", "Pemrograman Web", 10, 22, 89);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'] ?? '';
    $matakuliah = $_POST['matakuliah'] ?? '';
    $nilai_uts = $_POST['nilai_uts'] ?? 0;
    $nilai_uas = $_POST['nilai_uas'] ?? 0;
    $nilai_tugas = $_POST['nilai_tugas'] ?? 0;

    $data_mhs[] = new NilaiMahasiswa($nama, $matakuliah, $nilai_uts, $nilai_uas, $nilai_tugas);
}
?>

<h3>Daftar Nilai Mahasiswa</h3>

<form method="POST" action="">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" required>   

    <label for="matakuliah">Mata Kuliah</label>
    <input type="text" name="matakuliah" id="matakuliah" required>

    <label for="nilai_uts">Nilai UTS</label>
    <input type="number" name="nilai_uts" id="nilai_uts" required>

    <label for="nilai_uas">Nilai UAS</label>
    <input type="number" name="nilai_uas" id="nilai_uas" required>

    <label for="nilai_tugas">Nilai Tugas</label>
    <input type="number" name="nilai_tugas" id="nilai_tugas" required>

    <button type="submit">Simpan</button>
</form>

<h3>Daftar Nilai Mahasiswa</h3>

<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Mata Kuliah</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Tugas</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        foreach ($data_mhs as $mhs) {
            echo "<tr>
                <td>{$no}</td>
                <td>{$mhs->nama}</td>
                <td>{$mhs->matakuliah}</td>
                <td>{$mhs->nilai_uts}</td>
                <td>{$mhs->nilai_uas}</td>
                <td>{$mhs->nilai_tugas}</td>
            </tr>";
            $no++;
        }
        ?>
    </tbody>
</table>
