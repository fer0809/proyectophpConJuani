<?php
require_once 'persona.php';
class Paciente extends Persona{
    private string $obra_social;
    private array $doctores;
public function __construct(string $obra_social,string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento) {
    parent::__construct($apellido, $nombre, $telefono, $fecha_de_nacimiento);
    $this->obra_social = $obra_social;
    $this->doctores = [];
}
public function setObra_social(string $obra_social){
    $this->obra_social = $obra_social;
}
public function getObra_social():string{
    return $this->obra_social;
}
public function agregarDoctor(int $doctorId) {
    if (!in_array($doctorId, $this->doctores)) {
        $this->doctores[] = $doctorId;
    }
}

public function quitarDoctor(int $doctorId) {
    $key = array_search($doctorId, $this->doctores);
    if ($key !== false) {
        unset($this->doctores[$key]);
        $this->doctores = array_values($this->doctores); // Reindexar el array
    }
}

public function getDoctores(): array {
    return $this->doctores;
}

public function mostrarInfo(): string {
    return parent::mostrarInfo() .
           "Obra Social: " . $this->getObra_social() . "\n" .
           "Doctores (IDs): " . implode(", ", $this->getDoctores()) . "\n";
}
}
