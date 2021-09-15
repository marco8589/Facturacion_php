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

    <title>Lista de Cliente</title>
</head>

<?php include "header.php"?>

<body>

    <section id="contenedor">
        <h1>Lista de Cliente</h1>
        <a href="registro_cliente.php" class="btn_new">Crear Cliente</a>
        <br>
        <form action="" method="post" class="form_buscar">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btn_buscar">
        </form>

        <table>
            <tr>
                <th>ID Cliente</th>
                <th>NIT</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Acciones</th>
            </tr>

            <?php

if (empty($_POST['busqueda'])) {
    $sql_leer = 'SELECT idcliente,nit,nombre,telefono,direccion
    FROM cliente' .
        ' order by idcliente';
    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

} else {
    $busqueda = $_POST['busqueda'];
    $sql_leer = "SELECT idcliente,nit,nombre,telefono,direccion
    FROM cliente where (nit LIKE '%" . $busqueda . "%' OR nombre LIKE '%" . $busqueda . "%' OR
    telefono LIKE '%" . $busqueda . "%'  or direccion LIKE '%" . $busqueda . "%') " .
        " order by idcliente";

    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute(array($busqueda));

}

$resultado = $gsent->fetchAll();

?>

            <?php foreach ($resultado as $dato): ?>
            <tr>
                <td><?php echo $dato['idcliente'] ?></td>
                <td><?php echo $dato['nit'] ?></td>
                <td><?php echo $dato['nombre'] ?></td>
                <td><?php echo $dato['telefono'] ?></td>
                <td><?php echo $dato['direccion'] ?></td>
                <td>

                    <a class="link_edit" href="editar_cliente.php?id=<?php echo $dato['idcliente'] ?>">Editar</a>
                    <a class="link_delete" href="eliminar_cliente.php?id=<?php echo $dato['idcliente'] ?>">Eliminar</a>

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