<?php

require_once 'app/modelo/doctor.php';
require_once 'app/modelo/persona.php';

class MenuDoctor {
    private array $personas;

    public function __construct(array $personas) {
        $this->personas = $personas;
    }

    public function ejecutar() {
        while (true) {
            $this->mostrarMenuDoctor();
            $opcion = $this->obtenerOpcion();

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
                    echo "\nOpción inválida.\n";
            }
        }
    }

    private function obtenerOpcion() {
        return (int)readline();
    }

    private function agregarDoctor() {
        echo "\n--- AGREGAR DOCTOR ---\n";

        $apellido = readline("Apellido: ");
        $nombre = readline("Nombre: ");
        $telefono = (int)readline("Teléfono: ");
        $fecha = readline("Fecha de nacimiento (YYYY-MM-DD): ");
        $especialidad = readline("Especialidad: ");
        $horario = readline("Horario: ");

        try {
            $doctor = new Doctor($apellido, $nombre, $telefono, $fecha, $especialidad, $horario);
            $this->personas[] = $doctor;
            echo "\nDoctor agregado exitosamente!\n";
        } catch (Exception $e) {
            echo "\nError al agregar doctor: " . $e->getMessage() . "\n";
        }
    }

    private function editarDoctor() {
        if (empty($this->getDoctores())) {
            echo "\nNo hay doctores registrados.\n";
            return;
        }

        echo "\n--- EDITAR DOCTOR ---\n";
        $this->mostrarListaDoctores();

        $id = (int)readline("Seleccione el ID del doctor a editar: ");
        $doctor = $this->buscarDoctorPorId($id);

        if (!$doctor) {
            echo "\nDoctor no encontrado.\n";
            return;
        }

        echo "\nDatos actuales:\n";
        echo $doctor->mostrarInfo();

        echo "\nNuevos datos (deje vacío para mantener el actual):\n";

        $nuevoApellido = readline("Nuevo apellido: ");
        if (!empty($nuevoApellido)) {
            $doctor->setApellido($nuevoApellido);
        }

        $nuevoNombre = readline("Nuevo nombre: ");
        if (!empty($nuevoNombre)) {
            $doctor->setNombre($nuevoNombre);
        }

        $nuevoTelefono = readline("Nuevo teléfono: ");
        if (!empty($nuevoTelefono)) {
            $doctor->setTelefono((int)$nuevoTelefono);
        }

        $nuevaEspecialidad = readline("Nueva especialidad: ");
        if (!empty($nuevaEspecialidad)) {
            $doctor->setEspecialidad($nuevaEspecialidad);
        }

        $nuevoHorario = readline("Nuevo horario: ");
        if (!empty($nuevoHorario)) {
            $doctor->setHorario($nuevoHorario);
        }

        echo "\nDoctor editado exitosamente!\n";
    }

    private function eliminarDoctor() {
        if (empty($this->getDoctores())) {
            echo "\nNo hay doctores registrados.\n";
            return;
        }

        echo "\n--- ELIMINAR DOCTOR ---\n";
        $this->mostrarListaDoctores();

        $id = (int)readline("Seleccione el ID del doctor a eliminar: ");

        foreach ($this->personas as $i => $persona) {
            if ($persona instanceof Doctor && $persona->getId() == $id) {
                echo "\nEliminando doctor: " . $persona->getNombre() . " " . $persona->getApellido() . "\n";
                unset($this->personas[$i]);
                $this->personas = array_values($this->personas);
                echo "Doctor eliminado exitosamente!\n";
                return;
            }
        }

        echo "\nDoctor no encontrado.\n";
    }

    private function listarDoctores() {
        echo "\n--- LISTA DE DOCTORES ---\n";
        $this->mostrarListaDoctores();
    }

    private function buscarDoctorPorId($id) {
        foreach ($this->personas as $persona) {
            if ($persona instanceof Doctor && $persona->getId() == $id) {
                return $persona;
            }
        }
        return null;
    }

    private function getDoctores() {
        $doctores = [];
        foreach ($this->personas as $persona) {
            if ($persona instanceof Doctor) {
                $doctores[] = $persona;
            }
        }
        return $doctores;
    }

    private function mostrarMenuDoctor() {
        echo "\n--- MENÚ DOCTORES ---\n";
        echo "1. Agregar doctor\n";
        echo "2. Editar doctor\n";
        echo "3. Eliminar doctor\n";
        echo "4. Mostrar doctores\n";
        echo "5. Volver al menú principal\n";
        echo "Seleccione una opción: ";
    }

    private function mostrarListaDoctores() {
        foreach ($this->getDoctores() as $doctor) {
            echo "ID: " . $doctor->getId() . " - " . $doctor->getNombre() . " " . $doctor->getApellido() . " (" . $doctor->getEspecialidad() . ")\n";
        }
    }
}

?>
