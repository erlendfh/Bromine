-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Vært: localhost
-- Genereringstid: 12. 08 2008 kl. 21:49:29
-- Serverversion: 5.0.51
-- PHP-version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `bromine`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_browser`
--

CREATE TABLE IF NOT EXISTS `trm_browser` (
  `ID` int(11) NOT NULL auto_increment,
  `browsername` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `name` (`browsername`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Data dump for tabellen `trm_browser`
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
-- Struktur-dump for tabellen `trm_commands`
--

CREATE TABLE IF NOT EXISTS `trm_commands` (
  `ID` int(10) unsigned NOT NULL auto_increment,
  `status` varchar(255) character set latin1 collate latin1_danish_ci default NULL,
  `action` longtext character set latin1 collate latin1_danish_ci,
  `var1` longtext character set latin1 collate latin1_danish_ci,
  `var2` longtext character set latin1 collate latin1_danish_ci,
  `t_id` int(10) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=92 ;

--
-- Data dump for tabellen `trm_commands`
--

INSERT INTO `trm_commands` (`ID`, `status`, `action`, `var1`, `var2`, `t_id`) VALUES
(40, 'done', 'click', 'btnG', '', 10),
(3, 'failed', 'open', '/', '', 0),
(4, 'failed', 'testComplete', '', '', 0),
(38, 'done', 'open', '/', '', 10),
(39, 'done', 'type', 'q', 'bromine openqa', 10),
(6, 'failed', 'open', '/', '', 0),
(7, 'failed', 'testComplete', '', '', 0),
(37, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 10),
(9, 'failed', 'testComplete', '', '', 0),
(10, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 7),
(11, 'done', 'open', '/', '', 7),
(12, 'done', 'type', 'q', 'bromine openqa', 7),
(13, 'done', 'click', 'btnG', '', 7),
(14, 'done', 'waitForPageToLoad', '30000', '', 7),
(15, 'done', 'click', 'link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA', '', 7),
(16, 'failed', 'waitForPageToLoad', '30000', '', 7),
(17, 'done', 'testComplete', '', '', 7),
(18, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 8),
(19, 'done', 'open', '/', '', 8),
(20, 'done', 'type', 'q', 'bromine', 8),
(21, 'done', 'click', 'btnG', '', 8),
(22, 'done', 'waitForPageToLoad', '30000', '', 8),
(23, 'done', 'click', 'link=Bromine - Wikipedia, the free encyclopedia', '', 8),
(24, 'done', 'waitForPageToLoad', '30000', '', 8),
(25, 'passed', 'isTextPresent', 'Bromine', '', 8),
(26, 'done', 'testComplete', '', '', 8),
(27, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 9),
(28, 'done', 'setContext', 'test_new', '', 9),
(29, 'done', 'open', '/', '', 9),
(30, 'done', 'type', 'q', 'bromine', 9),
(31, 'done', 'click', 'btnG', '', 9),
(32, 'done', 'waitForPageToLoad', '30000', '', 9),
(33, 'done', 'click', 'link=Bromine - Wikipedia, the free encyclopedia', '', 9),
(34, 'done', 'waitForPageToLoad', '30000', '', 9),
(35, 'passed', 'isTextPresent', 'Bromine', '', 9),
(36, 'done', 'testComplete', '', '', 9),
(41, 'done', 'waitForPageToLoad', '30000', '', 10),
(42, 'done', 'click', 'link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA', '', 10),
(43, 'failed', 'waitForPageToLoad', '30000', '', 10),
(44, 'done', 'testComplete', '', '', 10),
(45, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 11),
(46, 'done', 'open', '/', '', 11),
(47, 'done', 'type', 'q', 'bromine', 11),
(48, 'done', 'click', 'btnG', '', 11),
(49, 'done', 'waitForPageToLoad', '30000', '', 11),
(50, 'done', 'click', 'link=Bromine - Wikipedia, the free encyclopedia', '', 11),
(51, 'done', 'waitForPageToLoad', '30000', '', 11),
(52, 'passed', 'isTextPresent', 'Bromine', '', 11),
(53, 'done', 'testComplete', '', '', 11),
(54, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 12),
(55, 'done', 'setContext', 'test_new', '', 12),
(56, 'done', 'open', '/', '', 12),
(57, 'done', 'type', 'q', 'bromine', 12),
(58, 'done', 'click', 'btnG', '', 12),
(59, 'done', 'waitForPageToLoad', '30000', '', 12),
(60, 'done', 'click', 'link=Bromine - Wikipedia, the free encyclopedia', '', 12),
(61, 'done', 'waitForPageToLoad', '30000', '', 12),
(62, 'passed', 'isTextPresent', 'Bromine', '', 12),
(63, 'done', 'testComplete', '', '', 12),
(64, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 13),
(65, 'done', 'open', '/', '', 13),
(66, 'done', 'type', 'q', 'bromine openqa', 13),
(67, 'done', 'click', 'btnG', '', 13),
(68, 'done', 'waitForPageToLoad', '30000', '', 13),
(69, 'done', 'click', 'link=exact:OpenQA: Bromine Blog: Bromine arrives at OpenQA', '', 13),
(70, 'done', 'waitForPageToLoad', '30000', '', 13),
(71, 'passed', 'isTextPresent', 'Bromine', '', 13),
(72, 'done', 'testComplete', '', '', 13),
(73, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 14),
(74, 'done', 'open', '/', '', 14),
(75, 'done', 'type', 'q', 'bromine', 14),
(76, 'done', 'click', 'btnG', '', 14),
(77, 'done', 'waitForPageToLoad', '30000', '', 14),
(78, 'done', 'click', 'link=Bromine - Wikipedia, the free encyclopedia', '', 14),
(79, 'done', 'waitForPageToLoad', '30000', '', 14),
(80, 'passed', 'isTextPresent', 'Bromine', '', 14),
(81, 'done', 'testComplete', '', '', 14),
(82, 'done', 'getNewBrowserSession', '*chrome', 'http://www.google.com', 15),
(83, 'done', 'setContext', 'test_new', '', 15),
(84, 'done', 'open', '/', '', 15),
(85, 'done', 'type', 'q', 'bromine', 15),
(86, 'done', 'click', 'btnG', '', 15),
(87, 'done', 'waitForPageToLoad', '30000', '', 15),
(88, 'done', 'click', 'link=Bromine - Wikipedia, the free encyclopedia', '', 15),
(89, 'done', 'waitForPageToLoad', '30000', '', 15),
(90, 'passed', 'isTextPresent', 'Bromine', '', 15),
(91, 'done', 'testComplete', '', '', 15);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_comments`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `trm_comments`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_config`
--

CREATE TABLE IF NOT EXISTS `trm_config` (
  `id` int(11) NOT NULL auto_increment,
  `var` varchar(255) collate utf8_bin NOT NULL,
  `value` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `var` (`var`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Data dump for tabellen `trm_config`
--

INSERT INTO `trm_config` (`id`, `var`, `value`) VALUES
(1, 'lite_version', '0'),
(2, 'registration', '1');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_core`
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
-- Data dump for tabellen `trm_core`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_core_testsuites`
--

CREATE TABLE IF NOT EXISTS `trm_core_testsuites` (
  `id` int(11) NOT NULL auto_increment,
  `p_id` int(11) NOT NULL,
  `testsuite` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=108 ;

--
-- Data dump for tabellen `trm_core_testsuites`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_cronjobs`
--

CREATE TABLE IF NOT EXISTS `trm_cronjobs` (
  `id` int(11) NOT NULL auto_increment,
  `runtime` datetime NOT NULL,
  `job` text collate utf8_bin NOT NULL,
  `run` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `trm_cronjobs`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_defects`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `trm_defects`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_defect_has_attachment`
--

CREATE TABLE IF NOT EXISTS `trm_defect_has_attachment` (
  `id` int(11) NOT NULL auto_increment,
  `d_id` int(11) NOT NULL,
  `attachment_path` text collate utf8_bin NOT NULL,
  `microtime` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `trm_defect_has_attachment`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_design_manual_commands`
--

CREATE TABLE IF NOT EXISTS `trm_design_manual_commands` (
  `id` int(11) NOT NULL auto_increment,
  `orderby` int(11) NOT NULL,
  `action` text collate utf8_bin NOT NULL,
  `reaction` text collate utf8_bin NOT NULL,
  `td_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Data dump for tabellen `trm_design_manual_commands`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_design_manual_test`
--

CREATE TABLE IF NOT EXISTS `trm_design_manual_test` (
  `id` int(11) NOT NULL auto_increment,
  `name` text collate utf8_bin NOT NULL,
  `p_id` int(11) NOT NULL,
  `Description` longtext collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Data dump for tabellen `trm_design_manual_test`
--

INSERT INTO `trm_design_manual_test` (`id`, `name`, `p_id`, `Description`) VALUES
(1, 0x7472696c6c65, 123, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_lang`
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
-- Data dump for tabellen `trm_lang`
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
(11, 'Cmd. not done', 'Cmd. not done', '', 'K ikke udført', '...'),
(12, 'T graph', 'T graph', '', 'T graf', '...'),
(13, 'Cmd. graph', 'Cmd. graph', '', 'K graf', '...'),
(14, 'To', 'To', '', 'Til', '...'),
(15, 'From', 'From', '', 'Fra', '...'),
(16, 'Show', 'Show', '', 'Vis', '...'),
(17, 'Difference', 'Difference', '', 'Forskel', '...'),
(18, 'Add user', 'Add user', '', 'Tilføj bruger', '...'),
(19, 'See old reports', 'See old reports', '', 'Se gamle rapporter', '...'),
(20, 'Users', 'Users', '', 'Brugere', '...'),
(21, 'All', 'All', '', 'Alle', '...'),
(22, 'Test succeded', 'Test succeded', '', 'Test lykkedes', '...'),
(23, 'Help text', 'Help text', '', 'Hjælpe tekst', '...'),
(24, 'Commands succeded', 'Commands succeded', '', 'Kommandoer lykkedes', '...'),
(25, 'Commands failed', 'Commands failed', '', 'Kommandoer fejlet', '...'),
(26, 'Commands done', 'Commands done', '', 'Kommandoer gennemført', '...'),
(27, 'Commands not done', 'Commands not done', '', 'Kommandoer ikke gennemført', '...'),
(28, 'min.', 'min.', '', 'min.', '...'),
(29, 'sec.', 'sec.', '', 'sek.', '...'),
(30, 'Client', 'Client', '', 'Klient', '...'),
(31, 'Total time', 'Total time', '', 'Samlet tid', '...'),
(32, 'Selenium version', 'Selenium version', '', 'Selenium version', '...'),
(33, 'Selenium revision', 'Selenium revision', '', 'Selenium revision', '...'),
(34, 'Time', 'Time', '', 'Tid', '...'),
(35, 'Command Failures %', 'Command Failures %', '', 'Kommando fejl %', '...'),
(36, 'Commands errors', 'Commands errors', '', 'Kommandoer ikke gennemført', '...'),
(38, 'Test failed', 'Test failed', '', 'Test fejlet', '...'),
(39, 'Test', 'Test', '', 'Test', '...'),
(40, 'Commands', 'Commands', '', 'Kommandoer', '...'),
(41, 'Comparison by', 'Comparison by', '', 'Sammenlign på', '...'),
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
(57, 'environment', 'Environment', '', 'Miljø', '...'),
(58, 'Failed', 'Failed', '', 'Fejl', '...'),
(59, 'Passed', 'Passed', '', 'Godkendt', '...'),
(60, 'Error', 'Error', '', 'Ikke gennemført', '...'),
(61, 'manPassed', 'Manually Passed', '', 'Manuelt gennemført', '...'),
(62, 'Language', 'Language', '', 'Sprog', '...'),
(63, 'Welcome to Bromine', 'Welcome to Bromine', '', 'Velkommen til Bromine', '...'),
(64, 'WelcomeMsg', 'Internal news and stuff goes here', '', 'Interne nyheder og andre ting her', '...'),
(65, 'log out', 'log out', '', 'log ud', '...'),
(66, 'Test Lab', 'Test Lab', '', 'Test Lab', '...'),
(67, 'Test Result Manager', 'Test Result Manager', '', 'Test Result Manager', '...'),
(69, 'Choose project', 'Choose project', '', 'Vælg projekt', '...'),
(70, 'No test attached', 'No test attached', '', 'Ingen test tilføjet', '...'),
(71, 'Environment', 'Environment', '', 'Miljø', '...'),
(72, 'Choose environment', 'Choose environment', '', 'Vælg miljø', '...'),
(73, 'Admin WARNING!', 'WARNING!!! - THINK before you change anything!!', '', 'PAS PÅ!! Hvad du ændrer...!!', '...'),
(74, 'Choose test', 'Choose test', '', 'Vælg test', '...'),
(75, 'No environment attached', 'No environment attached', '', 'Intet miljø tilknyttet', '...'),
(76, 'Edit users', 'Edit users', '', 'Rediger brugere', '...'),
(77, 'Edit projects', 'Edit projects', '', 'Rediger projekter', '...'),
(78, 'Edit tests', 'Edit tests', '', 'Rediger tests', '...'),
(79, 'yyyy-mm-dd', 'yyyy-mm-dd', '', 'yyyy-mm-dd', '...'),
(80, 'Name', 'Name', '', 'Navn', '...'),
(81, 'Usertype', 'Usertype', '', 'Brugertype', '...'),
(82, 'Email', 'Email', '', 'Email', '...'),
(83, 'Previous 15', 'Previous 15', '', 'Forrige 15', '...'),
(84, 'Next 15', 'Next 15', '', 'Næste 15', '...'),
(85, 'Pass man.', 'Pass man.', '', 'Godkend man.', '...'),
(87, 'Add', 'Add', '', 'Tilføj', '...'),
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
(100, 'Add project', 'Add project', '', 'Tilføj projekt', '...'),
(101, 'Delete', 'Delete', '', 'Slet', '...'),
(102, 'confirmDelete', 'Are you sure you want to delete this?', '', 'Er du sikker på du vil slette dette?', '...'),
(103, 'Add test to this project', 'Add test to this project', '', 'Tilføj test til dette projekt', '...'),
(104, 'No project description', 'Collects all testsuites that does not have a project specified', '', 'Opsamler alle testsuiter der ikke har et projekt tilknyttet', '...'),
(105, 'You have to choose 2 suites', 'You have to choose 2 suites', '', 'Du skal vælge 2 suiter', '...'),
(106, 'Run test', 'Run test', '', 'Kør test', '...'),
(108, 'Generate testlink', 'Generate direct link to this test', '', 'Generer direkte link til denne test', '...'),
(109, 'Direct link warning', 'Warning! Your username and password is readable in the direct link', '', 'Advarsel! Dit brugernavn og kode er synligt i det direkte link', '...'),
(110, 'First name', 'First name', '', 'Fornavn', '...'),
(111, 'Last name', 'Last name', '', 'Efternavn', '...'),
(112, 'Status', 'Status', '', 'Status', '...'),
(113, 'Requirement', 'Requirement', '', 'Krav', '...'),
(114, 'Nr', 'Nr', '', 'Nr', '...'),
(115, 'OS/Browser requirements', 'OS/Browser requirements', '', 'OS/Browser krav', '...'),
(116, 'No access', 'You dont have access to do this', '', 'Du har ikke adgang til at udføre denne operation', '...'),
(117, 'Author', 'Author', '', 'Forfatter', '...'),
(118, 'Edit requirements', 'Edit requirements', '', 'Rediger krav', '...'),
(119, 'Site to be tested', 'Site to be tested', '', 'Side der skal testes på', '...'),
(120, 'Node location', 'Node location', '', 'Node placering', '...'),
(121, 'Type', 'Type', '', 'Type', '...'),
(122, 'Choose type', 'Choose type', '', 'Vælg type', '...'),
(123, 'Choose', 'Choose', '', 'Vælg', '...'),
(124, 'Requirements', 'Requirements', '', 'Krav', '...'),
(125, 'HR', 'Human resources', '', 'Menneskelige resourcer', '...'),
(126, 'Projects', 'Projects', '', 'Projekter', '...'),
(127, 'Submit', 'Submit', '', 'Submit', '...'),
(128, 'Testplan', 'Testplan', '', 'Testplan', '...'),
(129, 'Testrunner', 'Test runner', '', 'Test kører', '...'),
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
(142, 'Add node', 'Add node', '', 'Tilføj node', '...'),
(143, 'Edit misc', 'Edit misc', '', 'Rediger div.', '...'),
(144, 'Typename', 'Type name', '', 'Type navn', '...'),
(145, 'Add type', 'Add type', '', 'Tilføj type', '...'),
(146, 'Add browser', 'Add browser', '', 'Tilføj browser', '...'),
(147, 'Add OS', 'Add OS', '', 'Tilføj OS', '...'),
(148, 'Access', 'Access', '', 'Adgang', '...'),
(149, 'Node', 'Node', '', 'Node', '...'),
(150, 'FTP access', 'FTP access', '', 'FTP access', '...'),
(151, 'Choose node', 'Choose node', '', 'Vælg node', '...'),
(152, 'Guest account', 'Guest account', '', 'Gæste konto', '...'),
(153, 'Guest name', 'Guest name', '', 'Gæste navn', '...'),
(154, 'Guest password', 'Guest password', '', 'Gæste kodeord', '...'),
(155, 'Edit usertype access', 'Edit usertype access', '', 'Rediger brugertype adgang', '...'),
(156, 'Choose usertype', 'Choose usertype', '', 'Vælg brugertype', '...'),
(157, 'Sites', 'Sites', '', 'Sider', '...'),
(158, 'Add site', 'Add site', '', 'Tilføj side', '...'),
(159, 'noclosemsg', 'Testsuite running. Do not close window untill it finishes loading', '', 'Test kører. Luk ikke vinduet før siden er færdig med at indlæse', '...'),
(161, 'Testing', 'Testing', '', 'Tester', '...'),
(162, 'Usertypes', 'Usertypes', '', 'Brugertyper', '...'),
(163, 'Add usertype', 'Add usertype', '', 'Tilføj brugertype', '...'),
(164, 'Schedule tests', 'Schedule tests', '', 'Planlæg test', '...'),
(165, 'Add scheduled test', 'Add scheduled test', '', 'Tilføj planlagt test', '...'),
(166, 'All minutes', 'All minutes', '', 'Alle minutter', '...'),
(167, 'All hours', 'All hours', '', 'Alle timer', '...'),
(168, 'All days', 'All days', '', 'Alle dage', '...'),
(169, 'All months', 'All months', '', 'Alle måneder', '...'),
(170, 'All weekdays', 'All weekdays', '', 'Alle ugedage', '...'),
(171, 'Minute', 'Minute', '', 'Minut', '...'),
(172, 'Hour', 'Hour', '', 'Time', '...'),
(173, 'Day', 'Day', '', 'Dage', '...'),
(174, 'Month', 'Month', '', 'Måned', '...'),
(175, 'Weekday', 'Weekday', '', 'Ugedag', '...'),
(176, 'Task', 'Task', '', 'Opgave', '...'),
(177, 'Start', 'Start', '', 'Start', '...'),
(178, 'Home', 'Home', '', 'Hjem', '...'),
(179, 'Choose datafile', 'Choose datafile', '', 'Vælg datafil', '...'),
(180, 'There is no difference', 'There is no difference', '', 'De er ens', '...'),
(181, 'You have to choose 2 runs of the same testsuite', 'You have to choose 2 runs of the same testsuite', '', 'Du skal vælge 2 rapporter fra den samme test suite', '...'),
(204, 'Show comments', 'Show comments', '', 'Vis kommentarer', '...'),
(183, 'Show requirements', 'Show requirements', '', 'Vis kravstatus', '...'),
(184, 'Choose your current browser', 'Choose your current browser', '', 'Vælg din nuværende browser', '...'),
(185, 'Choose your current OS', 'Choose your current OS', '', 'Vælg dit nuværende styresystem', '...'),
(186, 'Add new OS/browser to this requirements', 'Add new OS/browser to this requirements', '', 'Tilføj nyOS/browser til dette krav', '...'),
(187, 'Add new', 'Add new', '', 'Tilføj ny', '...'),
(188, 'Test Plan', 'Test Plan', '', 'Test Plan', '...'),
(189, 'Add test to this requirement', 'Add test to this requirement', '', 'Tilføj test til dette krav', '...'),
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
(202, 'Network_drive', 'Network drive', '', 'Netværksdrev', '...'),
(203, 'Write comment', 'Write comment to this test', '', 'Skriv kommentar til denne test', '...'),
(205, 'Headline', 'Headline', '', 'Overskrift', '...'),
(206, 'Comment', 'Comment', '', 'Kommentar', '...'),
(207, 'View Screenshot', 'View screenshot of this error', '', 'Vis skærmbillede af fejlen', '...'),
(208, 'Date time', 'Date time', '', 'Dato tid', '...'),
(209, 'Send to analysis', 'Send to analysis', '', 'Send til analyse', '...'),
(210, 'Analysis', 'Analysis', '', 'Analyse', '...'),
(211, 'Send to raw data', 'Send to raw data', '', 'Send til rå data', '...'),
(212, 'Raw data', 'Raw data', '', 'Rå data', '...'),
(213, 'Sites to test', 'Sites to test', '', 'Sider der skal testes', '...'),
(214, 'Show defects', 'Show defects', '', 'Vis defekter', '...'),
(215, 'Add defect', 'Add defect', '', 'Tilføj defekt', '...'),
(216, 'Pass manually', 'Pass manually', '', 'Godkend manuelt', '...'),
(217, 'Manually passed', 'Manually passed', '', 'Manuelt godkendt', '...'),
(218, 'Remove manual pass', 'Remove manual pass', '', 'Fjern manuel godkendelse', '...'),
(219, 'Req num', 'Requirement no.', '', 'Krav nr.', '...'),
(220, 'Req name', 'Requirement name', '', 'Krav navn', '...'),
(221, 'Created', 'Created', '', 'Oprettet', '...'),
(222, 'Created by', 'Created by', '', 'Oprettet af', '...'),
(223, 'Last updated', 'Last updated', '', 'Sidst updateret', '...'),
(224, 'Updated by', 'Updated by', '', 'Opdateret af', '...'),
(225, 'Affected Reqs', 'Affected Requirements', '', 'Påvirkede krav', '...'),
(226, 'Defect', 'Defect', '', 'Defekt', '...'),
(227, 'Decription', 'Decription', '', 'Beskrivelse', '...'),
(228, 'Comments', 'Comments', '', 'Kommentarer', '...'),
(229, 'Add comment', 'Add comment', '', 'Tilføj kommentar', '...'),
(230, 'Reqs overview', 'Requirement overview', '', 'Krav overblik', '...'),
(231, 'Defects', 'Defects', '', 'Defekter', '...'),
(232, 'Properties', 'Properties', '', 'Egenskaber', '...'),
(233, 'Error in test', 'Error in test', '', 'Fejl i testen', '...'),
(235, 'Open', 'Open', '', 'Åben', '...'),
(236, 'In Progress', 'In Progress', '', 'Igangværende', '...'),
(237, 'Resolved', 'Resolved', '', 'Problem løst', '...'),
(238, 'Rejected', 'Rejected', '', 'Afvist', '...'),
(239, 'Plan test', 'Plan this test', '', 'Planlæg test', '...'),
(240, 'Test name', 'Test name', '', 'Test navn', '...'),
(241, 'Help', 'Help', '', 'Hjælp', '...'),
(242, 'Time date', 'Time date', '', 'Tid Dato', '...'),
(243, 'Manual runner', 'Manual runner', '', 'Manuel testkørsel', '...'),
(244, 'Testcases', 'Testcases', '', 'Testcases', '...'),
(245, 'Edit', 'Edit', '', 'Rediger', '...'),
(246, 'or', 'or', '', 'eller', '...'),
(247, 'Test name help', 'Test name cannot contain any spaces or special characters', '', 'Test navn må ikke indeholde nogle mellemrum eller specielle tegn(bl.a. æ, ø og å)', '...'),
(248, 'Reaction', 'Reaction', '', 'Systemet svarer', '...'),
(249, 'Action', 'Action', '', 'Du gør', '...'),
(250, 'testcase equals test', 'Choose the testcase the test equals', '', 'Vælg den testcase som test passer med', '...'),
(251, 'Choose a file to upload', 'Choose a file to upload', '', 'Vælg fil som skal uploades', '...'),
(252, 'Advanced FTP functionality', 'Advanced FTP functionality', '', 'Advanceret FTP', '...'),
(253, 'Already uploaded tests', 'Already uploaded tests', '', 'Allerede uploadede test', '...'),
(254, 'Config', 'Config', '', 'Konfigurering', ''),
(255, 'Type of defect', 'Type of defect', '', 'Defekt type', ''),
(256, 'Type of defect status', 'Type of defect status', '', 'Defekt status type ', ''),
(257, 'Variable', 'Variable', '', 'Variabel', ''),
(258, 'Value', 'Value', '', 'Værdi', ''),
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
(269, 'Comment added', 'Comment added', '', 'Kommentar tilføjet', ''),
(270, 'Already exist', 'already exist', '', 'eksisterer allerede', ''),
(271, 'is missing', 'is missing', '', 'mangler', ''),
(272, 'OS-browser combi already exist', 'That OS/Browser combination already exist', '', 'Den OS/Browser kombination eksisterer allerede', ''),
(273, 'Req with same nr exist', 'A requirement with same unique nr already exist', '', 'Der findes allerede et krav, med det unikke nr', ''),
(274, 'Both action fields must contain text', 'Both action fields must contain text', '', 'Begge handlingsfelter skal udfyldes', ''),
(275, 'must not be empty', 'must not be empty', '', 'må ikke være blanke', ''),
(276, 'and', 'and', '', 'og', ''),
(277, 'Same project name error', 'You cannot have 2 projects with the same name', '', '2 projekter med samme navn er ikke tilladt', ''),
(278, 'Name contains illegal characters', 'Name contains illegal characters', '', 'Navn indeholder ugyldige karakter', ''),
(279, 'All fields must be filled out', 'All fields must be filled out', '', 'Alle felter skal være udfyldt', ''),
(280, 'Attachment', 'Attachment', '', 'Vedhæftet fil', ''),
(281, 'Succesfully inserted', 'Succesfully inserted', '', 'Succesfuld indsætning af', ''),
(282, 'out of', 'out of', '', 'ud af', ''),
(283, 'tests', 'tests', '', 'tests', ''),
(284, 'commands', 'commands', '', 'kommandoer', ''),
(285, 'Test started', 'Test started', '', 'Test startet', ''),
(286, 'No tests', 'No tests available', '', 'Ingen test tilgængelige', ''),
(287, 'Assigned to', 'Assigned to', '', 'Tildelt til', ''),
(288, 'Filename must not be empty', 'Filename must not be empty', '', 'Filnavn må ikke være blankt', ''),
(289, 'Upload file', 'Upload file', '', 'Upload fil', ''),
(290, 'Stored in', 'Stored in', '', 'Gemt i', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_langlist`
--

CREATE TABLE IF NOT EXISTS `trm_langlist` (
  `ID` int(11) NOT NULL auto_increment,
  `abbrv` varchar(255) character set latin1 NOT NULL,
  `full` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Data dump for tabellen `trm_langlist`
--

INSERT INTO `trm_langlist` (`ID`, `abbrv`, `full`) VALUES
(1, 'dk', 'Danish'),
(2, 'en', 'English'),
(6, 'de', 'German');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_nodes`
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
-- Data dump for tabellen `trm_nodes`
--

INSERT INTO `trm_nodes` (`ID`, `nodepath`, `o_id`, `description`, `network_drive`) VALUES
(15, 'localhost', 12, 0x6c6f63616c686f7374, '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_nodes_browsers`
--

CREATE TABLE IF NOT EXISTS `trm_nodes_browsers` (
  `ID` int(11) NOT NULL auto_increment,
  `b_id` int(11) NOT NULL,
  `n_id` int(11) NOT NULL,
  `browser_path` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Data dump for tabellen `trm_nodes_browsers`
--

INSERT INTO `trm_nodes_browsers` (`ID`, `b_id`, `n_id`, `browser_path`) VALUES
(1, 1, 15, '*iexplore'),
(2, 3, 15, '*firefox'),
(3, 10, 15, '*chrome'),
(4, 11, 15, '*iehta');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_os`
--

CREATE TABLE IF NOT EXISTS `trm_os` (
  `ID` int(11) NOT NULL auto_increment,
  `OSname` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `name` (`OSname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Data dump for tabellen `trm_os`
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
-- Struktur-dump for tabellen `trm_projectlist`
--

CREATE TABLE IF NOT EXISTS `trm_projectlist` (
  `id` int(11) NOT NULL auto_increment,
  `userID` int(11) NOT NULL default '0',
  `projectID` int(11) NOT NULL default '0',
  `access` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1334 ;

--
-- Data dump for tabellen `trm_projectlist`
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
-- Struktur-dump for tabellen `trm_projects`
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
-- Data dump for tabellen `trm_projects`
--

INSERT INTO `trm_projects` (`id`, `name`, `description`, `assigned`, `outsidedefects`, `viewdefectsurl`, `adddefecturl`) VALUES
(1, 'No project', '', 0, 0, '', ''),
(123, 'sample', 'A sample project', 0, 0, '', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_projects_has_sites`
--

CREATE TABLE IF NOT EXISTS `trm_projects_has_sites` (
  `ID` int(11) NOT NULL auto_increment,
  `p_id` int(11) NOT NULL,
  `sitetotest` longtext collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=38 ;

--
-- Data dump for tabellen `trm_projects_has_sites`
--

INSERT INTO `trm_projects_has_sites` (`ID`, `p_id`, `sitetotest`) VALUES
(36, 122, 0x687474703a2f2f7777772e6b72616b2e646b),
(37, 123, 0x687474703a2f2f7777772e676f6f676c652e636f6d);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_reqsosbrows`
--

CREATE TABLE IF NOT EXISTS `trm_reqsosbrows` (
  `ID` int(11) NOT NULL auto_increment,
  `b_id` int(11) NOT NULL,
  `o_id` int(11) NOT NULL,
  `r_id` int(11) NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `b_id` (`b_id`,`o_id`,`r_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=151 ;

--
-- Data dump for tabellen `trm_reqsosbrows`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_reqstests`
--

CREATE TABLE IF NOT EXISTS `trm_reqstests` (
  `ID` int(11) NOT NULL auto_increment,
  `t_name` varchar(255) collate utf8_bin NOT NULL,
  `r_id` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=87 ;

--
-- Data dump for tabellen `trm_reqstests`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_requirements`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=328 ;

--
-- Data dump for tabellen `trm_requirements`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_selenium_server_vars`
--

CREATE TABLE IF NOT EXISTS `trm_selenium_server_vars` (
  `sessionId` varchar(255) NOT NULL,
  `nodepath` varchar(255) NOT NULL,
  `u_id` varchar(255) NOT NULL,
  `t_id` int(11) NOT NULL,
  PRIMARY KEY  (`sessionId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data dump for tabellen `trm_selenium_server_vars`
--

INSERT INTO `trm_selenium_server_vars` (`sessionId`, `nodepath`, `u_id`, `t_id`) VALUES
('5f94960a08814ec6a8c7630cf83588d6', 'localhost', '121856928614365', 4),
('e6f58b47a57743eba8bb3ff1ade318a2', 'localhost', '121856928614365', 5),
('c2a68bcb64094f54a327a0c258bcb9cd', 'localhost', '121856928614365', 6),
('f07301424c9b434e93a159f21b465d57', 'localhost', '12185696412490', 7),
('542850f1e150444ab0908d49e03e360a', 'localhost', '12185696412490', 8),
('78b27d4b67314fba9ab517fd8838b1eb', 'localhost', '12185696412490', 9),
('ed97dabeab3f42738e379642dffb9774', 'localhost', '121856974128361', 10),
('25377d958e314052af5a1e608437ca7b', 'localhost', '121856974128361', 11),
('0893bee113d543a48978bbaaf5e0618e', 'localhost', '121856974128361', 12),
('173a61e1c08d49d59ae20e71a72f6564', 'localhost', '121857039772884', 13),
('581703747c17462a8c4fb935bf253490', 'localhost', '121857039772884', 14),
('46f0e65fd0714eb0bc659a7a36bfbc00', 'localhost', '121857039772884', 15);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_sites`
--

CREATE TABLE IF NOT EXISTS `trm_sites` (
  `ID` int(11) NOT NULL auto_increment,
  `sitename` varchar(255) collate utf8_bin NOT NULL,
  `description` longtext collate utf8_bin NOT NULL,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `sitename` (`sitename`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=99 ;

--
-- Data dump for tabellen `trm_sites`
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
-- Struktur-dump for tabellen `trm_suite`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Data dump for tabellen `trm_suite`
--

INSERT INTO `trm_suite` (`ID`, `suitename`, `environment`, `status`, `timeDate`, `timeTaken`, `browser`, `platform`, `selenium_version`, `selenium_revision`, `numTestPassed`, `numTestFailed`, `numCommandsPassed`, `numCommandsFailed`, `numCommandsErrors`, `p_id`, `analysis`) VALUES
(6, 'trille,1 - trille,4 - trille,10', 'http://www.google.com', 'failed', '2008-08-12 21:35:41', 58, '10', '12', 'RC', '', 2, 1, 2, 1, 0, 123, 0),
(5, 'trille,1 - trille,4 - trille,10', 'http://www.google.com', 'failed', '2008-08-12 21:34:01', 58, '10', '12', 'RC', '', 2, 1, 2, 1, 0, 123, 0),
(7, 'trille,1 - trille,4 - trille,10', 'http://www.google.com', 'passed', '2008-08-12 21:46:38', 43, '10', '12', 'RC', '', 3, 0, 3, 0, 0, 123, 0);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_tempcommands`
--

CREATE TABLE IF NOT EXISTS `trm_tempcommands` (
  `id` int(11) NOT NULL auto_increment,
  `u_id` varchar(255) collate utf8_bin NOT NULL,
  `action` text collate utf8_bin NOT NULL,
  `var1` text collate utf8_bin NOT NULL,
  `var2` text collate utf8_bin NOT NULL,
  `status` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

--
-- Data dump for tabellen `trm_tempcommands`
--


-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_test`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=16 ;

--
-- Data dump for tabellen `trm_test`
--

INSERT INTO `trm_test` (`ID`, `status`, `name`, `s_id`, `Thelp`, `manstatus`, `author`) VALUES
(12, 'passed', 'trille', 6, 'rc-ruby', '', NULL),
(11, 'passed', 'trille', 6, 'rc-java', '', NULL),
(10, 'failed', 'trille', 6, 'rc-php', '', NULL),
(7, 'failed', 'trille', 5, 'rc-php', '', NULL),
(8, 'passed', 'trille', 5, 'rc-java', '', NULL),
(9, 'passed', 'trille', 5, 'rc-ruby', '', NULL),
(13, 'passed', 'trille', 7, 'rc-php', '', NULL),
(14, 'passed', 'trille', 7, 'rc-java', '', NULL),
(15, 'passed', 'trille', 7, 'rc-ruby', '', NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_types`
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
-- Data dump for tabellen `trm_types`
--

INSERT INTO `trm_types` (`ID`, `typename`, `command`, `spacer`, `extension`) VALUES
(1, 'rc-php', 'php', ' ', 'php'),
(4, 'rc-java', 'java -jar', ' ', 'jar'),
(10, 'rc-ruby', 'ruby', ' ', 'rb');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_type_of_defects`
--

CREATE TABLE IF NOT EXISTS `trm_type_of_defects` (
  `id` int(11) NOT NULL auto_increment,
  `priority` int(11) NOT NULL,
  `name` varchar(255) collate utf8_bin NOT NULL,
  `imgpath` text collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- Data dump for tabellen `trm_type_of_defects`
--

INSERT INTO `trm_type_of_defects` (`id`, `priority`, `name`, `imgpath`) VALUES
(2, 4, 'Test error', 0x696d672f746573746572726f722e706e67),
(6, 3, 'Request', 0x696d672f726571756573742e706e67),
(1, 0, 'Functionality', 0x696d672f66756e6374696f6e616c6974792e706e67),
(5, 1, 'Layout', 0x696d672f6c61796f75742e706e67),
(7, 2, 'Data', 0x696d672f646174612e706e67);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_type_of_defect_status`
--

CREATE TABLE IF NOT EXISTS `trm_type_of_defect_status` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) collate utf8_bin NOT NULL,
  `imgpath` text collate utf8_bin NOT NULL,
  `priority` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=43 ;

--
-- Data dump for tabellen `trm_type_of_defect_status`
--

INSERT INTO `trm_type_of_defect_status` (`id`, `name`, `imgpath`, `priority`) VALUES
(4, 'Rejected', 0x696d672f72656a65637465642e706e67, 3),
(1, 'Open', 0x696d672f6f70656e2e706e67, 0),
(2, 'In Progress', 0x696d672f696e70726f67726573732e706e67, 1),
(3, 'Resolved', 0x696d672f7265736f6c7665642e706e67, 4),
(42, 'Ready for test', 0x696d672f7265616479666f72746573742e706e67, 2);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_users`
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
-- Data dump for tabellen `trm_users`
--

INSERT INTO `trm_users` (`id`, `firstname`, `lastname`, `name`, `password`, `usertype`, `email`, `lastLogin`) VALUES
(72, '12', '12', 'selftester', '81dc9bdb52d04dc20036dbd8313ed055', 3, '', '2008-04-29 12:50:59'),
(1, 'guest', 'guest', 'guest', '084e0343a0486ff05530df6c705c8bb4', 7, '', '0000-00-00 00:00:00'),
(104, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 3, '', '2008-08-12 19:57:24'),
(113, '', '', 'service', '81dc9bdb52d04dc20036dbd8313ed055', 9, '', '2008-04-17 09:55:18'),
(112, '', '', 'tester', '81dc9bdb52d04dc20036dbd8313ed055', 5, '', '2008-04-17 09:48:40'),
(114, '', '', 'manager', '81dc9bdb52d04dc20036dbd8313ed055', 4, '', '2008-04-16 17:25:58');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `trm_usertypes`
--

CREATE TABLE IF NOT EXISTS `trm_usertypes` (
  `ID` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set latin1 NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Data dump for tabellen `trm_usertypes`
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
-- Struktur-dump for tabellen `trm_usertype_access`
--

CREATE TABLE IF NOT EXISTS `trm_usertype_access` (
  `ID` int(11) NOT NULL auto_increment,
  `ut_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=895 ;

--
-- Data dump for tabellen `trm_usertype_access`
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
