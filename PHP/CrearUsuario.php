<?php
require_once("conexion.php");

$mysql = new connection();
$conexion = $mysql->get_connection();

// Datos ficticios
    $genero = $_POST['genero'];
    $nombres = $_POST['Nombres'];
    $primer_apellido = $_POST['Primer_Apellido'];
    $segundo_apellido = $_POST['Segundo_Apellido'];
    $telefono = $_POST['telefono'];
    $telefono2 = $_POST['telefono2'] ?? ''; // Opcional
    $correo = $_POST['correo'];
    $fecha_nac = $_POST['fecha'];
    $idpregunta = intval($_POST['pregunta']); // Asegurar que sea int
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $respuesta = $_POST['respuesta'];
/*
echo "<h3>Datos Recibidos</h3>";
echo "<p><strong>Género:</strong> $genero</p>";
echo "<p><strong>Nombres:</strong> $nombres</p>";
echo "<p><strong>Primer Apellido:</strong> $primer_apellido</p>";
echo "<p><strong>Segundo Apellido:</strong> $segundo_apellido</p>";
echo "<p><strong>Teléfono 1:</strong> $telefono</p>";
echo "<p><strong>Teléfono 2:</strong> $telefono2</p>";
echo "<p><strong>Correo Electrónico:</strong> $correo</p>";
echo "<p><strong>Fecha de Nacimiento:</strong> $fecha_nac</p>";
echo "<p><strong>ID Pregunta:</strong> $idpregunta</p>";
echo "<p><strong>Contraseña (hash):</strong> $contraseña</p>";
echo "<p><strong>Respuesta:</strong> $respuesta</p>";
*/
$validar=true;
if ($genero=='N' or $genero==NULL){
    $validar=false;
}
if ($idpregunta ==0){
    $validar=false;
}

if ($validar==true){
    try {
        // Llamada al procedimiento con parámetro OUT
        $sql = "CALL SPD_INSERTA_PERSONA(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @pcResultado)";
        $stmt = $conexion->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error al preparar: " . $conexion->error);
        }
        else{
            //echo "Conexion Exitosa --->";
        }
        $stmt->bind_param(
            "ssssssssiss",
            $genero,
            $nombres,
            $primer_apellido,
            $segundo_apellido,
            $telefono,
            $telefono2,
            $correo,
            $fecha_nac,
            $idpregunta,
            $contraseña,
            $respuesta
        );
    
        $stmt->execute();
        $stmt->close();
    
        // Obtener el valor del parámetro OUT
        $resultado_query = $conexion->query("SELECT @pcResultado AS resultado");
        if ($resultado_query) {
            $row = $resultado_query->fetch_assoc();
            //echo "Resultado de la base: " . $row['resultado'];
            $respuesta= trim($row['resultado']);
            if($respuesta =="Se ha insertado al usuario exitosamente"){
                //echo "Sesión iniciada correctamente.";
                header('Location: ../index.html');
            }
        } else {
            throw new Exception("Error al obtener resultado: " . $conexion->error);
            header('Location: ../Html/Registro.html');
        }
    
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}
else{
    //echo "Campos sin llenar o incorrectos";
    header('Location: ../Html/Registro.html');
}
$conexion->close();
?>
