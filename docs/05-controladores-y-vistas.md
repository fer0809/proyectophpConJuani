# Controladores y Vistas

El proyecto utiliza un patrón similar a MVC (Modelo-Vista-Controlador) para separar las responsabilidades.

## Vistas (`app/view/`)

Las vistas son responsables de toda la interacción con el usuario en la consola.

- **Función**: Mostrar menús, solicitar datos (`readline`) y presentar información (listas, mensajes de confirmación/error).
- **Ejemplos**:
    - `MainView`: Muestra el menú principal.
    - `DoctorView`: Se encarga de los menús y la visualización de datos de los doctores.
    - `PacienteView` y `TurnoView` cumplen funciones similares para sus respectivas áreas.

## Controladores (`app/controller/`)

Los controladores contienen la lógica de la aplicación y conectan los modelos con las vistas.

- **Función**: Reciben la opción del usuario desde la vista, solicitan los datos necesarios al modelo (`DB`), y le dicen a la vista qué mostrar.
- **Flujo de trabajo típico**:
    1. El controlador muestra un menú a través de la vista.
    2. La vista captura la opción del usuario y la devuelve al controlador.
    3. El controlador ejecuta un método según la opción (ej: `agregarDoctor`).
    4. Pide los datos necesarios a la vista (ej: `obtenerDatosDoctor`).
    5. Llama al método correspondiente en la clase `DB` para actualizar los datos.
    6. Muestra un mensaje de resultado a través de la vista.

- **Controladores Principales**:
    - `MenuController`: Es el orquestador principal. Decide qué sub-menú (Doctores, Pacientes o Turnos) debe mostrarse.
    - `DoctorController`, `PacienteController`, `TurnoController`: Cada uno gestiona la lógica para su módulo específico.
