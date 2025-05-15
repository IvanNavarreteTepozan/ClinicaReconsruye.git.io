<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Información.
    <?php
    session_start();
    echo $_SESSION['CadenaPermisos'];
    ?>
</body>
</html>