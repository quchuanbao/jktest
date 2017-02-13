/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50027
Source Host           : localhost:3306
Source Database       : jksoft

Target Server Type    : MYSQL
Target Server Version : 50027
File Encoding         : 65001

Date: 2015-10-09 00:04:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for courseorder
-- ----------------------------
DROP TABLE IF EXISTS `courseorder`;
CREATE TABLE `courseorder` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `userId` int(11) unsigned default NULL COMMENT '用户ID',
  `employeeId` int(11) unsigned default NULL COMMENT '教练ID',
  `startDate` date default NULL COMMENT '课程日期',
  `startTime` varchar(255) default NULL COMMENT '开始时间',
  `endTime` varchar(255) default NULL COMMENT '结束日期',
  `status` tinyint(1) unsigned default NULL COMMENT '1未确认，2确认成功，3确认失败',
  `type` tinyint(1) unsigned default NULL COMMENT '1学员发起，2教练发起',
  `cdate` datetime default NULL COMMENT '创建日期',
  PRIMARY KEY  (`id`),
  KEY `userId` (`userId`),
  KEY `employeeI` (`employeeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='课程表';

-- ----------------------------
-- Records of courseorder
-- ----------------------------
INSERT INTO `courseorder` VALUES ('1', '14', '1', '2014-09-01', '06:30', '10:30', '1', null, null);
INSERT INTO `courseorder` VALUES ('6', '19', '17', '2015-10-09', '10:00', '11:00', '1', '1', '2015-10-08 23:42:34');
INSERT INTO `courseorder` VALUES ('7', '19', '17', '2015-10-09', '10:00', '12:00', '1', '1', '2015-10-08 23:44:15');
INSERT INTO `courseorder` VALUES ('8', '19', '17', '2015-10-09', '09:00', '09:30', '1', '1', '2015-10-08 23:48:09');
