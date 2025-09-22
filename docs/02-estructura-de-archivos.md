# Estructura de Archivos

El proyecto está organizado en las siguientes carpetas y archivos principales:

```
/
├── index.php
└── app/
    ├── controller/
    │   ├── doctorController.php
    │   ├── menuController.php
    │   ├── pacienteController.php
    │   └── turnoController.php
    ├── db/
    │   └── db.php
    ├── modelo/
    │   ├── doctor.php
    │   ├── paciente.php
    │   ├── persona.php
    │   └── turno.php
    └── view/
        ├── doctorView.php
        ├── mainView.php
        ├── pacienteView.php
        └── turnoView.php
```

## Descripción de Carpetas

- **`index.php`**: Es el punto de entrada de la aplicación. Inicializa la base de datos, carga datos de prueba y ejecuta el menú principal.

- **`app/`**: Contiene el núcleo de la aplicación.
    - **`controller/`**: Contiene los controladores que manejan la lógica de la aplicación y actúan como intermediarios entre el modelo y la vista.
    - **`db/`**: Contiene la clase `DB` que simula una base de datos en memoria.
    - **`modelo/`**: Contiene las clases que representan los datos del sistema (Doctor, Paciente, etc.).
    - **`view/`**: Contiene las clases responsables de mostrar la información al usuario y recibir sus entradas a través de la consola.
