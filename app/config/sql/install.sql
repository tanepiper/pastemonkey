-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-2ubuntu1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 03, 2007 at 03:44 PM
-- Server version: 5.0.38
-- PHP Version: 5.2.1
-- 
-- Database: `pastemonkey`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `attachments`
-- 

DROP TABLE IF EXISTS `attachments`;
CREATE TABLE `attachments` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `class` varchar(20) NOT NULL,
  `foreign_id` int(8) NOT NULL,
  `filename` varchar(255) default NULL,
  `dir` varchar(255) default NULL,
  `mimetype` varchar(255) default NULL,
  `filesize` int(11) unsigned default NULL,
  `height` int(10) unsigned default NULL,
  `width` int(10) unsigned default NULL,
  `thumb` tinyint(1) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `attachments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `cake_sessions`
-- 

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE `cake_sessions` (
  `id` varchar(255) collate utf8_unicode_ci NOT NULL default '',
  `data` text collate utf8_unicode_ci,
  `expires` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `cake_sessions`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `config_categories`
-- 

DROP TABLE IF EXISTS `config_categories`;
CREATE TABLE `config_categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `config_categories`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `configs`
-- 

DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `config_category_id` int(10) unsigned NOT NULL,
  `key` varchar(50) collate utf8_unicode_ci NOT NULL,
  `value` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `configs`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `languages`
-- 

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `language` varchar(255) collate utf8_unicode_ci NOT NULL,
  `class` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

-- 
-- Dumping data for table `languages`
-- 

INSERT INTO `languages` (`id`, `language`, `class`) VALUES 
(1, 'Actionscript', 'actionscript'),
(2, 'ADA', 'ada'),
(3, 'Apache Log', 'apache'),
(4, 'AppleScript', 'applescript'),
(5, 'ASM', 'asm'),
(6, 'ASP', 'asp'),
(7, 'AutoIT', 'autoit'),
(8, 'Backus-Naur form', 'bnf'),
(9, 'Bash', 'bash'),
(10, 'BlitzBasic', 'blitzbasic'),
(11, 'C', 'c'),
(12, 'C For Macs', 'c_mac'),
(13, 'C#', 'csharp'),
(14, 'C++', 'cpp'),
(15, 'CAD DCL', 'caddcl'),
(16, 'CadLisp', 'cadlisp'),
(17, 'CFDG', 'cfdg'),
(18, 'ColdFusion', 'cfm'),
(19, 'CSS', 'css'),
(20, 'Delphi', 'delphi'),
(21, 'DIV', 'div'),
(22, 'DOS', 'dos'),
(23, 'Eiffel', 'eiffel'),
(24, 'Fortran', 'fortran'),
(25, 'FreeBasic', 'freebasic'),
(26, 'GML', 'gml'),
(27, 'Groovy', 'groovy'),
(28, 'HTML', 'html4strict'),
(29, 'Inno', 'inno'),
(30, 'IO', 'io'),
(31, 'Java', 'java'),
(32, 'Java 5', 'java5'),
(33, 'JavaScript', 'javascript'),
(34, 'LaTeX', 'latex'),
(35, 'Lisp', 'lisp'),
(36, 'Lua', 'lua'),
(37, 'Microprocessor ASM', 'mpasm'),
(38, 'mIRC', 'mirc'),
(39, 'MySQL', 'mysql'),
(40, 'NSIS', 'nsis'),
(41, 'Objective C', 'objc'),
(42, 'OCaml', 'ocaml'),
(43, 'Open Office BASIC', 'oobas'),
(44, 'Oracle 8 SQL', 'oracle8'),
(45, 'Pascal', 'pascal'),
(46, 'Perl', 'perl'),
(47, 'PHP', 'php'),
(48, 'Plain Text', 'text'),
(49, 'PL/SQL', 'plsql'),
(50, 'Python', 'python'),
(51, 'Q(uick) Basic', 'qbasic'),
(52, 'robots.txt', 'robots'),
(53, 'Ruby', 'ruby'),
(54, 'SAS', 'sas'),
(55, 'Scheme', 'scheme'),
(56, 'SDLBasic', 'sdlbasic'),
(57, 'Smalltalk', 'smalltalk'),
(58, 'Smarty', 'smarty'),
(59, 'SQL', 'sql'),
(60, 'T-SQL', 'tsql'),
(61, 'TCL', 'tcl'),
(62, 'thinBasic', 'thinbasic'),
(63, 'Uno IDL', ''),
(64, 'VB.NET', 'vbnet'),
(65, 'Visual Basic', 'vb'),
(66, 'Visual Fox Pro', 'visualfoxpro'),
(67, 'Winbatch', 'winbatch'),
(68, 'X++', 'xpp'),
(69, 'XML', 'xml'),
(70, 'Z80 ASM', 'z80');

-- --------------------------------------------------------

-- 
-- Table structure for table `pastes`
-- 

DROP TABLE IF EXISTS `pastes`;
CREATE TABLE `pastes` (
  `id` varchar(36) collate utf8_unicode_ci NOT NULL,
  `paste` longtext collate utf8_unicode_ci NOT NULL,
  `note` text collate utf8_unicode_ci,
  `author` varchar(255) collate utf8_unicode_ci default NULL,
  `tags` text collate utf8_unicode_ci,
  `parent_id` varchar(36) collate utf8_unicode_ci default NULL,
  `language_id` int(11) NOT NULL,
  `private` tinyint(1) unsigned NOT NULL default '0',
  `created` datetime default NULL,
  `expiry` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `pastes`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pastes_tags`
-- 

DROP TABLE IF EXISTS `pastes_tags`;
CREATE TABLE `pastes_tags` (
  `paste_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `pastes_tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pinboards`
-- 

DROP TABLE IF EXISTS `pinboards`;
CREATE TABLE `pinboards` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `author` varchar(255) collate utf8_unicode_ci NOT NULL,
  `tags` varchar(255) collate utf8_unicode_ci default NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `pinboards`
-- 

INSERT INTO `pinboards` (`id`, `title`, `body`, `author`, `tags`, `created`, `modified`) VALUES 
(1, 'Paste Monkey 0.2', '<p>Welcome to the Pinboards.  This is a new feature in Paste Monkey that allows me to update you with very simple blog messages about the progress of Paste Monkey.</p>\r\n\r\n<p>As I''ve said, this is version 0.2, and so far here are the existing features:</p>\r\n<ul>\r\n<li>Powered by <a href="http://cakephp.org">CakePHP</a> 1.2 MVC Framework.  Allows for a lightweight application, that is rapidly developed. (Release Early, Release Often!</li>\r\n<li>Full AJAX Interface using <a href="http://jquery.com">jQuery</a>.</li>\r\n<li><a href="http://geshi.sf.net">GeSHi</a> Syntax Highlighting library for PHP, provides the formatting for around 50 lanuages.</li>\r\n<li>Download the source code of each paste, as well as the Diff file of any amendments to a paste.</li>\r\n<li>Fully open-source under the MIT Licence (some components are GPL, License included).</li>\r\n<li class="new-feature">Basic News System called Pinboard that allows paste community to be kept up to date with the latest developments.</li>\r\n</ul>\r\n<p>As I am following the Release Early, Release Often methodology, Paste Monkey is constantly being updated with new features.  Keep an eye out on this pinboard to be kept up to date.</p>', 'Tane', 'Welcome, Pinboard, News, Details', '2007-09-28 08:29:30', '2007-09-28 08:31:59'),
(2, 'Pastebin 0.2.5', 'Today I have uploaded the latest version of my code.  In the code there are some improvements for performance, plus expiries now work, although all old posts that have not got an expiry will not be affected, however there may soon be a purge of any code on here anyway.', 'Tane', 'Paste Monkey, Beta, Expiry', '2007-09-29 11:18:52', '2007-09-29 11:18:52'),
(3, 'Newest Feature: Captcha', 'Tonight, I have implemented the latest feature into the code - Spam Captcha.  The code uses the <a href="http://recaptcha.net/">ReCaptcha</a> API.  As well as helping to stop spam, it helps the ReCaptcha project as well.  Check out their site for more details', 'Tane', 'Captcha, Recaptcha', '2007-09-30 22:58:58', '2007-09-30 22:58:58'),
(4, 'New Live Search function', 'Today, the newest feature to be added is the Live Search.  When JavaScript is enabled, all you need to do is type in the word you are looking for, and tab off the field.  This will then fire the search, and load the results into the main content area.  If you don''t have JavaScript, thats fine because you''ll see a search button that works like normal.\r\n\r\nI''ve also started moving over to another design.  At the moment, it''s a bit hodge-podge, but gradually you''ll see it building up.', 'Tane', 'Live Search', '2007-10-01 16:38:16', '2007-10-01 16:38:16'),
(5, 'Pastemonkey.org now active', 'The new permanent URL for this site, <a href="http://pastemonkey.org">pastemonkey.org</a> is now active.', 'Tane', 'Site Url', '2007-10-01 23:09:19', '2007-10-01 23:09:19'),
(6, 'Various Improvments', 'I''ve installed various improvments on both the server and in the code.  First of all, I''ve upgraded the server from 256mb to 512mb RAM, and I''ve installed <a href="http://www.danga.com/memcached/">Memcache</a>.  Since these improvements, the speed on this site has improved VASTLY.  I''ve also cleaned up some code, as well as adding a few more UI elements.', 'Tane', 'Memcache, Server, Improvments', '2007-10-02 16:22:47', '2007-10-02 16:22:47'),
(7, 'Private pastes and other improvments', 'Since Memcache has been installed, there has been some major improvements in the site handling.  Since then, I''ve implemented some privacy features.  The first is the ability to make a paste private.  This means your paste will not show up on any lists or searches, but it is still public.  The second feature is now paste ID''s are a UUID instead of an integer, this means the URL is not easily guessable.', 'Tane', 'Privacy', '2007-10-03 13:21:18', '2007-10-03 13:21:18');

-- --------------------------------------------------------

-- 
-- Table structure for table `pinboards_tags`
-- 

DROP TABLE IF EXISTS `pinboards_tags`;
CREATE TABLE `pinboards_tags` (
  `pinboard_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `pinboards_tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tags`
-- 

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `tag` varchar(255) collate utf8_unicode_ci NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `passwd` varchar(255) collate utf8_unicode_ci NOT NULL,
  `author` varchar(255) collate utf8_unicode_ci NOT NULL,
  `pastes_count` int(11) unsigned NOT NULL default '0',
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `users`
-- 

