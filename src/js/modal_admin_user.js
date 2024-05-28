function openModalForProject(projectId) {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
    var modalContent = document.getElementById("modalContent");

    switch (projectId) {
        case 1:
            fetch('/controllers/Get/getPost.php')
                .then(response => response.json())
                .then(data => {
                    let html = "<h2>Lista de publicaciones</h2>";
                    html += `
                        <table class="usertable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Título</th>
                                    <th>Nombre del creador</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    data.forEach(post => { 
                        html += `
                            <tr class="trusers">
                                <td><a href="/src/views/admin-post.php?idPerfil=${post.creatorId}&idPost=${post.id}" style="color: black; text-decoration: none;"> 
                                    ${post.image ? `<img src="../../public/images_posts/${post.image}" alt="Imagen de la publicación" style="width:5vh; height:5vh; border-radius: 20px;">` : ''}
                                    ${post.id}</a>
                                </td>
                                <td>${post.title}</td>
                                <td>${post.creator_name}
                                    <a href="/src/views/userPage.php?idPerfil=${post.creatorId}&fromPage=admin" style="color: black; text-decoration: none;"> 
                                    <img src="../../public/images_users/${post.img}" alt='si' style="width:5vh; height:5vh; border-radius: 20px;"></a>
                                </td>
                                <td>
                                    <a href="/controllers/Delete/DeletePost.php?id=${post.id}&page=2">
                                        <i class="bi bi-trash-fill" style="color: white; font-size: 3vh;"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                    });
                    html += `
                            </tbody>
                        </table>
                    `;
                    modalContent.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
            break;

        case 2:
            fetch('/controllers/Get/getUsers.php')
                .then(response => response.json())
                .then(data => {
                    var html = "<h2>Tabla de usuarios</h2>";
                    html += `<table class="usertable">`;
                    html += `<thead><tr><th>ID</th><th>USUARIO</th><th>CORREO</th><th>ELIMINAR</th></tr></thead>`;
                    html += `<tbody>`;
                    data.forEach(user => {
                        if(user.id !== 16){
                            html += `<tr class="trusers"> 
                                <td><a href="/src/views/userPage.php?idPerfil=${user.id}&fromPage=admin" style="color: black; text-decoration: none;"> 
                                    <img src="../../public/images_users/${user.image}"  alt='' style="width:5vh; height:5vh; border-radius: 20px;"></a> ${user.id}
                                </td>
                                <td><span style="text-decoration: none;">${user.username}</span></td>
                                <td>${user.email}</td>
                                <td>
                                    <a href="/controllers/Delete/deleteUser.php?id=${user.id}&page=2">
                                        <i class="bi bi-trash-fill" style="color: white; font-size: 3vh;"></i>
                                    </a>
                                </td>
                            </tr>`;
                        }
                    });
                    html += `</tbody></table>`;
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
