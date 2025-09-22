# Clases del Modelo

Las clases del modelo definen la estructura de los datos con los que trabaja la aplicación.

## `Persona` (`app/modelo/persona.php`)

Es la clase base para `Doctor` y `Paciente`. Contiene propiedades y métodos comunes.

- **Propiedades Principales**:
    - `id`: Identificador único (se autoincrementa).
    - `apellido`: Apellido de la persona.
    - `nombre`: Nombre de la persona.
    - `telefono`: Número de teléfono.
    - `fecha_de_nacimiento`: Fecha de nacimiento.

## `Doctor` (`app/modelo/doctor.php`)

Hereda de `Persona` y añade información específica del doctor.

- **Propiedades Adicionales**:
    - `especialidad`: Especialidad médica del doctor.
    - `horario`: Horario de trabajo.
    - `pacientes`: Un array con los IDs de los pacientes que tiene asignados.

## `Paciente` (`app/modelo/paciente.php`)

Hereda de `Persona` y añade información específica del paciente.

- **Propiedades Adicionales**:
    - `obra_social`: Nombre de la obra social del paciente.
    - `doctores`: Un array con los IDs de los doctores que tiene asignados.

## `Turno` (`app/modelo/turno.php`)

Representa un turno médico.

- **Propiedades Principales**:
    - `id`: Identificador único del turno.
    - `fecha`: Fecha del turno.
    - `hora`: Hora del turno.
    - `id_doctor`: ID del doctor asignado al turno.
    - `id_paciente`: ID del paciente asignado al turno.
    - `estado`: `true` si el turno está activo, `false` si está cancelado.
