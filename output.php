<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <div class="container mt-5">
            <h1>data yang di kirim</h1>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST")
                    $name = isset($_POST['name']) 
                            ? $_POST['name'] : "";
                    $_email = isset($_POST['email'])
                            ? $_POST['email'] : "";
                    $_pesan = isset($_POST['pesan'])
                            ? $_POST['pesan'] : "";
                 
                $datauser = array(
                    "name" => $name,
                    "email" => $_email,
                    "pesan" => $_pesan
                );

                echo "<h2> data yang dikirm lewat post : </h2>";
                echo '<ul class="list-group">';

                foreach ($datauser as $key => $value){
                    if (!empty($value)){
                        echo '<li; class="list-group-item"><strong>'
                        .ucfirst($key) . '</strong>' .htmlspecialchars($value) . '</li>';

                    }
                    else {
                        echo '<li class="list-group-item"><strong>'
                        .ucfirst($key) . '</strong> Tidak ada data yang dikirim</li>';
                    }
                    
                }
                
            ?>
    </div>

</body>
</html>