/* js/light-darc */
const toggleButton = document.getElementById('theme-toggle-btn');
const themeStyle = document.getElementById('theme-style');

toggleButton.addEventListener('click', () => {
  const currentTheme = "<?php echo $_SESSION['theme']; ?>";
  if (currentTheme == '0') {
    themeStyle.href = '../css/light-mode.css'; 
  } else {
    themeStyle.href = '../css/main.css'; 
  }
  var CurrentPage = window.location.href;
  window.location.href = "/controllers/Edit/UpdateTheme.php?CurrentPage=" + CurrentPage;
});  