-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2023 a las 09:32:56
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goty`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `productora` varchar(100) NOT NULL,
  `img` varchar(100) NOT NULL,
  `votos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `productora`, `img`, `votos`) VALUES
('elden_ring', 'elden ring', 'FROMSOFTWARE / BANDAI NAMCO', 'https://i.postimg.cc/tRWc044J/goty-eldenring-4.jpg', 1),
('god_of_war', 'god of war ragnarök', 'SONY SANTA MONICA / SIE', 'https://i.postimg.cc/NftzQvK4/goty-godofwar-4.jpg', 0),
('horizon_forbidden', 'HORIZON FORBIDDEN WEST', 'GUERRILLA GAMES / SIE', 'https://i.postimg.cc/K8vpg7r3/goty-horizon-4.jpg', 0),
('plague_tale', 'a plague tale: requiem', 'asobo studio / focus entertainment', 'https://i.postimg.cc/cHYFNFZ2/GOTY-Plague-tale-3.jpg', 0),
('stray', 'stray', 'BLUETWELVE STUDIO / ANNAPURNA', 'https://i.postimg.cc/02CHQXmq/GOTY-Stray-6.jpg', 0),
('xenoblade_3', 'XENOBLADE CHRONICLES 3', 'MONOLITH SOFT / NINTENDO', 'https://i.postimg.cc/jjBM9pVy/GOTY-Xenoblade-1.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario` varchar(20) NOT NULL,
  `contra` varchar(50) NOT NULL,
  `votado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contra`, `votado`) VALUES
('admin', '9996535e07258a7bbfd8b132435c5962', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
