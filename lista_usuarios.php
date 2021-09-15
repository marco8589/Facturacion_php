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
</footer>

</html>

<?php

$gsent = null;
$pdo = null;

?>