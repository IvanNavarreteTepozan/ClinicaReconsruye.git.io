<?php
require_once("conexion.php");

$mysql = new connection();
$conexion = $mysql->get_connection();

$correo = $_POST['correo'];
$contraseña = md5($_POST['contraseña']); 
//$contraseña =$_POST['contraseña'];

echo "<p><strong>Correo Electrónico:</strong> $correo</p>";
echo "<p><strong>Contraseña:</strong> $contraseña</p>";

try {
    // Llamar al procedimiento almacenado con parámetros de entrada y salida
    $sql = "CALL SPD_VALIDA_INICIAR_SESION(?, ?, @pnIdRol, @pcCadenaPermiso, @pcResultado)";
    $stmt = $conexion->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error al preparar la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $correo, $contraseña);
    $stmt->execute();
    $stmt->close();


    $resultado_query = $conexion->query("SELECT @pnIdRol AS IdRol, @pcCadenaPermiso AS Permiso, @pcResultado AS Resultado");

    if ($resultado_query) {
        $row = $resultado_query->fetch_assoc();

        $idRol = $row['IdRol'];
        $permiso = $row['Permiso'];
        $respuesta = trim($row['Resultado']);

        // Mostrar las tres salidas
        echo "<p><strong>IdRol:</strong> $idRol</p>";
        echo "<p><strong>Permiso:</strong> $permiso</p>";
        echo "<p><strong>Resultado:</strong> $respuesta</p>";

        // Manejar la respuesta
        if ($respuesta === "Inicio de sesión exitoso") {
            echo "<script>
            alert('" . htmlspecialchars($contraseña) . "');
            </script>";
        } else {
            echo "<script>
                    alert('Error en el inicio de sesión');
                </script>";
        }

    } else {
        throw new Exception("Error al obtener el resultado: " . $conexion->error);
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
} finally {
    $conexion->close();
}
?>
