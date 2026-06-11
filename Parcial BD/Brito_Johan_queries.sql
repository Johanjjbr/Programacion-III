-- Insertar valores: casado, soltero, divorciado
INSERT INTO tbl_estado_civil (nombre) VALUES 
('casado'), 
('soltero'), 
('divorciado');

--  Modificar 'casado' como 'casados'
UPDATE tbl_estado_civil 
SET nombre = 'casados' 
WHERE nombre = 'casado';

-- Borrar 'casados'
DELETE FROM tbl_estado_civil 
WHERE nombre = 'casados';

-- Mostrar tabla tbl_estado_civil
SELECT * FROM tbl_estado_civil;

--Mostrar tbl_prestamos 
SELECT 
    p.id AS 'ID Prestamo',
    s.nombre AS 'Nombre del Socio',
    l.titulo AS 'Nombre del Libro',
    p.fecha_entrega AS 'Fecha Entrega',
    p.fecha_devolucion AS 'Fecha Devolución'
FROM tbl_prestamos p
INNER JOIN tbl_socios s ON p.id_socio = s.id
INNER JOIN tbl_libros l ON p.id_libro = l.id;