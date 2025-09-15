<?php

class Persona{
    private $id;
    static private $ultimoId = 0;
    private string $apellido;
    private string $nombre;
    private int $telefono;
    private string $fecha_de_nacimiento;

    public function __construct(string $apellido, string $nombre, int $telefono, string $fecha_de_nacimiento) {
        $this->apellido = $apellido;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->fecha_de_nacimiento = $fecha_de_nacimiento;
        self::$ultimoId++;
        $this->id = self::$ultimoId;
    }

    public function getId():int { 
        return $this->id; 
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
    public function setId(int $id) { 
        $this->id = $id;
        // Asegurar que $ultimoId se actualice si se carga un ID mayor
        if ($id > self::$ultimoId) {
            self::$ultimoId = $id;
        }
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
        return "ID: " . $this->getId() . "\n" .
               "Nombre completo: " . $this->getNombre() . " " . $this->getApellido() . "\n" .
               "Teléfono: " . $this->getTelefono() . "\n" .
               "Fecha de Nacimiento: " . $this->getFecha_de_nacimiento() . "\n";
    }

    // Método estático para establecer el último ID conocido al cargar datos
    public static function setUltimoId(int $id) {
        self::$ultimoId = $id;
    }
    
    // Método estático para obtener el último ID actual
    public static function getUltimoId(): int {
        return self::$ultimoId;
    }
}

?>