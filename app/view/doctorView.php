<?php

class DoctorView {

    public function mostrarMenuDoctor() {
        echo "\n--- MENÚ DOCTORES ---\n";
        echo "1. Agregar doctor\n";
        echo "2. Editar doctor\n";
        echo "3. Eliminar doctor\n";
        echo "4. Mostrar doctores\n";
        echo "5. Volver al menú principal\n";
        echo "Seleccione una opción: ";
    }

    public function obtenerOpcion(): int {
        return (int)readline();
    }

    public function mostrarMensaje(string $mensaje) {
        echo "\n" . $mensaje . "\n";
    }

    public function obtenerDatosDoctor(): array {
        echo "\n--- AGREGAR DOCTOR ---\n";
        $apellido = readline("Apellido: ");
        $nombre = readline("Nombre: ");
        $telefono = (int)readline("Teléfono: ");
        $fecha = readline("Fecha de nacimiento (YYYY-MM-DD): ");
        $especialidad = readline("Especialidad: ");
        $horario = readline("Horario: ");
        return compact('apellido', 'nombre', 'telefono', 'fecha', 'especialidad', 'horario');
    }

    public function obtenerDatosEdicionDoctor(Doctor $doctor): array {
        echo "\nDatos actuales:\n";
        echo $doctor->mostrarInfo();
        echo "\nNuevos datos (deje vacío para mantener el actual):\n";

        $datos = [];
        $datos['apellido'] = readline("Nuevo apellido: ");
        $datos['nombre'] = readline("Nuevo nombre: ");
        $datos['telefono'] = readline("Nuevo teléfono: ");
        $datos['especialidad'] = readline("Nueva especialidad: ");
        $datos['horario'] = readline("Nuevo horario: ");

        return $datos;
    }

    public function obtenerIdDoctor(string $accion): int {
        echo "\n--- " . strtoupper($accion) . " DOCTOR ---\n";
        return (int)readline("Seleccione el ID del doctor a " . strtolower($accion) . ": ");
    }

    public function mostrarListaDoctores(array $doctores) {
        echo "\n--- LISTA DE DOCTORES ---\n";
        if (empty($doctores)) {
            echo "No hay doctores registrados.\n";
            return;
        }
        foreach ($doctores as $doctor) {
            echo "ID: " . $doctor->getId() . " - " . $doctor->getNombre() . " " . $doctor->getApellido() . " (" . $doctor->getEspecialidad() . ")\n";
        }
    }
}
?>