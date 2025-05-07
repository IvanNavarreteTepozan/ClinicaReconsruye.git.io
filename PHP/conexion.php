<?php

class connection{
    private $conn;
    public function __construct(){
        $this->conn =new mysqli("reconstruye.ddns.net","IvanLoco","S0yBienL0c0","DB_RECONSTRUYE",3308);
        if (!$this->conn) {
            echo "Falló la conexión <br>";
            die("0" . mysqli_connect_error());
        } else {
            echo "1";
        }
    }
    public function get_connection(){
        return $this->conn;
    }
}

//Crear la conexión
/*
//Variables para la conexión
$servidor = "reconstruye.ddns.net";
$puerto = 3308;
$usuario = "IvanLoco";
$contraseña = "S0yBienL0c0";
$BD = "DB_RECONSTRUYE"; 
$conexion = mysqli_connect($servidor, $usuario, $contraseña, $BD, $puerto);
}*/
//Verificar conexión


?>