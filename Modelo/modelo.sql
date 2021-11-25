
USE clinica;


CREATE TABLE personas
(
 id_persona int not null AUTO_INCREMENT,
 nombres  VARCHAR(30) NOT NULL,
 apellidos VARCHAR(30) NOT NULL,
 direccion  VARCHAR(30) NOT NULL,
 telefono VARCHAR(30) NOT NULL,
 celular  VARCHAR(30) NOT NULL,
 correo VARCHAR(50) NOT NULL,
 usuario  VARCHAR(30) NOT NULL,
 contrasena VARCHAR(100) NOT NULL,
 rol VARCHAR(30) NOT NULL,
 estado VARCHAR(30) NOT NULL,
 primary key(id_persona)
);

CREATE TABLE paises
(
  codigo int not null,
  nombre varchar(30) NOT NULL,
  descripcion varchar(100) NOT NULL,
  estado varchar(30) NOT NULL,
  primary key(codigo)
);

CREATE TABLE ciudades(
  codigo int not null,
  codigo_pais int not null,
  nombre varchar(30) NOT NULL,
  descripcion varchar(100) NOT NULL,
  estado varchar(30) NOT NULL,
  primary key(codigo,codigo_pais),
  FOREIGN KEY(codigo_pais)
  REFERENCES paises(codigo)
  ON UPDATE CASCADE 
  ON DELETE RESTRICT
);


CREATE TABLE sedes
(
 codigo_sede int not null,
 codigo_pais int not null,
 codigo_ciudad int not null,
 nombre  VARCHAR(30) NOT NULL,
 direccion VARCHAR(30) NOT NULL,
 telefono  VARCHAR(30) NOT NULL,
 estado VARCHAR(30) NOT NULL,
 primary key(codigo_sede,codigo_pais,codigo_ciudad),
  FOREIGN KEY(codigo_ciudad)
  REFERENCES ciudades(codigo)
  ON UPDATE CASCADE 
  ON DELETE RESTRICT,
  FOREIGN KEY(codigo_pais)
  REFERENCES paises(codigo)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT
);

CREATE TABLE nominas
(
  id_empleado int not null,
  id_nomina int not null AUTO_INCREMENT,
  s_basico REAL NOT NULL,
  can_hor int(3) NOT NULL,
  v_hor_extra varchar(100) NOT NULL,
  s_total varchar(100) NOT NULL,
  estado varchar(30) NOT NULL,
  fecha DATE NOT NULL,
  primary key(id_nomina),
  FOREIGN KEY(id_empleado)
  REFERENCES personas(id_persona)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT
);

CREATE TABLE citas
(
  id_paciente int not null,
  id_medico int not null,
  id_cita  int not null AUTO_INCREMENT,
  descripcion varchar(250) NOT NULL,
  fecha DATE NOT NULL,
  tipo varchar(30),
  estado varchar(30) NOT NULL,
  primary key(id_cita),

  FOREIGN KEY(id_medico)
  REFERENCES personas(id_persona)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT,

  FOREIGN KEY(id_paciente)
  REFERENCES personas(id_persona)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT
);


CREATE TABLE productos
(
  id_producto int not null AUTO_INCREMENT,
  nombre varchar(30) NOT NULL,
  descripcion varchar(100) NOT NULL,
  valor_unitario int(9) NOT NULL,
  url_imagen VARCHAR(30),
  estado varchar(30) NOT NULL,
  primary key(id_producto)
);

CREATE TABLE proveedores
(
  id_proveedor int not null AUTO_INCREMENT,
  nombre varchar(30) NOT NULL,
  descripcion varchar(300) NOT NULL,
  direccion varchar(150) NOT NULL,
  telefono VARCHAR(30),
  estado varchar(30) NOT NULL,
  primary key(id_proveedor)
);

CREATE TABLE pedidos
(
  id_pedido int not null AUTO_INCREMENT,
  id_administrador int not null,
  cant_productos int(3) NOT NULL,
  total int(15) NOT NULL,
  fecha VARCHAR(30),
  estado varchar(30) NOT NULL,
  primary key(id_pedido),
  FOREIGN KEY(id_administrador)
  REFERENCES personas(id_persona)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT
);

CREATE TABLE detalle_pedido
(
  id_detalle_pedido int not null AUTO_INCREMENT,
  id_pedido int not null,
  id_proveedor int not null,
  id_producto int not null,
  cant_productos int(3) NOT NULL,
  sub_total int(15) NOT NULL,
  primary key(id_detalle_pedido),

  FOREIGN KEY(id_pedido)
  REFERENCES pedidos(id_pedido)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT,

  FOREIGN KEY(id_proveedor)
  REFERENCES proveedores(id_proveedor)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT,

  FOREIGN KEY(id_producto)
  REFERENCES productos(id_producto)
  ON UPDATE RESTRICT 
  ON DELETE RESTRICT
);

