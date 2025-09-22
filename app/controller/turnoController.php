<?php

require_once __DIR__ . '/../view/turnoView.php';
require_once __DIR__ . '/../modelo/turnoModelo.php';
require_once __DIR__ . '/../modelo/doctorModelo.php';
require_once __DIR__ . '/../modelo/pacienteModelo.php';

class TurnoController {
    private TurnoModelo $turnoModelo;
    private DoctorModelo $doctorModelo;
    private PacienteModelo $pacienteModelo;
    private TurnoView $view;

    public function __construct() {
        $this->turnoModelo = new TurnoModelo();
        $this->doctorModelo = new DoctorModelo();
        $this->pacienteModelo = new PacienteModelo();
        $this->view = new TurnoView();
    }

    public function menu() {
        while (true) {
            $this->view->mostrarMenuTurnos();
            $opcion = $this->view->obtenerOpcion();

            switch ($opcion) {
                case 1:
                    $this->crearTurno();
                    break;
                case 2:
                    $this->modificarTurno();
                    break;
                case 3:
                    $this->cancelarTurno();
                    break;
                case 4:
                    $this->mostrarTurnos();
                    break;
                case 5:
                    return; // Volver al menú principal
                default:
                    $this->view->mostrarMensaje("Opción inválida.");
            }
        }
    }

    private function crearTurno() {
        $doctores = $this->doctorModelo->obtenerTodosLosDoctores();
        $pacientes = $this->pacienteModelo->obtenerTodosLosPacientes();
        
        if (empty($doctores) || empty($pacientes)) {
            $this->view->mostrarMensaje("Debe haber al menos un doctor y un paciente registrados para crear un turno.");
            return;
        }

        $datos = $this->view->obtenerDatosTurno($doctores, $pacientes);
        try {
            $this->turnoModelo->agregarTurno($datos['fecha'], $datos['id_doctor'], $datos['id_paciente'], $datos['hora']);
            
            $doctor = $this->doctorModelo->obtenerDoctorPorId($datos['id_doctor']);
            $paciente = $this->pacienteModelo->obtenerPacientePorId($datos['id_paciente']);
            
            if($doctor && $paciente) {
                $doctor->agregarPaciente($paciente->getId());
                $paciente->agregarDoctor($doctor->getId());
            }

            $this->view->mostrarMensaje("Turno creado y asignado exitosamente!");
        } catch (Exception $e) {
            $this->view->mostrarMensaje("Error al crear turno: " . $e->getMessage());
        }
    }

    private function modificarTurno() {
        $turnos = $this->turnoModelo->obtenerTodosLosTurnos();
        if (empty($turnos)) {
            $this->view->mostrarMensaje("No hay turnos registrados.");
            return;
        }
        $this->mostrarTurnos(); // Muestra la lista para que el usuario elija

        $id = $this->view->obtenerIdTurno('modificar');
        $turno = $this->turnoModelo->obtenerTurnoPorId($id);

        if (!$turno) {
            $this->view->mostrarMensaje("Turno no encontrado.");
            return;
        }

        $nuevosDatos = $this->view->obtenerDatosEdicionTurno($turno);

        if ($this->turnoModelo->actualizarTurno($id, $nuevosDatos)) {
            $this->view->mostrarMensaje("Turno modificado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Error al modificar el turno.");
        }
    }

    private function cancelarTurno() {
        $turnos = $this->turnoModelo->obtenerTodosLosTurnos();
        if (empty($turnos)) {
            $this->view->mostrarMensaje("No hay turnos registrados.");
            return;
        }
        $this->mostrarTurnos(); // Muestra la lista para que el usuario elija

        $id = $this->view->obtenerIdTurno('cancelar');

        if ($this->turnoModelo->cancelarTurno($id)) {
            $this->view->mostrarMensaje("Turno cancelado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Turno no encontrado.");
        }
    }

    private function mostrarTurnos() {
        $turnos = $this->turnoModelo->obtenerTodosLosTurnos();
        $turnosData = [];
        foreach ($turnos as $turno) {
            $doctor = $this->doctorModelo->obtenerDoctorPorId($turno->getId_doctor());
            $paciente = $this->pacienteModelo->obtenerPacientePorId($turno->getId_paciente());

            $turnosData[] = [
                'id' => $turno->getId(),
                'fecha' => $turno->getFecha(),
                'hora' => $turno->getHora(),
                'estado' => $turno->getEstado() ? "Activo" : "Cancelado",
                'doctor' => $doctor ? $doctor->getNombre() . " " . $doctor->getApellido() : "No encontrado",
                'paciente' => $paciente ? $paciente->getNombre() . " " . $paciente->getApellido() : "No encontrado",
            ];
        }
        $this->view->mostrarTurnos($turnosData);
    }
}
?>