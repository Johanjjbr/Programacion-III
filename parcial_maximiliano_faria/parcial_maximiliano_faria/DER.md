# Diagrama Entidad Relacion

Programador: Maximiliano Faria  
Fecha de desarrollo: Junio/2026  
Materia: Programacion 3 de la TSDS  
Curso: Tecnicatura Superior en Desarrollo de Software

## Entidades

- `alumnos`: guarda los datos personales de los alumnos.
- `mesas`: guarda fecha, materia, tipo de mesa y tribunal.
- `inscripciones`: relaciona alumnos con mesas de examen.
- `usuarios`: guarda datos de acceso y perfil.

## Relaciones

- Un alumno puede tener muchas inscripciones.
- Una mesa puede tener muchas inscripciones.
- Cada inscripcion pertenece a un alumno y a una mesa.
- Los usuarios se usan para el control de acceso del sistema.

```mermaid
erDiagram
    ALUMNOS ||--o{ INSCRIPCIONES : realiza
    MESAS ||--o{ INSCRIPCIONES : recibe

    ALUMNOS {
        int id_alumno PK
        varchar dni
        varchar apellido
        varchar nombre
        varchar telefono
        varchar email
    }

    MESAS {
        int id_mesa PK
        date fecha_mesa
        varchar materia
        enum tipo_mesa
        varchar profesor_titular
        varchar profesor_vocal1
        varchar profesor_vocal2
    }

    INSCRIPCIONES {
        int id_inscripcion PK
        int id_alumno FK
        int id_mesa FK
        date fecha_inscripcion
        enum asistencia
        int nota
    }

    USUARIOS {
        int id_usuario PK
        varchar usuario
        varchar clave
        varchar nombre_completo
        enum perfil
    }
```

