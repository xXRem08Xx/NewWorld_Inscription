<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=rmaissa_inscriptionNewWorld;charset=utf8',
    "rmaissa", "elini01", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
}
?>