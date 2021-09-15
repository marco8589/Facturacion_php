<?php
session_start();
if (empty($_SESSION['activo'])) {
    header('location:index.php');

}
date_default_timezone_set('America/Santo_Domingo');
$mes = array("", "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre");
$fecha_dia = date('d') . " de " . $mes[date('n')] . " de " . date('Y');

?>

<header>

    <div class="header">
        <div class="optionsBar">
            <p><?php echo $fecha_dia; ?>
            </p>
            <span>|</span>
            <span class="user"><?php echo $_SESSION['usuario']; ?></span>
        </div>
    </div>


    <?php include "nav.php"?>


</header>