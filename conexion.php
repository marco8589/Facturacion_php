<?php
$link = 'mysql:host=localhost;dbname=facturacion';
$usuario = 'root';
$pass = 'root';

try {
    $pdo = new PDO($link, $usuario, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}