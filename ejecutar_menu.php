<?php

// Archivo para ejecutar el menú de la aplicación
require_once './Menu.php';

echo "🏥 BIENVENIDO AL SISTEMA DE GESTIÓN MÉDICA\n";
echo "==========================================\n\n";

// Crear y ejecutar el menú
$menu = new Menu();
$menu->ejecutar();

?> 