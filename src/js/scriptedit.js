
document.getElementById("eliminarButton").addEventListener("click", function(event) {
    event.preventDefault(); // Evita que el enlace redirija a otra página
    var id = this.getAttribute("data-id");
    window.location.href = "/controllers/Delete/DeletePost.php?id=" + id;
});