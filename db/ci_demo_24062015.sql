-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2016 at 12:57 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ci_demo_24062015`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_adv`
--

CREATE TABLE IF NOT EXISTS `ci_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ci_adv`
--

INSERT INTO `ci_adv` (`id`, `title`, `content`, `order`, `position`, `lang`, `time_start`, `time_end`, `publish`, `userid_created`, `userid_updated`, `created`, `updated`) VALUES
(3, 'Quảng cáo', '<p><a href="3">http://localhost/ci_24062015/backend/adv/edit/3</a></p>\r\n<p>&nbsp;</p>', 0, 'Bên phải', '', '2015-07-30 11:06:49', '2015-07-31 11:17:38', 1, 6, 6, '2015-07-31 09:47:04', '2015-08-05 10:44:06'),
(4, 'Quảng cáo 02', '<p>Quảng c&aacute;o 2</p>', 0, 'Bên phải', '', '2015-08-06 11:14:07', '2015-08-07 11:14:09', 1, 6, 6, '2015-08-06 11:14:12', '2015-08-07 09:18:10'),
(5, 'Nhựa', '<p>Nhựa cao cấp</p>', 0, 'Bên phải', 'vi', '2015-08-06 09:58:27', '2015-08-09 16:49:41', 1, 6, 6, '2015-08-08 16:49:45', '2015-08-12 09:58:29'),
(6, 'Quản trị viên', 'avdfv', 0, 'Bên phải', 'en', '2015-08-08 17:04:08', '2015-08-09 17:04:11', 1, 6, 0, '2015-08-08 17:04:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_article_category`
--

CREATE TABLE IF NOT EXISTS `ci_article_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `viewed` int(11) NOT NULL,
  `publish` tinyint(4) NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ci_article_category`
--

INSERT INTO `ci_article_category` (`id`, `title`, `alias`, `route`, `parentid`, `description`, `order`, `level`, `lft`, `rgt`, `image`, `viewed`, `publish`, `lang`, `meta_title`, `meta_keyword`, `meta_description`, `userid_created`, `userid_updated`, `created`, `updated`) VALUES
(1, 'Root', '', '', 0, '', 0, 0, 0, 27, '', 0, 0, 'all', '', '', '', 6, 0, '2015-08-08 17:30:05', '0000-00-00 00:00:00'),
(2, 'Thể thao', 'th-thao', '', 1, '', 0, 1, 1, 12, '', 0, 1, 'vi', 'Thể thao Việt Nam', 'the thao, viet nam', 'Đây là mô tả về thể thao', 6, 6, '2015-08-09 16:03:34', '2015-08-15 17:07:49'),
(3, 'Sports', '', '', 1, '', 0, 1, 1, 2, '', 0, 1, 'en', '', '', '', 6, 0, '2015-08-09 16:15:03', '0000-00-00 00:00:00'),
(5, 'Chính Trị', 'chinh-tri', '', 1, '', 0, 1, 13, 16, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-13 08:43:07', '0000-00-00 00:00:00'),
(6, 'Kinh Tế', 'kinh-te', '', 1, '', 0, 1, 17, 20, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-13 08:43:17', '0000-00-00 00:00:00'),
(7, 'Xã Hội', 'x-hoi', 'x-hoi', 1, '', 0, 1, 21, 22, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-13 08:43:33', '0000-00-00 00:00:00'),
(8, 'Kinh Doanh', 'kinh-doanh', 'kinh-doanh', 6, '', 0, 2, 14, 15, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-13 08:44:06', '0000-00-00 00:00:00'),
(9, 'Văn Hóa', 'van-ha', '', 1, '', 0, 1, 23, 24, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 09:03:11', '0000-00-00 00:00:00'),
(10, 'chuyện người thường', 'chuyn-ngi-thng', 'chuyn-ngi-thng', 1, '', 0, 1, 25, 26, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 09:34:02', '0000-00-00 00:00:00'),
(11, 'Thể thao', 'th-thao', '', 1, '', 0, 1, 1, 2, '', 0, 1, 'jp', '', '', '', 6, 0, '2015-08-14 11:49:50', '0000-00-00 00:00:00'),
(12, 'Bóng đá', 'bng-d', '', 2, '', 0, 2, 2, 9, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 22:06:33', '0000-00-00 00:00:00'),
(13, 'Bơi  lội', 'bi-loi', '', 2, '', 0, 2, 10, 11, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 22:06:50', '0000-00-00 00:00:00'),
(14, 'Trong nước', 'trong-nc', '', 5, '', 0, 2, 12, 13, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 22:11:05', '0000-00-00 00:00:00'),
(15, 'Câu lạc bộ', 'cau-lac-bo', '', 12, '', 0, 3, 3, 8, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 22:20:03', '0000-00-00 00:00:00'),
(16, 'Chelsea', 'chelsea', '', 15, '', 0, 4, 4, 5, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 22:28:01', '0000-00-00 00:00:00'),
(17, 'MU', 'mu', '', 15, '', 0, 4, 6, 7, '', 0, 1, 'vi', '', '', '', 6, 0, '2015-08-14 22:28:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_article_item`
--

CREATE TABLE IF NOT EXISTS `ci_article_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `tags` text COLLATE utf8_unicode_ci NOT NULL,
  `rate_value` int(11) NOT NULL,
  `rate_total` int(11) NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL,
  `viewed` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `highlight` tinyint(1) NOT NULL,
  `hot` tinyint(1) NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `timer` datetime NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ci_article_item`
--

INSERT INTO `ci_article_item` (`id`, `title`, `alias`, `route`, `parentid`, `image`, `description`, `content`, `tags`, `rate_value`, `rate_total`, `source`, `order`, `viewed`, `publish`, `highlight`, `hot`, `lang`, `meta_title`, `meta_keyword`, `meta_description`, `userid_created`, `userid_updated`, `timer`, `created`, `updated`) VALUES
(1, 'Người viết bài', 'ngi-viet-bai', '', 2, '/ci_24062015/upload/image/HinhUngTuyen_TaDinhTich.jpg', '<p>abc</p>', '', ',ô tô về làng,Việt Nam quê tôi,', 0, 0, '', 0, 0, 1, 0, 0, 'vi', '', '', '', 6, 6, '1970-01-01 00:00:00', '2015-08-09 21:02:05', '2015-08-15 10:01:01'),
(9, 'ô tô về làng', 'o-to-ve-lang', 'o-to', 2, '', '', '', '', 0, 0, '', 0, 0, 1, 0, 0, 'vi', '', '', '', 6, 6, '1970-01-01 01:00:00', '2015-08-11 14:18:56', '2015-08-12 09:04:29'),
(10, 'ô tô về làng', 'o-to-ve-lang', 'o-to-ve', 12, '', '', '', '', 0, 0, '', 0, 0, 1, 0, 0, 'vi', '', '', '', 6, 6, '1970-01-01 05:00:00', '2015-08-11 14:19:29', '2015-08-15 18:14:07'),
(11, 'test 01', 'test-01', '', 5, '', '', '', '', 0, 0, '', 0, 0, 1, 1, 0, 'vi', '', '', '', 6, 6, '1970-01-01 07:00:00', '2015-08-12 09:47:00', '2015-08-15 18:13:35'),
(12, 'Thể thao', 'th-thao', '', 2, '/ci_24062015/upload/image/HinhUngTuyen_TaDinhTich.jpg', '<p>acsacsa</p>', '', ',ô tô về làng,', 0, 0, '', 0, 0, 1, 1, 0, 'vi', '', '', '', 6, 6, '1970-01-01 07:00:00', '2015-08-13 14:10:01', '2015-08-15 09:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `ci_comment`
--

CREATE TABLE IF NOT EXISTS `ci_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `param` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=113 ;

--
-- Dumping data for table `ci_comment`
--

INSERT INTO `ci_comment` (`id`, `param`, `fullname`, `email`, `content`, `publish`, `userid_created`, `userid_updated`, `created`, `updated`) VALUES
(1, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:43', '0000-00-00 00:00:00'),
(2, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:44', '0000-00-00 00:00:00'),
(3, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:46', '0000-00-00 00:00:00'),
(4, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:47', '0000-00-00 00:00:00'),
(5, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:47', '0000-00-00 00:00:00'),
(6, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:48', '0000-00-00 00:00:00'),
(7, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:49', '0000-00-00 00:00:00'),
(8, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:50', '0000-00-00 00:00:00'),
(9, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:53', '0000-00-00 00:00:00'),
(10, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:54', '0000-00-00 00:00:00'),
(11, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:54', '0000-00-00 00:00:00'),
(12, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:54', '0000-00-00 00:00:00'),
(13, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:54', '0000-00-00 00:00:00'),
(14, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:54', '0000-00-00 00:00:00'),
(15, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:55', '0000-00-00 00:00:00'),
(16, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:55', '0000-00-00 00:00:00'),
(17, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:55', '0000-00-00 00:00:00'),
(18, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:55', '0000-00-00 00:00:00'),
(19, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:55', '0000-00-00 00:00:00'),
(20, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:55', '0000-00-00 00:00:00'),
(21, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:56', '0000-00-00 00:00:00'),
(22, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:56', '0000-00-00 00:00:00'),
(23, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:56', '0000-00-00 00:00:00'),
(24, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:56', '0000-00-00 00:00:00'),
(25, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:56', '0000-00-00 00:00:00'),
(26, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:57', '0000-00-00 00:00:00'),
(27, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:57', '0000-00-00 00:00:00'),
(28, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:57', '0000-00-00 00:00:00'),
(29, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:57', '0000-00-00 00:00:00'),
(30, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:57', '0000-00-00 00:00:00'),
(31, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:58', '0000-00-00 00:00:00'),
(32, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:58', '0000-00-00 00:00:00'),
(33, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:58', '0000-00-00 00:00:00'),
(34, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:58', '0000-00-00 00:00:00'),
(35, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:58', '0000-00-00 00:00:00'),
(36, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:59', '0000-00-00 00:00:00'),
(37, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:59', '0000-00-00 00:00:00'),
(38, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:59', '0000-00-00 00:00:00'),
(39, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:21:59', '0000-00-00 00:00:00'),
(40, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:00', '0000-00-00 00:00:00'),
(41, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:00', '0000-00-00 00:00:00'),
(42, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:00', '0000-00-00 00:00:00'),
(43, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:00', '0000-00-00 00:00:00'),
(44, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:01', '0000-00-00 00:00:00'),
(45, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:01', '0000-00-00 00:00:00'),
(46, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:01', '0000-00-00 00:00:00'),
(47, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:01', '0000-00-00 00:00:00'),
(48, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:02', '0000-00-00 00:00:00'),
(49, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:02', '0000-00-00 00:00:00'),
(50, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:02', '0000-00-00 00:00:00'),
(51, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:02', '0000-00-00 00:00:00'),
(52, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:03', '0000-00-00 00:00:00'),
(53, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:03', '0000-00-00 00:00:00'),
(54, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:03', '0000-00-00 00:00:00'),
(55, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:03', '0000-00-00 00:00:00'),
(56, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:04', '0000-00-00 00:00:00'),
(57, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:04', '0000-00-00 00:00:00'),
(58, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:04', '0000-00-00 00:00:00'),
(59, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:04', '0000-00-00 00:00:00'),
(60, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:05', '0000-00-00 00:00:00'),
(61, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:05', '0000-00-00 00:00:00'),
(62, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:05', '0000-00-00 00:00:00'),
(63, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:05', '0000-00-00 00:00:00'),
(64, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:05', '0000-00-00 00:00:00'),
(65, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:05', '0000-00-00 00:00:00'),
(66, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:06', '0000-00-00 00:00:00'),
(67, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:06', '0000-00-00 00:00:00'),
(68, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:06', '0000-00-00 00:00:00'),
(69, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:06', '0000-00-00 00:00:00'),
(70, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:06', '0000-00-00 00:00:00'),
(71, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:07', '0000-00-00 00:00:00'),
(72, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:07', '0000-00-00 00:00:00'),
(73, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:07', '0000-00-00 00:00:00'),
(74, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:07', '0000-00-00 00:00:00'),
(75, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:07', '0000-00-00 00:00:00'),
(76, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:07', '0000-00-00 00:00:00'),
(77, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:08', '0000-00-00 00:00:00'),
(78, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:08', '0000-00-00 00:00:00'),
(79, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:08', '0000-00-00 00:00:00'),
(80, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:08', '0000-00-00 00:00:00'),
(81, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:08', '0000-00-00 00:00:00'),
(82, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:09', '0000-00-00 00:00:00'),
(83, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:09', '0000-00-00 00:00:00'),
(84, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:09', '0000-00-00 00:00:00'),
(85, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:09', '0000-00-00 00:00:00'),
(86, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:09', '0000-00-00 00:00:00'),
(87, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:10', '0000-00-00 00:00:00'),
(88, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:10', '0000-00-00 00:00:00'),
(89, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:10', '0000-00-00 00:00:00'),
(90, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:10', '0000-00-00 00:00:00'),
(91, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:10', '0000-00-00 00:00:00'),
(92, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:11', '0000-00-00 00:00:00'),
(93, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:11', '0000-00-00 00:00:00'),
(94, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:11', '0000-00-00 00:00:00'),
(95, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:11', '0000-00-00 00:00:00'),
(96, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:11', '0000-00-00 00:00:00'),
(97, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:12', '0000-00-00 00:00:00'),
(98, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:12', '0000-00-00 00:00:00'),
(99, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:12', '0000-00-00 00:00:00'),
(100, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:13', '0000-00-00 00:00:00'),
(101, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:13', '0000-00-00 00:00:00'),
(102, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:13', '0000-00-00 00:00:00'),
(103, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:14', '0000-00-00 00:00:00'),
(104, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:14', '0000-00-00 00:00:00'),
(105, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:14', '0000-00-00 00:00:00'),
(106, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:14', '0000-00-00 00:00:00'),
(107, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:14', '0000-00-00 00:00:00'),
(108, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:15', '0000-00-00 00:00:00'),
(109, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:15', '0000-00-00 00:00:00'),
(110, 'article/item/11', 'abc', 'xyz@gmail.com', 'hay', 0, 0, 0, '2015-08-18 11:22:15', '0000-00-00 00:00:00'),
(111, 'article/item/11', 'abc', 'xyz@gmail.com', 'good', 0, 0, 0, '2015-08-18 11:26:50', '0000-00-00 00:00:00'),
(112, 'article/item/11', 'abc', 'xyz@gmail.com', 'ascfasv', 0, 0, 0, '2015-08-18 11:27:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_config`
--

CREATE TABLE IF NOT EXISTS `ci_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value_vi` text COLLATE utf8_unicode_ci NOT NULL,
  `value_en` text COLLATE utf8_unicode_ci NOT NULL,
  `value_jp` text COLLATE utf8_unicode_ci NOT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `update` datetime NOT NULL,
  `created` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ci_config`
--

INSERT INTO `ci_config` (`id`, `keyword`, `value_vi`, `value_en`, `value_jp`, `group`, `update`, `created`, `order`, `publish`, `type`, `label`) VALUES
(1, 'meta_title', 'Học Codeigniter Hiệu Quả', 'Đây là phần EN', '', 'seo', '2015-08-18 09:01:22', '0000-00-00 00:00:00', 0, 1, 'text', 'Meta Title'),
(2, 'meta_description', 'CHuyên Thiết Kế Web Bằng Codeigniter SDT: 097 257 1744', '', '', 'seo', '2015-08-18 09:01:22', '0000-00-00 00:00:00', 0, 1, 'text', 'Meta Description'),
(3, 'meta_keywords', 'Học Codeigniter', '', '', 'seo', '2015-08-18 09:01:22', '0000-00-00 00:00:00', 0, 1, 'text', 'Meta Keywords'),
(4, 'background_image', '', '', '', 'frontend', '2015-08-13 15:51:50', '0000-00-00 00:00:00', 0, 1, 'text', 'Hình nền'),
(5, 'background_style', 'repeat', '', '', 'frontend', '2015-08-13 15:51:50', '0000-00-00 00:00:00', 0, 1, 'text', 'Định dạng hình nền'),
(6, 'close_website', '0', '', '', 'frontend', '2015-08-13 15:51:50', '0000-00-00 00:00:00', 0, 1, 'radio', 'Đóng cửa website'),
(7, 'close_alert', 'Hệ thống đang bảo trì!', '', '', 'frontend', '2015-08-13 15:51:50', '0000-00-00 00:00:00', 0, 1, 'textarea', 'Thông báo đóng cửa'),
(8, 'ftp_hostname', 'localhost', '', '', 'ftp', '2015-08-13 16:00:57', '0000-00-00 00:00:00', 0, 1, 'text', 'Hostname'),
(9, 'ftp_username', 'root', '', '', 'ftp', '2015-08-13 16:00:57', '0000-00-00 00:00:00', 0, 1, 'text', 'Username'),
(10, 'ftp_password', '', '', '', 'ftp', '2015-08-13 16:00:57', '0000-00-00 00:00:00', 0, 1, 'text', 'Password'),
(11, 'google_authorship', 'Tạ Đình Tích', '', '', 'seo', '2015-08-18 09:01:22', '0000-00-00 00:00:00', 4, 1, 'text', 'Tác giả'),
(12, 'google_publisher', 'KHTN', '', '', 'seo', '2015-08-18 09:01:22', '0000-00-00 00:00:00', 5, 1, 'text', 'Xuất Bản'),
(13, 'contact-footer', '<p><span>Copyright &copy; 2015 OpenCart - All rights reserved</span></p>', '', '', 'contact', '2015-08-18 10:38:36', '0000-00-00 00:00:00', 2, 1, 'editor', 'Contact cuối trang'),
(14, 'contact-info', '', '', '', 'contact', '2015-08-18 10:38:36', '0000-00-00 00:00:00', 1, 1, 'editor', 'Thông tin liên hệ');

-- --------------------------------------------------------

--
-- Table structure for table `ci_menu`
--

CREATE TABLE IF NOT EXISTS `ci_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ci_menu`
--

INSERT INTO `ci_menu` (`id`, `title`, `url`, `module`, `module_id`, `order`, `lang`, `publish`, `userid_created`, `userid_updated`, `created`, `updated`) VALUES
(1, 'Trang chủ', '.', '', 0, 0, 'jp', 1, 6, 0, '2015-08-14 11:46:47', '0000-00-00 00:00:00'),
(2, 'Trang chủ', '.', '', 0, 0, 'vi', 1, 6, 0, '2015-08-14 11:50:34', '0000-00-00 00:00:00'),
(3, 'Thể thao', '', 'article_category', 2, 0, 'vi', 1, 6, 6, '2015-08-14 13:16:17', '2015-08-14 22:08:16'),
(4, 'Chính Trị', '', 'article_category', 5, 0, 'vi', 1, 6, 0, '2015-08-14 13:16:49', '0000-00-00 00:00:00'),
(5, 'Liên hệ', 'lien-he.html', '', 0, 0, 'vi', 1, 6, 0, '2015-08-14 13:18:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_partner`
--

CREATE TABLE IF NOT EXISTS `ci_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `publish` tinyint(1) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_partner`
--

INSERT INTO `ci_partner` (`id`, `title`, `url`, `image`, `order`, `publish`, `userid_created`, `userid_updated`, `created`, `updated`) VALUES
(1, 'ITQ', 'itq.vn', '/ci_24062015/upload/image/HinhUngTuyen_TaDinhTich.jpg', 0, 1, 6, 0, '2015-08-18 10:26:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_route`
--

CREATE TABLE IF NOT EXISTS `ci_route` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `param` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ci_route`
--

INSERT INTO `ci_route` (`id`, `url`, `param`, `created`, `updated`) VALUES
(3, 'o-to', 'article/item9', '2015-08-11 22:04:57', '2015-08-12 09:04:29'),
(4, 'o-to-ve', 'article/item10', '2015-08-12 09:05:02', '0000-00-00 00:00:00'),
(12, 'chuyn-ngi-thng', 'article/category10', '2015-08-14 09:34:02', '0000-00-00 00:00:00'),
(14, 'o-to-ve', 'article/item/10', '2015-08-15 18:13:53', '2015-08-15 18:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('320998a671fdb35b14366678338635f1', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', 1456983832, 'a:2:{s:9:"user_data";s:0:"";s:5:"_lang";s:2:"vi";}'),
('3e5c8b11b8058319373bb3448013122c', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', 1456984092, 'a:2:{s:9:"user_data";s:0:"";s:5:"_lang";s:2:"vi";}'),
('d5d038340b87e3770a266316e581f748', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36', 1456984285, 'a:2:{s:9:"user_data";s:0:"";s:5:"_lang";s:2:"vi";}');

-- --------------------------------------------------------

--
-- Table structure for table `ci_slider`
--

CREATE TABLE IF NOT EXISTS `ci_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image1` text COLLATE utf8_unicode_ci NOT NULL,
  `image2` text COLLATE utf8_unicode_ci NOT NULL,
  `image3` text COLLATE utf8_unicode_ci NOT NULL,
  `image4` text COLLATE utf8_unicode_ci NOT NULL,
  `image5` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_tag`
--

CREATE TABLE IF NOT EXISTS `ci_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_tag`
--

INSERT INTO `ci_tag` (`id`, `title`, `alias`, `description`, `meta_title`, `meta_keyword`, `meta_description`, `publish`, `created`, `updated`, `userid_created`, `userid_updated`) VALUES
(1, 'ô tô về làng', 'o-to-ve-lang', '', '', '', '', 1, '2015-08-10 11:11:28', '0000-00-00 00:00:00', 6, 0),
(2, 'Việt Nam quê tôi', 'vit-nam-que-toi', '', '', '', '', 1, '2015-08-10 21:34:52', '0000-00-00 00:00:00', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_user`
--

CREATE TABLE IF NOT EXISTS `ci_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` datetime NOT NULL,
  `update` datetime NOT NULL,
  `created` datetime NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `google_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgot_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgot_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `groupid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ci_user`
--

INSERT INTO `ci_user` (`id`, `username`, `password`, `fullname`, `salt`, `login`, `update`, `created`, `email`, `google_author`, `forgot_code`, `forgot_time`, `groupid`) VALUES
(6, 'admin', 'e4cf5ee155834b38213504dfa2e2127d', 'Tạ Đình Tích', 'xM8542J73YyNQvFixwzi5w1YUpeIfNOUtUwUhFwOBCR9vwk8EIMxAIIr3X7b0X7PD30Ob', '2016-03-03 12:53:32', '2015-07-28 10:17:39', '2015-06-29 15:55:24', 'dinhtich91@gmail.com', '', '', '', 3),
(7, 'adminstrator', 'e4cf5ee155834b38213504dfa2e2127d', 'Tạ Hoàng An', 'xM8542J73YyNQvFixwzi5w1YUpeIfNOUtUwUhFwOBCR9vwk8EIMxAIIr3X7b0X7PD30Ob', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'tahoangan2000@gmail.com', '', '', '', 2),
(8, 'admin', 'd95d554cdbf0f71920ff42fa59e29a25d', '', 'YTQtqq1Z0kxkmSAIPoHQNjei3YCD1zRY7HWBDv0K6pyhouBEF1CFMRDG5y9C8oGR949tZ', '2016-03-03 12:53:32', '0000-00-00 00:00:00', '2015-08-12 22:07:20', 'abc@yahoo.com', '', '', '', 0),
(10, 'admin', '92d6809aa5b2a181b37c5385b067ba68', '', 'ou1fi06jkERpQAAu5BY8eiH5yCBAmdIzAAmpS0yX1umnE8QMgyocrsmT2gnKoFvJdH28B', '2016-03-03 12:53:32', '0000-00-00 00:00:00', '2015-08-13 08:13:42', 'abc@yahoo.com', '', '', '', 2),
(11, 'quantrivien01', '65692242cd38d8cb0891b63ea4c011fd', '', 'gk7jx0MRgIATM27axG5ZqFGM0SD9nr8Z9KIO6dYniw3DGg66uZ6D0FCVxXqqNMVYqyKYf', '2015-08-13 13:56:54', '0000-00-00 00:00:00', '2015-08-13 09:46:27', 'dinhtich91@gmail.com', '', '', '', 2),
(12, 'bikhoa', 'fd5f9544af01931e38b7d41b2a0f11e7', '', 'QYiBPyoHY8QQYqXhUSagbKEz1dVuztzznbtwFdcVne1dUrtkv2feH78vJGnvwnCZvGh6D', '2015-08-13 10:25:01', '0000-00-00 00:00:00', '2015-08-13 10:23:44', 'abc@yahoo.com', '', '', '', 4);

-- --------------------------------------------------------

--
-- Table structure for table `ci_user_group`
--

CREATE TABLE IF NOT EXISTS `ci_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `allow` tinyint(4) NOT NULL,
  `group` text COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ci_user_group`
--

INSERT INTO `ci_user_group` (`id`, `title`, `allow`, `group`, `created`, `updated`, `userid_created`, `userid_updated`, `order`) VALUES
(1, 'Quản trị viên', 0, '', '2015-07-29 08:52:55', '2015-08-13 13:48:21', 6, 6, 30),
(2, 'Người viết bài', 1, 'backend/article\r\nbackend/article/item\r\nbackend/article/additem\r\nbackend/article/edititem\r\nbackend/article/edititem/self\r\n\r\nbackend/auth/login', '2015-07-29 08:57:02', '2015-08-13 13:56:44', 6, 6, 5),
(3, 'Thành viên', 0, '', '2015-07-30 17:37:51', '2015-07-30 18:39:49', 6, 6, 0),
(4, 'Bị khóa', 1, '', '2015-08-13 10:21:55', '0000-00-00 00:00:00', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
