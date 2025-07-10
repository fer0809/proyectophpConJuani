<?php
require_once './Persona.php';
class Doctor extends Persona{
    private string $especialidad;
    private string $horario;
    private array $pacientes; 

    public function __construct(string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento, string $especialidad, string $horario) {
        parent::__construct($apellido, $nombre, $telefono, $fecha_de_nacimiento);
        $this->especialidad= $especialidad;
        $this->horario=$horario;
        $this->pacientes = [];
    }
    
    public function setEspecialidad(string $especialidad){
    $this->especialidad= $especialidad;
}
    public function setHorario(string $horario){
        $this->horario= $horario;
    }
    public function getEspecialidad():string{
        return $this->especialidad;
    }
    public function getHorario():string{
        return $this->horario;
    }
    public function agregarPaciente(int $pacienteId) {
        if (!in_array($pacienteId, $this->pacientes)) {
            $this->pacientes[] = $pacienteId;
        }
    }
    public function quitarPaciente(int $pacienteId) {
        $key = array_search($pacienteId, $this->pacientes);
        if ($key !== false) {
            unset($this->pacientes[$key]);
            $this->pacientes = array_values($this->pacientes); // Reindexar el array
        }
    }
    public function getPacientes(): array {
        return $this->pacientes;
    }

    public function mostrarInfo(): string {
        return parent::mostrarInfo() .
               "Especialidad: " . $this->getEspecialidad() . "\n" .
               "Horario: " . $this->getHorario() . "\n" .
               "Pacientes (IDs): " . implode(", ", $this->getPacientes()) . "\n";
    }
}
?>


                     