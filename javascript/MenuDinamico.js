// Add this script to your existing JavaScript or create a new file (e.g., MenuDinamico.js)

function MenuConsultas() {
    // Show only Agendar and Reagendar
    document.getElementById('Consultas').style.display = 'block';
    document.getElementById('Psicologos').style.display = 'none';
    document.getElementById('ListaMenu').style.display = 'block';
}

function MenuPsicologos() {
    // Show only Consultar and Insertar
    document.getElementById('Consultas').style.display = 'none';
    document.getElementById('Psicologos').style.display = 'block';
    document.getElementById('ListaMenu').style.display = 'block';
}

function MenuUnico() {
    // Hide the entire menu
    document.getElementById('ListaMenu').style.display = 'none';
}
