<?php

require_once 'app/view/menuPrincipal.php';
require_once 'app/modelo/persona.php';
require_once 'app/modelo/doctor.php';
require_once 'app/modelo/paciente.php';
require_once 'app/modelo/turno.php';
require_once 'app/controller/doctorController.php';
require_once 'app/controller/pacienteController.php';

class Menu {
    private $menuDoctor;
    private $menuPaciente;
    private array $personas = [];
    private array $turnos = [];

    public function __construct() {
        $this->cargarDatos();
        $this->menuDoctor = new MenuDoctor($this->personas);
        $this->menuPaciente = new MenuPaciente($this->personas);
    }

    public function ejecutar() {
        while (true) {
            mostrarMenuPrincipal();
            $opcion = $this->obtenerOpcion();

            switch ($opcion) {
                case 1:
                    $this->menuDoctores();
                    break;
                case 2:
                    $this->menuPacientes();
                    break;
                case 3:
                    $this->menuTurnos();
                    break;
                case 4:
                    echo "\n¡Gracias por usar la aplicación!\n";
                    exit(0);
                default:
                    echo "\nOpción inválida. Intente nuevamente.\n";
            }
        }
    }

    private function obtenerOpcion() {
        return (int)readline();
    }

    private function menuDoctores() {
        $this->menuDoctor->ejecutar();
    }

    private function menuPacientes() {
        $this->menuPaciente->ejecutar();
    }

    private function menuTurnos() {
        while (true) {
            $this->mostrarMenuTurnos();
            $opcion = $this->obtenerOpcion();

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
                    return;
                default:
                    echo "\nOpción inválida.\n";
            }
        }
    }

    private function crearTurno() {
        echo "\n--- CREAR TURNO ---\n";

        $fecha = readline("Fecha (YYYY-MM-DD): ");
        $hora = readline("Hora (HH:MM): ");

        echo "\nDoctores disponibles:\n";
        $this->mostrarListaDoctores();
        $id_doctor = (int)readline("ID del doctor: ");

        echo "\nPacientes disponibles:\n";
        $this->mostrarListaPacientes();
        $id_paciente = (int)readline("ID del paciente: ");

        try {
            $turno = new Turno($fecha, $id_doctor, $id_paciente, $hora, false);
            $this->turnos[] = $turno;
            echo "\nTurno creado exitosamente!\n";
        } catch (Exception $e) {
            echo "\nError al crear turno: " . $e->getMessage() . "\n";
        }
    }

    private function modificarTurno() {
        if (empty($this->turnos)) {
            echo "\nNo hay turnos registrados.\n";
            return;
        }

        echo "\n--- MODIFICAR TURNO ---\n";
        $this->mostrarListaTurnos();

        $indice = (int)readline("Seleccione el número de turno a modificar: ") - 1;

        if ($indice < 0 || $indice >= count($this->turnos)) {
            echo "\nTurno no encontrado.\n";
            return;
        }

        $turno = $this->turnos[$indice];

        echo "\nDatos actuales del turno:\n";
        echo "Fecha: " . $turno->getFecha() . "\n";
        echo "Hora: " . $turno->getHora() . "\n";
        echo "Estado: " . ($turno->getEstado() ? "Confirmado" : "Pendiente") . "\n";

        echo "\nNuevos datos (deje vacío para mantener el actual):\n";

        $nuevaFecha = readline("Nueva fecha (YYYY-MM-DD): ");
        if (!empty($nuevaFecha)) {
            $turno->setFecha($nuevaFecha);
        }

        $nuevaHora = readline("Nueva hora (HH:MM): ");
        if (!empty($nuevaHora)) {
            $turno->setHora($nuevaHora);
        }

        echo "\nTurno modificado exitosamente!\n";
    }

    private function cancelarTurno() {
        if (empty($this->turnos)) {
            echo "\nNo hay turnos registrados.\n";
            return;
        }

        echo "\n--- CANCELAR TURNO ---\n";
        $this->mostrarListaTurnos();

        $indice = (int)readline("Seleccione el número de turno a cancelar: ") - 1;

        if ($indice < 0 || $indice >= count($this->turnos)) {
            echo "\nTurno no encontrado.\n";
            return;
        }

        echo "\nCancelando turno...\n";
        unset($this->turnos[$indice]);
        $this->turnos = array_values($this->turnos);
        echo "Turno cancelado exitosamente!\n";
    }

    private function mostrarTurnos() {
        if (empty($this->turnos)) {
            echo "\nNo hay turnos registrados.\n";
            return;
        }

        echo "\n--- LISTADO DE TURNOS ---\n";
        foreach ($this->turnos as $index => $turno) {
            $doctor = $this->buscarDoctorPorId($turno->getId_doctor());
            $paciente = $this->buscarPacientePorId($turno->getId_paciente());

            echo "Turno #" . ($index + 1) . "\n";
            echo "Fecha: " . $turno->getFecha() . "\n";
            echo "Hora: " . $turno->getHora() . "\n";
            echo "Estado: " . ($turno->getEstado() ? "Confirmado" : "Pendiente") . "\n";

            if ($doctor) {
                echo "Doctor: " . $doctor->getNombre() . " " . $doctor->getApellido() . " (" . $doctor->getEspecialidad() . ")\n";
            }

            if ($paciente) {
                echo "Paciente: " . $paciente->getNombre() . " " . $paciente->getApellido() . "\n";
            }

            echo "----------------------------------------\n";
        }
    }

    private function mostrarListaDoctores() {
        $doctores = $this->obtenerDoctores();
        foreach ($doctores as $doctor) {
            echo "ID: " . $doctor->getId() . " - " . $doctor->getNombre() . " " . $doctor->getApellido() . " (" . $doctor->getEspecialidad() . ")\n";
        }
    }

    private function mostrarListaPacientes() {
        $pacientes = $this->obtenerPacientes();
        foreach ($pacientes as $paciente) {
            echo "ID: " . $paciente->getId() . " - " . $paciente->getNombre() . " " . $paciente->getApellido() . " (" . $paciente->getObra_social() . ")\n";
        }
    }

    private function mostrarListaTurnos() {
        foreach ($this->turnos as $index => $turno) {
            $doctor = $this->buscarDoctorPorId($turno->getId_doctor());
            $paciente = $this->buscarPacientePorId($turno->getId_paciente());

            echo "Turno #" . ($index + 1) . " - " . $turno->getFecha() . " " . $turno->getHora();
            if ($doctor) {
                echo " - Dr. " . $doctor->getApellido();
            }
            if ($paciente) {
                echo " - " . $paciente->getApellido();
            }
            echo " - " . ($turno->getEstado() ? "Confirmado" : "Pendiente") . "\n";
        }
    }

    private function obtenerDoctores() {
        $doctores = [];
        foreach ($this->personas as $persona) {
            if ($persona instanceof Doctor) {
                $doctores[] = $persona;
            }
        }
        return $doctores;
    }

    private function obtenerPacientes() {
        $pacientes = [];
        foreach ($this->personas as $persona) {
            if ($persona instanceof Paciente) {
                $pacientes[] = $persona;
            }
        }
        return $pacientes;
    }

    private function buscarDoctorPorId($id) {
        foreach ($this->personas as $persona) {
            if ($persona instanceof Doctor && $persona->getId() == $id) {
                return $persona;
            }
        }
        return null;
    }

    private function buscarPacientePorId($id) {
        foreach ($this->personas as $persona) {
            if ($persona instanceof Paciente && $persona->getId() == $id) {
                return $persona;
            }
        }
        return null;
    }

    private function cargarDatos() {
        if (empty($this->personas)) {
            $this->personas[] = new Doctor("García", "María", 123456789, "1980-05-15", "Cardiología", "Lunes a Viernes 8-16hs");
            $this->personas[] = new Doctor("López", "Carlos", 987654321, "1975-03-20", "Dermatología", "Martes a Sábado 9-17hs");
            $this->personas[] = new Paciente("OSDE", "Pérez", "Ana", 111222333, "1990-08-10");
            $this->personas[] = new Paciente("Swiss Medical", "Rodríguez", "Juan", 444555666, "1985-12-03");
        }
    }

    private function mostrarMenuTurnos() {
        echo "\n--- MENÚ TURNOS ---\n";
        echo "1. Crear turno\n";
        echo "2. Modificar turno\n";
        echo "3. Cancelar turno\n";
        echo "4. Mostrar turnos\n";
        echo "5. Volver al menú principal\n";
        echo "Seleccione una opción: ";
    }
}

?>