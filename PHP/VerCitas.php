<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar cita</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <script src="../javascript/ventanas.js"></script>
</head>
<body>
    <?php
    SESSION_START();
    ?>
    <div class="titulo">
        <img src="../img/Calendar_Icon.png" height="35px" style="margin-right:20px;">
        <h2>Mis Citas</h2>
    </div>
    <?php 
    require_once("conexion.php");
    $mysql = new connection();
    $conn = $mysql->get_connection();
    $id_usuario =$_SESSION['usuario'];

    $sql = "CALL SPD_CONSULTA_CITAS(?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error al preparar: " . $conn->error);
    }else{
        //echo "Conexion Exitosa --->";
    }
        
    $stmt->bind_param("s", $id_usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    
    if (!$result) {
        //echo "Error en la consulta: " . $conn->error . "\n";
    } else {
        //echo "Número de filas: " . $result->num_rows . "\n";
        if ($result->num_rows > 0) {
            $first_row = $result->fetch_assoc();
            //print_r($first_row);
            // Volver al inicio del resultset
            $result->data_seek(0);
        }
    }

    echo '<div class="citas-grid">';
    while ($row = $result->fetch_assoc()) {
        $date = htmlspecialchars($row['FechaConsulta']);
        $psicologo = htmlspecialchars($row['NombrePsicologo']);
        $status = htmlspecialchars($row['Estatus']);
        $observaciones = htmlspecialchars($row['Observaciones'] ?? 'Sin observaciones');
        
        echo '<div class="cita-card ' . strtolower($status) . '">
                <div class="cita-header">
                    <h3>' . "Psicológo: ", $psicologo . '</h3>
                    <span class="cita-status">' . $status . '</span>
                </div>
                <div class="cita-header">' . "Fecha: ", $date . '</div>
                <div class="cita-notes">' . "Observaciones: ", $observaciones . '</div>
              </div>';
    }
    
    echo "-->";
    $conn->close();

    ?>

</body>