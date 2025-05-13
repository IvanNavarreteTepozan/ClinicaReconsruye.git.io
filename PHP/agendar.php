<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar cita</title>
    <link rel="stylesheet" href="../CSS/Forms.css">
    <script src="../javascript/validacion.js"></script>
    <script src="../javascript/ventanas.js"></script>
</head>
<body>
    <div class="titulo" style="min-height: 40vw;">
        <img src="../img/newUser_Icon.png" height="35px" style="margin-right:20px;">
        <h2>Ingrese los datos de la cita</h2>
    </div>
    <div class="Formulario_cita">
        <form id="Form_Cita" name="agendar" method="post" action="conexionPaciente.php"> 
            <label for="id_usuario">Ingresa tu correo:</label><br>
            <input type="text" id="usuario" name="usuario" minlength="3" maxlength="50" required>
            <br><br>
            <label for="motivo">¿Cuál es el motivo de la cita?</label><br>
            <input type="text" id="motivo" name="motivo" minlength="4" maxlength="200">
            <br><br>
            <label for="cita">Selecciona fecha y hora:</label><br>
            <input type="datetime-local" id="cita" name="fecha_consulta" min="<?= $ahora ?>" required>
            <br><br>
            <div id="psicologo">
                <label>Selecciona al psicólogo:
                    <select name="psicologo_id" required>
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