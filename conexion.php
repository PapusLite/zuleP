<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>conexion</title>
</head>
<body>
<?php

function conexion(){
    return mysqli_connect('localhost','root','','covid19cuba');
}
?>
</body>
</html>


