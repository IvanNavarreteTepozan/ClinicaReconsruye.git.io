<?php
require_once("conexion.php");

$mysql = new connection();
$conexion = $mysql->get_connection();

// Datos ficticios
    $usuario= $_POST['usuario'];
    $
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $respuesta = $_POST['respuesta'];

echo "<h3>Datos Recibidos</h3>";
echo "<p><strong>Usuario:</strong> $usuario</p>";
echo "<p><strong>Contraseña (hash):</strong> $contraseña</p>";
echo "<p><strong>Respuesta:</strong> $respuesta</p>";

try {
    // Llamada al procedimiento con parámetro OUT
    $sql = "CALL SPD_VALIDA_USUARIO( ?, ?, ?, @pcResultado)";
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error al preparar: " . $conexion->error);
    }
    else{
        echo "Conexion Exitosa --->";
    }
    $stmt->bind_param(
        "sss",
        $usuario,
        $contraseña,
        $respuesta
    );

    $stmt->execute();
    $stmt->close();

    // Obtener el valor del parámetro OUT
    $resultado_query = $conexion->query("SELECT @pcResultado AS resultado");
    if ($resultado_query) {
        $row = $resultado_query->fetch_assoc();
        echo "Resultado de INICIO SESIÓN: " . $row['resultado'];
    } else {
        throw new Exception("Error al obtener resultado: " . $conexion->error);
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

$conexion->close();
?>
