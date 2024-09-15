-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-09-2024 a las 21:40:26
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreria_tudai`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE `editorial` (
  `ID_Editorial` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`ID_Editorial`, `nombre`, `pais`) VALUES
(1, 'Debolsillo', 'España'),
(2, 'Ivrea', 'Argentina'),
(3, 'NOVA', 'Argentina'),
(4, 'Panini', 'Mexico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `ID_Libro` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `ID_Editorial` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`ID_Libro`, `titulo`, `autor`, `genero`, `precio`, `ID_Editorial`) VALUES
(1, 'Juego de tronos', 'George R.R. Martin', 'Fantasia', 30000, 1),
(2, 'Fullmetal alchemist', ' Hiromu Arakawa', 'Aventura', 6000, 2),
(3, 'Elantris', 'Brandon Sanderson', 'Fantasia', 40000, 3),
(4, 'Spider-man', 'Stan Lee', 'Superheroe', 15000, 4),
(5, 'La comunidad del anillo', 'J. R. R. Tolkien', 'Fantasia', 30000, 1),
(6, 'El rey arturo', 'Chretien de Troyes ', 'Aventura', 4000, 1),
(7, 'Yo soy el Diego de la gente', 'Diego Armando Maradona', 'Autobiografico', 10000, 1),
(8, 'Dragon ball', 'Akira Toriyama', 'Aventura', 6000, 2),
(9, 'DUNE: Parte 1', 'Frank Herbert', 'Postapocalíptico', 40000, 3),
(11, 'Naruto', 'Masashi Kishimoto', 'Aventura', 6000, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `editorial`
--
ALTER TABLE `editorial`
  ADD PRIMARY KEY (`ID_Editorial`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`ID_Libro`),
  ADD KEY `ID_Editorial` (`ID_Editorial`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `editorial`
--
ALTER TABLE `editorial`
  MODIFY `ID_Editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `libro`
--
ALTER TABLE `libro`
  MODIFY `ID_Libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro`
--
ALTER TABLE `libro`
  ADD CONSTRAINT `libro_ibfk_1` FOREIGN KEY (`ID_Editorial`) REFERENCES `editorial` (`ID_Editorial`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
