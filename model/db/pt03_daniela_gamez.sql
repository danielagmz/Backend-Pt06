-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-09-2024 a las 16:37:14
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
-- Base de datos: `pt02_daniela_gamez`
--
CREATE DATABASE IF NOT EXISTS `pt03_daniela_gamez` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt03_daniela_gamez`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titol` varchar(45) NOT NULL,
  `cos` varchar(2504) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `titol`, `cos`) VALUES
(1, 'La Revolución de las Estrellas', 'Exploramos cómo las estrellas guían la navegación estelar y su impacto en la tecnología moderna.'),
(2, 'La Magia de los Hologramas', 'Descubre la ciencia detrás de los hologramas y cómo cambiarán nuestra forma de comunicarnos.'),
(3, 'El Misterio del Tiempo', 'Un artículo sobre los últimos descubrimientos científicos acerca de la relatividad del tiempo y sus efectos.'),
(4, 'Inteligencia Artificial: Futuro y Retos', 'Una discusión sobre los beneficios y riesgos de la inteligencia artificial en nuestra sociedad actual.'),
(5, 'El Arte del Diseño Minimalista', 'El minimalismo en el diseño ha marcado tendencia en los últimos años, simplificando la estética visual.'),
(6, 'La Evolución de los Videojuegos', 'Desde los primeros juegos de arcade hasta los complejos mundos virtuales de hoy en día, los videojuegos han cambiado radicalmente. La industria del entretenimiento ha adoptado la tecnología de manera innovadora, permitiendo experiencias más inmersivas. Además, los videojuegos no solo son entretenimiento, sino que también son una herramienta educativa, con aplicaciones en campos como la medicina y la formación militar.'),
(7, 'Los Secretos del Océano Profundo', 'El océano profundo sigue siendo uno de los misterios más grandes de la Tierra. A pesar de los avances en la tecnología de exploración submarina, gran parte de este vasto ecosistema sigue inexplorado. Los científicos creen que podría haber especies completamente nuevas viviendo en sus profundidades, adaptadas a la vida en condiciones extremas. Además, estudiar estos entornos podría ayudarnos a comprender mejor los límites de la vida en la Tierra.'),
(8, 'Los Drones y su Impacto', 'Los drones están revolucionando la logística.'),
(9, 'El Auge de la Realidad Aumentada', 'La realidad aumentada (RA) está revolucionando la forma en que interactuamos con el mundo digital. A diferencia de la realidad virtual, que crea un entorno completamente artificial, la RA superpone información digital sobre el mundo real, ofreciendo experiencias interactivas. Desde el entretenimiento hasta la educación, la RA tiene el potencial de transformar una variedad de industrias.'),
(10, 'El Futuro del Transporte: Coches Autónomos', 'Los coches autónomos ya no son una visión futurista, sino una realidad en desarrollo. Empresas de tecnología y automovilísticas están invirtiendo miles de millones en el perfeccionamiento de estos vehículos, con la promesa de mejorar la seguridad y reducir el tráfico. No obstante, aún quedan preguntas sobre la regulación, la ética y la confianza del público en estos sistemas.'),
(11, 'El Misterio de los Agujeros Negros', 'Los agujeros negros son uno de los fenómenos más enigmáticos del universo. Su inmensa gravedad atrapa incluso la luz, haciendo imposible ver lo que sucede en su interior. Los científicos creen que en su centro podría haber una singularidad, un punto de densidad infinita donde las leyes de la física tal como las conocemos dejan de aplicarse. Estudiar estos objetos cósmicos podría revelar claves importantes sobre el origen y el destino del universo.'),
(12, 'Nanotecnología: Un Mundo Invisible', 'La nanotecnología está revolucionando campos como la medicina y la electrónica, permitiendo avances a nivel microscópico. Desde el desarrollo de nuevos materiales hasta la creación de tratamientos médicos altamente específicos, esta tecnología promete cambiar el futuro de la humanidad. Sin embargo, su desarrollo plantea preguntas éticas y desafíos de regulación.'),
(13, 'Las Bases de la Programación Funcional', 'La programación funcional simplifica el código.'),
(14, 'Colonización de Marte', 'El sueño de colonizar Marte está más cerca de convertirse en realidad gracias a avances como el cohete Starship de SpaceX. Sin embargo, la idea de establecer una colonia en el planeta rojo plantea numerosos desafíos. Desde la radiación espacial hasta la falta de agua líquida, los futuros colonos necesitarán soluciones tecnológicas innovadoras para sobrevivir en un entorno tan hostil. Aun así, la humanidad parece decidida a expandir sus fronteras más allá de la Tierra.'),
(15, 'Realidad Virtual en la Educación', 'La realidad virtual (RV) está abriendo nuevas posibilidades en el ámbito educativo, proporcionando a los estudiantes experiencias de aprendizaje inmersivas. Imagina estudiar historia mientras caminas por una recreación del antiguo Egipto, o aprender anatomía explorando el cuerpo humano en 3D. Esta tecnología tiene el potencial de cambiar radicalmente la forma en que aprendemos, haciendo que el conocimiento sea más accesible y atractivo para todos.'),
(16, 'Razones por las que deberia aprobar', 'Ta guapa la pagina, verdad?.'),
(17, 'Robótica en la Industria Moderna', 'La robótica ha transformado el sector industrial, permitiendo una automatización avanzada en procesos de manufactura. Gracias a los robots, se ha logrado incrementar la eficiencia y reducir los costos operativos, además de mejorar la seguridad en el lugar de trabajo. Los robots colaborativos o "cobots" están diseñados para trabajar junto con humanos, abriendo nuevas posibilidades en el campo de la producción y la logística.'),
(18, 'Los Secretos del ADN', 'El ADN es el manual de instrucciones de la vida.'),
(19, 'La Impresión 3D en la Arquitectura', 'La impresión 3D está comenzando a revolucionar la forma en que construimos edificios. Esta tecnología permite la creación de estructuras más rápidas, baratas y sostenibles que los métodos tradicionales. Además, está facilitando el diseño de formas arquitectónicas complejas que antes eran imposibles de realizar. Aunque todavía en sus primeras etapas, la impresión 3D promete transformar radicalmente la industria de la construcción en las próximas décadas.'),
(20, 'El Futuro de la Agricultura con IA', 'La inteligencia artificial está siendo aplicada en la agricultura para optimizar el uso de recursos como el agua y los fertilizantes. Con drones y sensores, los agricultores pueden monitorear sus cultivos de manera más eficiente, lo que reduce costos y aumenta la productividad. Además, la IA está ayudando a predecir plagas y enfermedades, lo que permite tomar decisiones más informadas y mejorar la calidad de los alimentos que consumimos.');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
