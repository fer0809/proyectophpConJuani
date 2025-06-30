<?php
class turno{
    private string $fecha;
    private $id_doctor;
    private $id_paciente;
    private string $hora;
    private bool $estado;
  
    public function __construct(string $fecha, string $doctor, string $hora, bool $estado) {
        $this->fecha = $fecha;
        $this->hora= $hora;
        $this->estado=$estado;
    }
    public function setFecha (string $fecha) {
        $this->fecha=$fecha;
    }

    public function setHora(string $hora){
        $this->hora=$hora;
    }
    public function setEstado(bool $estado)  {
        $this->estado=$estado;
        
    }
    public function getFecha(): string{
        return $this->fecha;
    }
    public function getEstado():bool{
        return $this->estado;
    }
    

}
?>