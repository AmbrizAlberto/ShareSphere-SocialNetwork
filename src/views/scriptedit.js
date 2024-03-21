
document.getElementById("eliminarButton").addEventListener("click", function(event) {
    event.preventDefault(); // Evita que el enlace redirija a otra página
    
    // Mostrar un mensaje de confirmación
    if (confirm("¿Estás seguro de que deseas eliminar este elemento?")) {
        // Aquí puedes colocar el código para eliminar el elemento
        console.log("El elemento ha sido eliminado.");
    } else {
        console.log("La eliminación ha sido cancelada.");
    }
});