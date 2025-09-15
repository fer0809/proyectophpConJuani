<?php

require_once 'app/modelo/doctor.php';
require_once 'app/modelo/persona.php';
require_once 'app/view/menuDoctorView.php';

class MenuDoctor {
    private array $doctores = [];
    
    public function __construct() {
        $this->cargarDoctores();
    }


    
    public function ejecutar() {
        while (true) {
            $this->mostrarMenuDoctor();
            $opcion = $this->obtenerOpcion();
            
            switch ($opcion) {
                case 1:
                    $this->agregarDoctor();
                    break;
                case 2:
                    $this->editarDoctor();
                    break;
                case 3:
                    $this->eliminarDoctor();
                    break;
                case 4:
                    $this->mostrarDoctores();
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
    
    private function agregarDoctor() {
        echo "\n--- AGREGAR DOCTOR ---\n";
        
        $apellido = readline("Apellido: ");
        $nombre = readline("Nombre: ");
        $telefono = (int)readline("Teléfono: ");
        $fecha = readline("Fecha de nacimiento (YYYY-MM-DD): ");
        $especialidad = readline("Especialidad: ");
        $horario = readline("Horario: ");
        
        try {
            $doctor = new Doctor($apellido, $nombre, $telefono, $fecha, $especialidad, $horario);
            $this->doctores[] = $doctor;
            echo "\nDoctor agregado exitosamente!\n";
        } catch (Exception $e) {
            echo "\nError al agregar doctor: " . $e->getMessage() . "\n";
        }
    }
    
    private function editarDoctor() {
        if (empty($this->doctores)) {
            echo "\nNo hay doctores registrados.\n";
            return;
        }
        
        echo "\n--- EDITAR DOCTOR ---\n";
        $this->mostrarListaDoctores();
        
        $id = (int)readline("Seleccione el ID del doctor a editar: ");
        $doctor = $this->buscarDoctorPorId($id);
        
        if (!$doctor) {
            echo "\nDoctor no encontrado.\n";
            return;
        }
        
        echo "\nDatos actuales:\n";
        echo $doctor->mostrarInfo();
        
        echo "\nNuevos datos (deje vacío para mantener el actual):\n";
        
        $nuevoApellido = readline("Nuevo apellido: ");
        if (!empty($nuevoApellido)) {
            $doctor->setApellido($nuevoApellido);
        }
        
        $nuevoNombre = readline("Nuevo nombre: ");
        if (!empty($nuevoNombre)) {
            $doctor->setNombre($nuevoNombre);
        }
        
        $nuevoTelefono = readline("Nuevo teléfono: ");
        if (!empty($nuevoTelefono)) {
            $doctor->setTelefono((int)$nuevoTelefono);
        }
        
        $nuevaEspecialidad = readline("Nueva especialidad: ");
        if (!empty($nuevaEspecialidad)) {
            $doctor->setEspecialidad($nuevaEspecialidad);
        }
        
        $nuevoHorario = readline("Nuevo horario: ");
        if (!empty($nuevoHorario)) {
            $doctor->setHorario($nuevoHorario);
        }
        
        echo "\nDoctor editado exitosamente!\n";
    }
    
    private function eliminarDoctor() {
        if (empty($this->doctores)) {
            echo "\nNo hay doctores registrados.\n";
            return;
        }
        
        echo "\n--- ELIMINAR DOCTOR ---\n";
        $this->mostrarListaDoctores();
        
        $id = (int)readline("Seleccione el ID del doctor a eliminar: ");
        
        for ($i = 0; $i < count($this->doctores); $i++) {
            if ($this->doctores[$i]->getId() == $id) {
                echo "\nEliminando doctor: " . $this->doctores[$i]->getNombre() . " " . $this->doctores[$i]->getApellido() . "\n";
                unset($this->doctores[$i]);
                $this->doctores = array_values($this->doctores);
                echo "Doctor eliminado exitosamente!\n";
                return;
            }
        }
        
        echo "\nDoctor no encontrado.\n";
    }
    
   

    private function buscarDoctorPorId($id) {
        foreach ($this->doctores as $doctor) {
            if ($doctor->getId() == $id) {
                return $doctor;
            }
        }
        return null;
    }
    
    private function cargarDoctores() {
        if (empty($this->doctores)) {
            $this->doctores[] = new Doctor("García", "María", 123456789, "1980-05-15", "Cardiología", "Lunes a Viernes 8-16hs");
            $this->doctores[] = new Doctor("López", "Carlos", 987654321, "1975-03-20", "Dermatología", "Martes a Sábado 9-17hs");
        }
    }
}

?>