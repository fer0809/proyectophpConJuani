<? 
class Paciente{
    private string $obra_social;
public function __construct(string $obra_social) {
    $this->obra_social = $obra_social;
}
public function setObra_social(string $obra_social){
    $this->obra_social = $obra_social;
}
public function getObra_social():string{
    return $this-> obra_social;
}
}