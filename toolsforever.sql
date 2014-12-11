-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2014 at 11:38 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `toolsforever`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `last_activity` varchar(255) NOT NULL,
  `user_data` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('a0ba57b123c8d5bbd4bd269eea75eae4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1417717572', 'a:1:{s:9:"user_data";s:0:"";}'),
('467a0ed924735b00b84c03abdc13442d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1417725018', ''),
('26de64d35fb8faa83dc0f288927f6711', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36', '1417766788', '');

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE IF NOT EXISTS `factories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `factory` varchar(32) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`id`, `factory`, `phone`, `deleted`) VALUES
(1, 'Bosch', '0411-454647', 0),
(2, 'Black & Dekker', '0909-0538', 0),
(3, 'Precision', '0800-0909', 0),
(4, 'Ruud Fabriekske', '0909-0807', 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(32) NOT NULL,
  `deleted` int(1) DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `deleted`, `description`) VALUES
(1, 'Rotterdam', 0, 'Onze prachtlocatie aan de haven is mooi '),
(2, 'Almere', 0, 'Onze prachtlocatie in Almere is mooi '),
(3, 'Eindhoven', 0, 'EINDHOVEE!!! EINDHOVEEEEE!!!! EEINNDHDOOOVEEEEEEE!!! errup EEEINDHOVOVEEEEEEEEEE!'),
(4, 'Vissers', 1, ''),
(5, 'Errup', 1, ''),
(6, 'Erruuupppp', 0, 'Center of the universe'),
(7, 'Veghel', 0, 'tja, hier wil je niet wonen. Of misschien toch wel?');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(32) NOT NULL,
  `type` varchar(32) DEFAULT NULL,
  `factory_id` int(11) NOT NULL,
  `buy_price` decimal(11,2) NOT NULL,
  `sell_price` decimal(11,2) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `minimum_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eerste` (`factory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `type`, `factory_id`, `buy_price`, `sell_price`, `deleted`, `minimum_stock`) VALUES
(8, 'Boormachine', 'GH-2011', 1, '40.00', '50.00', 0, 5),
(9, 'Boormachine', 'GH-2011', 1, '40.00', '50.00', 1, 5),
(10, 'Boormachine', 'GH-2011', 1, '40.00', '50.00', 1, 5),
(11, 'Spijkerpistool', 'HG90-90', 3, '40.00', '79.00', 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `deleted` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created`, `updated`, `deleted`) VALUES
(1, 'Development', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Directie', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Gebruiker', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `location_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL,
  KEY `tweede` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`location_id`, `product_id`, `amount`) VALUES
(1, 2, 50),
(3, 3, 46),
(2, 3, 12),
(2, 2, 50),
(3, 1, 666),
(1, 8, 4),
(2, 8, 22),
(3, 8, 2),
(6, 8, 55),
(1, 9, 0),
(2, 9, 0),
(3, 9, 0),
(6, 9, 0),
(1, 10, 0),
(2, 10, 0),
(3, 10, 0),
(6, 10, 0),
(1, 11, 555),
(2, 11, 11),
(3, 11, 2),
(6, 11, 3),
(1, 12, 0),
(2, 12, 0),
(3, 12, 0),
(6, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `initials` varchar(32) NOT NULL,
  `prefix` varchar(32) DEFAULT NULL,
  `last_name` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `deleted` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `initials`, `prefix`, `last_name`, `username`, `password`, `deleted`) VALUES
(1, 1, 'J', 'De', 'Man', 'Jorie', '3c649185ca41b2c53060c8266b0845206b4ab363', 0),
(2, 1, 'R', '', 'Vissers', 'Ruud', '4317b620a5cdb210fb92123281588ec4b30a74e7', 0),
(3, 0, '', '', '', '', '2356e59638c3bc00ed8b72d433dbf0b7ecedc536', 0),
(4, 1, 'test', 'ge', 'bruikerts', 'testgebruiker', '38905a016f394a3f5090b5ed665c12ebbe3ba619', 0),
(5, 2, 'tester', 'tester', 'tester', 'Tester', 'ab4d8d2a5f480a137067da17100271cd176607a1', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`factory_id`) REFERENCES `factories` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
