<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar cita</title>
    <link rel="stylesheet" href="../CSS/Menu.css">
    <script src="../javascript/validacion.js"></script>
    <script src="../javascript/ventanas.js"></script>
</head>
<body>
    <?php
    SESSION_START();
    ?>
    <div class="titulo">
        <img src="../img/Calendar_Icon.png" height="35px" style="margin-right:20px;">
        <h2>Ingrese los datos de la cita</h2>
    </div>
    <div class="Formulario_cita">
        <form id="Form_Cita" name="agendar" method="post" action="conexionPaciente.php"> 
            <div class="item">
                <label for="motivo">¿Cuál es el motivo de la cita?</label><br>
                <input type="text" id="motivo" name="motivo" minlength="4" maxlength="200" placeholder="Escriba su motivo  de cita">
            </div>
            <div class="item">
                <label for="cita">Selecciona fecha y hora:</label><br>
                <input type="datetime-local" id="cita" name="fecha_consulta" min="<?= $ahora ?>" required>
            </div>
            <div id="psicologo" class="item">
                <label>Selecciona al psicólogo:
                    <select  class="Selector" id="Selector" name="psicologo_id" required >
                        <option value="">-- Seleccione --</option>
                        <?php
                            $conn =new mysqli("reconstruye.ddns.net","IvanLoco","S0yBienL0c0","DB_RECONSTRUYE",3308);

                            $sql = "CALL SPD_CONSULTA_NOMBRES_PSICOLOGOS()";
                            $result = $conn->query($sql); 
                            
                            // DIAGNÓSTICO: Mostrar estructura completa de los datos
                            echo "<!-- DEBUG INFO:\n";
                            if (!$result) {
                                echo "Error en la consulta: " . $conn->error . "\n";
                            } else {
                                echo "Número de filas: " . $result->num_rows . "\n";
                                if ($result->num_rows > 0) {
                                    $first_row = $result->fetch_assoc();
                                    print_r($first_row);
                                    // Volver al inicio del resultset
                                    $result->data_seek(0);
                                }
                            }
                            echo "-->";
                            
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $id = $row['idPsicologo'];
                                    $nombre = $row['NombrePsicologo'];
                                    echo '<option value="' . htmlspecialchars($id) . '">' 
                                        . htmlspecialchars($nombre) 
                                        . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No hay psicólogos disponibles</option>';
                            }
                            
                            $conn->close();
                        ?> 
                    </select>
                </label>
            </div>
            <div class="botones">
                <input type="submit" value="Enviar" class="boton">
                <input type="reset" value="Restablecer" class="boton">
            </div>
        </form>
        
    </div>
</body>
</html>