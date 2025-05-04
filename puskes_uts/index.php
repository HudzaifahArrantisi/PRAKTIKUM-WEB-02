<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Puskes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Dashboard CRUD Puskes</h1>
    <div class="row g-4">
        <?php
        $menus = ['kelurahan', 'unit_kerja', 'pasien', 'paramedik', 'periksa'];
        foreach ($menus as $menu): ?>
            <div class="col-md-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body text-center">
                        <h5 class="card-title"><?= ucfirst(str_replace("_", " ", $menu)) ?></h5>
                        <a href="<?= $menu ?>.php" class="btn btn-primary">Kelola</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
