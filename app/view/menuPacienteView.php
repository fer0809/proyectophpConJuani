<?php
    function mostrarMenuPaciente() {
    echo "\n--- GESTIÓN DE PACIENTES ---\n";
    echo "1. Agregar Paciente\n";
    echo "2. Editar Paciente\n";
    echo "3. Eliminar Paciente\n";
    echo "4. Ver todos los pacientes\n";
    echo "5. Volver al menú principal\n";
    echo "Seleccione una opción: ";
}
// Función para mostrar todos

    function mostrarTodos($personas) {
    echo "\n--- LISTADO DE TODAS LAS PERSONAS ---\n";
    if (empty($personas)) {
        echo "No hay personas registradas.\n";
        return;
    }
    
    foreach ($personas as $persona) {
        echo $persona->mostrarInfo();
        echo "----------------------------------------\n";
    }
}
?>