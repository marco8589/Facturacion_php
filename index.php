<?php
session_start();

if (!empty($$_SESSION['activo'])) {
    header('location:menu.php');

} else {
    $alert = '';
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = "Ingrese Usuario o Contraseña";
            // echo $alert;
        } else {

            try {
                require_once "conexion.php";
                $user = $_POST['usuario'];
                $pass = md5($_POST['clave']);
                $sql_leer = 'SELECT * FROM usuario where usuario=? and clave=?';
                $gsent = $pdo->prepare($sql_leer);
                $gsent->execute(array($user, $pass));

                $resultado = $gsent->rowCount();

                if ($resultado > 0) {

                    $resultado = $gsent->fetchAll();
                    foreach ($resultado as $data) {
                        $_SESSION['activo'] = true;
                        $_SESSION['idusuario'] = $data['idusuario'];
                        $_SESSION['nombre'] = $data['nombre'];
                        $_SESSION['email'] = $data['email'];
                        $_SESSION['usuario'] = $data['usuario'];
                        $_SESSION['rol'] = $data['idusuario'];
                        header('location:menu.php');
                    }
                } else {
                    $alert = 'El usuario o la contraseña son incorrectos';
                    session_destroy();
                }

            } catch (Exception $e) {

                die("Error: " . $e->GetMessage() . " En la Linea " . $e->getline());
            }

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
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>


    <section id="container">
        <form action="" method="post">
            <h3>Iniciar Sesion</h3>
            <img src="img/login.png" alt="Login" width="190px">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="clave" placeholder="Contraseña">
            <div class="alerta"><?php echo isset($alert) ? $alert : '' ?></div>
            <input id="boton_ingresar" type="submit" value="INGRESAR">
        </form>
    </section>

</body>

</html>

<?php

$gsent = null;
$pdo = null;

?>