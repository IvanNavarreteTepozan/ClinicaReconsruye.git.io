document.getElementById("Form").addEventListener("submit", function(event) {
    event.preventDefault(); // Previene el envío normal

    let formData = new FormData(this);

    fetch("CrearUsuario.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(resultado => {
        if (resultado.trim() === "Éxito") {
            alert("Inicio exitoso");
            setTimeout(() => {
                window.open("dashboard.html", "_blank"); // Abre nueva pestaña
            }, 2000); // Espera 2 segundos
        } else {
            alert("Inicio erróneo");
            setTimeout(() => {
                window.open("error.html", "_blank"); // Abre otra pestaña
            }, 2000); // Espera 2 segundos
        }
    });
});

