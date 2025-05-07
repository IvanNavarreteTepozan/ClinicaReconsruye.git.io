function Ventana(url, alto, ancho) {
    let izquierda = (window.innerWidth - ancho) / 2;
    let arriba = (window.innerHeight - alto) / 2;
    window.open(url, 'nuevaVentana', `width=${ancho},height=${alto},top=${arriba},left=${izquierda}`);
}
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("Form").addEventListener("submit", function(event) {
        // Opcional: Agregar una confirmación antes de cerrar la ventana.
        alert("Formulario enviado. Cerrando ventana...");

        // Espera un momento antes de cerrarla, en caso de redirección.
        setTimeout(function() {
            window.close();
        }, 500);
    });
});

