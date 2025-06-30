<?php
class ASG{
public function menu($opcion)  {

    switch ($opcion) {
        case '1':
            "Sacar turno";
            break;

        case '2':
            "Ver Disponibilidad";
            break;
        
        case '3':
            "Agregar Doctor";
            break;
        
        case '4':
            "Cancelar turno";
            break;


        default:
            # code...
            break;
    }
    
}
}
?>