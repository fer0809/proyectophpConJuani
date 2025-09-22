# Base de Datos (`DB`)

La clase `DB` (`app/db/db.php`) funciona como una base de datos en memoria para el sistema. No se conecta a un motor de base de datos real (como MySQL o PostgreSQL), sino que almacena los datos en arrays mientras la aplicación está en ejecución.

## Funcionamiento

- **Propiedades**:
    - `$doctores`: Un array para guardar los objetos de tipo `Doctor`.
    - `$pacientes`: Un array para guardar los objetos de tipo `Paciente`.
    - `$turnos`: Un array para guardar los objetos de tipo `Turno`.

- **Métodos Principales**:
    - `agregar...()`: Añade un nuevo objeto (doctor, paciente o turno) al array correspondiente. Por ejemplo, `agregarDoctor()`.
    - `get...()`: Obtiene un objeto específico por su ID. Por ejemplo, `getDoctor($id)`.
    - `getAll...()`: Devuelve el array completo de objetos. Por ejemplo, `getAllDoctores()`.
    - `actualizar...()`: Modifica los datos de un objeto existente.
    - `eliminar...()`: Elimina un objeto del array por su ID.

> **Nota**: Al ser una base de datos en memoria, toda la información se pierde cuando la aplicación se cierra. Los datos iniciales se cargan cada vez que se ejecuta `index.php`.
