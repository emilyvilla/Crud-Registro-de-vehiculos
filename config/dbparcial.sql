-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 07:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbparcial`
--

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE `marca` (
  `marcaNombre` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `marca`
--

INSERT INTO `marca` (`marcaNombre`) VALUES
('Chevrolet'),
('KIA'),
('Mazda'),
('Renault');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `contrasena` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `contrasena`) VALUES
(1, 'nombreestudiante', 'appweb'),
(2, 'admin', 'parcialfin');

-- --------------------------------------------------------

--
-- Table structure for table `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `marca` varchar(50) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `modelo`, `valor`, `marca`, `foto`) VALUES
(1, 'Sportage 2024', '149490000', 'KIA', 'imagenes/sportage-nq5-1.png'),
(2, 'Onix Turbo Sedan 2023', '76820000', 'Chevrolet', 'imagenes/Captura.PNG'),
(3, 'Sedan 2024', '82250000', 'Mazda', 'imagenes/2024-aveo-form.png'),
(4, 'Sandero', '64990000', 'Renault', 'imagenes/sandero.png'),
(5, 'Soluto 2024', '68990000', 'KIA', 'imagenes/solutoo.png'),
(6, 'Blazer RS', '215620000', 'Chevrolet', 'imagenes/Colores-Blanco.png'),
(7, 'Duster', '96900000', 'Renault', 'imagenes/duster.png'),
(8, 'Convertible MX-5', '172750000', 'Mazda', 'imagenes/2022-mx5-sport-jet-black.png'),
(9, 'Colorado', '244320000', 'Chevrolet', 'imagenes/Desktop.png'),
(10, 'Twizy Technic', '44000000', 'Renault', 'imagenes/renault_18t.png'),
(11, 'Prueba', '123456789', 'Chevrolet', 'imagenes/icons8-oncoming-automobile-96.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `marca` (`marca`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
