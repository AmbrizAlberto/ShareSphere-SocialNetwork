
// Función para abrir el modal y mostrar el contenido según el proyecto seleccionado
function openModalForProject(projectId) {
    // Mostrar el modal
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    
    // Realizar la solicitud AJAX para obtener la lista de usuarios
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Cuando la solicitud es exitosa, actualizar el contenido del modal con la lista de usuarios
            var modalContent = document.getElementById("modalContent");
            var usuarios = JSON.parse(this.responseText);
            var html = "<h2>Lista de usuarios</h2><ul>";
            usuarios.forEach(function(usuario) {
                html += "<li>" + usuario.nombre + " <button onclick=\"eliminarUsuario(" + usuario.id + ")\">Eliminar</button></li>";
            });
            html += "</ul>";
            modalContent.innerHTML = "<h2>Lista de usuarios</h2>"+html;
        }
    };
    xhttp.open("GET", "obtener_usuarios.php", true); // Aquí debe ser el nombre del archivo correcto
    xhttp.send();
}


// Función para cerrar el modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}