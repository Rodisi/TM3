-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28-Maio-2015 às 14:30
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `marker`
--

INSERT INTO `marker` (`MarkerID`, `UserID`, `lat`, `lon`, `imagem`, `texto`, `markerLikes`, `titulo`) VALUES
(1, 1, '', '', 'images/polaroid.png', 'Quisque nec varius enim. Aliquam at elit nec erat ultrices commodo. Sed id ligula at ipsum interdum ornare. Aliquam gravida velit lorem, sit amet aliquet augue eleifend pellentesque. In pretium id lorem ut auctor. Maecenas non scelerisque massa, et commodo elit. Suspendisse in velit semper ipsum posuere sollicitudin sit amet ut lectus. Quisque at nulla et dolor porttitor tristique. Donec quam lacus, molestie et hendrerit at, ultrices eu orci. Mauris sed quam eget nunc elementum scelerisque id vel nisl. Curabitur congue enim non libero lobortis finibus. Mauris porttitor ante nec massa scelerisque ultrices. Pellentesque malesuada lorem neque, at dictum metus rhoncus quis. Morbi rutrum, sem laoreet tincidunt egestas, lorem metus auctor felis, sed maximus ipsum leo ac enim. Duis pulvinar, quam at iaculis auctor, ligula mauris auctor purus, quis egestas sem ex et erat. Mauris ac elit tortor.', 0, 'Lorem Ipsum'),
(2, 1, '48.873792', '2.295028', 'images/polaroid.png', 'Arco do Triunfo - Charles de Gaule', 0, 'Arco do Triumfo'),
(3, 1, '51.178882', '-1.826216', 'images/polaroid.png', 'Stonehenge - Rock it', 0, 'Stonehenge'),
(4, 1, '-20.2095307', '-67.5920104', 'images/flats.png', 'Bolivian Salt Flats - Mirror', 0, 'Salt Flats');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marker_rota`
--

CREATE TABLE IF NOT EXISTS `marker_rota` (
  `MarkerID` int(11) NOT NULL,
  `RotaID` int(11) NOT NULL,
  `posicao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `rota`
--

CREATE TABLE IF NOT EXISTS `rota` (
  `RotaID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `nlikes` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`RotaID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`UserID`, `Nome`, `email`, `Password`) VALUES
(1, 'Daniela', 'seky.dsbv@gmail.com', 'none'),
(2, 'Daniela Vieira', 'seky.dsbv@gmail.com', '1234');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
