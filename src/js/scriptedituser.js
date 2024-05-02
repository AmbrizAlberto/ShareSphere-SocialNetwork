// Obtener el modal
var modal = document.getElementById("Modal-Profile");
        
// Obtener el botón que abre el modal
var btn = document.getElementById("modalBtnEdit");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close-edit")[0];

// Cuando se haga clic en el botón, abrir el modal
btn.onclick = function() {
    modal.style.display = "block";
    document.getElementById('newImage').value = document.getElementById('currentImage').value;
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
    // Cerrar el modal después de guardar los cambios
    modal.style.display = "none";
});

document.getElementById('newImage').addEventListener('change', function() {
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

            document.getElementById('previewImage').src = canvas.toDataURL('image/jpeg');
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
