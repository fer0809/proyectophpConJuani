<?php

require_once 'app/controller/menuController.php';

echo "BIENVENIDO AL SISTEMA DE GESTIÓN MÉDICA
";
echo "==========================================

";

$menu = new Menu();
$menu->ejecutar();

?>