-- --------------------------------------------------------
-- book list table
--
-- `cc_web_book`
--

CREATE TABLE IF NOT EXISTS `cc_web_book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_dbid` int(11) DEFAULT NULL,
  `book_img` varchar(500) DEFAULT NULL,
  `book_name` varchar(200) DEFAULT NULL,
  `book_author` varchar(100) DEFAULT NULL,
  `book_publisher` varchar(100) DEFAULT NULL,
  `book_pages` int(11) DEFAULT NULL,
  `book_ISBN` varchar(30) DEFAULT NULL,
  `book_pubdate` datetime DEFAULT NULL,
  `book_create` datetime DEFAULT NULL,
  `book_isRead` int DEFAULT '0',
  `book_valid` int(11) DEFAULT '1',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- lend list table
--
-- `cc_web_lend`
--

CREATE TABLE IF NOT EXISTS `cc_web_lend` (
  `lend_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `lend_Man` varchar(50) DEFAULT NULL,
  `lend_date` datetime DEFAULT NULL,
  `lend_back` datetime DEFAULT NULL,
  `lend_valid` int(11) DEFAULT '1',
  PRIMARY KEY (`lend_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------
-- base setting table
--
-- `cc_web_base`
--

CREATE TABLE IF NOT EXISTS `cc_web_base` (
  `base_id` int(11) NOT NULL AUTO_INCREMENT,
  `base_name` varchar(50) DEFAULT NULL,
  `base_value` varchar(200) DEFAULT NULL,
  `base_update` datetime DEFAULT NULL,
  `base_valid` int(11) DEFAULT '1',
  PRIMARY KEY (`base_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `cc_web_base` (`base_name`, `base_value`, `base_update`, `base_valid`)
VALUES  ('WebName', '我的图书馆', now(), 1);

INSERT INTO `cc_web_base` (`base_name`, `base_value`, `base_update`, `base_valid`)
VALUES  ('Logo', './upload/logo.png', now(), 1);

INSERT INTO `cc_web_base` (`base_name`, `base_value`, `base_update`, `base_valid`)
VALUES  ('login', './upload/login.png', now(), 1);

INSERT INTO `cc_web_base` (`base_name`, `base_value`, `base_update`, `base_valid`)
VALUES  ('ReadCtrl', '1', now(), 1);

