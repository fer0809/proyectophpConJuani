<?php
require_once __DIR__ . '/../db/db.php';

class TurnoModelo{
    private DB $db;

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function obtenerTodosLosTurnos() {
        return $this->db->getAllTurnos();
    }

    public function obtenerTurnoPorId(int $id) {
        return $this->db->getTurno($id);
    }

    public function agregarTurno(string $fecha, int $id_doctor, int $id_paciente, string $hora) {
        return $this->db->agregarTurno($fecha, $id_doctor, $id_paciente, $hora);
    }

    public function actualizarTurno(int $id, array $datos) {
        return $this->db->actualizarTurno($id, $datos);
    }

    public function eliminarTurno(int $id) {
        return $this->db->eliminarTurno($id);
    }
}
?>