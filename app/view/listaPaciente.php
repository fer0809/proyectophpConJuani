<?php 
    function mostrarPacientes() {
        if (empty($this->pacientes)) {
            echo "\nNo hay pacientes registrados.\n";
            return;
        }
        
        echo "\n--- LISTADO DE PACIENTES ---\n";
        foreach ($this->pacientes as $paciente) {
            echo $paciente->mostrarInfo();
            echo "----------------------------------------\n";
        }
    }
    
    function mostrarListaPacientes() {
        foreach ($this->pacientes as $paciente) {
            echo "ID: " . $paciente->getId() . " - " . $paciente->getNombre() . " " . $paciente->getApellido() . " (" . $paciente->getObra_social() . ")\n";
        }
    }
?>