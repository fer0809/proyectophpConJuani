<?php

class TurnoView {

    public function mostrarMenuTurnos() {
        echo "\n--- MENÚ TURNOS ---\n";
        echo "1. Crear turno\n";
        echo "2. Modificar turno\n";
        echo "3. Cancelar turno\n";
        echo "4. Mostrar turnos\n";
        echo "5. Volver al menú principal\n";
        echo "Seleccione una opción: ";
    }

    public function obtenerOpcion(): int {
        return (int)readline();
    }

    public function mostrarMensaje(string $mensaje) {
        echo "\n" . $mensaje . "\n";
    }

    public function obtenerDatosTurno(array $doctores, array $pacientes): array {
        echo "\n--- CREAR TURNO ---\n";
        $this->mostrarListaDoctores($doctores);
        $id_doctor = (int)readline("ID del doctor: ");

        $this->mostrarListaPacientes($pacientes);
        $id_paciente = (int)readline("ID del paciente: ");

        $fecha = readline("Fecha (YYYY-MM-DD): ");
        $hora = readline("Hora (HH:MM): ");

        return compact('id_doctor', 'id_paciente', 'fecha', 'hora');
    }

    public function obtenerIdTurno(string $accion): int {
        return (int)readline("Seleccione el ID del turno a " . strtolower($accion) . ": ");
    }
    
    public function obtenerDatosEdicionTurno(Turno $turno): array {
        echo "\nDatos actuales del turno:\n";
        echo "Fecha: " . $turno->getFecha() . "\n";
        echo "Hora: " . $turno->getHora() . "\n";
        echo "\nNuevos datos (deje vacío para mantener el actual):\n";
        
        $datos = [];
        $datos['fecha'] = readline("Nueva fecha (YYYY-MM-DD): ");
        $datos['hora'] = readline("Nueva hora (HH:MM): ");
        
        return $datos;
    }

    public function mostrarTurnos(array $turnosData) {
        echo "\n--- LISTADO DE TURNOS ---\n";
        if (empty($turnosData)) {
            echo "No hay turnos registrados.\n";
            return;
        }

        foreach ($turnosData as $data) {
            echo "Turno ID: " . $data['id'] . "\n";
            echo "Fecha: " . $data['fecha'] . "\n";
            echo "Hora: " . $data['hora'] . "\n";
            echo "Estado: " . $data['estado'] . "\n";
            echo "Doctor: " . $data['doctor'] . "\n";
            echo "Paciente: " . $data['paciente'] . "\n";
            echo "----------------------------------------\n";
        }
    }

    private function mostrarListaDoctores(array $doctores) {
        echo "\nDoctores disponibles:\n";
        foreach ($doctores as $doctor) {
            echo "ID: " . $doctor->getId() . " - " . $doctor->getNombre() . " " . $doctor->getApellido() . "\n";
        }
    }

    private function mostrarListaPacientes(array $pacientes) {
        echo "\nPacientes disponibles:\n";
        foreach ($pacientes as $paciente) {
            echo "ID: " . $paciente->getId() . " - " . $paciente->getNombre() . " " . $paciente->getApellido() . "\n";
        }
    }
}
?>