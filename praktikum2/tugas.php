<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $uas = isset($_POST['uas']) ? floatval($_POST['uas']) : 0;
    $uts = isset($_POST['uts']) ? floatval($_POST['uts']) : 0;
    $tugas = isset($_POST['tugas']) ? floatval($_POST['tugas']) : 0;

    $final_score = ($uts * 0.30) + ($uas * 0.35) + ($tugas * 0.35);
      
    $status = ($final_score >= 60) ? "Dah lolos " : "Ga  lolos rek😂";
    
    $grades = [
        "A" => 85,
        "B" => 70,
        "C" => 56,
        "D" => 36,
        "E" => 0
    ];
    
    foreach ($grades as $grade => $min_score) {
        if ($final_score >= $min_score) {
            break;
        }
    }
    
    $predicates = [
        "A" => "Sangat Memuaskan",
        "B" => "Memuaskan",
        "C" => "Cukup",
        "D" => "Kurang",
        "E" => "Sangat Kurang"
    ];

    $status_grade = $predicates[$grade] ?? "Tidak Ada";

    $_SESSION['result'] = compact('name', 'subject', 'uas', 'uts', 'tugas', 'final_score', 'status', 'grade', 'status_grade');
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

$result = $_SESSION['result'] ?? null;
unset($_SESSION['result']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Penilaian Mahasiswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <form method="POST" class="w-full max-w-md p-6 bg-white rounded-lg shadow-md space-y-4">
        <h2 class="text-xl font-semibold text-center">Sistem Penilaian Mahasiswa</h2>

        <input type="text" name="name" placeholder="Nama Mahasiswa" required class="w-full p-2 border rounded-md">
        <input type="text" name="subject" placeholder="Mata Kuliah" required class="w-full p-2 border rounded-md">
        <input type="number" name="uas" step="0.1" placeholder="Nilai UAS" required class="w-full p-2 border rounded-md">
        <input type="number" name="uts" step="0.1" placeholder="Nilai UTS" required class="w-full p-2 border rounded-md">
        <input type="number" name="tugas" step="0.1" placeholder="Nilai Tugas" required class="w-full p-2 border rounded-md">
        
        <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded-md">Hitung Nilai</button>

        <?php if ($result): ?>
            <div class="mt-4 p-4 bg-gray-200 rounded-md">
                <p><strong>Nama:</strong> <?= $result['name'] ?></p>
                <p><strong>Mata Kuliah:</strong> <?= $result['subject'] ?></p>
                <p><strong>Nilai UAS:</strong> <?= $result['uas'] ?></p>
                <p><strong>Nilai UTS:</strong> <?= $result['uts'] ?></p>
                <p><strong>Nilai Tugas:</strong> <?= $result['tugas'] ?></p>
                <p><strong>Nilai Akhir:</strong> <?= number_format($result['final_score'], 2) ?></p>
                <p><strong>Status:</strong> <?= $result['status'] ?></p>
                <p><strong>Predikat:</strong> <?= $result['grade'] ?></p>
                <p><strong>Predikat Status:</strong> <?= $result['status_grade'] ?></p>
            </div>
        <?php endif; ?>
    </form>
</body>
</html>
