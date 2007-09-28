-- phpMyAdmin SQL Dump
-- version 2.9.1.1-Debian-2ubuntu1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 28, 2007 at 10:08 AM
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
  `id` char(36) collate utf8_unicode_ci NOT NULL,
  `model` varchar(25) collate utf8_unicode_ci NOT NULL,
  `model_id` char(36) collate utf8_unicode_ci NOT NULL,
  `group` varchar(20) collate utf8_unicode_ci NOT NULL,
  `mime_type` varchar(50) collate utf8_unicode_ci default NULL,
  `user_id` char(36) collate utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `title` varchar(100) collate utf8_unicode_ci default NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- Dumping data for table `attachments`
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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=70 ;

-- 
-- Dumping data for table `languages`
-- 

INSERT INTO `languages` (`id`, `language`) VALUES 
(1, 'Actionscript'),
(2, 'ADA'),
(3, 'Apache Log'),
(4, 'AppleScript'),
(5, 'ASM'),
(6, 'ASP'),
(7, 'AutoIT'),
(8, 'Backus-Naur form'),
(9, 'Bash'),
(10, 'BlitzBasic'),
(11, 'C'),
(12, 'C For Macs'),
(13, 'C#'),
(14, 'C++'),
(15, 'CAD DCL'),
(16, 'CadLisp'),
(17, 'CFDG'),
(18, 'ColdFusion'),
(19, 'CSS'),
(20, 'Delphi'),
(21, 'DIV'),
(22, 'DOS'),
(23, 'Eiffel'),
(24, 'Fortran'),
(25, 'FreeBasic'),
(26, 'GML'),
(27, 'Groovy'),
(28, 'HTML'),
(29, 'Inno'),
(30, 'IO'),
(31, 'Java'),
(32, 'Java 5'),
(33, 'JavaScript'),
(34, 'LaTeX'),
(35, 'Lisp'),
(36, 'Lua'),
(37, 'Microprocessor ASM'),
(38, 'mIRC'),
(39, 'MySQL'),
(40, 'NSIS'),
(41, 'Objective C'),
(42, 'OCaml'),
(43, 'Open Office BASIC'),
(44, 'Oracle 8 SQL'),
(45, 'Pascal'),
(46, 'Perl'),
(47, 'PHP'),
(48, 'PL/SQL'),
(49, 'Python'),
(50, 'Q(uick) Basic'),
(51, 'robots.txt'),
(52, 'Ruby'),
(53, 'SAS'),
(54, 'Scheme'),
(55, 'SDLBasic'),
(56, 'Smalltalk'),
(57, 'Smarty'),
(58, 'SQL'),
(59, 'T-SQL'),
(60, 'TCL'),
(61, 'thisBasic'),
(62, 'Uno IDL'),
(63, 'VB.NET'),
(64, 'Visual Basic'),
(65, 'Visual Fox Pro'),
(66, 'Winbatch'),
(67, 'X++'),
(68, 'XML'),
(69, 'Z80 ASM');

-- --------------------------------------------------------

-- 
-- Table structure for table `pastes`
-- 

DROP TABLE IF EXISTS `pastes`;
CREATE TABLE `pastes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `paste` longtext collate utf8_unicode_ci NOT NULL,
  `note` text collate utf8_unicode_ci,
  `author` varchar(255) collate utf8_unicode_ci default NULL,
  `tags` text collate utf8_unicode_ci,
  `parent_id` int(11) unsigned default NULL,
  `language_id` int(11) NOT NULL,
  `filename` varchar(255) collate utf8_unicode_ci default NULL,
  `dir` varchar(255) collate utf8_unicode_ci default NULL,
  `mimetype` varchar(255) collate utf8_unicode_ci default NULL,
  `filesize` int(15) default NULL,
  `created` datetime default NULL,
  `expiry` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `pinboards`
-- 

INSERT INTO `pinboards` (`id`, `title`, `body`, `author`, `tags`, `created`, `modified`) VALUES 
(1, 'Paste Monkey 0.2', '<p>Welcome to the Pinboards.  This is a new feature in Paste Monkey that allows me to update you with very simple blog messages about the progress of Paste Monkey.</p>\r\n\r\n<p>As I''ve said, this is version 0.2, and so far here are the existing features:</p>\r\n<ul>\r\n<li>Powered by <a href="http://cakephp.org">CakePHP</a> 1.2 MVC Framework.  Allows for a lightweight application, that is rapidly developed. (Release Early, Release Often!</li>\r\n<li>Full AJAX Interface using <a href="http://jquery.com">jQuery</a>.</li>\r\n<li><a href="http://geshi.sf.net">GeSHi</a> Syntax Highlighting library for PHP, provides the formatting for around 50 lanuages.</li>\r\n<li>Download the source code of each paste, as well as the Diff file of any amendments to a paste.</li>\r\n<li>Fully open-source under the MIT Licence (some components are GPL, License included).</li>\r\n<li class="new-feature">Basic News System called Pinboard that allows paste community to be kept up to date with the latest developments.</li>\r\n</ul>\r\n<p>As I am following the Release Early, Release Often methodology, Paste Monkey is constantly being updated with new features.  Keep an eye out on this pinboard to be kept up to date.</p>', 'Tane', 'Welcome, Pinboard, News, Details', '2007-09-28 08:29:30', '2007-09-28 08:31:59');

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


