-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-08-2023 a las 19:05:34
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `demo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `nombredos` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `apellidodos` varchar(20) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `estadocivil` varchar(12) NOT NULL,
  `fechanacimiento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `peso` int(11) NOT NULL,
  `tallacalzado` int(11) NOT NULL,
  `gradodeinstruccion` varchar(25) NOT NULL,
  `profesion` varchar(50) NOT NULL,
  `discapacidad` varchar(25) NOT NULL,
  `enfermedad` varchar(25) NOT NULL,
  `poseevivienda` varchar(3) NOT NULL,
  `tipovivienda` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `nombredos`, `apellido`, `apellidodos`, `cedula`, `direccion`, `telefono`, `correo`, `estadocivil`, `fechanacimiento`, `sexo`, `peso`, `tallacalzado`, `gradodeinstruccion`, `profesion`, `discapacidad`, `enfermedad`, `poseevivienda`, `tipovivienda`) VALUES
(01, 'DENNYS', 'ZULIfgMAR', 'MACIAS', 'TORREZ', '10991538', '24 DE JUNIO', '4144035102', 'DENNYZULIMAR@GMAIL.COM', 'Soltero', '1973-12-29', 'F', 78, 37, 'Universitario', 'POLICIA', 'No', 'No', 'SI', 'Casa'),
(02, 'LUIS', 'VICENTE', 'PAISA', 'SALCEDO', '3455896', '24', '4266927712', 'CRITICLIGHT@HOTMAIL.COM', 'Casado', '1995-11-12', 'M', 50, 30, 'Ninguno', 'BEISBOLISTA', 'No', 'No', 'SI', 'Casa'),
(03, 'JOSMAR', 'GABRIEL', 'PEDROZA', 'MACIAS', '32911533', '24', '4266927712', 'GOKUDIOSMANSUPER@GMAIL.COM', 'Soltero', '2007-11-12', 'M', 30, 30, 'Básica', 'NINGUNA', 'No', 'No', 'SI', 'Casa'),
(04, 'MOISES', 'ANIBAL', 'FARINA', 'FERNANDEZ', '34551206', '24', '3267789', 'CARAOTADIGITAL@GMAIL.COM', 'Soltero', '2002-01-07', 'M', 50, 30, 'Ninguno', 'YOUTUBER', 'No', 'No', 'SI', 'Casa'),
(05, 'TOMMY', 'HILFIGER', 'RODRIGUEZ', 'MACIAS', '32551287', 'BELLWOOD', '425897120', 'ELGAMER4000@GMAIL.COM', 'Soltero', '2003-01-07', 'M', 50, 30, 'Bachiller', 'CONDUCTOR', 'No', 'No', 'SI', 'Casa'),
(06, 'MARCOS', 'ANUEL', 'SIRA', 'MILANO', '30789876', '24 DE JUNIO ', '4164559571', 'MARCOS@GMAIL.OM', 'Divorciado', '2006-02-17', 'M', 34, 40, 'BÃ¡sica', 'DOCTOR', 'Deficiencia visual', 'Artritis', 'SI', 'Chalet'),
(07, 'ANGELES', 'MARIA', 'HURTADO', 'BLANCO', '29365743', 'SAN FELIPE', '4128876591', 'SICCCA@GMAIL.COM', 'Soltero', '2002-07-22', 'F', 56, 39, 'Bachiller', 'ESTUDIANTE', 'No', 'No', 'NO', 'Ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(7, 'rayner@sarej', '$2y$10$JqT8i2IG.GA/0eaK5K102O4rKHq42fzUBsrXhR6IVF.WhyUTXESZW'),
(8, 'hola', '12345678'),
(9, 'eliver', '$2y$10$3yyGUjis..AEfBymz4CCDuJ9.1Msi1AGc3ghYsquLf1iIXMUOopKq');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
