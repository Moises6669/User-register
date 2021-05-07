<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/signup.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h2>iniciar sesión</h2>
        <form action="login.php" method="POST" id="signup" name="signup">

            <input id="email" placeholder="email" type="text" name="email">

            <input id="password" placeholder="contraseña" type="password" name="password">

            <input id="aceptar" class="enviar" type="submit" value="ACEPTAR">

        </form>
    </div>
</body>

</html>

<?php


require 'databaseconnect.php';

$login = new Conection();

$email = $_POST['email'];
$password = $_POST['password'];

$login->login_users($email, $password);

?>