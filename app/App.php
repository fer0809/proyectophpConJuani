<?php

require_once './Persona.php';
require_once './Doctor.php';
require_once './Paciente.php';

// Arreglo para almacenar personas
$personas = [];

// Función para mostrar el menú
function mostrarMenu() {
    echo "\n=== MENÚ DE GESTIÓN ===\n";
    echo "1. Agregar Doctor\n";
    echo "2. Agregar Paciente\n";
    echo "3. Editar Doctor\n";
    echo "4. Editar Paciente\n";
    echo "5. Borrar Doctor\n";
    echo "6. Borrar Paciente\n";
    echo "7. Mostrar todos\n";
    echo "8. Salir\n";
    echo "=====================\n";
}

// Función para agregar doctor
function agregarDoctor(&$personas) {
    echo "\n--- AGREGAR DOCTOR ---\n";
    $doctor = new Doctor($apellido, $nombre, $telefono, $fecha, $especialidad, $horario);
    $personas[] = $doctor;
    
    echo "Doctor agregado exitosamente!\n";
}

// Función para agregar paciente
function agregarPaciente(&$personas) {
    echo "\n--- AGREGAR DOCTOR ---\n";
    $paciente = new Paciente($obra_social, $apellido, $nombre, $telefono, $fecha);
    $personas[] = $paciente;
}

// Función para editar doctor
function editarDoctor(&$personas) {
    echo "\n--- EDITAR DOCTOR ---\n";
    
    // Buscar el primer doctor
    $doctorEncontrado = false;
    foreach ($personas as $persona) {
        if ($persona instanceof Doctor) {
            echo "Editando doctor: " . $persona->getNombre() . " " . $persona->getApellido() . "\n";
            $persona->setEspecialidad("Neurología");
            $persona->setHorario("Lunes a Viernes 9-18hs");
            echo "Doctor editado exitosamente!\n";
            $doctorEncontrado = true;
            break;
        }
    }
    
    if (!$doctorEncontrado) {
        echo "No se encontraron doctores para editar.\n";
    }
}

// Función para editar paciente
function editarPaciente(&$personas) {
    echo "\n--- EDITAR PACIENTE ---\n";
    
    // Buscar el primer paciente
    $pacienteEncontrado = false;
    foreach ($personas as $persona) {
        if ($persona instanceof Paciente) {
            echo "Editando paciente: " . $persona->getNombre() . " " . $persona->getApellido() . "\n";
            $persona->setObra_social("OSDE Premium");
            echo "Paciente editado exitosamente!\n";
            $pacienteEncontrado = true;
            break;
        }
    }
    
    if (!$pacienteEncontrado) {
        echo "No se encontraron pacientes para editar.\n";
    }
}

// Función para borrar doctor
function borrarDoctor(&$personas) {
    echo "\n--- BORRAR DOCTOR ---\n";
    
    for ($i = 0; $i < count($personas); $i++) {
        if ($personas[$i] instanceof Doctor) {
            echo "Borrando doctor: " . $personas[$i]->getNombre() . " " . $personas[$i]->getApellido() . "\n";
            unset($personas[$i]);
            $personas = array_values($personas); // Reindexar
            echo "Doctor borrado exitosamente!\n";
            return;
        }
    }
    
    echo "No se encontraron doctores para borrar.\n";
}

// Función para borrar paciente
function borrarPaciente(&$personas) {
    echo "\n--- BORRAR PACIENTE ---\n";
    
    for ($i = 0; $i < count($personas); $i++) {
        if ($personas[$i] instanceof Paciente) {
            echo "Borrando paciente: " . $personas[$i]->getNombre() . " " . $personas[$i]->getApellido() . "\n";
            unset($personas[$i]);
            $personas = array_values($personas); // Reindexar
            echo "Paciente borrado exitosamente!\n";
            return;
        }
    }
    
    echo "No se encontraron pacientes para borrar.\n";
}

// Función para mostrar todos
function mostrarTodos($personas) {
    echo "\n--- LISTADO DE TODAS LAS PERSONAS ---\n";
    if (empty($personas)) {
        echo "No hay personas registradas.\n";
        return;
    }
    
    foreach ($personas as $persona) {
        echo $persona->mostrarInfo();
        echo "----------------------------------------\n";
    }
}


?>