-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2026 a las 03:29:49
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
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id` int(11) NOT NULL,
  `idUsuarios` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id`, `idUsuarios`, `id_producto`, `cantidad`, `creado_en`) VALUES
(63, 5, 3, 1, '2026-06-15 22:04:45');

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
(13, 'Joshua Williamson', 'Carmine Di Giandomenico', 'DC Comics', 100, '9789876543212'),
(14, 'Robert Kirkman', 'Cory Walker', 'Image Comics', 1, '9789876543213'),
(15, 'Kentaro Takekuma', 'Charlie Nozawa', 'Nintendo Comics System', 1, '9789876543214'),
(16, 'Francisco Ibáñez', 'Francisco Ibáñez', 'Bruguera', 1, '9789876543215'),
(17, 'Brian Michael Bendis', 'Ivan Reis', 'DC Comics', 1, '9789876543216'),
(18, 'Hergé', 'Hergé', 'Casterman', 1, '9789876543217'),
(19, 'José Escobar', 'José Escobar', 'Bruguera', 1, '9789876543218'),
(20, 'Stan Lee', 'Steve Ditko', 'Marvel Comics', 1, '9789876543219'),
(63, 'J.M. DeMatteis', 'Mike Zeck', 'Panini', 42, '9791370136550'),
(64, 'Brian Michael Bendis', 'Sara Pichelli', 'Panini', 1, '9788413346052'),
(65, 'Ed Brubaker', 'Michael Lark', 'Panini España', 2, '9788410497825'),
(66, 'Bilquis Evely', 'Tom King', 'Panini', 1, '9791370136338'),
(67, 'Geoff Johns', 'Ivan Reis', 'Panini', 1, '9791370136895'),
(68, 'Charles Soule', 'Steve McNiven', 'Panini', 1, '9788411017107');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `idUsuarios` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`idUsuarios`, `id_producto`) VALUES
(3, 11),
(3, 14),
(5, 13);

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
(6, 'Franz Kafka', 'Alianza', '9788420651361', 120),
(7, 'Paul Morley', 'Editorial Sexto Piso', '9788417517298', 180),
(8, 'Carmen Laforet', 'Destino', '9788437641683', 376),
(9, 'Giorgio Terruzzi', 'Motorbooks', '9788494786952', 320),
(10, 'Julio Verne', 'Anaya', '9788415618737', 280),
(31, 'Jon Krakauer', 'B de Bolsillo', '9788496778740', 288),
(41, 'Miguel de Cervantes Saavedra', 'Rae', '9788420479873', 1424),
(42, 'J.K. Rowling', 'Debolsillo', '9788466393645', 320),
(43, 'J.K. Rowling', 'Debolsillo', '9788466393652', 384),
(44, 'J.K. Rowling', 'Debolsillo', '9788466393652', 384),
(45, 'J.K. Rowling', 'Debolsillo', '9788466393638', 576),
(46, 'J.K. Rowling', 'Debolsillo', '9788466393676', 704),
(47, 'Frank Herbert', 'Debolsillo', '9788466353779', 784),
(48, 'Frank Helbert', 'Debolsillo', '9788466356961', 304),
(49, 'Frank Herbert', 'Debolsillo', '9788466357005', 608),
(50, 'J.R.R. Tolkien', 'Minotauro', '9788445013557', 704),
(51, 'J.R.R Tolkien', 'Booket', '9788445018064', 592),
(52, 'J.R.R. Tolkien', 'Booket', '9788445018071', 688);

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
(21, 'Hajime Isayama', 'Norma Editorial', 22, 'Shingeki no Kyojin', '9781234567890'),
(22, 'Shinichi Sakamoto', 'Milky Way Ediciones', 1, 'The Climber', '9781234567891'),
(23, 'Yoshiyuki Sadamoto', 'Norma Editorial', 1, 'Evangelion', '9781234567892'),
(24, 'Riichiro Inagaki', 'Ivrea', 1, 'Eyeshield 21', '9781234567893'),
(25, 'Gege Akutami', 'Norma Editorial', 1, 'Jujutsu Kaisen', '9781234567894'),
(26, 'Takeru Hokazono', 'Shueisha', 1, 'Kagurabachi', '9781234567895'),
(27, 'Masashi Kishimoto', 'Planeta Cómic', 1, 'Naruto', '9781234567896'),
(28, 'Eiichiro Oda', 'Planeta Cómic', 1, 'One Piece', '9781234567897'),
(29, 'Yoichi Takahashi', 'Ivrea', 1, 'Captain Tsubasa', '9781234567898'),
(30, 'Tatsuki Fujimoto', 'Norma Editorial', 1, 'Chainsaw Man', '9781234567899'),
(53, 'Kentaro Miura', 'Panini', 1, 'Master', '9791370136383'),
(54, 'Makoto Yukimura', 'Planeta Cómic', 29, 'Manga Seinen', '9791387918095'),
(55, 'Makoto Yukimura', 'Planeta Cómic', 1, 'Manga Seinen', '9788416051816'),
(56, 'Makoto Yukimura', 'Planeta Cómic', 13, 'Manga Seinen', '9788416816248'),
(57, 'Takehiko Inoue', 'Ivrea', 1, 'Vagabond', '9788415922940'),
(58, 'Takehiko Inoue', 'Ivrea', 8, 'Vagabond', '9788416150045'),
(59, 'Takehiko Inoue', 'Ivrea', 29, 'Vagabond', '9788416352913'),
(60, 'Takehiko Inoue', 'Ivrea', 19, 'Slam Dunk', '9788410258822'),
(61, 'Takehiko Inoue', 'Ivrea', 14, 'Slam Dunk ', '9788410113626'),
(62, 'Takehiko Inoue', 'Ivrea', 15, 'Slam Dunk New Edition', '9788410113985');

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
(1, 'El amor en los tiempos del cólera', 9.99, 10, 'libro', 'img/Libros/amor_colera.webp', 'La novela comienza con la muerte del Dr. Juvenal Urbino, esposo de Fermina Daza, un médico respetado que muere accidentalmente al intentar rescatar a su loro. Durante el funeral, Florentino Ariza, un hombre que ha esperado pacientemente más de cincuenta años, le declara nuevamente su amor a Fermina, recordándole la promesa de fidelidad que hizo en su juventud.\r\nLa historia retrocede al pasado para narrar cómo Florentino, un joven telegrafista, se enamora de Fermina, hija de una familia acomodada. Aunque Fermina inicialmente corresponde a sus sentimientos, su padre, Lorenzo Daza, desaprueba la relación y la envía lejos para separarla de Florentino. Durante su ausencia, mantienen contacto mediante cartas, pero al regresar, Fermina se distancia y finalmente se casa con Urbino, con quien tiene un hijo llamado Marco Aurelio'),
(2, 'Der Pate', 5.50, 8, 'libro', 'img/Libros/DerPate.webp', 'Relato sobre el poder, la familia y el crimen organizado a través de la vida de la familia Corleone.'),
(3, 'Project Hail Mary', 9.99, 6, 'libro', 'img/Libros/hailmarry.webp', 'Un astronauta despierta solo en el espacio con la misión de salvar a la humanidad.'),
(4, 'Hamlet', 9.50, 7, 'libro', 'img/Libros/Hamlet.webp', 'Hamlet, la obra maestra de William Shakespeare, narra la historia del príncipe de Dinamarca quien, consumido por el dolor y guiado por el fantasma de su padre, busca vengar su asesinato. En su camino hacia la venganza, Hamlet finge locura y se enfrenta a profundos dilemas morales y existenciales.'),
(6, 'La metamorfosis', 8.99, 9, 'libro', 'img/Libros/metamorfosis.webp', 'La metamorfosis, escrita por Franz Kafka en 1915, narra la historia de Gregorio Samsa, un viajante de comercio que despierta una mañana convertido en un monstruoso insecto. A partir de ese momento, sufre el rechazo y la incomprensión de su familia, mientras su vida se desmorona al dejar de ser el sostén económico del hogar'),
(7, '¿Quién mató a Michael Jackson?', 9.50, 7, 'libro', 'img/Libros/michael.webp', 'Michael Jackson murió el 25 de junio de 2009 en Los Angeles. Para entonces, su\r\nagotamiento, paranoia y mala salud eran un secreto a voces; de algún modo, era\r\ncomo si ya llevase muerto un tiempo y la muerte real no fuera sino un gran final\r\ndramático con el que se coronaba una existencia que, desde muy temprana edad,\r\nestuvo marcada por el talento y el estrellato, pero también por la infelicidad y la\r\npolémica: sus operaciones, el color de su piel y, muy especialmente, las gravísimas\r\nacusaciones de pederastia. Paul Morley reflexiona sobre la cultura mediática y\r\nnuestra obsesión con las celebridades; sobre la cultura mediática y nuestra obsesión\r\ncon las celebridades; sobre el modo en que convertimos a la mayor estrella infantil de\r\nfinales del siglo XX en un monstruo grotesco...'),
(8, 'Nada', 9.50, 6, 'libro', 'img/Libros/nada.webp', 'Narra la historia de Andrea, una joven huérfana Andrea que llega a Barcelona llena de ilusiones para estudiar en la universidad. Sin embargo, sus expectativas chocan de inmediato con la opresiva, sórdida y caótica atmósfera de la casa de su familia en la calle Aribau, donde se vive una profunda miseria económica y moral de la posguerra española'),
(9, 'La última noche de Ayrton Senna', 9.65, 10, 'libro', 'img/Libros/senna.webp', 'La última noche de Ayrton Senna es un libro del periodista italiano Giorgio Terruzzi que reconstruye de forma íntima las horas previas a la muerte del piloto en el Gran Premio de San Marino el 1 de mayo de 1994'),
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
(21, 'Ataque a los Titanes ', 6.99, 10, 'manga', 'img/Mangas/ataque.webp', 'Ataque a los Titanes (Shingeki no Kyojin) sigue a la humanidad, que vive confinada tras gigantescos muros para protegerse de los Titanes, unas criaturas humanoides gigantes que devoran personas. Tras la destrucción de su ciudad natal por dos titanes colosales y la muerte de su madre, el joven Eren Jaeger jura exterminarlos y se une al Cuerpo de Exploración.'),
(22, 'The Climber', 17.50, 6, 'manga', 'img/Mangas/climber.webp', 'Historia introspectiva sobre la superación personal a través del alpinismo.'),
(23, 'Neon Genesis Evangelion', 19.00, 5, 'manga', 'img/Mangas/evangelion.webp', 'Jóvenes pilotos deben enfrentarse a misteriosas criaturas en un mundo postapocalíptico.'),
(24, 'Eyeshield 21', 16.00, 7, 'manga', 'img/Mangas/eyeshield21.webp', 'Un chico tímido se convierte en estrella del fútbol americano escolar.'),
(25, 'Jujutsu Kaisen', 18.50, 9, 'manga', 'img/Mangas/jujutsu.webp', 'Un estudiante entra en el mundo de los hechiceros para combatir maldiciones.'),
(26, 'Kagurabachi', 17.00, 6, 'manga', 'img/Mangas/kagurabachi.webp', 'Un joven busca venganza usando una espada forjada con poderes especiales.'),
(27, 'Naruto', 15.00, 10, 'manga', 'img/Mangas/naruto.webp', 'Un ninja soñador busca convertirse en el líder de su aldea.'),
(28, 'One Piece', 17.50, 12, 'manga', 'img/Mangas/onepiece.webp', 'Un grupo de piratas recorre el mundo en busca del tesoro definitivo.'),
(29, 'Captain Tsubasa', 14.50, 7, 'manga', 'img/Mangas/tsubasa.webp', 'La historia de un joven futbolista con sueños de grandeza.'),
(30, 'Chainsaw Man', 18.00, 8, 'manga', 'img/Mangas/chainsawman.webp', 'Un joven con poderes demoníacos lucha contra criaturas en un mundo oscuro.'),
(31, 'Hacia rutas salvajes', 9.99, 10, 'libro', 'img/Libros/rutas_salvajes.webp', 'Christopher McCandless, un estudiante de 10, abandona todas sus posesiones, dona sus ahorros a la caridad y hace autoestop hasta llegar a Alaska para vivir en una zona selvática.'),
(41, 'Don Quijote de la Mancha', 11.50, 12, 'libro', 'img/Libros/1781347305_quijote.webp', 'Don Quijote de la Mancha (escrita por Miguel de Cervantes) narra la historia de Alonso Quijano, un hidalgo que enloquece tras leer demasiadas novelas de caballería. Convencido de ser un caballero andante, viaja por España acompañado por su fiel escudero, Sancho Panza, viviendo cómicas aventuras mientras intenta defender a los débiles y hacer justicia'),
(42, 'Harry Potter y la cámara secreta', 11.30, 13, 'libro', 'img/Libros/harry1.webp', 'Harry Potter y la cámara secreta, el segundo volumen de la ya clásica serie de novelas fantásticas de la autora británica J.K. Rowling.\r\n\r\n«Hay una conspiración, Harry Potter. Una conspiración para hacer que este año sucedan las cosas más terribles en el Colegio Hogwarts de Magia y Hechicería.»\r\n\r\nEl verano de Harry Potter ha incluido el peor cumpleaños de su vida, las funestas advertencias de un elfo doméstico llamado Dobby y el rescate de casa de los Dursley protagonizado por su amigo Ron Weasley al volante de un coche mágico volador. De vuelta en el Colegio Hogwarts de Magia y Hechicería, donde va a empezar su segundo curso, Harry oye unos extraños susurros que resuenan por los pasillos vacíos. Y entonces empiezan los ataques y varios alumnos aparecen petrificados... Por lo visto, las siniestras predicciones de Dobby se están cumpliendo.'),
(43, 'Harry Potter y el prisionero de Azkaban', 11.30, 15, 'libro', 'img/Libros/harry2.webp', 'Harry Potter y el prisionero de Azkaban es la tercera novela de la ya clásica serie fantástica de la autora británica J.K. Rowling.\n\n«Bienvenido al autobús noctámbulo, transporte de emergencia para el brujo abandonado a su suerte. Levante la varita, suba a bordo y lo llevaremos a donde quiera.»\n\nCuando el autobús noctámbulo irrumpe en una calle oscura y frena con fuertes chirridos delante de Harry, comienza para él un nuevo curso en Hogwarts, lleno de acontecimientos extraordinarios. Sirius Black, asesino y seguidor de lord Voldemort, se ha fugado, y dicen que va en busca de Harry. En su primera clase de Adivinación, la profesora Trelawney ve un augurio de muerte en las hojas de té de la taza de Harry... Pero quizá lo más aterrador sean los dementores que patrullan por los jardines del colegio, capaces de sorberte el alma con su beso...'),
(44, 'Harry Potter y el misterio del príncipe', 11.50, 12, 'libro', 'img/Libros/harry3.webp', 'Harry Potter y el misterio del príncipe es la sexta novela de la ya clásica serie fantástica de la autora británica J.K. Rowling.\r\n\r\nCon dieciséis años cumplidos, Harry inicia el sexto curso en Hogwarts en medio de terribles acontecimientos que asolan Inglaterra. Elegido capitán del equipo de quidditch, los ensayos, los exámenes y las chicas ocupan todo su tiempo, pero la tranquilidad dura poco.\r\n\r\nA pesar de los férreos controles de seguridad que protegen la escuela, dos alumnos son brutalmente atacados. Dumbledore sabe que se acerca el momento, anunciado por la Profecía, en que Harry y Voldemort se enfrentarán a muerte: «El único con poder para vencer al Señor Tenebroso se acerca... Uno de los dos debe morir a manos del otro, pues ninguno de los dos podrá vivir mientras siga el otro con vida.»'),
(45, 'Harry Potter y el cáliz de fuego', 9.50, 16, 'libro', 'img/Libros/harry4.webp', 'Harry Potter y el cáliz de fuego es la cuarta entrega de la serie fantástica de la autora británica J.K. Rowling.\r\n\r\n«Habrá tres pruebas, espaciadas en el curso escolar, que medirán a los campeones en muchos aspectos diferentes: sus habilidades mágicas, su osadía, sus dotes de deducción y, por supuesto, su capacidad para sortear el peligro.»\r\n\r\nSe va a celebrar en Hogwarts el Torneo de los Tres Magos. Sólo los alumnos mayores de diecisiete años pueden participar en esta competición, pero, aun así, Harry sueña con ganarla. En Halloween, cuando el cáliz de fuego elige a los campeones, Harry se lleva una sorpresa al ver que su nombre es uno de los escogidos por el cáliz mágico. Durante el torneo deberá enfrentarse a desafíos mortales, dragones y magos tenebrosos, pero con la ayuda de Ron y Hermione, sus mejores amigos, ¡quizá logre salir con vida!\r\n\r\n'),
(46, 'Harry Potter y las reliquias de la muerte', 12.30, 16, 'libro', 'img/Libros/harry5.webp', 'Harry Potter y las reliquias de la muerte es el séptimo y último volumen de la ya clásica serie fantástica de la autora británica J.K. Rowling.\r\n\r\n«Entregadme a Harry Potter -dijo la voz de Voldemort- y nadie sufrirá ningún daño. Entregadme a Harry Potter y dejaré el colegio intacto. Entregadme a Harry Potter y seréis recompensados.»\r\n\r\nCuando se monta en el sidecar de la moto de Hagrid y se eleva en el cielo, dejando Privet Drive por última vez, Harry Potter sabe que lord Voldemort y sus mortífagos se hallan cerca. El encantamiento protector que había mantenido a salvo a Harry se ha roto, pero él no puede seguir escondiéndose. El Señor Tenebroso se dedica a aterrorizar a todos los seres queridos de Harry, y, para detenerlo, éste habrá de encontrar y destruir los horrocruxes que quedan. La batalla definitiva debe comenzar: Harry tendrá que alzarse y enfrentarse a'),
(47, 'Dune', 11.20, 12, 'libro', 'img/Libros/dune1.webp', ' mayor epopeya de todos los tiempos, en nueva edición con la traducción corregida en 2019.\r\n\r\nEn el desértico planeta Arrakis, el agua es el bien más preciado y llorar a los muertos, el símbolo de máxima prodigalidad. Pero algo hace de Arrakis una pieza estratégica para los intereses del Emperador, las Grandes Casas y la Cofradía, los tres grandes poderes de la galaxia. Arrakis es el único origen conocido de la melange, preciosa especia y uno de los bienes más codiciados del universo.\r\n\r\nAl duque Leto Atreides se le asigna el gobierno de este mundo inhóspito, habitado por los indómitos Fremen y monstruosos gusanos de arena de centenares de metros de longitud. Sin embargo, cuando la familia es traicionada, su hijo y heredero, Paul, emprenderá un viaje hacia un destino más grande del que jamás hubiese podido soñar.\r\n\r\nMezcla fascinante de aventura, misticismo, intrigas políticas y ecologismo, Dune se convirtió, desde el momento de su publicación, en un fenómeno de culto y en la mayor epopeya de ciencia-ficción de todos los tiempos.'),
(48, 'El mesías de Dune', 10.00, 11, 'libro', 'img/Libros/dune2.webp', 'El mesías de Dune es la segunda entrega de la excepcional saga de Frank Herbert «Dune», considerada la mejor serie de ciencia ficción de todos los tiempos.\r\n\r\nArrakis, también llamado Dune: un mundo desierto en pos del sueño de convertirse en un paraíso, cuna de mil guerras que se han extendido por todo el universo y de un anhelo mesiánico que intenta alcanzar el sueño más antiguo de la humanidad...\r\n\r\nPaul Atreides: un personaje mítico, perturbado por la cercana presencia de una sombra dominante: su hermana Alia. Y frente a ellos, los grandes intereses económicos, políticos y religiosos que sacuden los espacios interestelares: la CHOAM, la Cofradía espacial, el Landsraad, la Bene Gesserit...\r\n\r\nTodo ello, y mucho más, conforma esta segunda entrega de «Dune»: un fresco impresionante y una obra cumbre de la imaginación.\r\n\r\n'),
(49, 'Hijos de Dune', 12.65, 16, 'libro', 'img/Libros/dune3.webp', 'Hijos de Dune es la tercera novela de la serie «Dune» de Frank Herbert, una obra maestra unánimemente reconocida como la mejor saga de ciencia ficción de todos los tiempos.\r\n\r\nLeto Atreides, el hijo de Paul -el mesías de una religión que arrasó el universo, el mártir que, ciego, se adentró en el desierto para morir-, tiene ahora nueve años. Pero es mucho más que un niño, porque dentro de él laten miles de vidas que lo arrastran a un implacable destino. Él y su hermana gemela, bajo la regencia de su tía Alia, gobiernan un planeta que se ha convertido en el eje de todo el universo. Arrakis, más conocido como Dune.\r\n\r\nY en este planeta, centro de las intrigas de una corrupta clase política y sometido a una sofocante burocracia religiosa, aparece de pronto un predicador ciego, procedente del desierto. ¿Es realmente Paul Atreides, que regresa de entre los muertos para advertir a la humanidad del peligro más abominable?'),
(50, 'El Señor de los Anillos:La Comunidad del Anillo', 10.00, 20, 'libro', 'img/Libros/sa1.webp', 'Primera entrega de la trilogía.\n\n«Este libro es como un relámpago en un cielo claro. Decir que la novela heroica, espléndida, elocuente y desinhibida, ha retornado de pronto en una época de un antirromanticismo casi patológico, sería inadecuado. Para quienes vivimos en esa extraña época, el retorno —y el alivio que nos trae— es sin duda lo más importante'),
(51, 'El Señor de los Anillos:Las Dos Torres', 12.65, 16, 'libro', 'img/Libros/sa2.webp', 'La segunda entrega de la trilogía de J. R. R. Tolkien El Señor de los Anillos.\r\nEmpieza tu viaje a la Tierra Media.\r\nEdición revisada.\r\n\r\nLa misión parece abocada al fracaso, pero la aventura épica que se inició con La Comunidad del Anillo continúa…\r\n\r\n\r\nLa Compañía se ha disuelto y sus integrantes emprenden caminos separados. Frodo y Sam avanzan solos en su viaje a lo largo del río Anduin, perseguidos por la sombra misteriosa de un ser extraño que también ambiciona la posesión del Anillo. Mientras, hombres, elfos y enanos se preparan para la batalla final contra las fuerzas del Señor del Mal.\r\n\r\n'),
(52, 'El Señor de los Anillos:El Retorno del Rey', 13.20, 17, 'libro', 'img/Libros/sa3.webp', 'La tercera entrega de la trilogía de J. R. R. Tolkien El Señor de los Anillos.\r\nEmpieza tu viaje a la Tierra Media.\r\nEdición revisada.\r\n\r\nLa última parte del viaje de Frodo y Sam, el espectacular final de la épica historia creada por J. R. R. Tolkien.\r\n\r\n\r\nLos ejércitos del Señor Oscuro van extendiendo cada vez más su maléfica sombra por la Tierra Media. Hombres, elfos y enanos unen sus fuerzas para presentar batalla a Sauron y sus huestes. Ajenos a estos preparativos, Frodo y Sam siguen adentrándose en el país de Mordor en su heroico viaje para destruir el Anillo de Poder en las Grietas del Destino.\r\n\r\n'),
(53, 'Berserk Master Edition 1', 20.00, 9, 'manga', 'img/Mangas/berserk1.webp', 'La oscura fantasía épica llena de acción y que ha definido todo un género, de Kentaro Miura, ahora disponible como MASTER EDITION en un elegante volumen de tapa dura de más de 700 páginas ¡Vive las sangrientas y atormentadas aventuras de Guts y compañía como nunca antes! Esta edición incluye los volúmenes originales del 1 al 3 con nuevos materiales de imprenta que, junto al formato de mayores dimensiones, presentan los impresionantes detalles de la obra maestra de Kentaro Miura de una forma tan grandiosa como nunca antes. Además, la rica sección de extras especiales en papel satinado incluye todas las páginas en color y portadas hasta ahora inéditos en España.'),
(54, 'Vinland Saga nº 29', 11.20, 16, 'manga', 'img/Mangas/vinland29.webp', 'La epopeya nórdica que cuestiona qué es un verdadero guerrero llega a su fin. ¡El último volumen de Vinland Saga!\r\n\r\nAmbientada en la Escandinavia vikinga del siglo XI, esta es la historia de Thorfinn y su búsqueda del significado de ser un verdadero guerrero. Tras una vida marcada por la venganza y la esclavitud, alcanza la tierra prometida de Vinland con el sueño de fundar un país en paz. Pero las disonancias entre su pueblo y los nativos de Vinland son cada vez más grandes y la epidemia ha dejado estragos inimaginables.'),
(55, 'Vinland Saga nº 01', 10.20, 19, 'manga', 'img/Mangas/vinland1.webp', 'Desafiando las rígidas leyes vikingas y a pesar de ser un gran guerrero, Thors decide huiráde la cruenta vida que llevaba con su familia. Al ser descubierto, será perseguido durante su viaje marítimoápor un mercenario de nombre Askeladd, cayendo finalmente en una emboscadaájunto a su expedición.áGanará la batalla contraásus atacantes, aunque a un alto precio: Thors dará su vida para que el resto de la tripulación, incluido su hijo Thorfinn, vivan. Desde aquel instante Thorfinn jura vengarse. Sin embargo, será apresado por Askeladd y obligado a enrolarse en su barco.áPero aºn le quedará una esperanza. Segºn el código vikingo,áThorfinn tendrá derecho de retar a Askeladd a duelo si cumple una serie de difíciles tareas, como sabotear o matar a generales enemigos, lo que lo les llevará a involucrarse incluso en la guerra por la corona de Inglaterra.'),
(56, 'Vinland Saga nº 13', 10.23, 6, 'manga', 'img/Mangas/vinland13.webp', 'Thorfinn ha dado la espalda a su vida de mercenario y ahora aspira a una existencia sin violencia. Pero tras defender a un esclavo fugitivo, las cosas se complican...'),
(57, 'Vagabond 01', 6.50, 11, 'manga', 'img/Mangas/vagabond1.webp', 'Cuenta la historia del legendario espadachín Musashi Miyamoto, la figura histórica más importante del Japón en lo que se refiere al desarrollo de las técnicas de lucha con espada. Desde su juventud como el violento e iracundo joven llamado Takezo, sobreviviendo (aun estando del lado perdedor) a una de las batallas más sangrientas de la historia: Sekigahara; hasta su decisión de pasar a llamarse Musashi y embarcarse en una búsqueda de autosuperación personal que lo llevará a enfrentarse con los más grandes expertos de las artes marciales del país. Colección Seinen Manga.\r\n'),
(58, 'Vagabond 8', 6.20, 5, 'manga', 'img/Mangas/vagabond8.webp', 'Cuenta la historia del legendario espadachín Musashi Miyamoto, la figura histórica más importante del Japón en lo que se refiere al desarrollo de las técnicas de lucha con espada. Desde su juventud como el violento e iracundo joven llamado Takezo, sobreviviendo (aun estando del lado perdedor) a una de las batallas más sangrientas de la historia: Sekigahara; hasta su decisión de pasar a llamarse Musashi y embarcarse en una búsqueda de autosuperación personal que lo llevará a enfrentarse con los más grandes expertos de las artes marciales del país.'),
(59, 'Vagabond 29', 5.50, 9, 'manga', 'img/Mangas/vagabond29.webp', 'Cuenta la historia del legendario espadachín Musashi Miyamoto, la figura histórica más importante del Japón en lo que se refiere al desarrollo de las técnicas de lucha con espada. Desde su juventud como el violento e iracundo joven llamado Takezo, sobreviviendo (aun estando del lado perdedor) a una de las batallas más sangrientas de la historia: Sekigahara; hasta su decisión de pasar a llamarse Musashi y embarcarse en una búsqueda de autosuperación personal que lo llevará a enfrentarse con los más grandes expertos de las artes marciales del país.'),
(60, 'Slam Dunk New Edition 19', 11.23, 6, 'manga', 'img/Mangas/slam19.webp', '¡Presentamos Slam Dunk New Edition en formato B6! Esta nueva edición del manga cuenta con sólo 20 tomos, sobrecubiertas inéditas en splash y una cubierta interior con textura que simula una pelota de baloncesto. Humor, romance y autosuperación en uno de los mejores spokon de la historia. La mítica obra la protagoniza Hanamichi Sakuragi, un gamberrillo de instituto que descubre la pasión del baloncesto y acaba convirtiéndose en un gran jugador intentando ligarse a su compañera de clase Haruko Akagi. Ante él tendrá como obstáculos a su compañero de equipo, archirival y superjugador Kaede Rukawa, del cual Haruko está enamorada, al capitán del equipo Takenori, que es hermano de Haruko y a su mayor enemigo: su explosivo carácter. El memorable manga es obra de Takehiko Inoue, que muestra su pasión por el basket viñeta a viñeta, cuenta con el genial dibujo al que nos tiene acostumbrados y que se ha vuelto a demostrar con unas nuevas e increíbles ilustraciones de portada.'),
(61, 'Slam Dunk New Edition 14', 10.20, 6, 'manga', 'img/Mangas/slam14.webp', 'Presentamos Slam Dunk New Edition en formato B6! Esta nueva edición del manga cuenta con sólo 20 tomos, sobrecubiertas inéditas en splash y una cubierta interior con textura que simula una pelota de baloncesto. Humor, romance y autosuperación en uno de los mejores spokon de la historia. La mítica obra la protagoniza Hanamichi Sakuragi, un gamberrillo de instituto que descubre la pasión del baloncesto y acaba convirtiéndose en un gran jugador intentando ligarse a su compañera de clase Haruko Akagi. Ante él tendrá como obstáculos a su compañero de equipo, archirival y superjugador Kaede Rukawa, del cual Haruko está enamorada, al capitán del equipo Takenori, que es hermano de Haruko y a su mayor enemigo: su explosivo carácter. El memorable manga es obra de Takehiko Inoue, que muestra su pasión por el basket viñeta a viñeta, cuenta con el genial dibujo al que nos tiene acostumbrados y que se ha vuelto a demostrar con unas nuevas e increíbles ilustraciones de portada.\r\n'),
(62, 'Slam Dunk New Edition 15', 9.99, 5, 'manga', 'img/Mangas/slam15.webp', 'Presentamos Slam Dunk New Edition en formato B6! Esta nueva edición del manga cuenta con sólo 20 tomos, sobrecubiertas inéditas en splash y una cubierta interior con textura que simula una pelota de baloncesto. Humor, romance y autosuperación en uno de los mejores spokon de la historia. La mítica obra la protagoniza Hanamichi Sakuragi, un gamberrillo de instituto que descubre la pasión del baloncesto y acaba convirtiéndose en un gran jugador intentando ligarse a su compañera de clase Haruko Akagi. Ante él tendrá como obstáculos a su compañero de equipo, archirival y superjugador Kaede Rukawa, del cual Haruko está enamorada, al capitán del equipo Takenori, que es hermano de Haruko y a su mayor enemigo: su explosivo carácter. El memorable manga es obra de Takehiko Inoue, que muestra su pasión por el basket viñeta a viñeta, cuenta con el genial dibujo al que nos tiene acostumbrados y que se ha vuelto a demostrar con unas nuevas e increíbles ilustraciones de portada.'),
(63, 'MARVEL ESESENTIALS 42 SPIDERMAN: LA ÚLTIMA CACERÍA DE KRAVEN', 9.49, 6, 'comic', 'img/Comics/marvel42.webp', 'Contiene Web of Spider-Man 31 y 32, The Amazing Spider-Man 293 y 294 y Peter Parker, The Spectacular Spider-Man 131 y 132reativo compuesto por J. M. DeMatteis y Mike Zeck elaboran la historia definitiva de venganza, en esta revolucionaria e inigualable saga, considerada la mejor aventura moderna de Spiderman. Kraven El Cazador ha acechado y acabado con la vida de todos los animales conocidos por el hombre. Pero hay una bestia que se le resiste, una que se burló de él en cada encuentro: el superhéroe conocido como Spiderman. Ahora el tiempo de jugar ha terminado. Acabará con la araña, la enterrará y se convertirá en ella. Empieza la Última Cacería de Kraven.'),
(64, 'MILES MORALES: SPIDER-MAN. ORIGEN MUST HAVE', 10.42, 7, 'comic', 'img/Comics/mm1.webp', '¡Miles Morales toma el legado de Spiderman! Antes de la muerte de Peter Parker, el joven Miles Morales se disponía a empezar un nuevo capítulo de su vida en una brillante academia. Pero entonces la picadura de una araña le confirió extraordinarios poderes. Así comienza una de las más grandes sagas arácnidas del siglo XXI.\r\n'),
(65, 'Daredevil de Ed Brubaker y Michael Lark 2', 30.20, 6, 'comic', 'img/Comics/dd2.webp', 'Segundo y último volumen de la etapa de Brubaker y Lark en Daredevil. Matt Murdock intenta demostrar la inocencia de un condenado a muerte mientras surge una nueva amenaza: Lady Bullseye.\r\n'),
(66, 'SUPERGIRL: MUJER DEL MAÑANA 100% DC HC', 15.33, 15, 'comic', 'img/Comics/sp1.webp', 'El título que inspiró la película de James Gunn, una obra maestra en la que Tom King y Bilquis Evely redefinieron a Supergirl como nunca antes. Pese a las épicas aventuras que ha vivido a lo largo de los años, Kara Zor-El no encuentra sentido a su vida. ¿De qué le sirvió ver su planeta destruido y ser enviada a la Tierra a proteger a su pequeño primo? Allá donde va solo la ven con relación a Superman. Pero, justo cuando piensa que ha tenido suficiente, todo cambia. Una chica alienígena la busca. Su mundo ha sido destruido, y los responsables están libres. Quiere venganza, y si Supergirl no la ayuda, la buscará ella misma. Este viaje cambiará a la kryptoniana, a su perro y a la niña que, destrozada, arrastra a todos al espacio.'),
(67, 'Green Lantern:La noche más oscura.', 13.90, 20, 'comic', 'img/Comics/gg1.webp', 'La profecía se ha cumplido. El momento más esperado por unos y temido por otros al fin ha llegado: “La noche más oscura, del cielo caerá. La muerte de la luz, la oscuridad traerá…”. La historia que redefinió el universo Green Lantern está aquí, y ahora la muerte se cierne sobre nuestros héroes.'),
(68, 'La Muerte de Lobezno', 14.25, 7, 'comic', 'img/Comics/lobezno.webp', 'Contiene Death of Wolverine 1-4 El mayor acontecimiento en la historia de Lobezno! Logan ha pasado un siglo siendo el mejor en lo que hace, pero incluso los mejores acaban cayendo. A lo largo de los años, Logan ha sido un guerrero, un héroe, un renegado, un samurái, un profesor... y mucho más. Ahora, el más importante hombre-X será algo que nadie hubiera imaginado: un hombre muerto.\r\n');

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
(1, 'Admin', 'admin@papelverde.com', 'admin1234', 'img/perfiles/1781285053_admin.png', 1, 'Hombre', '2000-01-10', 'Calle de la Naturaleza, 14', 'España', '', 0, 0),
(3, 'Nath Garrido', 'nath@gmail.com', 'nath123', 'img/perfiles/1781096115_nath.jpg', 0, 'Mujer', '2006-10-25', 'Calle La chopera,14', 'España', '5555', 0, 0),
(5, 'Carlos Garrido', 'carlos@gmail.com', '$2y$12$Ej4rU0XkPJ6wJEnkbyfvp.nwmULT.jj0H1NBLdBqqf100JI5ct8LK', 'img/perfiles/1781342511_wp2273005-uncharted-4-a-thiefs-end-wallpapers.jpg', 0, 'Hombre', '1998-07-03', 'Calle de La Chopera,14', 'España', '12345678910152', 0, 0),
(8, 'He man', 'Heman@gmail.com', '$2y$12$YqrK0WIu7X8Kir2YbmDzBuSJ3fjzgBPHtt5Njx0YdQt560OfP1o4.', 'img/perfiles/1781444981_heman.jpg', 0, 'Hombre', '2026-06-03', 'Calle de Eternia , 1', 'Grayskol', '99999999999', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_producto` (`idUsuarios`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`idUsuarios`,`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

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
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD CONSTRAINT `carrito_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrito_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `comics_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`idUsuarios`) ON DELETE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE;

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
