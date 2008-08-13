-- phpmyadmin sql dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- vært: localhost
-- genereringstid: 12. 08 2008 kl. 21:49:29
-- serverversion: 5.0.51
-- php-version: 5.2.5

set sql_mode="no_auto_value_on_zero";

--
-- database: `bromine`
--

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_browser`
--

create table if not exists `trm_browser` (
  `id` int(11) not null auto_increment,
  `browsername` varchar(255) collate utf8_bin not null,
  primary key  (`id`),
  unique key `name` (`browsername`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=16 ;

--
-- data dump for tabellen `trm_browser`
--

insert into `trm_browser` (`id`, `browsername`) values
(1, 'ie7'),
(2, 'ie6'),
(3, 'firefox'),
(11, 'iehta'),
(10, 'chrome'),
(13, 'safari'),
(14, 'pifirefox'),
(15, 'firefox 3');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_commands`
--

create table if not exists `trm_commands` (
  `id` int(10) unsigned not null auto_increment,
  `status` varchar(255) character set latin1 collate latin1_danish_ci default null,
  `action` longtext character set latin1 collate latin1_danish_ci,
  `var1` longtext character set latin1 collate latin1_danish_ci,
  `var2` longtext character set latin1 collate latin1_danish_ci,
  `t_id` int(10) not null default '0',
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=92 ;

--
-- data dump for tabellen `trm_commands`
--

insert into `trm_commands` (`id`, `status`, `action`, `var1`, `var2`, `t_id`) values
(40, 'done', 'click', 'btng', '', 10),
(3, 'failed', 'open', '/', '', 0),
(4, 'failed', 'testcomplete', '', '', 0),
(38, 'done', 'open', '/', '', 10),
(39, 'done', 'type', 'q', 'bromine openqa', 10),
(6, 'failed', 'open', '/', '', 0),
(7, 'failed', 'testcomplete', '', '', 0),
(37, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 10),
(9, 'failed', 'testcomplete', '', '', 0),
(10, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 7),
(11, 'done', 'open', '/', '', 7),
(12, 'done', 'type', 'q', 'bromine openqa', 7),
(13, 'done', 'click', 'btng', '', 7),
(14, 'done', 'waitforpagetoload', '30000', '', 7),
(15, 'done', 'click', 'link=exact:openqa: bromine blog: bromine arrives at openqa', '', 7),
(16, 'failed', 'waitforpagetoload', '30000', '', 7),
(17, 'done', 'testcomplete', '', '', 7),
(18, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 8),
(19, 'done', 'open', '/', '', 8),
(20, 'done', 'type', 'q', 'bromine', 8),
(21, 'done', 'click', 'btng', '', 8),
(22, 'done', 'waitforpagetoload', '30000', '', 8),
(23, 'done', 'click', 'link=bromine - wikipedia, the free encyclopedia', '', 8),
(24, 'done', 'waitforpagetoload', '30000', '', 8),
(25, 'passed', 'istextpresent', 'bromine', '', 8),
(26, 'done', 'testcomplete', '', '', 8),
(27, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 9),
(28, 'done', 'setcontext', 'test_new', '', 9),
(29, 'done', 'open', '/', '', 9),
(30, 'done', 'type', 'q', 'bromine', 9),
(31, 'done', 'click', 'btng', '', 9),
(32, 'done', 'waitforpagetoload', '30000', '', 9),
(33, 'done', 'click', 'link=bromine - wikipedia, the free encyclopedia', '', 9),
(34, 'done', 'waitforpagetoload', '30000', '', 9),
(35, 'passed', 'istextpresent', 'bromine', '', 9),
(36, 'done', 'testcomplete', '', '', 9),
(41, 'done', 'waitforpagetoload', '30000', '', 10),
(42, 'done', 'click', 'link=exact:openqa: bromine blog: bromine arrives at openqa', '', 10),
(43, 'failed', 'waitforpagetoload', '30000', '', 10),
(44, 'done', 'testcomplete', '', '', 10),
(45, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 11),
(46, 'done', 'open', '/', '', 11),
(47, 'done', 'type', 'q', 'bromine', 11),
(48, 'done', 'click', 'btng', '', 11),
(49, 'done', 'waitforpagetoload', '30000', '', 11),
(50, 'done', 'click', 'link=bromine - wikipedia, the free encyclopedia', '', 11),
(51, 'done', 'waitforpagetoload', '30000', '', 11),
(52, 'passed', 'istextpresent', 'bromine', '', 11),
(53, 'done', 'testcomplete', '', '', 11),
(54, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 12),
(55, 'done', 'setcontext', 'test_new', '', 12),
(56, 'done', 'open', '/', '', 12),
(57, 'done', 'type', 'q', 'bromine', 12),
(58, 'done', 'click', 'btng', '', 12),
(59, 'done', 'waitforpagetoload', '30000', '', 12),
(60, 'done', 'click', 'link=bromine - wikipedia, the free encyclopedia', '', 12),
(61, 'done', 'waitforpagetoload', '30000', '', 12),
(62, 'passed', 'istextpresent', 'bromine', '', 12),
(63, 'done', 'testcomplete', '', '', 12),
(64, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 13),
(65, 'done', 'open', '/', '', 13),
(66, 'done', 'type', 'q', 'bromine openqa', 13),
(67, 'done', 'click', 'btng', '', 13),
(68, 'done', 'waitforpagetoload', '30000', '', 13),
(69, 'done', 'click', 'link=exact:openqa: bromine blog: bromine arrives at openqa', '', 13),
(70, 'done', 'waitforpagetoload', '30000', '', 13),
(71, 'passed', 'istextpresent', 'bromine', '', 13),
(72, 'done', 'testcomplete', '', '', 13),
(73, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 14),
(74, 'done', 'open', '/', '', 14),
(75, 'done', 'type', 'q', 'bromine', 14),
(76, 'done', 'click', 'btng', '', 14),
(77, 'done', 'waitforpagetoload', '30000', '', 14),
(78, 'done', 'click', 'link=bromine - wikipedia, the free encyclopedia', '', 14),
(79, 'done', 'waitforpagetoload', '30000', '', 14),
(80, 'passed', 'istextpresent', 'bromine', '', 14),
(81, 'done', 'testcomplete', '', '', 14),
(82, 'done', 'getnewbrowsersession', '*chrome', 'http://www.google.com', 15),
(83, 'done', 'setcontext', 'test_new', '', 15),
(84, 'done', 'open', '/', '', 15),
(85, 'done', 'type', 'q', 'bromine', 15),
(86, 'done', 'click', 'btng', '', 15),
(87, 'done', 'waitforpagetoload', '30000', '', 15),
(88, 'done', 'click', 'link=bromine - wikipedia, the free encyclopedia', '', 15),
(89, 'done', 'waitforpagetoload', '30000', '', 15),
(90, 'passed', 'istextpresent', 'bromine', '', 15),
(91, 'done', 'testcomplete', '', '', 15);

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_comments`
--

create table if not exists `trm_comments` (
  `id` int(11) not null auto_increment,
  `timedate` timestamp not null default current_timestamp,
  `author` int(11) not null,
  `headline` varchar(255) collate utf8_bin not null,
  `comment` longtext collate utf8_bin not null,
  `table_name` varchar(255) collate utf8_bin not null,
  `table_id` int(11) not null,
  primary key  (`id`)
) engine=myisam default charset=utf8 collate=utf8_bin auto_increment=1 ;

--
-- data dump for tabellen `trm_comments`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_config`
--

create table if not exists `trm_config` (
  `id` int(11) not null auto_increment,
  `var` varchar(255) collate utf8_bin not null,
  `value` varchar(255) collate utf8_bin not null,
  primary key  (`id`),
  unique key `var` (`var`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=3 ;

--
-- data dump for tabellen `trm_config`
--

insert into `trm_config` (`id`, `var`, `value`) values
(1, 'lite_version', '0'),
(2, 'registration', '1');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_core`
--

create table if not exists `trm_core` (
  `id` int(11) not null auto_increment,
  `referer` varchar(255) character set latin1 collate latin1_danish_ci not null,
  `p_id` int(11) not null default '0',
  `testrunnerlocation` varchar(255) character set latin1 not null,
  `testpath` varchar(255) character set latin1 not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=94 ;

--
-- data dump for tabellen `trm_core`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_core_testsuites`
--

create table if not exists `trm_core_testsuites` (
  `id` int(11) not null auto_increment,
  `p_id` int(11) not null,
  `testsuite` varchar(255) character set latin1 not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=108 ;

--
-- data dump for tabellen `trm_core_testsuites`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_cronjobs`
--

create table if not exists `trm_cronjobs` (
  `id` int(11) not null auto_increment,
  `runtime` datetime not null,
  `job` text collate utf8_bin not null,
  `run` int(11) not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=2 ;

--
-- data dump for tabellen `trm_cronjobs`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_defects`
--

create table if not exists `trm_defects` (
  `id` int(11) not null auto_increment,
  `createdby` int(11) not null,
  `description` longtext collate utf8_bin not null,
  `type_of_defect` int(11) not null,
  `created` datetime not null,
  `updated` timestamp not null default current_timestamp on update current_timestamp,
  `status` int(11) not null,
  `p_id` int(11) not null,
  `t_id` int(11) default null,
  `updatedby` int(11) not null,
  `name` varchar(255) collate utf8_bin not null,
  `priority` enum('urgent','very high','high','medium','low') collate utf8_bin not null,
  `stt_id` varchar(11) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam default charset=utf8 collate=utf8_bin auto_increment=1 ;

--
-- data dump for tabellen `trm_defects`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_defect_has_attachment`
--

create table if not exists `trm_defect_has_attachment` (
  `id` int(11) not null auto_increment,
  `d_id` int(11) not null,
  `attachment_path` text collate utf8_bin not null,
  `microtime` varchar(255) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam default charset=utf8 collate=utf8_bin auto_increment=1 ;

--
-- data dump for tabellen `trm_defect_has_attachment`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_design_manual_commands`
--

create table if not exists `trm_design_manual_commands` (
  `id` int(11) not null auto_increment,
  `orderby` int(11) not null,
  `action` text collate utf8_bin not null,
  `reaction` text collate utf8_bin not null,
  `td_id` int(11) not null,
  primary key  (`id`)
) engine=myisam default charset=utf8 collate=utf8_bin auto_increment=1 ;

--
-- data dump for tabellen `trm_design_manual_commands`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_design_manual_test`
--

create table if not exists `trm_design_manual_test` (
  `id` int(11) not null auto_increment,
  `name` text collate utf8_bin not null,
  `p_id` int(11) not null,
  `description` longtext collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=2 ;

--
-- data dump for tabellen `trm_design_manual_test`
--

insert into `trm_design_manual_test` (`id`, `name`, `p_id`, `description`) values
(1, 0x7472696c6c65, 123, '');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_lang`
--

create table if not exists `trm_lang` (
  `id` int(11) not null auto_increment,
  `langkey` varchar(255) collate utf8_bin not null,
  `en` varchar(255) collate utf8_bin not null,
  `es` varchar(255) collate utf8_bin not null,
  `dk` varchar(255) collate utf8_bin not null,
  `de` varchar(255) collate utf8_bin not null,
  primary key  (`id`),
  unique key `langkey` (`langkey`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=291 ;

--
-- data dump for tabellen `trm_lang`
--

insert into `trm_lang` (`id`, `langkey`, `en`, `es`, `dk`, `de`) values
(1, 'date', 'date', '', 'dato', '...'),
(2, 'suite name', 'suite name', '', 'suite navn', '...'),
(3, 'sel. ver.', 'sel. ver.', '', 'sel. ver.', '...'),
(4, 'sel. rev.', 'sel. rev.', '', 'sel. rev.', '...'),
(5, 'browser', 'browser', '', 'browser', '...'),
(6, 'platform', 'platform', '', 'platform', '...'),
(7, 'test suc.', 'test suc.', '', 't lykkedes', '...'),
(8, 'test fail.', 'test fail.', '', 't fejlet', '...'),
(9, 'cmd. suc.', 'cmd. suc.', '', 'k lykkedes', '...'),
(10, 'cmd. failed', 'cmd. failed', '', 'k fejlet', '...'),
(11, 'cmd. not done', 'cmd. not done', '', 'k ikke udført', '...'),
(12, 't graph', 't graph', '', 't graf', '...'),
(13, 'cmd. graph', 'cmd. graph', '', 'k graf', '...'),
(14, 'to', 'to', '', 'til', '...'),
(15, 'from', 'from', '', 'fra', '...'),
(16, 'show', 'show', '', 'vis', '...'),
(17, 'difference', 'difference', '', 'forskel', '...'),
(18, 'add user', 'add user', '', 'tilføj bruger', '...'),
(19, 'see old reports', 'see old reports', '', 'se gamle rapporter', '...'),
(20, 'users', 'users', '', 'brugere', '...'),
(21, 'all', 'all', '', 'alle', '...'),
(22, 'test succeded', 'test succeded', '', 'test lykkedes', '...'),
(23, 'help text', 'help text', '', 'hjælpe tekst', '...'),
(24, 'commands succeded', 'commands succeded', '', 'kommandoer lykkedes', '...'),
(25, 'commands failed', 'commands failed', '', 'kommandoer fejlet', '...'),
(26, 'commands done', 'commands done', '', 'kommandoer gennemført', '...'),
(27, 'commands not done', 'commands not done', '', 'kommandoer ikke gennemført', '...'),
(28, 'min.', 'min.', '', 'min.', '...'),
(29, 'sec.', 'sec.', '', 'sek.', '...'),
(30, 'client', 'client', '', 'klient', '...'),
(31, 'total time', 'total time', '', 'samlet tid', '...'),
(32, 'selenium version', 'selenium version', '', 'selenium version', '...'),
(33, 'selenium revision', 'selenium revision', '', 'selenium revision', '...'),
(34, 'time', 'time', '', 'tid', '...'),
(35, 'command failures %', 'command failures %', '', 'kommando fejl %', '...'),
(36, 'commands errors', 'commands errors', '', 'kommandoer ikke gennemført', '...'),
(38, 'test failed', 'test failed', '', 'test fejlet', '...'),
(39, 'test', 'test', '', 'test', '...'),
(40, 'commands', 'commands', '', 'kommandoer', '...'),
(41, 'comparison by', 'comparison by', '', 'sammenlign på', '...'),
(42, 'project', 'project', '', 'projekt', '...'),
(43, 'description', 'description', '', 'beskrivelse', '...'),
(44, 'username', 'username', '', 'brugernavn', '...'),
(45, 'password', 'password', '', 'adgangskode', '...'),
(46, 'log in', 'log in', '', 'log ind', '...'),
(47, 'logged in as', 'logged in as', '', 'logget ind som', '...'),
(48, 'link to admin-site', 'admin module', '', 'admin modul', '...'),
(49, 'back to suite overview', 'back to suite overview', '', 'tilbage til suite overblik', '...'),
(50, 'no reports', 'there are no report in this project', '', 'der er ingen rapport i dette project', '...'),
(51, 'return to index', 'back to project overview', '', 'tilbage til projekt overblik', '...'),
(52, 'reset', 'reset', '', 'nulstil', '...'),
(53, 'no login', 'your username or password is not correct', '', 'mit brugernavn eller adgangskode er forkert ', '...'),
(54, 'no projects', 'you don''t have access to any projects', '', 'du har ikke adgang til noget projekter', '...'),
(56, 'diff', 'diff', '', 'diff', '...'),
(57, 'environment', 'environment', '', 'miljø', '...'),
(58, 'failed', 'failed', '', 'fejl', '...'),
(59, 'passed', 'passed', '', 'godkendt', '...'),
(60, 'error', 'error', '', 'ikke gennemført', '...'),
(61, 'manpassed', 'manually passed', '', 'manuelt gennemført', '...'),
(62, 'language', 'language', '', 'sprog', '...'),
(63, 'welcome to bromine', 'welcome to bromine', '', 'velkommen til bromine', '...'),
(64, 'welcomemsg', 'internal news and stuff goes here', '', 'interne nyheder og andre ting her', '...'),
(65, 'log out', 'log out', '', 'log ud', '...'),
(66, 'test lab', 'test lab', '', 'test lab', '...'),
(67, 'test result manager', 'test result manager', '', 'test result manager', '...'),
(69, 'choose project', 'choose project', '', 'vælg projekt', '...'),
(70, 'no test attached', 'no test attached', '', 'ingen test tilføjet', '...'),
(71, 'environment', 'environment', '', 'miljø', '...'),
(72, 'choose environment', 'choose environment', '', 'vælg miljø', '...'),
(73, 'admin warning!', 'warning!!! - think before you change anything!!', '', 'pas på!! hvad du ændrer...!!', '...'),
(74, 'choose test', 'choose test', '', 'vælg test', '...'),
(75, 'no environment attached', 'no environment attached', '', 'intet miljø tilknyttet', '...'),
(76, 'edit users', 'edit users', '', 'rediger brugere', '...'),
(77, 'edit projects', 'edit projects', '', 'rediger projekter', '...'),
(78, 'edit tests', 'edit tests', '', 'rediger tests', '...'),
(79, 'yyyy-mm-dd', 'yyyy-mm-dd', '', 'yyyy-mm-dd', '...'),
(80, 'name', 'name', '', 'navn', '...'),
(81, 'usertype', 'usertype', '', 'brugertype', '...'),
(82, 'email', 'email', '', 'email', '...'),
(83, 'previous 15', 'previous 15', '', 'forrige 15', '...'),
(84, 'next 15', 'next 15', '', 'næste 15', '...'),
(85, 'pass man.', 'pass man.', '', 'godkend man.', '...'),
(87, 'add', 'add', '', 'tilføj', '...'),
(88, 'back to admin site', 'back to admin site', '', 'tilbage til admin siden', '...'),
(89, 'save', 'save', '', 'gem', '...'),
(90, 'pass', 'pass', '', 'godkend', '...'),
(91, 'interval', 'interval', '', 'interval', '...'),
(92, 'allowed:', 'allowed:', '', 'adgang:', '...'),
(93, 'not allowed:', 'not allowed:', '', 'ikke adgang:', '...'),
(94, 'no test', 'no test', '', 'ingen test tilknyttet dette projekt', '...'),
(95, 'site', 'site', '', 'side', '...'),
(96, 'testsuite path', 'testsuite path', '', 'testsuite sti', '...'),
(97, 'tr location', 'testrunner.html location', '', 'testrunner.html placering', '...'),
(98, 'no project sites attached', 'no project sites attached', '', 'ingen projekt sider tilknyttet', '...'),
(99, 'add site to this project', 'add site to this project', '', 'tilknyt side til dette projekt', '...'),
(100, 'add project', 'add project', '', 'tilføj projekt', '...'),
(101, 'delete', 'delete', '', 'slet', '...'),
(102, 'confirmdelete', 'are you sure you want to delete this?', '', 'er du sikker på du vil slette dette?', '...'),
(103, 'add test to this project', 'add test to this project', '', 'tilføj test til dette projekt', '...'),
(104, 'no project description', 'collects all testsuites that does not have a project specified', '', 'opsamler alle testsuiter der ikke har et projekt tilknyttet', '...'),
(105, 'you have to choose 2 suites', 'you have to choose 2 suites', '', 'du skal vælge 2 suiter', '...'),
(106, 'run test', 'run test', '', 'kør test', '...'),
(108, 'generate testlink', 'generate direct link to this test', '', 'generer direkte link til denne test', '...'),
(109, 'direct link warning', 'warning! your username and password is readable in the direct link', '', 'advarsel! dit brugernavn og kode er synligt i det direkte link', '...'),
(110, 'first name', 'first name', '', 'fornavn', '...'),
(111, 'last name', 'last name', '', 'efternavn', '...'),
(112, 'status', 'status', '', 'status', '...'),
(113, 'requirement', 'requirement', '', 'krav', '...'),
(114, 'nr', 'nr', '', 'nr', '...'),
(115, 'os/browser requirements', 'os/browser requirements', '', 'os/browser krav', '...'),
(116, 'no access', 'you dont have access to do this', '', 'du har ikke adgang til at udføre denne operation', '...'),
(117, 'author', 'author', '', 'forfatter', '...'),
(118, 'edit requirements', 'edit requirements', '', 'rediger krav', '...'),
(119, 'site to be tested', 'site to be tested', '', 'side der skal testes på', '...'),
(120, 'node location', 'node location', '', 'node placering', '...'),
(121, 'type', 'type', '', 'type', '...'),
(122, 'choose type', 'choose type', '', 'vælg type', '...'),
(123, 'choose', 'choose', '', 'vælg', '...'),
(124, 'requirements', 'requirements', '', 'krav', '...'),
(125, 'hr', 'human resources', '', 'menneskelige resourcer', '...'),
(126, 'projects', 'projects', '', 'projekter', '...'),
(127, 'submit', 'submit', '', 'submit', '...'),
(128, 'testplan', 'testplan', '', 'testplan', '...'),
(129, 'testrunner', 'test runner', '', 'test kører', '...'),
(130, 'testrunner nodes', 'testrunner nodes', '', 'testrunner noder', '...'),
(131, 'testrunner core', 'testrunner core', '', 'testrunner core', '...'),
(132, 'core tests', 'core tests', '', 'core tests', '...'),
(133, 'node tests', 'node tests', '', 'node tests', '...'),
(134, 'edit core sites', 'edit core sites', '', 'rediger core sider', '...'),
(135, 'core sites', 'core sited', '', 'core sider', '...'),
(136, 'node sites', 'node sites', '', 'node sider', '...'),
(137, 'os', 'os', '', 'os', '...'),
(138, 'browsers', 'browsers', '', 'browsere', '...'),
(139, 'types', 'types', '', 'typer', '...'),
(140, 'edit nodes', 'edit nodes', '', 'rediger noder', '...'),
(141, 'type path', 'type path', '', 'type sti', '...'),
(142, 'add node', 'add node', '', 'tilføj node', '...'),
(143, 'edit misc', 'edit misc', '', 'rediger div.', '...'),
(144, 'typename', 'type name', '', 'type navn', '...'),
(145, 'add type', 'add type', '', 'tilføj type', '...'),
(146, 'add browser', 'add browser', '', 'tilføj browser', '...'),
(147, 'add os', 'add os', '', 'tilføj os', '...'),
(148, 'access', 'access', '', 'adgang', '...'),
(149, 'node', 'node', '', 'node', '...'),
(150, 'ftp access', 'ftp access', '', 'ftp access', '...'),
(151, 'choose node', 'choose node', '', 'vælg node', '...'),
(152, 'guest account', 'guest account', '', 'gæste konto', '...'),
(153, 'guest name', 'guest name', '', 'gæste navn', '...'),
(154, 'guest password', 'guest password', '', 'gæste kodeord', '...'),
(155, 'edit usertype access', 'edit usertype access', '', 'rediger brugertype adgang', '...'),
(156, 'choose usertype', 'choose usertype', '', 'vælg brugertype', '...'),
(157, 'sites', 'sites', '', 'sider', '...'),
(158, 'add site', 'add site', '', 'tilføj side', '...'),
(159, 'noclosemsg', 'testsuite running. do not close window untill it finishes loading', '', 'test kører. luk ikke vinduet før siden er færdig med at indlæse', '...'),
(161, 'testing', 'testing', '', 'tester', '...'),
(162, 'usertypes', 'usertypes', '', 'brugertyper', '...'),
(163, 'add usertype', 'add usertype', '', 'tilføj brugertype', '...'),
(164, 'schedule tests', 'schedule tests', '', 'planlæg test', '...'),
(165, 'add scheduled test', 'add scheduled test', '', 'tilføj planlagt test', '...'),
(166, 'all minutes', 'all minutes', '', 'alle minutter', '...'),
(167, 'all hours', 'all hours', '', 'alle timer', '...'),
(168, 'all days', 'all days', '', 'alle dage', '...'),
(169, 'all months', 'all months', '', 'alle måneder', '...'),
(170, 'all weekdays', 'all weekdays', '', 'alle ugedage', '...'),
(171, 'minute', 'minute', '', 'minut', '...'),
(172, 'hour', 'hour', '', 'time', '...'),
(173, 'day', 'day', '', 'dage', '...'),
(174, 'month', 'month', '', 'måned', '...'),
(175, 'weekday', 'weekday', '', 'ugedag', '...'),
(176, 'task', 'task', '', 'opgave', '...'),
(177, 'start', 'start', '', 'start', '...'),
(178, 'home', 'home', '', 'hjem', '...'),
(179, 'choose datafile', 'choose datafile', '', 'vælg datafil', '...'),
(180, 'there is no difference', 'there is no difference', '', 'de er ens', '...'),
(181, 'you have to choose 2 runs of the same testsuite', 'you have to choose 2 runs of the same testsuite', '', 'du skal vælge 2 rapporter fra den samme test suite', '...'),
(204, 'show comments', 'show comments', '', 'vis kommentarer', '...'),
(183, 'show requirements', 'show requirements', '', 'vis kravstatus', '...'),
(184, 'choose your current browser', 'choose your current browser', '', 'vælg din nuværende browser', '...'),
(185, 'choose your current os', 'choose your current os', '', 'vælg dit nuværende styresystem', '...'),
(186, 'add new os/browser to this requirements', 'add new os/browser to this requirements', '', 'tilføj nyos/browser til dette krav', '...'),
(187, 'add new', 'add new', '', 'tilføj ny', '...'),
(188, 'test plan', 'test plan', '', 'test plan', '...'),
(189, 'add test to this requirement', 'add test to this requirement', '', 'tilføj test til dette krav', '...'),
(190, 'priority', 'priority', '', 'prioritet', '...'),
(191, 'urgent', 'urgent', '', 'yderst vigtigt', '...'),
(192, 'very high', 'very high', '', 'meget vigtig', '...'),
(193, 'high', 'high', '', 'vigtig', '...'),
(194, 'medium', 'medium', '', 'mellem', '...'),
(195, 'low', 'low', '', 'lav', '...'),
(196, 'disabled', 'disabled', '', 'deaktiveret', '...'),
(197, 'suite results', 'suite results', '', 'suite resultater', '...'),
(198, 'matrix', 'os / browser matrix', '', 'styresystem / browser matrix', '...'),
(199, 'view matrix', 'view matrix', '', 'vis matrice', '...'),
(200, 'close', 'close', '', 'luk', '...'),
(201, 'show full desc', 'show full description', '', 'vis hele beskrivelsen', '...'),
(202, 'network_drive', 'network drive', '', 'netværksdrev', '...'),
(203, 'write comment', 'write comment to this test', '', 'skriv kommentar til denne test', '...'),
(205, 'headline', 'headline', '', 'overskrift', '...'),
(206, 'comment', 'comment', '', 'kommentar', '...'),
(207, 'view screenshot', 'view screenshot of this error', '', 'vis skærmbillede af fejlen', '...'),
(208, 'date time', 'date time', '', 'dato tid', '...'),
(209, 'send to analysis', 'send to analysis', '', 'send til analyse', '...'),
(210, 'analysis', 'analysis', '', 'analyse', '...'),
(211, 'send to raw data', 'send to raw data', '', 'send til rå data', '...'),
(212, 'raw data', 'raw data', '', 'rå data', '...'),
(213, 'sites to test', 'sites to test', '', 'sider der skal testes', '...'),
(214, 'show defects', 'show defects', '', 'vis defekter', '...'),
(215, 'add defect', 'add defect', '', 'tilføj defekt', '...'),
(216, 'pass manually', 'pass manually', '', 'godkend manuelt', '...'),
(217, 'manually passed', 'manually passed', '', 'manuelt godkendt', '...'),
(218, 'remove manual pass', 'remove manual pass', '', 'fjern manuel godkendelse', '...'),
(219, 'req num', 'requirement no.', '', 'krav nr.', '...'),
(220, 'req name', 'requirement name', '', 'krav navn', '...'),
(221, 'created', 'created', '', 'oprettet', '...'),
(222, 'created by', 'created by', '', 'oprettet af', '...'),
(223, 'last updated', 'last updated', '', 'sidst updateret', '...'),
(224, 'updated by', 'updated by', '', 'opdateret af', '...'),
(225, 'affected reqs', 'affected requirements', '', 'påvirkede krav', '...'),
(226, 'defect', 'defect', '', 'defekt', '...'),
(227, 'decription', 'decription', '', 'beskrivelse', '...'),
(228, 'comments', 'comments', '', 'kommentarer', '...'),
(229, 'add comment', 'add comment', '', 'tilføj kommentar', '...'),
(230, 'reqs overview', 'requirement overview', '', 'krav overblik', '...'),
(231, 'defects', 'defects', '', 'defekter', '...'),
(232, 'properties', 'properties', '', 'egenskaber', '...'),
(233, 'error in test', 'error in test', '', 'fejl i testen', '...'),
(235, 'open', 'open', '', 'åben', '...'),
(236, 'in progress', 'in progress', '', 'igangværende', '...'),
(237, 'resolved', 'resolved', '', 'problem løst', '...'),
(238, 'rejected', 'rejected', '', 'afvist', '...'),
(239, 'plan test', 'plan this test', '', 'planlæg test', '...'),
(240, 'test name', 'test name', '', 'test navn', '...'),
(241, 'help', 'help', '', 'hjælp', '...'),
(242, 'time date', 'time date', '', 'tid dato', '...'),
(243, 'manual runner', 'manual runner', '', 'manuel testkørsel', '...'),
(244, 'testcases', 'testcases', '', 'testcases', '...'),
(245, 'edit', 'edit', '', 'rediger', '...'),
(246, 'or', 'or', '', 'eller', '...'),
(247, 'test name help', 'test name cannot contain any spaces or special characters', '', 'test navn må ikke indeholde nogle mellemrum eller specielle tegn(bl.a. æ, ø og å)', '...'),
(248, 'reaction', 'reaction', '', 'systemet svarer', '...'),
(249, 'action', 'action', '', 'du gør', '...'),
(250, 'testcase equals test', 'choose the testcase the test equals', '', 'vælg den testcase som test passer med', '...'),
(251, 'choose a file to upload', 'choose a file to upload', '', 'vælg fil som skal uploades', '...'),
(252, 'advanced ftp functionality', 'advanced ftp functionality', '', 'advanceret ftp', '...'),
(253, 'already uploaded tests', 'already uploaded tests', '', 'allerede uploadede test', '...'),
(254, 'config', 'config', '', 'konfigurering', ''),
(255, 'type of defect', 'type of defect', '', 'defekt type', ''),
(256, 'type of defect status', 'type of defect status', '', 'defekt status type ', ''),
(257, 'variable', 'variable', '', 'variabel', ''),
(258, 'value', 'value', '', 'værdi', ''),
(259, 'edit core suites', 'edit core suites', '', 'rediger core suites', ''),
(260, 'already uploaded', 'already uploaded', '', 'allerede uploadet', ''),
(261, 'edit node tests', 'edit node tests', '', 'rediger node tests', ''),
(262, 'test error', 'test error', '', 'test fejl', ''),
(263, 'request', 'request', '', 'anmodning', ''),
(264, 'functionality', 'functionality', '', 'funktionalitet', ''),
(265, 'layout', 'layout', '', 'layout', ''),
(266, 'data', 'data', '', 'data', ''),
(267, 'ready for test', 'ready for test', '', 'klar til test', ''),
(268, 'image path', 'image path', '', 'billedsti', ''),
(269, 'comment added', 'comment added', '', 'kommentar tilføjet', ''),
(270, 'already exist', 'already exist', '', 'eksisterer allerede', ''),
(271, 'is missing', 'is missing', '', 'mangler', ''),
(272, 'os-browser combi already exist', 'that os/browser combination already exist', '', 'den os/browser kombination eksisterer allerede', ''),
(273, 'req with same nr exist', 'a requirement with same unique nr already exist', '', 'der findes allerede et krav, med det unikke nr', ''),
(274, 'both action fields must contain text', 'both action fields must contain text', '', 'begge handlingsfelter skal udfyldes', ''),
(275, 'must not be empty', 'must not be empty', '', 'må ikke være blanke', ''),
(276, 'and', 'and', '', 'og', ''),
(277, 'same project name error', 'you cannot have 2 projects with the same name', '', '2 projekter med samme navn er ikke tilladt', ''),
(278, 'name contains illegal characters', 'name contains illegal characters', '', 'navn indeholder ugyldige karakter', ''),
(279, 'all fields must be filled out', 'all fields must be filled out', '', 'alle felter skal være udfyldt', ''),
(280, 'attachment', 'attachment', '', 'vedhæftet fil', ''),
(281, 'succesfully inserted', 'succesfully inserted', '', 'succesfuld indsætning af', ''),
(282, 'out of', 'out of', '', 'ud af', ''),
(283, 'tests', 'tests', '', 'tests', ''),
(284, 'commands', 'commands', '', 'kommandoer', ''),
(285, 'test started', 'test started', '', 'test startet', ''),
(286, 'no tests', 'no tests available', '', 'ingen test tilgængelige', ''),
(287, 'assigned to', 'assigned to', '', 'tildelt til', ''),
(288, 'filename must not be empty', 'filename must not be empty', '', 'filnavn må ikke være blankt', ''),
(289, 'upload file', 'upload file', '', 'upload fil', ''),
(290, 'stored in', 'stored in', '', 'gemt i', '');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_langlist`
--

create table if not exists `trm_langlist` (
  `id` int(11) not null auto_increment,
  `abbrv` varchar(255) character set latin1 not null,
  `full` varchar(255) character set latin1 not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=7 ;

--
-- data dump for tabellen `trm_langlist`
--

insert into `trm_langlist` (`id`, `abbrv`, `full`) values
(1, 'dk', 'danish'),
(2, 'en', 'english'),
(6, 'de', 'german');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_nodes`
--

create table if not exists `trm_nodes` (
  `id` int(11) not null auto_increment,
  `nodepath` varchar(255) collate utf8_bin not null,
  `o_id` int(11) not null,
  `description` longtext collate utf8_bin not null,
  `network_drive` varchar(255) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=23 ;

--
-- data dump for tabellen `trm_nodes`
--

insert into `trm_nodes` (`id`, `nodepath`, `o_id`, `description`, `network_drive`) values
(15, 'localhost', 12, 0x6c6f63616c686f7374, '');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_nodes_browsers`
--

create table if not exists `trm_nodes_browsers` (
  `id` int(11) not null auto_increment,
  `b_id` int(11) not null,
  `n_id` int(11) not null,
  `browser_path` varchar(255) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=5 ;

--
-- data dump for tabellen `trm_nodes_browsers`
--

insert into `trm_nodes_browsers` (`id`, `b_id`, `n_id`, `browser_path`) values
(1, 1, 15, '*iexplore'),
(2, 3, 15, '*firefox'),
(3, 10, 15, '*chrome'),
(4, 11, 15, '*iehta');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_os`
--

create table if not exists `trm_os` (
  `id` int(11) not null auto_increment,
  `osname` varchar(255) collate utf8_bin not null,
  primary key  (`id`),
  unique key `name` (`osname`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=13 ;

--
-- data dump for tabellen `trm_os`
--

insert into `trm_os` (`id`, `osname`) values
(1, 'vista'),
(2, 'linux'),
(3, '2000'),
(4, 'os x'),
(5, '98'),
(6, '95'),
(12, 'xp');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_projectlist`
--

create table if not exists `trm_projectlist` (
  `id` int(11) not null auto_increment,
  `userid` int(11) not null default '0',
  `projectid` int(11) not null default '0',
  `access` int(1) not null default '0',
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=1334 ;

--
-- data dump for tabellen `trm_projectlist`
--

insert into `trm_projectlist` (`id`, `userid`, `projectid`, `access`) values
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
-- struktur-dump for tabellen `trm_projects`
--

create table if not exists `trm_projects` (
  `id` int(11) not null auto_increment,
  `name` text character set latin1 not null,
  `description` text character set latin1 not null,
  `assigned` int(255) not null,
  `outsidedefects` tinyint(1) not null,
  `viewdefectsurl` varchar(256) collate utf8_bin not null,
  `adddefecturl` varchar(256) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=124 ;

--
-- data dump for tabellen `trm_projects`
--

insert into `trm_projects` (`id`, `name`, `description`, `assigned`, `outsidedefects`, `viewdefectsurl`, `adddefecturl`) values
(1, 'no project', '', 0, 0, '', ''),
(123, 'sample', 'a sample project', 0, 0, '', '');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_projects_has_sites`
--

create table if not exists `trm_projects_has_sites` (
  `id` int(11) not null auto_increment,
  `p_id` int(11) not null,
  `sitetotest` longtext collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=38 ;

--
-- data dump for tabellen `trm_projects_has_sites`
--

insert into `trm_projects_has_sites` (`id`, `p_id`, `sitetotest`) values
(36, 122, 0x687474703a2f2f7777772e6b72616b2e646b),
(37, 123, 0x687474703a2f2f7777772e676f6f676c652e636f6d);

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_reqsosbrows`
--

create table if not exists `trm_reqsosbrows` (
  `id` int(11) not null auto_increment,
  `b_id` int(11) not null,
  `o_id` int(11) not null,
  `r_id` int(11) not null,
  primary key  (`id`),
  unique key `b_id` (`b_id`,`o_id`,`r_id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=151 ;

--
-- data dump for tabellen `trm_reqsosbrows`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_reqstests`
--

create table if not exists `trm_reqstests` (
  `id` int(11) not null auto_increment,
  `t_name` varchar(255) collate utf8_bin not null,
  `r_id` int(11) not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=87 ;

--
-- data dump for tabellen `trm_reqstests`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_requirements`
--

create table if not exists `trm_requirements` (
  `id` int(11) not null auto_increment,
  `name` varchar(255) collate utf8_bin not null,
  `description` longtext collate utf8_bin not null,
  `p_id` int(11) not null,
  `nr` varchar(6) collate utf8_bin not null,
  `author` varchar(255) collate utf8_bin not null,
  `priority` enum('urgent','very high','high','medium','low') collate utf8_bin not null,
  `assigned` int(255) not null,
  primary key  (`id`),
  unique key `p_id` (`p_id`,`nr`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=328 ;

--
-- data dump for tabellen `trm_requirements`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_selenium_server_vars`
--

create table if not exists `trm_selenium_server_vars` (
  `sessionid` varchar(255) not null,
  `nodepath` varchar(255) not null,
  `u_id` varchar(255) not null,
  `t_id` int(11) not null,
  primary key  (`sessionid`)
) engine=myisam default charset=latin1;

--
-- data dump for tabellen `trm_selenium_server_vars`
--

insert into `trm_selenium_server_vars` (`sessionid`, `nodepath`, `u_id`, `t_id`) values
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
-- struktur-dump for tabellen `trm_sites`
--

create table if not exists `trm_sites` (
  `id` int(11) not null auto_increment,
  `sitename` varchar(255) collate utf8_bin not null,
  `description` longtext collate utf8_bin not null,
  primary key  (`id`),
  unique key `sitename` (`sitename`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=99 ;

--
-- data dump for tabellen `trm_sites`
--

insert into `trm_sites` (`id`, `sitename`, `description`) values
(2, 'edithr.php', 0x417373696e672070656f706c6520746f2070726f6a65637473),
(54, 'testlabindex.php', 0x496e646578207061676520666f72207468652074657374206c6162),
(7, 'corerunner.php', 0x52756e7320636f7265207465737473),
(55, 'adminindex.php', 0x41646d696e20696e6465782070616765),
(59, 'savenodes.php', 0x5361766573206e6f64652064617461),
(14, 'header.php', 0x496e636c7564656420696e206d6f73742066696c65732c20696e636c75646520636f7079726967687420616e64206c616e67756167652068616e646c6572),
(15, 'index.php', 0x4669727374207061676520746f20686974),
(58, 'editcron.php', 0x506c616e20746573747320746f2072756e20696e20746865206675747572652e205761726e696e6721212044616e6765726f75732e2043616e20706c616e20414e595448494e472121),
(18, 'main.php', 0x53686f777320737569746520726573756c7473),
(19, 'menu.php', 0x546865206272696768746c7920636f6c6f726564206d656e75),
(53, 'projectsindex.php', 0x50726f6a6563747320696e6465782070616765),
(24, 'editprojects.php', 0x4372656174652f456469742070726f6a65637473),
(98, 'editdata.php', 0x4d616e61676520746573742064617461),
(51, 'saveusertypeaccess.php', 0x5361766520757365727479706520616363636573732064617461),
(68, 'showfullreqs.php', 0x53686f7720612073696e676c6520726571756972656d656e74207374796c656420666f72207072696e74696e67),
(29, 'savehr.php', 0x536176652070656f706c652f70726f6a6563742061737369676e6d656e7473),
(30, 'saveprojects.php', 0x53617665732070726f6a656374732064617461),
(32, 'showreport.php', 0x53686f77732074686520726573756c7473206f6620612073696e676c65207375746965),
(97, 'savedata.php', 0x53617665206461746166696c65),
(50, 'editusertypeaccess.php', 0x4564697420757365727479706520616363657373),
(38, 'delete.php', 0x48616e646c657320616c6c2064656c65746573),
(39, 'editmisc.php', 0x45646974206d6973632e20696e666f),
(40, 'editnodes.php', 0x45646974206e6f64657320286c6f636174696f6e2f62726f7773657273206574632e29),
(41, 'editsites.php', 0x4564697420636f7265207369746573202854522070617468206574632e29),
(42, 'editusers.php', 0x456469742f616464207573657273),
(43, 'savemisc.php', 0x5361766573206d6973632064617461),
(44, 'savecron.php', 0x5361766573207468652063726f6e746162),
(45, 'savesites.php', 0x536176657320636f72652073697465732064617461),
(46, 'saveusers.php', 0x5361766520757365722064617461),
(79, 'manualtest.php', 0x50617274206f66206d616e75616c2074657374),
(67, 'saverequirements.php', 0x536176657320726571756972656d656e7473),
(78, 'addcomment.php', 0x416464206120636f6d6d656e7420746f20616e797468696e67),
(61, 'statusrc.php', 0x53686f77732074686520737461747573206f66207468652072756e6e696e672052432074657374),
(62, 'testrunnerrc.php', 0x52756e73205243207465737473),
(63, 'editrequirements.php', 0x456469742074686520726571756972656d656e7473),
(64, 'showreqs.php', 0x53686f7720616c6c20726571756972656d656e7473),
(65, 'edittestplan.php', 0x41737369676e20746573747320746f2070726f6a65637473),
(66, 'trmindex.php', 0x54524d20696e6465782070616765),
(70, 'edittest.php', 0x70726f7065727469657320666f7220612073696e676c652074657374),
(71, 'analysis.php', 0x53686f77732074686520737569746573206d61726b656420666f7220616e616c79736973),
(72, 'showdefects.php', 0x53686f7720616c6c2064656665637473),
(73, 'editdefectpopup.php', 0x53686f777320612073696e676c652064656665637420696e206120706f7075702077696e646f77),
(74, 'savedefect.php', 0x47656d6d65722f4f70646174657265722064656665637473),
(75, 'savecomment.php', 0x536176657320636f6d6d656e7473),
(83, 'manualcontrol.php', 0x50617274206f66206d616e75616c2074657374),
(82, 'savemanstatus.php', 0x536176652074686520726573756c74732063726561746520696e2061206d616e75616c2074657374),
(84, 'manualrunner.php', 0x50617274206f66206d616e75616c2074657374),
(85, 'edittestcase.php', 0x456469742074657374206361736573),
(86, 'createmansuite.php', 0x4372656174652061207375697465207768656e20796f752072756e2061206d616e75616c2074657374),
(87, 'savetestcase.php', 0x5361766520746573746361736573),
(88, 'savetestplan.php', 0x53617665732074657374706c616e),
(89, 'simpleftp.php', 0x48616e646c65732075706c6f6164206f6620746573747320746f20736572766572),
(90, 'uploader.php', 0x446f207468652061637475616c2075706c6f6164),
(91, 'genericrunner.php', 0x52756e20524320746573747320776974686f75742061207375697465),
(92, 'editcoresuites.php', 0x4564697420636f726520737569746573),
(93, 'savecoresuites.php', 0x5361766520636f726520737569746573),
(96, 'ajaxcron.php', 0x617364),
(95, 'download.php', '');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_suite`
--

create table if not exists `trm_suite` (
  `id` int(10) unsigned not null auto_increment,
  `suitename` varchar(255) character set latin1 collate latin1_danish_ci not null,
  `environment` varchar(255) character set latin1 not null,
  `status` varchar(255) character set latin1 collate latin1_danish_ci not null default '0',
  `timedate` datetime default null,
  `timetaken` int(10) unsigned default null,
  `browser` varchar(255) character set latin1 collate latin1_danish_ci default null,
  `platform` varchar(255) character set latin1 collate latin1_danish_ci default null,
  `selenium_version` varchar(255) character set latin1 collate latin1_danish_ci default null,
  `selenium_revision` varchar(255) character set latin1 collate latin1_danish_ci default null,
  `numtestpassed` int(10) unsigned default null,
  `numtestfailed` int(10) unsigned default null,
  `numcommandspassed` int(10) unsigned default null,
  `numcommandsfailed` int(10) unsigned default null,
  `numcommandserrors` int(10) unsigned default null,
  `p_id` int(11) not null default '0',
  `analysis` tinyint(1) not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=8 ;

--
-- data dump for tabellen `trm_suite`
--

insert into `trm_suite` (`id`, `suitename`, `environment`, `status`, `timedate`, `timetaken`, `browser`, `platform`, `selenium_version`, `selenium_revision`, `numtestpassed`, `numtestfailed`, `numcommandspassed`, `numcommandsfailed`, `numcommandserrors`, `p_id`, `analysis`) values
(6, 'trille,1 - trille,4 - trille,10', 'http://www.google.com', 'failed', '2008-08-12 21:35:41', 58, '10', '12', 'rc', '', 2, 1, 2, 1, 0, 123, 0),
(5, 'trille,1 - trille,4 - trille,10', 'http://www.google.com', 'failed', '2008-08-12 21:34:01', 58, '10', '12', 'rc', '', 2, 1, 2, 1, 0, 123, 0),
(7, 'trille,1 - trille,4 - trille,10', 'http://www.google.com', 'passed', '2008-08-12 21:46:38', 43, '10', '12', 'rc', '', 3, 0, 3, 0, 0, 123, 0);

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_tempcommands`
--

create table if not exists `trm_tempcommands` (
  `id` int(11) not null auto_increment,
  `u_id` varchar(255) collate utf8_bin not null,
  `action` text collate utf8_bin not null,
  `var1` text collate utf8_bin not null,
  `var2` text collate utf8_bin not null,
  `status` varchar(255) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=32 ;

--
-- data dump for tabellen `trm_tempcommands`
--


-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_test`
--

create table if not exists `trm_test` (
  `id` int(10) unsigned not null auto_increment,
  `status` varchar(255) character set latin1 collate latin1_danish_ci default null,
  `name` varchar(45) character set latin1 collate latin1_danish_ci default null,
  `s_id` int(10) unsigned default null,
  `thelp` longtext character set latin1 collate latin1_danish_ci not null,
  `manstatus` varchar(255) character set latin1 not null,
  `author` int(11) default null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=16 ;

--
-- data dump for tabellen `trm_test`
--

insert into `trm_test` (`id`, `status`, `name`, `s_id`, `thelp`, `manstatus`, `author`) values
(12, 'passed', 'trille', 6, 'rc-ruby', '', null),
(11, 'passed', 'trille', 6, 'rc-java', '', null),
(10, 'failed', 'trille', 6, 'rc-php', '', null),
(7, 'failed', 'trille', 5, 'rc-php', '', null),
(8, 'passed', 'trille', 5, 'rc-java', '', null),
(9, 'passed', 'trille', 5, 'rc-ruby', '', null),
(13, 'passed', 'trille', 7, 'rc-php', '', null),
(14, 'passed', 'trille', 7, 'rc-java', '', null),
(15, 'passed', 'trille', 7, 'rc-ruby', '', null);

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_types`
--

create table if not exists `trm_types` (
  `id` int(11) not null auto_increment,
  `typename` varchar(255) collate utf8_bin not null,
  `command` varchar(255) collate utf8_bin not null,
  `spacer` varchar(255) collate utf8_bin not null,
  `extension` varchar(255) collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=11 ;

--
-- data dump for tabellen `trm_types`
--

insert into `trm_types` (`id`, `typename`, `command`, `spacer`, `extension`) values
(1, 'rc-php', 'php', ' ', 'php'),
(4, 'rc-java', 'java -jar', ' ', 'jar'),
(10, 'rc-ruby', 'ruby', ' ', 'rb');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_type_of_defects`
--

create table if not exists `trm_type_of_defects` (
  `id` int(11) not null auto_increment,
  `priority` int(11) not null,
  `name` varchar(255) collate utf8_bin not null,
  `imgpath` text collate utf8_bin not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=8 ;

--
-- data dump for tabellen `trm_type_of_defects`
--

insert into `trm_type_of_defects` (`id`, `priority`, `name`, `imgpath`) values
(2, 4, 'test error', 0x696d672f746573746572726f722e706e67),
(6, 3, 'request', 0x696d672f726571756573742e706e67),
(1, 0, 'functionality', 0x696d672f66756e6374696f6e616c6974792e706e67),
(5, 1, 'layout', 0x696d672f6c61796f75742e706e67),
(7, 2, 'data', 0x696d672f646174612e706e67);

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_type_of_defect_status`
--

create table if not exists `trm_type_of_defect_status` (
  `id` int(11) not null auto_increment,
  `name` varchar(255) collate utf8_bin not null,
  `imgpath` text collate utf8_bin not null,
  `priority` int(11) not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=43 ;

--
-- data dump for tabellen `trm_type_of_defect_status`
--

insert into `trm_type_of_defect_status` (`id`, `name`, `imgpath`, `priority`) values
(4, 'rejected', 0x696d672f72656a65637465642e706e67, 3),
(1, 'open', 0x696d672f6f70656e2e706e67, 0),
(2, 'in progress', 0x696d672f696e70726f67726573732e706e67, 1),
(3, 'resolved', 0x696d672f7265736f6c7665642e706e67, 4),
(42, 'ready for test', 0x696d672f7265616479666f72746573742e706e67, 2);

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_users`
--

create table if not exists `trm_users` (
  `id` int(3) not null auto_increment,
  `firstname` varchar(255) character set utf8 collate utf8_bin not null,
  `lastname` varchar(255) character set utf8 collate utf8_bin not null,
  `name` varchar(255) character set latin1 collate latin1_danish_ci not null,
  `password` varchar(255) character set latin1 collate latin1_danish_ci not null,
  `usertype` int(11) not null default '1',
  `email` varchar(255) character set latin1 collate latin1_danish_ci not null,
  `lastlogin` datetime not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_danish_ci auto_increment=116 ;

--
-- data dump for tabellen `trm_users`
--

insert into `trm_users` (`id`, `firstname`, `lastname`, `name`, `password`, `usertype`, `email`, `lastlogin`) values
(72, '12', '12', 'selftester', '81dc9bdb52d04dc20036dbd8313ed055', 3, '', '2008-04-29 12:50:59'),
(1, 'guest', 'guest', 'guest', '084e0343a0486ff05530df6c705c8bb4', 7, '', '0000-00-00 00:00:00'),
(104, 'admin', 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 3, '', '2008-08-12 19:57:24'),
(113, '', '', 'service', '81dc9bdb52d04dc20036dbd8313ed055', 9, '', '2008-04-17 09:55:18'),
(112, '', '', 'tester', '81dc9bdb52d04dc20036dbd8313ed055', 5, '', '2008-04-17 09:48:40'),
(114, '', '', 'manager', '81dc9bdb52d04dc20036dbd8313ed055', 4, '', '2008-04-16 17:25:58');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_usertypes`
--

create table if not exists `trm_usertypes` (
  `id` int(11) not null auto_increment,
  `name` varchar(255) character set latin1 not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=10 ;

--
-- data dump for tabellen `trm_usertypes`
--

insert into `trm_usertypes` (`id`, `name`) values
(1, 'inactive'),
(3, 'admin'),
(4, 'manager'),
(5, 'tester'),
(7, 'guest'),
(9, 'service');

-- --------------------------------------------------------

--
-- struktur-dump for tabellen `trm_usertype_access`
--

create table if not exists `trm_usertype_access` (
  `id` int(11) not null auto_increment,
  `ut_id` int(11) not null,
  `s_id` int(11) not null,
  `access` int(11) not null,
  primary key  (`id`)
) engine=myisam  default charset=utf8 collate=utf8_bin auto_increment=895 ;

--
-- data dump for tabellen `trm_usertype_access`
--

insert into `trm_usertype_access` (`id`, `ut_id`, `s_id`, `access`) values
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
