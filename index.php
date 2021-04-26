<?php

require "databaseconnect.php";

// database connection and tables 
$querys = new Conexiones();

$querys->connect();

$table = "USUARIOS";

//error and message handling
$aErrores = array();
$aMenssages = array();

//form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($_POST)) {

    if (isset($name) && isset($email) && isset($password)) {

        if (empty($_POST['name'])) {
            $aErrores[] = "Debe especificar el nombre";
        } else {
            $aMensajes[] = "Nombre: [" . $_POST['name'] . "]";
        }

        if (empty($_POST['email'])) {
            $aErrores[] = "Debe ingresar un email";
        } else {
            $aMensajes[] = "Nombre: [" . $_POST['email'] . "]";
        }
        if (empty($_POST['password'])) {
            $aErrores[] = "Debe ingresar una contraseña";
        } else {
            $aMensajes[] = "Nombre: [" . $_POST['password'] . "]";
        }

        if (!empty($name) && !empty($email) && !empty($password)) {
            $querys->NewUser($name, $email, $password);
        }
    }
} else {
    echo '<p>No se obtuvieron los datos</p>';
}

if (count($aErrores)) {
    // echo "<p>ERRORES ENCONTRADOS:</p>";

    for ($contador = 0; $contador < count($aErrores); $contador++) {
        // echo $aErrores[$contador] . "</br>";
    }
} else {
    for ($contador = 0; $contador < count($aMensajes); $contador++) {
        // echo $aMensajes[$contador] . "</br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/main.css">
    <title>Formulario</title>
</head>

<body>
    <div class="container">
        <h2>Registrate</h2>
        <form action="index.php" method="POST">

            <input placeholder="nombre" type="text" name="name">

            <input placeholder="email" type="text" name="email">

            <input placeholder="contraseña" type="password" name="password">

            <input class="enviar" type="submit" value="ACEPTAR">

        </form>
    </div>
</body>

</html>