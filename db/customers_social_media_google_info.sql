-- phpMyAdmin SQL Dump
-- version 3.5.9-dev
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 05 月 13 日 12:33
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
-- 表的结构 `customers_social_media_google_info`
--

CREATE TABLE IF NOT EXISTS `customers_social_media_google_info` (
  `customers_google_account_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `google_plus_id` int(50) DEFAULT NULL,
  `google_plus_email` varchar(200) DEFAULT NULL,
  `google_plus_name` varchar(20) DEFAULT NULL,
  `google_plus_gender` varchar(40) DEFAULT NULL,
  `google_plus_location` varchar(120) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`customers_google_account_info_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
