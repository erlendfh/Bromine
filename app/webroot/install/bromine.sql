-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 22. 08 2009 kl. 02:01:40
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=225 ;

--
-- Data dump for tabellen `browsers_nodes`
--

INSERT INTO `browsers_nodes` (`id`, `browser_id`, `node_id`) VALUES
(224, 17, 59),
(223, 8, 59),
(222, 7, 59),
(221, 6, 59),
(220, 3, 59),
(203, 7, 57),
(202, 1, 57),
(219, 2, 59),
(218, 1, 59);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1664 ;

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
(1662, 345, 1),
(1650, 344, 1),
(1663, 343, 43);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Data dump for tabellen `commands`
--

INSERT INTO `commands` (`id`, `status`, `action`, `var1`, `var2`, `test_id`) VALUES
(1, 'done', 'getNewBrowserSession', '*iexplore', 'http://localhost', 79),
(2, 'done', 'open', '/', '', 79),
(3, 'done', 'type', 'UserName', 'ralle', 79),
(4, 'done', 'type', 'UserPassword', 'a32', 79),
(5, 'done', 'click', '//input[@value=''Login'']', '', 79),
(6, 'done', 'waitForPageToLoad', '30000', '', 79),
(7, 'passed', 'assertEquals(getTitle)', '', 'Projects', 79),
(8, 'done', 'testComplete', '', '', 79);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

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
(54, 56, 'Users', 'users', '', 3),
(55, 56, 'Groups', 'groups', '', 1),
(56, -2, 'Users and access', '', '', 3),
(57, 61, 'Browsers', 'browsers', '', 0),
(58, 61, 'Operating systems', 'operatingsystems', '', 0),
(59, -2, 'Nodes', 'nodes', '', 1),
(60, 56, 'Access control', 'manage_acl', '', 2),
(61, -2, 'Misc', '', '', 4),
(63, 62, 'Register Bromine', 'configs', 'register', 1),
(64, 62, 'Email developers on error >>', '', '', 2),
(65, 64, 'Set to: On', 'configs', 'sendUsMailWhenBromineFails/true', 1),
(66, 64, 'Set to: Off', 'configs', 'sendUsMailWhenBromineFails/false', 2),
(67, 56, 'Logs >>', 'echelons', 'index', 4),
(68, 67, 'Set to: Off', 'configs', 'setEchelon/false', 2),
(69, 67, 'Set to: On', 'configs', 'setEchelon/true', 1);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Data dump for tabellen `myaros`
--

INSERT INTO `myaros` (`id`, `model`, `foreign_key`, `parent_id`, `alias`) VALUES
(1, 'group', 1, NULL, '/admin'),
(2, 'group', 2, NULL, '/managers'),
(3, 'group', 3, NULL, '/users'),
(23, 'user', 23, 1, '/admin/Visti'),
(24, 'user', 24, 1, '/admin/test'),
(21, 'user', 21, 1, '/admin/Ralle'),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=60 ;

--
-- Data dump for tabellen `nodes`
--

INSERT INTO `nodes` (`id`, `nodepath`, `operatingsystem_id`, `description`) VALUES
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
-- Struktur-dump for tabellen `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=138 ;

--
-- Data dump for tabellen `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`) VALUES
(134, 'selftest', 'The Bromine selftest project');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `projects_users`
--

CREATE TABLE IF NOT EXISTS `projects_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Data dump for tabellen `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`) VALUES
(84, 134, 21),
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=351 ;

--
-- Data dump for tabellen `requirements`
--

INSERT INTO `requirements` (`id`, `name`, `description`, `project_id`, `parent_id`) VALUES
(345, 'selftest', '', 134, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=15023 ;

--
-- Data dump for tabellen `requirements_testcases`
--

INSERT INTO `requirements_testcases` (`id`, `testcase_id`, `requirement_id`) VALUES
(15016, 269, 345),
(15015, 268, 345),
(15014, 267, 345),
(15013, 266, 345),
(15012, 265, 345),
(15011, 264, 345),
(15010, 263, 345),
(15009, 262, 345),
(15008, 261, 345),
(15007, 260, 345),
(15006, 259, 345),
(15005, 258, 345),
(15004, 257, 345),
(15003, 256, 345),
(15002, 255, 345),
(15001, 254, 345),
(15000, 253, 345),
(14999, 252, 345),
(14998, 251, 345),
(14997, 250, 345),
(14996, 249, 345),
(14995, 248, 345),
(14994, 247, 345),
(14993, 246, 345),
(14992, 245, 345),
(14991, 244, 345),
(14990, 243, 345),
(14989, 242, 345),
(14988, 241, 345),
(14987, 240, 345),
(14986, 239, 345),
(14985, 238, 345),
(14984, 237, 345),
(14983, 236, 345),
(14982, 235, 345),
(14981, 234, 345),
(14980, 233, 345),
(14979, 232, 345),
(14978, 231, 345),
(14977, 230, 345),
(14976, 229, 345),
(14975, 228, 345),
(14974, 227, 345),
(14973, 226, 345),
(14972, 225, 345),
(14971, 224, 345),
(14970, 223, 345),
(14969, 222, 345),
(14968, 221, 345),
(14967, 220, 345),
(14966, 219, 345),
(14965, 218, 345),
(14964, 217, 345),
(14963, 216, 345),
(14962, 215, 345),
(14961, 214, 345),
(14960, 213, 345),
(14959, 212, 345),
(14958, 211, 345),
(14957, 210, 345),
(14956, 209, 345),
(14955, 208, 345),
(14954, 207, 345),
(14953, 206, 345),
(14952, 205, 345),
(14951, 204, 345),
(14950, 203, 345),
(14949, 202, 345),
(14948, 201, 345),
(14947, 200, 345),
(14946, 199, 345),
(14945, 198, 345),
(14944, 197, 345),
(14943, 196, 345),
(14942, 195, 345),
(14941, 194, 345),
(14940, 193, 345),
(14939, 192, 345),
(14938, 191, 345),
(14937, 190, 345),
(14936, 189, 345),
(14935, 188, 345),
(14934, 187, 345),
(14933, 186, 345),
(14932, 185, 345),
(14931, 184, 345),
(14930, 183, 345),
(14929, 182, 345),
(14928, 181, 345),
(14927, 180, 345),
(14926, 179, 345),
(14925, 178, 345),
(14924, 177, 345),
(14923, 176, 345),
(14922, 175, 345),
(14921, 174, 345),
(14920, 173, 345),
(14919, 172, 345),
(14918, 171, 345),
(14917, 170, 345),
(14916, 169, 345),
(14915, 168, 345),
(14914, 167, 345),
(14913, 166, 345),
(14912, 165, 345),
(14911, 164, 345),
(14910, 163, 345),
(14909, 162, 345),
(14908, 161, 345),
(14907, 160, 345),
(14906, 159, 345),
(14905, 158, 345);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=65 ;

--
-- Data dump for tabellen `sites`
--

INSERT INTO `sites` (`id`, `name`, `project_id`) VALUES
(59, 'http://localhost', 134);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=101 ;

--
-- Data dump for tabellen `suites`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=270 ;

--
-- Data dump for tabellen `testcases`
--

INSERT INTO `testcases` (`id`, `name`, `project_id`, `description`) VALUES
(248, 'Testcases: edit', 134, ''),
(247, 'Testcases: add', 134, ''),
(246, 'Testcases: viewscript', 134, ''),
(245, 'Testcases: testlabview', 134, ''),
(244, 'Testcases: view', 134, ''),
(243, 'Testcases: lilist', 134, ''),
(242, 'Testcases: index', 134, ''),
(241, 'Testcasesteps: delete', 134, ''),
(240, 'Testcasesteps: edit', 134, ''),
(239, 'Testcasesteps: add', 134, ''),
(238, 'Testcasesteps: view', 134, ''),
(237, 'Testcasesteps: reorder', 134, ''),
(236, 'Testcasesteps: index', 134, ''),
(235, 'Suites: delete', 134, ''),
(234, 'Suites: edit', 134, ''),
(233, 'Suites: add', 134, ''),
(232, 'Suites: view', 134, ''),
(231, 'Suites: index', 134, ''),
(230, 'Sites: delete', 134, ''),
(229, 'Sites: edit', 134, ''),
(228, 'Sites: add', 134, ''),
(227, 'Sites: view', 134, ''),
(226, 'Sites: select', 134, ''),
(225, 'Seleniumserver: executeCommand', 134, ''),
(224, 'Seleniumserver: driver', 134, ''),
(223, 'Runrctests: runTestcase', 134, ''),
(222, 'Runrctests: runRequirement', 134, ''),
(221, 'Runrctests: runAndViewRequirement', 134, ''),
(220, 'Runrctests: runAndViewTestcase', 134, ''),
(219, 'Requirements: delete', 134, ''),
(218, 'Requirements: edit', 134, ''),
(217, 'Requirements: add', 134, ''),
(216, 'Requirements: testlabview', 134, ''),
(215, 'Requirements: view', 134, ''),
(214, 'Requirements: index', 134, ''),
(213, 'Requirements: updateCombination', 134, ''),
(212, 'Requirements: updatetc', 134, ''),
(211, 'Requirements: reorder', 134, ''),
(210, 'Projects: select', 134, ''),
(209, 'Projects: testlabsview', 134, ''),
(208, 'Projects: delete', 134, ''),
(207, 'Projects: edit', 134, ''),
(206, 'Projects: add', 134, ''),
(205, 'Projects: view', 134, ''),
(204, 'Projects: index', 134, ''),
(203, 'Operatingsystems: delete', 134, ''),
(202, 'Operatingsystems: edit', 134, ''),
(201, 'Operatingsystems: add', 134, ''),
(200, 'Operatingsystems: view', 134, ''),
(199, 'Operatingsystems: index', 134, ''),
(198, 'Nodes: delete', 134, ''),
(197, 'Nodes: edit', 134, ''),
(196, 'Nodes: add', 134, ''),
(195, 'Nodes: view', 134, ''),
(194, 'Nodes: index', 134, ''),
(193, 'Myaros: delete', 134, ''),
(192, 'Myaros: edit', 134, ''),
(191, 'Myaros: add', 134, ''),
(190, 'Myaros: view', 134, ''),
(189, 'Myaros: index', 134, ''),
(188, 'Myacos: delete', 134, ''),
(187, 'Myacos: edit', 134, ''),
(186, 'Myacos: add', 134, ''),
(185, 'Myacos: view', 134, ''),
(184, 'Myacos: index', 134, ''),
(183, 'ManageAcl: buildAcl', 134, ''),
(182, 'ManageAcl: listAcos', 134, ''),
(181, 'ManageAcl: removeACL', 134, ''),
(180, 'ManageAcl: createACL', 134, ''),
(179, 'ManageAcl: listAros', 134, ''),
(178, 'ManageAcl: index', 134, ''),
(177, 'Items: updateItemSize', 134, ''),
(176, 'Items: updateItemPosition', 134, ''),
(175, 'Items: edit', 134, ''),
(174, 'Items: index', 134, ''),
(173, 'Groups: delete', 134, ''),
(172, 'Groups: edit', 134, ''),
(171, 'Groups: add', 134, ''),
(170, 'Groups: view', 134, ''),
(169, 'Groups: index', 134, ''),
(168, 'Configs: stateOfTheSystem', 134, ''),
(167, 'Configs: sendUsMailWhenBromineFails', 134, ''),
(166, 'Configs: help', 134, ''),
(165, 'Configs: do_post_request', 134, ''),
(164, 'Configs: register', 134, ''),
(163, 'Configs: checkForUpdates', 134, ''),
(162, 'Browsers: delete', 134, ''),
(161, 'Browsers: edit', 134, ''),
(160, 'Browsers: add', 134, ''),
(159, 'Browsers: view', 134, ''),
(158, 'Browsers: index', 134, ''),
(249, 'Testcases: upload', 134, ''),
(250, 'Testcases: delete', 134, ''),
(251, 'Testcases: addToJira', 134, ''),
(252, 'Testlabs: index', 134, ''),
(253, 'Tests: index', 134, ''),
(254, 'Tests: view', 134, ''),
(255, 'Tests: add', 134, ''),
(256, 'Tests: edit', 134, ''),
(257, 'Tests: delete', 134, ''),
(258, 'Types: index', 134, ''),
(259, 'Types: view', 134, ''),
(260, 'Types: add', 134, ''),
(261, 'Types: edit', 134, ''),
(262, 'Types: delete', 134, ''),
(263, 'Users: login', 134, ''),
(264, 'Users: logout', 134, ''),
(265, 'Users: index', 134, ''),
(266, 'Users: view', 134, ''),
(267, 'Users: add', 134, ''),
(268, 'Users: edit', 134, ''),
(269, 'Users: delete', 134, '');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=80 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci AUTO_INCREMENT=51 ;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `name`, `password`, `group_id`, `email`) VALUES
(21, '', '', 'Ralle', '598773e99e6e49f1663c11363f16267c30862549', 1, ''),
(50, '', '', 'admin', '6770906accd531bd8cfd4c4f5d2b469c03f447e0', 1, 'admin@localhost.com');
