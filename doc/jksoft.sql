-- MySQL dump 10.14  Distrib 5.5.41-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: jksoft
-- ------------------------------------------------------
-- Server version	5.5.41-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `userName` varchar(255) DEFAULT NULL COMMENT '登录名',
  `password` varchar(255) DEFAULT NULL COMMENT '密码',
  `realName` varchar(255) DEFAULT NULL COMMENT '真实姓名',
  `loginDate` datetime DEFAULT NULL COMMENT '登陆时间',
  `loginIp` varchar(255) DEFAULT NULL COMMENT '登陆IP',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1有效，2冻结',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='管理员';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','管理员','2015-09-25 17:30:56','114.250.106.148',1),(4,'test','e10adc3949ba59abbe56e057f20f883e','三蛋','2015-03-02 11:38:45','106.2.204.110',2);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '员工ID',
  `startDate` datetime DEFAULT NULL COMMENT '上班日期',
  `endDate` datetime DEFAULT NULL COMMENT '下班日期',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='考勤表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaint` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `userId` int(11) unsigned DEFAULT '0' COMMENT '会员ID',
  `content` varchar(255) DEFAULT NULL COMMENT '投诉内容',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  `deparentId` int(5) unsigned DEFAULT '0' COMMENT '所属部门ID',
  `status` tinyint(1) unsigned DEFAULT '1' COMMENT '1处理中，2处理完成，3无效投诉',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '创建员工ID',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `employeeId` (`employeeId`),
  KEY `deparentId` (`deparentId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT=' 投诉表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaint`
--

LOCK TABLES `complaint` WRITE;
/*!40000 ALTER TABLE `complaint` DISABLE KEYS */;
INSERT INTO `complaint` VALUES (1,1,'aadsfasdf','2015-08-30 05:19:47',1,2,1);
/*!40000 ALTER TABLE `complaint` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaintlog`
--

DROP TABLE IF EXISTS `complaintlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complaintlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `complaintId` int(11) unsigned DEFAULT '0' COMMENT '投诉ID',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '员工ID',
  `content` varchar(255) DEFAULT NULL COMMENT '处理意见',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`),
  KEY `complaintId` (`complaintId`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='投诉处理表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaintlog`
--

LOCK TABLES `complaintlog` WRITE;
/*!40000 ALTER TABLE `complaintlog` DISABLE KEYS */;
INSERT INTO `complaintlog` VALUES (1,1,1,'aaa','2015-08-30 22:31:04');
/*!40000 ALTER TABLE `complaintlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `employeeId` int(11) unsigned DEFAULT NULL COMMENT '教练ID',
  `startDate` date DEFAULT NULL COMMENT '课程日期',
  `startTime` varchar(255) DEFAULT NULL COMMENT '开始时间',
  `endTime` varchar(255) DEFAULT NULL COMMENT '结束日期',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '1未确认，2已确认',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `employeeI` (`employeeId`)
)  AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='课程表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
INSERT INTO `course` VALUES (1,14,1,'2015-09-23','11:24','14:24',1),(2,19,17,'2015-10-02','19:55','19:55',1),(3,19,17,'2015-10-02','18:06','21:06',1),(4,19,17,'2015-10-02','18:21','20:21',1),(5,19,17,'2015-10-02','18:23','21:23',1),(6,19,17,'2015-10-02','18:24','20:24',1),(7,19,17,'2015-10-02','21:30','23:30',1),(8,19,17,'2015-10-05','13:41','14:41',1);
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseaction`
--

DROP TABLE IF EXISTS `courseaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseaction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '动作名称',
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='课程动作表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseaction`
--

LOCK TABLES `courseaction` WRITE;
/*!40000 ALTER TABLE `courseaction` DISABLE KEYS */;
INSERT INTO `courseaction` VALUES (1,'跑'),(2,'跳'),(3,'蹲'),(4,'平板撑');
/*!40000 ALTER TABLE `courseaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursebuy`
--

DROP TABLE IF EXISTS `coursebuy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coursebuy` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `num` int(11) unsigned DEFAULT NULL COMMENT '课节数',
  `usenum` int(11) unsigned DEFAULT NULL COMMENT '使用次数',
  `price` decimal(10,2) unsigned DEFAULT NULL COMMENT '课程单价',
  `total` decimal(10,2) unsigned DEFAULT NULL COMMENT '课程总价',
  `paytype` tinyint(1) unsigned DEFAULT NULL COMMENT '1现金2信用卡3支票',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `employeeId` int(10) unsigned DEFAULT NULL COMMENT '提交人ID',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  `status` tinyint(1) unsigned DEFAULT NULL COMMENT '1待主管审核，2待财务审核，3购买成功，4驳回',
  `financeId` int(11) unsigned DEFAULT NULL COMMENT '财务ID',
  `manageId` int(10) unsigned DEFAULT NULL COMMENT '经理ID',
  `auditDate` datetime DEFAULT NULL COMMENT '审核日期',
  `auditRemark` varchar(255) DEFAULT NULL COMMENT '审核意见',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `financeId` (`financeId`),
  KEY `employeeId` (`employeeId`) ,
  KEY `manageId` (`manageId`)
)  AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='课程购买表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursebuy`
--

LOCK TABLES `coursebuy` WRITE;
/*!40000 ALTER TABLE `coursebuy` DISABLE KEYS */;
INSERT INTO `coursebuy` VALUES (1,14,30,NULL,100.00,3000.00,1,'购买',1,'2015-09-23 11:50:10',2,NULL,NULL,'2015-10-02 13:51:12','123'),(2,19,50,NULL,100.00,5000.00,2,'测试',17,'2015-10-02 18:26:31',2,NULL,NULL,'2015-10-02 18:41:46','通过'),(3,19,100,NULL,50.00,5000.00,1,'优惠',17,'2015-10-02 22:13:37',2,NULL,NULL,'2015-10-02 22:13:54','同意'),(4,19,100,NULL,1000.00,100000.00,1,'',17,'2015-10-05 13:42:05',2,NULL,NULL,'2015-10-05 13:42:43','');
/*!40000 ALTER TABLE `coursebuy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseclass`
--

DROP TABLE IF EXISTS `courseclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseclass` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `siteId` int(5) unsigned DEFAULT NULL COMMENT '场地ID',
  `startDate` date DEFAULT NULL,
  `startTime` varchar(255) DEFAULT NULL COMMENT '添加日期',
  `endTime` varchar(255) DEFAULT NULL COMMENT '结束时间',
  `employeeId` int(10) unsigned DEFAULT NULL COMMENT '员工ID',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`),
  KEY `siteId` (`siteId`)
)  AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseclass`
--

LOCK TABLES `courseclass` WRITE;
/*!40000 ALTER TABLE `courseclass` DISABLE KEYS */;
INSERT INTO `courseclass` VALUES (1,1,'2014-09-01','9','10:30',1),(2,1,'2015-09-24','11:47','18:48',1),(3,2,'2015-09-24','11:50','15:50',1),(4,3,'2015-09-24','11:51','15:51',1),(5,1,'2015-09-24','18:37','23:37',17),(6,1,'2015-10-01','11:41','14:41',17);
/*!40000 ALTER TABLE `courseclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseinstrument`
--

DROP TABLE IF EXISTS `courseinstrument`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseinstrument` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '器械名称',
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseinstrument`
--

LOCK TABLES `courseinstrument` WRITE;
/*!40000 ALTER TABLE `courseinstrument` DISABLE KEYS */;
INSERT INTO `courseinstrument` VALUES (1,'无器械'),(2,'小器械'),(3,'卧推'),(4,'平推');
/*!40000 ALTER TABLE `courseinstrument` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseposition`
--

DROP TABLE IF EXISTS `courseposition`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseposition` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='课程部位';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseposition`
--

LOCK TABLES `courseposition` WRITE;
/*!40000 ALTER TABLE `courseposition` DISABLE KEYS */;
INSERT INTO `courseposition` VALUES (1,'胸'),(2,'肩'),(3,'腿'),(4,'腹'),(5,'腰');
/*!40000 ALTER TABLE `courseposition` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courseresult`
--

DROP TABLE IF EXISTS `courseresult`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courseresult` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `courseId` int(10) unsigned DEFAULT NULL COMMENT '课程ID',
  `actionId` int(10) unsigned DEFAULT NULL COMMENT '课程动作',
  `postionId` int(10) unsigned DEFAULT NULL COMMENT '训练部位',
  `instrumentId` int(10) unsigned DEFAULT NULL COMMENT '器械',
  `num` varchar(255) DEFAULT NULL COMMENT '次数',
  `strength` varchar(255) DEFAULT NULL COMMENT '强度',
  `feeling` varchar(255) DEFAULT NULL COMMENT '感觉',
  PRIMARY KEY (`id`),
  KEY `courseId` (`courseId`),
  KEY `actionId` (`actionId`),
  KEY `postionId` (`postionId`),
  KEY `instrumentId` (`instrumentId`)
)  AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courseresult`
--

LOCK TABLES `courseresult` WRITE;
/*!40000 ALTER TABLE `courseresult` DISABLE KEYS */;
INSERT INTO `courseresult` VALUES (10,1,1,1,1,'1','1','1'),(11,1,1,1,4,'1','1','1'),(12,1,1,1,1,'1','1','1'),(13,1,1,1,4,'1','1','1'),(14,1,1,2,2,'','',''),(18,2,2,2,2,'2','2','2'),(19,2,1,1,1,'1','1','1'),(20,7,1,1,1,'1','1','1');
/*!40000 ALTER TABLE `courseresult` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) DEFAULT NULL COMMENT '部门名称',
  `parentId` int(5) unsigned DEFAULT '0' COMMENT '父部门ID',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='部门';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'会籍部',0),(2,'教练部',0);
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `realName` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `tel` char(11) NOT NULL COMMENT '手机号',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `img` varchar(100) DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) DEFAULT '0' COMMENT '没有选择性别：0，男士:1,女士2，默认是字符串0',
  `born` date DEFAULT '0000-00-00' COMMENT '出身日期',
  `cdate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `lasttime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次登录时间',
  `departmentId` int(5) unsigned DEFAULT '0' COMMENT '部门ID',
  `status` tinyint(3) unsigned DEFAULT '1' COMMENT '1有效，2无效，3删除',
  `positionId` int(5) unsigned DEFAULT '0' COMMENT '职位ID',
  PRIMARY KEY (`id`),
  KEY `tel` (`tel`),
  KEY `departmentId` (`departmentId`),
  KEY `positionId` (`positionId`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COMMENT='员工表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employee`
--

LOCK TABLES `employee` WRITE;
/*!40000 ALTER TABLE `employee` DISABLE KEYS */;
INSERT INTO `employee` VALUES (1,'宝宝','13552513007','e10adc3949ba59abbe56e057f20f883e','2015/05/14_1431076839.png',1,'1982-08-19','2015-05-05 19:20:21','0000-00-00 00:00:00',1,1,1),(2,'王小花','13552513007','e10adc3949ba59abbe56e057f20f883e','2015/05/14_1431076839.png',1,'2015-08-02','2015-09-04 01:40:13','2015-09-05 22:20:30',1,1,7),(17,'教练测试','13888888888','e10adc3949ba59abbe56e057f20f883e','2015/05/14_1431076839.png',1,'1985-08-19','2015-05-05 19:20:21','0000-00-00 00:00:00',2,1,6);
/*!40000 ALTER TABLE `employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interest`
--

DROP TABLE IF EXISTS `interest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interest` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) DEFAULT NULL COMMENT '兴趣爱好名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='会员兴趣爱好';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interest`
--

LOCK TABLES `interest` WRITE;
/*!40000 ALTER TABLE `interest` DISABLE KEYS */;
INSERT INTO `interest` VALUES (1,'其他'),(2,'音乐'),(3,'上网'),(4,'看书'),(5,'旅游');
/*!40000 ALTER TABLE `interest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave`
--

DROP TABLE IF EXISTS `leave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leave` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '员工ID',
  `startDate` datetime DEFAULT NULL COMMENT '启始日期',
  `endDate` datetime DEFAULT NULL COMMENT '终止日期',
  `reason` varchar(255) DEFAULT NULL COMMENT '请假理由',
  `audit` varchar(255) DEFAULT NULL COMMENT '上级审核意见',
  `leaderId` int(10) unsigned DEFAULT '0' COMMENT '审核人ID',
  `auditDate` datetime DEFAULT NULL COMMENT '审核日期',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0待审核，1审核通过，2驳回，3作废',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT=' 请假表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave`
--

LOCK TABLES `leave` WRITE;
/*!40000 ALTER TABLE `leave` DISABLE KEYS */;
INSERT INTO `leave` VALUES (1,1,'2015-08-31 04:31:04','2015-09-30 04:31:09','111','123123123',1,'2015-08-30 05:12:38',1,'2015-08-30 04:31:30'),(2,1,'2015-08-31 00:00:00','2015-10-01 00:00:00','1123123123','不同意',1,'2015-08-30 22:10:25',2,'2015-08-30 13:32:35'),(3,1,'2015-08-30 00:00:00','2015-09-01 00:00:00','事假！',NULL,0,NULL,0,'2015-08-30 23:54:25'),(4,1,'2015-09-10 00:00:00','2015-09-10 00:00:00','陪妈妈去看病',NULL,0,NULL,0,'2015-09-10 10:26:06'),(5,1,'2015-09-10 00:00:00','2015-09-10 00:00:00','陪妈妈去看病',NULL,0,NULL,0,'2015-09-10 10:26:42');
/*!40000 ALTER TABLE `leave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opinion`
--

DROP TABLE IF EXISTS `opinion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opinion` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '员工ID',
  `content` varchar(255) DEFAULT NULL COMMENT '意见内容',
  `type` tinyint(3) unsigned DEFAULT '1' COMMENT '1匿名，2实名',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='意见表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opinion`
--

LOCK TABLES `opinion` WRITE;
/*!40000 ALTER TABLE `opinion` DISABLE KEYS */;
INSERT INTO `opinion` VALUES (1,1,'坏了坏了坏了坏了',1,'2015-08-30 14:22:56'),(2,1,'服务待加强',1,'2015-08-31 19:01:53');
/*!40000 ALTER TABLE `opinion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) DEFAULT NULL COMMENT '部门名称',
  `parentId` int(5) unsigned DEFAULT '0' COMMENT '父类ID',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='职位表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'投资人',0),(2,'店长',0),(3,'会籍经理',0),(4,'教练经理',0),(5,'会籍',0),(6,'教练',0),(7,'前台',0),(8,'财务',0);
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `type` tinyint(1) unsigned DEFAULT NULL COMMENT '1:运动背景，2回访问题',
  `class` tinyint(1) unsigned DEFAULT '1' COMMENT '1单选，2多选',
  PRIMARY KEY (`id`)
)  AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `question`
--

LOCK TABLES `question` WRITE;
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` VALUES (1,'首次来参考吗？',1,1),(2,'是自己兴趣来参观吗？',1,1),(3,'比较喜欢的运动方式？',1,2),(4,'用户态度？',2,2),(5,'是否约定来参观？',2,1),(6,'购买会员意向？',2,2);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionoption`
--

DROP TABLE IF EXISTS `questionoption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionoption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `qid` int(11) unsigned DEFAULT NULL COMMENT '问题ID',
  PRIMARY KEY (`id`),
  KEY `qid` (`qid`)
)  AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionoption`
--

LOCK TABLES `questionoption` WRITE;
/*!40000 ALTER TABLE `questionoption` DISABLE KEYS */;
INSERT INTO `questionoption` VALUES (1,'是',1),(2,'不是',1),(3,'是',2),(4,'不是',2),(5,'篮球',3),(6,'跑步',3),(7,'游泳',3),(8,'其他',3),(9,'冷淡',4),(10,'一般',4),(11,'反感',4),(12,'是',5),(13,'不是',5),(14,'不会',6),(15,'一般',6),(16,'强烈',6);
/*!40000 ALTER TABLE `questionoption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reason`
--

DROP TABLE IF EXISTS `reason`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reason` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='会员参加理由';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reason`
--

LOCK TABLES `reason` WRITE;
/*!40000 ALTER TABLE `reason` DISABLE KEYS */;
INSERT INTO `reason` VALUES (1,'其他'),(2,'交友'),(3,'消遣'),(4,'增肌'),(5,'减肥'),(6,'体制下降'),(7,'出现亚健康状态'),(8,'体检不合格'),(9,'朋友在健身');
/*!40000 ALTER TABLE `reason` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair`
--

DROP TABLE IF EXISTS `repair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repair` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `num` varchar(255) DEFAULT NULL COMMENT '器械编号',
  `content` varchar(255) DEFAULT NULL COMMENT '故障描述',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '员工ID',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0维修中，1已修完',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='器械报修表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair`
--

LOCK TABLES `repair` WRITE;
/*!40000 ALTER TABLE `repair` DISABLE KEYS */;
INSERT INTO `repair` VALUES (1,'1033','坏了坏了坏了坏了',1,0,'2015-08-30 14:11:55'),(2,'1002','磨损！',1,0,'2015-08-31 00:22:32'),(3,'321','下水道阻塞',1,1,'2015-09-10 10:29:55');
/*!40000 ALTER TABLE `repair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultsdepartmentlog`
--

DROP TABLE IF EXISTS `resultsdepartmentlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultsdepartmentlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `departmentId` int(5) unsigned DEFAULT '0' COMMENT '用户ID',
  `year` int(4) unsigned DEFAULT '0' COMMENT '年',
  `month` varchar(2) DEFAULT NULL COMMENT '月份',
  `num` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '业绩',
  `completeNum` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '完成业绩',
  PRIMARY KEY (`id`),
  KEY `departmentId` (`departmentId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='部门业绩表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultsdepartmentlog`
--

LOCK TABLES `resultsdepartmentlog` WRITE;
/*!40000 ALTER TABLE `resultsdepartmentlog` DISABLE KEYS */;
INSERT INTO `resultsdepartmentlog` VALUES (1,1,2015,'08',300000.00,0.00);
/*!40000 ALTER TABLE `resultsdepartmentlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resultslog`
--

DROP TABLE IF EXISTS `resultslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `resultslog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `employeeId` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `year` int(4) unsigned DEFAULT '0' COMMENT '年',
  `month` varchar(2) DEFAULT NULL COMMENT '月份',
  `num` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '业绩',
  `completeNum` decimal(11,2) unsigned DEFAULT '0.00' COMMENT '完成业绩',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='业绩表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resultslog`
--

LOCK TABLES `resultslog` WRITE;
/*!40000 ALTER TABLE `resultslog` DISABLE KEYS */;
INSERT INTO `resultslog` VALUES (1,1,2015,'08',20000.00,500.00),(2,1,2015,'09',0.00,0.00),(3,1,2015,'10',0.00,0.00),(4,17,2015,'10',0.00,0.00);
/*!40000 ALTER TABLE `resultslog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `source`
--

DROP TABLE IF EXISTS `source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `source` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `name` varchar(255) DEFAULT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='会员来源';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `source`
--

LOCK TABLES `source` WRITE;
/*!40000 ALTER TABLE `source` DISABLE KEYS */;
INSERT INTO `source` VALUES (11,'报纸'),(10,'朋友'),(9,'传单'),(8,'团购'),(7,'百度'),(6,'美团'),(5,'大众点评'),(4,'宣传活动'),(3,'门口广告'),(2,'电视'),(1,'其他来源');
/*!40000 ALTER TABLE `source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `content` varchar(255) DEFAULT NULL COMMENT '任务内容',
  `employeeId` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `noticeDate` datetime DEFAULT NULL COMMENT '提醒日期',
  `complete` datetime DEFAULT NULL COMMENT '完成日期',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `parentId` int(11) unsigned DEFAULT '0' COMMENT '父类ID',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1未完成，2已完成',
  `leaderId` int(11) unsigned DEFAULT '0' COMMENT '分配人ID',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  PRIMARY KEY (`id`),
  KEY `leaderId` (`leaderId`),
  KEY `parentId` (`parentId`),
  KEY `employeeId` (`employeeId`),
  KEY `cdate` (`cdate`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COMMENT='任务表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (1,'完成10个回访',1,'2015-08-20 15:26:39','2015-08-31 15:26:45','备注',0,1,0,'2015-08-20 15:27:13'),(2,'打扫库房',1,'2015-08-20 18:04:08',NULL,NULL,0,1,1,'2015-08-20 18:04:23'),(4,'1',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','1',0,1,1,'2015-08-22 18:09:46'),(5,'分派任务测试',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,1,1,'2015-08-22 18:16:00'),(6,'分派任务测试',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,1,1,'2015-08-22 18:17:03'),(7,'分派任务测试',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,1,1,'2015-08-22 18:20:09'),(8,'d3',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',1,1,0,'2015-08-22 20:19:17'),(14,'a2',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',1,1,0,'2015-08-23 00:31:24'),(15,'a2',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',1,1,0,'2015-08-23 00:31:24'),(16,'a2',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',1,1,0,'2015-08-23 00:31:24'),(17,'a5',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',1,1,0,'2015-08-23 00:31:24'),(30,'广告',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','ok',0,0,1,'2015-08-31 00:47:08'),(31,'跑步',1,'0000-00-00 00:00:00','2015-08-31 15:28:53','',0,1,0,'2015-08-31 15:28:41'),(32,'啊啊啊',1,'2015-09-04 15:37:00','2015-09-04 15:54:53','发几个',0,1,0,'2015-09-04 15:37:41'),(33,'啊是是',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',32,1,0,'2015-09-04 15:37:41'),(34,'发个好',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',32,1,0,'2015-09-04 15:37:41'),(35,'刚刚',1,'2015-09-04 16:22:00','0000-00-00 00:00:00','吧你',0,1,0,'2015-09-04 15:57:05'),(36,'回访准会员！',1,'2015-09-05 22:31:00','0000-00-00 00:00:00','',0,1,0,'2015-09-05 16:41:57'),(37,'琪琪',1,'2015-09-05 22:32:00','0000-00-00 00:00:00','',0,1,0,'2015-09-05 22:27:13'),(38,'传单',1,'2015-09-05 22:32:00','0000-00-00 00:00:00','',0,1,0,'2015-09-05 22:28:13'),(39,'恩',1,'2015-09-10 11:02:00','0000-00-00 00:00:00','',0,1,0,'2015-09-10 11:02:42'),(40,'阿恩',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',39,1,0,'2015-09-10 11:02:42'),(41,'身体延伸200',1,'2015-09-10 13:03:00','0000-00-00 00:00:00','',0,1,0,'2015-09-10 11:03:33'),(42,'阿恩',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',41,1,0,'2015-09-10 11:03:34'),(43,'踢球',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','',0,1,0,'2015-09-18 19:27:16'),(44,'训练',17,'2015-10-02 13:01:00','2015-10-02 22:23:44','加油！',0,2,0,'2015-10-02 12:59:57'),(45,'测试',17,'2015-10-02 13:09:00','0000-00-00 00:00:00','',0,1,0,'2015-10-02 13:07:45'),(46,'测试',1,'2015-10-02 13:32:00','2015-10-03 16:09:24','',0,2,0,'2015-10-02 13:30:59'),(47,'发广告',1,'0000-00-00 00:00:00','0000-00-00 00:00:00','加油',0,2,0,'2015-10-04 22:17:08'),(48,'回访',1,'2015-10-04 22:21:00','0000-00-00 00:00:00','',0,1,0,'2015-10-04 22:20:43');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `realName` varchar(50) DEFAULT '' COMMENT '真实姓名',
  `tel` char(11) NOT NULL COMMENT '手机号',
  `pwd` char(32) NOT NULL COMMENT '密码',
  `img` varchar(100) DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) DEFAULT '0' COMMENT '没有选择性别：0，男士:1,女士2，默认是字符串0',
  `cardNum` varchar(255) DEFAULT NULL COMMENT '证件号码',
  `wxnum` varchar(255) DEFAULT NULL COMMENT '微信号',
  `email` varchar(255) DEFAULT NULL COMMENT '邮件',
  `born` date DEFAULT '0000-00-00' COMMENT '出身日期',
  `cdate` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `lasttime` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次登录时间',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `ismarry` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1已婚，2未婚',
  `ischild` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1有小孩，2无小孩',
  `isvip` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1是会员，2准会员，3过期会员，4暂停会员',
  `coachId` int(11) unsigned DEFAULT '0' COMMENT '教练ID',
  `memberShipId` int(11) unsigned DEFAULT '0' COMMENT '会籍ID',
  `sourceId` int(5) unsigned DEFAULT '0' COMMENT '会员来源',
  `visitDate` datetime DEFAULT NULL COMMENT '回访日期',
  `vipNum` varchar(255) DEFAULT NULL COMMENT '会员卡号',
  `startDate` date DEFAULT NULL COMMENT '会员开始日期',
  `endDate` date DEFAULT NULL COMMENT '会员结算日期',
  `cardType` tinyint(1) unsigned DEFAULT '0' COMMENT '会员卡类型',
  `totalNum` int(5) unsigned DEFAULT '0' COMMENT '会员卡次数',
  `useNum` int(5) unsigned DEFAULT '0' COMMENT '会员卡剩余次数',
  `iscoach` tinyint(1) unsigned DEFAULT '1' COMMENT '1没购买教练客，2已购买教练课',
  PRIMARY KEY (`id`),
  KEY `memberShipId` (`memberShipId`),
  KEY `coachId` (`coachId`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COMMENT='会员表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (14,'宝宝','13552513007','','upload/userpic/2015/09/1_1441410678.jpg',2,'1232','123','123','2015-01-01','2015-08-18 17:08:20','0000-00-00 00:00:00','123',0,0,1,17,1,9,'0000-00-00 00:00:00','1343124','2015-08-01','2016-08-01',1,0,0,1),(18,'111','324234','','upload/userpic/2015/09/1_1441410711.jpg',1,'333','66','55','1995-09-01','2015-08-01 17:00:00','0000-00-00 00:00:00','444',0,0,2,17,1,0,'0000-00-00 00:00:00','','0000-00-00','0000-00-00',0,0,0,2),(19,'测试','13559595555','','upload/userpic/2015/09/1_1441410696.jpg',1,'21111111','啊地方','啊打发掉','1981-10-09','2015-08-01 17:00:00','0000-00-00 00:00:00','阿飞大是大非',2,2,1,17,1,7,'2015-10-02 14:38:00','123','2015-09-05','2016-10-31',1,0,0,2),(20,'dawu','13691449868','','upload/userpic/2015/09/1_1443585538.jpg',1,NULL,NULL,'king@gmail.com','1982-10-08','2015-09-29 10:30:58','0000-00-00 00:00:00','beijing',2,1,2,0,1,7,NULL,NULL,NULL,NULL,0,0,0,1),(21,'t11','123','','',1,NULL,NULL,'123','1995-10-04','2015-09-29 10:50:05','0000-00-00 00:00:00','123',2,1,2,0,1,1,NULL,NULL,NULL,NULL,0,0,0,1),(22,'xiaomi','13691449868','','',1,NULL,NULL,'king@gmail.com','1993-10-04','2015-09-29 11:12:03','0000-00-00 00:00:00','beijing',2,2,2,0,1,10,NULL,NULL,NULL,NULL,0,0,0,1),(23,'long','13691449868','','',1,NULL,NULL,'king@gmail.com','1990-10-05','2015-09-29 12:40:01','0000-00-00 00:00:00','beijing',0,2,2,0,1,10,NULL,NULL,NULL,NULL,0,0,0,1),(24,'曲传宝','13552513007','','upload/userpic/2015/09/1_1443502358.1443502358.jpg',1,NULL,NULL,'qucb@gmail.com','1982-10-08','2015-09-29 12:52:38','0000-00-00 00:00:00','北京海淀',2,1,2,0,1,10,NULL,NULL,NULL,NULL,0,0,0,1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userextended`
--

DROP TABLE IF EXISTS `userextended`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userextended` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增Id',
  `userId` int(11) unsigned DEFAULT '0' COMMENT '会员ID',
  `interestId` int(5) unsigned DEFAULT '0' COMMENT '兴趣爱好',
  `interest` varchar(255) DEFAULT NULL COMMENT '其他爱好填写',
  `source` varchar(255) DEFAULT NULL COMMENT '其他来源填写',
  `reasonId` int(5) unsigned DEFAULT '0' COMMENT '参加俱乐部原因',
  `reason` varchar(255) DEFAULT NULL COMMENT '其他原因',
  `isadd` tinyint(1) unsigned DEFAULT '0' COMMENT '1参加过，2未参加',
  `iscoach` tinyint(1) unsigned DEFAULT '0' COMMENT '是否请过教练，1请过，2未请过',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `cpname` varchar(255) DEFAULT NULL COMMENT '公司名称',
  `cpaddress` varchar(255) DEFAULT NULL COMMENT '公司地址',
  `cptel` varchar(255) DEFAULT NULL COMMENT '公司电话',
  `cppost` varchar(255) DEFAULT NULL COMMENT '公司邮编',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `interestId` (`interestId`),
  KEY `reasonId` (`reasonId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='会员扩展表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userextended`
--

LOCK TABLES `userextended` WRITE;
/*!40000 ALTER TABLE `userextended` DISABLE KEYS */;
INSERT INTO `userextended` VALUES (1,14,0,NULL,'',0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(2,19,0,NULL,'',0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(3,18,0,NULL,'',0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(4,0,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(5,0,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(6,20,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(7,27,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(8,21,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(9,22,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(10,23,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(11,24,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL),(12,27,0,NULL,NULL,0,NULL,0,0,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `userextended` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userlog`
--

DROP TABLE IF EXISTS `userlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userlog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `cdate` datetime DEFAULT NULL COMMENT '日期',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
)  AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userlog`
--

LOCK TABLES `userlog` WRITE;
/*!40000 ALTER TABLE `userlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `userlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useroption`
--

DROP TABLE IF EXISTS `useroption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useroption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `qid` int(10) unsigned DEFAULT NULL COMMENT '用户问题ID',
  `optionId` int(10) unsigned DEFAULT NULL COMMENT '用户答案ID',
  `userid` int(11) unsigned DEFAULT NULL COMMENT '用户ID',
  `class` tinyint(1) unsigned DEFAULT NULL COMMENT '类型：1运动经验，2回访',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `qid` (`qid`) 
)  AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useroption`
--

LOCK TABLES `useroption` WRITE;
/*!40000 ALTER TABLE `useroption` DISABLE KEYS */;
INSERT INTO `useroption` VALUES (1,1,1,26,1),(6,4,9,2,2),(8,4,9,3,2),(10,4,9,27,2),(12,1,1,21,1),(13,1,1,27,1),(18,1,2,24,1),(19,2,4,24,1),(20,3,6,24,1),(21,3,7,24,1),(34,1,2,20,1),(35,2,4,20,1),(36,3,6,20,1),(37,3,7,20,1),(38,4,10,20,2),(39,5,13,20,2),(40,6,15,20,2),(41,6,16,20,2),(42,1,2,19,1),(43,2,4,19,1),(44,3,6,19,1),(45,3,7,19,1),(49,4,10,19,2),(50,5,13,19,2),(51,6,15,19,2);
/*!40000 ALTER TABLE `useroption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vippaylog`
--

DROP TABLE IF EXISTS `vippaylog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vippaylog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `userId` int(11) unsigned DEFAULT '0' COMMENT '会员ID',
  `cardNum` varchar(255) DEFAULT NULL COMMENT '卡号',
  `cardType` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1年卡，2半年卡，3季卡，4月卡，5次卡',
  `startDate` date DEFAULT NULL COMMENT '开始日期',
  `endDate` date DEFAULT NULL COMMENT '结束日期',
  `totalNum` int(11) unsigned DEFAULT '0' COMMENT '总次数',
  `payable` decimal(8,2) unsigned DEFAULT '0.00' COMMENT '应付',
  `payMoney` decimal(8,2) unsigned DEFAULT '0.00' COMMENT '实付',
  `payType` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1现金，2刷卡，3支票',
  `remark` varchar(255) DEFAULT NULL COMMENT '备注',
  `applyId` int(11) unsigned DEFAULT '0' COMMENT '申请人ID',
  `reviewId` int(11) unsigned DEFAULT '0' COMMENT '财务审核人ID',
  `leaderId` int(11) unsigned DEFAULT '0' COMMENT '部门审核人Id',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0默认，1待主管审核，2待财务审核，3生效，4作废',
  `cdate` datetime DEFAULT NULL COMMENT '创建日期',
  `reviewDate` datetime DEFAULT NULL COMMENT '财务审核日期',
  `leaderDate` datetime DEFAULT NULL COMMENT '部门主管审核日期',
  `leaderRemark` varchar(255) DEFAULT NULL COMMENT '部门主管审核意见',
  `contract` varchar(255) DEFAULT NULL COMMENT '合同编号',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `applyId` (`applyId`),
  KEY `leaderId` (`leaderId`),
  KEY `reviewId` (`reviewId`),
  KEY `cardNum` (`cardNum`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='会员购买记录表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vippaylog`
--

LOCK TABLES `vippaylog` WRITE;
/*!40000 ALTER TABLE `vippaylog` DISABLE KEYS */;
INSERT INTO `vippaylog` VALUES (1,14,'1343124',1,'2015-08-01','2016-08-01',0,1000.00,1000.00,1,'啊啊啊',1,1,0,3,'2015-08-26 14:56:38','2015-09-05 15:55:35','2015-08-29 23:18:53','adsfasdfasdfasdf','255'),(2,18,'123123123',2,'2015-09-04','2016-10-31',11,100.00,1000.00,1,'11111111111',1,1,0,3,'2015-09-03 17:28:15','2015-09-04 00:49:45','0000-00-00 00:00:00','','255'),(4,20,'123123123123123123123123',1,'2015-09-05','2016-10-01',0,10000.00,6000.00,2,'123123123',1,1,0,3,'2015-09-04 15:14:24','2015-09-04 15:15:48','0000-00-00 00:00:00','','255'),(5,20,'11111',1,'2015-09-05','2015-10-31',0,0.00,0.00,2,'qqq',1,1,0,3,'2015-09-04 17:21:30','2015-09-05 12:46:21','0000-00-00 00:00:00','','1111'),(6,19,'123',1,'2015-09-05','2016-10-31',0,1000.00,1000.00,2,'asdfasdf',1,1,0,3,'2015-09-05 15:54:57','2015-09-05 15:55:41','0000-00-00 00:00:00','','123'),(7,20,'',1,'2015-09-30','2016-09-30',0,1000.00,3000.00,1,'ca',1,0,0,2,'2015-09-30 15:44:13','0000-00-00 00:00:00','2015-10-02 19:10:05','很好',NULL),(8,24,'',5,'2015-10-02','2015-11-02',0,1000.00,3000.00,1,'无变化',1,0,0,1,'2015-10-02 19:08:36','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL);
/*!40000 ALTER TABLE `vippaylog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitlog`
--

DROP TABLE IF EXISTS `visitlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `userId` int(11) unsigned DEFAULT '0' COMMENT '用户ID',
  `employeeId` int(11) unsigned DEFAULT '0' COMMENT '员工Id',
  `content` varchar(255) DEFAULT NULL COMMENT '回访内容',
  `telTime` int(11) unsigned DEFAULT '0' COMMENT '通话时长',
  `telNum` int(5) unsigned DEFAULT '1' COMMENT '呼叫次数',
  `cdate` datetime DEFAULT NULL COMMENT '呼叫日期',
  PRIMARY KEY (`id`),
  KEY `employeeId` (`employeeId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='回访表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitlog`
--

LOCK TABLES `visitlog` WRITE;
/*!40000 ALTER TABLE `visitlog` DISABLE KEYS */;
INSERT INTO `visitlog` VALUES (1,14,1,'aaaa',1,1,'2015-08-29 11:57:46'),(2,20,1,'abc',0,0,'2015-09-30 15:27:49'),(3,19,17,'ok',0,0,'2015-10-01 14:35:21'),(4,19,17,'啊啊啊',2,0,'2015-10-05 13:43:36');
/*!40000 ALTER TABLE `visitlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wardrobe`
--

DROP TABLE IF EXISTS `wardrobe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wardrobe` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增ID',
  `num` varchar(255) DEFAULT NULL COMMENT '衣柜编号',
  `userId` int(11) unsigned DEFAULT '0' COMMENT '会员ID',
  `employeeId` int(5) unsigned DEFAULT '0' COMMENT '员工ID',
  `startDate` datetime DEFAULT NULL COMMENT '开始日期',
  `endDate` datetime DEFAULT NULL COMMENT '结束日期',
  `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0未归还，1已归还',
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`),
  KEY `num` (`num`),
  KEY `employeeId` (`employeeId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='衣柜租用';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wardrobe`
--

LOCK TABLES `wardrobe` WRITE;
/*!40000 ALTER TABLE `wardrobe` DISABLE KEYS */;
INSERT INTO `wardrobe` VALUES (1,'102',1,1,'2015-08-30 13:55:23','2015-08-31 13:55:30',0);
/*!40000 ALTER TABLE `wardrobe` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-05 22:55:16
