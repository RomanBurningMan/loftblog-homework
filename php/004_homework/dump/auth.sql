-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Ноя 17 2017 г., 00:45
-- Версия сервера: 5.5.48
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `auth`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `age` date DEFAULT NULL,
  `description` text,
  `photo` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `user_name`, `age`, `description`, `photo`) VALUES
(17, 'Ibragim', '$2y$10$pTBd3L8Kpb/umvn/ckt6EuDVCn5b3AArwBLDnGKYwxTP8P0jxoQxe', 'Mambel', '1999-12-12', '12123132132132', './upload/download (1).png'),
(18, 'Radeon', '$2y$10$rmX.lkGtL5GC8flDUCBRw.eTPczLVNM.pxxt0uiDd0N.zyqwH39Uq', 'Radik', '1992-12-12', '123132132132132', './upload/download (2).png'),
(19, 'Zach', '$2y$10$B9RUYA7pAl0ABPIMUmNnV.k.SJ657LMHRP8Z2PG0JFaa890OJuO6S', 'Za', '1999-02-03', '123132132132132', './upload/download (3).png'),
(20, 'Lol', '$2y$10$lKx3vENYHvxcng.LJZnLDuSLx/DvfQghqo3P8TOMky5JgqBJk1xdy', 'El', '1999-05-09', '199191919191', './upload/images (1).jpg'),
(21, 'Ravin', '$2y$10$VbGxjm0IADzIPGApF4C2FuAtW7RG1Qkr3kYumtlDOQn.5X.eAugH2', 'Rava', '2008-11-22', '123', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
