/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : haotaitai2

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-03-14 16:24:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_prize
-- ----------------------------
DROP TABLE IF EXISTS `admin_prize`;
CREATE TABLE `admin_prize` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `group` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1:上市好礼，2:上市红利,3:代金券',
  `pro` decimal(10,2) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `mld` int(10) DEFAULT NULL,
  `dl` int(10) DEFAULT NULL,
  `add_time` timestamp NULL DEFAULT NULL,
  `tl` int(10) DEFAULT '0' COMMENT '值上限',
  `ml` int(10) DEFAULT '0' COMMENT '值下限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of admin_prize
-- ----------------------------
INSERT INTO `admin_prize` VALUES ('00000000004', '好太太智能晾衣机GW-1583', '1', '0.00', '18', '0', '0', '2017-11-24 18:05:13', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000005', '好太太智能晾衣机GW-5823', '1', '0.00', '28', '1', '0', '2017-11-24 18:05:46', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000006', '智能垃圾桶 GL-H001D 熊猫图案', '1', '0.00', '58', '1', '0', '2017-11-24 18:13:35', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000007', '炫彩简约衣架I琥珀色（16个）', '1', '0.00', '88', '1', '0', '2017-11-24 18:14:10', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000008', '好太太抱枕', '1', '30.00', '2000', '1', '0', '2017-11-24 18:14:22', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000009', '好太太安迪人偶', '1', '30.00', '2350', '1', '0', '2017-11-24 18:14:37', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000010', '好太太100代金券', '3', '50.00', '2147483647', '10000', '2147483647', '2017-11-24 18:15:11', '0', '0');
INSERT INTO `admin_prize` VALUES ('00000000011', '好太太积分', '2', '100.00', '999999999', '1', '999999999', '2017-11-24 18:15:26', '1000', '10');
INSERT INTO `admin_prize` VALUES ('00000000012', '好太太红包', '4', '10.00', '100', '1', '10', '2018-03-14 15:56:03', '5', '3');
