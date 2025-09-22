# Diagrama de Clases (Textual)

Este diagrama muestra las relaciones entre las principales clases del modelo y la clase de base de datos.

### Relación de Herencia

La herencia se utiliza para compartir las propiedades y métodos comunes de una persona entre doctores y pacientes.

```
+-----------+
|  Persona  |
+-----------+
| - id      |
| - apellido|
| - nombre  |
| - telefono|
| ...       |
+-----------+
      ^
      |
      +--------------------+
      |                    |
+-----------+        +-------------+
|  Doctor   |        |   Paciente  |
+-----------+        +-------------+
| - especialidad |     | - obra_social |
| - horario      |     | - doctores[]  |
| - pacientes[]  |     +-------------+
+----------------+
```

### Relación de Composición / Agregación

La clase `DB` contiene (compone) los arrays de `Doctor`, `Paciente` y `Turno`. A su vez, `Turno` está asociado a un `Doctor` y un `Paciente` a través de sus IDs.

```
+------+
|  DB  |
+------+
| - doctores[]  -------(contiene)---> +----------+      +--------+
| - pacientes[] -------(contiene)---> +----------+      | Turno  |
| - turnos[]    -------(contiene)---> | Paciente |----(asociado a)-->+--------+
+------+                               +----------+      | - id_paciente |
                                         ^            | - id_doctor   |
                                         |            +--------+
                                         |                ^
                                         |                |
                                         |          (asociado a)
                                         |                |
                                         |                v
                                     +----------+
                                     |  Doctor  |
                                     +----------+

```

- **`DB`** contiene arrays de las otras clases.
- Un **`Turno`** se asocia con un `Doctor` y un `Paciente` mediante el almacenamiento de sus respectivos `id`.
- `Doctor` y `Paciente` también mantienen una lista de los IDs de los otros para registrar su relación.
