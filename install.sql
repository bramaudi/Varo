-- Database: `varo`

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_comment`
-- 

CREATE TABLE `varo_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `text` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_time` int(11) NOT NULL,
  `edit_author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_forum`
-- 

CREATE TABLE `varo_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_friend`
-- 

CREATE TABLE `varo_friend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `req_id` int(11) NOT NULL,
  `rec_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_gallery`
-- 

CREATE TABLE `varo_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_images`
-- 

CREATE TABLE `varo_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_messages`
-- 

CREATE TABLE `varo_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_id` int(10) NOT NULL,
  `from_id` int(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` int(1) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_post`
-- 

CREATE TABLE `varo_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int(11) NOT NULL,
  `edit_time` int(11) NOT NULL,
  `edit_author` int(11) NOT NULL,
  `last` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Table structure for table `varo_users`
-- 

CREATE TABLE `varo_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first` varchar(10) NOT NULL,
  `last` varchar(10) NOT NULL,
  `user` varchar(10) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `key` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `level` int(1) NOT NULL DEFAULT '3',
  `ban` int(1) NOT NULL DEFAULT '0',
  `online` int(11) NOT NULL,
  `theme` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------
-- 
-- Dumping data for table `varo_users`
-- 

INSERT INTO `varo_users` VALUES ('1','Super','Admin','503418930','77e2edcc9b40441200e31dc57dbb8829','f322a625d18446e13415b0e854240608','admin@site.com','','1','0','0','');

SET @@global.time_zone = '+07:00'
