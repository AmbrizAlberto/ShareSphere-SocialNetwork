document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("modalBtn");
    var span = document.getElementById("closeBtn");
  
    btn.onclick = function () {
      modal.style.display = "block";
    };
  
    span.onclick = function () {
      modal.style.display = "none";
    };
  
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    };
  });

  // para modo de visitante
document.addEventListener('DOMContentLoaded', function () {
  const themeToggleBtn = document.getElementById('theme-toggle-btn-visitor');
  const themeStyleLink = document.getElementById('theme-style-visitor');

  themeToggleBtn.addEventListener('click', function () {
      // Verificar si el estilo actual es el modo oscuro
      if (themeStyleLink.getAttribute('href') === '../css/main.css') {
          // Cambiar al modo claro
          themeStyleLink.setAttribute('href', '../css/light-mode.css');
      } else {
          // Cambiar al modo oscuro
          themeStyleLink.setAttribute('href', '../css/main.css');
      }
  });
});
