<?php
include "conexion.php";

if (!empty($_POST)) {
    $idusuario = $_POST['idusuario'];

    $sql_eliminar = 'DELETE FROM usuario WHERE idusuario=?';
    $sentencia_eliminar = $pdo->prepare($sql_eliminar);
    $sentencia_eliminar->execute(array($idusuario));

    $sentencia_eliminar = null;
    $pdo = null;
    header('Location:lista_usuarios.php');
}

if (empty($_GET['id'])) {
    header('location:lista_usuarios.php');

} else {

    $idusuario = $_GET['id'];
    $sql_leer = 'SELECT * FROM usuario WHERE idusuario=?';
    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute(array($idusuario));

    $resultado = $gsent->rowCount();
    if ($resultado <= 0) {
        header('location:lista_usuarios.php');
    } else {
        $sql_leer = 'SELECT nombre,usuario,rol.rol as rol
        FROM usuario,rol where usuario.rol=rol.idrol and idusuario=?' .
            ' order by idusuario';

        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute(array($idusuario));

        $resultado = $gsent->fetchAll();
        foreach ($resultado as $data) {
            $nombre = $data['nombre'];
            $usuario = $data['usuario'];
            $rol = $data['rol'];

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

    <title>Eliminar usuario</title>
</head>

<?php include "header.php"?>

<body>
    <section id="contenedor">
        <div clase="eliminar">
            <h2>Esta seguro de eliminar el usuario?</h2>
            <p>Nombre: <span><?php echo $nombre ?></span></p>
            <p>Usuario: <span><?php echo $usuario ?></span></p>
            <p>Tipo de Usuario: <span><?php echo $rol ?></span></p>

            <form id="form_eliminar" method="post" action="">
                <a href="lista_usuarios.php" class="btn_cancel"> cancelar</a>
                <input type="submit" value="Aceptar" class="btn_aceptar">
                <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $idusuario; ?>">
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