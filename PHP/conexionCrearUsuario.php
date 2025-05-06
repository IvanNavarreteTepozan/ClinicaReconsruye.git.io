<?php

include("conexion.php");

//Variables para recibir y guardar datos del formulario de registro
$nombres = $_POST("nombre");
$PrimerApellido = $_POST("apellidoP");
$SegundoApellido = $_POST("apellidom");
$genero = $_POST("genero");
$fecha = $_POST("fecha");
$curp = $_POST("curp");
$correo = $_POST("correo");
$telefono = $_POST("telefono");
$telefono2 = $_POST("telefono2");
$contraseña = $_POST("contraseña");

$passwordHash = password_hash($contraseña, PASSWORD_BCRYPT); //Para encriptar la contraseña
$fotoPerfil = "img/$nombres/Avatar.webp";


?>
