-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2015 at 01:05 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`id`, `factory`, `phone`, `deleted`) VALUES
(1, 'Bosch', '0411-454647', 0),
(2, 'Black & Dekker', '0909-0538', 0),
(3, 'Precision', '0800-0909', 0),
(4, 'Einhell', '5645689', 0),
(5, 'KÃ¤rchen', '564645', 0),
(6, 'KÃ¤rchen', '564645', 1),
(7, 'Worx', '435345', 0),
(8, 'Sencys', '234234234', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location`, `deleted`, `description`) VALUES
(1, 'Rotterdam', 0, 'Onze prachtlocatie aan de haven is mooi '),
(2, 'Almere', 0, 'Onze prachtlocatie in Almere is mooi '),
(3, 'Eindhoven', 0, 'EINDHOVEEE! EINDHOVEEEEE! EINDHOVEEEEEEE!'),
(4, 'Vissers', 1, ''),
(5, 'Errup', 1, ''),
(6, 'Veghel', 0, 'Center of the universe '),
(7, 'EINDHUVENKVLEJDSFLDSF', 1, 'sdfdsfdsf'),
(8, 'Test', 1, 'test');

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
  `minimum_stock` int(11) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `eerste` (`factory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `type`, `factory_id`, `buy_price`, `sell_price`, `minimum_stock`, `deleted`) VALUES
(1, 'Boormachine', 'XM-1022', 2, '40.00', '60.00', 10, 0),
(2, 'Hamer', 'MX-2011', 2, '15.00', '70.00', 25, 0),
(3, 'Schroevendraaier', '2020-MM', 1, '23.00', '55.00', 15, 1),
(46, 'dfs', 'jkhjk', 1, '131.00', '123.00', 10, 1),
(47, 'ddsfds', 'sdf', 2, '12.00', '13.00', 10, 1),
(48, 'dfg', 'dfg', 1, '12.00', '13.00', 0, 1),
(49, '4-in-1 schuurmachine', 'KA 280 K', 2, '55.95', '67.95', 15, 0),
(50, 'Verstekzaag', 'BT-MS-2112', 4, '49.95', '67.49', 2, 0),
(51, 'Alleszuiger', 'WD2.200', 5, '29.95', '47.96', 4, 0),
(52, 'Accu Voorhamer', 'WX 382', 7, '69.95', '111.75', 11, 0),
(53, 'Accuboormachine', 'PSR 14.4', 1, '59.95', '68.00', 12, 0),
(54, '33 delige borenset', '', 8, '9.95', '15.20', 54, 0),
(55, 'workmate', 'WM 536', 2, '49.95', '63.20', 14, 0),
(56, 'Kruislijnlasserset', 'PCL 20', 1, '99.95', '122.40', 11, 0);

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
(3, 'Buitendienst', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(1, 46, 0),
(2, 46, 0),
(3, 46, 0),
(6, 46, 0),
(1, 1, 50),
(1, 2, 50),
(1, 3, 25),
(1, 47, 0),
(2, 47, 0),
(3, 47, 0),
(6, 47, 0),
(1, 48, 0),
(2, 48, 0),
(3, 48, 0),
(6, 48, 0),
(1, 49, 0),
(2, 49, 0),
(3, 49, 0),
(6, 49, 15),
(1, 50, 0),
(2, 50, 0),
(3, 50, 0),
(6, 50, 2),
(1, 51, 0),
(2, 51, 0),
(3, 51, 0),
(6, 51, 4),
(1, 52, 0),
(2, 52, 0),
(3, 52, 0),
(6, 52, 11),
(1, 53, 0),
(2, 53, 0),
(3, 53, 0),
(6, 53, 12),
(1, 54, 0),
(2, 54, 0),
(3, 54, 0),
(6, 54, 54),
(1, 55, 0),
(2, 55, 0),
(3, 55, 0),
(6, 55, 14),
(1, 56, 0),
(2, 56, 0),
(3, 56, 0),
(6, 56, 11);

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
(1, 1, 'J.P.J.L.', 'de', 'Man', 'Jorie', '3c649185ca41b2c53060c8266b0845206b4ab363', 0),
(2, 3, 'R', '', 'Vissers', 'Ruud', '3c649185ca41b2c53060c8266b0845206b4ab363', 0);

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
