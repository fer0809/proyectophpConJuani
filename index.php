<?php

require_once __DIR__ . '/app/db/db.php';
require_once __DIR__ . '/app/controller/menuController.php';

// 1. Inicializar la base de datos en memoria
$db = DB::getInstance();

// 2. Cargar datos iniciales (seeding)
function seedData(DB $db) {
    // Doctores
    $db->agregarDoctor("García", "María", 123456789, "1980-05-15", "Cardiología", "Lunes a Viernes 8-16hs");
    $db->agregarDoctor("López", "Carlos", 987654321, "1975-03-20", "Dermatología", "Martes a Sábado 9-17hs");

    // Pacientes
    $db->agregarPaciente("OSDE", "Pérez", "Ana", 111222333, "1990-08-10");
    $db->agregarPaciente("Swiss Medical", "Rodríguez", "Juan", 444555666, "1985-12-03");
    
    // Turnos de ejemplo
    try {
        $db->agregarTurno("2025-10-20", 1, 3, "10:00");
        $db->agregarTurno("2025-10-21", 2,  4, "11:30");
    } catch (Exception $e) {
        // Manejar excepción si ocurre durante la creación de turnos
        echo "Error al crear turnos iniciales: " . $e->getMessage() . "\n";
    }
}

seedData($db);

// 3. Inicializar el controlador principal
$menuController = new MenuController($db);

// 4. Ejecutar la aplicación
$menuController->ejecutar();

?>