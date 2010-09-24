-- phpMyAdmin SQL Dump
<<<<<<< HEAD
-- version 3.2.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2010 at 04:16 PM
-- Server version: 5.1.40
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `blog`
=======
-- version 3.3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 23 2010 г., 05:00
-- Версия сервера: 5.1.48
-- Версия PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kohana_blog`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `categories`
=======
-- Структура таблицы `categories`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `url` text NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
<<<<<<< HEAD
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`, `parent`) VALUES
(1, '������ ���������', 'pervaya-kategoriya', 0);
=======
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `url`, `parent`) VALUES
(13, 'Третья вложенная категория', 'tretya-vlozhennaya-kategoriya', 12),
(12, 'Первая вложенная категория', 'pervaya-vlozhennaya-kategoriya', 11),
(11, 'Вторая категория', 'vtoraya-kategoriya', 0),
(10, 'Первая категория', 'pervaya-kategoriya', 0);
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `comments`
=======
-- Структура таблицы `comments`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `text` text NOT NULL,
  `url` text NOT NULL,
  `postid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
<<<<<<< HEAD
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `username`, `text`, `url`, `postid`) VALUES
(1, 'admin', '������ �����������', 'http://purpled.biz', 1);
=======
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `username`, `text`, `url`, `postid`) VALUES
(14, 'admin', 'Это первый комментарий.\nОчень интересно!', 'http://microsoft.com', 17);
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `posts`
=======
-- Структура таблицы `posts`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `posted` date NOT NULL,
  `author` int(11) NOT NULL,
  `allowcomment` int(11) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
<<<<<<< HEAD
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `catid`, `title`, `content`, `posted`, `author`, `allowcomment`, `url`) VALUES
(1, 1, '������ ���������', '������! ��� �������� ������ ������������.', '1985-01-01', 1, 1, 'pervoe-soobshenie');
=======
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `catid`, `title`, `content`, `posted`, `author`, `allowcomment`, `url`) VALUES
(20, 12, 'И во вложенной категории есть сообщение', ':)', '2010-08-22', 1, 0, 'i-vo-vlozhennoi-kategorii-est-soobshenie'),
(19, 11, 'Тут тоже есть сообщение', 'Привет!', '2010-08-22', 1, 0, 'tut-tozhe-est-soobshenie'),
(17, 10, 'Первое сообщение', 'Привет!\nЭто новый движок блога, написанный на Kohana Framework.\nА еще это первое сообщение в нем. Удачи!', '2010-08-22', 1, 1, 'pervoe-soobshenie'),
(18, 10, 'Второе сообщение', 'А тут запрещены комментарии', '2010-08-22', 1, 0, 'vtoroe-soobshenie');
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `roles`
=======
-- Структура таблицы `roles`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
<<<<<<< HEAD
-- Dumping data for table `roles`
=======
-- Дамп данных таблицы `roles`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'login', 'Login privileges, granted after account confirmation'),
(2, 'admin', 'Administrative user, has access to everything.');

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `roles_users`
=======
-- Структура таблицы `roles_users`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `roles_users` (
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `fk_role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
<<<<<<< HEAD
-- Dumping data for table `roles_users`
=======
-- Дамп данных таблицы `roles_users`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

INSERT INTO `roles_users` (`user_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `users`
=======
-- Структура таблицы `users`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(127) NOT NULL,
  `username` varchar(32) NOT NULL DEFAULT '',
  `password` char(50) NOT NULL,
  `logins` int(10) unsigned NOT NULL DEFAULT '0',
  `last_login` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_username` (`username`),
  UNIQUE KEY `uniq_email` (`email`)
<<<<<<< HEAD
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(1, '', 'admin', '102dd4917e30c8378da401e147cdf69f10a56b075c301de6d2', 0, 0);
=======
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `logins`, `last_login`) VALUES
(1, '', 'admin', '01e7c753e2398b0cad65b7099494c72c4aa347540bb4dc2e02', 21, 1282528737);
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c

-- --------------------------------------------------------

--
<<<<<<< HEAD
-- Table structure for table `user_tokens`
=======
-- Структура таблицы `user_tokens`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `expires` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`)
<<<<<<< HEAD
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `user_agent`, `token`, `created`, `expires`) VALUES
(9, 1, '648fb3e8c436ce9effe5daf893902590c98e2670', 'CaWdUGjjd3RT8XuJoybf8x3ZqgsZkGZL', 1284412004, 1285621604),
(10, 1, '579e0cc1de2e9e157a39a8acfcb3fad5b1d0c3fc', 'Pr9KYmfnUzkTpTXNnfyu2cmMJJNk2X32', 1284907945, 1286117545);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roles_users`
=======
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `user_id`, `user_agent`, `token`, `created`, `expires`) VALUES
(2, 1, '1a41d00b996fcc6184b7b5f38ad39f013c438266', 'Ml3tsTAKpFqr2tV9OjsRUQyHUjjcWuJQ', 1282164622, 1283374222);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `roles_users`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--
ALTER TABLE `roles_users`
  ADD CONSTRAINT `roles_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `roles_users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
<<<<<<< HEAD
-- Constraints for table `user_tokens`
=======
-- Ограничения внешнего ключа таблицы `user_tokens`
>>>>>>> d1f48eb12b2f4afa561a6eaeb918e5a494cb769c
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `user_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
