<?php
require_once __DIR__ . '/../db/db.php';

class DoctorModelo {
    private DB $db;

    public function __construct() {
        $this->db = DB::getInstance();
    }

    public function obtenerTodosLosDoctores() {
        return $this->db->getAllDoctores();
    }

    public function obtenerDoctorPorId(int $id) {
        return $this->db->getDoctor($id);
    }

    public function agregarDoctor(string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento, string $especialidad, string $horario) {
        return $this->db->agregarDoctor($apellido, $nombre, $telefono, $fecha_de_nacimiento, $especialidad, $horario);
    }

    public function actualizarDoctor(int $id, array $datos) {
        return $this->db->actualizarDoctor($id, $datos);
    }

    public function eliminarDoctor(int $id) {
        return $this->db->eliminarDoctor($id);
    }
}
?>