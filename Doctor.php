<?
class Doctor extends Persona{
    private string $especialidad;
    private string $horario;  

    public function __construct(string $especialidad, string $horario) {
        $this->especialidad= $especialidad;
        $this->horario=$horario;
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
}

                     