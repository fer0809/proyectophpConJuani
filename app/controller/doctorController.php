<?php
require_once __DIR__ . '/../view/doctorView.php';
require_once __DIR__ . '/../modelo/doctorModelo.php';

class DoctorController {
    private DoctorModelo $modelo;
    private DoctorView $view;

    public function __construct() {
        $this->modelo = new DoctorModelo();
        $this->view = new DoctorView();
    }

    public function menu() {
        // Inicializar DB con datos de prueba si está vacía
        if (empty($this->modelo->obtenerTodosLosDoctores())) {
            $this->modelo->agregarDoctor("García", "Ana", 11223344, "1985-03-10", "Pediatría", "L-V 8-14");
            $this->modelo->agregarDoctor("Rodriguez", "Carlos", 99887766, "1979-11-22", "Cardiología", "L-M-V 14-20");
        }

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
                    return;
                default:
                    $this->view->mostrarMensaje("Opción inválida.");
            }
        }
    }

    public function agregarDoctor() {
        $datos = $this->view->obtenerDatosDoctor();
        try {
            $this->modelo->agregarDoctor($datos['apellido'], $datos['nombre'], $datos['telefono'], $datos['fecha'], $datos['especialidad'], $datos['horario']);
            $this->view->mostrarMensaje("Doctor agregado exitosamente!");
        } catch (Exception $e) {
            $this->view->mostrarMensaje("Error al agregar doctor: " . $e->getMessage());
        }
    }

    public function editarDoctor() {
        $doctores = $this->modelo->obtenerTodosLosDoctores();
        if (empty($doctores)) {
            $this->view->mostrarMensaje("No hay doctores registrados.");
            return;
        }
        $this->view->mostrarListaDoctores($doctores);
        
        $id = $this->view->obtenerIdDoctor('editar');
        $doctor = $this->modelo->obtenerDoctorPorId($id);

        if (!$doctor) {
            $this->view->mostrarMensaje("Doctor no encontrado.");
            return;
        }

        $nuevosDatos = $this->view->obtenerDatosEdicionDoctor($doctor);
        
        if ($this->modelo->actualizarDoctor($id, $nuevosDatos)) {
            $this->view->mostrarMensaje("Doctor editado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Error al editar el doctor.");
        }
    }

    public function eliminarDoctor() {
        $doctores = $this->modelo->obtenerTodosLosDoctores();
        if (empty($doctores)) {
            $this->view->mostrarMensaje("No hay doctores registrados.");
            return;
        }
        $this->view->mostrarListaDoctores($doctores);

        $id = $this->view->obtenerIdDoctor('eliminar');

        if ($this->modelo->eliminarDoctor($id)) {
            $this->view->mostrarMensaje("Doctor eliminado exitosamente!");
        } else {
            $this->view->mostrarMensaje("Doctor no encontrado.");
        }
    }

    public function listarDoctores() {
        $doctores = $this->modelo->obtenerTodosLosDoctores();
        $this->view->mostrarListaDoctores($doctores);
    }
}
?>