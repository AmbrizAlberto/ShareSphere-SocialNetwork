function openModalForProject(projectId) {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    var modalContent = document.getElementById("modalContent");

    switch (projectId) {
        case 1:
            fetch('/controllers/Get/getPost.php')
                .then(response => response.json())
                .then(data => {
                    var html = "<h2>Lista de publicaciones</h2>";
                    html += "<ul>";
                    data.forEach(post => { 
                        html +=`<li> 
                        <a href="/src/views/userPage.php?idPerfil=${post.creatorId}"> 
                        <img src="../../public/images_users/${post.img}"  alt='si' style=" width:2%; height: auto;">
                        </a> ID: ${post.id}, Titulo: ${post.title}, Nombre del creador: ${post.creator_name} 
                        <a href="/controllers/Delete/DeletePost.php?id=${post.id}&page=2"><i class="bi bi-trash-fill" style=" width:2%; height: auto;"></i></a>
                        </li>`
                    });
                    html += "</ul>"; 
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
                        if(user.id !== 16){
                        html +=`<li> 
                        <a href="/src/views/userPage.php?idPerfil=${user.id}"> 
                        <img src="../../public/images_users/${user.image}"  alt='si' style=" width:2%; height: auto;">
                        </a> 
                        ID: ${user.id}, Nombre de usuario: ${user.username}, Correo: ${user.email} 
                        <a href="/controllers/Delete/deleteUser.php?id=${user.id}&page=2"><i class="bi bi-trash-fill" style=" width:2%; height: auto;"></i></a>
                        </li>`
                        }
                    });
                    html += "</ul>";
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
    var modalContent = document.getElementById("modalContent");
    modalContent.innerHTML = "";
}