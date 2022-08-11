<?php
require "config.php";
require "funciones.class.php";
$funciones = new funciones($mysqli);
$modulo = isset($_GET['modulo']) ? $_GET['modulo'] : 'home';
require 'app/index.php';
?>