<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar contraseña</title>
</head>
<body>
<form action="../../controllers/funtion_cpassword.php" method="post">
        <input type="password" id="password" name="password" class="input-field" placeholder="Password" required>
        <input type="password" id="cpassword" name="cpassword" class="input-field" placeholder="Confirm Password" required>
        <input type="submit" value="Cambiar contraseña">
    </form>
</body>
</html>