-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2012 at 04:44 PM
-- Server version: 5.1.58
-- PHP Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `cat_title` varchar(255) NOT NULL,
  `cat_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `cat_title`, `cat_url`) VALUES
(53, 52, 'тест', 'test'),
(52, 52, 'asd', 'asd'),
(51, 47, 'Новости', 'novosti'),
(47, 51, 'Спорт', 'sport'),
(41, 51, 'Новости 2', 'novosti-2');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Postedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `Description`, `Name`, `Postedon`) VALUES
(1, 169, 'Hello World comment also a hello world', 'Hari K T', '2009-08-27 09:33:05'),
(2, 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur,', 'Sarath Tomy', '2009-08-27 09:53:20'),
(3, 1, 'Contrary to popular belief, Lorem Ipsum is not simply random text. ', 'Sarath Tomy', '2009-08-27 09:53:47'),
(4, 1, 'My dummy comment', 'Dummy', '2009-08-27 11:53:25'),
(5, 1, 'My dummy comment', 'Dummy', '2009-08-27 11:54:05'),
(6, 1, 'Values are nice', 'Chris', '2009-08-27 11:55:30'),
(7, 1, 'Yes I am Mr Cool . ;)', 'Cool', '2009-08-27 12:09:26'),
(8, 1, 'Yes I am Mr Cool . ;)', 'Cool', '2009-08-27 12:15:59'),
(9, 1, 'Yes cool is my brother . But I am Mr cool not as cool as cool .', 'Mr Cool', '2009-08-27 12:20:26'),
(10, 1, 'Yes cool is my brother . But I am Mr cool not as cool as cool .', 'Mr Cool', '2009-08-27 12:21:18'),
(11, 1, 'Yes cool is my brother . But I am Mr cool not as cool as cool .', 'Mr Cool', '2009-08-27 12:22:38'),
(12, 1, 'Yes cool is my brother . But I am Mr cool not as cool as cool .', 'Mr Cool', '2009-08-27 12:23:50'),
(13, 1, 'Yes cool is my brother . But I am Mr cool not as cool as cool .\r\n\r\nNow I am rude ..', 'Mr Cool', '2009-08-27 12:24:35'),
(14, 1, 'Yes cool is my brother . But I am Mr cool not as cool as cool .\r\n\r\nNow I am rude ..\r\n\r\nFuck it man', 'Mr Cool', '2009-08-27 12:25:36'),
(15, 2, 'I am the first to post comments to this post .', 'Hari K T', '2009-08-27 12:38:08'),
(16, 2, 'I am simply Jack .', 'Jack', '2009-08-27 12:38:40'),
(17, 2, 'I am simply Jack .', 'Jack', '2009-08-27 12:40:03'),
(18, 3, 'Onam is a great and wonderful festival .', 'Sujith M S', '2009-08-27 12:40:43'),
(19, 4, 'I love X'' mas . We all get wonderful holidays in these days .', 'Ajith K D', '2009-08-27 12:41:43'),
(20, 3, 'Hello I am on leave for 2 days.\r\n\r\nThanks', 'Riyas K P', '2009-08-27 12:50:23'),
(21, 4, 'My Test', 'Your Name', '2009-08-27 12:59:25'),
(22, 5, 'Wow cool man . This is what I love.', 'Martin K Abraham', '2009-08-27 14:54:42'),
(23, 8, 'Lorem Ipsum is a dummy text .', 'Lorem Ipsum', '2009-08-28 06:15:19'),
(24, 7, 'We need dummy text :)', 'Hari K T', '2009-08-28 06:15:58'),
(25, 9, 'This is a great comment .\r\n\r\nI love this blog tutorial .\r\n\r\nThanks\r\n\r\nHari K T', 'Blogger', '2009-09-11 12:50:35'),
(26, 170, 'adsaddasd', '1', '2012-02-20 08:45:53'),
(27, 170, 'eee', '1', '2012-02-20 08:46:05'),
(28, 170, '45645', '1', '2012-02-20 08:50:24'),
(29, 170, 'hgjgjhgjh', '1', '2012-02-20 08:50:52'),
(30, 170, '1111', '1', '2012-02-20 12:03:13'),
(31, 169, 'adasd', '1', '2012-02-20 12:18:00'),
(32, 169, 'ddd', '1', '2012-02-20 12:20:50'),
(33, 169, 'dsd', '1', '2012-02-20 12:21:04'),
(34, 169, 'dsdsd', '1', '2012-02-20 12:21:25'),
(35, 169, 'dfdfdf', '1', '2012-02-20 12:21:42'),
(36, 169, 'fdfdf', '1', '2012-02-20 12:22:04'),
(37, 169, 'dsds', '1', '2012-02-20 12:22:23'),
(38, 169, 'ddd', '1', '2012-02-20 12:22:30'),
(39, 169, 'ddd', '1', '2012-02-20 12:23:23'),
(40, 169, 'asdasd', '1', '2012-02-20 12:28:06'),
(41, 170, 'sdsd', '1', '2012-02-20 12:28:47'),
(42, 168, 'ssss', '7', '2012-02-20 15:00:03'),
(43, 170, 'sdadasdasd', '1', '2012-02-20 18:46:27'),
(44, 171, 'sdsd', '1', '2012-02-20 19:46:08'),
(45, 171, 'sdsd', '1', '2012-02-20 19:47:08'),
(46, 171, 'sdsd', '1', '2012-02-20 20:08:01'),
(47, 175, 'ывывывывыв', '1', '2012-02-20 20:17:38'),
(48, 175, 'aa', '1', '2012-02-28 14:21:01');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `full_text` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `category` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=176 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `full_text`, `url`, `is_active`, `category`, `user`, `date`) VALUES
(168, 'Запись1', 'Траливалвалвла', 'zapis1', 1, '51', 1, '2012-02-17 13:50:10'),
(170, 'Запись 2', 'записьзапись запись запись запись запись запись запись запись запись запись запись запись', 'zapis-2', 0, '51', 1, '2012-02-20 21:36:21'),
(169, 'Запись 123', 'Трали вали', 'zapis-123', 1, '51', 1, '2012-02-17 13:50:14'),
(171, 'test123111', 'tstst', 'test', 1, '51', 1, '2012-02-20 22:04:37'),
(172, 'dwdwd', 'dwdwd', 'dwdwd', 1, '47', 1, '2012-02-20 21:44:43'),
(173, 'aa', 'aa', 'aa', 1, '41', 1, '2012-02-20 22:05:34'),
(174, '1', '', '1', 1, '47', 1, '2012-02-20 22:06:10'),
(175, 'new', 'sadasd', 'new', 1, '53', 1, '2012-03-02 16:15:36');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
(1, 'Teg1'),
(2, '2eg2'),
(15, 'set'),
(16, 'set1'),
(17, 'test1'),
(18, ' test2'),
(19, ' test 3'),
(20, ' test 5'),
(21, 'test1 test2'),
(22, ' test4'),
(23, ' t4st'),
(24, 'testA'),
(25, 'TestB'),
(26, 'r'),
(27, 't'),
(28, 'arr'),
(29, 'app'),
(30, 'yyy'),
(31, 'kkk'),
(32, 'iii'),
(33, 'oooo'),
(34, 'Пк'),
(35, 'Зубры'),
(36, 'Футбол'),
(37, 'rrr'),
(38, '1'),
(39, '2'),
(40, ''),
(41, 'Дети'),
(42, '11'),
(43, '3'),
(44, 'qq'),
(45, 'tt'),
(46, 'tttttt'),
(47, 'запись'),
(48, 'новости'),
(49, 'test'),
(50, 'wdwd'),
(51, 'a'),
(52, 'aa');

-- --------------------------------------------------------

--
-- Table structure for table `tag_post`
--

CREATE TABLE IF NOT EXISTS `tag_post` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tag_post`
--

INSERT INTO `tag_post` (`post_id`, `tag_id`) VALUES
(171, 49),
(166, 31),
(13, 1),
(13, 2),
(166, 32),
(170, 48),
(170, 47),
(169, 44),
(168, 43),
(168, 39),
(168, 38),
(168, 36),
(169, 45),
(169, 46),
(167, 31),
(167, 32),
(167, 33),
(168, 35),
(172, 50),
(173, 51),
(174, 38),
(175, 52);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET latin1 NOT NULL,
  `password` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) CHARACTER SET latin1 NOT NULL,
  `date_created` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `role`, `date_created`) VALUES
(7, 'sergiy', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'ss@mail.ru', 'blogger', '2012-02-20'),
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@mail.ru', 'admin', '2012-02-20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
