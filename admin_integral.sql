/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : haotaitai2

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-03-14 10:55:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_integral
-- ----------------------------
DROP TABLE IF EXISTS `admin_integral`;
CREATE TABLE `admin_integral` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `status` tinyint(10) NOT NULL DEFAULT '0',
  `open_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `addres` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logistics` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '物流单号',
  `IP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `add_time` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_integral
-- ----------------------------
