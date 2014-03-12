/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50532
Source Host           : localhost:3306
Source Database       : chi

Target Server Type    : MYSQL
Target Server Version : 50532
File Encoding         : 65001

Date: 2013-10-29 20:13:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `address`
-- ----------------------------
DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `phone` varchar(16) COLLATE utf8_bin NOT NULL,
  `address` varchar(256) COLLATE utf8_bin NOT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `f3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `f4` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of address
-- ----------------------------
INSERT INTO `address` VALUES ('1', '---', '18940900000', '大连海事大学E1', null, null, null, null);
INSERT INTO `address` VALUES ('2', '---', '186880000004', '深圳宝安区湾仔码头1号1001号仓库', null, null, null, null);
INSERT INTO `address` VALUES ('3', '大螃蟹', '13480000375', '浙江省余姚市舜水北路169号2-202', null, null, null, null);

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shopId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `consumerId` int(11) NOT NULL,
  `comment` varchar(2048) COLLATE utf8_bin NOT NULL,
  `time` datetime NOT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `f3` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `f4` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('1', '1', '1', '1', '挺好的', '2013-10-29 20:12:30', null, null, null, null);

-- ----------------------------
-- Table structure for `consumer`
-- ----------------------------
DROP TABLE IF EXISTS `consumer`;
CREATE TABLE `consumer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `score` int(10) NOT NULL,
  `addressId` varchar(128) NOT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `f3` varchar(255) DEFAULT NULL,
  `f4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of consumer
-- ----------------------------
INSERT INTO `consumer` VALUES ('1', 'vurgoe', '0', '1,3', null, null, null, null);
INSERT INTO `consumer` VALUES ('2', 'bojoy', '0', '2', null, null, null, null);

-- ----------------------------
-- Table structure for `dish`
-- ----------------------------
DROP TABLE IF EXISTS `dish`;
CREATE TABLE `dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL,
  `shopId` int(11) NOT NULL,
  `summary` varchar(1024) NOT NULL,
  `price` int(6) NOT NULL,
  `weight` int(6) NOT NULL,
  `quantity` int(6) NOT NULL,
  `discount` int(2) NOT NULL,
  `style` varchar(20) NOT NULL,
  `sales` int(10) NOT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `f3` varchar(255) DEFAULT NULL,
  `f4` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dish
-- ----------------------------
INSERT INTO `dish` VALUES ('1', '东坡肉', 'dpr.png', '1', '又是东坡肉，你叫我怎么减肥？！', '5', '250', '50', '100', '浙菜', '0', null, null, null, null);
INSERT INTO `dish` VALUES ('2', '西湖醋鱼', 'xhcy.png', '1', '就没吃过好吃的', '10', '350', '10', '90', '浙菜', '0', null, null, null, null);
INSERT INTO `dish` VALUES ('3', '毛血旺', 'mxw.png', '2', '辣不辣，不怕辣', '5', '300', '-1', '100', '川菜', '0', null, null, null, null);

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumerId` int(11) DEFAULT NULL,
  `shopId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `dishes` varchar(256) NOT NULL,
  `payment` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `startAt` time NOT NULL,
  `endAt` time DEFAULT NULL,
  `date` date NOT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `f3` varchar(512) DEFAULT NULL,
  `f4` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '1', '1', '1', '1,1', '1', '4', '18:08:50', '18:30:36', '2013-10-29', null, null, null, null);
INSERT INTO `order` VALUES ('2', '2', '1', '2', '1,2,2,3', '0', '0', '19:00:00', null, '2013-10-29', null, null, null, null);

-- ----------------------------
-- Table structure for `shop`
-- ----------------------------
DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `address` varchar(256) NOT NULL,
  `location` varchar(128) NOT NULL,
  `sumary` varchar(4096) NOT NULL,
  `longitude` double(8,0) NOT NULL,
  `latitude` double(8,0) NOT NULL,
  `score` int(2) NOT NULL,
  `discount` int(2) NOT NULL,
  `style` varchar(20) NOT NULL,
  `sales` int(10) NOT NULL,
  `payment` int(8) NOT NULL,
  `shipping` varchar(128) NOT NULL,
  `spread` int(8) NOT NULL,
  `balance` int(8) NOT NULL,
  `status` int(1) NOT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `f3` varchar(512) DEFAULT NULL,
  `f4` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop
-- ----------------------------
INSERT INTO `shop` VALUES ('1', '楼外楼', '杭州西湖', 'lwl.png', '楼外青山楼外楼', '120', '30', '0', '100', '浙菜', '0', '3', '0,0,0,5,1.9,10,-1', '100', '1050', '0', null, null, null, null);
INSERT INTO `shop` VALUES ('2', '重庆鸡公煲', '不在重庆', 'cq.png', '这是家奇葩店', '-120', '30', '0', '100', '川菜', '0', '1', '-1', '0', '50', '1', null, null, null, null);
