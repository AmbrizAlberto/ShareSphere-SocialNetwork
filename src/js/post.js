function openModal(event) {
    var modal = document.getElementById("Post-complete");
    var fullImg = document.getElementById("fullImage");
    var clickedImgSrc = event.target.src;
    
    fullImg.src = clickedImgSrc;
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("Post-complete");
    modal.style.display = "none";
}

