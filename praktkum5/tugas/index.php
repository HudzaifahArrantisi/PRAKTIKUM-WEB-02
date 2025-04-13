<?php
// Koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "dbpuskes";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8mb4");

// Fungsi untuk membersihkan input
function clean_input($data) {
    global $conn;
    return htmlspecialchars(stripslashes(trim($conn->real_escape_string($data))));
}

// Proses CRUD
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {
    case 'create':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $kode = clean_input($_POST['kode']);
            $nama = clean_input($_POST['nama']);
            $tmp_lahir = clean_input($_POST['tmp_lahir']);
            $tgl_lahir = $_POST['tgl_lahir'];
            $gender = clean_input($_POST['gender']);
            $email = clean_input($_POST['email']);
            $alamat = clean_input($_POST['alamat']);
            $kelurahan_id = (int)$_POST['kelurahan_id'];
            
            $stmt = $conn->prepare("INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssi", $kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan_id);
            
            if ($stmt->execute()) {
                $message = "Data berhasil ditambahkan";
                $message_type = "success";
            } else {
                $message = "Error: " . $stmt->error;
                $message_type = "error";
            }
            
            $stmt->close();
            header("Location: index.php?message=" . urlencode($message) . "&message_type=" . $message_type);
            exit();
        }
        break;
        
    case 'update':
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = (int)$_POST['id'];
            $kode = clean_input($_POST['kode']);
            $nama = clean_input($_POST['nama']);
            $tmp_lahir = clean_input($_POST['tmp_lahir']);
            $tgl_lahir = $_POST['tgl_lahir'];
            $gender = clean_input($_POST['gender']);
            $email = clean_input($_POST['email']);
            $alamat = clean_input($_POST['alamat']);
            $kelurahan_id = (int)$_POST['kelurahan_id'];
            
            $stmt = $conn->prepare("UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, kelurahan_id=? WHERE id=?");
            $stmt->bind_param("sssssssii", $kode, $nama, $tmp_lahir, $tgl_lahir, $gender, $email, $alamat, $kelurahan_id, $id);
            
            if ($stmt->execute()) {
                $message = "Data berhasil diperbarui";
                $message_type = "success";
            } else {
                $message = "Error: " . $stmt->error;
                $message_type = "error";
            }
            
            $stmt->close();
            header("Location: index.php?message=" . urlencode($message) . "&message_type=" . $message_type);
            exit();
        }
        break;
        
    case 'delete':
        $id = (int)$_GET['id'];
        
        // Periksa apakah ada data terkait di tabel periksa
        $check = $conn->prepare("SELECT COUNT(*) FROM periksa WHERE id_pasien=?");
        $check->bind_param("i", $id);
        $check->execute();
        $check->bind_result($count);
        $check->fetch();
        $check->close();
        
        if ($count > 0) {
            $message = "Data tidak dapat dihapus karena memiliki riwayat pemeriksaan";
            $message_type = "error";
        } else {
            $stmt = $conn->prepare("DELETE FROM pasien WHERE id=?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $message = "Data berhasil dihapus";
                $message_type = "success";
            } else {
                $message = "Error: " . $stmt->error;
                $message_type = "error";
            }
            
            $stmt->close();
        }
        
        header("Location: index.php?message=" . urlencode($message) . "&message_type=" . $message_type);
        exit();
}

// Ambil data pasien untuk ditampilkan
$search = isset($_GET['search']) ? clean_input($_GET['search']) : '';
$query = "SELECT p.*, k.nama as nama_kelurahan FROM pasien p LEFT JOIN kelurahan k ON p.kelurahan_id = k.id";

if (!empty($search)) {
    $query .= " WHERE p.nama LIKE '%$search%' OR p.kode LIKE '%$search%'";
}

$query .= " ORDER BY p.nama";
$result = $conn->query($query);

// Ambil data kelurahan untuk dropdown
$kelurahan_result = $conn->query("SELECT id, nama FROM kelurahan ORDER BY nama");

// Ambil data untuk edit
$edit_data = null;
if (isset($_GET['edit_id'])) {
    $edit_id = (int)$_GET['edit_id'];
    $stmt = $conn->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_result = $stmt->get_result();
    $edit_data = $edit_result->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem CRUD Pasien - dbpuskes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            text-align: center;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .alert-success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .alert-error {
            background-color: #f2dede;
            color: #a94442;
        }
        .form-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, 
        .form-group select, 
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        .btn-primary:hover {
            background-color: #45a049;
        }
        .btn-danger {
            background-color: #f44336;
            color: white;
        }
        .btn-danger:hover {
            background-color: #d32f2f;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            position: sticky;
            top: 0;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .search-container {
            margin-bottom: 20px;
            display: flex;
            gap: 10px;
        }
        .search-container input {
            padding: 8px;
            width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .radio-group {
            display: flex;
            gap: 15px;
            align-items: center;
        }
        .radio-option {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem CRUD Pasien - dbpuskes</h1>
        
        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-<?= isset($_GET['message_type']) ? $_GET['message_type'] : 'success' ?>">
                <?= htmlspecialchars(urldecode($_GET['message'])) ?>
            </div>
        <?php endif; ?>
        
        <!-- Form Tambah/Edit Data -->
        <div class="form-container">
            <h2><?= $edit_data ? 'Edit' : 'Tambah' ?> Data Pasien</h2>
            <form method="post" action="index.php?action=<?= $edit_data ? 'update' : 'create' ?>">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                <?php endif; ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="kode">Kode Pasien</label>
                        <input type="text" id="kode" name="kode" 
                               value="<?= $edit_data ? htmlspecialchars($edit_data['kode']) : '' ?>" 
                               required maxlength="20">
                    </div>
                    
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" 
                               value="<?= $edit_data ? htmlspecialchars($edit_data['nama']) : '' ?>" 
                               required maxlength="45">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="tmp_lahir">Tempat Lahir</label>
                        <input type="text" id="tmp_lahir" name="tmp_lahir" 
                               value="<?= $edit_data ? htmlspecialchars($edit_data['tmp_lahir']) : '' ?>" 
                               required maxlength="30">
                    </div>
                    
                    <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" 
                               value="<?= $edit_data ? $edit_data['tgl_lahir'] : '' ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="gender_l" name="gender" value="L" 
                                   <?= $edit_data && $edit_data['gender'] == 'L' ? 'checked' : '' ?> required>
                            <label for="gender_l">Laki-laki</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="gender_p" name="gender" value="P" 
                                   <?= $edit_data && $edit_data['gender'] == 'P' ? 'checked' : '' ?>>
                            <label for="gender_p">Perempuan</label>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" 
                           value="<?= $edit_data ? htmlspecialchars($edit_data['email']) : '' ?>" 
                           maxlength="100">
                </div>
                
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" maxlength="100"><?= $edit_data ? htmlspecialchars($edit_data['alamat']) : '' ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="kelurahan_id">Kelurahan</label>
                    <select id="kelurahan_id" name="kelurahan_id">
                        <option value="">Pilih Kelurahan</option>
                        <?php while($kelurahan = $kelurahan_result->fetch_assoc()): ?>
                            <option value="<?= $kelurahan['id'] ?>" 
                                <?= $edit_data && $edit_data['kelurahan_id'] == $kelurahan['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kelurahan['nama']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><?= $edit_data ? 'Update' : 'Simpan' ?></button>
                
                <?php if ($edit_data): ?>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                <?php endif; ?>
            </form>
        </div>
        
        <!-- Pencarian dan Tabel Data -->
        <div class="search-container">
            <form method="get" action="">
                <input type="text" name="search" placeholder="Cari pasien..." 
                       value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if (!empty($search)): ?>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </form>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Tempat/Tgl Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Kelurahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kode']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td>
                                <?= htmlspecialchars($row['tmp_lahir']) ?>, 
                                <?= $row['tgl_lahir'] ? date('d-m-Y', strtotime($row['tgl_lahir'])) : '-' ?>
                            </td>
                            <td><?= $row['gender'] == 'L' ? 'Laki-laki' : ($row['gender'] == 'P' ? 'Perempuan' : '-') ?></td>
                            <td><?= $row['email'] ? htmlspecialchars($row['email']) : '-' ?></td>
                            <td><?= $row['alamat'] ? htmlspecialchars($row['alamat']) : '-' ?></td>
                            <td><?= $row['nama_kelurahan'] ? htmlspecialchars($row['nama_kelurahan']) : '-' ?></td>
                            <td class="action-buttons">
                                <a href="index.php?edit_id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="index.php?action=delete&id=<?= $row['id'] ?>" 
                                   class="btn btn-danger" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada data pasien</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>