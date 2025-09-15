<?php

require_once 'app/modelo/paciente.php';
require_once 'app/modelo/persona.php';

class MenuPaciente {
    private array $pacientes = [];
    
    public function __construct() {
        $this->cargarPacientes();
    }
    
    public function ejecutar() {
        while (true) {
            $this->mostrarMenuPaciente();
            $opcion = $this->obtenerOpcion();
            
            switch ($opcion) {
                case 1:
                    $this->agregarPaciente();
                    break;
                case 2:
                    $this->editarPaciente();
                    break;
                case 3:
                    $this->eliminarPaciente();
                    break;
                case 4:
                    $this->mostrarPacientes();
                    break;
                case 5:
                    return;
                default:
                    echo "\nOpción inválida.\n";
            }
        }
    }
    
    
    private function obtenerOpcion() {
        return (int)readline();
    }
    
    private function agregarPaciente() {
        echo "\n--- AGREGAR PACIENTE ---\n";
        
        $apellido = readline("Apellido: ");
        $nombre = readline("Nombre: ");
        $telefono = (int)readline("Teléfono: ");
        $fecha = readline("Fecha de nacimiento (YYYY-MM-DD): ");
        $obra_social = readline("Obra social: ");
        
        try {
            $paciente = new Paciente($obra_social, $apellido, $nombre, $telefono, $fecha);
            $this->pacientes[] = $paciente;
            echo "\nPaciente agregado exitosamente!\n";
        } catch (Exception $e) {
            echo "\nError al agregar paciente: " . $e->getMessage() . "\n";
        }
    }
    
    private function editarPaciente() {
        if (empty($this->pacientes)) {
            echo "\nNo hay pacientes registrados.\n";
            return;
        }
        
        echo "\n--- EDITAR PACIENTE ---\n";
        $this->mostrarListaPacientes();
        
        $id = (int)readline("Seleccione el ID del paciente a editar: ");
        $paciente = $this->buscarPacientePorId($id);
        
        if (!$paciente) {
            echo "\nPaciente no encontrado.\n";
            return;
        }
        
        echo "\nDatos actuales:\n";
        echo $paciente->mostrarInfo();
        
        echo "\nNuevos datos (deje vacío para mantener el actual):\n";
        
        $nuevoApellido = readline("Nuevo apellido: ");
        if (!empty($nuevoApellido)) {
            $paciente->setApellido($nuevoApellido);
        }
        
        $nuevoNombre = readline("Nuevo nombre: ");
        if (!empty($nuevoNombre)) {
            $paciente->setNombre($nuevoNombre);
        }
        
        $nuevoTelefono = readline("Nuevo teléfono: ");
        if (!empty($nuevoTelefono)) {
            $paciente->setTelefono((int)$nuevoTelefono);
        }
        
        $nuevaObraSocial = readline("Nueva obra social: ");
        if (!empty($nuevaObraSocial)) {
            $paciente->setObra_social($nuevaObraSocial);
        }
        
        echo "\nPaciente editado exitosamente!\n";
    }
    
    private function eliminarPaciente() {
        if (empty($this->pacientes)) {
            echo "\nNo hay pacientes registrados.\n";
            return;
        }
        
        echo "\n--- ELIMINAR PACIENTE ---\n";
        $this->mostrarListaPacientes();
        
        $id = (int)readline("Seleccione el ID del paciente a eliminar: ");
        
        for ($i = 0; $i < count($this->pacientes); $i++) {
            if ($this->pacientes[$i]->getId() == $id) {
                echo "\nEliminando paciente: " . $this->pacientes[$i]->getNombre() . " " . $this->pacientes[$i]->getApellido() . "\n";
                unset($this->pacientes[$i]);
                $this->pacientes = array_values($this->pacientes);
                echo "Paciente eliminado exitosamente!\n";
                return;
            }
        }
        
        echo "\nPaciente no encontrado.\n";
    }
   
    private function buscarPacientePorId($id) {
        foreach ($this->pacientes as $paciente) {
            if ($paciente->getId() == $id) {
                return $paciente;
            }
        }
        return null;
    }
    
    private function cargarPacientes() {
        if (empty($this->pacientes)) {
            $this->pacientes[] = new Paciente("OSDE", "Pérez", "Ana", 111222333, "1990-08-10");
            $this->pacientes[] = new Paciente("Swiss Medical", "Rodríguez", "Juan", 444555666, "1985-12-03");
        }
    }
}

?> 