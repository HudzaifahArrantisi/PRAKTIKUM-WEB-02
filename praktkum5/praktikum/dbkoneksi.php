<?php
// Konfigurasi database
$host = 'localhost'; // Host database
$dbname = 'dbpuskes'; // Nama database
$username = 'root'; // Username database
$password = ''; // Password database

// Membuat koneksi ke database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set mode error PDO ke exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Koneksi berhasil!";
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Fungsi untuk Create (Insert)
function createData($table, $data) {
    global $conn;
    $columns = implode(", ", array_keys($data));
    $values = ":" . implode(", :", array_keys($data));
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute($data);
}

// Fungsi untuk Read (Select)
function readData($table, $conditions = []) {
    global $conn;
    $sql = "SELECT * FROM $table";
    if (!empty($conditions)) {
        $sql .= " WHERE ";
        $conditionsArray = [];
        foreach ($conditions as $key => $value) {
            $conditionsArray[] = "$key = :$key";
        }
        $sql .= implode(" AND ", $conditionsArray);
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($conditions);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk Update
function updateData($table, $data, $conditions) {
    global $conn;
    $sql = "UPDATE $table SET ";
    $setArray = [];
    foreach ($data as $key => $value) {
        $setArray[] = "$key = :$key";
    }
    $sql .= implode(", ", $setArray);
    $sql .= " WHERE ";
    $conditionsArray = [];
    foreach ($conditions as $key => $value) {
        $conditionsArray[] = "$key = :$key";
    }
    $sql .= implode(" AND ", $conditionsArray);
    $stmt = $conn->prepare($sql);
    return $stmt->execute(array_merge($data, $conditions));
}

// Fungsi untuk Delete
function deleteData($table, $conditions) {
    global $conn;
    $sql = "DELETE FROM $table WHERE ";
    $conditionsArray = [];
    foreach ($conditions as $key => $value) {
        $conditionsArray[] = "$key = :$key";
    }
    $sql .= implode(" AND ", $conditionsArray);
    $stmt = $conn->prepare($sql);
    return $stmt->execute($conditions);
}

// Contoh penggunaan fungsi CRUD dengan metode POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $table = $_POST['table']; // Menentukan tabel yang akan dioperasikan

    switch ($action) {
        case 'create':
            $data = $_POST['data']; // Data yang akan dimasukkan
            if (createData($table, $data)) {
                echo "Data berhasil ditambahkan di tabel $table!";
            } else {
                echo "Gagal menambahkan data di tabel $table!";
            }
            break;

        case 'read':
            $conditions = $_POST['conditions'] ?? []; // Kondisi untuk filter data
            $result = readData($table, $conditions);
            echo json_encode($result);
            break;

        case 'update':
            $data = $_POST['data']; // Data yang akan diupdate
            $conditions = $_POST['conditions']; // Kondisi untuk menentukan data yang diupdate
            if (updateData($table, $data, $conditions)) {
                echo "Data berhasil diupdate di tabel $table!";
            } else {
                echo "Gagal mengupdate data di tabel $table!";
            }
            break;

        case 'delete':
            $conditions = $_POST['conditions']; // Kondisi untuk menentukan data yang dihapus
            if (deleteData($table, $conditions)) {
                echo "Data berhasil dihapus di tabel $table!";
            } else {
                echo "Gagal menghapus data di tabel $table!";
            }
            break;

        default:
            echo "Aksi tidak valid!";
            break;
    }
}
?>