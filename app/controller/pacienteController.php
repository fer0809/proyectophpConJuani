<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../view/pacienteView.php';
require_once __DIR__ . '/../modelo/paciente.php';

class PacienteController {
    private DB $db;
    private PacienteView $view;

    public function __construct(DB $db) {
        $this->db = $db;
        $this->view = new PacienteView();
    }

    public function menu() {
        while (true) {
            $this->view->mostrarMenuPaciente();
            $opcion = $this->view->obtenerOpcion();

            switch ($opcion) {
                case 1:
                    $this->agregarPaciente();
                    break;
                case 2:
                    $this->editarPaciente();
                    break;
                case 3:
                    $this->eliminarPaciente();
                    break;
                case 4:
                    $this->listarPacientes();
                    break;
                case 5:
                    return; // Volver al menú principal
                default:
                    $this->view->mostrarMensaje("Opción inválida.");
            }
        }
    }

    private function agregarPaciente() {
        $datos = $this->view->obtenerDatosPaciente();
        try {
            $this->db->agregarPaciente($datos['obra_social'], $datos['apellido'], $datos['nombre'], $datos['telefono'], $datos['fecha']);
            $this->view->mostrarMensaje("Paciente agregado exitosamente!");
        } catch (Exception $e) {
            $this->view->mostrarMensaje("Error al agregar paciente: " . $e->getMessage());
        }
    }

    private function editarPaciente() {
        $pacientes = $this->db->getAllPacientes();
        if (empty($pacientes)) {
            $this->view->mostrarMensaje("No hay pacientes registrados.");
            return;
        }
        $this->view->mostrarListaPacientes($pacientes);

        $id = $this->view->obtenerIdPaciente('editar');
        $paciente = $this->db->getPaciente($id);

        if (!$paciente) {
            $this->view->mostrarMensaje("Paciente no encontrado.");
            return;
        }

        $nuevosDatos = $this->view->obtenerDatosEdicionPaciente($paciente);

        if ($this->db->actualizarPaciente($id, $nuevosDatos)) {
            $this->view->mostrarMensaje("Paciente editado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Error al editar el paciente.");
        }
    }

    private function eliminarPaciente() {
        $pacientes = $this->db->getAllPacientes();
        if (empty($pacientes)) {
            $this->view->mostrarMensaje("No hay pacientes registrados.");
            return;
        }
        $this->view->mostrarListaPacientes($pacientes);

        $id = $this->view->obtenerIdPaciente('eliminar');

        if ($this->db->eliminarPaciente($id)) {
            $this->view->mostrarMensaje("Paciente eliminado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Paciente no encontrado.");
        }
    }

    private function listarPacientes() {
        $pacientes = $this->db->getAllPacientes();
        $this->view->mostrarListaPacientes($pacientes);
    }
}
?>