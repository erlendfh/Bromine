-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 20. 08 2009 kl. 14:12:45
-- Serverversion: 5.1.33
-- PHP-version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bromine`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `browsers`
--

CREATE TABLE IF NOT EXISTS `browsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `path` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

--
-- Data dump for tabellen `browsers`
--

INSERT INTO `browsers` (`id`, `name`, `path`) VALUES
(1, 'Internet Explorer 7', '*iexplore'),
(2, 'Internet Explorer 6', '*iexplore'),
(3, 'Firefox 2', '*firefox'),
(6, 'Safari', '*safari'),
(7, 'Firefox 3', '*firefox'),
(8, 'Opera', '*opera'),
(17, 'testfest', '*testfest');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `browsers_nodes`
--

CREATE TABLE IF NOT EXISTS `browsers_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `browser_id` int(11) NOT NULL,
  `node_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `browser_id` (`browser_id`),
  KEY `node_id` (`node_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=204 ;

--
-- Data dump for tabellen `browsers_nodes`
--

INSERT INTO `browsers_nodes` (`id`, `browser_id`, `node_id`) VALUES
(203, 7, 57),
(202, 1, 57);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `combinations`
--

CREATE TABLE IF NOT EXISTS `combinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `browser_id` int(11) NOT NULL,
  `operatingsystem_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `browser_id` (`browser_id`),
  KEY `operatingsystem_id` (`operatingsystem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Data dump for tabellen `combinations`
--

INSERT INTO `combinations` (`id`, `browser_id`, `operatingsystem_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 1),
(9, 2, 2),
(10, 2, 3),
(11, 2, 4),
(12, 2, 5),
(13, 2, 6),
(14, 2, 7),
(15, 3, 1),
(16, 3, 2),
(17, 3, 3),
(18, 3, 4),
(19, 3, 5),
(20, 3, 6),
(21, 3, 7),
(22, 4, 1),
(23, 4, 2),
(24, 4, 3),
(25, 4, 4),
(26, 4, 5),
(27, 4, 6),
(28, 4, 7),
(29, 5, 1),
(30, 5, 2),
(31, 5, 3),
(32, 5, 4),
(33, 5, 5),
(34, 5, 6),
(35, 5, 7),
(36, 6, 1),
(37, 6, 2),
(38, 6, 3),
(39, 6, 4),
(40, 6, 5),
(41, 6, 6),
(42, 6, 7),
(43, 7, 1),
(44, 7, 2),
(45, 7, 3),
(46, 7, 4),
(47, 7, 5),
(48, 7, 6),
(49, 7, 7),
(50, 8, 1),
(51, 8, 2),
(52, 8, 3),
(53, 8, 4),
(54, 8, 5),
(55, 8, 6),
(56, 8, 7);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `combinations_requirements`
--

CREATE TABLE IF NOT EXISTS `combinations_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requirement_id` int(11) NOT NULL,
  `combination_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requirement_id` (`requirement_id`),
  KEY `combination_id` (`combination_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1651 ;

--
-- Data dump for tabellen `combinations_requirements`
--

INSERT INTO `combinations_requirements` (`id`, `requirement_id`, `combination_id`) VALUES
(1643, 342, 46),
(1642, 342, 53),
(1641, 342, 14),
(1640, 342, 43),
(1639, 342, 1),
(1638, 342, 15),
(1648, 334, 15),
(1647, 334, 1),
(1637, 342, 39),
(1636, 342, 7),
(1635, 342, 49),
(1644, 342, 21),
(1650, 344, 1),
(1649, 343, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `commands`
--

CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci DEFAULT NULL,
  `action` longtext CHARACTER SET latin1 COLLATE latin1_danish_ci,
  `var1` longtext CHARACTER SET latin1 COLLATE latin1_danish_ci,
  `var2` longtext CHARACTER SET latin1 COLLATE latin1_danish_ci,
  `test_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `test_id` (`test_id`),
  KEY `status` (`status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=235 ;

--
-- Data dump for tabellen `commands`
--

INSERT INTO `commands` (`id`, `status`, `action`, `var1`, `var2`, `test_id`) VALUES
(1, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 1),
(2, 'done', 'open', '/', '', 1),
(3, 'done', 'type', 'what', 'Kaninungar', 1),
(4, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 1),
(5, 'done', 'waitForPageToLoad', '30000', '', 1),
(6, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 1),
(7, 'done', 'testComplete', '', '', 1),
(8, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 2),
(9, 'done', 'open', '/', '', 2),
(10, 'done', 'type', 'what', 'Kaninungar', 2),
(11, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 2),
(12, 'done', 'waitForPageToLoad', '30000', '', 2),
(13, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 2),
(14, 'done', 'testComplete', '', '', 2),
(15, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 3),
(16, 'done', 'open', '/', '', 3),
(17, 'done', 'type', 'what', 'Biler', 3),
(18, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 3),
(19, 'done', 'waitForPageToLoad', '30000', '', 3),
(20, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kos"]', '', 3),
(21, 'done', 'testComplete', '', '', 3),
(22, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 4),
(23, 'done', 'open', '/', '', 4),
(24, 'done', 'type', 'what', 'Kaninungar', 4),
(25, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 4),
(26, 'done', 'waitForPageToLoad', '30000', '', 4),
(27, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 4),
(28, 'done', 'testComplete', '', '', 4),
(29, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 5),
(30, 'done', 'open', '/', '', 5),
(31, 'done', 'type', 'what', 'Kaninungar', 5),
(32, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 5),
(33, 'done', 'waitForPageToLoad', '30000', '', 5),
(34, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 5),
(35, 'done', 'testComplete', '', '', 5),
(36, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 6),
(37, 'done', 'open', '/', '', 6),
(38, 'done', 'type', 'what', 'Biler', 6),
(39, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 6),
(40, 'done', 'waitForPageToLoad', '30000', '', 6),
(41, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kos"]', '', 6),
(42, 'done', 'testComplete', '', '', 6),
(43, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 7),
(44, 'done', 'open', '/', '', 7),
(45, 'done', 'type', 'what', 'Kaninungar', 7),
(46, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 7),
(47, 'done', 'waitForPageToLoad', '30000', '', 7),
(48, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 7),
(49, 'done', 'testComplete', '', '', 7),
(50, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 8),
(51, 'done', 'open', '/', '', 8),
(52, 'done', 'type', 'what', 'Kaninungar', 8),
(53, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 8),
(54, 'done', 'waitForPageToLoad', '30000', '', 8),
(55, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 8),
(56, 'done', 'testComplete', '', '', 8),
(57, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 9),
(58, 'done', 'open', '/', '', 9),
(59, 'done', 'type', 'what', 'Biler', 9),
(60, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 9),
(61, 'done', 'waitForPageToLoad', '30000', '', 9),
(62, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kos"]', '', 9),
(63, 'done', 'testComplete', '', '', 9),
(64, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 10),
(65, 'done', 'open', '/', '', 10),
(66, 'done', 'type', 'what', 'Biler', 10),
(67, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 10),
(68, 'done', 'waitForPageToLoad', '30000', '', 10),
(69, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kos"]', '', 10),
(70, 'done', 'testComplete', '', '', 10),
(71, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 11),
(72, 'done', 'open', '/', '', 11),
(73, 'done', 'type', 'what', 'Biler', 11),
(74, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 11),
(75, 'done', 'waitForPageToLoad', '30000', '', 11),
(76, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kol"]', '', 11),
(77, 'done', 'testComplete', '', '', 11),
(78, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 12),
(79, 'done', 'open', '/', '', 12),
(80, 'done', 'type', 'what', 'Biler', 12),
(81, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 12),
(82, 'done', 'waitForPageToLoad', '30000', '', 12),
(83, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kol"]', '', 12),
(84, 'done', 'testComplete', '', '', 12),
(85, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 13),
(86, 'done', 'open', '/', '', 13),
(87, 'done', 'type', 'what', 'fredrik reinfeldt', 13),
(88, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 13),
(89, 'done', 'waitForPageToLoad', '30000', '', 13),
(90, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="video"]', '', 13),
(91, 'done', 'testComplete', '', '', 13),
(92, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 14),
(93, 'done', 'open', '/', '', 14),
(94, 'done', 'type', 'what', 'fredrik reinfeldt', 14),
(95, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 14),
(96, 'done', 'waitForPageToLoad', '30000', '', 14),
(97, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="video"]', '', 14),
(98, 'done', 'testComplete', '', '', 14),
(99, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 15),
(100, 'done', 'open', '/', '', 15),
(101, 'passed', 'verifyTrue(isElementPresent)', 'what', '', 15),
(102, 'passed', 'verifyTrue(isElementPresent)', 'where', '', 15),
(103, 'passed', 'verifyTrue(isElementPresent)', 'link=WebbsÃ¶k', '', 15),
(104, 'passed', 'verifyTrue(isElementPresent)', 'link=BildsÃ¶k', '', 15),
(105, 'passed', 'verifyTrue(isElementPresent)', 'link=NyhetssÃ¶k', '', 15),
(106, 'passed', 'verifyTrue(isElementPresent)', 'link=BloggsÃ¶k', '', 15),
(107, 'passed', 'verifyTrue(isElementPresent)', 'link=JobbsÃ¶k', '', 15),
(108, 'passed', 'verifyTrue(isElementPresent)', 'link=Shopping', '', 15),
(109, 'passed', 'verifyTrue(isElementPresent)', 'link=Kommun & landsting', '', 15),
(110, 'passed', 'verifyTrue(isElementPresent)', 'link=Annonsera', '', 15),
(111, 'passed', 'verifyTrue(isElementPresent)', 'link=Bli partner', '', 15),
(112, 'passed', 'verifyTrue(isElementPresent)', 'link=Om eniro.se', '', 15),
(113, 'passed', 'verifyTrue(isElementPresent)', 'link=118 118', '', 15),
(114, 'passed', 'verifyTrue(isElementPresent)', 'link=AnvÃ¤ndarvillkor', '', 15),
(115, 'passed', 'verifyTrue(isElementPresent)', 'link=Kontakta Eniro', '', 15),
(116, 'passed', 'verifyTrue(isElementPresent)', 'link=HjÃ¤lp', '', 15),
(117, 'failed', 'verifyTrue(isElementPresent)', '//div[@id="ssBanner"]/object/embed', '', 15),
(118, 'done', 'testComplete', '', '', 15),
(119, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 16),
(120, 'done', 'open', '/', '', 16),
(121, 'passed', 'verifyTrue(isElementPresent)', 'what', '', 16),
(122, 'passed', 'verifyTrue(isElementPresent)', 'where', '', 16),
(123, 'passed', 'verifyTrue(isElementPresent)', 'link=WebbsÃ¶k', '', 16),
(124, 'passed', 'verifyTrue(isElementPresent)', 'link=BildsÃ¶k', '', 16),
(125, 'passed', 'verifyTrue(isElementPresent)', 'link=NyhetssÃ¶k', '', 16),
(126, 'passed', 'verifyTrue(isElementPresent)', 'link=BloggsÃ¶k', '', 16),
(127, 'passed', 'verifyTrue(isElementPresent)', 'link=JobbsÃ¶k', '', 16),
(128, 'passed', 'verifyTrue(isElementPresent)', 'link=Shopping', '', 16),
(129, 'passed', 'verifyTrue(isElementPresent)', 'link=Kommun & landsting', '', 16),
(130, 'passed', 'verifyTrue(isElementPresent)', 'link=Annonsera', '', 16),
(131, 'passed', 'verifyTrue(isElementPresent)', 'link=Bli partner', '', 16),
(132, 'passed', 'verifyTrue(isElementPresent)', 'link=Om eniro.se', '', 16),
(133, 'passed', 'verifyTrue(isElementPresent)', 'link=118 118', '', 16),
(134, 'passed', 'verifyTrue(isElementPresent)', 'link=AnvÃ¤ndarvillkor', '', 16),
(135, 'passed', 'verifyTrue(isElementPresent)', 'link=Kontakta Eniro', '', 16),
(136, 'passed', 'verifyTrue(isElementPresent)', 'link=HjÃ¤lp', '', 16),
(137, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="ssBanner"]/object/embed', '', 16),
(138, 'done', 'testComplete', '', '', 16),
(139, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 17),
(140, 'done', 'open', '/', '', 17),
(141, 'done', 'type', 'what', 'Kaninungar', 17),
(142, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 17),
(143, 'done', 'waitForPageToLoad', '30000', '', 17),
(144, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 17),
(145, 'done', 'testComplete', '', '', 17),
(146, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 18),
(147, 'done', 'open', '/', '', 18),
(148, 'done', 'type', 'what', 'Kaninungar', 18),
(149, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 18),
(150, 'done', 'waitForPageToLoad', '30000', '', 18),
(151, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="image"]', '', 18),
(152, 'done', 'testComplete', '', '', 18),
(153, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 19),
(154, 'done', 'open', '/', '', 19),
(155, 'done', 'type', 'what', 'Biler', 19),
(156, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 19),
(157, 'done', 'waitForPageToLoad', '30000', '', 19),
(158, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kos"]', '', 19),
(159, 'done', 'testComplete', '', '', 19),
(160, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 20),
(161, 'done', 'open', '/', '', 20),
(162, 'done', 'type', 'what', 'Biler', 20),
(163, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 20),
(164, 'done', 'waitForPageToLoad', '30000', '', 20),
(165, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kos"]', '', 20),
(166, 'done', 'testComplete', '', '', 20),
(167, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 21),
(168, 'done', 'open', '/', '', 21),
(169, 'done', 'type', 'what', 'Biler', 21),
(170, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 21),
(171, 'done', 'waitForPageToLoad', '30000', '', 21),
(172, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kol"]', '', 21),
(173, 'done', 'testComplete', '', '', 21),
(174, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 22),
(175, 'done', 'open', '/', '', 22),
(176, 'done', 'type', 'what', 'Biler', 22),
(177, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 22),
(178, 'done', 'waitForPageToLoad', '30000', '', 22),
(179, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="kol"]', '', 22),
(180, 'done', 'testComplete', '', '', 22),
(181, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 23),
(182, 'done', 'open', '/', '', 23),
(183, 'done', 'type', 'what', 'fredrik reinfeldt', 23),
(184, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 23),
(185, 'done', 'waitForPageToLoad', '30000', '', 23),
(186, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="video"]', '', 23),
(187, 'done', 'testComplete', '', '', 23),
(188, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 24),
(189, 'done', 'open', '/', '', 24),
(190, 'done', 'type', 'what', 'fredrik reinfeldt', 24),
(191, 'done', 'click', '//input[@value=''SÃ¶k'']', '', 24),
(192, 'done', 'waitForPageToLoad', '30000', '', 24),
(193, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="image-video"]//div[@class="image-video"]//div[@class="video"]', '', 24),
(194, 'done', 'testComplete', '', '', 24),
(195, 'done', 'getNewBrowserSession', '*iexplore', 'http://www.eniro.se', 25),
(196, 'done', 'open', '/', '', 25),
(197, 'passed', 'verifyTrue(isElementPresent)', 'what', '', 25),
(198, 'passed', 'verifyTrue(isElementPresent)', 'where', '', 25),
(199, 'passed', 'verifyTrue(isElementPresent)', 'link=WebbsÃ¶k', '', 25),
(200, 'passed', 'verifyTrue(isElementPresent)', 'link=BildsÃ¶k', '', 25),
(201, 'passed', 'verifyTrue(isElementPresent)', 'link=NyhetssÃ¶k', '', 25),
(202, 'passed', 'verifyTrue(isElementPresent)', 'link=BloggsÃ¶k', '', 25),
(203, 'passed', 'verifyTrue(isElementPresent)', 'link=JobbsÃ¶k', '', 25),
(204, 'passed', 'verifyTrue(isElementPresent)', 'link=Shopping', '', 25),
(205, 'passed', 'verifyTrue(isElementPresent)', 'link=Kommun & landsting', '', 25),
(206, 'passed', 'verifyTrue(isElementPresent)', 'link=Annonsera', '', 25),
(207, 'passed', 'verifyTrue(isElementPresent)', 'link=Bli partner', '', 25),
(208, 'passed', 'verifyTrue(isElementPresent)', 'link=Om eniro.se', '', 25),
(209, 'passed', 'verifyTrue(isElementPresent)', 'link=118 118', '', 25),
(210, 'passed', 'verifyTrue(isElementPresent)', 'link=AnvÃ¤ndarvillkor', '', 25),
(211, 'passed', 'verifyTrue(isElementPresent)', 'link=Kontakta Eniro', '', 25),
(212, 'passed', 'verifyTrue(isElementPresent)', 'link=HjÃ¤lp', '', 25),
(213, 'failed', 'verifyTrue(isElementPresent)', '//div[@id="ssBanner"]/object/embed', '', 25),
(214, 'done', 'testComplete', '', '', 25),
(215, 'done', 'getNewBrowserSession', '*firefox', 'http://www.eniro.se', 26),
(216, 'done', 'open', '/', '', 26),
(217, 'passed', 'verifyTrue(isElementPresent)', 'what', '', 26),
(218, 'passed', 'verifyTrue(isElementPresent)', 'where', '', 26),
(219, 'passed', 'verifyTrue(isElementPresent)', 'link=WebbsÃ¶k', '', 26),
(220, 'passed', 'verifyTrue(isElementPresent)', 'link=BildsÃ¶k', '', 26),
(221, 'passed', 'verifyTrue(isElementPresent)', 'link=NyhetssÃ¶k', '', 26),
(222, 'passed', 'verifyTrue(isElementPresent)', 'link=BloggsÃ¶k', '', 26),
(223, 'passed', 'verifyTrue(isElementPresent)', 'link=JobbsÃ¶k', '', 26),
(224, 'passed', 'verifyTrue(isElementPresent)', 'link=Shopping', '', 26),
(225, 'passed', 'verifyTrue(isElementPresent)', 'link=Kommun & landsting', '', 26),
(226, 'passed', 'verifyTrue(isElementPresent)', 'link=Annonsera', '', 26),
(227, 'passed', 'verifyTrue(isElementPresent)', 'link=Bli partner', '', 26),
(228, 'passed', 'verifyTrue(isElementPresent)', 'link=Om eniro.se', '', 26),
(229, 'passed', 'verifyTrue(isElementPresent)', 'link=118 118', '', 26),
(230, 'passed', 'verifyTrue(isElementPresent)', 'link=AnvÃ¤ndarvillkor', '', 26),
(231, 'passed', 'verifyTrue(isElementPresent)', 'link=Kontakta Eniro', '', 26),
(232, 'passed', 'verifyTrue(isElementPresent)', 'link=HjÃ¤lp', '', 26),
(233, 'passed', 'verifyTrue(isElementPresent)', '//div[@id="ssBanner"]/object/embed', '', 26),
(234, 'done', 'testComplete', '', '', 26);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Data dump for tabellen `configs`
--

INSERT INTO `configs` (`id`, `name`, `value`) VALUES
(1, 'registered', '1'),
(2, 'email on error', '1'),
(3, 'autoupdate', '1');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `dashboard_types`
--

CREATE TABLE IF NOT EXISTS `dashboard_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `dashboard_types`
--

INSERT INTO `dashboard_types` (`id`, `name`) VALUES
(1, 'pie');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Data dump for tabellen `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'managers'),
(3, 'users');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dashboard_type_id` int(11) NOT NULL,
  `posx` int(11) NOT NULL,
  `posy` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `sql` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type_id` (`dashboard_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `items`
--

INSERT INTO `items` (`id`, `user_id`, `dashboard_type_id`, `posx`, `posy`, `width`, `height`, `sql`) VALUES
(1, 21, 1, 220, 80, 380, 188, '\n                        SELECT * FROM testcases, tests, suites, projects, browsers, operatingsystems WHERE\n                        testcases.id = tests.testcase_id AND\n                        tests.suite_id = suites.id AND\n                        testcases.project_id = projects.id AND\n                        tests.browser_id = browsers.id AND\n                        tests.operatingsystem_id = operatingsystems.id AND\n                        projects.id = 131');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `odr` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Data dump for tabellen `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `title`, `controller`, `action`, `odr`) VALUES
(-2, 0, 'Admin menu', '', '', 0),
(47, 40, 'Add testcase', 'requirements#/testcases', 'add', 2),
(-1, 0, 'Main menu', '', '', 0),
(41, -1, 'TestLabs', 'testlabs#/projects/testlabsview', '', 1),
(46, 40, 'Add requirement', 'requirements#/requirements', 'add', 1),
(40, -1, 'Planning', 'requirements', 'index', 0),
(62, -2, 'Contribute', '', '', 5),
(49, -2, 'Help', '', '', 5),
(50, 49, 'State of the system', 'configs', 'stateOfTheSystem', 0),
(51, 49, 'About Bromine', 'pages', 'about', 2),
(52, -2, 'Projects', 'projects', '', 2),
(53, 61, 'Types', 'types', '', 0),
(54, 56, 'Users', 'users', '', 0),
(55, 56, 'Groups', 'groups', '', 1),
(56, -2, 'Users and access', '', '', 3),
(57, 61, 'Browsers', 'browsers', '', 0),
(58, 61, 'Operating systems', 'operatingsystems', '', 0),
(59, -2, 'Nodes', 'nodes', '', 1),
(60, 56, 'Access control', 'manage_acl', '', 2),
(61, -2, 'Misc', '', '', 4),
(63, 62, 'Register Bromine', 'configs', 'register', 1),
(64, 62, 'Email developers on error >>', '', '', 2),
(65, 64, 'Change to yes', 'configs', 'sendUsMailWhenBromineFails/true', 1),
(66, 64, 'Change to no', 'configs', 'sendUsMailWhenBromineFails/false', 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `myacos`
--

CREATE TABLE IF NOT EXISTS `myacos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `parent_id` (`parent_id`),
  KEY `foreign_key` (`foreign_key`),
  KEY `model` (`model`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=348 ;

--
-- Data dump for tabellen `myacos`
--

INSERT INTO `myacos` (`id`, `model`, `foreign_key`, `parent_id`, `alias`) VALUES
(1, '', 0, NULL, '/everything'),
(318, '', 0, 314, '/everything/Testcases/testlabview'),
(317, '', 0, 314, '/everything/Testcases/view'),
(316, '', 0, 314, '/everything/Testcases/lilist'),
(315, '', 0, 314, '/everything/Testcases/index'),
(314, '', 0, 1, '/everything/Testcases'),
(313, '', 0, 307, '/everything/Testcasesteps/delete'),
(312, '', 0, 307, '/everything/Testcasesteps/edit'),
(311, '', 0, 307, '/everything/Testcasesteps/add'),
(310, '', 0, 307, '/everything/Testcasesteps/view'),
(309, '', 0, 307, '/everything/Testcasesteps/reorder'),
(308, '', 0, 307, '/everything/Testcasesteps/index'),
(307, '', 0, 1, '/everything/Testcasesteps'),
(306, '', 0, 301, '/everything/Suites/delete'),
(305, '', 0, 301, '/everything/Suites/edit'),
(304, '', 0, 301, '/everything/Suites/add'),
(303, '', 0, 301, '/everything/Suites/view'),
(302, '', 0, 301, '/everything/Suites/index'),
(301, '', 0, 1, '/everything/Suites'),
(300, '', 0, 295, '/everything/Sites/delete'),
(299, '', 0, 295, '/everything/Sites/edit'),
(298, '', 0, 295, '/everything/Sites/add'),
(297, '', 0, 295, '/everything/Sites/view'),
(296, '', 0, 295, '/everything/Sites/select'),
(295, '', 0, 1, '/everything/Sites'),
(294, '', 0, 293, '/everything/Selftest/build'),
(293, '', 0, 1, '/everything/Selftest'),
(292, '', 0, 290, '/everything/Seleniumserver/executeCommand'),
(291, '', 0, 290, '/everything/Seleniumserver/driver'),
(290, '', 0, 1, '/everything/Seleniumserver'),
(289, '', 0, 285, '/everything/Runrctests/runTestcase'),
(288, '', 0, 285, '/everything/Runrctests/runRequirement'),
(287, '', 0, 285, '/everything/Runrctests/runAndViewRequirement'),
(286, '', 0, 285, '/everything/Runrctests/runAndViewTestcase'),
(285, '', 0, 1, '/everything/Runrctests'),
(284, '', 0, 275, '/everything/Requirements/delete'),
(283, '', 0, 275, '/everything/Requirements/edit'),
(282, '', 0, 275, '/everything/Requirements/add'),
(281, '', 0, 275, '/everything/Requirements/testlabview'),
(280, '', 0, 275, '/everything/Requirements/view'),
(279, '', 0, 275, '/everything/Requirements/index'),
(278, '', 0, 275, '/everything/Requirements/updateCombination'),
(277, '', 0, 275, '/everything/Requirements/updatetc'),
(276, '', 0, 275, '/everything/Requirements/reorder'),
(275, '', 0, 1, '/everything/Requirements'),
(274, '', 0, 267, '/everything/Projects/select'),
(273, '', 0, 267, '/everything/Projects/testlabsview'),
(272, '', 0, 267, '/everything/Projects/delete'),
(271, '', 0, 267, '/everything/Projects/edit'),
(270, '', 0, 267, '/everything/Projects/add'),
(269, '', 0, 267, '/everything/Projects/view'),
(268, '', 0, 267, '/everything/Projects/index'),
(267, '', 0, 1, '/everything/Projects'),
(266, '', 0, 261, '/everything/Operatingsystems/delete'),
(265, '', 0, 261, '/everything/Operatingsystems/edit'),
(264, '', 0, 261, '/everything/Operatingsystems/add'),
(263, '', 0, 261, '/everything/Operatingsystems/view'),
(262, '', 0, 261, '/everything/Operatingsystems/index'),
(261, '', 0, 1, '/everything/Operatingsystems'),
(260, '', 0, 255, '/everything/Nodes/delete'),
(259, '', 0, 255, '/everything/Nodes/edit'),
(258, '', 0, 255, '/everything/Nodes/add'),
(257, '', 0, 255, '/everything/Nodes/view'),
(256, '', 0, 255, '/everything/Nodes/index'),
(255, '', 0, 1, '/everything/Nodes'),
(254, '', 0, 253, '/everything/News/index'),
(253, '', 0, 1, '/everything/News'),
(252, '', 0, 247, '/everything/Myaros/delete'),
(251, '', 0, 247, '/everything/Myaros/edit'),
(250, '', 0, 247, '/everything/Myaros/add'),
(249, '', 0, 247, '/everything/Myaros/view'),
(248, '', 0, 247, '/everything/Myaros/index'),
(247, '', 0, 1, '/everything/Myaros'),
(246, '', 0, 241, '/everything/Myacos/delete'),
(245, '', 0, 241, '/everything/Myacos/edit'),
(244, '', 0, 241, '/everything/Myacos/add'),
(243, '', 0, 241, '/everything/Myacos/view'),
(242, '', 0, 241, '/everything/Myacos/index'),
(241, '', 0, 1, '/everything/Myacos'),
(240, '', 0, 235, '/everything/Menus/delete'),
(239, '', 0, 235, '/everything/Menus/edit'),
(238, '', 0, 235, '/everything/Menus/add'),
(237, '', 0, 235, '/everything/Menus/view'),
(236, '', 0, 235, '/everything/Menus/index'),
(235, '', 0, 1, '/everything/Menus'),
(234, '', 0, 229, '/everything/ManageAcl/listAcos'),
(233, '', 0, 229, '/everything/ManageAcl/removeACL'),
(232, '', 0, 229, '/everything/ManageAcl/createACL'),
(231, '', 0, 229, '/everything/ManageAcl/listAros'),
(230, '', 0, 229, '/everything/ManageAcl/index'),
(229, '', 0, 1, '/everything/ManageAcl'),
(228, '', 0, 224, '/everything/Items/updateItemSize'),
(227, '', 0, 224, '/everything/Items/updateItemPosition'),
(226, '', 0, 224, '/everything/Items/edit'),
(225, '', 0, 224, '/everything/Items/index'),
(224, '', 0, 1, '/everything/Items'),
(223, '', 0, 218, '/everything/Groups/delete'),
(222, '', 0, 218, '/everything/Groups/edit'),
(221, '', 0, 218, '/everything/Groups/add'),
(220, '', 0, 218, '/everything/Groups/view'),
(219, '', 0, 218, '/everything/Groups/index'),
(218, '', 0, 1, '/everything/Groups'),
(217, '', 0, 212, '/everything/Configs/stateOfTheSystem'),
(216, '', 0, 212, '/everything/Configs/sendUsMailWhenBromineFails'),
(215, '', 0, 212, '/everything/Configs/help'),
(214, '', 0, 212, '/everything/Configs/register'),
(213, '', 0, 212, '/everything/Configs/checkForUpdates'),
(212, '', 0, 1, '/everything/Configs'),
(211, '', 0, 205, '/everything/Commands/delete'),
(210, '', 0, 205, '/everything/Commands/edit'),
(209, '', 0, 205, '/everything/Commands/add'),
(208, '', 0, 205, '/everything/Commands/view'),
(207, '', 0, 205, '/everything/Commands/belongsToProject'),
(206, '', 0, 205, '/everything/Commands/index'),
(205, '', 0, 1, '/everything/Commands'),
(204, '', 0, 199, '/everything/Browsers/delete'),
(203, '', 0, 199, '/everything/Browsers/edit'),
(202, '', 0, 199, '/everything/Browsers/add'),
(201, '', 0, 199, '/everything/Browsers/view'),
(200, '', 0, 199, '/everything/Browsers/index'),
(199, '', 0, 1, '/everything/Browsers'),
(198, '', 0, 197, '/everything/Pages/display'),
(197, '', 0, 1, '/everything/Pages'),
(319, '', 0, 314, '/everything/Testcases/viewscript'),
(320, '', 0, 314, '/everything/Testcases/add'),
(321, '', 0, 314, '/everything/Testcases/edit'),
(322, '', 0, 314, '/everything/Testcases/upload'),
(323, '', 0, 314, '/everything/Testcases/delete'),
(324, '', 0, 314, '/everything/Testcases/addToJira'),
(325, '', 0, 1, '/everything/Testlabs'),
(326, '', 0, 325, '/everything/Testlabs/index'),
(327, '', 0, 1, '/everything/Tests'),
(328, '', 0, 327, '/everything/Tests/index'),
(329, '', 0, 327, '/everything/Tests/view'),
(330, '', 0, 327, '/everything/Tests/add'),
(331, '', 0, 327, '/everything/Tests/edit'),
(332, '', 0, 327, '/everything/Tests/delete'),
(333, '', 0, 1, '/everything/Types'),
(334, '', 0, 333, '/everything/Types/index'),
(335, '', 0, 333, '/everything/Types/view'),
(336, '', 0, 333, '/everything/Types/add'),
(337, '', 0, 333, '/everything/Types/edit'),
(338, '', 0, 333, '/everything/Types/delete'),
(339, '', 0, 1, '/everything/Users'),
(340, '', 0, 339, '/everything/Users/assign'),
(341, '', 0, 339, '/everything/Users/login'),
(342, '', 0, 339, '/everything/Users/logout'),
(343, '', 0, 339, '/everything/Users/index'),
(344, '', 0, 339, '/everything/Users/view'),
(345, '', 0, 339, '/everything/Users/add'),
(346, '', 0, 339, '/everything/Users/edit'),
(347, '', 0, 339, '/everything/Users/delete');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `myaros`
--

CREATE TABLE IF NOT EXISTS `myaros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `parent_id` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  KEY `parent_id` (`parent_id`),
  KEY `foreign_key` (`foreign_key`),
  KEY `model` (`model`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Data dump for tabellen `myaros`
--

INSERT INTO `myaros` (`id`, `model`, `foreign_key`, `parent_id`, `alias`) VALUES
(1, 'group', 1, NULL, '/admin'),
(2, 'group', 2, NULL, '/managers'),
(3, 'group', 3, NULL, '/users'),
(23, 'user', 23, 2, '/managers/Visti'),
(24, 'user', 24, 1, '/admin/test'),
(21, 'user', 21, 1, '/admin/Ralle');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `myaros_myacos`
--

CREATE TABLE IF NOT EXISTS `myaros_myacos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `myaro_id` int(10) NOT NULL,
  `myaco_id` int(10) NOT NULL,
  `access` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`myaro_id`,`myaco_id`),
  KEY `myaco_id` (`myaco_id`),
  KEY `myaro_id` (`myaro_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Data dump for tabellen `myaros_myacos`
--

INSERT INTO `myaros_myacos` (`id`, `myaro_id`, `myaco_id`, `access`) VALUES
(15, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `nodes`
--

CREATE TABLE IF NOT EXISTS `nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nodepath` varchar(255) COLLATE utf8_bin NOT NULL,
  `operatingsystem_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `operatingsystem_id` (`operatingsystem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=58 ;

--
-- Data dump for tabellen `nodes`
--

INSERT INTO `nodes` (`id`, `nodepath`, `operatingsystem_id`, `description`) VALUES
(57, '127.0.0.1:4444', 1, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `operatingsystems`
--

CREATE TABLE IF NOT EXISTS `operatingsystems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Data dump for tabellen `operatingsystems`
--

INSERT INTO `operatingsystems` (`id`, `name`) VALUES
(1, 'Windows Vista'),
(2, 'Ubuntu'),
(3, 'Windows 2000'),
(4, 'Mac OSx'),
(5, 'Windows 98'),
(6, 'Windows 95'),
(7, 'Windows XP');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=134 ;

--
-- Data dump for tabellen `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`) VALUES
(125, 'lala', 'as'),
(123, 'sample', 'A sample project'),
(126, 'Krak-eniro update', ''),
(131, 'eniro3', 'Test of all eniro portals\r\neniro.dk, eniro.se, eniro.fi '),
(132, 'selftest', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `projects_users`
--

CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Data dump for tabellen `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`) VALUES
(26, 131, 21),
(25, 131, 24);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `requirements`
--

CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  `project_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=345 ;

--
-- Data dump for tabellen `requirements`
--

INSERT INTO `requirements` (`id`, `name`, `description`, `project_id`, `parent_id`) VALUES
(343, 'Requirement 2', '', 123, 0),
(344, 'selftest', '', 132, 0),
(334, 'Requirement 1', '', 123, 0),
(342, 'Super Search', 0x54686520726571756972656d656e74206f6620737570657220736561726368, 131, 0),
(338, 'uihk', 0x686b, 123, 329);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `requirements_testcases`
--

CREATE TABLE IF NOT EXISTS `requirements_testcases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testcase_id` int(11) NOT NULL,
  `requirement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `requirement_id` (`requirement_id`),
  KEY `testcase_id` (`testcase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7951 ;

--
-- Data dump for tabellen `requirements_testcases`
--

INSERT INTO `requirements_testcases` (`id`, `testcase_id`, `requirement_id`) VALUES
(930, 20, 343),
(200, 328, 123),
(910, 27, 342),
(909, 29, 342),
(908, 26, 342),
(929, 21, 343),
(928, 23, 343),
(921, 20, 334),
(907, 28, 342),
(906, 25, 342),
(920, 23, 334),
(919, 21, 334),
(918, 24, 334),
(917, 22, 334),
(7950, 146, 344),
(7949, 145, 344),
(7948, 144, 344),
(7947, 143, 344),
(7946, 142, 344),
(7945, 141, 344),
(7944, 140, 344),
(7943, 139, 344),
(7942, 138, 344),
(7941, 137, 344),
(7940, 136, 344),
(7939, 135, 344),
(7938, 134, 344),
(7937, 133, 344),
(7936, 132, 344),
(7935, 131, 344),
(7934, 130, 344),
(7933, 129, 344),
(7932, 128, 344),
(7931, 127, 344),
(7930, 126, 344),
(7929, 125, 344),
(7928, 124, 344),
(7927, 123, 344),
(7926, 122, 344),
(7925, 121, 344),
(7924, 120, 344),
(7923, 119, 344),
(7922, 118, 344),
(7921, 117, 344),
(7920, 116, 344),
(7919, 115, 344),
(7918, 114, 344),
(7917, 113, 344),
(7916, 112, 344),
(7915, 111, 344),
(7914, 110, 344),
(7913, 109, 344),
(7912, 108, 344),
(7911, 107, 344),
(7910, 106, 344),
(7909, 105, 344),
(7908, 104, 344),
(7907, 103, 344),
(7906, 102, 344),
(7905, 101, 344),
(7904, 100, 344),
(7903, 99, 344),
(7902, 98, 344),
(7901, 97, 344),
(7900, 96, 344),
(7899, 95, 344),
(7898, 94, 344),
(7897, 93, 344),
(7896, 92, 344),
(7895, 91, 344),
(7894, 90, 344),
(7893, 89, 344),
(7892, 88, 344),
(7891, 87, 344),
(7890, 86, 344),
(7889, 85, 344),
(7888, 84, 344),
(7887, 83, 344),
(7886, 82, 344),
(7885, 81, 344),
(7884, 80, 344),
(7883, 79, 344),
(7882, 78, 344),
(7881, 77, 344),
(7880, 76, 344),
(7879, 75, 344),
(7878, 74, 344),
(7877, 73, 344),
(7876, 72, 344),
(7875, 71, 344),
(7874, 70, 344),
(7873, 69, 344),
(7872, 68, 344),
(7871, 67, 344),
(7870, 66, 344),
(7869, 65, 344),
(7868, 64, 344),
(7867, 63, 344),
(7866, 62, 344),
(7865, 61, 344),
(7864, 60, 344),
(7863, 59, 344),
(7862, 58, 344),
(7861, 57, 344),
(7860, 56, 344),
(7859, 55, 344),
(7858, 54, 344),
(7857, 53, 344),
(7856, 52, 344),
(7855, 51, 344),
(7854, 50, 344),
(7853, 49, 344),
(7852, 48, 344),
(7851, 47, 344),
(7850, 46, 344),
(7849, 45, 344),
(7848, 44, 344),
(7847, 43, 344),
(7846, 42, 344),
(7845, 41, 344),
(7844, 40, 344),
(7843, 39, 344),
(7842, 38, 344),
(7841, 37, 344),
(7840, 36, 344),
(7839, 35, 344),
(7838, 34, 344),
(7837, 33, 344),
(7836, 32, 344),
(7835, 31, 344),
(7834, 30, 344);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `seleniumservers`
--

CREATE TABLE IF NOT EXISTS `seleniumservers` (
  `session` varchar(255) NOT NULL,
  `nodepath` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `test_id` int(11) NOT NULL,
  `lastCommand` int(20) NOT NULL,
  `done` int(1) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `test_id` (`test_id`),
  KEY `session` (`session`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `seleniumservers`
--

INSERT INTO `seleniumservers` (`session`, `nodepath`, `uid`, `test_id`, `lastCommand`, `done`) VALUES
('6a7d00ff1f6743ee8d135f25336ecf60', '10.10.11.74:4444', '124695717587347', 1, 1246957281, 0),
('d1c5bcf14a0d49a9825081419fc2c45c', '10.10.11.74:4444', '124695736754580', 2, 1246957393, 1),
('8f1c491206994d119c07317e381c2d1e', '10.10.11.74:4444', '124696043658577', 3, 1246960458, 1),
('56386b6029c74793a044b3c078d77369', '10.10.11.74:4444', '124696046161370', 4, 1246960533, 1),
('318f7eced2a04d32875201d66df49121', '10.10.11.74:4444', '124696053427769', 5, 1246960561, 1),
('c1938b618f7545f1b5a2668801bda496', '10.10.11.74:4444', '124696056319713', 6, 1246960579, 1),
('f6aaf4a0d26a461c98eaaad220b75caf', '10.10.11.92:4446', '124698130438961', 32, 1246981360, 1),
('1f896c3bd7154c879ab7f907e39e3ca9', '10.10.11.74:4444', '124696263072810', 8, 1246962686, 1),
('', '', '', 0, 1246981359, 0),
('f2e41ded2e4443eb8b6a2540d37eae02', '10.10.11.73:4444', '124698147659700', 33, 1246981495, 1),
('64033cb5f4e544d69ce2e2c9061b8c6e', '10.10.11.92:4446', '12469814769842', 34, 1246981491, 1),
('7fe238fc1d0c4a989f98f60476c63499', '10.10.11.74:4444', '124696313374346', 13, 1246963190, 1),
('56123189ac94493daa76e988ec01cbf8', '10.10.11.74:4444', '124696479543666', 15, 1246964851, 1),
('48660713a9f24bbaae97f946ef379d6d', '10.10.11.92:4444', '1247034494091', 35, 1247034565, 1),
('75e7992c11d14f4e82e6ca9eb2f3446d', '10.10.11.92:4446', '12470344947497', 36, 1247034561, 1),
('e2d6f44d76ae4efdbc42a911c8992390', '10.10.11.92:4444', '124703460689569', 37, 1247034667, 1),
('9bfc4a44e41548e9871bb45ec51f252a', '10.10.11.92:4446', '124703460734871', 38, 1247034734, 1),
('a97bca45ecfe46c5b647efcf0ed05b5c', '10.10.11.73:4444', '124696619015330', 21, 1246966253, 1),
('6c5c68f883c74bee8502eed4e420fff0', '10.10.11.74:4444', '124696619067679', 22, 1246966249, 1),
('764d64bbf7e3405caeb9401e938cb50f', '10.10.11.73:4444', '124696632567596', 23, 1246966386, 1),
('a1a66af232ef495a896d38dd65e5aa64', '10.10.11.74:4444', '124696632618210', 24, 1246966382, 1),
('9944c5050871432fbb76ecfcf117ca56', '10.10.11.73:4444', '124697024078565', 25, 1246970301, 1),
('1a299d121e734a77ba1bb19799014817', '10.10.11.74:4444', '124697024143868', 26, 1246970309, 1),
('6b546c7c829f44c28143fce433e589d5', '10.10.11.73:4444', '124697035723595', 27, 1246970417, 1),
('c5d385295f6a4f9fa0b6259b37b8a95e', '10.10.11.74:4444', '124697035773639', 28, 1246970413, 1),
('f261135d5c1a4bb1858d4c8a4da6768c', '10.10.11.73:4444', '124697092015297', 29, 1246970938, 0),
('11a36ba1a517479996afe51e8f7ccbe6', '10.10.11.74:4444', '124697092069638', 30, 1246970944, 1),
('88f38be94b9247ceaa26c9bf7138fb37', '10.10.11.73:4444', '124698130395355', 31, 1246981369, 1),
('8986ff2bc7c24184b3fa1bd1118b5b02', '10.10.11.92:4444', '1247034770876', 39, 1247034836, 1),
('b29401c25b3f4966b6ee2b738a403260', '10.10.11.92:4446', '124703477049358', 40, 1247034830, 1),
('4b2448e1586c45c187b65c23a5f86103', '10.10.11.92:4444', '12470349598424', 41, 1247035024, 1),
('84a3394745f340069c332e12b98cd7c9', '10.10.11.92:4446', '12470349603990', 42, 1247035018, 1),
('b39b3393a7f6438280b2ebc5767ea2c9', '10.10.11.92:4446', '12470351272653', 43, 1247035151, 1),
('25f46a98682b410884af5823ff32b0ed', '10.10.11.92:4444', '124703512778864', 44, 1247035156, 1),
('80be420f831143a58e31cb991a2679c4', '10.10.11.92:4446', '124703520695185', 45, 1247035228, 1),
('2bef206ed59842739d81f118aa0f115d', '10.10.11.92:4444', '12470352073987', 46, 1247035232, 1),
('', '10.10.11.74:4446', '124704015115801', 47, 1247040273, 0),
('661c729055714f99821a61c1eb03b5f3', '10.10.11.74:4445', '124704015156627', 48, 1247040174, 1),
('', '10.10.11.74:4446', '124704030884440', 49, 1247040372, 0),
('77347febaa31415586770777f21869c0', '10.10.11.74:4445', '124704030925271', 50, 1247040327, 1),
('0e4ba674d9cd446aaab1a2d83a398650', '10.10.11.74:4445', '124704037989200', 51, 1247040407, 1),
('2b15065825d4477b96f2d681b038d286', '10.10.11.74:4444', '124704038033635', 52, 1247040397, 1),
('', '127.0.0.1:4444', '12471375196846', 53, 0, 0),
('', '10.10.11.74:4444', '124714354113133', 54, 0, 0),
('', '10.10.11.74:4444', '124722337618572', 55, 1247223500, 0),
('badc03f09b7e48c68e03281b6e63d5e0', '10.10.11.74:4444', '124722346475985', 56, 1247223527, 1),
('4179af84e90c4647b2500505b9bfc0de', '10.10.11.74:4444', '12472235281189', 57, 1247223591, 1),
('0f1fa894ac1d4f5ca870a3e799396d2e', '10.10.11.74:4444', '12472235478448', 58, 1247223605, 1),
('6fb0bf970f2c4f6e97fc117b5792bb44', '10.10.11.74:4444', '12472236144860', 59, 1247223672, 1),
('c1cc5882659c48d0b3cae23eacd54017', '10.10.11.74:4444', '124722367305239', 60, 1247223735, 1),
('aa4625ec7794426b9e37be51f158c196', '10.10.11.74:4444', '124722370424312', 61, 1247223758, 1),
('fc471a5618c64bb8a4f16239be159347', '10.10.11.74:4444', '124722375856509', 62, 1247223814, 1),
('efa9da32fec843d29a569e89d99e0128', '10.10.11.74:4446', '12472240389635', 63, 1247224094, 1),
('b1bb48de959b4b39bcedaffddbc19860', '10.10.11.74:4446', '124722418031624', 64, 1247224236, 1),
('9881e93babd54e629c7cb76d86e3932e', '10.10.11.74:4446', '124722425869479', 65, 1247224313, 1),
('5d00af7fc8b94f6abbf056bf8e824615', '10.10.11.74:4446', '12472247315418', 66, 1247224794, 1),
('9daff8922adb48c39d4f503b7ff9064f', '10.10.11.74:4446', '124722591564355', 67, 1247225945, 1),
('e39654d8052f475c90aabecc6186cf00', '10.10.11.74:4446', '124722598077866', 68, 1247225997, 1),
('df306e2102da4e14bf6c455c0ad4c71f', '10.10.11.74:4446', '124722720169189', 69, 1247227223, 1),
('7f909bab282045f2bdebec0e1f69e1b3', '10.10.11.74:4446', '124722744058782', 70, 1247227468, 1),
('1b43ccc087294efe80f5899b8d983da0', '10.10.11.74:4446', '124722789911189', 71, 1247227932, 1),
('ff22120f0ffd484193713ad1eb81274e', '10.10.11.74:4446', '12472279352449', 72, 1247227961, 1),
('2d45c3f731a64654bacd1ee726b89753', '10.10.11.74:4446', '124722809223268', 73, 1247228113, 1),
('36f54c8494234d19bd36ce21e07a4b4f', '10.10.11.74:4446', '124722811436797', 74, 1247228133, 1),
('cff313b8789446fabc3671d386310950', '10.0.0.5:4445', '124748441958875', 75, 1247484474, 1),
('', '10.0.0.5:4444', '124748442018434', 76, 1247484530, 0),
('0dd9bb32511347c28b5c418e022b1512', '10.0.0.5:4445', '124748447707893', 77, 1247484496, 1),
('a5cfaef5b25d450b95e2fefaafb3e672', '10.0.0.5:4445', '124748449806830', 78, 1247484523, 1),
('a738c6d4a5214d40b8e7cddde23382f7', '10.0.0.5:4445', '124748454768512', 79, 1247484574, 1),
('8fb04d56db2142a080c335508107e04c', '10.0.0.5:4445', '124748457614379', 80, 1247484591, 1),
('', '10.0.0.5:4445', '124748459362319', 81, 0, 0),
('a9140b8530114eed912ac0508551948a', '10.0.0.5:4445', '12474849948244', 82, 1247485032, 1),
('', '10.0.0.5:4444', '12474849949482', 83, 1247485107, 0),
('0f75da77c1b44d1bac58c1443e0489f7', '10.0.0.5:4445', '124748503441798', 84, 1247485052, 1),
('5f61c3ba69404760b974fc0d2610bb1d', '10.0.0.5:4445', '124748505306328', 85, 1247485086, 1),
('7c328ada830143c4be49a300b051c5a7', '10.0.0.5:4446', '124748522821260', 86, 1247485252, 1),
('7d83ad1454684c6dbb4886e7b7e08c8d', '10.0.0.5:4444', '12474852283205', 87, 1247485276, 1),
('dd2f7991a3ef4bc7bf8f46222c1eeba1', '10.0.0.5:4446', '124748525423308', 88, 1247485276, 1),
('e04819e03101427895de23ae0e8523a3', '10.0.0.5:4446', '12474852763598', 89, 1247485306, 1),
('', '10.0.0.5:4446', '12474863267370', 90, 1247486449, 0),
('e1bff2a032ee4fde8aca0f2f3083011e', '10.0.0.2:4444', '124748632688104', 91, 1247486393, 1),
('9c455d3169634d99bb62780524a913c3', '10.0.0.2:4445', '1247486327590', 92, 1247486379, 1),
('260b098992c848d181755729b212ac2e', '10.0.0.2:4446', '124748632715409', 93, 1247486369, 1),
('ab040daafd934f42a6f780f913c1684c', '10.0.0.5:4444', '124748632725379', 94, 1247486399, 1),
('9950c844e96e4b98b8301f8fd4a2e4c4', '10.0.0.2:4446', '124748637063290', 95, 1247486400, 1),
('a461c386b09d40e498fd7212b38dfc25', '10.0.0.2:4445', '12474863793167', 96, 1247486412, 1),
('e4fb4e64caab4cdc8fe236dc6f2b7b65', '10.0.0.2:4444', '12474863938368', 97, 1247486432, 1),
('0e1eb09f2e9b4515858b70a22c11567b', '10.0.0.5:4444', '1247486400654', 98, 1247486441, 1),
('eefb907e3c934ce7945d8235777bf7be', '10.0.0.2:4446', '12474864022857', 99, 1247486430, 1),
('', '10.0.0.2:4445', '124748641259258', 100, 1247486534, 0),
('0ba097bee5794893b6bf8675daf8d79f', '10.0.0.2:4446', '124748643112316', 101, 1247486464, 1),
('43e2aaff7e004ec9a39f0e0de51f3ce3', '10.0.0.2:4444', '124748643335865', 102, 1247486472, 1),
('a4a7908184f247f580f9243c1bea4f64', '10.0.0.5:4444', '12474864435398', 103, 1247486466, 1),
('85814c24ca6e4b058dba692b754f2797', '10.0.0.2:4444', '124748655818147', 104, 1247486609, 1),
('209a9666c528467985830863ed186165', '10.0.0.2:4445', '12474865584563', 105, 1247486609, 1),
('1ecf555f9edd43c8ae5a61690d5485b2', '10.0.0.2:4446', '124748655861365', 106, 1247486592, 1),
('8fb7c1685b5746c49acccdf0a7bd8f51', '10.0.0.2:4446', '124748659465476', 107, 1247486620, 1),
('', '10.0.0.2:4444', '124748661194970', 108, 1247486733, 0),
('dbc89ac4a4e1409eb0b777376672d14c', '10.0.0.2:4445', '124748661219739', 109, 1247486637, 1),
('2dec018d66e44fb8a61464d8d8e61a70', '10.0.0.2:4446', '12474866214878', 110, 1247486647, 1),
('b1cd0eb9eb8445608cdd10fae6fd9b64', '10.0.0.2:4445', '124748663883409', 111, 1247486667, 1),
('af9a3bdd2e754353a098720d4f03c0c9', '10.0.0.2:4446', '124748665013477', 112, 1247486673, 1),
('a88975a80bbb4aea93c40c2de782fcda', '10.0.0.2:4445', '124748666804640', 113, 1247486690, 1),
('cad8b43f966c4ce390e0d0aed286a3f5', '10.0.0.2:4446', '124748667568373', 114, 1247486702, 1),
('b41eaa7a7de749d48c42099a6a06e640', '10.0.0.2:4445', '124748669216426', 115, 1247486721, 1),
('7f82d111eff34914bb81c5fe270fee8c', '10.0.0.2:4446', '12474867043139', 116, 1247486721, 1),
('56d02c357f674da3a657cf7f53fd22a2', '10.0.0.2:4445', '124748672262359', 117, 1247486743, 1),
('094e38369e1d4f9fba80f28986fd91a4', '10.0.0.2:4444', '124748703283304', 118, 1247487082, 1),
('eca0a48c06614004a1ac416de4d0d27d', '10.0.0.2:4445', '124748703324594', 119, 1247487078, 1),
('3299a646cf94496ba2fd4a30aa903c59', '10.0.0.2:4446', '124748703344772', 120, 1247487064, 1),
('a1e77ea5aa5a4e0ebfeefd1ec323b196', '10.0.0.2:4446', '12474870679758', 121, 1247487096, 1),
('4f2f1a5d9f5442e29c696878ce3ee3a4', '10.0.0.2:4445', '124748708039626', 122, 1247487107, 1),
('343ca6e96bc74529976d76668bbf7247', '10.0.0.2:4444', '124748708371270', 123, 1247487111, 1),
('72c030f4905943fe9f555e2533da6c03', '10.0.0.2:4446', '124748709869785', 124, 1247487127, 1),
('162fe75d631f4fbbaa5b97df96adf8fa', '10.0.0.2:4445', '124748711014190', 125, 1247487141, 1),
('45a65b14fa1e4598bdee1d219e602a61', '10.0.0.2:4444', '124748711305634', 126, 1247487142, 1),
('b8bc8ed861d2411da95102e0f1327b4e', '10.0.0.2:4446', '124748712722671', 127, 1247487154, 1),
('4328e72e812f487fa4d82ea42b2b630f', '10.0.0.2:4445', '124748714252780', 128, 1247487169, 1),
('56bb616859744d3fb9f8bb4246a44d94', '10.0.0.2:4444', '124748714506708', 129, 1247487178, 1),
('d28ac444825b4f9e97a6c2b2f6aa17d0', '10.0.0.2:4446', '124748715432796', 130, 1247487177, 1),
('557037889d534f719b818b38874c45e7', '10.0.0.2:4445', '124748717049890', 131, 1247487194, 1),
('05ff7cac86f545e8aa5cd0b2f10c0121', '10.0.0.2:4444', '124748728313976', 132, 1247487318, 1),
('22b5d5334d8446969c5807253d73b484', '10.0.0.2:4445', '124748728335152', 133, 1247487328, 1),
('ea6d65735cd64fc2805c3949c95a0cd5', '10.0.0.2:4446', '1247487283680', 134, 1247487316, 1),
('cb5c3617ff674aa88a642a8a580c3e87', '10.0.0.2:4446', '124748731692521', 135, 1247487346, 1),
('37e9b4fc052f4b07ac10686e9be3375b', '10.0.0.2:4444', '12474873202691', 136, 1247487345, 1),
('e5ed938dc8eb49f69a9e2c4c97952124', '10.0.0.2:4445', '124748732965869', 137, 1247487350, 1),
('d13f4c1f035643fd98ca9eec8d2627ba', '10.0.0.2:4444', '124748734693958', 138, 1247487359, 1),
('6c30fed4b6474889bc6e75a50ebac383', '10.0.0.2:4446', '12474873472658', 139, 1247487381, 1),
('7b5317f60ffa443e976aafad5e5ef75b', '10.0.0.2:4445', '124748735271346', 140, 1247487363, 1),
('20ebbc977f9e44f192355eebbc650228', '10.0.0.2:4444', '124748736075700', 141, 1247487389, 1),
('bfb6ee6d6dc04a3f9e534815472ecb86', '10.0.0.2:4445', '124748736346395', 142, 1247487391, 1),
('6eaf4611bd9d46c6ad2af414fdc8df46', '10.0.0.2:4446', '124748738266895', 143, 1247487412, 1),
('14a6be2d14514a79bce7928d531d39d5', '10.0.0.2:4444', '124748738972458', 144, 1247487413, 1),
('629f9bb3032340dfbe8a1a5a7f865724', '10.0.0.2:4445', '124748739202991', 145, 1247487418, 1),
('207895fcd7b44458a27e5ebd7ec668b3', '10.0.0.2:4445', '124748744739862', 146, 1247487481, 1),
('c952d1496b5c44c0b4d5d19fb07ff003', '10.0.0.2:4445', '124748748267325', 147, 1247487517, 1),
('bab84b6012dc44738729e8bbb3071f0d', '10.0.0.2:4445', '124748752018647', 148, 1247487546, 1),
('482dcb89184b4840acbbafb01b66e16f', '10.0.0.2:4445', '124748754803583', 149, 1247487574, 1),
('6b2951f5e413475db01c34f3170b8952', '10.0.0.2:4445', '124748757718326', 150, 1247487595, 1),
('864fd42eaec24a9198abf26e99d14dd3', '10.0.0.2:4445', '124748759724542', 151, 1247487619, 1),
('89233aab3e74497f96a7a600520aa378', '10.0.0.2:4445', '124748762356630', 152, 1247487648, 1),
('a971fdd89bb7489a964c3d0f7f99f316', '10.0.0.2:4445', '124748765184823', 153, 1247487680, 1),
('885e022848714e9da43fb02c7ec083ca', '10.0.0.2:4445', '124748768208257', 154, 1247487704, 1),
('fc808384270a422584c355852e465499', '10.0.0.2:4445', '124748770683640', 155, 1247487736, 1),
('0170a78533d9482291fab73c349b24fd', '10.0.0.2:4445', '124748773902627', 156, 1247487761, 1),
('4ddbac62fe724928a21f08d22f33a1a5', '10.0.0.2:4445', '124748776297553', 157, 1247487792, 1),
('088a473cf77240c2a625d261b212fefa', '10.0.0.2:4445', '124748779562625', 158, 1247487813, 1),
('61e90e03b6f64fda94e45ca16c3e4cfe', '10.0.0.2:4445', '124748781496213', 159, 1247487837, 1),
('0753afd0e6b943b3a488c3b9ee60b0c6', '10.0.0.2:4444', '124748796936815', 160, 1247488004, 1),
('25e2bd25e562486aaf77a5b29dc559ba', '10.0.0.2:4445', '124748796969603', 161, 1247488008, 1),
('99b52b6a3b014e8d8cf30438a0c6bf46', '10.0.0.2:4446', '124748796992519', 162, 1247488002, 1),
('bb807980962a4534a22c1a65f298b31b', '10.0.0.2:4444', '124748800501625', 163, 1247488041, 1),
('6db7a237eefb414e9069249ee65ef025', '10.0.0.2:4446', '124748800523537', 164, 1247488036, 1),
('e5951a5404844f23972e5057a6c3c153', '10.0.0.2:4445', '124748801017118', 165, 1247488040, 1),
('64ccfd5946934c8b868fd45eb098c920', '10.0.0.2:4446', '124748803804271', 166, 1247488075, 1),
('0adb4da6e9dc4a9f9761c31d789c84f7', '10.0.0.2:4444', '124748818192949', 167, 1247488231, 1),
('e1d3f2d19689493dbfa53d23cafe0daa', '10.0.0.2:4445', '124748818214489', 168, 1247488230, 1),
('a6a296cf09374989bcaa7e1593c0200c', '10.0.0.2:4446', '124748818234368', 169, 1247488214, 1),
('7820d7cd046d468ab8e487ee4b0bf152', '10.0.0.2:4446', '124748821537429', 170, 1247488245, 1),
('ad555113d6db43178e2c05cd80f528cc', '10.0.0.2:4445', '124748823143444', 171, 1247488261, 1),
('10bfa5747c39476fab5bf931fa5c1070', '10.0.0.2:4444', '124748823458309', 172, 1247488259, 1),
('337c7dd055094d0da0880393b64358c8', '10.0.0.2:4446', '124748824615331', 173, 1247488294, 1),
('890864bb09884e3bbe8d1dba88df066d', '10.0.0.2:4444', '124748826017737', 174, 1247488291, 1),
('9015eb8a919e4e06935ce3c470cae4ce', '10.0.0.2:4445', '12474882630423', 175, 1247488289, 1),
('1a4ea55539654820ba6d86b042e567f8', '10.0.0.2:4444', '124748829192284', 176, 1247488320, 1),
('664ace48514248529c9851403af1a223', '10.0.0.2:4445', '124748829212112', 177, 1247488322, 1),
('71097fed8cb04b1a9006f6e4d7006744', '10.0.0.2:4446', '124748829702245', 178, 1247488327, 1),
('e3cb8724a5bd42f7849c9a06f516fc8c', '10.0.0.2:4444', '124748832248531', 179, 1247488344, 1),
('246cc8596f9d4af9819f8970efdd610e', '10.0.0.2:4445', '124748832496381', 180, 1247488349, 1),
('0b18efa1c8404ad8897c53b9fb8d1c22', '10.0.0.2:4444', '124748841284306', 181, 1247488433, 1),
('435a75c3a523436aba00ea34ee6dcacf', '10.0.0.2:4444', '124748843345674', 182, 1247488459, 1),
('ac59ff9b07f14621a3e05d78ccb75fb7', '10.0.0.2:4444', '124748846291310', 183, 1247488488, 1),
('f7b3bb1d3a7b48649a7a1559ee482151', '10.0.0.2:4444', '12474884890270', 184, 1247488516, 1),
('8254a7b5a2ab4ecd831f049179fd14de', '10.0.0.2:4444', '1247488519215', 185, 1247488542, 1),
('e0f8e40167a448f681809a4b395303de', '10.0.0.2:4444', '124748854466241', 186, 1247488569, 1),
('52aaf1bafc89415aac06c05a3e3cacdb', '10.0.0.2:4444', '124748857022203', 187, 1247488608, 1),
('6d855237e81b447ca2491d1932650efb', '10.0.0.2:4444', '12474888398721', 188, 1247488859, 1),
('254474dda3f24301b4067033211feeb2', '10.0.0.2:4444', '12474888631430', 189, 1247488887, 1),
('c63487c3a4284873b4d2d8f2b18c40f1', '10.0.0.2:4444', '124748888795988', 190, 1247488913, 1),
('4fe62845c9ae4b58a2b6852e366e8698', '10.0.0.2:4444', '124748891393881', 191, 1247488942, 1),
('6851fc38dc5b4536955fcda4f8552954', '10.0.0.2:4444', '124748894343136', 192, 1247488961, 1),
('63b78244655042e0b594f6acdefa25ce', '10.0.0.2:4444', '124748896339539', 193, 1247488987, 1),
('5219db30f2414c66a2982802d48bfa8d', '10.0.0.2:4444', '124748898854261', 194, 1247489020, 1),
('75971df8f20b4cb28b93be6798419e28', '10.0.0.2:4444', '124748904378792', 195, 1247489067, 1),
('f5c51eb3ab1a4adf8ed88276977c351e', '10.0.0.5:4445', '124748904409429', 196, 1247489089, 1),
('6fea7460159b403fae2d38edf3651f9d', '10.0.0.2:4444', '124748907181247', 197, 1247489097, 1),
('9a5b32cf0bdc4805b7548c87decf5ab7', '10.0.0.5:4445', '124748909239611', 198, 1247489125, 1),
('71c7ad95b34d43c7a8e2b1dd9006c6e2', '10.0.0.2:4444', '124748909811920', 199, 1247489118, 1),
('21c65b15fd2b4ec6a6529c14ad707d61', '10.0.0.2:4444', '124748912088620', 200, 1247489145, 1),
('bb8c3f6ae9bb42b69c281ee15b1e760d', '10.0.0.5:4445', '12474891289753', 201, 1247489163, 1),
('c10d14ec8ece448ba28d43efa504cce2', '10.0.0.2:4444', '12474892067740', 202, 1247489231, 1),
('392d5d2a1e5747109c51bc0abd2b6d56', '10.0.0.2:4445', '124748920698647', 203, 1247489240, 1),
('d9ec46d148f64147a5516739ddd558b7', '10.0.0.5:4445', '124748920727393', 204, 1247489247, 1),
('8fc32b3e013943dba805704e0138aa92', '10.0.0.2:4444', '124748923175231', 205, 1247489272, 1),
('76a99c0b9422403cac06ae42348329f2', '10.0.0.2:4445', '124748924218428', 206, 1247489262, 1),
('0bc11b96e949405595a7ec5325f19271', '10.0.0.5:4445', '12474892494740', 207, 1247489281, 1),
('7185f99d22934caf9d3bb7a696fe8ffb', '10.0.0.2:4445', '12474892629357', 208, 1247489273, 1),
('a771bb6034de4d45a9ba4dbc4201e1be', '10.0.0.2:4445', '124748964313949', 209, 1247489687, 1),
('df206c252d21437aa457482fd8174eb8', '10.0.0.5:4445', '124748964358912', 210, 1247489693, 1),
('10c52bc6ee20458ca3f6e55e909bea8a', '10.0.0.2:4445', '124748968937479', 211, 1247489719, 1),
('a3e412a788514c7aa2863df90068ec28', '10.0.0.5:4445', '124748969401789', 212, 1247489726, 1),
('d0041065d94c4700a269e0369e516f6a', '10.0.0.2:4445', '124748972071546', 213, 1247489745, 1),
('13a26a4320784498a906f996e1027514', '10.0.0.5:4445', '124748972872408', 214, 1247489753, 1),
('2949adcf0bca4ed793145c8c89689f4e', '10.0.0.2:4445', '124748974779709', 215, 1247489778, 1),
('1a0cb3a7f7754f2b812d9fadd4e25290', '10.0.0.5:4445', '124748975503656', 216, 1247489787, 1),
('f9778e49434e4a3b9a6e789fb28520d8', '10.0.0.2:4445', '124748978239619', 217, 1247489809, 1),
('872166941bb24c65bb192eb14a6a2bfd', '10.0.0.5:4445', '1247489789638', 218, 1247489824, 1),
('f2f605c2805f40e593f2216c7fb55fb3', '10.0.0.2:4445', '124748980985773', 219, 1247489837, 1),
('c86026207e124a8f95af97dd6d024e52', '10.0.0.5:4445', '124748982622427', 220, 1247489857, 1),
('f03074f30d3448f790ad788cc20c5fa9', '10.0.0.2:4445', '124748983881260', 221, 1247489862, 1),
('f1332826450c4560acd53403bcb51f2f', '10.0.0.5:4445', '124748985962819', 222, 1247489881, 1),
('f4ceb3b84d104c3eb3c4a906d5ef89c4', '10.10.11.65:4444', '124756724197553', 223, 1247567277, 1),
('d164d3d1810a46d594bfbcd6d18b5a58', '10.10.11.65:4444', '124756727806174', 224, 1247567295, 1),
('4015bc00c3464b5ea6acf7db2ade5354', '10.10.11.65:4444', '124756729598387', 225, 1247567313, 1),
('2e2c942a3d87463d87366f02cc207154', '10.10.11.65:4444', '124756742763466', 226, 1247567450, 1),
('20842fe04da94590b966fe59e5aba1f6', '10.10.11.65:4444', '12475674518616', 227, 1247567468, 1),
('88380181118f4d7bb6250fe5cc9cf720', '10.10.11.65:4444', '124756746995269', 228, 1247567495, 1),
('f87fa63b489349d89df651ad0ecca968', '10.10.11.65:4444', '124756765727791', 229, 1247567675, 1),
('47bdc16dea98430a8b9d8efe1c6621c5', '10.10.11.65:4444', '124756767676795', 230, 1247567693, 1),
('6b82c17aa1bd4d1f9c1b6d67878df3d7', '10.10.11.65:4444', '124756769501932', 231, 1247567719, 1),
('a65c9e86a9fc4d94937316ce32db1612', '10.10.11.65:4444', '12475677624233', 232, 1247567781, 1),
('6000753bddc54a168230a13f82e8ae60', '10.10.11.65:4444', '124756778178863', 233, 1247567799, 1),
('8f528254c33a462a87e4a44e6438808f', '10.10.11.65:4444', '124756780003995', 234, 1247567825, 1),
('f8f2029b68a641bdb2f3ece99c6a1998', '10.10.11.65:4444', '124756821519587', 235, 1247568240, 1),
('', '10.10.11.92:4444', '124756821551886', 236, 0, 0),
('24e463a425d04ae087f16a94c3089d0a', '10.10.11.92:4445', '124756821577620', 237, 1247568286, 1),
('', '10.10.11.92:4446', '124756821639377', 238, 0, 0),
('47627a1956ab48aca92b1582d3d9c9b8', '10.10.11.65:4444', '12475682428942', 239, 1247568263, 1),
('9814c9e8f03740ef8512061e973dc0b2', '10.10.11.65:4444', '124756826659645', 240, 1247568286, 0),
('3bfa8f627952464fb6afa7ff465b1c2c', '10.10.11.65:4444', '124756839193530', 241, 1247568412, 1),
('0dfafe19499946e5b7b68ff547f42a71', '10.10.11.92:4444', '12475683923498', 242, 1247568431, 1),
('af2740e15d704706b29864e95cffc5e6', '10.10.11.65:4444', '124756841296466', 243, 1247568431, 1),
('95af23e37a0b4e3db79c0c3e926e0ec8', '10.10.11.92:4444', '124756843227651', 244, 1247568462, 1),
('940a1b930cdc4b0aacb77c29108a7292', '10.10.11.65:4444', '12475684326587', 245, 1247568459, 1),
('58ccb6fd4b684c329e5bb45218fe276f', '10.10.11.65:4444', '12475690901514', 1, 1247569110, 1),
('520f484ec567409f82372ff1ffa1c1a1', '10.10.11.65:4444', '124756911446219', 2, 1247569132, 1),
('f2de6b91eaf84db5b08543fa52131bbc', '10.10.11.65:4444', '1247569132687', 3, 1247569158, 1),
('4148a28d5e1a4964b6cc1511adc92455', '10.10.11.65:4444', '124756940534482', 4, 1247569426, 1),
('34791a0f662c43e9b1e7d1240184bedd', '10.10.11.65:4444', '12475694301736', 5, 1247569449, 1),
('138dafafcff641fa87a9d31d70a310d1', '10.10.11.65:4444', '124756945289417', 6, 1247569480, 1),
('95aecaff79d74fc795e2f9e0cfa0c786', '10.10.11.65:4444', '124757005456727', 7, 1247570083, 1),
('9deb732467194a379cbaa5757e49722b', '10.10.11.65:4444', '124757008394283', 8, 1247570101, 1),
('d9be2e69537846be805335c0d3398d83', '10.10.11.65:4444', '12475701020720', 9, 1247570127, 1),
('366b67167df44687a96395079414dd10', '10.10.11.65:4444', '124757013148499', 10, 1247570149, 1),
('2c7d7d6fe3364087a1d1d32c83f6a7fd', '10.10.11.65:4444', '124757015103623', 11, 1247570176, 1),
('3fd85f2779a3471ca6259202e2280c95', '10.10.11.65:4444', '124757017954549', 12, 1247570198, 1),
('25f83b55011a472a919af6f707a37e20', '10.10.11.65:4444', '124757019936326', 13, 1247570220, 1),
('cd340eaf16d345b2865191d249ab1a9e', '10.10.11.65:4444', '124757022318866', 14, 1247570240, 1),
('940257ec37ed4e8795d72be2b542c5d3', '10.10.11.65:4444', '124757024193392', 15, 1247570277, 1),
('ce45d36376dd46f9ad47c3426f763eea', '10.10.11.65:4444', '12475702796978', 16, 1247570312, 1),
('ded957cdf27844b186fcc8d9e109631f', '10.10.11.65:4444', '124757036292301', 17, 1247570381, 1),
('1c55c60d0a2c46f580af08802d96cdf8', '10.10.11.65:4444', '124757038235254', 18, 1247570399, 1),
('bcf7e4d031104ce8a94d12456db5bf7f', '10.10.11.65:4444', '124757040044503', 19, 1247570425, 1),
('002bbedb652d43ce89d64f23baec603a', '10.10.11.65:4444', '12475704297661', 20, 1247570447, 1),
('96c89703712041f08ae915f59bbc6214', '10.10.11.65:4444', '124757044943165', 21, 1247570474, 1),
('0cb42e0c375d4dcd83399ab19e7eba8a', '10.10.11.65:4444', '124757047799507', 22, 1247570495, 1),
('a960fe05e68d49aaaaac769985009976', '10.10.11.65:4444', '124757049773926', 23, 1247570515, 1),
('ecf2f3309e534d7ebaf5be3749f2d91d', '10.10.11.65:4444', '124757051862194', 24, 1247570535, 1),
('c2e89282d3a044b8b02ccc0d5f4515d2', '10.10.11.65:4444', '124757053731637', 25, 1247570571, 1),
('5465449b39e74c1794839f7fee89f972', '10.10.11.65:4444', '124757057231970', 26, 1247570604, 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `project_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=58 ;

--
-- Data dump for tabellen `sites`
--

INSERT INTO `sites` (`id`, `name`, `project_id`) VALUES
(36, 'http://www.krak.dk', 123),
(37, 'http://www.google.dk', 123),
(38, 'http://www.eniro.dk', 125),
(40, 'http://www.eniro.se', 123),
(41, 'http://www.eniro.fi', 123),
(42, 'http://www.eniro.se', 131),
(53, 'http://www.eniro.dk', 131),
(45, 'http://localhost', 132),
(57, 'http://www.eniro.fi', 131);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `suites`
--

CREATE TABLE IF NOT EXISTS `suites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `timedate` datetime DEFAULT NULL,
  `timetaken` int(10) unsigned DEFAULT NULL,
  `selenium_version` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci DEFAULT NULL,
  `project_id` int(11) NOT NULL DEFAULT '0',
  `analysis` tinyint(1) NOT NULL,
  `status` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT 'failed',
  `browser_id` int(10) NOT NULL,
  `operating_system_id` int(10) NOT NULL,
  `selenium_revision` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `operating_system_id` (`operating_system_id`),
  KEY `browser_id` (`browser_id`),
  KEY `project_id` (`project_id`),
  KEY `site_id` (`site_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Data dump for tabellen `suites`
--

INSERT INTO `suites` (`id`, `name`, `site_id`, `timedate`, `timetaken`, `selenium_version`, `project_id`, `analysis`, `status`, `browser_id`, `operating_system_id`, `selenium_revision`) VALUES
(1, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(2, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(3, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(4, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(5, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(6, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(7, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, ''),
(8, 'alalal', 42, NULL, NULL, NULL, 131, 0, 'failed', 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `testcases`
--

CREATE TABLE IF NOT EXISTS `testcases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `project_id` int(11) NOT NULL,
  `description` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=147 ;

--
-- Data dump for tabellen `testcases`
--

INSERT INTO `testcases` (`id`, `name`, `project_id`, `description`) VALUES
(30, 'Browsers: index', 132, ''),
(31, 'Browsers: view', 132, ''),
(32, 'Browsers: add', 132, ''),
(33, 'Browsers: edit', 132, ''),
(29, 'Test 1326_3', 131, 0x687474703a2f2f636173656d616e2e656e69726f2e636f6d2f62726f7773652f544553542d31333236),
(20, 'Testcase 1', 123, ''),
(21, 'Testcase 2', 123, ''),
(22, 'Testcase 3', 123, ''),
(4, 'Testcase 4', 125, 0x736466736466),
(7, 'multiple map hits', 123, 0x6173617364617364),
(9, 'single map hit ', 123, 0x676666),
(27, 'Test 1326_1', 131, 0x687474703a2f2f636173656d616e2e656e69726f2e636f6d2f62726f7773652f544553542d31333236),
(25, 'Test 1296', 131, 0x687474703a2f2f636173656d616e2e656e69726f2e636f6d2f62726f7773652f544553542d31323936),
(26, 'Test 1326_4', 131, 0x687474703a2f2f636173656d616e2e656e69726f2e636f6d2f62726f7773652f544553542d31333236),
(28, 'Test 1326_2', 131, 0x687474703a2f2f636173656d616e2e656e69726f2e636f6d2f62726f7773652f544553542d31333236),
(23, 'Testcase 4', 123, ''),
(24, 'Testcase 5', 123, ''),
(34, 'Browsers: delete', 132, ''),
(35, 'Commands: index', 132, ''),
(36, 'Commands: belongsToProject', 132, ''),
(37, 'Commands: view', 132, ''),
(38, 'Commands: add', 132, ''),
(39, 'Commands: edit', 132, ''),
(40, 'Commands: delete', 132, ''),
(41, 'Groups: index', 132, ''),
(42, 'Groups: view', 132, ''),
(43, 'Groups: add', 132, ''),
(44, 'Groups: edit', 132, ''),
(45, 'Groups: delete', 132, ''),
(46, 'ManageAcl: index', 132, ''),
(47, 'ManageAcl: listAros', 132, ''),
(48, 'ManageAcl: listAcos', 132, ''),
(49, 'ManageAcl: createAcl', 132, ''),
(50, 'ManageAcl: removeAcl', 132, ''),
(51, 'Menus: index', 132, ''),
(52, 'Menus: view', 132, ''),
(53, 'Menus: add', 132, ''),
(54, 'Menus: edit', 132, ''),
(55, 'Menus: delete', 132, ''),
(56, 'Myacos: index', 132, ''),
(57, 'Myacos: view', 132, ''),
(58, 'Myacos: add', 132, ''),
(59, 'Myacos: edit', 132, ''),
(60, 'Myacos: delete', 132, ''),
(61, 'Myaros: index', 132, ''),
(62, 'Myaros: view', 132, ''),
(63, 'Myaros: add', 132, ''),
(64, 'Myaros: edit', 132, ''),
(65, 'Myaros: delete', 132, ''),
(66, 'News: index', 132, ''),
(67, 'Nodes: index', 132, ''),
(68, 'Nodes: view', 132, ''),
(69, 'Nodes: add', 132, ''),
(70, 'Nodes: edit', 132, ''),
(71, 'Nodes: delete', 132, ''),
(72, 'Operatingsystems: index', 132, ''),
(73, 'Operatingsystems: view', 132, ''),
(74, 'Operatingsystems: add', 132, ''),
(75, 'Operatingsystems: edit', 132, ''),
(76, 'Operatingsystems: delete', 132, ''),
(77, 'Projects: index', 132, ''),
(78, 'Projects: view', 132, ''),
(79, 'Projects: testlabsview', 132, ''),
(80, 'Projects: add', 132, ''),
(81, 'Projects: edit', 132, ''),
(82, 'Projects: delete', 132, ''),
(83, 'Projects: select', 132, ''),
(84, 'Requirements: reorder', 132, ''),
(85, 'Requirements: updatetc', 132, ''),
(86, 'Requirements: updateCombination', 132, ''),
(87, 'Requirements: index', 132, ''),
(88, 'Requirements: view', 132, ''),
(89, 'Requirements: testlabview', 132, ''),
(90, 'Requirements: add', 132, ''),
(91, 'Requirements: edit', 132, ''),
(92, 'Requirements: delete', 132, ''),
(93, 'Runrctests: runAndViewTestcase', 132, ''),
(94, 'Runrctests: runAndViewRequirement', 132, ''),
(95, 'Runrctests: runRequirement', 132, ''),
(96, 'Runrctests: runTestcase', 132, ''),
(97, 'Runrctests: stateOfTheSystem', 132, ''),
(98, 'Seleniumserver: driver', 132, ''),
(99, 'Seleniumserver: executeCommand', 132, ''),
(100, 'Sites: select', 132, ''),
(101, 'Sites: index', 132, ''),
(102, 'Sites: view', 132, ''),
(103, 'Sites: add', 132, ''),
(104, 'Sites: edit', 132, ''),
(105, 'Sites: delete', 132, ''),
(106, 'Suites: index', 132, ''),
(107, 'Suites: view', 132, ''),
(108, 'Suites: add', 132, ''),
(109, 'Suites: edit', 132, ''),
(110, 'Suites: delete', 132, ''),
(111, 'Testcasesteps: index', 132, ''),
(112, 'Testcasesteps: reorder', 132, ''),
(113, 'Testcasesteps: view', 132, ''),
(114, 'Testcasesteps: add', 132, ''),
(115, 'Testcasesteps: edit', 132, ''),
(116, 'Testcasesteps: delete', 132, ''),
(117, 'Testcases: index', 132, ''),
(118, 'Testcases: lilist', 132, ''),
(119, 'Testcases: view', 132, ''),
(120, 'Testcases: testlabview', 132, ''),
(121, 'Testcases: viewscript', 132, ''),
(122, 'Testcases: add', 132, ''),
(123, 'Testcases: edit', 132, ''),
(124, 'Testcases: upload', 132, ''),
(125, 'Testcases: delete', 132, ''),
(126, 'Testcases: addToJira', 132, ''),
(127, 'Testlabs: index', 132, ''),
(128, 'Tests: index', 132, ''),
(129, 'Tests: view', 132, ''),
(130, 'Tests: add', 132, ''),
(131, 'Tests: edit', 132, ''),
(132, 'Tests: delete', 132, ''),
(133, 'Types: index', 132, ''),
(134, 'Types: view', 132, ''),
(135, 'Types: add', 132, ''),
(136, 'Types: edit', 132, ''),
(137, 'Types: delete', 132, ''),
(138, 'Uploadtests: add', 132, ''),
(139, 'Users: assign', 132, ''),
(140, 'Users: login', 132, ''),
(141, 'Users: logout', 132, ''),
(142, 'Users: index', 132, ''),
(143, 'Users: view', 132, ''),
(144, 'Users: add', 132, ''),
(145, 'Users: edit', 132, ''),
(146, 'Users: delete', 132, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `testcasesteps`
--

CREATE TABLE IF NOT EXISTS `testcasesteps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderby` int(11) NOT NULL,
  `action` text COLLATE utf8_bin NOT NULL,
  `reaction` text COLLATE utf8_bin NOT NULL,
  `testcase_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `testcase_id` (`testcase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=45 ;

--
-- Data dump for tabellen `testcasesteps`
--

INSERT INTO `testcasesteps` (`id`, `orderby`, `action`, `reaction`, `testcase_id`) VALUES
(1, 0, 0x4f70656e20687474703a2f2f7777772e6d79736974652e636f6d, 0x53697465206f70656e73, 1),
(2, 1, 0x547970652068656c6c6f20776f726c6420696e20746865207365617263682074657874206669656c6420616e6420636c69636b20736561726368, 0x54686520736974652073686f77732074686520726573756c742070616765, 1),
(35, 6, 0x6173736572742074686174202748656c6c6f20776f726c642070726f6772616d272074657874206973204e4f542070726573656e74, '', 2),
(31, 4, 0x636c69636b2061742074686520666972737420726573756c74, 0x612077696b692070616765206f70656e73, 2),
(29, 2, 0x74797065205c2768656c6c6f20776f726c645c2720696e20736561726368206669656c64, '', 2),
(11, 1, 0x6f70656e20676f6f676c652e646b, 0x73697465206f70656e73, 2),
(30, 3, 0x636c69636b2073656172636820627574746f6e, 0x726573756c7420706167652069732073686f776e, 2),
(18, 3, 0x7665726966792066697273745f68656164696e67206973202748656c6c6f20576f726c642050726f6772616d27, '', 1),
(20, 2, 0x636c69636b2061742074686520666972737420726573756c7420696e2074686520726573756c742070616765, 0x746865206c696e6b20746f2077696b69206f70656e73, 1),
(24, 2, 0x353535, 0x353535, 6),
(23, 1, 0x363636, 0x363636, 6),
(32, 5, 0x6173736572742074686174205c2748656c6c6f20776f726c642070726f6772616d5c2720746578742069732070726573656e74, '', 2),
(36, 4, 0x7a6667686a6b68676664736161, 0x73646667686a76626378, 1),
(39, 0, 0x686868, 0x6868686d6d6d6d, 18),
(38, 2, 0x776565, 0x726565, 8),
(40, 1, 0x6666, 0x666666, 18),
(41, 2, 0x3434, 0x3535, 18),
(42, 1, 0x6669737466697374, 0x6a616a61, 19),
(44, 1, 0x7479, 0x6667, 7);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci DEFAULT NULL,
  `name` varchar(45) CHARACTER SET latin1 COLLATE latin1_danish_ci DEFAULT NULL,
  `suite_id` int(10) unsigned DEFAULT NULL,
  `manstatus` varchar(255) CHARACTER SET latin1 NOT NULL,
  `browser_id` int(11) NOT NULL,
  `operatingsystem_id` int(11) NOT NULL,
  `testcase_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `testcase_id` (`testcase_id`),
  KEY `operatingsystem_id` (`operatingsystem_id`),
  KEY `browser_id` (`browser_id`),
  KEY `suite_id` (`suite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=42 ;

--
-- Data dump for tabellen `tests`
--

INSERT INTO `tests` (`id`, `status`, `name`, `suite_id`, `manstatus`, `browser_id`, `operatingsystem_id`, `testcase_id`, `timestamp`) VALUES
(1, 'passed', 'Test 1326_1', 1, '', 2, 7, 27, '0000-00-00 00:00:00'),
(2, 'passed', 'Test 1326_1', 1, '', 3, 7, 27, '0000-00-00 00:00:00'),
(3, 'passed', 'Test 1326_3', 1, '', 2, 7, 29, '0000-00-00 00:00:00'),
(4, 'passed', 'Test 1326_1', 3, '', 2, 7, 27, '0000-00-00 00:00:00'),
(5, 'passed', 'Test 1326_1', 3, '', 3, 7, 27, '0000-00-00 00:00:00'),
(6, 'passed', 'Test 1326_3', 3, '', 2, 7, 29, '0000-00-00 00:00:00'),
(7, 'passed', 'Test 1326_1', 5, '', 2, 7, 27, '0000-00-00 00:00:00'),
(8, 'passed', 'Test 1326_1', 5, '', 3, 7, 27, '0000-00-00 00:00:00'),
(9, 'passed', 'Test 1326_3', 5, '', 2, 7, 29, '0000-00-00 00:00:00'),
(10, 'passed', 'Test 1326_3', 5, '', 3, 7, 29, '0000-00-00 00:00:00'),
(11, 'passed', 'Test 1326_4', 5, '', 2, 7, 26, '0000-00-00 00:00:00'),
(12, 'passed', 'Test 1326_4', 5, '', 3, 7, 26, '0000-00-00 00:00:00'),
(13, 'passed', 'Test 1326_2', 5, '', 2, 7, 28, '0000-00-00 00:00:00'),
(14, 'passed', 'Test 1326_2', 5, '', 3, 7, 28, '0000-00-00 00:00:00'),
(15, 'failed', 'Test 1296', 5, '', 2, 7, 25, '0000-00-00 00:00:00'),
(16, 'passed', 'Test 1296', 5, '', 3, 7, 25, '0000-00-00 00:00:00'),
(17, 'passed', 'Test 1326_1', 7, '', 2, 7, 27, '0000-00-00 00:00:00'),
(18, 'passed', 'Test 1326_1', 7, '', 3, 7, 27, '0000-00-00 00:00:00'),
(19, 'passed', 'Test 1326_3', 7, '', 2, 7, 29, '0000-00-00 00:00:00'),
(20, 'passed', 'Test 1326_3', 7, '', 3, 7, 29, '0000-00-00 00:00:00'),
(21, 'passed', 'Test 1326_4', 7, '', 2, 7, 26, '0000-00-00 00:00:00'),
(22, 'passed', 'Test 1326_4', 7, '', 3, 7, 26, '0000-00-00 00:00:00'),
(23, 'passed', 'Test 1326_2', 7, '', 2, 7, 28, '0000-00-00 00:00:00'),
(24, 'passed', 'Test 1326_2', 7, '', 3, 7, 28, '0000-00-00 00:00:00'),
(25, 'failed', 'Test 1296', 7, '', 2, 7, 25, '0000-00-00 00:00:00'),
(26, 'passed', 'Test 1296', 7, '', 3, 7, 25, '0000-00-00 00:00:00'),
(27, NULL, 'Test Test', 9, '', 1, 1, 31, '0000-00-00 00:00:00'),
(28, 'failed', 'Test Test', 11, '', 1, 1, 31, '0000-00-00 00:00:00'),
(29, 'passed', 'Test Test', 11, '', 7, 1, 31, '0000-00-00 00:00:00'),
(30, 'failed', 'Test 1296', 11, '', 1, 1, 25, '0000-00-00 00:00:00'),
(31, 'passed', 'Test 1296', 11, '', 7, 1, 25, '0000-00-00 00:00:00'),
(32, 'passed', 'Test 1326_2', 11, '', 1, 1, 28, '0000-00-00 00:00:00'),
(33, 'passed', 'Test 1326_2', 11, '', 7, 1, 28, '0000-00-00 00:00:00'),
(34, 'passed', 'Test 1326_4', 11, '', 1, 1, 26, '0000-00-00 00:00:00'),
(35, 'passed', 'Test 1326_4', 11, '', 7, 1, 26, '0000-00-00 00:00:00'),
(36, 'failed', 'Test 1326_3', 11, '', 1, 1, 29, '0000-00-00 00:00:00'),
(37, 'passed', 'Test 1326_3', 11, '', 7, 1, 29, '0000-00-00 00:00:00'),
(38, 'failed', 'Test 1326_1', 11, '', 1, 1, 27, '0000-00-00 00:00:00'),
(39, 'passed', 'Test 1326_1', 11, '', 7, 1, 27, '0000-00-00 00:00:00'),
(40, 'failed', 'Test Test', 13, '', 1, 1, 31, '2009-02-21 10:39:10'),
(41, 'passed', 'Test Test', 13, '', 7, 1, 31, '2009-07-21 10:40:10');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `command` varchar(255) COLLATE utf8_bin NOT NULL,
  `spacer` varchar(255) COLLATE utf8_bin NOT NULL,
  `extension` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Data dump for tabellen `types`
--

INSERT INTO `types` (`id`, `name`, `command`, `spacer`, `extension`) VALUES
(1, 'php', 'php', ' ', 'php'),
(4, 'java', 'java -jar', ' ', 'jar'),
(10, 'ruby', 'ruby', ' ', 'rb');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '1',
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_danish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci AUTO_INCREMENT=50 ;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `name`, `password`, `group_id`, `email`) VALUES
(23, '', '', 'Visti', 'a827d495e2eedc372a1410b4e725ec7ace863771', 2, ''),
(24, '', '', 'test', 'a827d495e2eedc372a1410b4e725ec7ace863771', 1, ''),
(21, '', '', 'Ralle', 'a827d495e2eedc372a1410b4e725ec7ace863771', 1, '');
