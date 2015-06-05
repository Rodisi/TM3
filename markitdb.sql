-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 05-Jun-2015 às 11:22
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `markitdb`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `marker`
--

CREATE TABLE IF NOT EXISTS `marker` (
  `MarkerID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `lat` varchar(255) NOT NULL DEFAULT '',
  `lon` varchar(255) NOT NULL DEFAULT '',
  `imagem` varchar(255) NOT NULL DEFAULT 'images/polaroid.png',
  `texto` text NOT NULL,
  `markerLikes` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(255) NOT NULL,
  PRIMARY KEY (`MarkerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `marker`
--

INSERT INTO `marker` (`MarkerID`, `UserID`, `lat`, `lon`, `imagem`, `texto`, `markerLikes`, `titulo`) VALUES
(2, 1, '48.873792', '2.295028', 'images/polaroid.png', 'Arco do Triunfo - Charles de Gaule', 0, 'Arco do Triumfo'),
(3, 1, '51.178882', '-1.826216', 'images/polaroid.png', 'Stonehenge - Rock it', 0, 'Stonehenge'),
(4, 1, '-20.2095307', '-67.5920104', 'images/flats.png', 'Bolivian Salt Flats - Mirror', 0, 'Salt Flats'),
(5, 1, '48.85837', '2.294481', 'images/eiffel.jpg', 'AWEEEEEEE', 0, 'Torre Eiffel'),
(7, 1, '38.75313949701864', '-9.202594757080078', 'images/1011176_10151521963473506_959555969_n.png', 'Ena pa bueda fixe', 0, 'isto eh um titulo'),
(8, 3, '38.7591700932071', '-9.229888916015625', 'images/IMG_20140706_112105.jpg', 'Estou a testar marcadores', 0, 'Marker Test'),
(15, 1, '38.61111960943566', '-9.129619896411896', 'images/IMG_20140703_193257.jpg', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sed elit eu augue tempor pharetra. Proin nec venenatis metus. Maecenas risus magna, efficitur ac mauris quis, convallis hendrerit sapien. Phasellus vel dolor sagittis, semper libero vel, ornare risus. In non eros ornare sapien lacinia congue. Quisque eleifend porttitor purus, non tincidunt enim ornare eu. Suspendisse in pharetra est. Aenean sed malesuada augue.  Aliquam ut turpis eget est imperdiet efficitur at ut est. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus ac augue quis ex sodales pharetra. Cras ipsum orci, tempor sit amet velit eu, interdum aliquam tortor. Morbi consequat dignissim turpis id pretium. Nulla quis bibendum ante. Donec at lacus vitae libero blandit tincidunt ac non nisl. Ut fermentum, tellus vel venenatis malesuada, nibh sapien dignissim massa, ac tempus tortor ipsum at ligula. Morbi mi turpis, sollicitudin at lectus ut, iaculis mollis odio. Curabitur elementum elit quis magna gravida finibus. In tristique scelerisque sapien vitae viverra. Praesent sodales nibh lorem, eu ornare eros fringilla et. ', 0, 'Lorem Ipsum'),
(16, 5, '38.60607256141475', '-9.129552841186523', 'images/IMG_20140703_193303.jpg', 'ajshdiaaysfasdasdtsydadasudasdsdda', 0, 'Olha um marcador'),
(17, 7, '-33.87519018812205', '151.1752223968506', 'images/IMG_20140703_193252.jpg', 'Ena pa bueda fixe', 0, 'Isto Ã© um titulo'),
(18, 7, '-33.86435779106245', '151.1396026611328', 'images/IMG_20140706_015010.jpg', 'Outra historia', 0, 'Outro marcador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marker_rota`
--

CREATE TABLE IF NOT EXISTS `marker_rota` (
  `MarkerID` int(11) NOT NULL,
  `RotaID` int(11) NOT NULL,
  `posicao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marker_rota`
--

INSERT INTO `marker_rota` (`MarkerID`, `RotaID`, `posicao`) VALUES
(2, 1, 1),
(5, 1, 1),
(2, 17, 0),
(5, 17, 0),
(2, 18, 0),
(5, 18, 0),
(2, 19, 0),
(5, 19, 0),
(6, 19, 0),
(3, 19, 0),
(4, 19, 0),
(2, 19, 0),
(15, 20, 0),
(7, 20, 0),
(18, 21, 0),
(17, 21, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `rota`
--

CREATE TABLE IF NOT EXISTS `rota` (
  `RotaID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `nlikes` int(11) NOT NULL DEFAULT '0',
  `titulo_rota` varchar(100) NOT NULL DEFAULT 'sem titulo',
  PRIMARY KEY (`RotaID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `rota`
--

INSERT INTO `rota` (`RotaID`, `UserID`, `nlikes`, `titulo_rota`) VALUES
(17, 1, 0, 'olha aqui'),
(18, 1, 0, 'Titulo da Rota'),
(19, 1, 0, 'Teste1'),
(20, 1, 0, 'Casa - Universidade'),
(21, 7, 0, 'Titulo de rota');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `Password` varchar(100) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`UserID`, `Nome`, `email`, `Password`) VALUES
(1, 'Daniela', 'seky.dsbv@gmail.com', 'none'),
(3, 'Tester', 'teste@europeia.pt', '1234'),
(4, 'Teste2', 'testee@ue.pt', 'bla'),
(5, 'são', 'so@gmail.com', '123'),
(7, 'bla', 'eu@europeia.pt', '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
