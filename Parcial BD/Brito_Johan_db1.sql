
CREATE TABLE tbl_pais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_provincia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    id_pais INT NOT NULL,
    FOREIGN KEY (id_pais) REFERENCES tbl_pais(id) ON DELETE CASCADE
);

CREATE TABLE tbl_tipo_doc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE tbl_sexo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE tbl_estado_civil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE tbl_categoria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_editorial (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE tbl_socios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    nro_doc VARCHAR(20) NOT NULL UNIQUE,
    id_tipo_doc INT NOT NULL,
    id_sexo INT NOT NULL,
    id_estado_civil INT NOT NULL,
    id_pais INT NOT NULL,
    id_provincia INT NOT NULL,
    localidad VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    FOREIGN KEY (id_tipo_doc) REFERENCES tbl_tipo_doc(id),
    FOREIGN KEY (id_sexo) REFERENCES tbl_sexo(id),
    FOREIGN KEY (id_estado_civil) REFERENCES tbl_estado_civil(id),
    FOREIGN KEY (id_pais) REFERENCES tbl_pais(id),
    FOREIGN KEY (id_provincia) REFERENCES tbl_provincia(id)
);

CREATE TABLE tbl_libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    id_categoria INT NOT NULL,
    id_editorial INT NOT NULL,
    isbn VARCHAR(30) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_ingreso DATE NOT NULL,
    FOREIGN KEY (id_categoria) REFERENCES tbl_categoria(id),
    FOREIGN KEY (id_editorial) REFERENCES tbl_editorial(id)
);

CREATE TABLE tbl_prestamos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_socio INT NOT NULL,
    id_libro INT NOT NULL,
    fecha_entrega DATE NOT NULL,
    fecha_devolucion DATE NOT NULL,
    FOREIGN KEY (id_socio) REFERENCES tbl_socios(id) ON DELETE CASCADE,
    FOREIGN KEY (id_libro) REFERENCES tbl_libros(id) ON DELETE CASCADE
);