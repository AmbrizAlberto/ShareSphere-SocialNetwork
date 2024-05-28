function openPostModal(postId) {
    // Obtener la información de la publicación y los comentarios mediante una solicitud AJAX
    fetch('../../controllers/Get/get_post_info.php?postId=' + postId)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Verificar la estructura de la respuesta

            if (data.status === 'error') {
                console.error(data.message);
                return;
            }

            const currentUserId = data.currentUserId;
            const postOwnerId = data.creator.id;
            // Verificar si los datos del creador existen
            const userImage = data.creator && data.creator.image ? data.creator.image : 'default.png';
            const userName = data.creator && data.creator.username ? data.creator.username : 'Usuario desconocido';

            // Rellenar el contenido del modal con la información obtenida
            const postModalContent = document.getElementById('postModalContent');
            const postModalComment = document.querySelector('.post-comments');

            postModalContent.innerHTML = `
                <div class="user-info">
                    <img src="/public/images_users/${userImage}" alt="Foto de perfil" class="user-image">
                    <span class="user-name">${userName}</span>
                </div>
                <h2 class="post-title">${data.title}</h2>
                <p class="post-text">${data.content}</p>
                ${data.image ? `<img src="../../public/images_posts/${data.image}" alt="Imagen de la publicación" class="post-image1">` : ''}
            `;

            postModalComment.innerHTML = `
                <h3 class="comment-title">Comentarios</h3>
                <div class="commentsct">
                    <ul class="comment-list">
                        ${data.comments.map(comment => `
                            <li class="comment-item">
                                <div class="comment-user-info">
                                    <img src="/public/images_users/${comment.user && comment.user.image ? comment.user.image : 'default.png'}" alt="Foto de perfil" class="comment-user-image">
                                    <span class="comment-user-name">${comment.user && comment.user.username ? comment.user.username : 'Usuario desconocido'}</span>
                                    <span class="comment-date">${comment.created_at}</span>
                                    ${(currentUserId === postOwnerId || currentUserId === comment.user.userId) ? `
                                            <a href="/controllers/Delete/deleteComment.php?id=${comment.id}&from=main">
                                            <i class="bi bi-trash-fill"></i></a>` : ''}
                                </div>
                                <div class="comment-text">${comment.content}</div>
                            </li>`).join('')}
                    </ul>
                    <div class="new-comment">
                        <input type="text" id="newCommentInput" placeholder="Nuevo comentario" class="new-comment-input">
                        <button onclick="submitComment(${postId})" class="new-comment-button">Enviar</button>
                    </div>
                </div>
            `;

            // Mostrar el modal
            document.getElementById('postModal').style.display = 'block';
        })
        .catch(error => console.error('Error:', error));
}


function closePostModal() {
    document.getElementById('postModal').style.display = 'none';
}

function submitComment(postId) {
    const newComment = document.querySelector('#newCommentInput').value;
    if (/[a-zA-Z]/.test(newComment)) {
        // Aquí puedes agregar el código para enviar el comentario
        console.log('Comentario válido:', newComment);
    } else {
        alert('El comentario debe contener al menos una letra.');
        return;
    }

    // Enviar el nuevo comentario mediante una solicitud AJAX
    fetch('../../controllers/Get/submit_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ postId: postId, comment: newComment })
    })
    .then(response => response.json())
    .then(data => {
        // Actualizar el conteo de comentarios en el botón de comentarios
        document.getElementById(`comment-count-${postId}`).textContent = data.commentCount;

        // Obtener la información actualizada de la publicación (incluidos los comentarios)
        return fetch('../../controllers/Get/get_post_info.php?postId=' + postId);
    })
    .then(response => response.json())
    .then(data => {
        const currentUserId = data.currentUserId;
        const postOwnerId = data.creator.id;

        // Actualizar la lista de comentarios en el modal con la información actualizada
        const postModalComment = document.querySelector('.post-comments');
        postModalComment.innerHTML = `
            <h3 class="comment-title">Comentarios</h3>
            <div class="commentsct">
                <ul class="comment-list">
                    ${data.comments.map(comment => `
                        <li class="comment-item">
                            <div class="comment-user-info">
                                <img src="/public/images_users/${comment.user && comment.user.image ? comment.user.image : 'default.png'}" alt="Foto de perfil" class="comment-user-image">
                                <span class="comment-user-name">${comment.user && comment.user.username ? comment.user.username : 'Usuario desconocido'}</span>
                                <span class="comment-date">${comment.created_at}</span>
                                ${(currentUserId === postOwnerId || currentUserId === comment.user.userId) ? `
                                <a href="/controllers/Delete/deleteComment.php?id=${comment.id}&from=main">
                                    <i class="bi bi-trash-fill"></i>
                                </a>` : ''}
                            </div>
                            <div class="comment-text">${comment.content}</div>
                        </li>`).join('')}
                </ul>
                <div class="new-comment">
                    <input type="text" id="newCommentInput" placeholder="Nuevo comentario" class="new-comment-input">
                    <button onclick="submitComment(${postId})" class="new-comment-button">Comentar</button>
                </div>
            </div>
        `;

        // Limpiar el input del comentario
        document.querySelector('#newCommentInput').value = '';

        // Mostrar el modal
        document.getElementById('postModal').style.display = 'block';
    })
    .catch(error => console.error('Error:', error));
}

