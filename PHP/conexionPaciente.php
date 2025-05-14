<?php
session_start();

use function PHPSTORM_META\type;

require_once("conexion.php");
$mysql = new connection();
$conexion = $mysql->get_connection();

$id_usuario =$_SESSION['correo'];
$id_psicologo = $_POST['psicologo_id'];
$motivo = $_POST['motivo'];
$fecha = $_POST['fecha_consulta'];

echo $id_usuario;
echo $id_psicologo;
echo $motivo;
echo $fecha;

$validar=true;
if (!filter_var($id_usuario, FILTER_VALIDATE_EMAIL) || $id_usuario == NULL) {
    $validar = false;
}

if($validar==true){
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
        $stmt->bind_param("siss", $id_usuario, $id_psicologo, $motivo, $fecha);
    
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
    }
}else{
    $conexion->close();
}

?>
