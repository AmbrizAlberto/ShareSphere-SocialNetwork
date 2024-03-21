// Obtener el modal
var modal = document.getElementById("myModalEdit");
        
// Obtener el botón que abre el modal
var btn = document.getElementById("modalBtnEdit");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close-edit")[0];

// Cuando se haga clic en el botón, abrir el modal
btn.onclick = function() {
    modal.style.display = "block";
}

// Cuando se haga clic en <span> (x), cerrar el modal
span.onclick = function() {
    modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier parte fuera del modal, cerrarlo
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Manejar el envío del formulario de edición
document.getElementById("editForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma tradicional

    // Obtener los valores del formulario
    var newImage = document.getElementById("newImage").value;
    var newUsername = document.getElementById("newUsername").value;
    var newDescription = document.getElementById("newDescription").value;

    // Actualizar la imagen, nombre de usuario y descripción en la página (esto es un ejemplo, debes implementar la lógica de actualización real)
    document.getElementById("profileImage").src = newImage;
    // Aquí actualizarías el nombre de usuario y la descripción en la página

    // Cerrar el modal después de guardar los cambios
    modal.style.display = "none";
});