<?php
include "conexion.php";
if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nombre']) || empty($_POST['correo'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        $idusuario = $_POST['idusuario'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $usuario = $_POST['usuario'];
        $rol = $_POST['rol'];

        $sql_editar = 'UPDATE usuario SET nombre=?,correo=?,rol=? WHERE idusuario=?';
        $sentencia_editar = $pdo->prepare($sql_editar);
        $sentencia_editar->execute(array($nombre, $correo, $rol, $idusuario));

        header('location:lista_usuario.php');

    }

}

if (empty($_GET['id'])) {
    header('location:lista_usuario.php');
}
$idusuario = $_GET['id'];

$sql_leer = 'SELECT * FROM usuario WHERE idusuario=?';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute(array($idusuario));

$resultado = $gsent->rowCount();

if ($resultado <= 0) {
    header('location:lista_usuarios.php');
} else {
    $opcion = '';
    $sql_leer = 'SELECT idusuario,nombre,correo,usuario,rol.rol as rol,rol.idrol as idrol,clave
    FROM usuario,rol where usuario.rol=rol.idrol and idusuario=?' .
        ' order by idusuario';

    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute(array($idusuario));

    $resultado = $gsent->fetchAll();
    foreach ($resultado as $data) {
        $nombre = $data['nombre'];
        $correo = $data['correo'];
        $usuario = $data['usuario'];
        $rol = $data['rol'];
        $idrol = $data['idrol'];

        $clave = $data['clave'];

        $opcion = '<option value=' . $idrol . ' select>' . $rol . '</option>';

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

    <title>Actualizar usuario</title>
</head>

<?php include "header.php"?>

<body>
    <section id="contenedor">
        <div class="form_register">
            <h1>Actualizar Usuario</h1>
            <hr>
            <div class="alerta" id="alerta"><?php echo isset($alert) ? $alert : '' ?></div>
            <form action="" method="post">
                <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $idusuario; ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo"
                    value="<?php echo $nombre; ?>">
                <label for="correo">Correo Electronico:</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico"
                    value="<?php echo $correo; ?>">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" placeholder="Usuario" value="<?php echo $usuario; ?>"
                    disabled>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" id="clave" placeholder="Contraseña" value="<?php echo $clave; ?>"
                    disabled>
                <label for="rol">Tipo Usuario:</label>


                <?php

include_once 'conexion.php';

$sql_leer_t = 'SELECT * FROM rol order by idrol';

$gsent_t = $pdo->prepare($sql_leer_t);
$gsent_t->execute();

$resultado_t = $gsent_t->fetchAll();

?>

                <select name="rol" id="rol" class="eliminaritem">
                    <?php echo $opcion ?>
                    <?php foreach ($resultado_t as $dato_t): ?>
                    <option value=<?php echo $dato_t['idrol'] ?>> <?php echo $dato_t['rol'] ?></option>
                    <?php endforeach?>
                </select>
                <input type="submit" onclick="return enviarformulario();" value="Actualizar Usuario"
                    class="btn_guardar">
            </form>

        </div>
    </section>


</body>

<footer>
    <?php include "footer.php"?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
    </script>

</footer>

</html>


</html>

<?php

$gsent = null;
$pdo = null;

?>