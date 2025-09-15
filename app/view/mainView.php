<?php

class MainView {

    public function mostrarMenuPrincipal() {
        echo "\n--- SISTEMA DE GESTIÓN DE TURNOS MÉDICOS ---\n";
        echo "1. Gestionar Doctores\n";
        echo "2. Gestionar Pacientes\n";
        echo "3. Gestionar Turnos\n";
        echo "4. Salir\n";
        echo "Seleccione una opción: ";
    }

    public function obtenerOpcion(): int {
        return (int)readline();
    }

    public function mostrarMensaje(string $mensaje) {
        echo "\n" . $mensaje . "\n";
    }
}
?>
