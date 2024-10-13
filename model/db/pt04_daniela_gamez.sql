-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-10-2024 a las 21:40:32
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
-- Base de datos: `pt04_daniela_gamez`
--
CREATE DATABASE IF NOT EXISTS `pt04_daniela_gamez` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt04_daniela_gamez`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titol` varchar(45) NOT NULL,
  `cos` varchar(2504) NOT NULL,
  `data_creacio` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_modificacio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `autor` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `articles`:
--   `autor`
--       `usuaris` -> `id`
--

--
-- Truncar tablas antes de insertar `articles`
--

TRUNCATE TABLE `articles`;
--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `titol`, `cos`, `data_creacio`, `data_modificacio`, `autor`) VALUES
(1, 'La Revolución de las Estrellas', 'Exploramos cómo las estrellas guían la navegación estelar y su impacto en la tecnología moderna.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 2),
(2, 'La Magia de los Hologramas', 'Descubre la ciencia detrás de los hologramas y cómo cambiarán nuestra forma de comunicarnos.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 2),
(3, 'El Misterio del Tiempo', 'Un artículo sobre los últimos descubrimientos científicos acerca de la relatividad del tiempo y sus efectos.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 3),
(4, 'Inteligencia Artificial: Futuro y Retos', 'Una discusión sobre los beneficios y riesgos de la inteligencia artificial en nuestra sociedad actual.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 4),
(5, 'El Arte del Diseño Minimalista', 'El minimalismo en el diseño ha marcado tendencia en los últimos años, simplificando la estética visual.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 5),
(6, 'La Evolución de los Videojuegos', 'Desde los primeros juegos de arcade hasta los complejos mundos virtuales de hoy en día, los videojuegos han cambiado radicalmente. La industria del entretenimiento ha adoptado la tecnología de manera innovadora, permitiendo experiencias más inmersivas. Además, los videojuegos no solo son entretenimiento, sino que también son una herramienta educativa, con aplicaciones en campos como la medicina y la formación militar.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 4),
(7, 'Los Secretos del Océano Profundo', 'El océano profundo sigue siendo uno de los misterios más grandes de la Tierra. A pesar de los avances en la tecnología de exploración submarina, gran parte de este vasto ecosistema sigue inexplorado. Los científicos creen que podría haber especies completamente nuevas viviendo en sus profundidades, adaptadas a la vida en condiciones extremas. Además, estudiar estos entornos podría ayudarnos a comprender mejor los límites de la vida en la Tierra.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 2),
(8, 'Los Drones y su Impacto', 'Los drones están revolucionando la logística.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 3),
(9, 'El Auge de la Realidad Aumentada', 'La realidad aumentada (RA) está revolucionando la forma en que interactuamos con el mundo digital. A diferencia de la realidad virtual, que crea un entorno completamente artificial, la RA superpone información digital sobre el mundo real, ofreciendo experiencias interactivas. Desde el entretenimiento hasta la educación, la RA tiene el potencial de transformar una variedad de industrias.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 4),
(10, 'El Futuro del Transporte: Coches Autónomos', 'Los coches autónomos ya no son una visión futurista, sino una realidad en desarrollo. Empresas de tecnología y automovilísticas están invirtiendo miles de millones en el perfeccionamiento de estos vehículos, con la promesa de mejorar la seguridad y reducir el tráfico. No obstante, aún quedan preguntas sobre la regulación, la ética y la confianza del público en estos sistemas.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 5),
(11, 'El Misterio de los Agujeros Negros', 'Los agujeros negros son uno de los fenómenos más enigmáticos del universo. Su inmensa gravedad atrapa incluso la luz, haciendo imposible ver lo que sucede en su interior. Los científicos creen que en su centro podría haber una singularidad, un punto de densidad infinita donde las leyes de la física tal como las conocemos dejan de aplicarse. Estudiar estos objetos cósmicos podría revelar claves importantes sobre el origen y el destino del universo.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 3),
(12, 'Nanotecnología: Un Mundo Invisible', 'La nanotecnología está revolucionando campos como la medicina y la electrónica, permitiendo avances a nivel microscópico. Desde el desarrollo de nuevos materiales hasta la creación de tratamientos médicos altamente específicos, esta tecnología promete cambiar el futuro de la humanidad. Sin embargo, su desarrollo plantea preguntas éticas y desafíos de regulación.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 2),
(13, 'Las Bases de la Programación Funcional', 'La programación funcional simplifica el código.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 3),
(14, 'Colonización de Marte', 'El sueño de colonizar Marte está más cerca de convertirse en realidad gracias a avances como el cohete Starship de SpaceX. Sin embargo, la idea de establecer una colonia en el planeta rojo plantea numerosos desafíos. Desde la radiación espacial hasta la falta de agua líquida, los futuros colonos necesitarán soluciones tecnológicas innovadoras para sobrevivir en un entorno tan hostil. Aun así, la humanidad parece decidida a expandir sus fronteras más allá de la Tierra.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 4),
(15, 'Realidad Virtual en la Educación', 'La realidad virtual (RV) está abriendo nuevas posibilidades en el ámbito educativo, proporcionando a los estudiantes experiencias de aprendizaje inmersivas. Imagina estudiar historia mientras caminas por una recreación del antiguo Egipto, o aprender anatomía explorando el cuerpo humano en 3D. Esta tecnología tiene el potencial de cambiar radicalmente la forma en que aprendemos, haciendo que el conocimiento sea más accesible y atractivo para todos.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 5),
(16, 'Razones por las que deberia aprobar', 'Ta guapa la pagina, verdad?.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 5),
(17, 'Robótica en la Industria Moderna', 'La robótica ha transformado el sector industrial, permitiendo una automatización avanzada en procesos de manufactura. Gracias a los robots, se ha logrado incrementar la eficiencia y reducir los costos operativos, además de mejorar la seguridad en el lugar de trabajo. Los robots colaborativos o \"cobots\" están diseñados para trabajar junto con humanos, abriendo nuevas posibilidades en el campo de la producción y la logística.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 2),
(18, 'Los Secretos del ADN', 'El ADN es el manual de instrucciones de la vida.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 3),
(19, 'La Impresión 3D en la Arquitectura', 'La impresión 3D está comenzando a revolucionar la forma en que construimos edificios. Esta tecnología permite la creación de estructuras más rápidas, baratas y sostenibles que los métodos tradicionales. Además, está facilitando el diseño de formas arquitectónicas complejas que antes eran imposibles de realizar. Aunque todavía en sus primeras etapas, la impresión 3D promete transformar radicalmente la industria de la construcción en las próximas décadas.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 4),
(20, 'El Futuro de la Agricultura con IA', 'La inteligencia artificial está siendo aplicada en la agricultura para optimizar el uso de recursos como el agua y los fertilizantes. Con drones y sensores, los agricultores pueden monitorear sus cultivos de manera más eficiente, lo que reduce costos y aumenta la productividad. Además, la IA está ayudando a predecir plagas y enfermedades, lo que permite tomar decisiones más informadas y mejorar la calidad de los alimentos que consumimos.', '2024-10-13 17:56:20', '2024-10-13 17:56:20', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE `usuaris` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(254) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELACIONES PARA LA TABLA `usuaris`:
--

--
-- Truncar tablas antes de insertar `usuaris`
--

TRUNCATE TABLE `usuaris`;
--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `usuario`, `email`, `pass`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$10$ilxLGStxXHzSyDlCl4tj2O9dRcvX9vKG2.zuU2ekJwp4tkxYKXZCq'),
(2, 'roger_51', '4hogrlwp4@talk21.com', '$2y$10$hJ5Vz8XeYuSfBfbOihK95.jkcSDeI1FX4ECIj3Y5IBUTwOsNfBzaW'),
(3, 'luisangel_72', 'ivl77yaca@lycos.es', '$2y$10$TO3VRIrEOBFVnshlgG0oYOzfdZFMJ9A1OjnpQ7tIeBLeU1CYshZCS'),
(4, 'martin_71', '47vjms9v@talk21.com', '$2y$10$R2aFxfkatEfZn3.Z3hsRJeDlaZWb6syKgfDK/04R1LqT3SwDnmYqO'),
(5, 'anaisabel_82', '661y5fmif@witty.com', '$2y$10$tW6cDQgrP2zI3xxeVpbxj.4S.s/7eb.kHeJ0nGSpwQzQEcv4EGJRu'),
(6, 'ariadna_82', 'qp31jzyc3r@aol.com', '$2y$10$JlmbnTbgibv43CU15geRsOYm9IlD7RoDaVLHWy6E.gqQax63RZZ6a');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_articles_usuaris` (`autor`);

--
-- Indices de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_usuaris_usuario_email` (`usuario`,`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `fk_articles_usuaris` FOREIGN KEY (`autor`) REFERENCES `usuaris` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
