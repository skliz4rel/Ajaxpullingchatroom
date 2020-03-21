-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2012 at 07:28 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teemarkchatroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminusers`
--

CREATE TABLE IF NOT EXISTS `adminusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(10) NOT NULL,
  `password` text NOT NULL,
  `department` char(20) NOT NULL,
  `status` char(20) NOT NULL,
  `picname` text,
  `picpath` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `adminusers`
--

INSERT INTO `adminusers` (`id`, `username`, `password`, `department`, `status`, `picname`, `picpath`) VALUES
(17, 'Femi', '9ce1d8392bbc71ba87d9be758e8ffc8a0f84068de7028970435656d1c5029769', 'Customer Care', 'offline', '18954images1.jpg', 'c:/wamp/www/Teemark chatroom/server/adminpics/18954images1.jpg'),
(18, 'jaido', '0424695f750805a49faa51fe201340cdd5417292e3782f35d01d2810fbabde24', 'Customer Care', 'offline', '5113images1.jpg', 'c:/wamp/www/Teemark chatroom/server/adminpics/5113images1.jpg'),
(19, 'damilola', '9c364bef9d1e5870fe2ccbea052fe178ad65ab6715ccdf1e26df5aa22cc33a85', 'Technical Support', 'offline', '25991bottom (2).jpg', 'c:/wamp/www/Teemark chatroom/server/adminpics/25991bottom (2).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` char(40) NOT NULL,
  `email` char(40) NOT NULL,
  `ipaddress` char(20) NOT NULL,
  `agent_department` char(30) DEFAULT NULL,
  `admin_id` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `username`, `email`, `ipaddress`, `agent_department`, `admin_id`) VALUES
(30, 'jaido', 'jaido@yahoo.com', '127.0.0.1', 'Customer Care', '18');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `chatuser` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `client_id`, `admin_id`, `message`, `chatuser`) VALUES
(64, 30, 18, 'hello', 'jaido'),
(65, 30, 18, 'hello', 'jaido'),
(66, 30, 18, 'how are you doing', 'jaido'),
(67, 30, 18, 'i am very fine', 'jaido'),
(68, 30, 18, 'asdfasdf', 'jaido'),
(69, 30, 18, 'ok', 'jaido'),
(70, 30, 18, 'what is your name', 'jaido');
