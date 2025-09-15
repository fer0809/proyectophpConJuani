<?php

require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/../view/doctorView.php';
require_once __DIR__ . '/../modelo/doctor.php';

class DoctorController {
    private DB $db;
    private DoctorView $view;

    public function __construct(DB $db) {
        $this->db = $db;
        $this->view = new DoctorView();
    }

    public function menu() {
        while (true) {
            $this->view->mostrarMenuDoctor();
            $opcion = $this->view->obtenerOpcion();

            switch ($opcion) {
                case 1:
                    $this->agregarDoctor();
                    break;
                case 2:
                    $this->editarDoctor();
                    break;
                case 3:
                    $this->eliminarDoctor();
                    break;
                case 4:
                    $this->listarDoctores();
                    break;
                case 5:
                    return; // Volver al menú principal
                default:
                    $this->view->mostrarMensaje("Opción inválida.");
            }
        }
    }

    private function agregarDoctor() {
        $datos = $this->view->obtenerDatosDoctor();
        try {
            $this->db->agregarDoctor($datos['apellido'], $datos['nombre'], $datos['telefono'], $datos['fecha'], $datos['especialidad'], $datos['horario']);
            $this->view->mostrarMensaje("Doctor agregado exitosamente!");
        } catch (Exception $e) {
            $this->view->mostrarMensaje("Error al agregar doctor: " . $e->getMessage());
        }
    }

    private function editarDoctor() {
        $doctores = $this->db->getAllDoctores();
        if (empty($doctores)) {
            $this->view->mostrarMensaje("No hay doctores registrados.");
            return;
        }
        $this->view->mostrarListaDoctores($doctores);
        
        $id = $this->view->obtenerIdDoctor('editar');
        $doctor = $this->db->getDoctor($id);

        if (!$doctor) {
            $this->view->mostrarMensaje("Doctor no encontrado.");
            return;
        }

        $nuevosDatos = $this->view->obtenerDatosEdicionDoctor($doctor);
        
        if ($this->db->actualizarDoctor($id, $nuevosDatos)) {
            $this->view->mostrarMensaje("Doctor editado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Error al editar el doctor."); // Should not happen if ID exists
        }
    }

    private function eliminarDoctor() {
        $doctores = $this->db->getAllDoctores();
        if (empty($doctores)) {
            $this->view->mostrarMensaje("No hay doctores registrados.");
            return;
        }
        $this->view->mostrarListaDoctores($doctores);

        $id = $this->view->obtenerIdDoctor('eliminar');

        if ($this->db->eliminarDoctor($id)) {
            $this->view->mostrarMensaje("Doctor eliminado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Doctor no encontrado.");
        }
    }

    private function listarDoctores() {
        $doctores = $this->db->getAllDoctores();
        $this->view->mostrarListaDoctores($doctores);
    }
}
?>