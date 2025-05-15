<?php
session_start();

// Suponiendo que $_SESSION['CadenaPermisos'] contenga "1010100011"
$Cadena= $_SESSION['CadenaPermisos'];
$permisos = str_split($Cadena); // Convierte la cadena en un array
$opciones = [
    "Agendar Cita",
    "Revisar Cita",
    "Opción 3",
    "Opción 4",
    "Opción 5",
    "Opción 6",
    "Opción 7",
    "Opción 8",
    "Opción 9",
    "Opción 10"
];
$enlaces = [
    "agendar.php",
    "Pruebas.php",
    "Pruebas.php",
    "../index.html",
    "../index.html",
    "../index.html",
    "../index.html",
    "../index.html",
    "../index.html",
    "../index.html"
];
echo "";
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Reconstruye </title> 
    <meta name="description" content="En Reconstruye, consultorio de atención psicológica, ofrecemos un espacio seguro y 
    confidencial para acompañarte en tu proceso de crecimiento personal y emocional. Contamos con especialistas altamente capacitados que te ayudarán 
    a afrontar desafíos como ansiedad, depresión, estrés, y conflictos personales o familiares. Nuestro enfoque es personalizado, combinando técnicas 
    terapéuticas efectivas para ayudarte a encontrar equilibrio, bienestar y una mejor calidad de vida. Estamos aquí para escucharte y apoyarte en cada
    paso del camino hacia tu salud mental">
    <link rel="icon" href="../img/Icono.png" type="image/gif"/>
    <meta name="author" content="Reconstruye">
    <script>
                window.moveTo(0, 0);
                window.resizeTo(screen.width, screen.height);
    </script>
    <script src="../javascript/Frames.js"></script>
    <link rel="stylesheet" href="../CSS/Interfaz.css">
</head>

<body>
    <!--Aqui Inicia el encabezado de la página-->
        <header>
            <div class="titulo" id="paginaPrincipal">
                <div class="Enc">
                    <img src="../img/Icono.png">
                <div class="Logo"></div>
                </div>
            </div>
            <div class="Barra">
                <ul>
                    <li><img src="../img/MiEspacio.png"><a href="Interfaz.html">Mis Citas</a></li>
                    <li><img src="../img/User_Icon.png"><a href="../PHP/info.php">Mi información</a></li>
                    <li><img src="../img/Home_icon.png" > <a href="../index.html">Página Principal</a></li>
                    <li><img src="../img/Salir.png"><a href="CerrarSesion.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </header>
    <!--Aqui termina el encabezado de la página-->
    <main>
        <div class="VentanaPrincipal">
            <div class="Container">
            <div class="Menu">
                <ul>
                    <?php
                        foreach ($permisos as $index => $permiso) {
                            if ($permiso == "1") {
                                echo "<li onclick=\"abrirEnIframe('$enlaces[$index]')\">
                                <img src='../img/Agend_Icon.png'>$opciones[$index]
                                </li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="Info">
                <iframe src="../PHP/agendar.php"></iframe>
            </div>
        </div>
    </div>
    </main>
    <footer>
        <div class="Pie" id="Contacto">
            <ul>
                <li><img src="../img/Phone_Icon.png" > Tel:+1 775 268 2367</li>
                <li><img src="../img/mail.png"><a href="mailto:reconstruyesss@gmail.com">Correo: reconstruyesss@gmail.com</a></li>
                <li><img src="../img/Facebook_con.png"><a href="https://www.facebook.com/profile.php?id=100087628274036&sk=about">Facebook</a></li>
                <li><img src="../img/Locate_Icon.png" ><a href="https://maps.app.goo.gl/PiQ1fWPPXtciJ6DE8">Pte., #409, Int.3, Tulancingo, Mexico</a> </li>
            </ul>
        </div>
    </footer>
</body>