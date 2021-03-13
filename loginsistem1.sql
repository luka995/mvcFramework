-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 18, 2020 at 09:07 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginsistem1`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_user_uid` varchar(128) NOT NULL,
  `date` datetime NOT NULL,
  `message` varchar(256) NOT NULL,
  PRIMARY KEY (`comment_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=689 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_uid` varchar(256) NOT NULL,
  `user_pwd` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`) VALUES
(1, 'vladica', 'vladic', 'vlada1@gmail.com', 'vladica', '$2y$10$0tjyPNDXBwsh76uWdVsiRu605kjFib9O3OvtoFA4QTjMx649PCqN.'),
(2, 'vladica', 'vladic', 'vlada1@gmail.com', 'vlada1', '$2y$10$8ePlLM9OGgycqVH4DUski.oRVSJXgo5Hj/SuWB.k0jk6NjgPK723m'),
(3, 'myke', 'myller', 'myke@gmail.com', 'myke', '$2y$10$ySmCpsVVGgXbatwpToTg9OQW2ijl9K5BfdiAxDeekfieUumyzyVyu'),
(4, 'mile', 'milic', 'milic@gmail.com', 'mile', '$2y$10$bMv/sem/w9g.SAipaWWJQehzckxjjbIiLkK160jAU/pxB2VYVcBcO'),
(5, 'pol', 'jan', 'pol@gmail.com', 'pol', '$2y$10$BuW.E7HqnmXFdg4WhFEsbO9vF3K11MaNmRQaOCQU698EWELy3lDmq'),
(6, 'mile', 'milet', 'milet@gmail.com', 'milemile', '$2y$10$Mq.ZOEV1RfNcv713bXRco.ijgUgmEpaDiAUjB9GqMUGUGlh.42bky'),
(7, 'jovica', 'jovic', 'jovic@gmail.com', 'jovica', '$2y$10$oLnqUtNEgaU7JAv6Xp4WB.hdH2yYuwr22z5QQcdMGqaNYUF7jhOwq'),
(8, 'Mitar', 'Miric', 'm@gmail.com', 'mitar', '$2y$10$ofytsCDzwCdlpC7zKhDJS.1a0b7r/t7ULuFqbmZw7KAL9/M3YVnia'),
(9, 'taki', 'takic', 'taki1@gmail.com', 'taki', '$2y$10$Pvuu/lU48TJmfV8sg/lVieZpeZYD3LWJBeT78ssBryvJrAzpEy/Di'),
(10, 'Tim', 'Timic', 'tim@gmail.com', 'tim', '$2y$10$sCsuI8xr6v8TM0BoY/QjQ.3iqNzha2zJPxhVNXzajIn9t6ELbTCd.'),
(11, 'lola', 'loth', 'lola@gmail.com', 'lola', '$2y$10$lxo7...IZheD4.wPcf9yweyNnsLkfjCLLpyR1QLMXVk0JfbfyLoYW');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
