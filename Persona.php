<?php

class Persona{
    private $id;
    static private $ultimo = 0;
    private string $apellido;
    private string $nombre;
    private int $telefono;
    private string $fecha_de_nacimiento;

    public function __construct(string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento) {
        self::$ultimo++;
        $this -> id = self::$ultimo;
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->fecha_de_nacimiento = $fecha_de_nacimiento;
    }

    public function getApellido():string{
        return $this->apellido;
    }
    public function getNombre():string{
        return $this->nombre;
    }
    public function getTelefono():int{
        return $this->telefono;
    }
    public function getFecha_de_nacimiento():string{
        return $this->fecha_de_nacimiento;
    }
    public function setApellido(string $apellido){
        $this->apellido = $apellido;
    }
    public function setNombre(string $nombre){
        $this->nombre = $nombre;
    }
    public function setTelefono(int $telefono){
        $this->telefono= $telefono;
    }
    public function setFecha_de_nacimiento(string $fecha_de_nacimiento){
        $this->fecha_de_nacimiento = $fecha_de_nacimiento;
    }

    public function mostrarInfo(): string {
        return "Nombre completo: " . $this->getNombre() . " " . $this->getApellido() . "\n" .
               "Teléfono: " . $this->getTelefono() . "\n" .
               "Fecha de Nacimiento: " . $this->getFecha_de_nacimiento()."\n";
    }
}

?>