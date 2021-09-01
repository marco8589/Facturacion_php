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