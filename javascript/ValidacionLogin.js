document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("Form").addEventListener("submit", function (event) {
        event.preventDefault();
        
        let usuario = document.getElementById("usuario").value.trim();
        let contraseña = document.getElementById("contraseña").value.trim();
        
        if (usuario.length < 3 || contraseña.length < 10) {
            alert("Por favor, complete correctamente todos los campos.");
            return false;
        }

        alert("Inicio de sesión exitoso");
        window.close();
    });
});