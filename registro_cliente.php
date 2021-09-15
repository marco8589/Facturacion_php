<?php

if (!empty($_POST)) {
    $alert = '';
    if (empty($_POST['nit']) || empty($_POST['nombre']) || empty($_POST['telefono']) ||
        empty($_POST['direccion'])) {
        $alert = '<p class="msg_error">Todos los campos son obligatorios</p>';
    } else {
        include_once "conexion.php";
        $nit = $_POST['nit'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];

        $sql_leer = 'SELECT * FROM cliente WHERE nit=?';
        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute(array($nit));

        $resultado = $gsent->rowCount();

        if ($resultado > 0) {
            $alert = '<p class="msg_error">Este cliente ya existe</p>';
        } else {
            $sql_agregar = 'INSERT INTO cliente (nit, nombre, telefono, direccion)
            VALUES (?,?,?,?)';

            $sentencia_agregar = $pdo->prepare($sql_agregar);
            $sentencia_agregar->execute(array($nit, $nombre, $telefono, $direccion));
            $alert = '<p class="msg_guardar">Cliente creado!</p>';
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

    <title>Registro cliente</title>
</head>

<?php include "header.php"?>

<body>
    <section id="contenedor">
        <div class="form_register">
            <h1>Registro Cliente</h1>
            <hr>
            <div class="alerta" id="alerta"><?php echo isset($alert) ? $alert : '' ?></div>

            <form action="" method="post">
                <label for="nit">NIT:</label>
                <input type="text" name="nit" id="nit" placeholder="NIT">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo">
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" id="telefono" placeholder="Telefono">
                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" id="direccion" placeholder="Direccion">

                <input type="submit" onclick="return enviarformulario_cliente();" value="Actualizar Cliente"
                    class="btn_guardar">
            </form>

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