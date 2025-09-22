<?php
require_once __DIR__ . '/../db/db.php';

class PacienteModelo{
    private DB $db;

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function obtenerTodosLosPacientes() {
        return $this->db->getAllPacientes();
    }

    public function obtenerPacientePorId(int $id) {
        return $this->db->getPaciente($id);
    }

    public function agregarPaciente(string $obra_social, string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento) {
        return $this->db->agregarPaciente($obra_social, $apellido, $nombre, $telefono, $fecha_de_nacimiento);
    }

    public function actualizarPaciente(int $id, array $datos) {
        return $this->db->actualizarPaciente($id, $datos);
    }

    public function eliminarPaciente(int $id) {
        return $this->db->eliminarPaciente($id);
    }
}
?>