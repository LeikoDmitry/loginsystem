-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 27 2014 г., 17:33
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `login`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'standart user', ''),
(2, 'administrator', '{"admin":1}');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `user_id`, `hash`) VALUES
(7, 43, '641caf5288833f9727ef984f60ad4e1a2250821dbfea25800b'),
(8, 44, 'd35f736be6cafc88bd16d6a1dbea9492ac3b9619501725c3f2'),
(9, 45, '79de98939ea6053cc75769275e910fa7606774c8305e20333c'),
(10, 38, '3ab761f7cfe7dffdf8aa8814e25a7d0b4c8feb5107cef71dfa'),
(11, 40, '020031054803258123a52b318cd8482812a1fa76741b8b67f5');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `name` varchar(50) NOT NULL,
  `joined` datetime NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`, `name`, `joined`, `group`) VALUES
(36, 'Zen', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'Zen', '2014-11-27 01:44:31', 1),
(37, 'Sar', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'T', 'Sar', '2014-11-27 02:30:52', 1),
(38, 'Der', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '', 'Derт', '2014-11-27 02:32:02', 2),
(39, 'Ten', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'U', 'Ten', '2014-11-27 02:35:53', 1),
(40, 'DDD', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'ܪ', '123', '2014-11-27 02:39:53', 1),
(41, 'DDDD', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'qw', '2014-11-27 02:43:01', 1),
(42, 'Dimon', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'Dimon', '2014-11-27 02:50:57', 1),
(43, 'Det', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '-t', 'dqw', '2014-11-27 02:55:57', 1),
(44, 'Dmitry', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '7Z', 'Dimon', '2014-11-27 11:34:38', 1),
(45, 'Ser', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', '', 'der', '2014-11-27 11:46:22', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
