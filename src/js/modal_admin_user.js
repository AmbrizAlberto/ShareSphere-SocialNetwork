function openModalForProject(projectId) {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";

    switch (projectId) {
        case 1:
            fetch('/controllers/Get/getPost.php')
                .then(response => response.json())
                .then(data => {
                    var html = "<h2>Lista de publicaciones</h2>";
                    html += "<ul>";
                    data.forEach(post => {
                        html += "<li>ID: " + post.id + ", Titulo: " + post.title + ", Nombre del creador: " + post.creator_name + "</li>";
                    });
                    html += "</ul>";

                    var modalContent = document.getElementById("modalContent");
                    modalContent.innerHTML = html;
                }).catch(error => {
                console.error('Error al obtener los datos:', error);
            });
            break;
        case 2:
            fetch('/controllers/Get/getUsers.php')
                .then(response => response.json())
                .then(data => {
                    var html = "<h2>Lista de usuarios</h2>";
                    html += "<ul>";
                    data.forEach(user => {
                        html += "<li>ID: " + user.id + ", Nombre de usuario: " + user.username + ", Correo: " + user.email + "</li>";
                    });
                    html += "</ul>";

                    var modalContent = document.getElementById("modalContent");
                    modalContent.innerHTML = html;
                }).catch(error => {
                console.error('Error al obtener los datos:', error);
            });
            break;
        }
    }

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}