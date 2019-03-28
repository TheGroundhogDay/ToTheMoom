/*
Navicat MySQL Data Transfer

Source Server         : kim
Source Server Version : 50556
Source Host           : kim.srok.cn:3306
Source Database       : kim

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2018-08-09 14:49:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES ('1', 'kim', '5de58b4a35713dd86a44a8a9e2e1ada1');

-- ----------------------------
-- Table structure for tp_bg
-- ----------------------------
DROP TABLE IF EXISTS `tp_bg`;
CREATE TABLE `tp_bg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_bg
-- ----------------------------
INSERT INTO `tp_bg` VALUES ('1', '5', '/upload/15332775433253.jpg', '/upload/15332775433253_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('2', '5', '/upload/15332780791972.jpg', '/upload/15332780791972_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('3', '5', '/upload/15332788366333.jpg', '/upload/15332788366333_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('4', '5', '/upload/15332788366999.jpg', '/upload/15332788366999_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('5', '5', '/upload/15332788378315.jpg', '/upload/15332788378315_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('6', '5', '/upload/15332788374657.jpg', '/upload/15332788374657_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('7', '5', '/upload/15332788378552.jpg', '/upload/15332788378552_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('8', '5', '/upload/15332788377110.jpeg', '/upload/15332788377110_min.jpeg', '拿枪');
INSERT INTO `tp_bg` VALUES ('9', '5', '/upload/15332788371979.jpg', '/upload/15332788371979_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('10', '5', '/upload/15332788374962.jpg', '/upload/15332788374962_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('11', '5', '/upload/15332788387820.jpg', '/upload/15332788387820_min.jpg', '艾玛');
INSERT INTO `tp_bg` VALUES ('22', '1', '/upload/15336904327219.jpeg', '/upload/15336904327219_min.jpeg', '无');

-- ----------------------------
-- Table structure for tp_bg_c
-- ----------------------------
DROP TABLE IF EXISTS `tp_bg_c`;
CREATE TABLE `tp_bg_c` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_bg_c
-- ----------------------------
INSERT INTO `tp_bg_c` VALUES ('1', '动态');
INSERT INTO `tp_bg_c` VALUES ('2', '风景');
INSERT INTO `tp_bg_c` VALUES ('3', '素雅');
INSERT INTO `tp_bg_c` VALUES ('4', '唯美');
INSERT INTO `tp_bg_c` VALUES ('5', '纯色');

-- ----------------------------
-- Table structure for tp_qian
-- ----------------------------
DROP TABLE IF EXISTS `tp_qian`;
CREATE TABLE `tp_qian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_qian
-- ----------------------------
INSERT INTO `tp_qian` VALUES ('2', '3', '2018-08-08 00:00:00');
INSERT INTO `tp_qian` VALUES ('3', '4', '2018-08-08 00:00:00');
INSERT INTO `tp_qian` VALUES ('4', '5', '2018-08-08 00:00:00');
INSERT INTO `tp_qian` VALUES ('5', '5', '2018-08-09 00:00:00');
INSERT INTO `tp_qian` VALUES ('6', '4', '2018-08-09 00:00:00');
INSERT INTO `tp_qian` VALUES ('7', '6', '2018-08-09 00:00:00');

-- ----------------------------
-- Table structure for tp_user
-- ----------------------------
DROP TABLE IF EXISTS `tp_user`;
CREATE TABLE `tp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `jf` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_user
-- ----------------------------
INSERT INTO `tp_user` VALUES ('3', 'lisi2', '14e1b600b1fd579f47433b88e8d85291', '30');
INSERT INTO `tp_user` VALUES ('4', 'zhangsan', '14e1b600b1fd579f47433b88e8d85291', '30');
INSERT INTO `tp_user` VALUES ('5', '老水手', '09cfbc7dffb6ee9f1fe863fdf40accfe', '30');
INSERT INTO `tp_user` VALUES ('6', '水手', '09cfbc7dffb6ee9f1fe863fdf40accfe', '15');

-- ----------------------------
-- Table structure for tp_wang
-- ----------------------------
DROP TABLE IF EXISTS `tp_wang`;
CREATE TABLE `tp_wang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_wang
-- ----------------------------
INSERT INTO `tp_wang` VALUES ('1', '6', '虎扑体育', 'http://www.hoopchina.com', '/Public/upload/20180806/5b67e5c75ee0f.png');
INSERT INTO `tp_wang` VALUES ('3', '11', '微博', 'http://weibo.com', '/Public/upload/20180806/5b681302a11cf.png');

-- ----------------------------
-- Table structure for tp_wang_dh
-- ----------------------------
DROP TABLE IF EXISTS `tp_wang_dh`;
CREATE TABLE `tp_wang_dh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `wang` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_wang_dh
-- ----------------------------
INSERT INTO `tp_wang_dh` VALUES ('1', '常用', '1');
INSERT INTO `tp_wang_dh` VALUES ('8', '生活', '1');
INSERT INTO `tp_wang_dh` VALUES ('2', '男生', '1');
INSERT INTO `tp_wang_dh` VALUES ('3', '女生', '1');
INSERT INTO `tp_wang_dh` VALUES ('4', '常用', '2');
INSERT INTO `tp_wang_dh` VALUES ('5', '知识', '2');
INSERT INTO `tp_wang_dh` VALUES ('6', '商业', '2');
INSERT INTO `tp_wang_dh` VALUES ('9', '产品', '1');
INSERT INTO `tp_wang_dh` VALUES ('10', '设计', '1');
INSERT INTO `tp_wang_dh` VALUES ('11', '职能', '1');
INSERT INTO `tp_wang_dh` VALUES ('12', '运营', '1');
INSERT INTO `tp_wang_dh` VALUES ('13', 'kkk', '2');

-- ----------------------------
-- Table structure for tp_wang_zl
-- ----------------------------
DROP TABLE IF EXISTS `tp_wang_zl`;
CREATE TABLE `tp_wang_zl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tp_wang_zl
-- ----------------------------
INSERT INTO `tp_wang_zl` VALUES ('1', '3', '减肥');
INSERT INTO `tp_wang_zl` VALUES ('2', '3', '美容');
INSERT INTO `tp_wang_zl` VALUES ('3', '3', '星座');
INSERT INTO `tp_wang_zl` VALUES ('5', '3', '奢侈品');
INSERT INTO `tp_wang_zl` VALUES ('6', '2', '足球');
INSERT INTO `tp_wang_zl` VALUES ('7', '2', '篮球');
INSERT INTO `tp_wang_zl` VALUES ('8', '2', '军事');
INSERT INTO `tp_wang_zl` VALUES ('9', '2', '数码');
INSERT INTO `tp_wang_zl` VALUES ('10', '5', '公开课');
INSERT INTO `tp_wang_zl` VALUES ('11', '1', '热门');
INSERT INTO `tp_wang_zl` VALUES ('12', '1', '资讯');
INSERT INTO `tp_wang_zl` VALUES ('13', '1', '影音');
INSERT INTO `tp_wang_zl` VALUES ('14', '1', '邮箱');
INSERT INTO `tp_wang_zl` VALUES ('15', '4', '外热');
INSERT INTO `tp_wang_zl` VALUES ('16', '4', '社区');
INSERT INTO `tp_wang_zl` VALUES ('17', '5', 'lll');
INSERT INTO `tp_wang_zl` VALUES ('18', '13', '1111111111');
