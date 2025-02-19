<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
</head>
    <body>
        <h1>welkom</h1>
    <?php
        $_nama = "budi";
        $_umur = "20";
        $_prodi = "informatika";
        $_ipk = "3.5";
    ?>
        <p>nama : <?php echo $_nama;?> </p>
        <p>umur : <?php echo $_umur;?> </p>
        <p>prodi : <?php echo $_prodi;?> </p>
        <p>ipk : <?php echo $_ipk;?> </p>

        <hr>

        <?php
            echo "nama : ".$_nama."<br>";
            ?>
    </body>
</html>