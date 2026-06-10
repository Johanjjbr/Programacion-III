# Sistema de Inscripción a Mesas de Examen - TSDS

Este repositorio contiene el desarrollo del examen Parcial N° 2 para la materia **Programación III** de la Tecnicatura Superior en Desarrollo de Software (Escuela Normal Superior General Manuel Belgrano).

## 🚀 Características del Sistema

El sistema web permite al personal administrativo y operativo gestionar eficientemente las mesas de exámenes del instituto, distribuyéndose en 4 módulos centrales:

1. **Control de Acceso:** Autenticación segura basada en sesiones PHP con dos roles diferenciados (`Administrativo` y `Operador`).
2. **Gestión de Alumnos:** CRUD completo para la administración de la base de datos de estudiantes.
3. **Módulo de Mesas de Examen:** Creación y eliminación de instancias de examen con tribunales asignados (Titular, Vocal 1 y Vocal 2).
4. **Módulo de Inscripciones y Calificaciones:** Registro de alumnos en mesas específicas con bloqueo automatizado de carga de notas hasta que la fecha del examen haya expirado.

## 🛠️ Tecnologías Utilizadas

- **Backend:** PHP 8.x (Nativo con extensión MySQLi)
- **Base de Datos:** MySQL / MariaDB
- **Frontend:** Bootstrap 5.3 & FontAwesome (Iconografía)
- **Diseño & Prototipado:** Compatible con especificaciones de UI de Figma

## 📊 Modelo de Datos (DER)

El sistema se compone de 4 entidades principales interrelacionadas:
- `usuarios`: Manejo de credenciales y perfiles.
- `alumnos`: Información personal de los estudiantes de la TSDS.
- `mesas_examen`: Agenda de asignaturas, tipos (Regular/Libre) y tribunales docentes.
- `inscripciones`: Entidad relacional intermedia encargada del historial de exámenes, asistencias y calificaciones finales.

## 🧑‍💻 Autoría
- **Programador:** Johan Brito
- **Fecha:** Junio 2026
- **Carrera:** Tecnicatura Superior en Desarrollo de Software (2da 1ra)
- **Institución:** Escuela Normal Superior General Manuel Belgrano