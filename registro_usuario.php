<?php

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) ||
        empty($_POST['clave'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        include_once "conexion.php";
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $clave = md5($_POST['clave']);
        $rol = $_POST['rol'];

        $sql_leer = 'SELECT * FROM usuario WHERE usuario=?';
        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute(array($usuario));

        $resultado = $gsent->rowCount();

        if ($resultado > 0) {
            $alert = '<p class="msg_error">Este usuario ya existe</p>';
        } else {
            $sql_agregar = 'INSERT INTO usuario (nombre, correo, usuario, clave,rol)
            VALUES (?,?,?,?,?)';

            $sentencia_agregar = $pdo->prepare($sql_agregar);
            $sentencia_agregar->execute(array($nombre, $correo, $usuario, $clave, $rol));
            $alert = '<p class="msg_guardar">Usuario creado!</p>';
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
    <?php include "scripts.php"?>

    <title>Registro usuario</title>
</head>

<?php include "header.php"?>

<body>
    <section id="contenedor">
        <div class="form_register">
            <h1>Registro Usuario</h1>
            <hr>
            <div class="alerta" id="alerta"><?php echo isset($alert) ? $alert : '' ?></div>

            <form action="" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                <label for="correo">Correo Electronico:</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave" placeholder="Contraseña">
                <label for="rol">Tipo Usuario:</label>


                <?php

include_once 'conexion.php';

$sql_leer_t = 'SELECT * FROM rol order by idrol';

$gsent_t = $pdo->prepare($sql_leer_t);
$gsent_t->execute();

$resultado_t = $gsent_t->fetchAll();

?>

                <select name="rol" id="rol">
                    <?php foreach ($resultado_t as $dato_t): ?>
                    <option value=<?php echo $dato_t['idrol'] ?>> <?php echo $dato_t['rol'] ?></option>
                    <?php endforeach?>
                </select>
                <input type="submit" onclick="return enviarformulario_usuario();" value="Crear Usuario"
                    class="btn_guardar">
            </form>

        </div>
    </section>


</body>

<footer>
    <?php include "footer.php"?>
</footer>

</html>


</html>

<?php

$gsent = null;
$pdo = null;

?>