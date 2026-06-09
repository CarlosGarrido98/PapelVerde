-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2026 a las 14:04:57
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `papel_verde`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comics`
--

CREATE TABLE `comics` (
  `id_producto` int(11) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `ilustrador` varchar(255) DEFAULT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comics`
--

INSERT INTO `comics` (`id_producto`, `autor`, `ilustrador`, `editorial`, `numero`, `isbn`) VALUES
(11, 'Jeph Loeb', 'Jim Lee', 'DC Comics', 1, '9789876543210'),
(12, 'Dan Jurgens', 'Bernard Chang', 'DC Comics', 1, '9789876543211'),
(13, 'Joshua Williamson', 'Carmine Di Giandomenico', 'DC Comics', 1, '9789876543212'),
(14, 'Robert Kirkman', 'Cory Walker', 'Image Comics', 1, '9789876543213'),
(15, 'Kentaro Takekuma', 'Charlie Nozawa', 'Nintendo Comics System', 1, '9789876543214'),
(16, 'Francisco Ibáñez', 'Francisco Ibáñez', 'Bruguera', 1, '9789876543215'),
(17, 'Brian Michael Bendis', 'Ivan Reis', 'DC Comics', 1, '9789876543216'),
(18, 'Hergé', 'Hergé', 'Casterman', 1, '9789876543217'),
(19, 'José Escobar', 'José Escobar', 'Bruguera', 1, '9789876543218'),
(20, 'Stan Lee', 'Steve Ditko', 'Marvel Comics', 1, '9789876543219');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_producto` int(11) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `num_paginas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_producto`, `autor`, `editorial`, `isbn`, `num_paginas`) VALUES
(1, 'Gabriel García Márquez', 'Sudamericana', '9786070729164', 368),
(2, 'Mario Puzo', 'Random House', '9783217001442', 400),
(3, 'Andy Weir', 'Ballantine Books', '9788413148465', 496),
(4, 'William Shakespeare', 'Penguin', '9788410206847', 200),
(5, 'Jon Krakauer', 'B de Bolsillo', '9788496778740', 288),
(6, 'Franz Kafka', 'Alianza', '9788420651361', 120),
(7, 'Paul Morley', 'Editorial Sexto Piso', '9788417517298', 180),
(8, 'Carmen Laforet', 'Destino', '9788437641683', 376),
(9, 'Giorgio Terruzzi', 'Motorbooks', '9788494786952', 320),
(10, 'Julio Verne', 'Anaya', '9788415618737', 280);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mangas`
--

CREATE TABLE `mangas` (
  `id_producto` int(11) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `editorial` varchar(255) DEFAULT NULL,
  `volumen` int(11) DEFAULT NULL,
  `coleccion` varchar(255) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mangas`
--

INSERT INTO `mangas` (`id_producto`, `autor`, `editorial`, `volumen`, `coleccion`, `isbn`) VALUES
(21, 'Hajime Isayama', 'Norma Editorial', 1, 'Shingeki no Kyojin', '9781234567890'),
(22, 'Shinichi Sakamoto', 'Milky Way Ediciones', 1, 'The Climber', '9781234567891'),
(23, 'Yoshiyuki Sadamoto', 'Norma Editorial', 1, 'Evangelion', '9781234567892'),
(24, 'Riichiro Inagaki', 'Ivrea', 1, 'Eyeshield 21', '9781234567893'),
(25, 'Gege Akutami', 'Norma Editorial', 1, 'Jujutsu Kaisen', '9781234567894'),
(26, 'Takeru Hokazono', 'Shueisha', 1, 'Kagurabachi', '9781234567895'),
(27, 'Masashi Kishimoto', 'Planeta Cómic', 1, 'Naruto', '9781234567896'),
(28, 'Eiichiro Oda', 'Planeta Cómic', 1, 'One Piece', '9781234567897'),
(29, 'Yoichi Takahashi', 'Ivrea', 1, 'Captain Tsubasa', '9781234567898'),
(30, 'Tatsuki Fujimoto', 'Norma Editorial', 1, 'Chainsaw Man', '9781234567899');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `tipo` enum('libro','comic','manga') NOT NULL,
  `imagen_url` varchar(500) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `precio`, `stock`, `tipo`, `imagen_url`, `sinopsis`) VALUES
(1, 'El amor en los tiempos del cólera', 9.99, 10, 'libro', 'img/Libros/amor_colera.webp', 'Una historia de amor que atraviesa décadas, marcada por la paciencia y la fidelidad de sus protagonistas.'),
(2, 'Der Pate', 5.50, 8, 'libro', 'img/Libros/DerPate.webp', 'Relato sobre el poder, la familia y el crimen organizado a través de la vida de la familia Corleone.'),
(3, 'Project Hail Mary', 9.99, 6, 'libro', 'img/Libros/hailmarry.webp', 'Un astronauta despierta solo en el espacio con la misión de salvar a la humanidad.'),
(4, 'Hamlet', 12.50, 5, 'libro', 'img/Libros/Hamlet.webp', 'Tragedia sobre la venganza, la locura y la duda existencial del príncipe de Dinamarca.'),
(5, 'Hacia rutas salvajes', 18.00, 7, 'comic', 'img/Libros/rutas_salvajes.webp', 'Historia real de un joven que abandona todo para buscar libertad en la naturaleza.'),
(6, 'La metamorfosis', 14.00, 9, 'libro', 'img/Libros/metamorfosis.webp', 'Un hombre despierta convertido en insecto, explorando el aislamiento y la incomprensión.'),
(7, '¿Quién mató a Michael Jackson?', 14.99, 4, 'libro', 'img/Libros/michael.webp', 'Investigación sobre la vida, fama y circunstancias que rodearon la muerte del artista.'),
(8, 'Nada', 13.50, 6, 'libro', 'img/Libros/nada.webp', 'Retrato de la posguerra española a través de la mirada de una joven en Barcelona.'),
(9, 'La última noche de Ayrton Senna', 16.65, 3, 'libro', 'img/Libros/senna.webp', 'Crónica de la vida y legado del legendario piloto de Fórmula 1.'),
(10, 'Viaje al centro de la Tierra', 16.00, 8, 'libro', 'img/Libros/viaje_tierra.webp', 'Aventura clásica sobre una expedición al interior del planeta llena de descubrimientos.'),
(11, 'Batman: Hush', 17.99, 6, 'comic', 'img/Comics/batman.webp', 'Batman se enfrenta a un misterioso enemigo mientras investiga una compleja conspiración.'),
(12, 'Batman Beyond', 15.00, 5, 'comic', 'img/Comics/beyond.webp', 'Un nuevo Batman surge en el futuro para proteger Gotham con tecnología avanzada.'),
(13, 'The Flash', 14.50, 7, 'comic', 'img/Comics/flash.webp', 'El hombre más rápido del mundo lucha contra amenazas que desafían el tiempo.'),
(14, 'Invincible Vol. 1', 18.50, 6, 'comic', 'img/Comics/invencible.webp', 'Un joven descubre sus poderes y aprende lo que significa ser un verdadero héroe.'),
(15, 'Super Mario Adventures', 16.00, 8, 'comic', 'img/Comics/Mario.webp', 'Aventuras llenas de humor de Mario y Luigi en el Reino Champiñón.'),
(16, 'Mortadelo y Filemón', 13.00, 10, 'comic', 'img/Comics/mortadelo.webp', 'Dos agentes torpes viven misiones absurdas llenas de humor y caos.'),
(17, 'Superman', 15.99, 5, 'comic', 'img/Comics/superman.webp', 'El icónico héroe de Krypton protege la Tierra con su increíble poder.'),
(18, 'Las aventuras de Tintín', 14.00, 7, 'comic', 'img/Comics/tintin.webp', 'El joven reportero vive emocionantes aventuras alrededor del mundo.'),
(19, 'Zipi y Zape', 12.50, 9, 'comic', 'img/Comics/zipiyzape.webp', 'Las travesuras de dos hermanos que siempre terminan metiéndose en problemas.'),
(20, 'Spider-Man', 16.50, 6, 'comic', 'img/Comics/spiderman.webp', 'Peter Parker equilibra su vida personal con su responsabilidad como superhéroe.'),
(21, 'Ataque a los Titanes', 18.00, 8, 'manga', 'img/Mangas/ataque.webp', 'La humanidad lucha por sobrevivir frente a gigantes devoradores conocidos como titanes.'),
(22, 'The Climber', 17.50, 6, 'manga', 'img/Mangas/climber.webp', 'Historia introspectiva sobre la superación personal a través del alpinismo.'),
(23, 'Neon Genesis Evangelion', 19.00, 5, 'manga', 'img/Mangas/evangelion.webp', 'Jóvenes pilotos deben enfrentarse a misteriosas criaturas en un mundo postapocalíptico.'),
(24, 'Eyeshield 21', 16.00, 7, 'manga', 'img/Mangas/eyeshield21.webp', 'Un chico tímido se convierte en estrella del fútbol americano escolar.'),
(25, 'Jujutsu Kaisen', 18.50, 9, 'manga', 'img/Mangas/jujutsu.webp', 'Un estudiante entra en el mundo de los hechiceros para combatir maldiciones.'),
(26, 'Kagurabachi', 17.00, 6, 'manga', 'img/Mangas/kagurabachi.webp', 'Un joven busca venganza usando una espada forjada con poderes especiales.'),
(27, 'Naruto', 15.00, 10, 'manga', 'img/Mangas/naruto.webp', 'Un ninja soñador busca convertirse en el líder de su aldea.'),
(28, 'One Piece', 17.50, 12, 'manga', 'img/Mangas/onepiece.webp', 'Un grupo de piratas recorre el mundo en busca del tesoro definitivo.'),
(29, 'Captain Tsubasa', 14.50, 7, 'manga', 'img/Mangas/tsubasa.webp', 'La historia de un joven futbolista con sueños de grandeza.'),
(30, 'Chainsaw Man', 18.00, 8, 'manga', 'img/Mangas/chainsawman.webp', 'Un joven con poderes demoníacos lucha contra criaturas en un mundo oscuro.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuarios` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `imagenURL` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `sexo` enum('Hombre','Mujer','Otro') DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `tarjeta_credito` varchar(50) DEFAULT NULL,
  `activar_notificaciones` tinyint(1) DEFAULT 0,
  `recibir_revista_digital` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuarios`, `nombre`, `email`, `contrasena`, `imagenURL`, `admin`, `sexo`, `fecha_nacimiento`, `direccion`, `pais`, `tarjeta_credito`, `activar_notificaciones`, `recibir_revista_digital`) VALUES
(1, 'Admin', 'admin@papelverde.com', 'admin1234', '/img/imgUsuarios/admin.jpg', 1, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 'Dioggito', 'dgt@gmail.com', 'dgt123', '/img/imgUsuarios/dgt.jpg', 0, NULL, NULL, NULL, NULL, NULL, 0, 0),
(3, 'Nath', 'nath@gmail.com', 'nath123', 'img/imgUsuarios/nath.jpg', 0, 'Mujer', '2005-10-12', 'Calle La chopera,14', 'Colombia', NULL, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `mangas`
--
ALTER TABLE `mangas`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `comics_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `libros_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `mangas`
--
ALTER TABLE `mangas`
  ADD CONSTRAINT `mangas_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
