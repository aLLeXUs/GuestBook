-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 19 2016 г., 17:04
-- Версия сервера: 5.5.45
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `subject` varchar(50) NOT NULL,
  `text` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `date`, `subject`, `text`) VALUES
(19, 1, '2016-04-19 12:47:40', 'dscdcs1111111', 'sdcsdc'),
(20, 1, '2016-04-19 12:52:24', 'test', 'test'),
(21, 15, '2016-04-19 16:36:58', 'vsvfdv', 'dfvdfvfdv'),
(22, 15, '2016-04-19 16:37:11', 'wqertyutr', 'wefwefwefewfewewfwe');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `validation_code` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `validation_code`, `name`) VALUES
(1, 'aLLeXUs', '123', 'mail@mail.ru', '', ''),
(2, 'test', 'test', 'a@a.a', '', ''),
(3, 'demo', 'demo', 'l@l.l', '', ''),
(8, 'demo2', 'demo2', 'csdc', '', 'lololo'),
(9, 'demo3', 'demo3', '', '', 'wedwed'),
(10, 'lolo', 'qwerty1231', 'aaa@aa.aa', '', 'lolo'),
(11, 'vdjfvd', 'joij', 'mrallexus@gmail.com', 'KZEkTvdWUb', 'sds'),
(12, 'eerferfrefr', 'qweqwr', 'test@mail.ru', '2DY2VqmRna', 'dedede'),
(13, 'wetrwieriewuyrwe', 'uhewuidhe', 'iwjsiw@djdw.ww', '', 'jnwjen'),
(14, 'sadasx', 'xsxa', 'a@a.a', '', 'sixjsix'),
(15, 'demo4', 'demo4', 'demo@mail.ru', '', 'demo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
