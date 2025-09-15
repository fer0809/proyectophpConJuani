<?php

require_once 'view/menu.php';

echo "BIENVENIDO AL SISTEMA DE GESTIÓN MÉDICA\n";
echo "==========================================\n\n";

$menu = new Menu();
$menu->ejecutar();

?> 