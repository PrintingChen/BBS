-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-05-24 12:35:59
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webshare`
--

-- --------------------------------------------------------

--
-- 表的结构 `ws_content`
--

CREATE TABLE IF NOT EXISTS `ws_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标识符',
  `module_id` int(11) NOT NULL COMMENT '所属子版块id',
  `title` varchar(30) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '帖子内容',
  `time` datetime NOT NULL COMMENT '发帖时间',
  `member_id` int(11) NOT NULL COMMENT '会员id',
  `times` int(11) NOT NULL COMMENT '浏览次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- 转存表中的数据 `ws_content`
--

INSERT INTO `ws_content` (`id`, `module_id`, `title`, `content`, `time`, `member_id`, `times`) VALUES
(1, 23, '马布里', '士大夫士大夫', '2016-04-10 13:42:36', 30, 24),
(2, 8, '邓肯', '邓肯邓肯邓肯邓肯邓肯邓肯', '2016-04-10 13:50:20', 30, 3),
(3, 15, '姚明', '姚明姚明姚明姚明<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/18.gif" border="0" alt="" />\n<iframe src="http://localhost/web/webshare/kindeditor/plugins/baidumap/index.html?center=121.473704%2C31.230393&zoom=11&width=558&height=360&markers=121.473704%2C31.230393&markerStyles=l%2CA" frameborder="0" style="width:560px;height:362px;">\n</iframe>', '2016-04-10 13:51:10', 30, 89),
(9, 28, '说的分公司的 f', '&nbsp;发第三方', '2016-04-11 10:59:46', 14, 0),
(10, 30, '是对方的风格', '的更多人的风格地方官方打工 <br />', '2016-04-10 11:04:35', 31, 19),
(11, 24, '染头发刚刚好', '反对股份的股份的', '2016-04-11 11:08:38', 14, 54),
(12, 30, '的非官方的过', '梵蒂冈工号', '2016-04-11 16:21:49', 14, 10),
(13, 32, '利拉德对库里', '利拉德利拉德利拉德利拉德利拉德都是非法水电费水电费水电费过', '2016-04-12 09:38:33', 14, 9),
(14, 30, '说的开发商地方', '水电费safari撒', '2016-04-12 09:39:42', 14, 8),
(15, 30, '说的分手的', '&nbsp;发生的', '2016-04-12 09:52:16', 14, 9),
(16, 31, 'sdfsdf', '&nbsp;是的发生的发', '2016-04-12 10:02:15', 14, 40),
(17, 31, 'sdfdsfs', 'fsdfsadf', '2016-04-12 10:21:33', 31, 6),
(18, 31, '发个法规和规范化', '黑寡妇好 <br />', '2016-04-12 10:22:11', 31, 19),
(19, 31, '王泽奇', '王泽奇王泽奇王泽奇王泽奇', '2016-04-12 15:33:42', 32, 27),
(20, 30, '北卡夺冠了。。', '北卡夺冠了北卡夺冠了北卡夺冠了北卡夺冠了<img border="0" alt="" src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/44.gif" />', '2016-04-12 15:38:40', 33, 34),
(21, 8, '邓呆呆', '<strong> </strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯</strong><strong>邓肯<strong>邓呆呆</strong><strong>邓呆呆</strong><strong>邓呆呆</strong><strong>邓呆呆</strong></strong>', '2016-04-17 16:28:56', 14, 10),
(22, 31, '是地方都是粉色的 ', '水电费水电费的事发达舒服是的个', '2016-04-17 22:10:06', 14, 46),
(23, 27, '士大夫士大夫', '士大夫士大夫是否水电费', '2016-04-25 14:17:22', 14, 54),
(24, 31, '水电费水电费水电费 ', '发撒地方个单方事故的', '2016-04-25 21:44:24', 14, 3),
(25, 25, '辽宁必胜', '辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜辽宁必胜', '2016-04-26 08:47:23', 34, 28),
(26, 31, '北大', '北大北大北大北大北大北大北大北大北大北大北大', '2016-05-08 15:33:48', 35, 9),
(27, 32, '2016-2016赛季总冠军', '2016-2016赛季总冠军2016-2016赛季总冠军2016-2016赛季总冠军', '2016-05-08 16:34:48', 35, 19),
(28, 33, '山东青岛队', '山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队山东青岛队', '2016-05-08 21:02:05', 14, 31),
(29, 35, '北卡乔丹', '北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹北卡乔丹', '2016-05-08 21:27:33', 14, 9),
(30, 29, '浙江稠州银行', '浙江稠州银行浙江稠州银行浙江稠州银行浙江稠州银行浙江稠州银行浙江稠州银行浙江稠州银行', '2016-05-08 21:30:47', 14, 56),
(31, 15, '姚明以前在上海大鲨鱼', '姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼姚明以前在上海大鲨鱼', '2016-05-09 15:00:34', 14, 15),
(32, 15, '隐秘的身份', '水电费水电费的说法', '2016-05-09 15:48:30', 14, 4),
(58, 32, '勇士输给了雷霆', '<p>\r\n	<img src="http://api.map.baidu.com/staticimage?center=108.64309%2C24.491021&zoom=13&width=558&height=360&markers=108.64309%2C24.491021&markerStyles=l%2CA" alt="" />\r\n</p>\r\n<p>\r\n	我在这里。。。。\r\n</p>', '2016-05-18 22:45:09', 1, 0),
(34, 35, '周鸿祎是交大毕业的', '周鸿祎是交大毕业的周鸿祎是交大毕业的周鸿祎是交大毕业的周鸿祎是交大毕业的', '2016-05-09 22:47:01', 14, 45),
(59, 32, '勇士输给le啦雷霆', '<p>\r\n	<img src="http://api.map.baidu.com/staticimage?center=108.64309%2C24.491021&zoom=13&width=558&height=360&markers=108.64309%2C24.491021&markerStyles=l%2CA" alt="" />\r\n</p>\r\n<p>\r\n	我在这里。。。\r\n</p>', '2016-05-18 22:46:15', 1, 0),
(36, 35, '南京大学很美', '<p>\r\n	<strong><span style="color:#4C33E5;">南京大学很美南京大</span></strong><span style="line-height:1.5;color:#4C33E5;"><strong>美</strong></span><span style="line-height:1.5;color:#4C33E5;"><strong>学很</strong></span> \r\n</p>\r\n<p>\r\n	<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/10.gif" alt="" border="0" /> \r\n</p>\r\n<p>\r\n	<img src="/web/webshare/kindeditor/attached/image/20160510/20160510102419_13474.png" alt="" /> \r\n</p>\r\n<p>\r\n	<iframe src="http://localhost/web/webshare/kindeditor/plugins/baidumap/index.html?center=121.473704%2C31.230393&zoom=11&width=558&height=360&markers=121.473704%2C31.230393&markerStyles=l%2CA" style="width:560px;height:362px;" frameborder="0">\r\n	</iframe>\r\n</p>', '2016-05-10 10:25:03', 14, 17),
(37, 38, 'sdfdsfdsfdfsdsf', 'dsffdfddsffsddfsfdsfdsdsfff', '2016-05-12 21:45:29', 14, 59),
(38, 26, 'errrtre', 'reretr', '2016-05-12 21:45:54', 14, 28),
(39, 39, '我是周杰伦', '<span style="color:#4C33E5;font-size:24px;">我是周ＪＪ</span>', '2016-05-12 21:46:01', 14, 68),
(40, 40, '说的如果法国规范化', '法规和风格呵呵发', '2016-05-13 11:51:24', 36, 12),
(41, 41, '的非官方会更好', '是对方的身份规定', '2016-05-13 11:56:11', 36, 13),
(42, 39, '广东队很强', '广东队很强广东队很强广东队很强广东队很强广东队很强广东队很强', '2016-05-14 10:15:16', 38, 14),
(43, 32, '库里脚踝扭伤了', '库里脚踝扭伤了，勇士还会夺得总冠军吗？？？', '2016-05-14 12:56:04', 38, 8),
(44, 32, '勇士会赢的', '勇士会赢的勇士会赢的勇士会赢的勇士会赢的勇士会赢的', '2016-05-14 16:15:38', 38, 9),
(45, 23, '北京马布里', '北京马布里北京马布里北京马布里北京马布里', '2016-05-14 16:19:59', 38, 11),
(53, 25, '的范德萨分', '是的官方打工发 <br />', '2016-05-15 13:12:25', 29, 4),
(57, 26, '福建福建福建福建·', '福建福建福建福建福建福建福建', '2016-05-15 13:26:41', 29, 2),
(56, 38, '风格的股份的规划', '&nbsp;大概回复更好符合法规就好发', '2016-05-15 13:12:54', 29, 0),
(60, 31, '北大', '<img src="http://api.map.baidu.com/staticimage?center=121.473704%2C31.230393&zoom=11&width=558&height=360&markers=121.473704%2C31.230393&markerStyles=l%2CA" alt="" />', '2016-05-18 22:47:21', 1, 0),
(61, 32, 'VC非常刚才吃饭', '复旦光华很反感好', '2016-05-18 22:48:10', 1, 0),
(62, 32, '勇士输了雷霆', '<p>\r\n	<img src="http://api.map.baidu.com/staticimage?center=108.64309%2C24.491021&zoom=13&width=558&height=360&markers=108.64309%2C24.491021&markerStyles=l%2CA" alt="" />我在\r\n</p>\r\n<p>\r\n	这里。。。。\r\n</p>', '2016-05-18 22:50:44', 38, 5),
(63, 23, '马布里在北京队夺了冠军', '马布里在北京队夺了冠军马布里在北京队夺了冠军马布里在北京队夺了冠军', '2016-05-20 16:08:59', 14, 1),
(64, 32, '勇士大比分赢了雷霆', '勇士大比分赢了雷霆勇士大比分赢了雷霆勇士大比分赢了雷霆勇士大比分赢了雷霆', '2016-05-20 16:19:55', 14, 2),
(65, 32, '勇士大比分赢了雷霆', '勇士大比分赢了雷霆勇士大比分赢了雷霆勇士大比分赢了雷霆勇士大比分赢了雷霆', '2016-05-20 16:23:44', 14, 4),
(66, 41, '广西宜州', '广西宜州广西宜州广西宜州广西宜州', '2016-05-20 16:59:44', 14, 7),
(70, 29, '浙江队', '浙江队浙江队浙江队浙江队', '2016-05-20 17:11:43', 14, 3),
(71, 25, '辽宁大连', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;辽宁大连辽宁大连辽宁大连辽宁大连', '2016-05-20 17:12:04', 14, 0),
(72, 35, '交大', '交大交大交大交大', '2016-05-20 17:15:04', 14, 0),
(74, 40, '江苏南京', '江苏南京江苏南京江苏南京江苏南京', '2016-05-20 17:16:22', 14, 4),
(75, 8, '邓呆呆要退役了', '邓呆呆要退役了邓呆呆要退役了邓呆呆要退役了邓呆呆要退役了邓呆呆要退役了', '2016-05-20 17:17:49', 14, 3),
(76, 39, '广东广东广东广东', '<p>\r\n	广东广东广东广东广东广东广东广东广东广东广东广东广东广东广东广东广东广东广东广东\r\n</p>\r\n<p>\r\n	广东广东广东广东广东广东广东广东\r\n</p>\r\n<p>\r\n	广东广东广东广东广东广东广东广东广东广东广东\r\n</p>', '2016-05-20 20:46:59', 38, 2),
(77, 27, '汾酒集团', '汾酒集团汾酒集团汾酒<span style="color:#4C33E5;font-size:16px;">集团汾</span>酒集团汾酒集团', '2016-05-21 10:56:52', 33, 6),
(78, 26, '福建福建福建。。。', '福建福建福建福建福建福建福建福建福建', '2016-05-21 14:43:19', 14, 3),
(79, 41, '广西队很弱', '广西队很弱广西队很弱广西队很弱广西队很弱', '2016-05-23 16:38:14', 14, 3);

-- --------------------------------------------------------

--
-- 表的结构 `ws_father_module`
--

CREATE TABLE IF NOT EXISTS `ws_father_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一ID',
  `module_name` varchar(50) NOT NULL COMMENT '父版块名字',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- 转存表中的数据 `ws_father_module`
--

INSERT INTO `ws_father_module` (`id`, `module_name`, `sort`) VALUES
(87, 'CBA', 12),
(91, 'NBL', 45),
(92, 'CUBA', 71),
(93, 'WCBA', 93),
(81, 'NBA', 55);

-- --------------------------------------------------------

--
-- 表的结构 `ws_info`
--

CREATE TABLE IF NOT EXISTS `ws_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标识符',
  `index_title` varchar(50) NOT NULL COMMENT '主页标题',
  `keywords` varchar(50) NOT NULL COMMENT '关键词',
  `description` varchar(250) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ws_info`
--

INSERT INTO `ws_info` (`id`, `index_title`, `keywords`, `description`) VALUES
(1, '体育吧', '体育，体育吧，NBA等。', '体育吧是一个收集体育方面的各种信息的交流论坛。');

-- --------------------------------------------------------

--
-- 表的结构 `ws_manage`
--

CREATE TABLE IF NOT EXISTS `ws_manage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标识符',
  `name` varchar(20) NOT NULL COMMENT '管理员名称',
  `psw` varchar(32) NOT NULL COMMENT '管理员密码',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `level` tinyint(4) NOT NULL COMMENT '管理员等级',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- 转存表中的数据 `ws_manage`
--

INSERT INTO `ws_manage` (`id`, `name`, `psw`, `create_time`, `level`) VALUES
(12, '王五', 'e10adc3949ba59abbe56e057f20f883e', '2016-05-18 22:37:35', 0),
(11, '李四', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-05-18 12:25:58', 1),
(10, '张三', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '2016-05-18 12:20:50', 0);

-- --------------------------------------------------------

--
-- 表的结构 `ws_member`
--

CREATE TABLE IF NOT EXISTS `ws_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一id',
  `user` varchar(20) NOT NULL COMMENT '用户名',
  `pwd` varchar(40) NOT NULL COMMENT '密码',
  `sex` varchar(2) NOT NULL COMMENT '性别',
  `email` varchar(20) NOT NULL COMMENT '邮箱',
  `qq` varchar(11) NOT NULL COMMENT 'qq',
  `photo` varchar(255) NOT NULL COMMENT '头像',
  `register_time` datetime NOT NULL COMMENT '注册时间',
  `last_time` datetime NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `ws_member`
--

INSERT INTO `ws_member` (`id`, `user`, `pwd`, `sex`, `email`, `qq`, `photo`, `register_time`, `last_time`) VALUES
(5, 'printingchen', '83422503bcfc01d303030e8a7cc80efc', '男', '2663251638@qq.com', '2584480035', '', '2016-04-06 08:29:29', '2016-05-22 16:26:56'),
(6, '陈印棠', '85aa188ff7b6d0016ae06961a3fd8a20', '男', '1076023927@qq.com', '2584480037', '', '2016-04-06 08:33:07', '2016-05-22 16:26:56'),
(14, 'admin', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', 'uploads/2016/05/18/170143573c766eefd9e561931810.jpg', '2016-04-06 19:43:23', '2016-05-23 16:37:53'),
(15, 'admin1', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 19:43:59', '2016-05-22 16:26:56'),
(16, 'admin3', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 19:45:20', '2016-05-22 16:26:56'),
(17, 'admin6', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '女', '2584480035@qq.com', '2584480037', '', '2016-04-06 19:46:55', '2016-05-22 16:26:56'),
(18, 'admin7', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 19:48:53', '2016-05-22 16:26:56'),
(19, 'admin9', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1076023927@qq.com', '2584480035', '', '2016-04-06 19:52:22', '2016-05-22 16:26:56'),
(20, 'admin11', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 19:52:59', '2016-05-22 16:26:56'),
(21, 'admin12', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480035', '', '2016-04-06 19:53:52', '2016-05-22 16:26:56'),
(22, 'admin13', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 19:55:06', '2016-05-22 16:26:56'),
(23, 'admin15', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 20:02:08', '2016-05-22 16:26:56'),
(24, '陈印棠1', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480035', '', '2016-04-06 20:07:28', '2016-05-22 16:26:56'),
(25, '陈印棠2', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480035', '', '2016-04-06 20:17:51', '2016-05-22 16:26:56'),
(26, 'admin96', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', '', '2016-04-06 20:24:26', '2016-05-22 16:26:56'),
(27, '10001132546', '86c6c389eb773b047034392adb8437ac', '女', '2584480035@qq.com', '2584480037', '', '2016-04-06 20:32:21', '2016-05-22 16:26:56'),
(28, '10001897465', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1076023927@qq.com', '2584480037', '', '2016-04-06 20:44:19', '2016-05-22 16:26:56'),
(29, 'admin100', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '女', '2584480035@qq.com', '2584480037', '', '2016-04-06 22:29:06', '2016-05-22 16:26:56'),
(30, '陈印棠19', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480037', 'img', '2016-04-10 13:40:07', '2016-05-22 16:26:56'),
(31, 'chenyintangprinting', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '121654564', '', '2016-04-12 10:21:10', '2016-05-22 16:26:56'),
(32, 'zhiboba', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2663251638@qq.com', '121654564', '', '2016-04-12 15:33:17', '2016-05-22 16:26:56'),
(33, '王泽奇', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2663251638@qq.com', '121654564', 'uploads/2016/05/21/816260573fcf7d45b16818162760.jpg', '2016-04-12 15:38:02', '2016-05-22 16:26:56'),
(34, '姚明', '8657e143b31e69d2151a881faa7be0c4', '男', '2663251638@qq.com', '18698444758', '', '2016-04-26 08:46:23', '2016-05-22 16:26:56'),
(35, 'print', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1236549@qq.com', '2584480035', '', '2016-05-08 14:54:51', '2016-05-22 16:26:56'),
(36, 'chyt', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1076023927@qq.com', '213456897', '', '2016-05-13 09:16:44', '2016-05-22 16:26:56'),
(37, 'admin16', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1076023927@qq.com', '2584480037', '', '2016-05-13 12:33:25', '2016-05-22 16:26:56'),
(38, '科比', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1076023927@qq.com', '2584480037', 'uploads/2016/05/15/3685585738960ddbf80351639198.jpg', '2016-05-14 09:16:41', '2016-05-22 16:39:51'),
(39, '习大大', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '2584480035@qq.com', '2584480035', '', '2016-05-21 16:09:20', '2016-05-22 16:26:56'),
(40, '麦迪', '49dec5fb8af4eeef7c95e7f5c66c8ae6', '男', '1076023927@qq.com', '3140642362', '', '2016-05-22 16:41:27', '2016-05-22 16:42:21');

-- --------------------------------------------------------

--
-- 表的结构 `ws_reply`
--

CREATE TABLE IF NOT EXISTS `ws_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一标识符',
  `content_id` int(10) unsigned NOT NULL COMMENT '帖子id',
  `quote_id` int(10) unsigned NOT NULL COMMENT '引用回复id',
  `content` text NOT NULL COMMENT '回复内容',
  `member_id` int(10) unsigned NOT NULL COMMENT '回复者id',
  `time` datetime NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- 转存表中的数据 `ws_reply`
--

INSERT INTO `ws_reply` (`id`, `content_id`, `quote_id`, `content`, `member_id`, `time`) VALUES
(1, 34, 0, 'fdgfd&nbsp;', 14, '2016-05-10 16:06:54'),
(2, 34, 0, '发动反攻', 14, '2016-05-10 16:24:20'),
(3, 30, 0, '发动反攻', 14, '2016-05-10 16:26:24'),
(4, 35, 0, '人的个人风格', 14, '2016-05-10 16:27:22'),
(5, 34, 0, 'sdsdfsdfsd', 14, '2016-05-10 16:44:20'),
(6, 12, 0, 'ffggf&nbsp;', 14, '2016-05-10 16:47:00'),
(7, 10, 0, 'fdgfhfhhgfhgf', 14, '2016-05-10 16:53:43'),
(8, 10, 0, 'trrrfgrggffgfg', 14, '2016-05-10 16:57:17'),
(9, 10, 0, '和那后啊是对方的事&nbsp;<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/29.gif" border="0" alt="" />', 14, '2016-05-10 16:58:42'),
(10, 19, 0, '王子鄂情说的开发商看到了减肥深刻的减肥了', 14, '2016-05-10 17:00:24'),
(11, 23, 0, '方法奋斗过的', 14, '2016-05-10 17:05:35'),
(12, 23, 0, '韩国官方和官方回复共和国', 14, '2016-05-10 17:05:54'),
(13, 27, 0, '的非官方的股份', 14, '2016-05-10 17:07:53'),
(14, 3, 0, '发放给', 14, '2016-05-10 17:08:43'),
(15, 3, 0, '的非官方的好风光好风光好风光好风光好', 14, '2016-05-10 17:08:55'),
(16, 3, 0, '要命的是法律开时代是东方就是抵抗力<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/29.gif" border="0" alt="" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/44.gif" border="0" alt="" />', 14, '2016-05-10 17:12:56'),
(17, 3, 0, '<p>\r\n	dsfdsfsdfsd发\r\n</p>\r\n<p>\r\n	df地方的\r\n</p>\r\n<p>\r\n	fdsf都是\r\n</p>\r\n<p>\r\n	<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/20.gif" border="0" alt="" />\r\n</p>', 14, '2016-05-10 17:21:45'),
(18, 30, 0, '热太热太过分打工非官方的<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/10.gif" border="0" alt="" />', 14, '2016-05-10 17:24:16'),
(19, 20, 0, 'fgffdfffdfdgfds的非官方的过h', 14, '2016-05-10 17:47:44'),
(20, 20, 0, '风格的发生挂号费的规定发给复合肥', 14, '2016-05-10 17:47:55'),
(21, 20, 0, '都是发的是给对方更多放电饭锅的风格大法官地方', 14, '2016-05-10 17:53:03'),
(22, 20, 0, '的风格的非官方的股份打工', 14, '2016-05-10 17:53:11'),
(23, 34, 0, '<span>周鸿祎</span><span>周鸿祎</span><span>周鸿祎</span>周鸿祎周鸿祎<span>周鸿祎</span><span>周鸿祎</span><span>周鸿祎</span><span>周鸿祎</span>', 14, '2016-05-10 17:56:44'),
(24, 11, 0, '的风格的非官方的规定风格', 14, '2016-05-10 21:28:27'),
(25, 11, 0, '的事发生大幅啥地方', 14, '2016-05-10 21:28:35'),
(26, 11, 0, '的说法大使馆的非官方的股份打工', 14, '2016-05-10 21:28:47'),
(27, 11, 0, '是大V反对股份', 14, '2016-05-10 21:36:04'),
(28, 11, 0, '让对方梵蒂冈好好干', 14, '2016-05-10 21:36:17'),
(29, 39, 0, 'gffdgdfgfdg', 14, '2016-05-12 21:48:38'),
(30, 27, 0, '<p>\r\n	weaoiserfodskjfklsdjflk;sadjfksdjf\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', 14, '2016-05-12 22:02:17'),
(31, 35, 0, 'ggfdgdfgfdgfd', 14, '2016-05-12 22:05:28'),
(32, 35, 0, 'sdfdsfdsfdsgfdghgfhfghfg', 14, '2016-05-12 22:05:34'),
(33, 35, 0, 'dfsgdg反对股份打工反对股份打工发的给对方噶地方和规范回家', 14, '2016-05-12 22:05:42'),
(34, 21, 0, '的非官方的更好发挥就会感觉', 14, '2016-05-12 22:09:23'),
(35, 21, 0, '规范和规范会更好', 14, '2016-05-12 22:09:36'),
(36, 21, 0, '规范和法规和规范化法国货', 14, '2016-05-12 22:09:40'),
(37, 37, 0, '的非官方的股份官方的话就很快就会v婢女', 36, '2016-05-13 09:18:41'),
(38, 37, 0, '反对股份和规范很干净很干净', 36, '2016-05-13 09:18:57'),
(39, 37, 0, '规范和规范和规范和国家计划', 36, '2016-05-13 09:19:05'),
(40, 37, 0, '规划局和国家和国家规划', 36, '2016-05-13 09:19:15'),
(41, 28, 0, '梵蒂冈的股份的刚好符合规范就好', 36, '2016-05-13 09:34:17'),
(42, 30, 0, 'fjdsklfjsdlkflsdkfjlksdjflksd', 36, '2016-05-13 10:18:58'),
(43, 1, 0, 'fdbfdgfhfg', 36, '2016-05-13 11:02:14'),
(44, 36, 0, '看见楼上的房间肯定进口给大家快乐的方式空间啊放松的空间分 第三方圣诞节快乐分就开始打飞机卡洛斯的房间开了是的分开了电视剧看了都是离开家；吃的就是打开驴肝肺 凉快地方凉快交电费来看k', 36, '2016-05-13 11:40:47'),
(45, 7, 0, '梵蒂冈的非官方的规划', 36, '2016-05-13 11:54:30'),
(46, 41, 0, '反对股份的股份打工', 36, '2016-05-13 12:00:27'),
(47, 37, 0, '是对方的身份', 37, '2016-05-13 12:33:40'),
(48, 31, 0, '规范和规范化', 37, '2016-05-13 13:13:15'),
(49, 30, 18, '你说的观点我不赞同！！！', 37, '2016-05-13 13:54:46'),
(50, 39, 29, '就是不同意<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/38.gif" border="0" alt="" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/31.gif" border="0" alt="" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/24.gif" border="0" alt="" />', 37, '2016-05-13 13:56:20'),
(51, 39, 29, '说的发大水发大水给对方股份计划和高科技', 37, '2016-05-13 13:57:20'),
(52, 40, 0, '额外人和发动机的萨芬健康的萨芬健康浪费的时间考虑', 37, '2016-05-13 14:06:01'),
(53, 40, 52, '都是范德萨范德萨快疯了介绍的开了房间', 37, '2016-05-13 14:09:05'),
(54, 6, 0, '扔掉非官方的规划', 37, '2016-05-13 16:05:19'),
(55, 6, 0, '的非官方的施工方的三个风格', 37, '2016-05-13 16:08:00'),
(56, 6, 0, '反对股份大股东发挥共和国', 37, '2016-05-13 16:08:09'),
(57, 6, 55, '反对股份的更好发挥', 37, '2016-05-13 16:09:51'),
(58, 6, 54, '吃饭股份的规划好', 37, '2016-05-13 16:31:57'),
(59, 6, 58, '都是非法的', 37, '2016-05-13 16:35:19'),
(60, 6, 55, '我引用了2楼', 37, '2016-05-13 16:41:10'),
(61, 3, 14, '说的风格的股份的股份打工', 37, '2016-05-13 16:48:56'),
(62, 3, 61, '我引用了5楼', 37, '2016-05-13 16:53:55'),
(63, 30, 18, '<p>\r\n	我引用了2楼\r\n</p>\r\n<p>\r\n	<br />\r\n</p>', 37, '2016-05-13 17:02:04'),
(64, 16, 0, '我是一楼', 37, '2016-05-13 17:04:33'),
(65, 16, 64, '我引用了1楼', 37, '2016-05-13 17:04:46'),
(66, 16, 65, '我引用了2楼的回复', 37, '2016-05-13 17:06:51'),
(67, 18, 0, '反对股份的施工方的规划', 37, '2016-05-13 17:08:42'),
(68, 19, 10, '我是2楼，引用了1楼', 36, '2016-05-13 17:10:05'),
(69, 19, 0, '我赞同你的意见', 36, '2016-05-13 17:11:17'),
(70, 19, 69, '我不赞同你的意见<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/38.gif" border="0" alt="" />', 36, '2016-05-13 17:11:43'),
(71, 1, 43, '水电费水电费水电费的说法', 14, '2016-05-13 21:09:15'),
(72, 16, 0, '发的发方法更好', 14, '2016-05-13 21:27:29'),
(73, 25, 0, '是对方的身份的说法', 14, '2016-05-13 21:49:06'),
(74, 13, 0, '这是第一条回复', 14, '2016-05-13 22:53:12'),
(75, 33, 0, '的法国大使馆梵蒂冈', 14, '2016-05-13 22:55:41'),
(76, 3, 0, '是对方的身份是地方', 14, '2016-05-13 22:56:05'),
(77, 15, 0, '的方式反对股份打工', 14, '2016-05-13 22:56:39'),
(78, 27, 0, '今天是5月13号。。。<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/18.gif" border="0" alt="" />', 14, '2016-05-13 22:57:29'),
(79, 26, 0, '是对方受到广泛的很反感就好', 14, '2016-05-13 22:59:21'),
(80, 31, 0, '反反复复', 14, '2016-05-13 22:59:53'),
(81, 23, 0, '方法股份更丰富法规规范', 14, '2016-05-13 23:00:53'),
(82, 15, 0, '的方式股份', 14, '2016-05-13 23:01:16'),
(83, 19, 0, '的说法是地方', 14, '2016-05-13 23:04:54'),
(84, 28, 0, '从v不规范更好', 14, '2016-05-13 23:05:23'),
(85, 7, 0, '反对股份股份股份', 14, '2016-05-13 23:05:53'),
(86, 6, 0, '今天是周六，我回复了你的帖子', 38, '2016-05-14 09:17:39'),
(87, 28, 0, '今天是5月14号', 38, '2016-05-14 10:08:27'),
(88, 37, 47, '<span style="color:#003399;font-size:18px;"><strong>今天是五月十四号，我引用了五楼的回复。</strong></span><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/109.gif" border="0" alt="" />', 38, '2016-05-14 10:14:02'),
(89, 42, 0, '第一楼回复', 38, '2016-05-14 10:18:27'),
(90, 39, 0, '对双方都是非法打工', 38, '2016-05-14 10:19:20'),
(91, 17, 0, '个方法的股份的规划', 38, '2016-05-14 10:20:46'),
(92, 28, 0, '我是最后一个回复', 38, '2016-05-14 10:25:56'),
(93, 30, 49, '我也不赞同<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/10.gif" border="0" alt="" />', 38, '2016-05-14 10:58:38'),
(94, 3, 76, '赞同楼上的观点<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/20.gif" border="0" alt="" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/24.gif" border="0" alt="" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/19.gif" border="0" alt="" />', 38, '2016-05-14 11:02:23'),
(95, 31, 0, '是打发打发是豆腐干', 38, '2016-05-14 11:02:48'),
(96, 3, 0, '是打发打发水电费水电费双方的事', 38, '2016-05-14 11:04:27'),
(97, 42, 89, '<span style="color:#4C33E5;font-size:32px;">我是第二楼回复的</span>', 38, '2016-05-14 11:05:20'),
(98, 39, 51, '<span style="background-color:#FFE500;"><span style="color:#337FE5;"><strong><em>呵呵呵呵呵呵呵呵</em></strong></span><span style="color:#337FE5;"><strong><em></em></strong></span></span>', 38, '2016-05-14 11:07:25'),
(99, 38, 0, '反对股份打工', 38, '2016-05-14 11:09:48'),
(100, 38, 0, '法规规范的方法', 38, '2016-05-14 11:09:58'),
(101, 38, 0, '反对股份更丰富发个发广告', 38, '2016-05-14 11:10:04'),
(102, 38, 0, '是地方都是非法的啥地方', 38, '2016-05-14 11:10:14'),
(103, 42, 97, '发的方法会更好', 38, '2016-05-14 11:14:09'),
(104, 35, 33, '<em><span style="color:#60D978;font-size:18px;">我同意您的观点哦\r\n<table style="width:100%;" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<br />\r\n			</td>\r\n			<td>\r\n				<br />\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<br />\r\n<span id="__kindeditor_bookmark_end_19__"></span></span></em>', 38, '2016-05-14 12:54:25'),
(105, 43, 0, '当然会的了<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/13.gif" border="0" alt="" />', 38, '2016-05-14 12:57:26'),
(106, 27, 0, '我是科比', 38, '2016-05-14 16:16:58'),
(107, 35, 104, '你的风格我不喜欢', 38, '2016-05-14 16:42:46'),
(108, 19, 0, '空间的设计发动反击', 38, '2016-05-14 22:54:03'),
(109, 45, 0, '我是科比', 38, '2016-05-14 22:55:03'),
(110, 6, 0, '和地方很多顺丰到付都很反感', 38, '2016-05-14 23:34:17'),
(111, 41, 46, '让他好好广告费', 38, '2016-05-14 23:51:01'),
(112, 41, 0, '法规规范发的发共和国', 38, '2016-05-14 23:59:42'),
(113, 2, 0, '俗称邓呆呆 啊哈哈哈哈<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/13.gif" border="0" alt="" />', 38, '2016-05-15 00:01:55'),
(114, 35, 107, '<span style="color:#00D5FF;background-color:#009900;"><span style="color:#99BB00;font-size:16px;background-color:#FFFFFF;"><strong><em>其实我也不喜欢的</em></strong></span><span style="color:#99BB00;font-size:16px;background-color:#FFFFFF;"><strong><em><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/34.gif" border="0" alt="" /></em></strong></span></span>', 38, '2016-05-15 00:04:52'),
(115, 46, 0, '我知道很强<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/44.gif" alt="" border="0" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/22.gif" alt="" border="0" /><img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/20.gif" alt="" border="0" />', 29, '2016-05-15 09:33:42'),
(116, 28, 92, '今天是五月十五号<img src="http://localhost/web/webshare/kindeditor/plugins/emoticons/images/10.gif" alt="" border="0" />', 29, '2016-05-15 11:01:53'),
(117, 26, 0, '<ul>\r\n	<li>\r\n		<a target="_blank" href="http://www.baidu.com">北京大学是一个美丽的地方</a>\r\n	</li>\r\n</ul>', 29, '2016-05-15 11:04:31'),
(118, 57, 0, '规范的风格', 29, '2016-05-15 13:26:58'),
(119, 15, 82, '呵呵呵呵', 29, '2016-05-15 13:31:48'),
(120, 14, 0, '有统计人数太多就能获得过', 29, '2016-05-15 13:32:24'),
(121, 38, 0, '额头个人风格和', 29, '2016-05-15 13:32:42'),
(122, 29, 0, '乔丹是北卡的荣耀', 14, '2016-05-15 16:31:26'),
(123, 45, 0, '我是科比', 1, '2016-05-18 22:43:27'),
(124, 62, 0, '呵呵呵呵呵呵呵大', 38, '2016-05-18 22:52:12'),
(125, 62, 124, '让人非官方广告费', 38, '2016-05-18 22:52:21'),
(126, 6, 0, '<span>star</span><span>star</span><span>star</span><span>star</span><span>star</span>star<span>star</span>star<span>star</span>starstar<span>star</span>star<span>star</span>star<span>star</span><span>star</span>starstarstar<span>star</span><span>star</span>starstar<span>star</span>star<span>star</span>starstar<span>star</span>', 38, '2016-05-20 20:44:19'),
(127, 20, 22, '<p>\r\n	周杰伦你好！！！\r\n</p>\r\n<p>\r\n	周杰伦你好！！！\r\n</p>\r\n<p>\r\n	周杰伦你好！！！<img border="0" alt="" src="kindeditor/plugins/emoticons/images/13.gif" />\r\n</p>\r\n<p>\r\n	&nbsp;\r\n</p>', 33, '2016-05-21 11:02:56'),
(128, 77, 0, '王泽奇是北大男篮的队长。。。', 14, '2016-05-21 14:25:44'),
(129, 44, 0, '呵呵呵呵，科比。。。', 14, '2016-05-21 14:46:21'),
(130, 79, 0, '反对股份大股东风格的风格', 14, '2016-05-23 16:52:32');

-- --------------------------------------------------------

--
-- 表的结构 `ws_son_module`
--

CREATE TABLE IF NOT EXISTS `ws_son_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '唯一id标识符',
  `father_module_id` int(10) unsigned NOT NULL COMMENT '所属父版块id',
  `module_name` varchar(50) NOT NULL COMMENT '子版块名称',
  `info` varchar(255) NOT NULL COMMENT '描述信息',
  `member_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是否为版主id',
  `sort` int(11) unsigned NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- 转存表中的数据 `ws_son_module`
--

INSERT INTO `ws_son_module` (`id`, `father_module_id`, `module_name`, `info`, `member_id`, `sort`) VALUES
(8, 81, '马刺', '马刺队是一个西部传统的强队', 6, 39),
(15, 87, '上海玛吉斯', '上海玛吉斯(Shanghai Sharks)坐落城市：上海球馆：源深体育中心吉祥物:鲨鱼。', 0, 6),
(23, 87, '北京金隅', '北京金隅(Beijing Ducks)坐落城市：北京球馆：首钢体育馆;万事达中心（五棵松）吉祥物:鸭。', 0, 1),
(24, 81, '开拓者', '', 0, 2),
(25, 87, '辽宁衡业', '辽宁衡业(Liaoning Flying Leopards)坐落城市：本溪球馆：本溪市体育馆吉祥物:豹。', 0, 0),
(26, 87, '福建泉州银行', '福建泉州银行(Fujian Sturgeons)坐落城市：晋江球馆：祖昌体育馆吉祥物:鲟', 0, 89),
(27, 87, '山西汾酒集团', '山西汾酒集团(Shanxi Dragons)坐落城市：太原球馆：滨河体育中心吉祥物:龙。', 0, 10),
(29, 87, '浙江广厦', '浙江广厦(Zhejiang Lions)坐落城市：杭州球馆：杭州体育馆吉祥物:狮。', 6, 2),
(30, 91, '重庆翱龙', '重庆翱龙篮球俱乐部，重庆翱龙篮球队的人员构成建立在2012年NBL亚军广州自由人队的基础上', 0, 3),
(31, 92, '北京大学', '北京大学北京大学北京大学北京大学', 5, 45),
(32, 81, '勇士', '库里', 0, 59),
(33, 93, '江苏永联女篮', '江苏五台山女子篮球俱乐部是由是由江苏省五台山体育中心、江苏省体育局训练中心、江苏省金地体育发展有限公司斥资组建，由江苏省五台山体育中心独家运营的职业篮球俱乐部。', 0, 0),
(34, 92, '南京大学', '南京大学，简称南大，是一所源远流长的高等学府。', 0, 4),
(35, 92, '西安交通大学', '西安交通大学（Xi`an Jiaotong University）简称“西安交大”，位于古都西安，是国家“七五 ”、“八五”首批重点建设高校，是全国重点综合性研究型大学', 0, 0),
(39, 93, '广东东莞松山湖女篮', '广东东莞日报女篮将正式更名为广东东莞松山湖女子篮球队, 球队简称为:广东松山湖队。', 0, 0),
(38, 93, '北京金隅长城女篮', '北京金隅长城女篮位练习场所于宣武区先农坛街首钢篮球中心，由北京金隅集团赞助。', 0, 0),
(40, 91, '江苏同曦', '江苏同曦篮球俱乐部成立于2007年10月，由南京同曦投资发展有限责任公司独资组建。', 0, 5),
(41, 91, '广西威壮', '广西威壮篮球俱乐部成立于2013年4月13日，由广西威壮集团创建。', 0, 66),
(42, 81, '雷霆', '双少鹤壁，勇夺冠军', 38, 89);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
