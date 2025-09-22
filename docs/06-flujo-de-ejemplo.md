# Flujo de Ejemplo: Crear un Turno

Aquí se describe un flujo de trabajo completo, desde la creación de los registros necesarios hasta la asignación de un turno.

### Paso 1: Ejecutar la aplicación

Como se describe en [Cómo Empezar](./00-como-empezar.md), ejecuta el comando:
```bash
php index.php
```

### Paso 2: Gestionar Doctores

1. En el menú principal, selecciona la opción `1` (Gestionar Doctores).
2. En el menú de doctores, selecciona `1` (Agregar doctor).
3. Ingresa los datos que te solicita la consola, por ejemplo:
    - Apellido: `Simmons`
    - Nombre: `John`
    - Teléfono: `5551234`
    - Fecha de nacimiento: `1982-11-20`
    - Especialidad: `Pediatría`
    - Horario: `Lunes y Miércoles 10-18hs`
4. Verás el mensaje "Doctor agregado exitosamente!".
5. Vuelve al menú principal seleccionando la opción `5`.

### Paso 3: Gestionar Pacientes

1. En el menú principal, selecciona la opción `2` (Gestionar Pacientes).
2. En el menú de pacientes, selecciona `1` (Agregar paciente).
3. Ingresa los datos del paciente:
    - Apellido: `Wayne`
    - Nombre: `Bruce`
    - Teléfono: `5555678`
    - Fecha de nacimiento: `1972-02-19`
    - Obra Social: `WayneCorp Health`
4. Verás el mensaje "Paciente agregado exitosamente!".
5. Vuelve al menú principal seleccionando la opción `5`.

### Paso 4: Crear el Turno

1. En el menú principal, selecciona la opción `3` (Gestionar Turnos).
2. En el menú de turnos, selecciona `1` (Crear turno).
3. La aplicación te mostrará la lista de doctores y pacientes disponibles con sus IDs.
4. Selecciona el `ID del doctor` (por ejemplo, el ID del Dr. Simmons que acabas de crear).
5. Selecciona el `ID del paciente` (el ID de Bruce Wayne).
6. Ingresa la fecha y hora del turno, por ejemplo:
    - Fecha: `2025-11-15`
    - Hora: `11:00`
7. Verás el mensaje "Turno creado y asignado exitosamente!".

### Paso 5: Verificar el Turno

1. En el mismo menú de turnos, selecciona la opción `4` (Mostrar turnos).
2. La consola te mostrará una lista con todos los turnos registrados, incluyendo el que acabas de crear, con los detalles del doctor y el paciente.
