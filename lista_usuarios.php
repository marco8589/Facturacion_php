<?php

include 'conexion.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "scripts.php"?>

    <title>Lista de Usuarios</title>
</head>

<?php include "header.php"?>

<body>

    <section id="contenedor">
        <h1>Lista de Usuarios</h1>
        <a href="registro_usuario.php" class="btn_new">Crear Usuario</a>
        <br>
        <form action="" method="post" class="form_buscar">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btn_buscar">
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

            <?php

if (empty($_POST['busqueda'])) {
    $sql_leer = 'SELECT idusuario,nombre,correo,usuario,rol.rol as rol
    FROM usuario,rol where usuario.rol=rol.idrol' .
        ' order by idusuario';
    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

} else {
    $busqueda = $_POST['busqueda'];
    $sql_leer = "SELECT idusuario,nombre,correo,usuario,rol.rol as rol
    FROM usuario,rol where usuario.rol=rol.idrol and (idusuario LIKE '%" . $busqueda . "%' OR nombre LIKE '%" . $busqueda . "%' OR
    correo LIKE '%" . $busqueda . "%'  or usuario LIKE '%" . $busqueda . "%' or rol.rol like '%" . $busqueda . "%') " .
        " order by idusuario";

    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute(array($busqueda));

}

$resultado = $gsent->fetchAll();

?>

            <?php foreach ($resultado as $dato): ?>
            <tr>
                <td><?php echo $dato['idusuario'] ?></td>
                <td><?php echo $dato['nombre'] ?></td>
                <td><?php echo $dato['correo'] ?></td>
                <td><?php echo $dato['usuario'] ?></td>
                <td><?php echo $dato['rol'] ?></td>
                <td>

                    <a class="link_edit" href="editar_usuario.php?id=<?php echo $dato['idusuario'] ?>">Editar</a>
                    <a class="link_delete" href="eliminar_usuario.php?id=<?php echo $dato['idusuario'] ?>">Eliminar</a>

                </td>
            </tr>
            <?php endforeach?>


        </table>

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

<?php

$gsent = null;
$pdo = null;

?>