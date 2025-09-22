<?php
require_once __DIR__ . '/../modelo/doctor.php';
require_once __DIR__ . '/../modelo/paciente.php';
require_once __DIR__ . '/../modelo/turno.php';

class DB {
    private static ?DB $instance = null;
    private array $doctores;
    private array $pacientes;
    private array $turnos;

    private function __construct() {
        $this->doctores = [];
        $this->pacientes = [];
        $this->turnos = [];
    }

    public static function getInstance(): DB {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() {}
    public function __wakeup() {}

    // Métodos para Doctores
    public function agregarDoctor(string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento, string $especialidad, string $horario): Doctor {
        $doctor = new Doctor($apellido, $nombre, $telefono, $fecha_de_nacimiento, $especialidad, $horario);
        $this->doctores[$doctor->getId()] = $doctor;
        return $doctor;
    }

    public function getDoctor(int $id): ?Doctor {
        return $this->doctores[$id] ?? null;
    }

    public function getAllDoctores(): array {
        return $this->doctores;
    }

    public function actualizarDoctor(int $id, array $datos): bool {
        $doctor = $this->getDoctor($id);
        if (!$doctor) {
            return false;
        }

        if (!empty($datos['apellido'])) {
            $doctor->setApellido($datos['apellido']);
        }
        if (!empty($datos['nombre'])) {
            $doctor->setNombre($datos['nombre']);
        }
        if (!empty($datos['telefono'])) {
            $doctor->setTelefono((int)$datos['telefono']);
        }
        if (!empty($datos['especialidad'])) {
            $doctor->setEspecialidad($datos['especialidad']);
        }
        if (!empty($datos['horario'])) {
            $doctor->setHorario($datos['horario']);
        }
        return true;
    }

    public function eliminarDoctor(int $id): bool {
        if (isset($this->doctores[$id])) {
            unset($this->doctores[$id]);
            return true;
        }
        return false;
    }

    // Métodos para Pacientes
    public function agregarPaciente(string $obra_social, string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento): Paciente {
        $paciente = new Paciente($obra_social, $apellido, $nombre, $telefono, $fecha_de_nacimiento);
        $this->pacientes[$paciente->getId()] = $paciente;
        return $paciente;
    }

    public function getPaciente(int $id): ?Paciente {
        return $this->pacientes[$id] ?? null;
    }

    public function getAllPacientes(): array {
        return $this->pacientes;
    }

    public function actualizarPaciente(int $id, array $datos): bool {
        $paciente = $this->getPaciente($id);
        if (!$paciente) {
            return false;
        }

        if (!empty($datos['apellido'])) {
            $paciente->setApellido($datos['apellido']);
        }
        if (!empty($datos['nombre'])) {
            $paciente->setNombre($datos['nombre']);
        }
        if (!empty($datos['telefono'])) {
            $paciente->setTelefono((int)$datos['telefono']);
        }
        if (!empty($datos['obra_social'])) {
            $paciente->setObra_social($datos['obra_social']);
        }
        return true;
    }

    public function eliminarPaciente(int $id): bool {
        if (isset($this->pacientes[$id])) {
            unset($this->pacientes[$id]);
            return true;
        }
        return false;
    }

    // Métodos para Turnos
    public function agregarTurno(string $fecha, int $id_doctor, int $id_paciente, string $hora): Turno {
        if (!isset($this->doctores[$id_doctor]) || !isset($this->pacientes[$id_paciente])) {
            throw new Exception("Doctor o Paciente no encontrado.");
        }

        $turno = new Turno($fecha, $id_doctor, $id_paciente, $hora);
        $this->turnos[$turno->getId()] = $turno;
        return $turno;
    }

    public function getTurno(int $id): ?Turno {
        return $this->turnos[$id] ?? null;
    }

    public function getAllTurnos(): array {
        return $this->turnos;
    }

    public function actualizarTurno(int $id, array $datos): bool {
        $turno = $this->getTurno($id);
        if (!$turno) {
            return false;
        }

        if (!empty($datos['fecha'])) {
            $turno->setFecha($datos['fecha']);
        }
        if (!empty($datos['hora'])) {
            $turno->setHora($datos['hora']);
        }
        return true;
    }

    public function cancelarTurnoDb(int $id): bool {
        return $this->eliminarTurno($id);
    }

    public function eliminarTurno(int $id): bool {
        if (isset($this->turnos[$id])) {
            unset($this->turnos[$id]);
            return true;
        }
        return false;
    }
}
?>