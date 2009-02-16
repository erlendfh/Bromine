-- phpMyAdmin SQL Dump
-- version 2.11.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2008 at 03:02 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

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
-- Table structure for table `trm_browser`
--

CREATE TABLE IF NOT EXISTS `trm_browser` (
  `ID` int(11) NOT NULL auto_increment,
  `browsername` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `name` (`browsername`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Dumping data for table `trm_browser`
--

INSERT INTO `trm_browser` (`ID`, `browsername`) VALUES
(1, 'IE7'),
(2, 'IE6'),
(3, 'Firefox'),
(11, 'IEhta'),
(10, 'Chrome'),
(13, 'Safari'),
(14, 'pifirefox'),
(15, 'Firefox 3');

-- --------------------------------------------------------

--
-- Table structure for table `trm_commands`
--

CREATE TABLE IF NOT EXISTS `trm_commands` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `status` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `action` longtext character set latin1 collate latin1_danish_ci,
  `var1` longtext character set latin1 collate latin1_danish_ci,
  `var2` longtext character set latin1 collate latin1_danish_ci,
  `t_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=273 ;

--
-- Dumping data for table `trm_commands`
--

INSERT INTO `trm_commands` (`ID`, `status`, `action`, `var1`, `var2`, `t_id`) VALUES
(3, 'failed', 'open', '/', '', 0),
(4, 'failed', 'testComplete', '', '', 0),
(6, 'failed', 'open', '/', '', 0),
(7, 'failed', 'testComplete', '', '', 0),
(9, 'failed', 'testComplete', '', '', 0),
(227, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 34),
(228, 'done', 'open', '/', '', 34),
(229, 'passed', 'This Custom Command1', 'true', 'true', 34),
(230, 'done', 'type', 'q', 'bromine openqa', 34),
(231, 'done', 'click', 'btnG', '', 34),
(232, 'done', 'waitForPageToLoad', '30000', '', 34),
(233, 'done', 'click', 'link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA', '', 34),
(234, 'done', 'waitForPageToLoad', '30000', '', 34),
(235, 'done', 'isTextPresent', 'Bromine', '', 34),
(236, 'passed', 'This Custom Command2', 'true', 'true', 34),
(237, 'done', 'This Custom Command4', 'true', 'true', 34),
(238, 'done', 'testComplete', '', '', 34),
(239, 'done', 'getNewBrowserSession', '*iehta', 'http://www.google.com', 35),
(240, 'done', 'open', '/', '', 35),
(241, 'done', 'type', 'q', 'bromine openqa', 35),
(242, 'done', 'click', 'btnG', '', 35),
(243, 'done', 'waitForPageToLoad', '30000', '', 35),
(244, 'done', 'click', 'link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA', '', 35),
(245, 'done', 'waitForPageToLoad', '30000', '', 35),
(246, 'done', 'isTextPresent', 'Brom1ine1', '', 35),
(247, 'failed', 'customCommand', 'var1', 'var2', 35),
(248, 'done', 'testComplete', '', '', 35),
(249, 'done', 'getNewBrowserSession', '*iehta', 'http://www.google.com', 36),
(250, 'done', 'open', '/', '', 36),
(251, 'passed', 'This Custom Command1', 'true', 'true', 36),
(252, 'done', 'type', 'q', 'bromine openqa', 36),
(253, 'done', 'click', 'btnG', '', 36),
(254, 'done', 'waitForPageToLoad', '30000', '', 36),
(255, 'done', 'click', 'link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA', '', 36),
(256, 'done', 'waitForPageToLoad', '30000', '', 36),
(257, 'done', 'isTextPresent', 'Bromine', '', 36),
(258, 'passed', 'This Custom Command2', 'true', 'true', 36),
(259, 'done', 'This Custom Command4', 'true', 'true', 36),
(260, 'done', 'testComplete', '', '', 36);

-- --------------------------------------------------------

--
-- Table structure for table `trm_comments`
--

CREATE TABLE IF NOT EXISTS `trm_comments` (
  `id` int(11) NOT NULL auto_increment,
  `timedate` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  `headline` varchar(255) collate utf8_bin NOT NULL,
  `comment` longtext collate utf8_bin NOT NULL,
  `table_name` varchar(255) collate utf8_bin NOT NULL,
  `table_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `trm_comments`
--

INSERT INTO `trm_comments` (`id`, `timedate`, `author`, `headline`, `comment`, `table_name`, `table_id`) VALUES
(1, '2008-09-26 14:39:59', 104, 'Headline', 0x436f6d6d656e74206f6e20746865206572726f722f646566656374, 'trm_defects', 1),
(2, '2008-09-26 14:52:23', 104, 'Headline', 0x436f6d6d656e74206f6e207468697320746573742c2077687920697420646964206661696c206f7220616e797468696e672e2e2e, 'trm_test', 35);

-- --------------------------------------------------------

--
-- Table structure for table `trm_config`
--

CREATE TABLE IF NOT EXISTS `trm_config` (
  `id` int(11) NOT NULL auto_increment,
  `var` varchar(255) collate utf8_bin NOT NULL,
  `value` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `var` (`var`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `trm_config`
--

INSERT INTO `trm_config` (`id`, `var`, `value`) VALUES
(1, 'lite_version', '0'),
(2, 'registration', '1');

-- --------------------------------------------------------

--
-- Table structure for table `trm_core`
--

CREATE TABLE IF NOT EXISTS `trm_core` (
  `ID` int(11) NOT NULL auto_increment,
  `referer` varchar(255) character set latin1 collate latin1_danish_ci NOT NULL,
  `p_id` int(11) NOT NULL default '0',
  `TestRunnerLocation` varchar(255) character set latin1 NOT NULL,
  `testPath` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=94 ;

--
-- Dumping data for table `trm_core`
--


-- --------------------------------------------------------

--
-- Table structure for table `trm_core_testsuites`
--

CREATE TABLE IF NOT EXISTS `trm_core_testsuites` (
  `id` int(11) NOT NULL auto_increment,
  `p_id` int(11) NOT NULL,
  `testsuite` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=108 ;

--
-- Dumping data for table `trm_core_testsuites`
--


-- --------------------------------------------------------

--
-- Table structure for table `trm_cronjobs`
--

CREATE TABLE IF NOT EXISTS `trm_cronjobs` (
  `id` int(11) NOT NULL auto_increment,
  `runtime` datetime NOT NULL,
  `job` text collate utf8_bin NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trm_cronjobs`
--


-- --------------------------------------------------------

--
-- Table structure for table `trm_defects`
--

CREATE TABLE IF NOT EXISTS `trm_defects` (
  `id` int(11) NOT NULL auto_increment,
  `createdby` int(11) NOT NULL,
  `description` longtext collate utf8_bin NOT NULL,
  `type_of_defect` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `t_id` int(11) default NULL,
  `updatedby` int(11) NOT NULL,
  `name` varchar(255) collate utf8_bin NOT NULL,
  `priority` enum('Urgent','Very high','High','Medium','Low') collate utf8_bin NOT NULL,
  `stt_id` varchar(11) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `trm_defects`
--

INSERT INTO `trm_defects` (`id`, `createdby`, `description`, `type_of_defect`, `created`, `updated`, `status`, `p_id`, `t_id`, `updatedby`, `name`, `priority`, `stt_id`) VALUES
(1, 104, 0x446573637269706520796f7572206572726f722f64656665637420686572652e2e2e20596f752063616e20616c736f2061646420616e206174746163686d656e7420286120646f632c20616e20696d616765206f7220616e792066696c65292e0d0a596f752063616e20636f6d6d656e74206f6e2074686973206572726f722f64656665637420627920636c69636b696e67206f6e207468652061646420636f6d6d656e74206c696e6b2062656c6c6f772e, 2, '2008-09-26 14:39:16', '2008-09-26 14:41:21', 1, 123, 35, 104, 'Trille test failed due to -something-', 'Very high', '37'),
(2, 104, 0x6a75737420616e6f74686572206465666563742e2e2e, 6, '2008-09-26 14:43:21', '2008-09-26 14:43:21', 1, 123, NULL, 104, 'Trille test is obsolete', 'Urgent', '37');

-- --------------------------------------------------------

--
-- Table structure for table `trm_defect_has_attachment`
--

CREATE TABLE IF NOT EXISTS `trm_defect_has_attachment` (
  `id` int(11) NOT NULL auto_increment,
  `d_id` int(11) NOT NULL,
  `attachment_path` text collate utf8_bin NOT NULL,
  `microtime` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Dumping data for table `trm_defect_has_attachment`
--


-- --------------------------------------------------------

--
-- Table structure for table `trm_design_manual_commands`
--

CREATE TABLE IF NOT EXISTS `trm_design_manual_commands` (
  `id` int(11) NOT NULL auto_increment,
  `orderby` int(11) NOT NULL,
  `action` text collate utf8_bin NOT NULL,
  `reaction` text collate utf8_bin NOT NULL,
  `td_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Dumping data for table `trm_design_manual_commands`
--

INSERT INTO `trm_design_manual_commands` (`id`, `orderby`, `action`, `reaction`, `td_id`) VALUES
(1, 1, 0x4f70656e20687474703a2f2f7777772e6d79736974652e636f6d, 0x53697465206f70656e73, 1),
(2, 2, 0x547970652068656c6c6f20776f726c6420696e20746865207365617263682074657874206669656c6420616e6420636c69636b20736561726368, 0x54686520736974652073686f77732074686520726573756c742070616765, 1),
(3, 3, 0x467572746865722073746570, 0x467572746865722e2e2e2e2e2e, 1),
(4, 4, 0x416e64, 0x736f, 1),
(5, 5, 0x6f6e, 0x616e64, 1),
(6, 6, 0x736f, 0x6f6e, 1),
(7, 1, 0x537465702031, 0x537465702031, 2),
(8, 2, 0x537465702032, 0x537465702032, 2);

-- --------------------------------------------------------

--
-- Table structure for table `trm_design_manual_test`
--

CREATE TABLE IF NOT EXISTS `trm_design_manual_test` (
  `id` int(11) NOT NULL auto_increment,
  `name` text collate utf8_bin NOT NULL,
  `p_id` int(11) NOT NULL,
  `Description` longtext collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `trm_design_manual_test`
--

INSERT INTO `trm_design_manual_test` (`id`, `name`, `p_id`, `Description`) VALUES
(1, 0x7472696c6c65, 123, 0x5468697320697320616e206578616d706c65206f66206120746573742063617365210d0a537461727420627920616464696e672061206e657720746573742063617365207573696e672074686520627574746f6e2061626f76652e0d0a5768656e207479706520696e2061206e616d6520666f722061742074686520746573742063617365207573696e67207468652074657374206669656c642061626f76652e0d0a0d0a41646420737465707320746f20746865207465737420636173652062656c6c6f773a),
(2, 0x7472696c6c6532, 123, 0x54686973206973206a75737420616e6f7468657220746573742063617365);

-- --------------------------------------------------------

--
-- Table structure for table `trm_lang`
--

CREATE TABLE IF NOT EXISTS `trm_lang` (
  `id` int(11) NOT NULL auto_increment,
  `langKey` varchar(255) collate utf8_bin NOT NULL,
  `en` varchar(255) collate utf8_bin NOT NULL,
  `es` varchar(255) collate utf8_bin NOT NULL,
  `dk` varchar(255) collate utf8_bin NOT NULL,
  `de` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `langKey` (`langKey`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=291 ;

--
-- Dumping data for table `trm_lang`
--

INSERT INTO `trm_lang` (`id`, `langKey`, `en`, `es`, `dk`, `de`) VALUES
(1, 'Date', 'Date', '', 'Dato', '...'),
(2, 'Suite name', 'Suite name', '', 'Suite navn', '...'),
(3, 'Sel. ver.', 'Sel. ver.', '', 'Sel. ver.', '...'),
(4, 'Sel. rev.', 'Sel. rev.', '', 'Sel. rev.', '...'),
(5, 'Browser', 'Browser', '', 'Browser', '...'),
(6, 'Platform', 'Platform', '', 'Platform', '...'),
(7, 'Test suc.', 'Test suc.', '', 'T lykkedes', '...'),
(8, 'Test fail.', 'Test fail.', '', 'T Fejlet', '...'),
(9, 'Cmd. suc.', 'Cmd. suc.', '', 'K lykkedes', '...'),
(10, 'Cmd. failed', 'Cmd. failed', '', 'K fejlet', '...'),
(11, 'Cmd. not done', 'Cmd. not done', '', 'K ikke udfÃ¸rt', '...'),
(12, 'T graph', 'T graph', '', 'T graf', '...'),
(13, 'Cmd. graph', 'Cmd. graph', '', 'K graf', '...'),
(14, 'To', 'To', '', 'Til', '...'),
(15, 'From', 'From', '', 'Fra', '...'),
(16, 'Show', 'Show', '', 'Vis', '...'),
(17, 'Difference', 'Difference', '', 'Forskel', '...'),
(18, 'Add user', 'Add user', '', 'TilfÃ¸j bruger', '...'),
(19, 'See old reports', 'See old reports', '', 'Se gamle rapporter', '...'),
(20, 'Users', 'Users', '', 'Brugere', '...'),
(21, 'All', 'All', '', 'Alle', '...'),
(22, 'Test succeded', 'Test succeded', '', 'Test lykkedes', '...'),
(23, 'Help text', 'Help text', '', 'HjÃ¦lpe tekst', '...'),
(24, 'Commands succeded', 'Commands succeded', '', 'Kommandoer lykkedes', '...'),
(25, 'Commands failed', 'Commands failed', '', 'Kommandoer fejlet', '...'),
(26, 'Commands done', 'Commands done', '', 'Kommandoer gennemfÃ¸rt', '...'),
(27, 'Commands not done', 'Commands not done', '', 'Kommandoer ikke gennemfÃ¸rt', '...'),
(28, 'min.', 'min.', '', 'min.', '...'),
(29, 'sec.', 'sec.', '', 'sek.', '...'),
(30, 'Client', 'Client', '', 'Klient', '...'),
(31, 'Total time', 'Total time', '', 'Samlet tid', '...'),
(32, 'Selenium version', 'Selenium version', '', 'Selenium version', '...'),
(33, 'Selenium revision', 'Selenium revision', '', 'Selenium revision', '...'),
(34, 'Time', 'Time', '', 'Tid', '...'),
(35, 'Command Failures %', 'Command Failures %', '', 'Kommando fejl %', '...'),
(36, 'Commands errors', 'Commands errors', '', 'Kommandoer ikke gennemfÃ¸rt', '...'),
(38, 'Test failed', 'Test failed', '', 'Test fejlet', '...'),
(39, 'Test', 'Test', '', 'Test', '...'),
(40, 'Commands', 'Commands', '', 'Kommandoer', '...'),
(41, 'Comparison by', 'Comparison by', '', 'Sammenlign pÃ¥', '...'),
(42, 'Project', 'Project', '', 'Projekt', '...'),
(43, 'Description', 'Description', '', 'Beskrivelse', '...'),
(44, 'Username', 'Username', '', 'Brugernavn', '...'),
(45, 'Password', 'Password', '', 'Adgangskode', '...'),
(46, 'Log in', 'Log in', '', 'Log ind', '...'),
(47, 'Logged in as', 'Logged in as', '', 'Logget ind som', '...'),
(48, 'Link to admin-site', 'Admin module', '', 'Admin modul', '...'),
(49, 'Back to suite overview', 'Back to suite overview', '', 'Tilbage til suite overblik', '...'),
(50, 'No reports', 'There are no report in this project', '', 'Der er ingen rapport i dette project', '...'),
(51, 'Return to index', 'Back to project overview', '', 'Tilbage til projekt overblik', '...'),
(52, 'reset', 'Reset', '', 'Nulstil', '...'),
(53, 'no login', 'Your username or password is not correct', '', 'Mit brugernavn eller adgangskode er forkert ', '...'),
(54, 'no projects', 'You don''t have access to any projects', '', 'Du har ikke adgang til noget projekter', '...'),
(56, 'Diff', 'Diff', '', 'Diff', '...'),
(57, 'environment', 'Environment', '', 'MiljÃ¸', '...'),
(58, 'Failed', 'Failed', '', 'Fejl', '...'),
(59, 'Passed', 'Passed', '', 'Godkendt', '...'),
(60, 'Error', 'Error', '', 'Ikke gennemfÃ¸rt', '...'),
(61, 'manPassed', 'Manually Passed', '', 'Manuelt gennemfÃ¸rt', '...'),
(62, 'Language', 'Language', '', 'Sprog', '...'),
(63, 'Welcome to Bromine', 'Welcome to Bromine', '', 'Velkommen til Bromine', '...'),
(64, 'WelcomeMsg', 'Internal news and stuff goes here', '', 'Interne nyheder og andre ting her', '...'),
(65, 'log out', 'log out', '', 'log ud', '...'),
(66, 'Test Lab', 'Test Lab', '', 'Test Lab', '...'),
(67, 'Test Result Manager', 'Test Result Manager', '', 'Test Result Manager', '...'),
(69, 'Choose project', 'Choose project', '', 'VÃ¦lg projekt', '...'),
(70, 'No test attached', 'No test attached', '', 'Ingen test tilfÃ¸jet', '...'),
(71, 'Environment', 'Environment', '', 'MiljÃ¸', '...'),
(72, 'Choose environment', 'Choose environment', '', 'VÃ¦lg miljÃ¸', '...'),
(73, 'Admin WARNING!', 'WARNING!!! - THINK before you change anything!!', '', 'PAS PÃ…!! Hvad du Ã¦ndrer...!!', '...'),
(74, 'Choose test', 'Choose test', '', 'VÃ¦lg test', '...'),
(75, 'No environment attached', 'No environment attached', '', 'Intet miljÃ¸ tilknyttet', '...'),
(76, 'Edit users', 'Edit users', '', 'Rediger brugere', '...'),
(77, 'Edit projects', 'Edit projects', '', 'Rediger projekter', '...'),
(78, 'Edit tests', 'Edit tests', '', 'Rediger tests', '...'),
(79, 'yyyy-mm-dd', 'yyyy-mm-dd', '', 'yyyy-mm-dd', '...'),
(80, 'Name', 'Name', '', 'Navn', '...'),
(81, 'Usertype', 'Usertype', '', 'Brugertype', '...'),
(82, 'Email', 'Email', '', 'Email', '...'),
(83, 'Previous 15', 'Previous 15', '', 'Forrige 15', '...'),
(84, 'Next 15', 'Next 15', '', 'NÃ¦ste 15', '...'),
(85, 'Pass man.', 'Pass man.', '', 'Godkend man.', '...'),
(87, 'Add', 'Add', '', 'TilfÃ¸j', '...'),
(88, 'Back to admin site', 'Back to admin site', '', 'Tilbage til admin siden', '...'),
(89, 'Save', 'Save', '', 'Gem', '...'),
(90, 'Pass', 'Pass', '', 'Godkend', '...'),
(91, 'Interval', 'Interval', '', 'Interval', '...'),
(92, 'Allowed:', 'Allowed:', '', 'Adgang:', '...'),
(93, 'Not allowed:', 'Not allowed:', '', 'Ikke adgang:', '...'),
(94, 'No test', 'No test', '', 'Ingen test tilknyttet dette projekt', '...'),
(95, 'Site', 'Site', '', 'Side', '...'),
(96, 'Testsuite path', 'Testsuite path', '', 'Testsuite sti', '...'),
(97, 'TR location', 'TestRunner.html location', '', 'TestRunner.html placering', '...'),
(98, 'No project sites attached', 'No project sites attached', '', 'Ingen projekt sider tilknyttet', '...'),
(99, 'Add site to this project', 'Add site to this project', '', 'Tilknyt side til dette projekt', '...'),
(100, 'Add project', 'Add project', '', 'TilfÃ¸j projekt', '...'),
(101, 'Delete', 'Delete', '', 'Slet', '...'),
(102, 'confirmDelete', 'Are you sure you want to delete this?', '', 'Er du sikker pÃ¥ du vil slette dette?', '...'),
(103, 'Add test to this project', 'Add test to this project', '', 'TilfÃ¸j test til dette projekt', '...'),
(104, 'No project description', 'Collects all testsuites that does not have a project specified', '', 'Opsamler alle testsuiter der ikke har et projekt tilknyttet', '...'),
(105, 'You have to choose 2 suites', 'You have to choose 2 suites', '', 'Du skal vÃ¦lge 2 suiter', '...'),
(106, 'Run test', 'Run test', '', 'KÃ¸r test', '...'),
(108, 'Generate testlink', 'Generate direct link to this test', '', 'Generer direkte link til denne test', '...'),
(109, 'Direct link warning', 'Warning! Your username and password is readable in the direct link', '', 'Advarsel! Dit brugernavn og kode er synligt i det direkte link', '...'),
(110, 'First name', 'First name', '', 'Fornavn', '...'),
(111, 'Last name', 'Last name', '', 'Efternavn', '...'),
(112, 'Status', 'Status', '', 'Status', '...'),
(113, 'Requirement', 'Requirement', '', 'Krav', '...'),
(114, 'Nr', 'Nr', '', 'Nr', '...'),
(115, 'OS/Browser requirements', 'OS/Browser requirements', '', 'OS/Browser krav', '...'),
(116, 'No access', 'You dont have access to do this', '', 'Du har ikke adgang til at udfÃ¸re denne operation', '...'),
(117, 'Author', 'Author', '', 'Forfatter', '...'),
(118, 'Edit requirements', 'Edit requirements', '', 'Rediger krav', '...'),
(119, 'Site to be tested', 'Site to be tested', '', 'Side der skal testes pÃ¥', '...'),
(120, 'Node location', 'Node location', '', 'Node placering', '...'),
(121, 'Type', 'Type', '', 'Type', '...'),
(122, 'Choose type', 'Choose type', '', 'VÃ¦lg type', '...'),
(123, 'Choose', 'Choose', '', 'VÃ¦lg', '...'),
(124, 'Requirements', 'Requirements', '', 'Krav', '...'),
(125, 'HR', 'Human resources', '', 'Menneskelige resourcer', '...'),
(126, 'Projects', 'Projects', '', 'Projekter', '...'),
(127, 'Submit', 'Submit', '', 'Submit', '...'),
(128, 'Testplan', 'Testplan', '', 'Testplan', '...'),
(129, 'Testrunner', 'Test runner', '', 'Test kÃ¸rer', '...'),
(130, 'Testrunner nodes', 'Testrunner nodes', '', 'Testrunner noder', '...'),
(131, 'Testrunner core', 'Testrunner core', '', 'Testrunner core', '...'),
(132, 'Core tests', 'Core tests', '', 'Core tests', '...'),
(133, 'Node tests', 'Node tests', '', 'Node tests', '...'),
(134, 'Edit core sites', 'Edit core sites', '', 'Rediger core sider', '...'),
(135, 'Core sites', 'Core sited', '', 'Core sider', '...'),
(136, 'Node sites', 'Node sites', '', 'Node sider', '...'),
(137, 'OS', 'OS', '', 'OS', '...'),
(138, 'Browsers', 'Browsers', '', 'Browsere', '...'),
(139, 'Types', 'Types', '', 'Typer', '...'),
(140, 'Edit nodes', 'Edit nodes', '', 'Rediger noder', '...'),
(141, 'Type path', 'Type path', '', 'Type sti', '...'),
(142, 'Add node', 'Add node', '', 'TilfÃ¸j node', '...'),
(143, 'Edit misc', 'Edit misc', '', 'Rediger div.', '...'),
(144, 'Typename', 'Type name', '', 'Type navn', '...'),
(145, 'Add type', 'Add type', '', 'TilfÃ¸j type', '...'),
(146, 'Add browser', 'Add browser', '', 'TilfÃ¸j browser', '...'),
(147, 'Add OS', 'Add OS', '', 'TilfÃ¸j OS', '...'),
(148, 'Access', 'Access', '', 'Adgang', '...'),
(149, 'Node', 'Node', '', 'Node', '...'),
(150, 'FTP access', 'FTP access', '', 'FTP access', '...'),
(151, 'Choose node', 'Choose node', '', 'VÃ¦lg node', '...'),
(152, 'Guest account', 'Guest account', '', 'GÃ¦ste konto', '...'),
(153, 'Guest name', 'Guest name', '', 'GÃ¦ste navn', '...'),
(154, 'Guest password', 'Guest password', '', 'GÃ¦ste kodeord', '...'),
(155, 'Edit usertype access', 'Edit usertype access', '', 'Rediger brugertype adgang', '...'),
(156, 'Choose usertype', 'Choose usertype', '', 'VÃ¦lg brugertype', '...'),
(157, 'Sites', 'Sites', '', 'Sider', '...'),
(158, 'Add site', 'Add site', '', 'TilfÃ¸j side', '...'),
(159, 'noclosemsg', 'Testsuite running. Do not close window untill it finishes loading', '', 'Test kÃ¸rer. Luk ikke vinduet fÃ¸r siden er fÃ¦rdig med at indlÃ¦se', '...'),
(161, 'Testing', 'Testing', '', 'Tester', '...'),
(162, 'Usertypes', 'Usertypes', '', 'Brugertyper', '...'),
(163, 'Add usertype', 'Add usertype', '', 'TilfÃ¸j brugertype', '...'),
(164, 'Schedule tests', 'Schedule tests', '', 'PlanlÃ¦g test', '...'),
(165, 'Add scheduled test', 'Add scheduled test', '', 'TilfÃ¸j planlagt test', '...'),
(166, 'All minutes', 'All minutes', '', 'Alle minutter', '...'),
(167, 'All hours', 'All hours', '', 'Alle timer', '...'),
(168, 'All days', 'All days', '', 'Alle dage', '...'),
(169, 'All months', 'All months', '', 'Alle mÃ¥neder', '...'),
(170, 'All weekdays', 'All weekdays', '', 'Alle ugedage', '...'),
(171, 'Minute', 'Minute', '', 'Minut', '...'),
(172, 'Hour', 'Hour', '', 'Time', '...'),
(173, 'Day', 'Day', '', 'Dage', '...'),
(174, 'Month', 'Month', '', 'MÃ¥ned', '...'),
(175, 'Weekday', 'Weekday', '', 'Ugedag', '...'),
(176, 'Task', 'Task', '', 'Opgave', '...'),
(177, 'Start', 'Start', '', 'Start', '...'),
(178, 'Home', 'Home', '', 'Hjem', '...'),
(179, 'Choose datafile', 'Choose datafile', '', 'VÃ¦lg datafil', '...'),
(180, 'There is no difference', 'There is no difference', '', 'De er ens', '...'),
(181, 'You have to choose 2 runs of the same testsuite', 'You have to choose 2 runs of the same testsuite', '', 'Du skal vÃ¦lge 2 rapporter fra den samme test suite', '...'),
(204, 'Show comments', 'Show comments', '', 'Vis kommentarer', '...'),
(183, 'Show requirements', 'Show requirements', '', 'Vis kravstatus', '...'),
(184, 'Choose your current browser', 'Choose your current browser', '', 'VÃ¦lg din nuvÃ¦rende browser', '...'),
(185, 'Choose your current OS', 'Choose your current OS', '', 'VÃ¦lg dit nuvÃ¦rende styresystem', '...'),
(186, 'Add new OS/browser to this requirements', 'Add new OS/browser to this requirements', '', 'TilfÃ¸j nyOS/browser til dette krav', '...'),
(187, 'Add new', 'Add new', '', 'TilfÃ¸j ny', '...'),
(188, 'Test Plan', 'Test Plan', '', 'Test Plan', '...'),
(189, 'Add test to this requirement', 'Add test to this requirement', '', 'TilfÃ¸j test til dette krav', '...'),
(190, 'Priority', 'Priority', '', 'Prioritet', '...'),
(191, 'Urgent', 'Urgent', '', 'Yderst vigtigt', '...'),
(192, 'Very high', 'Very high', '', 'Meget vigtig', '...'),
(193, 'High', 'High', '', 'Vigtig', '...'),
(194, 'Medium', 'Medium', '', 'Mellem', '...'),
(195, 'Low', 'Low', '', 'Lav', '...'),
(196, 'Disabled', 'Disabled', '', 'Deaktiveret', '...'),
(197, 'Suite results', 'Suite results', '', 'Suite resultater', '...'),
(198, 'matrix', 'OS / Browser matrix', '', 'Styresystem / Browser matrix', '...'),
(199, 'View Matrix', 'View Matrix', '', 'Vis Matrice', '...'),
(200, 'close', 'Close', '', 'Luk', '...'),
(201, 'Show full desc', 'Show full description', '', 'Vis hele beskrivelsen', '...'),
(202, 'Network_drive', 'Network drive', '', 'NetvÃ¦rksdrev', '...'),
(203, 'Write comment', 'Write comment to this test', '', 'Skriv kommentar til denne test', '...'),
(205, 'Headline', 'Headline', '', 'Overskrift', '...'),
(206, 'Comment', 'Comment', '', 'Kommentar', '...'),
(207, 'View Screenshot', 'View screenshot of this error', '', 'Vis skÃ¦rmbillede af fejlen', '...'),
(208, 'Date time', 'Date time', '', 'Dato tid', '...'),
(209, 'Send to analysis', 'Send to analysis', '', 'Send til analyse', '...'),
(210, 'Analysis', 'Analysis', '', 'Analyse', '...'),
(211, 'Send to raw data', 'Send to raw data', '', 'Send til rÃ¥ data', '...'),
(212, 'Raw data', 'Raw data', '', 'RÃ¥ data', '...'),
(213, 'Sites to test', 'Sites to test', '', 'Sider der skal testes', '...'),
(214, 'Show defects', 'Show defects', '', 'Vis defekter', '...'),
(215, 'Add defect', 'Add defect', '', 'TilfÃ¸j defekt', '...'),
(216, 'Pass manually', 'Pass manually', '', 'Godkend manuelt', '...'),
(217, 'Manually passed', 'Manually passed', '', 'Manuelt godkendt', '...'),
(218, 'Remove manual pass', 'Remove manual pass', '', 'Fjern manuel godkendelse', '...'),
(219, 'Req num', 'Requirement no.', '', 'Krav nr.', '...'),
(220, 'Req name', 'Requirement name', '', 'Krav navn', '...'),
(221, 'Created', 'Created', '', 'Oprettet', '...'),
(222, 'Created by', 'Created by', '', 'Oprettet af', '...'),
(223, 'Last updated', 'Last updated', '', 'Sidst updateret', '...'),
(224, 'Updated by', 'Updated by', '', 'Opdateret af', '...'),
(225, 'Affected Reqs', 'Affected Requirements', '', 'PÃ¥virkede krav', '...'),
(226, 'Defect', 'Defect', '', 'Defekt', '...'),
(227, 'Decription', 'Decription', '', 'Beskrivelse', '...'),
(228, 'Comments', 'Comments', '', 'Kommentarer', '...'),
(229, 'Add comment', 'Add comment', '', 'TilfÃ¸j kommentar', '...'),
(230, 'Reqs overview', 'Requirement overview', '', 'Krav overblik', '...'),
(231, 'Defects', 'Defects', '', 'Defekter', '...'),
(232, 'Properties', 'Properties', '', 'Egenskaber', '...'),
(233, 'Error in test', 'Error in test', '', 'Fejl i testen', '...'),
(235, 'Open', 'Open', '', 'Ã…ben', '...'),
(236, 'In Progress', 'In Progress', '', 'IgangvÃ¦rende', '...'),
(237, 'Resolved', 'Resolved', '', 'Problem lÃ¸st', '...'),
(238, 'Rejected', 'Rejected', '', 'Afvist', '...'),
(239, 'Plan test', 'Plan this test', '', 'PlanlÃ¦g test', '...'),
(240, 'Test name', 'Test name', '', 'Test navn', '...'),
(241, 'Help', 'Help', '', 'HjÃ¦lp', '...'),
(242, 'Time date', 'Time date', '', 'Tid Dato', '...'),
(243, 'Manual runner', 'Manual runner', '', 'Manuel testkÃ¸rsel', '...'),
(244, 'Testcases', 'Testcases', '', 'Testcases', '...'),
(245, 'Edit', 'Edit', '', 'Rediger', '...'),
(246, 'or', 'or', '', 'eller', '...'),
(247, 'Test name help', 'Test name cannot contain any spaces or special characters', '', 'Test navn mÃ¥ ikke indeholde nogle mellemrum eller specielle tegn(bl.a. Ã¦, Ã¸ og Ã¥)', '...'),
(248, 'Reaction', 'Reaction', '', 'Systemet svarer', '...'),
(249, 'Action', 'Action', '', 'Du gÃ¸r', '...'),
(250, 'testcase equals test', 'Choose the testcase the test equals', '', 'VÃ¦lg den testcase som test passer med', '...'),
(251, 'Choose a file to upload', 'Choose a file to upload', '', 'VÃ¦lg fil som skal uploades', '...'),
(252, 'Advanced FTP functionality', 'Advanced FTP functionality', '', 'Advanceret FTP', '...'),
(253, 'Already uploaded tests', 'Already uploaded tests', '', 'Allerede uploadede test', '...'),
(254, 'Config', 'Config', '', 'Konfigurering', ''),
(255, 'Type of defect', 'Type of defect', '', 'Defekt type', ''),
(256, 'Type of defect status', 'Type of defect status', '', 'Defekt status type ', ''),
(257, 'Variable', 'Variable', '', 'Variabel', ''),
(258, 'Value', 'Value', '', 'VÃ¦rdi', ''),
(259, 'Edit core suites', 'Edit core suites', '', 'Rediger core suites', ''),
(260, 'Already uploaded', 'Already uploaded', '', 'Allerede uploadet', ''),
(261, 'Edit node tests', 'Edit node tests', '', 'Rediger node tests', ''),
(262, 'Test error', 'Test error', '', 'Test fejl', ''),
(263, 'Request', 'Request', '', 'Anmodning', ''),
(264, 'Functionality', 'Functionality', '', 'Funktionalitet', ''),
(265, 'Layout', 'Layout', '', 'Layout', ''),
(266, 'Data', 'Data', '', 'Data', ''),
(267, 'Ready for test', 'Ready for test', '', 'Klar til test', ''),
(268, 'Image path', 'Image path', '', 'Billedsti', ''),
(269, 'Comment added', 'Comment added', '', 'Kommentar tilfÃ¸jet', ''),
(270, 'Already exist', 'already exist', '', 'eksisterer allerede', ''),
(271, 'is missing', 'is missing', '', 'mangler', ''),
(272, 'OS-browser combi already exist', 'That OS/Browser combination already exist', '', 'Den OS/Browser kombination eksisterer allerede', ''),
(273, 'Req with same nr exist', 'A requirement with same unique nr already exist', '', 'Der findes allerede et krav, med det unikke nr', ''),
(274, 'Both action fields must contain text', 'Both action fields must contain text', '', 'Begge handlingsfelter skal udfyldes', ''),
(275, 'must not be empty', 'must not be empty', '', 'mÃ¥ ikke vÃ¦re blanke', ''),
(276, 'and', 'and', '', 'og', ''),
(277, 'Same project name error', 'You cannot have 2 projects with the same name', '', '2 projekter med samme navn er ikke tilladt', ''),
(278, 'Name contains illegal characters', 'Name contains illegal characters', '', 'Navn indeholder ugyldige karakter', ''),
(279, 'All fields must be filled out', 'All fields must be filled out', '', 'Alle felter skal vÃ¦re udfyldt', ''),
(280, 'Attachment', 'Attachment', '', 'VedhÃ¦ftet fil', ''),
(281, 'Succesfully inserted', 'Succesfully inserted', '', 'Succesfuld indsÃ¦tning af', ''),
(282, 'out of', 'out of', '', 'ud af', ''),
(283, 'tests', 'tests', '', 'tests', ''),
(284, 'commands', 'commands', '', 'kommandoer', ''),
(285, 'Test started', 'Test started', '', 'Test startet', ''),
(286, 'No tests', 'No tests available', '', 'Ingen test tilgÃ¦ngelige', ''),
(287, 'Assigned to', 'Assigned to', '', 'Tildelt til', ''),
(288, 'Filename must not be empty', 'Filename must not be empty', '', 'Filnavn mÃ¥ ikke vÃ¦re blankt', ''),
(289, 'Upload file', 'Upload file', '', 'Upload fil', ''),
(290, 'Stored in', 'Stored in', '', 'Gemt i', '');

-- --------------------------------------------------------

--
-- Table structure for table `trm_langlist`
--

CREATE TABLE IF NOT EXISTS `trm_langlist` (
  `ID` int(11) NOT NULL auto_increment,
  `abbrv` varchar(255) character set latin1 NOT NULL,
  `full` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `trm_langlist`
--

INSERT INTO `trm_langlist` (`ID`, `abbrv`, `full`) VALUES
(1, 'dk', 'Danish'),
(2, 'en', 'English'),
(6, 'de', 'German');

-- --------------------------------------------------------

--
-- Table structure for table `trm_nodes`
--

CREATE TABLE IF NOT EXISTS `trm_nodes` (
  `ID` int(11) NOT NULL auto_increment,
  `nodepath` varchar(255) collate utf8_bin NOT NULL,
  `o_id` int(11) NOT NULL,
  `description` longtext collate utf8_bin NOT NULL,
  `network_drive` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Dumping data for table `trm_nodes`
--

INSERT INTO `trm_nodes` (`ID`, `nodepath`, `o_id`, `description`, `network_drive`) VALUES
(15, 'localhost', 1, 0x6c6f63616c686f7374, '');

-- --------------------------------------------------------

--
-- Table structure for table `trm_nodes_browsers`
--

CREATE TABLE IF NOT EXISTS `trm_nodes_browsers` (
  `ID` int(11) NOT NULL auto_increment,
  `b_id` int(11) NOT NULL,
  `n_id` int(11) NOT NULL,
  `browser_path` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `trm_nodes_browsers`
--

INSERT INTO `trm_nodes_browsers` (`ID`, `b_id`, `n_id`, `browser_path`) VALUES
(1, 1, 15, '*iexplore'),
(2, 3, 15, '*firefox'),
(3, 10, 15, '*chrome'),
(4, 11, 15, '*iehta');

-- --------------------------------------------------------

--
-- Table structure for table `trm_os`
--

CREATE TABLE IF NOT EXISTS `trm_os` (
  `ID` int(11) NOT NULL auto_increment,
  `OSname` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `name` (`OSname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `trm_os`
--

INSERT INTO `trm_os` (`ID`, `OSname`) VALUES
(1, 'Vista'),
(2, 'Linux'),
(3, '2000'),
(4, 'os x'),
(5, '98'),
(6, '95'),
(12, 'XP');

-- --------------------------------------------------------

--
-- Table structure for table `trm_projectlist`
--

CREATE TABLE IF NOT EXISTS `trm_projectlist` (
  `id` int(11) NOT NULL auto_increment,
  `userID` int(11) NOT NULL default '0',
  `projectID` int(11) NOT NULL default '0',
  `access` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1334 ;

--
-- Dumping data for table `trm_projectlist`
--

INSERT INTO `trm_projectlist` (`id`, `userID`, `projectID`, `access`) VALUES
(644, 72, 1, 1),
(690, 1, 1, 1),
(966, 104, 1, 1),
(1239, 113, 1, 0),
(1233, 112, 1, 0),
(1245, 114, 1, 0),
(1328, 1, 123, 0),
(1329, 72, 123, 0),
(1330, 104, 123, 1),
(1331, 112, 123, 0),
(1332, 113, 123, 0),
(1333, 114, 123, 0);

-- --------------------------------------------------------

--
-- Table structure for table `trm_projects`
--

CREATE TABLE IF NOT EXISTS `trm_projects` (
  `id` int(11) NOT NULL auto_increment,
  `name` text character set latin1 NOT NULL,
  `description` text character set latin1 NOT NULL,
  `assigned` int(255) NOT NULL,
  `outsidedefects` tinyint(1) NOT NULL,
  `viewdefectsurl` varchar(256) collate utf8_bin NOT NULL,
  `adddefecturl` varchar(256) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=124 ;

--
-- Dumping data for table `trm_projects`
--

INSERT INTO `trm_projects` (`id`, `name`, `description`, `assigned`, `outsidedefects`, `viewdefectsurl`, `adddefecturl`) VALUES
(1, 'No project', '', 0, 0, '', ''),
(123, 'sample', 'A sample project', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `trm_projects_has_sites`
--

CREATE TABLE IF NOT EXISTS `trm_projects_has_sites` (
  `ID` int(11) NOT NULL auto_increment,
  `p_id` int(11) NOT NULL,
  `sitetotest` longtext collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=38 ;

--
-- Dumping data for table `trm_projects_has_sites`
--

INSERT INTO `trm_projects_has_sites` (`ID`, `p_id`, `sitetotest`) VALUES
(36, 122, 0x687474703a2f2f7777772e6b72616b2e646b),
(37, 123, 0x687474703a2f2f7777772e676f6f676c652e636f6d);

-- --------------------------------------------------------

--
-- Table structure for table `trm_reqsosbrows`
--

CREATE TABLE IF NOT EXISTS `trm_reqsosbrows` (
  `ID` int(11) NOT NULL auto_increment,
  `b_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `b_id` (`b_id`,`o_id`,`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=157 ;

--
-- Dumping data for table `trm_reqsosbrows`
--

INSERT INTO `trm_reqsosbrows` (`ID`, `b_id`, `o_id`, `r_id`) VALUES
(154, 11, 1, 330),
(152, 10, 1, 328),
(153, 11, 1, 329),
(155, 10, 1, 330),
(156, 13, 4, 328);

-- --------------------------------------------------------

--
-- Table structure for table `trm_reqstests`
--

CREATE TABLE IF NOT EXISTS `trm_reqstests` (
  `ID` int(11) NOT NULL auto_increment,
  `t_name` varchar(255) collate utf8_bin NOT NULL,
  `r_id` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=91 ;

--
-- Dumping data for table `trm_reqstests`
--

INSERT INTO `trm_reqstests` (`ID`, `t_name`, `r_id`) VALUES
(87, 'trille', 328),
(88, 'trille2', 329),
(89, 'trille', 330),
(90, 'trille2', 330);

-- --------------------------------------------------------

--
-- Table structure for table `trm_requirements`
--

CREATE TABLE IF NOT EXISTS `trm_requirements` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_bin NOT NULL,
  `description` longtext collate utf8_bin NOT NULL,
  `p_id` int(11) NOT NULL,
  `nr` varchar(6) collate utf8_bin NOT NULL,
  `author` varchar(255) collate utf8_bin NOT NULL,
  `priority` enum('Urgent','Very high','High','Medium','Low') collate utf8_bin NOT NULL,
  `assigned` int(255) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `p_id` (`p_id`,`nr`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=331 ;

--
-- Dumping data for table `trm_requirements`
--

INSERT INTO `trm_requirements` (`ID`, `name`, `description`, `p_id`, `nr`, `author`, `priority`, `assigned`) VALUES
(328, 'trille', 0x5468697320697320616e206578616d706c65206f66206120726571756972656d656e742e20577269746520796f7572206465736372697074696f6e2068657265210d0a3c2d2d2057726974652061206e7220616e642061206e616d6520746f20746865206c6566740d0a43686f6f73652062726f7773657220616e64204f5320636f6d62696e6174696f6e2c207072696f7269747920616e642061737369676e656520746f20746865207269676874202d2d3e, 123, '1', 'admin', 'Urgent', 0),
(329, 'trille2', 0x5468697320697320616e6f7468657220726571756972656d656e74, 123, '2', 'admin', 'Medium', 0),
(330, 'trille_trille2', 0x59657420616e6f7468657220726571756972656d656e740d0a0d0a596f752063616e206c696e6b20612074657374206361736520746f206120726571756972656d656e7420756e6465722054657374204c6162202d3e205465737420706c616e0d0a496e2074686973206578616d706c653a200d0a726571756972656d656e74202d7472696c6c652d206973206c696e6b656420746f202d7472696c6c652d207465737420636173650d0a726571756972656d656e74202d7472696c6c65322d206973206c696e6b656420746f202d7472696c6c65322d207465737420636173650d0a726571756972656d656e74202d7472696c6c655f7472696c6c65322d206973206c696e6b656420746f20626f7468202d7472696c6c652d20414e44202d7472696c6c65322d2074657374206361736573, 123, '3', 'admin', 'High', 0);

-- --------------------------------------------------------

--
-- Table structure for table `trm_selenium_server_vars`
--

CREATE TABLE IF NOT EXISTS `trm_selenium_server_vars` (
  `sessionId` varchar(255) NOT NULL,
  `nodepath` varchar(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `t_id` int(11) NOT NULL,
  PRIMARY KEY  (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trm_selenium_server_vars`
--

INSERT INTO `trm_selenium_server_vars` (`sessionId`, `nodepath`, `u_id`, `t_id`) VALUES
('390b3205b35148c388c06c7a7b4b08da', 'localhost', '122243041827819', 25),
('8fdaef03f73a4a2f90619e5f222cec0f', 'localhost', '122243161302869', 27),
('252422434ce9430c91f000289673e6c6', 'localhost', '122243169558310', 29),
('262c765a5bbb468fb2dd00882068919d', 'localhost', '122243202122134', 31),
('2b0327ec8f214caba10148c87e216181', 'localhost', '122243222966804', 33),
('a4608a722af4426d95f0bbfc6d7e2d37', 'localhost', '122243238307516', 34),
('4ae16f7143e848f2bb1dd6c7a328059e', 'localhost', '122243243142383', 35),
('9a1ec64b11c04867b6a8d40fd77aa858', 'localhost', '122243249842618', 36),
('94bf390cde134fb391ce3dff28b4398f', 'localhost', '12224335971228', 37);

-- --------------------------------------------------------

--
-- Table structure for table `trm_sites`
--

CREATE TABLE IF NOT EXISTS `trm_sites` (
  `ID` int(11) NOT NULL auto_increment,
  `sitename` varchar(255) collate utf8_bin NOT NULL,
  `description` longtext collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `sitename` (`sitename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=99 ;

--
-- Dumping data for table `trm_sites`
--

INSERT INTO `trm_sites` (`ID`, `sitename`, `description`) VALUES
(2, 'editHR.php', 0x417373696e672070656f706c6520746f2070726f6a65637473),
(54, 'testlabindex.php', 0x496e646578207061676520666f72207468652074657374206c6162),
(7, 'corerunner.php', 0x52756e7320636f7265207465737473),
(55, 'adminindex.php', 0x41646d696e20696e6465782070616765),
(59, 'saveNodes.php', 0x5361766573206e6f64652064617461),
(14, 'header.php', 0x496e636c7564656420696e206d6f73742066696c65732c20696e636c75646520636f7079726967687420616e64206c616e67756167652068616e646c6572),
(15, 'index.php', 0x4669727374207061676520746f20686974),
(58, 'editCron.php', 0x506c616e20746573747320746f2072756e20696e20746865206675747572652e205761726e696e6721212044616e6765726f75732e2043616e20706c616e20414e595448494e472121),
(18, 'main.php', 0x53686f777320737569746520726573756c7473),
(19, 'menu.php', 0x546865206272696768746c7920636f6c6f726564206d656e75),
(53, 'projectsindex.php', 0x50726f6a6563747320696e6465782070616765),
(24, 'editProjects.php', 0x4372656174652f456469742070726f6a65637473),
(98, 'editData.php', 0x4d616e61676520746573742064617461),
(51, 'saveUserTypeAccess.php', 0x5361766520757365727479706520616363636573732064617461),
(68, 'showFullReqs.php', 0x53686f7720612073696e676c6520726571756972656d656e74207374796c656420666f72207072696e74696e67),
(29, 'saveHR.php', 0x536176652070656f706c652f70726f6a6563742061737369676e6d656e7473),
(30, 'saveProjects.php', 0x53617665732070726f6a656374732064617461),
(32, 'showReport.php', 0x53686f77732074686520726573756c7473206f6620612073696e676c65207375746965),
(97, 'saveData.php', 0x53617665206461746166696c65),
(50, 'editUserTypeAccess.php', 0x4564697420757365727479706520616363657373),
(38, 'delete.php', 0x48616e646c657320616c6c2064656c65746573),
(39, 'editMisc.php', 0x45646974206d6973632e20696e666f),
(40, 'editNodes.php', 0x45646974206e6f64657320286c6f636174696f6e2f62726f7773657273206574632e29),
(41, 'editSites.php', 0x4564697420636f7265207369746573202854522070617468206574632e29),
(42, 'editUsers.php', 0x456469742f616464207573657273),
(43, 'saveMisc.php', 0x5361766573206d6973632064617461),
(44, 'saveCron.php', 0x5361766573207468652063726f6e746162),
(45, 'saveSites.php', 0x536176657320636f72652073697465732064617461),
(46, 'saveUsers.php', 0x5361766520757365722064617461),
(79, 'manualtest.php', 0x50617274206f66206d616e75616c2074657374),
(67, 'saveRequirements.php', 0x536176657320726571756972656d656e7473),
(78, 'addComment.php', 0x416464206120636f6d6d656e7420746f20616e797468696e67),
(61, 'statusRC.php', 0x53686f77732074686520737461747573206f66207468652072756e6e696e672052432074657374),
(62, 'testRunnerRC.php', 0x52756e73205243207465737473),
(63, 'editRequirements.php', 0x456469742074686520726571756972656d656e7473),
(64, 'showReqs.php', 0x53686f7720616c6c20726571756972656d656e7473),
(65, 'editTestPlan.php', 0x41737369676e20746573747320746f2070726f6a65637473),
(66, 'TRMindex.php', 0x54524d20696e6465782070616765),
(70, 'editTest.php', 0x70726f7065727469657320666f7220612073696e676c652074657374),
(71, 'analysis.php', 0x53686f77732074686520737569746573206d61726b656420666f7220616e616c79736973),
(72, 'showDefects.php', 0x53686f7720616c6c2064656665637473),
(73, 'editDefectPopup.php', 0x53686f777320612073696e676c652064656665637420696e206120706f7075702077696e646f77),
(74, 'saveDefect.php', 0x47656d6d65722f4f70646174657265722064656665637473),
(75, 'saveComment.php', 0x536176657320636f6d6d656e7473),
(83, 'manualControl.php', 0x50617274206f66206d616e75616c2074657374),
(82, 'saveManStatus.php', 0x536176652074686520726573756c74732063726561746520696e2061206d616e75616c2074657374),
(84, 'manualRunner.php', 0x50617274206f66206d616e75616c2074657374),
(85, 'editTestCase.php', 0x456469742074657374206361736573),
(86, 'createManSuite.php', 0x4372656174652061207375697465207768656e20796f752072756e2061206d616e75616c2074657374),
(87, 'saveTestCase.php', 0x5361766520746573746361736573),
(88, 'saveTestPlan.php', 0x53617665732074657374706c616e),
(89, 'simpleFTP.php', 0x48616e646c65732075706c6f6164206f6620746573747320746f20736572766572),
(90, 'uploader.php', 0x446f207468652061637475616c2075706c6f6164),
(91, 'genericRunner.php', 0x52756e20524320746573747320776974686f75742061207375697465),
(92, 'editCoreSuites.php', 0x4564697420636f726520737569746573),
(93, 'saveCoreSuites.php', 0x5361766520636f726520737569746573),
(96, 'ajaxCron.php', 0x617364),
(95, 'download.php', '');

-- --------------------------------------------------------

--
-- Table structure for table `trm_suite`
--

CREATE TABLE IF NOT EXISTS `trm_suite` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `suitename` varchar(255) character set latin1 collate latin1_danish_ci NOT NULL,
  `environment` varchar(255) character set latin1 NOT NULL,
  `status` varchar(255) character set latin1 collate latin1_danish_ci NOT NULL default '0',
  `timeDate` datetime default NULL,
  `timeTaken` int(10) unsigned default NULL,
  `browser` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `platform` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `selenium_version` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `selenium_revision` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `numTestPassed` int(10) unsigned default NULL,
  `numTestFailed` int(10) unsigned default NULL,
  `numCommandsPassed` int(10) unsigned default NULL,
  `numCommandsFailed` int(10) unsigned default NULL,
  `numCommandsErrors` int(10) unsigned default NULL,
  `p_id` int(11) NOT NULL default '0',
  `analysis` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=23 ;

--
-- Dumping data for table `trm_suite`
--

INSERT INTO `trm_suite` (`ID`, `suitename`, `environment`, `status`, `timeDate`, `timeTaken`, `browser`, `platform`, `selenium_version`, `selenium_revision`, `numTestPassed`, `numTestFailed`, `numCommandsPassed`, `numCommandsFailed`, `numCommandsErrors`, `p_id`, `analysis`) VALUES
(19, 'trille,1', 'http://www.google.com', 'passed', '2008-09-26 14:33:03', 29, '10', '1', 'RC', '', 1, 0, 2, 0, 0, 123, 1),
(20, 'trille,1', 'http://www.google.com', 'failed', '2008-09-26 14:33:51', 23, '11', '1', 'RC', '', 0, 1, 0, 1, 0, 123, 1),
(21, 'trille,1', 'http://www.google.com', 'passed', '2008-09-26 14:34:58', 23, '11', '1', 'RC', '', 1, 0, 2, 0, 0, 123, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trm_tempcommands`
--

CREATE TABLE IF NOT EXISTS `trm_tempcommands` (
  `id` int(11) NOT NULL auto_increment,
  `u_id` varchar(255) collate utf8_bin NOT NULL,
  `action` text collate utf8_bin NOT NULL,
  `var1` text collate utf8_bin NOT NULL,
  `var2` text collate utf8_bin NOT NULL,
  `status` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=235 ;

--
-- Dumping data for table `trm_tempcommands`
--


-- --------------------------------------------------------

--
-- Table structure for table `trm_test`
--

CREATE TABLE IF NOT EXISTS `trm_test` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `status` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `name` varchar(45) character set latin1 collate latin1_danish_ci default NULL,
  `s_id` int(10) unsigned default NULL,
  `Thelp` longtext character set latin1 collate latin1_danish_ci NOT NULL,
  `manstatus` varchar(255) character set latin1 NOT NULL,
  `author` int(11) default NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=38 ;

--
-- Dumping data for table `trm_test`
--

INSERT INTO `trm_test` (`ID`, `status`, `name`, `s_id`, `Thelp`, `manstatus`, `author`) VALUES
(34, 'passed', 'trille', 19, 'rc-php', '', NULL),
(35, 'failed', 'trille2', 20, 'rc-php', '', NULL),
(36, 'passed', 'trille', 21, 'rc-php', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trm_types`
--

CREATE TABLE IF NOT EXISTS `trm_types` (
  `ID` int(11) NOT NULL auto_increment,
  `typename` varchar(255) collate utf8_bin NOT NULL,
  `command` varchar(255) collate utf8_bin NOT NULL,
  `spacer` varchar(255) collate utf8_bin NOT NULL,
  `extension` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `trm_types`
--

INSERT INTO `trm_types` (`ID`, `typename`, `command`, `spacer`, `extension`) VALUES
(1, 'rc-php', 'php', ' ', 'php'),
(4, 'rc-java', 'java -jar', ' ', 'jar'),
(10, 'rc-ruby', 'ruby', ' ', 'rb');

-- --------------------------------------------------------

--
-- Table structure for table `trm_type_of_defects`
--

CREATE TABLE IF NOT EXISTS `trm_type_of_defects` (
  `id` int(11) NOT NULL auto_increment,
  `priority` int(11) NOT NULL,
  `name` varchar(255) collate utf8_bin NOT NULL,
  `imgpath` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Dumping data for table `trm_type_of_defects`
--

INSERT INTO `trm_type_of_defects` (`id`, `priority`, `name`, `imgpath`) VALUES
(2, 4, 'Test error', 0x696d672f746573746572726f722e706e67),
(6, 3, 'Request', 0x696d672f726571756573742e706e67),
(1, 0, 'Functionality', 0x696d672f66756e6374696f6e616c6974792e706e67),
(5, 1, 'Layout', 0x696d672f6c61796f75742e706e67),
(7, 2, 'Data', 0x696d672f646174612e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `trm_type_of_defect_status`
--

CREATE TABLE IF NOT EXISTS `trm_type_of_defect_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_bin NOT NULL,
  `imgpath` text collate utf8_bin NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=43 ;

--
-- Dumping data for table `trm_type_of_defect_status`
--

INSERT INTO `trm_type_of_defect_status` (`id`, `name`, `imgpath`, `priority`) VALUES
(4, 'Rejected', 0x696d672f72656a65637465642e706e67, 3),
(1, 'Open', 0x696d672f6f70656e2e706e67, 0),
(2, 'In Progress', 0x696d672f696e70726f67726573732e706e67, 1),
(3, 'Resolved', 0x696d672f7265736f6c7665642e706e67, 4),
(42, 'Ready for test', 0x696d672f7265616479666f72746573742e706e67, 2);

-- --------------------------------------------------------

--
-- Table structure for table `trm_users`
--

CREATE TABLE IF NOT EXISTS `trm_users` (
  `id` int(3) NOT NULL auto_increment,
  `firstname` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `lastname` varchar(255) character set utf8 collate utf8_bin NOT NULL,
  `name` varchar(255) character set latin1 collate latin1_danish_ci NOT NULL,
  `password` varchar(255) character set latin1 collate latin1_danish_ci NOT NULL,
  `usertype` int(11) NOT NULL default '1',
  `email` varchar(255) character set latin1 collate latin1_danish_ci NOT NULL,
  `lastLogin` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci AUTO_INCREMENT=116 ;

--
-- Dumping data for table `trm_users`
--

INSERT INTO `trm_users` (`id`, `firstname`, `lastname`, `name`, `password`, `usertype`, `email`, `lastLogin`) VALUES
(72, '12', '12', 'selftester', '81dc9bdb52d04dc20036dbd8313ed055', 3, '', '2008-04-29 12:50:59'),
(1, 'guest', 'guest', 'guest', '084e0343a0486ff05530df6c705c8bb4', 7, '', '0000-00-00 00:00:00'),
(104, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 3, '', '2008-09-26 12:05:46'),
(113, '', '', 'service', '81dc9bdb52d04dc20036dbd8313ed055', 9, '', '2008-04-17 09:55:18'),
(112, '', '', 'tester', '81dc9bdb52d04dc20036dbd8313ed055', 5, '', '2008-04-17 09:48:40'),
(114, '', '', 'manager', '81dc9bdb52d04dc20036dbd8313ed055', 4, '', '2008-04-16 17:25:58');

-- --------------------------------------------------------

--
-- Table structure for table `trm_usertypes`
--

CREATE TABLE IF NOT EXISTS `trm_usertypes` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Dumping data for table `trm_usertypes`
--

INSERT INTO `trm_usertypes` (`ID`, `name`) VALUES
(1, 'inactive'),
(3, 'admin'),
(4, 'manager'),
(5, 'tester'),
(7, 'guest'),
(9, 'service');

-- --------------------------------------------------------

--
-- Table structure for table `trm_usertype_access`
--

CREATE TABLE IF NOT EXISTS `trm_usertype_access` (
  `ID` int(11) NOT NULL auto_increment,
  `ut_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=895 ;

--
-- Dumping data for table `trm_usertype_access`
--

INSERT INTO `trm_usertype_access` (`ID`, `ut_id`, `s_id`, `access`) VALUES
(583, 3, 64, 1),
(2, 3, 2, 1),
(564, 9, 61, 1),
(792, 9, 84, 1),
(364, 7, 53, 0),
(7, 3, 7, 1),
(744, 9, 78, 1),
(752, 9, 79, 1),
(420, 9, 39, 0),
(784, 9, 83, 1),
(751, 7, 79, 0),
(581, 1, 64, 0),
(14, 3, 14, 1),
(15, 3, 15, 1),
(580, 9, 63, 0),
(427, 9, 46, 0),
(18, 3, 18, 1),
(19, 3, 19, 1),
(796, 4, 85, 1),
(406, 9, 53, 0),
(378, 7, 55, 0),
(24, 3, 24, 1),
(894, 9, 98, 0),
(371, 7, 54, 0),
(579, 7, 63, 0),
(612, 9, 67, 0),
(29, 3, 29, 1),
(30, 3, 30, 1),
(783, 7, 83, 0),
(32, 3, 32, 1),
(350, 7, 51, 0),
(888, 9, 97, 0),
(776, 9, 82, 1),
(343, 7, 50, 0),
(38, 3, 38, 1),
(39, 3, 39, 1),
(40, 3, 40, 1),
(41, 3, 41, 1),
(42, 3, 42, 1),
(43, 3, 43, 1),
(44, 3, 44, 1),
(45, 3, 45, 1),
(46, 3, 46, 1),
(48, 4, 2, 1),
(563, 7, 61, 0),
(791, 7, 84, 0),
(577, 5, 63, 1),
(53, 4, 7, 1),
(743, 7, 78, 0),
(419, 9, 38, 0),
(412, 9, 30, 0),
(576, 4, 63, 1),
(60, 4, 14, 1),
(61, 4, 15, 1),
(575, 3, 63, 1),
(426, 9, 45, 0),
(64, 4, 18, 1),
(65, 4, 19, 1),
(795, 3, 85, 1),
(70, 4, 24, 1),
(611, 7, 67, 0),
(75, 4, 29, 1),
(76, 4, 30, 1),
(78, 4, 32, 1),
(887, 7, 97, 0),
(775, 7, 82, 0),
(84, 4, 38, 1),
(85, 4, 39, 0),
(86, 4, 40, 0),
(87, 4, 41, 0),
(88, 4, 42, 0),
(89, 4, 43, 0),
(90, 4, 44, 1),
(91, 4, 45, 0),
(92, 4, 46, 0),
(573, 1, 63, 0),
(94, 5, 2, 0),
(572, 9, 62, 1),
(362, 5, 53, 1),
(99, 5, 7, 1),
(741, 5, 78, 1),
(749, 5, 79, 1),
(411, 9, 29, 0),
(397, 9, 7, 1),
(571, 7, 62, 0),
(106, 5, 14, 1),
(107, 5, 15, 1),
(425, 9, 44, 0),
(110, 5, 18, 1),
(111, 5, 19, 1),
(404, 9, 19, 1),
(376, 5, 55, 0),
(116, 5, 24, 1),
(893, 7, 98, 0),
(369, 5, 54, 1),
(569, 5, 62, 1),
(121, 5, 29, 0),
(122, 5, 30, 0),
(781, 5, 83, 1),
(124, 5, 32, 1),
(348, 5, 51, 0),
(886, 5, 97, 0),
(341, 5, 50, 0),
(130, 5, 38, 0),
(131, 5, 39, 0),
(132, 5, 40, 0),
(133, 5, 41, 0),
(134, 5, 42, 0),
(135, 5, 43, 0),
(136, 5, 44, 0),
(137, 5, 45, 0),
(138, 5, 46, 0),
(568, 4, 62, 1),
(561, 5, 61, 1),
(789, 5, 84, 1),
(567, 3, 62, 1),
(361, 4, 53, 1),
(740, 4, 78, 1),
(748, 4, 79, 1),
(417, 9, 50, 0),
(609, 5, 67, 0),
(396, 9, 54, 1),
(565, 1, 62, 0),
(424, 9, 43, 0),
(793, 1, 85, 0),
(403, 9, 18, 1),
(375, 4, 55, 0),
(892, 5, 98, 0),
(368, 4, 54, 1),
(548, 9, 59, 0),
(608, 4, 67, 1),
(780, 4, 83, 1),
(347, 4, 51, 0),
(773, 5, 82, 1),
(340, 4, 50, 0),
(547, 7, 59, 0),
(186, 1, 2, 0),
(560, 4, 61, 1),
(788, 4, 84, 1),
(360, 3, 53, 1),
(191, 1, 7, 0),
(739, 3, 78, 1),
(747, 3, 79, 1),
(772, 4, 82, 1),
(409, 9, 51, 0),
(787, 3, 84, 1),
(545, 5, 59, 0),
(198, 1, 14, 0),
(199, 1, 15, 0),
(544, 4, 59, 0),
(423, 9, 42, 0),
(202, 1, 18, 0),
(203, 1, 19, 0),
(720, 9, 75, 1),
(402, 9, 15, 1),
(374, 3, 55, 1),
(208, 1, 24, 0),
(891, 4, 98, 1),
(367, 3, 54, 1),
(543, 3, 59, 1),
(607, 3, 67, 1),
(213, 1, 29, 0),
(214, 1, 30, 0),
(779, 3, 83, 1),
(216, 1, 32, 0),
(346, 3, 51, 1),
(885, 4, 97, 1),
(771, 3, 82, 1),
(339, 3, 50, 1),
(222, 1, 38, 0),
(223, 1, 39, 0),
(224, 1, 40, 0),
(225, 1, 41, 0),
(226, 1, 42, 0),
(227, 1, 43, 0),
(228, 1, 44, 0),
(229, 1, 45, 0),
(230, 1, 46, 0),
(559, 3, 61, 1),
(541, 1, 59, 0),
(884, 3, 97, 1),
(890, 3, 98, 1),
(540, 9, 58, 0),
(539, 7, 58, 0),
(422, 9, 41, 0),
(719, 7, 75, 0),
(401, 9, 14, 1),
(537, 5, 58, 0),
(278, 7, 2, 0),
(557, 1, 61, 0),
(785, 1, 84, 0),
(536, 4, 58, 1),
(358, 1, 53, 0),
(283, 7, 7, 0),
(737, 1, 78, 0),
(745, 1, 79, 0),
(414, 9, 32, 1),
(407, 9, 24, 0),
(393, 9, 2, 0),
(535, 3, 58, 1),
(290, 7, 14, 0),
(291, 7, 15, 0),
(421, 9, 40, 0),
(294, 7, 18, 0),
(295, 7, 19, 0),
(620, 9, 68, 1),
(400, 9, 55, 0),
(372, 1, 55, 0),
(300, 7, 24, 0),
(889, 1, 98, 0),
(365, 1, 54, 0),
(533, 1, 58, 0),
(605, 1, 67, 0),
(305, 7, 29, 0),
(306, 7, 30, 0),
(777, 1, 83, 0),
(308, 7, 32, 1),
(344, 1, 51, 0),
(883, 1, 97, 0),
(769, 1, 82, 0),
(337, 1, 50, 0),
(314, 7, 38, 0),
(315, 7, 39, 0),
(316, 7, 40, 0),
(317, 7, 41, 0),
(318, 7, 42, 0),
(319, 7, 43, 0),
(320, 7, 44, 0),
(321, 7, 45, 0),
(322, 7, 46, 0),
(619, 7, 68, 0),
(617, 5, 68, 1),
(616, 4, 68, 1),
(615, 3, 68, 1),
(613, 1, 68, 0),
(604, 9, 66, 1),
(603, 7, 66, 0),
(601, 5, 66, 1),
(600, 4, 66, 1),
(599, 3, 66, 1),
(597, 1, 66, 0),
(596, 9, 65, 0),
(595, 7, 65, 0),
(593, 5, 65, 1),
(592, 4, 65, 1),
(591, 3, 65, 1),
(589, 1, 65, 0),
(588, 9, 64, 1),
(587, 7, 64, 0),
(585, 5, 64, 1),
(584, 4, 64, 1),
(717, 5, 75, 1),
(716, 4, 75, 1),
(715, 3, 75, 1),
(713, 1, 75, 0),
(712, 9, 74, 0),
(711, 7, 74, 0),
(709, 5, 74, 1),
(708, 4, 74, 1),
(707, 3, 74, 1),
(705, 1, 74, 0),
(704, 9, 73, 0),
(703, 7, 73, 0),
(701, 5, 73, 1),
(700, 4, 73, 1),
(699, 3, 73, 1),
(697, 1, 73, 0),
(696, 9, 72, 1),
(695, 7, 72, 0),
(876, 9, 95, 0),
(693, 5, 72, 1),
(692, 4, 72, 1),
(691, 3, 72, 1),
(689, 1, 72, 0),
(688, 9, 71, 1),
(687, 7, 71, 0),
(875, 7, 95, 0),
(685, 5, 71, 1),
(684, 4, 71, 1),
(683, 3, 71, 1),
(680, 9, 70, 0),
(679, 7, 70, 0),
(874, 5, 95, 0),
(677, 5, 70, 1),
(676, 4, 70, 1),
(675, 3, 70, 1),
(673, 1, 70, 0),
(681, 1, 71, 0),
(797, 5, 85, 1),
(873, 4, 95, 0),
(799, 7, 85, 0),
(800, 9, 85, 0),
(801, 1, 86, 0),
(803, 3, 86, 1),
(804, 4, 86, 1),
(805, 5, 86, 1),
(872, 3, 95, 1),
(807, 7, 86, 0),
(808, 9, 86, 1),
(809, 1, 87, 0),
(811, 3, 87, 1),
(812, 4, 87, 1),
(813, 5, 87, 1),
(871, 1, 95, 0),
(815, 7, 87, 0),
(816, 9, 87, 0),
(817, 1, 88, 0),
(819, 3, 88, 1),
(820, 4, 88, 1),
(821, 5, 88, 1),
(882, 9, 96, 0),
(823, 7, 88, 0),
(824, 9, 88, 0),
(825, 1, 89, 0),
(827, 3, 89, 1),
(828, 4, 89, 1),
(829, 5, 89, 1),
(881, 7, 96, 0),
(831, 7, 89, 0),
(832, 9, 89, 0),
(833, 1, 90, 0),
(835, 3, 90, 1),
(836, 4, 90, 1),
(837, 5, 90, 1),
(880, 5, 96, 0),
(839, 7, 90, 0),
(840, 9, 90, 0),
(841, 1, 91, 0),
(843, 3, 91, 1),
(844, 4, 91, 1),
(845, 5, 91, 1),
(879, 4, 96, 0),
(847, 7, 91, 0),
(848, 9, 91, 1),
(849, 1, 92, 0),
(851, 3, 92, 1),
(852, 4, 92, 1),
(853, 5, 92, 1),
(878, 3, 96, 1),
(855, 7, 92, 0),
(856, 9, 92, 0),
(857, 1, 93, 0),
(859, 3, 93, 1),
(860, 4, 93, 1),
(861, 5, 93, 1),
(877, 1, 96, 0),
(863, 7, 93, 0),
(864, 9, 93, 0);
