// Script para cambiar entre el modo claro y oscuro
const toggleButton = document.getElementById('theme-toggle-btn');
const themeStyle = document.getElementById('theme-style');

toggleButton.addEventListener('click', () => {
  if (themeStyle.getAttribute('href') === '../css/main.css') {
    themeStyle.href = '../css/light-mode.css'; // Cambia al modo claro
  } else {
    themeStyle.href = '../css/main.css'; // Cambia al modo oscuro
  }
});  
