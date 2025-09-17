-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2025 a las 02:52:29
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `practicastech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_persona`
--

CREATE TABLE `registro_persona` (
  `id_persona` int(11) NOT NULL,
  `nombre_persona` varchar(50) NOT NULL,
  `apellido_persona` varchar(50) NOT NULL,
  `dni_persona` int(8) NOT NULL,
  `fechanac_persona` date NOT NULL,
  `genero_persona` enum('M','F','Otros') NOT NULL,
  `provincia_persona` varchar(50) NOT NULL,
  `departamento_persona` varchar(50) NOT NULL,
  `municipio_persona` varchar(50) DEFAULT NULL,
  `localidad_persona` varchar(50) DEFAULT NULL,
  `barrio_persona` varchar(50) DEFAULT NULL,
  `calle_persona` varchar(100) DEFAULT NULL,
  `altura_persona` int(11) DEFAULT NULL,
  `latitud` varchar(255) DEFAULT NULL,
  `longitud` varchar(255) DEFAULT NULL,
  `imagen_persona` varchar(255) DEFAULT NULL,
  `codigo_postal` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `registro_persona`
--

INSERT INTO `registro_persona` (`id_persona`, `nombre_persona`, `apellido_persona`, `dni_persona`, `fechanac_persona`, `genero_persona`, `provincia_persona`, `departamento_persona`, `municipio_persona`, `localidad_persona`, `barrio_persona`, `calle_persona`, `altura_persona`, `latitud`, `longitud`, `imagen_persona`, `codigo_postal`) VALUES
(1, 'Lucas Rodrigo', 'Moran Cativa', 42991671, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Villa Revol', 'Pedro Nolasco Barrientos', 1000, '-31.444838269294994', '-64.17285919189455', 'uploads/registro_personas/LucasRodrigo_MoranCativa_2025-08-08_01-53-56.jpeg', ''),
(2, 'Juan Ignacio', 'Ponces', 45874483, '2001-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Alto Alberdi', 'Gobernador Justo Páez Molina', 300, '-31.400306387726097', '-64.22229766845705', 'uploads/img_6854e5fdc75b8.jpeg', ''),
(3, 'Maximiliano', 'Andrada', 37655093, '1994-08-09', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Ducasse', 'Intendente Ramón Bautista Mestre Norte', 600, '-31.4058545705102', '-64.18920993804933', 'uploads/img_6854f7a912c04.jpeg', ''),
(4, 'tiago', 'arias', 44765774, '2000-08-27', 'M', 'Catamarca', 'capayan', 'Huillapima', 'Chumbicha', 'Las flores', 'catamarca', 1, NULL, NULL, NULL, ''),
(5, 'Colita Gato', 'Sosa', 29813120, '2020-04-12', 'Otros', 'Catamarca', 'Valle Viejo', 'San Isidro', 'San Isidro', 'La Costanera', 'Padre Larrouy', 150, '-28.463973609581164', '-65.72517961263658', 'uploads/cam_685b118144013.jpeg', ''),
(6, 'CARLOS ', 'Chazarreta', 30987354, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Centro', 'Rosario de Santa Fe', 50, '-31.416824185038823', '-64.18110172856646', 'uploads/cam_685b30725db98.jpeg', ''),
(7, 'humberto', 'sani', 45654342, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Nueva Córdoba', 'Obispo Salguero', 620, '-31.425049955741194', '-64.18211793415543', 'uploads/registro_personasimg_6865b22cae24a.png', ''),
(8, 'carlos pedro', 'sosa', 23654657, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Centro', 'Rincón', 3, '-31.40693318974752', '-64.18002510495103', 'uploads/registro_personasimg_6865b256b123e.png', ''),
(9, 'daniela', 'perea', 56765432, '2000-08-27', 'F', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Las Flores', 'Luis María Drago', 68, '-31.44955816640121', '-64.19845741272725', 'uploads/registro_personasimg_6865b2827dd41.png', ''),
(10, 'hernan', 'guitierrez', 45674532, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Villa Revol Anexo', 'Los Araucanos', 23, '-31.43615755497506', '-64.1691152181322', 'uploads/registro_personasimg_6865b516f1096.png', ''),
(11, 'Lucas pedro', 'feliz', 43876423, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Nueva Córdoba', 'Tunel Plaza España', 23, '-31.428565471971634', '-64.18486507240014', 'uploads/registro_personasimg_6865b6418e1b7.jpeg', ''),
(12, 'franco', 'avila', 34654764, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Güemes', 'Avenida Vélez Sarsfield', 23, '-31.42026472383391', '-64.18883143053398', 'uploads/registro_personas/franco_avila_2025-07-03_00-49-34.png', ''),
(13, 'Lucas Rodrigo', 'Moran Cativa', 42991679, '2000-08-27', 'M', 'Catamarca', 'Capayan', 'San Fernando del Valle de Catamarca', 'San Fernando del Valle de Catamarca', 'Centro', 'Salta', 964, '0', '0', 'uploads/registro_personas/LucasRodrigo_MoranCativa_2025-08-08_00-48-28.png', '4728'),
(14, 'maxi', 'zyto', 42991676, '2000-08-27', 'M', 'Provincia de Córdoba', 'Pedanía Capital', 'Municipio de Córdoba', 'Córdoba', 'Providencia', 'Bialet Massé', 1000, '0', '0', 'uploads/registro_personas/maxi_zyto_2025-08-08_01-56-58.jpg', '4728'),
(15, 'Juan Gabriel', 'Sanchez', 45078688, '2003-02-10', 'M', 'Catamarca', 'Capital', 'San Fernando del Valle de Catamarca', 'San Fernando del Valle de Catamarca', 'Centro', 'Ayacucho', 911, '-28.472737325116523', '-65.78414448845865', 'uploads/registro_personas/JuanGabriel_Sanchez_2025-08-09_00-21-22.jpeg', '4700'),
(16, 'Juan carlos', 'ajedrez', 65343654, '2001-08-27', 'M', 'Catamarca', 'Capayan', 'huillapima', 'Chumbicha', 'Centro', 'Buenos Aires', 23, '0', '0', 'uploads/registro_personas/Juancarlos_ajedrez_2025-09-10_05-11-08.png', '4728');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `habilidades` text DEFAULT NULL,
  `nivel_experiencia` varchar(50) DEFAULT NULL,
  `anos_experiencia` int(11) DEFAULT NULL,
  `intereses` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `habilidades`, `nivel_experiencia`, `anos_experiencia`, `intereses`, `fecha_creacion`) VALUES
(1, 'Juan Pérez', 'juan@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '2025-09-16 22:45:27'),
(2, 'María García', 'maria@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '2025-09-16 22:45:27'),
(3, 'Carlos López', 'carlos@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NULL, NULL, NULL, NULL, '2025-09-16 22:45:27'),
(4, 'Jorge pedro perez', 'beso@gmail.com', '$2y$10$jI6YArqnM.CgokjPk7Da.uBY7ykTbszuTr4kANAVQ9qIgbIBvgTBK', NULL, NULL, NULL, NULL, '2025-09-16 23:26:39'),
(5, 'andriuolo maciel', 'nazi@gmail.com', '$2y$10$CELew8d66UJPuCo1KfplJ.sDFo/U/HbzcJ6gD/icAnf9tsTkgrI5S', NULL, NULL, NULL, NULL, '2025-09-16 23:45:13'),
(6, 'lucas rodrigo', 'kabra@gmail.com', '$2y$10$RPAEmsTgB7DMBhrvRgV67eyuJg9mFn8XuglokzOOTomJZN1bSSaJa', 'Python', 'Principiante', 4, 'Desarrollo web', '2025-09-16 23:50:37'),
(7, 'ana lopez', 'ana@gmail.com', '$2y$10$S8fvsfGL2wtyxZvqX3kTTu8Ooh6hr33WXOc6CDS/CPaTVvHNPLa.K', '', '', 0, '', '2025-09-16 23:55:52'),
(8, 'ana lopez', 'anaa@gmail.com', '$2y$10$9TpB6daGFUC/nHANEknsW.l8zOji9ATPFdSvm/x0LEzx1YKKZJV9C', NULL, NULL, NULL, NULL, '2025-09-16 23:58:39'),
(9, 'maico arias', 'maico@gmail.com', '$2y$10$X9OUbLRA1vvEz6SU4MKaJeR1UpkL7U8IwAifnp.IdCkg6zGtwl4Cy', NULL, NULL, NULL, NULL, '2025-09-17 00:17:47'),
(10, 'tiago arias', 'tiago@gmail.com', '$2y$10$EaWz2othYxiJhVkjEDlO..C9h40kf8OyWW0Ump2Baxv9c10TfaEwy', NULL, NULL, NULL, NULL, '2025-09-17 00:21:05'),
(11, 'jorge joirge', 'jorge@gmail.com', '$2y$10$W5OBQn3D2NED6HsREv/uruS4/KkoBQXEZLXYRGbKxwHMBkFfB2eRi', 'Python', 'Principiante', 3, 'Desarrollo web', '2025-09-17 00:26:42');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registro_persona`
--
ALTER TABLE `registro_persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registro_persona`
--
ALTER TABLE `registro_persona`
  MODIFY `id_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
