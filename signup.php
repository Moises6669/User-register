<?php

require "databaseconnect.php";

$querys = new Conection();

$table = "USUARIOS";

$aErrores = array();
$aMenssages = array();

if (!empty($_POST)) {

    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {

        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $querys->NewUser($_POST['name'], $_POST['email'],  $_POST['password']);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script src="./js/signup.js"> </script>

    <link rel="stylesheet" href="./styles/signup.css">

    <link rel="stylesheet" href="./styles/normalize.css">

    <title>Formulario</title>
</head>

<body>
    <div class="container">
        <h2>Registrate</h2>
        <form action="signup.php" method="POST" id="signup" name="signup">

            <input id="name" placeholder="nombre" type="text" name="name">

            <input id="email" placeholder="email" type="text" name="email">

            <input id="password" placeholder="contraseña" type="password" name="password">

            <input id="aceptar" class="enviar" type="submit" value="ACEPTAR">

        </form>
    </div>


</body>

</html>