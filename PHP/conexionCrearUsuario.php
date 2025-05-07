<?php

require_once("conexion.php");

$mysql= new connection();
$conexion= $mysql->get_connection();


$pcGenero = "Masculino"; //1
$pcNombre = "Luis"; //2
$pcPrimerApellido = "Martínez";//3
$pcSegundoApellido = "Gómez"; //4
$pcNumeroTelefono = "5512345678"; //5
$pcNumeroTelefonoAlternativo = "5545671234"; //6
$pcCorreoElectronico = "luis@example.com"; //7
$pcCurp = "MGLM950815HDFRLP09"; //8
$pdFecha_nacimiento = "1995-08-15"; //9
$pnIdPregunta = 1; //10
$pcContraseña = password_hash("MiClaveNOSegura", PASSWORD_BCRYPT); // 11
$pcRespuesta = "Mi mascota"; //12
$pcResultado = ""; //13

$sql = "CALL SPD_INSERTA_PERSONA(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$statement = $conexion->prepare($sql);
$statement->bind_param(
    $pcGenero, $pcNombre, $pcPrimerApellido, $pcSegundoApellido, 
    $pcNumeroTelefono, $pcNumeroTelefonoAlternativo, $pcCorreoElectronico, 
    $pcCurp, $pdFecha_nacimiento, $pnIdPregunta, $pcContraseña, $pcRespuesta, $pcResultado
);

if ($statement->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error en el registro: " . $statement->error;
}
$statement->close();
$conexion->close();
?>
/*
$genero = "Masculino";
$nombres = "Juan Pérez";
$P_apellido = "García";
$S_apellido = "López";
$telefono = "5512345678";
$telefono2 = "5545671234";
$correo = "juan.perez@example.com";
$curp = "GARJ950815HDFLPN09";
$fecha = "1995-08-15";
$IdPregunta = 1;
$contraseña = "MiClaveSegura";
$encriptada = password_hash($contraseña, PASSWORD_BCRYPT);
$Respuesta = "Esto es un comentario de prueba";
$Resultado ="";
*/