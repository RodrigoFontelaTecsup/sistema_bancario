<?php
$host = "bdmysql.testing-apps.com";
$bd = "grupo10";
$usuario = "grupo10";
$password = "9n67H4^S9*2H";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$bd",$usuario,$password);
} catch (Exception $ex) {
    echo $ex -> getMessage();
}
?>
