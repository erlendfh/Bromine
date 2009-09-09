-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 30. 08 2009 kl. 21:37:42
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Data dump for tabellen `browsers`
--

INSERT INTO `browsers` (`id`, `name`, `path`) VALUES
(1, 'Internet Explorer 7', '*iexplore'),
(2, 'Internet Explorer 6', '*iexplore'),
(3, 'Firefox 2', '*firefox'),
(6, 'Safari', '*safari'),
(7, 'Firefox 3', '*firefox'),
(8, 'Opera', '*opera');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=237 ;

--
-- Data dump for tabellen `browsers_nodes`
--

INSERT INTO `browsers_nodes` (`id`, `browser_id`, `node_id`) VALUES
(224, 17, 59),
(223, 8, 59),
(222, 7, 59),
(234, 7, 64),
(221, 6, 59),
(220, 3, 59),
(203, 7, 57),
(202, 1, 57),
(219, 2, 59),
(218, 1, 59),
(233, 1, 64);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1923 ;

--
-- Data dump for tabellen `combinations_requirements`
--

INSERT INTO `combinations_requirements` (`id`, `requirement_id`, `combination_id`) VALUES
(1859, 357, 43),
(1816, 355, 43),
(1806, 354, 43),
(1793, 353, 43),
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
(1781, 352, 43),
(1644, 342, 21),
(1768, 351, 43),
(1876, 345, 1),
(1650, 344, 1),
(1663, 343, 43),
(1826, 356, 43),
(1751, 359, 43),
(1845, 358, 43),
(1888, 369, 43),
(1730, 361, 43),
(1713, 362, 43),
(1700, 363, 43),
(1690, 364, 43),
(1893, 365, 1),
(1892, 365, 43),
(1878, 366, 43),
(1922, 1, 1),
(1889, 368, 43),
(1921, 1, 43),
(1919, 2, 43),
(1918, 2, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `commands`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `configs`
--

CREATE TABLE IF NOT EXISTS `configs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data dump for tabellen `configs`
--

INSERT INTO `configs` (`id`, `name`, `value`) VALUES
(1, 'registered', '0'),
(2, 'email on error', '0'),
(3, 'autoupdate', '0'),
(4, 'echelon', '0');

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
-- Struktur-dump for tabellen `echelons`
--

CREATE TABLE IF NOT EXISTS `echelons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `time` int(11) NOT NULL,
  `ip` varchar(32) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `echelons`
--


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
(1, 'admin');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=71 ;

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
(49, -2, 'Help', '', '', 5),
(50, 49, 'State of the system', 'configs', 'stateOfTheSystem', 0),
(51, 49, 'About Bromine', 'pages', 'about', 2),
(52, -2, 'Projects', 'projects', '', 2),
(53, 61, 'Types', 'types', '', 0),
(54, 56, 'Users', 'users', '', 3),
(55, 56, 'Groups', 'groups', '', 1),
(56, -2, 'Users and access', '', '', 3),
(57, 61, 'Browsers', 'browsers', '', 0),
(58, 61, 'Operating systems', 'operatingsystems', '', 0),
(59, -2, 'Nodes', 'nodes', '', 1),
(60, 56, 'Access control', 'manage_acl', '', 2),
(61, -2, 'Misc', '', '', 4),
(67, 56, 'Logs >>', 'echelons', 'index', 4),
(68, 67, 'Set to: Off', 'configs', 'setEchelon/false', 2),
(69, 67, 'Set to: On', 'configs', 'setEchelon/true', 1),
(70, -2, 'Manage plugins', 'plugins', 'index', 9);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Data dump for tabellen `myaros`
--

INSERT INTO `myaros` (`id`, `model`, `foreign_key`, `parent_id`, `alias`) VALUES
(1, 'group', 1, NULL, '/admin'),
(82, 'user', 50, 1, '/admin/admin');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=66 ;

--
-- Data dump for tabellen `nodes`
--

INSERT INTO `nodes` (`id`, `nodepath`, `operatingsystem_id`, `description`) VALUES
(64, '127.0.0.1:4445', 1, ''),
(57, '127.0.0.1:4444', 1, 'Selenium RC server on the localhost');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `operatingsystems`
--

CREATE TABLE IF NOT EXISTS `operatingsystems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=18 ;

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
-- Struktur-dump for tabellen `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `activated` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Data dump for tabellen `plugins`
--

INSERT INTO `plugins` (`id`, `name`, `activated`) VALUES
(19, 'pizza', 1);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=139 ;

--
-- Data dump for tabellen `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`) VALUES
(138, 'Google Sample', 'The google sample project');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `projects_users`
--

CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Data dump for tabellen `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`) VALUES
(106, 138, 50),
(89, 134, 50);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `requirements`
--

INSERT INTO `requirements` (`id`, `name`, `description`, `project_id`, `parent_id`) VALUES
(1, 'Web', 0x746865207765627061676520726573756c7473, 138, 0),
(2, 'Image', 0x54686520696d616765736561726368, 138, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=27 ;

--
-- Data dump for tabellen `requirements_testcases`
--

INSERT INTO `requirements_testcases` (`id`, `testcase_id`, `requirement_id`) VALUES
(22, 4, 2),
(21, 3, 2),
(26, 2, 1),
(25, 1, 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=70 ;

--
-- Data dump for tabellen `sites`
--

INSERT INTO `sites` (`id`, `name`, `project_id`) VALUES
(59, 'http://localhost', 134),
(68, 'http://www.google.in', 138),
(65, 'http://www.google.com', 138);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=59 ;

--
-- Data dump for tabellen `suites`
--

INSERT INTO `suites` (`id`, `name`, `site_id`, `timedate`, `timetaken`, `selenium_version`, `project_id`, `analysis`, `status`, `browser_id`, `operating_system_id`, `selenium_revision`) VALUES
(1, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(2, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(3, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(4, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(5, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(6, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(7, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(8, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(9, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(10, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(11, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(12, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(13, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(14, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(15, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(16, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(17, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(18, 'alalal', 68, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(19, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(20, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(21, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(22, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(23, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(24, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(25, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(26, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(27, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(28, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(29, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(30, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(31, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(32, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(33, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(34, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(35, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(36, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(37, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(38, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(39, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(40, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(41, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(42, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(43, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(44, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(45, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(46, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(47, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(48, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(49, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(50, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(51, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(52, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(53, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(54, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(55, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(56, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(57, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, ''),
(58, 'alalal', 65, NULL, NULL, NULL, 138, 0, 'failed', 0, 0, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Data dump for tabellen `testcases`
--

INSERT INTO `testcases` (`id`, `name`, `project_id`, `description`) VALUES
(1, 'Basic web', 138, 0x626173696320736561726368),
(2, 'Advanced web', 138, 0x616476616e6365642077656220736561726368),
(3, 'basic image', 138, ''),
(4, 'advanced image', 138, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=58 ;

--
-- Data dump for tabellen `testcasesteps`
--

INSERT INTO `testcasesteps` (`id`, `orderby`, `action`, `reaction`, `testcase_id`) VALUES
(52, 0, 0x616374696f6e207468726565, 0x7265616374696f6e207468726565, 102),
(53, 2, 0x616374696f6e207468726565, 0x7265616374696f6e207468726565, 102),
(54, 1, 0x616374696f6e207365766572616c, 0x7265616374696f6e2074776f0a, 102),
(57, 1, 0x6f70656e20656e69726f, 0x656e696f206f70656e73, 104);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `tests`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=27 ;

--
-- Data dump for tabellen `types`
--

INSERT INTO `types` (`id`, `name`, `command`, `spacer`, `extension`) VALUES
(1, 'php', 'php', ' ', 'php'),
(4, 'java', 'java -jar', ' ', 'jar');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci AUTO_INCREMENT=63 ;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `name`, `password`, `group_id`, `email`) VALUES
(50, '', '', 'admin', '6770906accd531bd8cfd4c4f5d2b469c03f447e0', 1, 'admin@localhost.com');
