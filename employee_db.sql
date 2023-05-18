/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : employee_db

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2019-09-18 20:48:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `t_admin`
-- ----------------------------
DROP TABLE IF EXISTS `t_admin`;
CREATE TABLE `t_admin` (
  `username` varchar(20) NOT NULL default '',
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_admin
-- ----------------------------
INSERT INTO `t_admin` VALUES ('a', 'a');

-- ----------------------------
-- Table structure for `t_bumen`
-- ----------------------------
DROP TABLE IF EXISTS `t_bumen`;
CREATE TABLE `t_bumen` (
  `bumenbianhao` varchar(20) NOT NULL COMMENT 'bumenbianhao',
  `bumenmingcheng` varchar(20) NOT NULL COMMENT '部门名称',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`bumenbianhao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_bumen
-- ----------------------------
INSERT INTO `t_bumen` VALUES ('BM001', '人事部', '2019-09-16 21:55:39');
INSERT INTO `t_bumen` VALUES ('BM002', '市场部', '2019-09-18 20:33:34');

-- ----------------------------
-- Table structure for `t_diaodong`
-- ----------------------------
DROP TABLE IF EXISTS `t_diaodong`;
CREATE TABLE `t_diaodong` (
  `id` int(11) NOT NULL auto_increment COMMENT '调动id',
  `xingming` varchar(20) NOT NULL COMMENT '姓名',
  `bumenmingcheng` varchar(20) NOT NULL COMMENT '部门名称',
  `danrenzhiwu` varchar(20) NOT NULL COMMENT '担任职务',
  `yuanjibengongzi` float NOT NULL COMMENT '原基本工资',
  `diaodongzhiwei` varchar(20) NOT NULL COMMENT '调动职位',
  `diaodongbumen` varchar(20) NOT NULL COMMENT '调动部门',
  `diaodongriqi` varchar(20) default NULL COMMENT '调动日期',
  `xianjibengongzi` float NOT NULL COMMENT '现基本工资',
  `diaodongyuanyin` varchar(80) NOT NULL COMMENT '调动原因',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`id`),
  KEY `xingming` (`xingming`),
  KEY `bumenmingcheng` (`bumenmingcheng`),
  KEY `diaodongbumen` (`diaodongbumen`),
  CONSTRAINT `t_diaodong_ibfk_3` FOREIGN KEY (`diaodongbumen`) REFERENCES `t_bumen` (`bumenbianhao`),
  CONSTRAINT `t_diaodong_ibfk_1` FOREIGN KEY (`xingming`) REFERENCES `t_employee` (`bianhao`),
  CONSTRAINT `t_diaodong_ibfk_2` FOREIGN KEY (`bumenmingcheng`) REFERENCES `t_bumen` (`bumenbianhao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_diaodong
-- ----------------------------
INSERT INTO `t_diaodong` VALUES ('1', 'EM001', 'BM001', '人事总管', '8500', 'Hr经理', 'BM001', '2019-09-04', '9800', '管理能力强', '2019-09-16 21:56:26');
INSERT INTO `t_diaodong` VALUES ('2', 'EM002', 'BM002', '销售人员', '3500', '市场总监', 'BM002', '2019-09-17', '6000', '销售能力强', '2019-09-18 20:38:47');

-- ----------------------------
-- Table structure for `t_employee`
-- ----------------------------
DROP TABLE IF EXISTS `t_employee`;
CREATE TABLE `t_employee` (
  `bianhao` varchar(20) NOT NULL COMMENT 'bianhao',
  `mima` varchar(20) NOT NULL COMMENT '密码',
  `xingming` varchar(20) NOT NULL COMMENT '姓名',
  `xingbie` varchar(4) NOT NULL COMMENT '性别',
  `bumenObj` varchar(20) NOT NULL COMMENT '部门',
  `danrenzhiwu` varchar(20) NOT NULL COMMENT '担任职务',
  `minzu` varchar(20) NOT NULL COMMENT '民族',
  `chushengriqi` varchar(20) default NULL COMMENT '出生日期',
  `shenfenzhenghao` varchar(20) NOT NULL COMMENT '身份证号',
  `jiguan` varchar(20) NOT NULL COMMENT '籍贯',
  `wenhuachengdu` varchar(20) NOT NULL COMMENT '文化程度',
  `zhengzhimianmao` varchar(20) NOT NULL COMMENT '政治面貌',
  `hunyinqingkuang` varchar(20) NOT NULL COMMENT '婚姻状况',
  `biyeyuanxiao` varchar(20) NOT NULL COMMENT '毕业院校',
  `zhuanye` varchar(20) NOT NULL COMMENT '专业',
  `biyeshijian` varchar(20) default NULL COMMENT '毕业时间',
  `shoujihao` varchar(20) NOT NULL COMMENT '手机号',
  `jibengongzi` float NOT NULL COMMENT '基本工资',
  `xianzhuzhi` varchar(100) NOT NULL COMMENT '现住址',
  `zhaopian` varchar(60) NOT NULL COMMENT '照片',
  `beizhu` varchar(800) default NULL COMMENT '备注',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`bianhao`),
  KEY `bumenObj` (`bumenObj`),
  CONSTRAINT `t_employee_ibfk_1` FOREIGN KEY (`bumenObj`) REFERENCES `t_bumen` (`bumenbianhao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_employee
-- ----------------------------
INSERT INTO `t_employee` VALUES ('EM001', '123', '张国英', '女', 'BM001', 'Hr经理', '汉', '2019-09-04', '513031199812111432', '四川达州', '本科', '党员', '已婚', '四川大学', '财务会计专业', '2019-09-03', '13084902243', '9800', '成都红星路', 'upload/83c2ed756493c6de85e1edceca394a66.jpg', '测试', '2019-09-16 21:56:09');
INSERT INTO `t_employee` VALUES ('EM002', '123', '李希艳', '女', 'BM002', '市场总监', '汉', '2019-09-13', '513051199611033423', '四川南充', '专科', '党员', '已婚', '四川师范大学', '市场营销', '2019-09-12', '13908319831', '6000', '四川成都高新区', 'upload/14786a680109e59289bb30e19296e555.jpg', '测试', '2019-09-18 14:21:48');

-- ----------------------------
-- Table structure for `t_kaohe`
-- ----------------------------
DROP TABLE IF EXISTS `t_kaohe`;
CREATE TABLE `t_kaohe` (
  `kaoheId` int(11) NOT NULL auto_increment COMMENT '考核id',
  `xingming` varchar(20) NOT NULL COMMENT '姓名',
  `bumenObj` varchar(20) NOT NULL COMMENT '部门',
  `zhiwu` varchar(20) NOT NULL COMMENT '职务',
  `nianfen` varchar(20) NOT NULL COMMENT '年份',
  `yuefen` varchar(20) NOT NULL COMMENT '月份',
  `kaohejieguo` varchar(500) NOT NULL COMMENT '考核结果',
  `kaohejiangli` varchar(500) NOT NULL COMMENT '考核奖励',
  `kaohebumen` varchar(20) NOT NULL COMMENT '考核部门',
  `kaoheren` varchar(20) NOT NULL COMMENT '考核人',
  `kaoheneirong` varchar(500) NOT NULL COMMENT '考核内容',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`kaoheId`),
  KEY `xingming` (`xingming`),
  KEY `bumenObj` (`bumenObj`),
  KEY `kaohebumen` (`kaohebumen`),
  CONSTRAINT `t_kaohe_ibfk_3` FOREIGN KEY (`kaohebumen`) REFERENCES `t_bumen` (`bumenbianhao`),
  CONSTRAINT `t_kaohe_ibfk_1` FOREIGN KEY (`xingming`) REFERENCES `t_employee` (`bianhao`),
  CONSTRAINT `t_kaohe_ibfk_2` FOREIGN KEY (`bumenObj`) REFERENCES `t_bumen` (`bumenbianhao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_kaohe
-- ----------------------------
INSERT INTO `t_kaohe` VALUES ('1', 'EM001', 'BM001', 'Hr经理', '2019', '9', '优秀', '500元', 'BM001', 'CEO', '办理能力，为公司吸纳人才能力', '2019-09-16 21:57:12');
INSERT INTO `t_kaohe` VALUES ('2', 'EM002', 'BM002', '市场总监', '2019', '9', '良好', '300元', 'BM002', '王中涛', '市场营销能力', '2019-09-18 20:42:38');

-- ----------------------------
-- Table structure for `t_kaoqin`
-- ----------------------------
DROP TABLE IF EXISTS `t_kaoqin`;
CREATE TABLE `t_kaoqin` (
  `kaoqinId` int(11) NOT NULL auto_increment COMMENT '考勤id',
  `xingming` varchar(20) NOT NULL COMMENT '姓名',
  `xingbie` varchar(4) NOT NULL COMMENT '性别',
  `suoshubumen` varchar(20) NOT NULL COMMENT '所属部门',
  `danrenzhiwu` varchar(20) NOT NULL COMMENT '担任职务',
  `nianfen` varchar(20) NOT NULL COMMENT '年份',
  `yuefen` varchar(20) NOT NULL COMMENT '月份',
  `daoqintianshu` float NOT NULL COMMENT '到勤天数',
  `chidaotianshu` float NOT NULL COMMENT '迟到天数',
  `kuangdaotianshu` float NOT NULL COMMENT '旷工天数',
  `qingjiatianshu` float NOT NULL COMMENT '请假天数',
  `beizhu` varchar(500) default NULL COMMENT '备注',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`kaoqinId`),
  KEY `xingming` (`xingming`),
  KEY `suoshubumen` (`suoshubumen`),
  CONSTRAINT `t_kaoqin_ibfk_2` FOREIGN KEY (`suoshubumen`) REFERENCES `t_bumen` (`bumenbianhao`),
  CONSTRAINT `t_kaoqin_ibfk_1` FOREIGN KEY (`xingming`) REFERENCES `t_employee` (`bianhao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_kaoqin
-- ----------------------------
INSERT INTO `t_kaoqin` VALUES ('1', 'EM001', '女', 'BM001', 'Hr经理', '2019', '9', '23', '2', '3', '1', '测试', '2019-09-16 21:57:47');
INSERT INTO `t_kaoqin` VALUES ('2', 'EM002', '女', 'BM002', '市场总监', '2019', '8', '22', '2', '1', '2', '测试', '2019-09-18 20:43:33');

-- ----------------------------
-- Table structure for `t_peixun`
-- ----------------------------
DROP TABLE IF EXISTS `t_peixun`;
CREATE TABLE `t_peixun` (
  `peixunId` int(11) NOT NULL auto_increment COMMENT '培训id',
  `mingcheng` varchar(20) NOT NULL COMMENT '培训名称',
  `shijian` varchar(20) default NULL COMMENT '培训时间',
  `qingdan` varchar(800) NOT NULL COMMENT '培训清单',
  `didian` varchar(20) NOT NULL COMMENT '培训地点',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`peixunId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_peixun
-- ----------------------------
INSERT INTO `t_peixun` VALUES ('1', '公司业务介绍讲座', '2019-09-11', '所有新入职新人', '公司办公室', '2019-09-10 21:57:56');
INSERT INTO `t_peixun` VALUES ('2', '市场部销售能力培训', '2019-10-08', '所以销售人员', '市场部', '2019-09-18 20:44:54');

-- ----------------------------
-- Table structure for `t_salary`
-- ----------------------------
DROP TABLE IF EXISTS `t_salary`;
CREATE TABLE `t_salary` (
  `salaryId` int(11) NOT NULL auto_increment COMMENT '工资id',
  `xingming` varchar(20) NOT NULL COMMENT '姓名',
  `bumenmingcheng` varchar(20) NOT NULL COMMENT '部门名称',
  `danrenzhiwu` varchar(20) NOT NULL COMMENT '担任职务',
  `nianfen` varchar(20) NOT NULL COMMENT '年份',
  `yuefen` varchar(20) NOT NULL COMMENT '月份',
  `jibengongzi` float NOT NULL COMMENT '基本工资',
  `quanqinjiangli` float NOT NULL COMMENT '全勤奖励',
  `kaohejiangli` float NOT NULL COMMENT '考核奖励',
  `jiabangongzi` float NOT NULL COMMENT '加班工资',
  `jintiebuzhu` float NOT NULL COMMENT '津贴补助',
  `chengfajine` float NOT NULL COMMENT '惩罚金额',
  `gerensuodeshui` float NOT NULL COMMENT '个人所得税',
  `wuxianyijin` float NOT NULL COMMENT '五险一金',
  `yingfagongzi` float NOT NULL COMMENT '应发工资',
  `shifagongzi` float NOT NULL COMMENT '实发工资',
  `beizhu` varchar(500) default NULL COMMENT '备注',
  `addtime` varchar(20) default NULL COMMENT '添加时间',
  PRIMARY KEY  (`salaryId`),
  KEY `xingming` (`xingming`),
  KEY `bumenmingcheng` (`bumenmingcheng`),
  CONSTRAINT `t_salary_ibfk_2` FOREIGN KEY (`bumenmingcheng`) REFERENCES `t_bumen` (`bumenbianhao`),
  CONSTRAINT `t_salary_ibfk_1` FOREIGN KEY (`xingming`) REFERENCES `t_employee` (`bianhao`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_salary
-- ----------------------------
INSERT INTO `t_salary` VALUES ('1', 'EM001', 'BM001', 'Hr经理', '2019', '9', '9800', '200', '150', '300', '450', '200', '1800', '260', '13050', '12980', '测试', '2019-09-16 21:56:51');
INSERT INTO `t_salary` VALUES ('2', 'EM002', 'BM002', '市场总监', '2019', '8', '6000', '280', '180', '580', '240', '100', '1200', '230', '8900', '7600', '测试', '2019-09-18 20:41:04');
