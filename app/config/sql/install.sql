-- phpMyAdmin SQL Dump
-- version 2.10.3deb1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Oct 27, 2007 at 10:44 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.3-1ubuntu6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `pastemonkey`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `cake_sessions`
-- 

DROP TABLE IF EXISTS `cake_sessions`;
CREATE TABLE IF NOT EXISTS `cake_sessions` (
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
-- Table structure for table `comments`
-- 

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `paste_id` bigint(11) unsigned NOT NULL,
  `line_position` int(5) NOT NULL,
  `comment` text collate utf8_unicode_ci NOT NULL,
  `author` varchar(255) collate utf8_unicode_ci NOT NULL,
  `created` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `comments`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `languages`
-- 

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `language` varchar(255) collate utf8_unicode_ci NOT NULL,
  `class` varchar(255) collate utf8_unicode_ci NOT NULL,
  `weight` int(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

-- 
-- Dumping data for table `languages`
-- 

INSERT INTO `languages` (`id`, `language`, `class`, `weight`) VALUES 
(1, 'Actionscript', 'actionscript', 0),
(2, 'ADA', 'ada', 0),
(3, 'Apache Log', 'apache', 0),
(4, 'AppleScript', 'applescript', 0),
(5, 'ASM', 'asm', 0),
(6, 'ASP', 'asp', 0),
(7, 'AutoIT', 'autoit', 0),
(8, 'Backus-Naur form', 'bnf', 0),
(9, 'Bash', 'bash', 0),
(10, 'BlitzBasic', 'blitzbasic', 0),
(11, 'C', 'c', 0),
(12, 'C For Macs', 'c_mac', 0),
(13, 'C#', 'csharp', 0),
(14, 'C++', 'cpp', 0),
(15, 'CAD DCL', 'caddcl', 0),
(16, 'CadLisp', 'cadlisp', 0),
(17, 'CFDG', 'cfdg', 0),
(18, 'ColdFusion', 'cfm', 0),
(19, 'CSS', 'css', 0),
(20, 'Delphi', 'delphi', 0),
(21, 'DIV', 'div', 0),
(22, 'DOS', 'dos', 0),
(23, 'Eiffel', 'eiffel', 0),
(24, 'Fortran', 'fortran', 0),
(25, 'FreeBasic', 'freebasic', 0),
(26, 'GML', 'gml', 0),
(27, 'Groovy', 'groovy', 0),
(28, 'HTML', 'html4strict', 14),
(29, 'Inno', 'inno', 0),
(30, 'IO', 'io', 0),
(31, 'Java', 'java', 0),
(32, 'Java 5', 'java5', 0),
(33, 'JavaScript', 'javascript', 2),
(34, 'LaTeX', 'latex', 0),
(35, 'Lisp', 'lisp', 0),
(36, 'Lua', 'lua', 0),
(37, 'Microprocessor ASM', 'mpasm', 0),
(38, 'mIRC', 'mirc', 0),
(39, 'MySQL', 'mysql', 0),
(40, 'NSIS', 'nsis', 0),
(41, 'Objective C', 'objc', 0),
(42, 'OCaml', 'ocaml', 0),
(43, 'Open Office BASIC', 'oobas', 0),
(44, 'Oracle 8 SQL', 'oracle8', 0),
(45, 'Pascal', 'pascal', 0),
(46, 'Perl', 'perl', 0),
(47, 'PHP', 'php', 21),
(48, 'Plain Text', 'text', 17),
(49, 'PL/SQL', 'plsql', 0),
(50, 'Python', 'python', 0),
(51, 'Q(uick) Basic', 'qbasic', 0),
(52, 'robots.txt', 'robots', 0),
(53, 'Ruby', 'ruby', 0),
(54, 'SAS', 'sas', 0),
(55, 'Scheme', 'scheme', 0),
(56, 'SDLBasic', 'sdlbasic', 0),
(57, 'Smalltalk', 'smalltalk', 0),
(58, 'Smarty', 'smarty', 0),
(59, 'SQL', 'sql', 0),
(60, 'T-SQL', 'tsql', 0),
(61, 'TCL', 'tcl', 0),
(62, 'thinBasic', 'thinbasic', 0),
(63, 'Uno IDL', '', 0),
(64, 'VB.NET', 'vbnet', 0),
(65, 'Visual Basic', 'vb', 0),
(66, 'Visual Fox Pro', 'visualfoxpro', 0),
(67, 'Winbatch', 'winbatch', 0),
(68, 'X++', 'xpp', 0),
(69, 'XML', 'xml', 0),
(70, 'Z80 ASM', 'z80', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `pastes`
-- 

DROP TABLE IF EXISTS `pastes`;
CREATE TABLE IF NOT EXISTS `pastes` (
  `id` bigint(11) unsigned NOT NULL auto_increment,
  `priv_stub` char(36) collate utf8_unicode_ci NOT NULL,
  `paste` longtext collate utf8_unicode_ci NOT NULL,
  `note` text collate utf8_unicode_ci,
  `author` varchar(255) collate utf8_unicode_ci default NULL,
  `tags` text collate utf8_unicode_ci,
  `highlight_lines` varchar(255) collate utf8_unicode_ci default NULL,
  `parent_id` bigint(11) unsigned default NULL,
  `language_id` int(11) NOT NULL,
  `private` tinyint(1) unsigned NOT NULL default '0',
  `created` datetime default NULL,
  `expiry` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `pastes`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `pastes_tags`
-- 

DROP TABLE IF EXISTS `pastes_tags`;
CREATE TABLE IF NOT EXISTS `pastes_tags` (
  `paste_id` bigint(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `pastes_tags`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tags`
-- 

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `tag` varchar(255) collate utf8_unicode_ci NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tags`
-- 

