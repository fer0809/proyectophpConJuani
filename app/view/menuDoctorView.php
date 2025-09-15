<?php
function mostrarDoctores() {
    if (empty($this->doctores)) {
        echo "\nNo hay doctores registrados.\n";
        return;
    }
    
    echo "\n--- LISTADO DE DOCTORES ---\n";
    foreach ($this->doctores as $doctor) {
        echo $doctor->mostrarInfo();
        echo "----------------------------------------\n";
    }
}
function mostrarMenuDoctor() {
    echo "\n--- GESTIÓN DE DOCTORES ---\n";
    echo "1. Agregar Doctor\n";
    echo "2. Editar Doctor\n";
    echo "3. Eliminar Doctor\n";
    echo "4. Ver todos los doctores\n";
    echo "5. Volver al menú principal\n";
    echo "Seleccione una opción: ";
}
?>
