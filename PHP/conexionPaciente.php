<?php
session_start();

use function PHPSTORM_META\type;

require_once("conexion.php");
$mysql = new connection();
$conexion = $mysql->get_connection();

$nombre_usuario =$_SESSION['usuario'];
$id_psicologo = $_POST['psicologo_id'];
$motivo = $_POST['motivo'];
$fecha = $_POST['fecha_consulta'];

echo $nombre_usuario."<hr>";
echo $id_psicologo."<hr>";
echo $motivo."<hr>";
echo $fecha."<hr>";

    try {   
        // Llamamos al procedimiento para guardar los datos de cita del formulario en la tabla consulta
        $sql = "CALL SPD_SOLICITAR_CITA_PACIENTE(?, ?, ?, ?, @pcResultado)";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar: " . $conexion->error);
        }
        else{
            echo "Conexion Exitosa --->";
        }
        // Bind de parámetros (solo 3 parámetros según tu procedimiento)
        $stmt->bind_param("siss", $nombre_usuario, $id_psicologo, $motivo, $fecha);
    
        $stmt->execute();
        $stmt->close();

        // Obtener el valor del parámetro OUT
        $resultado_query = $conexion->query("SELECT @pcResultado AS resultado");
        if ($resultado_query) {
            $row = $resultado_query->fetch_assoc();
            $resultado=trim($row['resultado']);
            echo $resultado;
            $row = $resultado_query->fetch_assoc();
        }

    }catch (Exception $e) {
        die("Error: " . $e->getMessage());
    };

?>