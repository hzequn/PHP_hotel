/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50051
Source Host           : localhost:3306
Source Database       : phpjiudian

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2016-11-24 15:54:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ---------------------------
-- Table structure for `allusers`
-- ----------------------------
DROP TABLE IF EXISTS `allusers`;
CREATE TABLE `allusers` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `pwd` varchar(50) default NULL,
  `cx` varchar(50) default '普通管理员',
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of allusers
-- ----------------------------
INSERT INTO `allusers` VALUES ('2', 'a', 'a', '超级管理员', '2019-02-24 10:51:02');

-- ----------------------------
-- Table structure for `dx`
-- ----------------------------
DROP TABLE IF EXISTS `dx`;
CREATE TABLE `dx` (
  `ID` int(11) NOT NULL auto_increment,
  `leibie` varchar(255) character set utf8 default NULL,
  `content` text character set utf8,
  `addtime` timestamp NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dx
-- ----------------------------
INSERT INTO `dx` VALUES ('1', '酒店介绍', '<P><FONT face=宋体>酒店介绍</P>\r\n<P><FONT face=宋体>酒店介绍</P>\r\n<P><FONT face=宋体>酒店介绍订单</P>\r\n<P><FONT face=宋体>酒店介绍</P>\r\n<P><FONT face=宋体>酒店介绍</P>\r\n<P><FONT face=宋体>酒店介绍</P></FONT></FONT></FONT></FONT></FONT></FONT>', '2016-11-24 22:00:15');
INSERT INTO `dx` VALUES ('2', '系统公告', '<P>XXXXXX</P>', '2019-02-24 21:14:15');

-- ----------------------------
-- Table structure for `jiudianxinxi`
-- ----------------------------
DROP TABLE IF EXISTS `jiudianxinxi`;
CREATE TABLE `jiudianxinxi` (
  `id` int(11) NOT NULL auto_increment,
  `jiudianmingcheng` varchar(300) default NULL,
  `xingji` varchar(50) default NULL,
  `dianhua` varchar(50) default NULL,
  `dizhi` varchar(300) default NULL,
  `zhaopian` varchar(50) default NULL,
  `beizhu` varchar(500) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of jiudianxinxi
-- ----------------------------
INSERT INTO `jiudianxinxi` VALUES ('2', '客房', '五星级', '99', '0', 'uploadfile/6.jpg', 'gewgweg', '2016-11-24 11:12:15');
INSERT INTO `jiudianxinxi` VALUES ('3', '客房', '四星级', '99', '0', 'uploadfile/7.jpg', 'fwefew', '2016-11-24 23:24:59');
INSERT INTO `jiudianxinxi` VALUES ('4', '客房', '五星级', '99', '0', 'uploadfile/8.jpg', 'gewgew', '2016-11-24 23:24:59');
INSERT INTO `jiudianxinxi` VALUES ('5', '客房', '五星级', '99', '0', 'uploadfile/9.jpg', 'gewgew', '2016-11-24 23:24:59');
INSERT INTO `jiudianxinxi` VALUES ('6', '客房', '三星级', '99', '0', 'uploadfile/13.jpg', 'gewgwe', '2016-11-24 23:24:59');

-- ----------------------------
-- Table structure for `jiudianyuding`
-- ----------------------------
DROP TABLE IF EXISTS `jiudianyuding`;
CREATE TABLE `jiudianyuding` (
  `id` int(11) NOT NULL auto_increment,
  `jiudianmingcheng` varchar(300) default NULL,
  `xingji` varchar(50) default NULL,
  `dianhua` varchar(50) default NULL,
  `dizhi` varchar(300) default NULL,
  `yudingren` varchar(50) default NULL,
  `yudingshijian` varchar(50) default NULL,
  `yudingrenshu` varchar(50) default NULL,
  `beizhu` varchar(500) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `issh` varchar(10) default '否',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of jiudianyuding
-- ----------------------------
INSERT INTO `jiudianyuding` VALUES ('5', '客房', '三星级', '99', '0', '53', '2016-11-22', '2', '', '2016-11-22 21:54:29', '否');
INSERT INTO `jiudianyuding` VALUES ('6', '客房', '三星级', '99', '0', '555', '2016-11-22', '1', '', '2016-11-22 21:58:33', '是');

-- ----------------------------
-- Table structure for `liuyanban`
-- ----------------------------
DROP TABLE IF EXISTS `liuyanban`;
CREATE TABLE `liuyanban` (
  `id` int(11) NOT NULL auto_increment,
  `zhanghao` varchar(50) default NULL,
  `zhaopian` varchar(50) default NULL,
  `xingming` varchar(50) default NULL,
  `liuyan` varchar(50) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `huifu` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of liuyanban
-- ----------------------------
INSERT INTO `liuyanban` VALUES ('20', '53', 'uploadfile/10.jpg', '53', '3333333333', '2016-11-22 21:54:12', null);
INSERT INTO `liuyanban` VALUES ('21', '555', '33', '刘东', '一份辣子鸡块', '2016-11-22 21:58:20', '已下单');

-- ----------------------------
-- Table structure for `ruzhuxinxi`
-- ----------------------------
DROP TABLE IF EXISTS `ruzhuxinxi`;
CREATE TABLE `ruzhuxinxi` (
  `id` int(11) NOT NULL auto_increment,
  `banjihao` varchar(50) default NULL,
  `shifadi` varchar(50) default NULL,
  `mudedi` varchar(50) default NULL,
  `piaojia` varchar(50) default NULL,
  `qifeishijian` varchar(50) default NULL,
  `beizhu` varchar(500) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of ruzhuxinxi
-- ----------------------------
INSERT INTO `ruzhuxinxi` VALUES ('2', 'X4876', '刘德华', '378888888880988', '188', '9:20', '结账退房', '2016-11-22 23:17:13');

-- ----------------------------
-- Table structure for `toupiaojilu`
-- ----------------------------
DROP TABLE IF EXISTS `toupiaojilu`;
CREATE TABLE `toupiaojilu` (
  `id` int(11) NOT NULL auto_increment,
  `xx` varchar(2) default NULL,
  `addby` varchar(10) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of toupiaojilu
-- ----------------------------
INSERT INTO `toupiaojilu` VALUES ('6', 'B', '555', '2016-11-22 09:29:20');
INSERT INTO `toupiaojilu` VALUES ('7', 'A', '555', '2016-11-22 09:29:23');
INSERT INTO `toupiaojilu` VALUES ('8', 'A', '555', '2016-11-22 13:14:11');
INSERT INTO `toupiaojilu` VALUES ('9', 'C', '555', '2016-11-22 09:40:59');
INSERT INTO `toupiaojilu` VALUES ('10', 'D', 'fs', '2016-11-22 10:01:22');

-- ----------------------------
-- Table structure for `xinwentongzhi`
-- ----------------------------
DROP TABLE IF EXISTS `xinwentongzhi`;
CREATE TABLE `xinwentongzhi` (
  `id` int(11) NOT NULL auto_increment,
  `biaoti` varchar(500) character set gb2312 default NULL,
  `leibie` varchar(50) character set gb2312 default NULL,
  `neirong` text character set gb2312,
  `tianjiaren` varchar(50) character set gb2312 default NULL,
  `addtime` timestamp NULL default CURRENT_TIMESTAMP,
  `shouyetupian` varchar(50) default NULL,
  `dianjilv` int(11) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of xinwentongzhi
-- ----------------------------
INSERT INTO `xinwentongzhi` VALUES ('48', '酒店优惠', '酒店优惠', '酒店优惠', 'a', '2016-11-22 21:19:49', 'uploadfile/1.jpg', '3');
INSERT INTO `xinwentongzhi` VALUES ('49', '酒店优惠', '酒店优惠', '酒店优惠', 'a', '2016-11-22 21:19:49', 'uploadfile/2.jpg', '3');
INSERT INTO `xinwentongzhi` VALUES ('50', '酒店优惠', '酒店优惠', '酒店优惠', 'a', '2016-11-22 21:19:49', 'uploadfile/3.jpg', '1');
INSERT INTO `xinwentongzhi` VALUES ('51', '酒店优惠', '酒店优惠', '酒店优惠', 'a', '2016-11-22 21:19:49', 'uploadfile/4.jpg', '2');
INSERT INTO `xinwentongzhi` VALUES ('52', '酒店优惠', '酒店优惠', '酒店优惠', 'a', '2016-11-22 21:19:49', 'uploadfile/5.jpg', '2');
INSERT INTO `xinwentongzhi` VALUES ('53', '酒店优惠', '酒店优惠', '酒店优惠', 'a', '2014-05-09 21:19:49', 'uploadfile/12.jpg', '1');

-- ----------------------------
-- Table structure for `yonghuzhuce`
-- ----------------------------
DROP TABLE IF EXISTS `yonghuzhuce`;
CREATE TABLE `yonghuzhuce` (
  `id` int(11) NOT NULL auto_increment,
  `zhanghao` varchar(50) default NULL,
  `mima` varchar(50) default NULL,
  `xingming` varchar(50) default NULL,
  `xingbie` varchar(50) default NULL,
  `diqu` varchar(50) default NULL,
  `Email` varchar(50) default NULL,
  `zhaopian` varchar(50) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `issh` varchar(10) default '否',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of yonghuzhuce
-- ----------------------------
INSERT INTO `yonghuzhuce` VALUES ('18', '53', '53', '53', '女', '浙江', 'twq@163.com', 'uploadfile/10.jpg', '2016-11-22 13:00:11', '是');
INSERT INTO `yonghuzhuce` VALUES ('20', '555', '555', '刘东', '男', '浙江', '33', '33', '2016-11-22 21:57:41', '是');

-- ----------------------------
-- Table structure for `youqinglianjie`
-- ----------------------------
DROP TABLE IF EXISTS `youqinglianjie`;
CREATE TABLE `youqinglianjie` (
  `id` int(11) NOT NULL auto_increment,
  `wangzhanmingcheng` varchar(50) default NULL,
  `wangzhi` varchar(50) default NULL,
  `addtime` timestamp NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of youqinglianjie
-- ----------------------------
INSERT INTO `youqinglianjie` VALUES ('11', '中国百度', 'http://www.by960.cn', '2016-11-22 14:47:19');
INSERT INTO `youqinglianjie` VALUES ('12', '中国网易', 'http://www.zgyimin.cn', '2016-11-22 13:11:13');
INSERT INTO `youqinglianjie` VALUES ('13', '中国新浪', 'http://www.bisow.cn', '2016-11-22 14:47:45');
INSERT INTO `youqinglianjie` VALUES ('14', '中国雅虎', 'http://www.ccbysj.cn', '2016-11-22 14:47:57');
INSERT INTO `youqinglianjie` VALUES ('15', '阿里巴巴中国', 'http://www.zgziliao.cn', '2016-11-22 14:48:15');

-- ----------------------------
-- Table structure for `yuangongxinxi`
-- ----------------------------
DROP TABLE IF EXISTS `yuangongxinxi`;
CREATE TABLE `yuangongxinxi` (
  `id` int(11) NOT NULL auto_increment,
  `bianhao` varchar(50) default NULL,
  `mingcheng` varchar(300) default NULL,
  `chufadi` varchar(50) default NULL,
  `mudedi` varchar(50) default NULL,
  `chuxingshijian` varchar(50) default NULL,
  `jiage` varchar(50) default NULL,
  `chuxingshichang` varchar(50) default NULL,
  `jiaotonggongju` varchar(50) default NULL,
  `beizhu` varchar(500) default NULL,
  `addtime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of yuangongxinxi
-- ----------------------------
INSERT INTO `yuangongxinxi` VALUES ('5', '2', '李丹妮', '上海', '3700000', '2014-05-16', '22', '22', '经理', '22', '2016-11-22 21:16:26');
