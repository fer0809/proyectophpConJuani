<?php
    function mostrarListaDoctores() {
        foreach ($this->doctores as $doctor) {
            echo "ID: " . $doctor->getId() . " - " . $doctor->getNombre() . " " . $doctor->getApellido() . " (" . $doctor->getEspecialidad() . ")\n";
        }
    }
?>    
    