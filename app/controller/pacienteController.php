<?php

require_once 'app/modelo/paciente.php';
require_once 'app/modelo/persona.php';

class MenuPaciente {
    private array $personas;

    public function __construct(array $personas) {
        $this->personas = $personas;
    }

    public function ejecutar() {
        while (true) {
            $this->mostrarMenuPaciente();
            $opcion = $this->obtenerOpcion();

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
                    return;
                default:
                    echo "\nOpción inválida.\n";
            }
        }
    }

    private function obtenerOpcion() {
        return (int)readline();
    }

    private function agregarPaciente() {
        echo "\n--- AGREGAR PACIENTE ---\n";

        $apellido = readline("Apellido: ");
        $nombre = readline("Nombre: ");
        $telefono = (int)readline("Teléfono: ");
        $fecha = readline("Fecha de nacimiento (YYYY-MM-DD): ");
        $obra_social = readline("Obra social: ");

        try {
            $paciente = new Paciente($obra_social, $apellido, $nombre, $telefono, $fecha);
            $this->personas[] = $paciente;
            echo "\nPaciente agregado exitosamente!\n";
        } catch (Exception $e) {
            echo "\nError al agregar paciente: " . $e->getMessage() . "\n";
        }
    }

    private function editarPaciente() {
        if (empty($this->getPacientes())) {
            echo "\nNo hay pacientes registrados.\n";
            return;
        }

        echo "\n--- EDITAR PACIENTE ---\n";
        $this->mostrarListaPacientes();

        $id = (int)readline("Seleccione el ID del paciente a editar: ");
        $paciente = $this->buscarPacientePorId($id);

        if (!$paciente) {
            echo "\nPaciente no encontrado.\n";
            return;
        }

        echo "\nDatos actuales:\n";
        echo $paciente->mostrarInfo();

        echo "\nNuevos datos (deje vacío para mantener el actual):\n";

        $nuevoApellido = readline("Nuevo apellido: ");
        if (!empty($nuevoApellido)) {
            $paciente->setApellido($nuevoApellido);
        }

        $nuevoNombre = readline("Nuevo nombre: ");
        if (!empty($nuevoNombre)) {
            $paciente->setNombre($nuevoNombre);
        }

        $nuevoTelefono = readline("Nuevo teléfono: ");
        if (!empty($nuevoTelefono)) {
            $paciente->setTelefono((int)$nuevoTelefono);
        }

        $nuevaObraSocial = readline("Nueva obra social: ");
        if (!empty($nuevaObraSocial)) {
            $paciente->setObra_social($nuevaObraSocial);
        }

        echo "\nPaciente editado exitosamente!\n";
    }

    private function eliminarPaciente() {
        if (empty($this->getPacientes())) {
            echo "\nNo hay pacientes registrados.\n";
            return;
        }

        echo "\n--- ELIMINAR PACIENTE ---\n";
        $this->mostrarListaPacientes();

        $id = (int)readline("Seleccione el ID del paciente a eliminar: ");

        foreach ($this->personas as $i => $persona) {
            if ($persona instanceof Paciente && $persona->getId() == $id) {
                echo "\nEliminando paciente: " . $persona->getNombre() . " " . $persona->getApellido() . "\n";
                unset($this->personas[$i]);
                $this->personas = array_values($this->personas);
                echo "Paciente eliminado exitosamente!\n";
                return;
            }
        }

        echo "\nPaciente no encontrado.\n";
    }

    private function listarPacientes() {
        echo "\n--- LISTA DE PACIENTES ---\n";
        $this->mostrarListaPacientes();
    }

    private function buscarPacientePorId($id) {
        foreach ($this->personas as $persona) {
            if ($persona instanceof Paciente && $persona->getId() == $id) {
                return $persona;
            }
        }
        return null;
    }

    private function getPacientes() {
        $pacientes = [];
        foreach ($this->personas as $persona) {
            if ($persona instanceof Paciente) {
                $pacientes[] = $persona;
            }
        }
        return $pacientes;
    }

    private function mostrarMenuPaciente() {
        echo "\n--- MENÚ PACIENTES ---\n";
        echo "1. Agregar paciente\n";
        echo "2. Editar paciente\n";
        echo "3. Eliminar paciente\n";
        echo "4. Mostrar pacientes\n";
        echo "5. Volver al menú principal\n";
        echo "Seleccione una opción: ";
    }

    private function mostrarListaPacientes() {
        foreach ($this->getPacientes() as $paciente) {
            echo "ID: " . $paciente->getId() . " - " . $paciente->getNombre() . " " . $paciente->getApellido() . " (" . $paciente->getObra_social() . ")\n";
        }
    }
}

?>