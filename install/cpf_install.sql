CREATE TABLE IF NOT EXISTS `forum_group` (
  `groupid` int(6) NOT NULL AUTO_INCREMENT,
  `groupname` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `moderators` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(6) NOT NULL,
  PRIMARY KEY (`groupid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `groupid` int(6) NOT NULL,
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  `top` char(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `forum_posts_reply` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `posts_id` int(6) NOT NULL,
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `news` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `title` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `setting` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `name` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `note` char(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

INSERT INTO `setting` (`NO`, `name`, `value`, `note`) VALUES
(1, 'sitename', 'OOXX測試站', '網站名稱，純文字'),
(2, 'url', 'https://yourname', '網站網址'),
(3, 'reg', 'true', '是否開放註冊，開放為true，關閉為false'),
(4, 'forum', 'true', '是否開啟會員討論區，開啟為true，關閉為false'),
(5, 'news', 'true', '是否開啟最新消息，開啟為true，關閉為false'),
(6, 'homepage_welcome', '<h2>歡迎來到OOXX測試站</h2>', '首頁歡迎語'),
(7, 'user_pm', 'true', '是否開啟會員私人短消息，開啟為true，關閉為false'),
(8, 'url_static', 'true', '是否開啟會員討論區版塊、會員討論區版塊帖子、部落格文章(外掛)網址偽靜態，開啟為true，關閉為false'),
(9, 'cookie_prefix', 'demo_', 'cookie前綴');

CREATE TABLE IF NOT EXISTS `user` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `username` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `level` char(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_pm` (
  `NO` int(6) NOT NULL AUTO_INCREMENT,
  `send_from` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `send_to` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `title` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `state` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `if_read` int(1) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
