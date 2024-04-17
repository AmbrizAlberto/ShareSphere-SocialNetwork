<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
</head>
<body>
    <form action="../../controllers/funtion_reset.php" method="post">
        <input type="text" class="input-field" placeholder="Ingrese el codigo" name="code" required>
        <input type="password" id="new_password" name="new_password" class="input-field" placeholder="Ingrese la nueva contraseña" required>
        <input type="submit" value="Continuar">
    </form>
</body>
</html>