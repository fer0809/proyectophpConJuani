<?php

require_once './Menu.php';

echo "BIENVENIDO AL SISTEMA DE GESTIÓN MÉDICA\n";
echo "==========================================\n\n";

$menu = new Menu();
$menu->ejecutar();

?> 