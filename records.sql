-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 02, 2014 at 12:25 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE IF NOT EXISTS `records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `user_hash` longtext NOT NULL,
  `password` longtext NOT NULL,
  `name` varchar(64) NOT NULL,
  `roll` varchar(30) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone` bigint(40) NOT NULL,
  `blood_group` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `username`, `user_hash`, `password`, `name`, `roll`, `age`, `email`, `phone`, `blood_group`) VALUES
(1, 'anubhav.cs12', '58c4db81be819fba5b5e08b1ae4e314da611f594', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'ANUBHAV', '1201CS03', 18, 'anubhav.cs12@iitp.ac.in', 8084257108, 'O+');
