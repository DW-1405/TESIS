DROP  database if EXISTS comalex;
CREATE database comalex;
use comalex;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `brands`
--

CREATE TABLE brands(
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  brand varchar(20) UNIQUE KEY NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

--
-- Estructura de tabla para la tabla `document_types`
--

CREATE TABLE document_types (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  document varchar(20) UNIQUE KEY NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

--
-- Estructura de tabla para la tabla `workstations`
--

CREATE TABLE workstations (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  work varchar(20) UNIQUE KEY NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);


CREATE TABLE voucher_types (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  type varchar(20) UNIQUE KEY NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);

--
-- Estructura de tabla para la tabla `product_categories`
--

CREATE TABLE product_categories (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  category varchar(20) UNIQUE KEY NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
);


--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE clients (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  lastname varchar(20) NOT NULL,
  document_type_id int(10) NOT NULL,
  number_document varchar(20) NOT NULL,
  telephone varchar(20) NOT NULL,
  address varchar(100) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  --
  -- 	FOREIGN KEYS
  --
  FOREIGN KEY (document_type_id) REFERENCES document_types(id)
);


--
-- Estructura de tabla para la tabla `employees`
--

CREATE TABLE employees (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(45)  NOT NULL,
  lastname varchar(35)  NOT NULL,
  document_type_id int(10) NOT NULL,
  number_document varchar(20) UNIQUE KEY NOT NULL,
  date_birth date NOT NULL,
  email varchar(30) UNIQUE KEY NOT NULL,
  telephone varchar(20) NOT NULL,
  address varchar(100)  NOT NULL,
  workstation_id int(10) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  --
  -- 	FOREIGN KEYS
  --
  FOREIGN KEY (document_type_id) REFERENCES document_types (id),
  FOREIGN KEY (workstation_id) REFERENCES workstations (id)

);


--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE users (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(20) UNIQUE KEY NOT NULL,
  password varchar(100) NOT NULL,
  employee_id int(10) UNIQUE KEY NOT NULL,
  remember_token varchar(100) DEFAULT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  --
  -- 	FOREIGN KEYS
  --
  FOREIGN KEY (employee_id) REFERENCES employees(id)
);

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE products (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(255)  NOT NULL,
  description varchar(255)  NOT NULL,
  product_categories_id int(10) NOT NULL,
  brand_id int(10)  NOT NULL,
  stock int(10)  DEFAULT 100,
  unit_price double(8,2) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  --
  -- 	FOREIGN KEYS
  --
  FOREIGN KEY (brand_id) REFERENCES brands (id),
  FOREIGN KEY (product_categories_id) REFERENCES product_categories (id)
) ;

--
-- Estructura de tabla para la tabla `sales`
--

CREATE TABLE sales (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  code varchar(10) NOT NULL,
  date date NOT NULL,
  client_id int(10)  NOT NULL,
  user_id int(10)  NOT NULL,
  voucher_type_id int(10)  NOT NULL,
  total int(11) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  --
  -- 	FOREIGN KEYS
  --
  FOREIGN KEY (client_id) REFERENCES clients (id),
  FOREIGN KEY (user_id) REFERENCES users (id),
  FOREIGN KEY (voucher_type_id) REFERENCES voucher_types (id)
) ;


--
-- Estructura de tabla para la tabla `sale_products`
--
CREATE TABLE sale_details (
  id int(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  sale_id int(10)  NOT NULL,
  product_id int(10)  NOT NULL,
  quantity int(11) NOT NULL,
  amount double(8,2) NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  --
  -- 	FOREIGN KEYS
  --
  FOREIGN KEY (product_id) REFERENCES products(id),
  FOREIGN KEY (sale_id) REFERENCES sales (id)
) ;

CREATE PROCEDURE monthly_sales (IN `iduser` INT) 
SELECT MONTHNAME(date) AS month, COUNT(*) AS quantity FROM sales WHERE sales.user_id = iduser GROUP BY(MONTH(date)); 


CREATE PROCEDURE total_monthly_sales () 
SELECT MONTHNAME(date) AS month, COUNT(*) AS quantity FROM sales GROUP BY(MONTH(date));

ALTER TABLE clients DROP FOREIGN KEY clients_ibfk_1;
ALTER TABLE clients ADD CONSTRAINT clients_ibfk_1 FOREIGN KEY (document_type_id) REFERENCES document_types(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE employees DROP FOREIGN KEY employees_ibfk_1; 
ALTER TABLE employees ADD CONSTRAINT employees_ibfk_1 FOREIGN KEY (document_type_id) REFERENCES document_types(id) ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE employees DROP FOREIGN KEY employees_ibfk_2; 
ALTER TABLE employees ADD CONSTRAINT employees_ibfk_2 FOREIGN KEY (workstation_id) REFERENCES workstations(id) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE products DROP FOREIGN KEY products_ibfk_1; 
ALTER TABLE products ADD CONSTRAINT products_ibfk_1 FOREIGN KEY (brand_id) REFERENCES brands(id) ON DELETE CASCADE ON UPDATE CASCADE; 
ALTER TABLE products DROP FOREIGN KEY products_ibfk_2; 
ALTER TABLE products ADD CONSTRAINT products_ibfk_2 FOREIGN KEY (product_categories_id) REFERENCES product_categories(id) ON DELETE CASCADE ON UPDATE CASCADE; 

ALTER TABLE sales DROP FOREIGN KEY sales_ibfk_1; 
ALTER TABLE sales ADD CONSTRAINT sales_ibfk_1 FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE sales DROP FOREIGN KEY sales_ibfk_2; 
ALTER TABLE sales ADD CONSTRAINT sales_ibfk_2 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE sales DROP FOREIGN KEY sales_ibfk_3;
ALTER TABLE sales ADD CONSTRAINT sales_ibfk_3 FOREIGN KEY (voucher_type_id) REFERENCES voucher_types(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE sale_details DROP FOREIGN KEY sale_details_ibfk_1; 
ALTER TABLE sale_details ADD CONSTRAINT sale_details_ibfk_1 FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE sale_details DROP FOREIGN KEY sale_details_ibfk_2;
ALTER TABLE sale_details ADD CONSTRAINT sale_details_ibfk_2 FOREIGN KEY (sale_id) REFERENCES sales(id) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE users DROP FOREIGN KEY users_ibfk_1; 
ALTER TABLE users ADD CONSTRAINT users_ibfk_1 FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE ON UPDATE CASCADE; 

INSERT INTO brands () VALUES
(NULL, 'LENOVO', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'HP', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'ACER', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'SONY', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'PANASONIC', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'OSTER', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'IMACO', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'MABE', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'PHILIPS', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'EPSON', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'CANON', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'S/E', '2021-10-10 00:21:45', '2021-10-10 00:21:45');

INSERT INTO product_categories () VALUES
(NULL, 'MUEBLES', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'ELECTRODOMESTICOS', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'JUGUETES', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'COMPUTO', '2021-10-10 00:21:45', '2021-10-10 00:21:45');

INSERT INTO products () VALUES 
(NULL, 'JUEGO DE SALA', 'MUEBLES PARA LA SALA', 1, 10, '10', '789', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'JUEGO DE COMEDOR', 'MUEBLES PARA EL COMEDOR', 1, 10, '10', '649', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'JUEGO DE DORMITORIO', 'MUEBLES PARA EL DORMITORIO', 1, 10, '10', '552', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'COCINA', 'COCINA DE 4 HORNILLAS', 2, 8, '5', '899', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'MICROONDAS', 'MICROONDAS', 2, 7, '10', '1099', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'REFRIGERADORA', 'REFRIGERADORA 700L', 2, 9, '5', '2300', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'BICICLETA', 'MONTAÑERA', 3, 10, '30', '199', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'SCOOTER', 'SCOOTER', 3, 10, '20', '159', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'CARRITO', 'CARRITO PARA NIÑOS', 3, 10, '50', '100', '2021-10-10 00:21:45', '2021-10-10 00:21:45'),
(NULL, 'IMPRESORA', 'IMPRESORA MULTIFUNCIONAL', 4, 10, '20', '789', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'COMPUTADORA', 'COMPUTADORA', 4, 2, '10', '1789', '2021-10-10 00:21:45', '2021-10-10 00:21:45'), 
(NULL, 'TABLET', 'TABLET', 4, 1, '20', '789', '2021-10-10 00:21:45', '2021-10-10 00:21:45');

INSERT INTO workstations () VALUES
(NULL, 'ADMINISTRADOR', '2020-09-20 00:10:42', '2020-09-20 00:10:42'),
(NULL, 'VENDEDOR', '2020-09-20 00:10:42', '2020-09-20 00:10:42');


INSERT INTO voucher_types () VALUES
(NULL, 'BOLETA', '2020-09-20 00:10:42', '2020-09-20 00:10:42'),
(NULL, 'FACTURA', '2020-09-20 00:10:42', '2020-09-20 00:10:42');


INSERT INTO document_types () VALUES
(NULL, 'DNI', '2020-09-20 00:10:42', '2020-09-20 00:10:42'),
(NULL, 'RUC', '2020-09-20 00:10:42', '2020-09-20 00:10:42');

INSERT INTO clients () VALUES
(NULL, 'Felicita', 'Maggio', 1, '26424683', '1-584-349-1006', '82707 Schaden Forges Apt. 023\nEast Marciaport, IN 26901-7071', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Buster', 'Howell', 2, '75059332', '1-852-788-0883', '37943 Beer Cape\nJohnathanshire, VA 03660-6446', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Ashton', 'Reilly', 2, '29822166', '1-934-713-7524', '82459 Mante Lights Apt. 176\nLake Willow, SD 06080', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Mercedes', 'Amore', 2, '33878185', '+1-429-462-9967', '746 Avery Crossing\nYesseniaview, MO 43479', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Kade', 'McKenzie', 2, '39552689', '(457) 346-4969 x153', '41394 Veum Shoals\nPort Isidroshire, DE 45092-6644', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Bart', 'Rau', 2, '80485969', '(379) 343-4383', '569 Grover Plains\nCruickshankport, NE 83102', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Ada', 'Eichmann', 1, '05623316', '823.586.2014', '923 Kuhn Mall Apt. 947\nLake Casper, CO 26714-8382', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Abigail', 'Treutel', 1, '49881519', '1-292-762-4062 x5987', '65360 Dayna Dam\nNorth Warrenchester, NY 07375-2423', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Gracie', 'Dicki', 1, '13406297', '+1 (873) 831-2099', '90890 Augustine Squares Suite 594\nSouth Candace, IN 82889', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Gayle', 'Lehner', 1, '04213488', '(875) 448-9316 x96476', '3732 Lehner Trail Suite 464\nSouth Rasheed, MD 74185', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Emil', 'Gorczany', 2, '18492908', '1-249-776-5891 x6428', '90837 Kraig Spurs\nAlleneborough, AL 72016', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Minerva', 'Davis', 2, '96115796', '472.421.0888 x986', '4993 Marcus Valleys Apt. 032\nNorth Crystal, WY 20521', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Landen', 'Hickle', 1, '60707452', '+1.982.436.9622', '928 Leatha Drive Apt. 284\nMaggieview, DE 43906', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Arne', 'Lebsack', 2, '47417043', '+1-736-627-2704', '3935 Manley Lane Apt. 171\nJonasport, NY 23193', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Gaylord', 'Mraz', 1, '31874555', '(458) 882-3380', '53031 Lourdes Dam\nFreemanhaven, IA 37666-5134', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Celestino', 'Wisozk', 1, '72948763', '+1-379-546-8719', '4958 Runolfsdottir Overpass Suite 035\nJanaville, AK 00599-9834', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Ashleigh', 'Green', 1, '47921051', '1-638-783-9361', '599 Wuckert Parkway Apt. 646\nMakaylaborough, NH 06894-6408', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Theresia', 'McKenzie', 1, '19456327', '(737) 285-8483 x55346', '780 Spencer Mission Suite 302\nEleanoraside, KS 64189-6075', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Lazaro', 'Kuhlman', 1, '11728366', '1-665-624-6754', '1659 David Tunnel Suite 585\nLake Rosemarie, DE 51891', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Francesco', 'Ortiz', 1, '26783524', '+1 (973) 758-1047', '7893 Hirthe Courts Apt. 353\nWest Denisfort, RI 37371-1190', '2020-09-20 00:10:44', '2020-09-20 00:10:44'),
(NULL, 'Gloria', 'Sawayn', 1, '49688875', '730-964-2836 x882', '79599 Davis Trail\nShawnhaven, VT 49800-9551', '2020-09-20 00:10:45', '2020-09-20 00:10:45'),
(NULL, 'Abelardo', 'Harris', 1, '99798205', '509.594.1473 x68739', '28451 Minerva Estates Suite 539\nSouth Alaynamouth, SC 72085', '2020-09-20 00:10:45', '2020-09-20 00:10:45'),
(NULL, 'Millie', 'Robel', 2, '20365560', '+1.710.874.9452', '948 Hermann Rapid Apt. 964\nSouth Alvismouth, GA 83787-2053', '2020-09-20 00:10:45', '2020-09-20 00:10:45'),
(NULL, 'Odie', 'Jaskolski', 1, '67486755', '1-250-407-7613 x267', '60984 Koss Route Apt. 075\nStreichton, VA 03408', '2020-09-20 00:10:45', '2020-09-20 00:10:45'),
(NULL, 'Corene', 'Cruickshank', 2, '53209170', '975-822-6583', '5420 Cornelius Canyon\nPfannerstillton, MO 62469', '2020-09-20 00:10:45', '2020-09-20 00:10:45');

