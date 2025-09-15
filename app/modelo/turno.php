<?php
require_once __DIR__ . '/persona.php';
require_once __DIR__ . '/paciente.php';

class Turno{

    private string $fecha;
    private int $id_doctor;
    private int $id_paciente;
    private string $hora;
    private bool $estado;
  
    public function __construct(string $fecha, int $id_doctor, int $id_paciente, string $hora, bool $estado) {
        $this->fecha = $fecha;
        $this->id_doctor = $id_doctor;
        $this->id_paciente = $id_paciente;
        $this->hora = $hora;
        $this->estado = $estado;
    }
    
    public function setFecha(string $fecha) {
        $this->fecha = $fecha;
    }

    public function setHora(string $hora){
        $this->hora = $hora;
    }
    
    public function setEstado(bool $estado) {
        $this->estado = $estado;
    }
    
    public function setId_doctor(int $id_doctor) {
        $this->id_doctor = $id_doctor;
    }
    
    public function setId_paciente(int $id_paciente) {
        $this->id_paciente = $id_paciente;
    }
    
    public function getFecha(): string{
        return $this->fecha;
    }
    
    public function getHora(): string{
        return $this->hora;
    }
    
    public function getEstado(): bool{
        return $this->estado;
    }
    
    public function getId_doctor(): int{
        return $this->id_doctor;
    }
    
    public function getId_paciente(): int{
        return $this->id_paciente;
    }
}
?>