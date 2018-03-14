/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : haotaitai2

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-03-14 16:24:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_system
-- ----------------------------
DROP TABLE IF EXISTS `admin_system`;
CREATE TABLE `admin_system` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `begin_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `end_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notice` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agree` text COLLATE utf8_unicode_ci NOT NULL,
  `game_one` int(11) NOT NULL DEFAULT '0' COMMENT '游戏第一关获得积分',
  `game_two` int(11) NOT NULL DEFAULT '0' COMMENT '游戏第二关获得积分',
  `game_three` int(11) NOT NULL DEFAULT '0' COMMENT '游戏第三关获得积分',
  `game_award` int(11) NOT NULL DEFAULT '1' COMMENT '游戏过三关抽奖次数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_system
-- ----------------------------
INSERT INTO `admin_system` VALUES ('1', '2018-03-15', '2018-05-06', '严禁外挂刷分与作弊！！！', '&lt;p&gt;1.遵守好太太集团活动协议&lt;/p&gt;', '10', '30', '50', '2');
