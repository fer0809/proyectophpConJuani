<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../view/turnoView.php';
require_once __DIR__ . '/../modelo/turno.php';

class TurnoController {
    private DB $db;
    private TurnoView $view;

    public function __construct(DB $db) {
        $this->db = $db;
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
        $doctores = $this->db->getAllDoctores();
        $pacientes = $this->db->getAllPacientes();
        
        if (empty($doctores) || empty($pacientes)) {
            $this->view->mostrarMensaje("Debe haber al menos un doctor y un paciente registrados para crear un turno.");
            return;
        }

        $datos = $this->view->obtenerDatosTurno($doctores, $pacientes);
        try {
            $this->db->agregarTurno($datos['fecha'], $datos['id_doctor'], $datos['id_paciente'], $datos['hora']);
            
            $doctor = $this->db->getDoctor($datos['id_doctor']);
            $paciente = $this->db->getPaciente($datos['id_paciente']);
            
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
        $turnos = $this->db->getAllTurnos();
        if (empty($turnos)) {
            $this->view->mostrarMensaje("No hay turnos registrados.");
            return;
        }
        $this->view->mostrarTurnos($turnos, $this->db);

        $id = $this->view->obtenerIdTurno('modificar');
        $turno = $this->db->getTurno($id);

        if (!$turno) {
            $this->view->mostrarMensaje("Turno no encontrado.");
            return;
        }

        $nuevosDatos = $this->view->obtenerDatosEdicionTurno($turno);

        if ($this->db->actualizarTurno($id, $nuevosDatos)) {
            $this->view->mostrarMensaje("Turno modificado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Error al modificar el turno.");
        }
    }

    private function cancelarTurno() {
        $turnos = $this->db->getAllTurnos();
        if (empty($turnos)) {
            $this->view->mostrarMensaje("No hay turnos registrados.");
            return;
        }
        $this->view->mostrarTurnos($turnos, $this->db);

        $id = $this->view->obtenerIdTurno('cancelar');

        if ($this->db->cancelarTurnoDb($id)) {
            $this->view->mostrarMensaje("Turno cancelado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Turno no encontrado.");
        }
    }

    private function mostrarTurnos() {
        $turnos = $this->db->getAllTurnos();
        $this->view->mostrarTurnos($turnos, $this->db);
    }
}
?>