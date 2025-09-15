<?php

class PacienteView {

    public function mostrarMenuPaciente() {
        echo "\n--- MENÚ PACIENTES ---\n";
        echo "1. Agregar paciente\n";
        echo "2. Editar paciente\n";
        echo "3. Eliminar paciente\n";
        echo "4. Mostrar pacientes\n";
        echo "5. Volver al menú principal\n";
        echo "Seleccione una opción: ";
    }

    public function obtenerOpcion(): int {
        return (int)readline();
    }

    public function mostrarMensaje(string $mensaje) {
        echo "\n" . $mensaje . "\n";
    }

    public function obtenerDatosPaciente(): array {
        echo "\n--- AGREGAR PACIENTE ---\n";
        $apellido = readline("Apellido: ");
        $nombre = readline("Nombre: ");
        $telefono = (int)readline("Teléfono: ");
        $fecha = readline("Fecha de nacimiento (YYYY-MM-DD): ");
        $obra_social = readline("Obra Social: ");
        return compact('apellido', 'nombre', 'telefono', 'fecha', 'obra_social');
    }

    public function obtenerDatosEdicionPaciente(Paciente $paciente): array {
        echo "\nDatos actuales:\n";
        echo $paciente->mostrarInfo();
        echo "\nNuevos datos (deje vacío para mantener el actual):\n";

        $datos = [];
        $datos['apellido'] = readline("Nuevo apellido: ");
        $datos['nombre'] = readline("Nuevo nombre: ");
        $datos['telefono'] = readline("Nuevo teléfono: ");
        $datos['obra_social'] = readline("Nueva Obra Social: ");

        return $datos;
    }

    public function obtenerIdPaciente(string $accion): int {
        echo "\n--- " . strtoupper($accion) . " PACIENTE ---\n";
        return (int)readline("Seleccione el ID del paciente a " . strtolower($accion) . ": ");
    }

    public function mostrarListaPacientes(array $pacientes) {
        echo "\n--- LISTA DE PACIENTES ---\n";
        if (empty($pacientes)) {
            echo "No hay pacientes registrados.\n";
            return;
        }
        foreach ($pacientes as $paciente) {
            echo "ID: " . $paciente->getId() . " - " . $paciente->getNombre() . " " . $paciente->getApellido() . " (" . $paciente->getObra_social() . ")\n";
        }
    }
}
?>
