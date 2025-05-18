<?php
session_start();

use function PHPSTORM_META\type;

require_once("conexion.php");
$mysql = new connection();
$conexion = $mysql->get_connection();

$id_psicologo = $_POST['id_psicologo'];
$fecha_consulta = $_POST['fecha_consulta'];
$accion = $_POST['accion'];
//$accion = isset($_POST['accion']) ? (int)$_POST['accion'] : null;
echo "opcion", $accion;
    
$sql = "CALL SPD_AGENDAR_CITA_EN_ESPERA_DE_CONFIRMACION(?,?, ?, @pcResultado)";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    throw new Exception("Error al preparar: " . $conn->error);
}else{
    echo "Conexion Exitosa --->";
}

$stmt->bind_param("ssi", $id_psicologo, $fecha_consulta, $accion);
$stmt->execute();
$resultado_query = $conexion->query("SELECT @pcResultado AS resultado");
        if ($resultado_query) {
            $row = $resultado_query->fetch_assoc();
            $resultado=trim($row['resultado']);
            echo $resultado;
            $row = $resultado_query->fetch_assoc();
        }

?>