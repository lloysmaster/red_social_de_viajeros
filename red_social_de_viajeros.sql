-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2024 at 05:17 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `red_social_de_viajeros`
--

-- --------------------------------------------------------

--
-- Table structure for table `viajes`
--

CREATE TABLE `viajes` (
  `id` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `pais_destino` varchar(100) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `ciudad_destino` varchar(100) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `viajes`
--

INSERT INTO `viajes` (`id`, `pais`, `pais_destino`, `ciudad`, `ciudad_destino`, `fecha_ini`, `fecha_fin`, `user_id`) VALUES
(2, 'Francia', 'Argentina', 'París', 'Buenos Aires', '2024-10-01', '2024-10-05', 1),
(3, 'España', 'España', 'Madrid', 'Barcelona', '2024-11-15', '2024-11-20', 2),
(4, 'Italia', 'Alemania', 'Roma', 'Berlin', '2024-08-22', '2024-08-26', 1),
(5, 'Brasil', 'Argentina', 'Río de Janeiro', 'Cordoba', '2024-12-05', '2024-12-10', 2),
(6, 'Japón', 'Grecia', 'Tokio', 'Atenas', '2024-09-12', '2024-09-20', 1),
(8, 'Argentina', 'Chile', 'Buenos Aires', 'Santiago', '0000-00-00', '0000-00-00', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `viajes`
--
ALTER TABLE `viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `viajes`
--
ALTER TABLE `viajes`
  ADD CONSTRAINT `viajes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
