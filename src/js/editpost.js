function openmodal(postInfo) {
    var modal = document.getElementById("myModal-edit");
    var span = document.getElementById("closeBtn-edit");

    var post = JSON.parse(postInfo);

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
        // Cerrar el modal después de guardar los cambios
        modal.style.display = "none";
    });

    // Muestra el modal
    modal.style.display = "block";

    // Llenar el formulario con la información del post
    document.getElementById('titulo-edit').textContent = post.title;
    document.getElementById('texto-edit').textContent = post.content;
    document.getElementById('selector-edit').value = post.SubgroupId;
    document.getElementById('idPost').value = post.id;
    if (post.image != null) {
        document.getElementById('previewImage-edit').src = "/public/images_posts/" + post.image;
    }else{
        document.getElementById('previewImage-edit').removeAttribute('src');
    }
}

document.addEventListener("DOMContentLoaded", function() {
document.getElementById('newImage-edit').addEventListener('change', function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onload = function(e) {
        var img = new Image();
        img.src = e.target.result;

        img.onload = function() {
            var canvas = document.createElement('canvas');
            var ctx = canvas.getContext('2d');

            var MAX_WIDTH = 300; 
            var MAX_HEIGHT = 300; 
            var width = img.width;
            var height = img.height;

            if (width > height) {
                if (width > MAX_WIDTH) {
                    height *= MAX_WIDTH / width;
                    width = MAX_WIDTH;
                }
            } else {
                if (height > MAX_HEIGHT) {
                    width *= MAX_HEIGHT / height;
                    height = MAX_HEIGHT;
                }
            }

            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(img, 0, 0, width, height);

            document.getElementById('previewImage-edit').src = canvas.toDataURL('image/jpeg');
        }
    };

    reader.readAsDataURL(file);
});


window.onload = function() {


    var currentImage = document.getElementById('currentImage');
    var previewCurrentImage = document.getElementById('previewCurrentImage');

    var MAX_WIDTH = 300; 
    var MAX_HEIGHT = 300; 
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');
    var img = new Image();
    img.src = currentImage.src;

    img.onload = function() {
        var width = img.width;
        var height = img.height;

        if (width > height) {
            if (width > MAX_WIDTH) {
                height *= MAX_WIDTH / width;
                width = MAX_WIDTH;
            }
        } else {
            if (height > MAX_HEIGHT) {
                width *= MAX_HEIGHT / height;
                height = MAX_HEIGHT;
            }
        }

        canvas.width = width;
        canvas.height = height;
        ctx.drawImage(img, 0, 0, width, height);

        previewCurrentImage.src = canvas.toDataURL('image/jpeg');
    };
};
});