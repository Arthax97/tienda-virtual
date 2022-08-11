<?php
$servidor = "localhost";
$basedatos = "desarrollo_aplicaciones";
$usuario = "root";
$password = "";
$mysqli = new mysqli($servidor, $usuario, $password, $basedatos);
  if ($mysqli->connect_error) {
    echo $mysqli->connect_error;
  }
  $urlweb = "http://localhost/tienda-virtual/";

?>