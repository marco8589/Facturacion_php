<?php
$link = 'mysql:host=localhost;dbname=facturacion';
$usuario = 'root';
$pass = 'root';

try {
    $pdo = new PDO($link, $usuario, $pass);

} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}