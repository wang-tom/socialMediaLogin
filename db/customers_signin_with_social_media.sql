-- phpMyAdmin SQL Dump
-- version 3.5.9-dev
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 13 日 12:32
-- 服务器版本: 5.5.24
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `fiberstore_spain`
--

-- --------------------------------------------------------

--
-- 表的结构 `customers_signin_with_social_media`
--

CREATE TABLE IF NOT EXISTS `customers_signin_with_social_media` (
  `social_media_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `social_media_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`social_media_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `customers_signin_with_social_media`
--

INSERT INTO `customers_signin_with_social_media` (`social_media_id`, `social_media_name`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'LinkedIn'),
(4, 'Google+'),
(5, 'Paypal'),
(6, 'MSN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
