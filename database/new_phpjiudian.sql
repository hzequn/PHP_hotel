/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50620
Source Host           : localhost:3306
Source Database       : phpjiudian

Target Server Type    : MYSQL
Target Server Version : 50620
File Encoding         : 65001

Date: 2019-04-24 16:34:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `allusers`
-- ----------------------------
DROP TABLE IF EXISTS `allusers`;
CREATE TABLE `allusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `cx` varchar(50) DEFAULT '普通管理员',
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of allusers
-- ----------------------------
INSERT INTO `allusers` VALUES ('3', 'admin', 'admin', '超级管理员', '2019-03-03 22:05:06');
INSERT INTO `allusers` VALUES ('15', 'chen', 'chen', '普通管理员', '2019-04-21 20:31:50');

-- ----------------------------
-- Table structure for `dx`
-- ----------------------------
DROP TABLE IF EXISTS `dx`;
CREATE TABLE `dx` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `leibie` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8,
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dx
-- ----------------------------
INSERT INTO `dx` VALUES ('1', '酒店介绍', '', '2019-04-21 10:27:11');
INSERT INTO `dx` VALUES ('2', '系统公告', '<P>清明节酒店限时特价房10间，请留意！</P>', '2019-04-02 17:53:11');

-- ----------------------------
-- Table structure for `jiudianxinxi`
-- ----------------------------
DROP TABLE IF EXISTS `jiudianxinxi`;
CREATE TABLE `jiudianxinxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `number` int(10) DEFAULT '0',
  `state` varchar(300) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of jiudianxinxi
-- ----------------------------
INSERT INTO `jiudianxinxi` VALUES ('7', '豪华单人床', '五星级', '123', '2', '1', 'uploadfile/37.jpg', '豪华大床房\r\n配备洗漱用品、拖鞋、电吹风、24小时热水。\r\n', '2019-03-03 22:59:10');
INSERT INTO `jiudianxinxi` VALUES ('8', '豪华双拼特价房', '五星级', '150', '6', '1', 'uploadfile/42.jpg', '我是豪华双拼特价房的备注信息。', '2019-04-02 17:35:13');
INSERT INTO `jiudianxinxi` VALUES ('9', '豪华海景房', '五星级', '299', '10', '1', 'uploadfile/43.jpg', '我是豪华海景房的备注信息。', '2019-04-02 17:36:41');
INSERT INTO `jiudianxinxi` VALUES ('10', '日落海景房', '五星级', '399', '4', '1', 'uploadfile/44.jpg', '我是日落海景房的备注信息。', '2019-04-02 17:37:36');
INSERT INTO `jiudianxinxi` VALUES ('11', '商务套房', '五星级', '100', '7', '1', 'uploadfile/45.jpg', '我是商务套房的备注信息。', '2019-04-02 17:39:19');
INSERT INTO `jiudianxinxi` VALUES ('12', '特惠单人房', '五星级', '99', '0', '0', 'uploadfile/46.jpg', '我是特惠单人房的备注信息。', '2019-04-02 17:40:18');
INSERT INTO `jiudianxinxi` VALUES ('13', '高级单人房', '五星级', '126', '2', '1', 'uploadfile/47.jpg', '我是高级单人房的备注信息。', '2019-04-02 17:40:58');
INSERT INTO `jiudianxinxi` VALUES ('14', '高级双人房', '五星级', '234', '2', '1', 'uploadfile/48.jpg', '我是高级双人房的备注信息。', '2019-04-02 17:42:51');
INSERT INTO `jiudianxinxi` VALUES ('15', '舒适房(无窗)', '五星级', '120', '1', '0', 'uploadfile/49.jpg', '我是舒适房(无窗)的备注信息。', '2019-04-02 17:45:14');
INSERT INTO `jiudianxinxi` VALUES ('16', '奇妙乐园野营房', '五星级', '150', '2', '1', 'uploadfile/50.jpg', '我是奇妙乐园大床野营房客房的备注信息。', '2019-04-02 17:46:22');
INSERT INTO `jiudianxinxi` VALUES ('17', '奇幻森林亲子房', '五星级', '89', '0', '0', 'uploadfile/51.jpg', '我是奇幻森林亲子房客房的备注信息。', '2019-04-02 17:47:09');
INSERT INTO `jiudianxinxi` VALUES ('18', '商旅城景双床房', '五星级', '300', '0', '0', 'uploadfile/52.jpg', '我是商旅城景双床房房客的备注信息。', '2019-04-02 17:48:09');
INSERT INTO `jiudianxinxi` VALUES ('20', '豪华单间电脑房', '五星级', '110', '0', '0', 'uploadfile/121.jpg', '我是豪华单间电脑房的备注信息。', '2019-04-21 19:14:49');
INSERT INTO `jiudianxinxi` VALUES ('21', '特价大圆床', '五星级', '99', '5', '1', 'uploadfile/122.jpg', '我是特价大圆床的备注信息。', '2019-04-21 19:16:09');
INSERT INTO `jiudianxinxi` VALUES ('22', '暑期豪华套间', '五星级', '299', '3', '1', 'uploadfile/123.jpg', '可住六人，东西任用。', '2019-04-21 19:17:26');
INSERT INTO `jiudianxinxi` VALUES ('23', '电脑空调房', '五星级', '111', '1', '1', 'uploadfile/125.jpg', '有独立的电脑和空调。', '2019-04-21 23:50:02');
INSERT INTO `jiudianxinxi` VALUES ('24', '五一特价房', '五星级', '77', '0', '0', 'uploadfile/134.jpg', '只限制五一假期出售', '2019-04-23 23:01:12');
INSERT INTO `jiudianxinxi` VALUES ('25', '豪华亲子房', '五星级', '155', '0', '0', 'uploadfile/136.jpg', '测试客房数量发布', '2019-04-24 00:18:46');

-- ----------------------------
-- Table structure for `jiudianyuding`
-- ----------------------------
DROP TABLE IF EXISTS `jiudianyuding`;
CREATE TABLE `jiudianyuding` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jiudianmingcheng` varchar(300) DEFAULT NULL,
  `xingji` varchar(50) DEFAULT NULL,
  `dianhua` varchar(50) DEFAULT NULL,
  `dizhi` varchar(300) DEFAULT NULL,
  `yudingren` varchar(50) DEFAULT NULL,
  `yudingshijian` varchar(50) DEFAULT NULL,
  `yudingrenshu` varchar(50) DEFAULT NULL,
  `beizhu` varchar(500) DEFAULT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `room_id` int(11) DEFAULT NULL,
  `leave` varchar(5) NOT NULL DEFAULT '否',
  `issh` varchar(10) DEFAULT '否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of jiudianyuding
-- ----------------------------
INSERT INTO `jiudianyuding` VALUES ('7', '豪华单人床', '五星级', '123', '1', 'hzq1', '2019-03-03', '2', '修改后需要再次审核测试！', '2019-04-02 10:02:52', '7', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('13', '商旅城景双床房', '三星级', '300', '1', 'hzq3', '2019-04-21', '2', '我要预订商旅城景双床房，谢谢。', '2019-04-21 01:14:24', '18', '否', '是');
INSERT INTO `jiudianyuding` VALUES ('14', '豪华海景房', '五星级', '299', '0', 'zhangsan', '2019-04-20', '2', '豪华海景房', '2019-04-21 01:16:50', '9', '否', '是');
INSERT INTO `jiudianyuding` VALUES ('15', '特惠单人房', '二星级', '99', '1', 'hzq2', '2019-04-12', '1', '我是单人，预订一间特惠单人房。请查看！', '2019-04-21 01:18:12', '12', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('16', '高级单人房', '四星级', '126', '1', 'hzq1', '2019-04-22', '2', '无', '2019-04-22 14:58:22', '13', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('17', '高级双人房', '五星级', '234', '1', 'hzq1', '2019-04-23', '3', '三人同行', '2019-04-23 10:27:15', '14', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('18', '豪华单间电脑房', '四星级', '110', '0', 'hzq1', '2019-04-22', '2', '小伙伴一起考试', '2019-04-23 10:31:43', '20', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('19', '奇幻森林亲子房', '二星级', '89', '0', 'hzq1', '2019-04-23', '2', '测试满房是否可以预订', '2019-04-23 15:19:52', '17', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('20', '高级单人房', '四星级', '126', '1', 'hzq1', '2019-04-23', '1', '预留空间', '2019-04-23 15:32:53', '13', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('23', '奇妙乐园野营房', '三星级', '150', '1', 'hzq1', '2019-04-23', '1', '测试有房可以预订', '2019-04-23 18:28:23', '16', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('24', '暑期豪华套间', '五星级', '299', '1', 'hzq1', '2019-04-23', '1', '测试数据量大于8显示分业条', '2019-04-23 19:20:28', '22', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('25', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-23', '1', '测试客房数量减少', '2019-04-24 00:57:26', '25', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('26', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-24', '2', '测试客房数量减少', '2019-04-24 00:58:35', '25', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('27', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-24', '3', '测试客房数量减少', '2019-04-24 00:59:53', '25', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('28', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-24', '4', '测试客房数量减少', '2019-04-24 01:02:01', '25', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('29', '电脑空调房', '五星级', '111', '1', 'hzq1', '2019-04-24', '2', '测试客房数量阀值1', '2019-04-24 01:05:05', '23', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('30', '舒适房(无窗)', '五星级', '120', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值2', '2019-04-24 01:07:03', '15', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('31', '奇幻森林亲子房', '五星级', '89', '1', 'hzq1', '2019-04-024', '2', '测试客房数量阀值3', '2019-04-24 01:07:59', '17', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('32', '奇妙乐园野营房', '五星级', '150', '1', 'hzq1', '2019-04-24', '3', '测试客房数量阀值4', '2019-04-24 01:09:43', '16', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('33', '奇妙乐园野营房', '五星级', '150', '1', 'hzq1', '2019-04-24', '5', '测试客房数量阀值5', '2019-04-24 01:10:37', '16', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('34', '奇妙乐园野营房', '五星级', '150', '1', 'hzq1', '2019-04-24', '3', '测试客房数量阀值6', '2019-04-24 01:12:41', '16', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('35', '奇妙乐园野营房', '五星级', '150', '1', 'hzq1', '2019-04-24', '6', '测试客房数量阀值7', '2019-04-24 01:15:03', '16', '否', '否');
INSERT INTO `jiudianyuding` VALUES ('36', '商旅城景双床房', '五星级', '300', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值7', '2019-04-24 01:15:29', '18', '否', '是');
INSERT INTO `jiudianyuding` VALUES ('37', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值8', '2019-04-24 01:18:19', '25', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('38', '电脑空调房', '五星级', '111', '1', 'hzq1', '2019-04-24', '3', '测试客房数量阀值10', '2019-04-24 01:18:59', '23', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('39', '舒适房(无窗)', '五星级', '120', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值11', '2019-04-24 09:31:33', '15', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('40', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-24', '1', '测试客房数量数量阀值12', '2019-04-24 09:35:24', '25', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('41', '五一特价房', '五星级', '77', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值13', '2019-04-24 09:36:33', '24', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('42', '五一特价房', '五星级', '77', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值14', '2019-04-24 09:43:58', '24', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('43', '五一特价房', '五星级', '77', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值15', '2019-04-24 09:44:22', '24', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('44', '奇幻森林亲子房', '五星级', '89', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值16', '2019-04-24 09:45:12', '17', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('45', '奇幻森林亲子房', '五星级', '89', '1', 'hzq1', '2019-04-24', '1', '测试客房数量阀值17', '2019-04-24 09:45:39', '17', '是', '是');
INSERT INTO `jiudianyuding` VALUES ('46', '豪华亲子房', '五星级', '155', '1', 'hzq1', '2019-04-24', '1', '测试25', '2019-04-24 10:22:45', '25', '是', '是');

-- ----------------------------
-- Table structure for `liuyanban`
-- ----------------------------
DROP TABLE IF EXISTS `liuyanban`;
CREATE TABLE `liuyanban` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(100) DEFAULT NULL,
  `tel` varchar(11) DEFAULT NULL,
  `reply` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`,`reply`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of liuyanban
-- ----------------------------
INSERT INTO `liuyanban` VALUES ('9', 'hzq2', 'uploadfile/83.jpg', '黄泽群', '椒盐虾', '2019-04-08 21:03:10', '湛江市赤坎区岭南师范学院', '13414851033', '已收到订单，请稍等！');
INSERT INTO `liuyanban` VALUES ('12', 'hzq1', 'uploadfile/132.jpg', '张渡', '一杯珍珠奶茶、一份烧鸭饭。', '2019-04-23 14:39:55', '岭南师范学院', '13414851033', '收到！');
INSERT INTO `liuyanban` VALUES ('13', 'hzq1', 'uploadfile/132.jpg', '张渡', '黄金手扒鸡、中杯可乐', '2019-04-23 14:42:11', '新民B69', '13414851033', '马上送到');
INSERT INTO `liuyanban` VALUES ('14', 'hzq1', 'uploadfile/132.jpg', '张渡', '猪肠拼猪腩肉', '2019-04-23 14:44:01', '鸿园饭堂', '13414851033', '骑手正在配送');
INSERT INTO `liuyanban` VALUES ('15', 'hzq1', 'uploadfile/132.jpg', '张渡', '电脑电源线一条、耳机一副', '2019-04-23 14:45:41', '岭师图书馆', '13414851033', '已送达。');
INSERT INTO `liuyanban` VALUES ('16', 'hzq1', 'uploadfile/132.jpg', '张渡', '酸菜鱼（测试数据量大于5时出现分页条）', '2019-04-23 14:55:09', '世贸大厦', '13414851033', '成功分页');

-- ----------------------------
-- Table structure for `ruzhuxinxi`
-- ----------------------------
DROP TABLE IF EXISTS `ruzhuxinxi`;
CREATE TABLE `ruzhuxinxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banjihao` varchar(50) DEFAULT NULL,
  `shifadi` varchar(50) DEFAULT NULL,
  `mudedi` varchar(50) DEFAULT NULL,
  `piaojia` varchar(50) DEFAULT NULL,
  `qifeishijian` varchar(50) DEFAULT NULL,
  `beizhu` varchar(500) DEFAULT NULL,
  `leave` varchar(5) NOT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`addtime`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of ruzhuxinxi
-- ----------------------------
INSERT INTO `ruzhuxinxi` VALUES ('1', '619', '张三', '441622199501165490', '110', '2019-04-02', '张三客户入住客房备注信息。', '否', '2019-04-02 17:04:18');
INSERT INTO `ruzhuxinxi` VALUES ('2', '203', '李四', '441622100901128303', '199', '2019-03-03', '我是李四客户入住房客的备注信息。', '否', '2019-04-02 17:05:17');
INSERT INTO `ruzhuxinxi` VALUES ('3', '209', '王五', '441622100902163285', '122', '2019-03-04', '我是王五客户入住房客的备注信息。', '否', '2019-04-02 17:06:33');
INSERT INTO `ruzhuxinxi` VALUES ('4', '405', '赵六', '441622122301123469', '200', '2019-03-14', '我是赵六客户入住房客的备注信息。', '是', '2019-04-02 17:07:27');
INSERT INTO `ruzhuxinxi` VALUES ('5', '606', '黄三', '442211288401127420', '300', '2019-03-13', '我是黄三客户入住房客的备注信息。', '是', '2019-04-02 17:10:01');
INSERT INTO `ruzhuxinxi` VALUES ('6', '808', '许可', '441622199501165429', '189', '2019-02-19', '我是许可客户入住房客的备注信息。', '是', '2019-04-02 17:11:21');
INSERT INTO `ruzhuxinxi` VALUES ('7', '777', '蔡旭', '441622199501123468', '156', '2019-03-20', '我是蔡旭客户入住房客的备注信息。', '否', '2019-04-02 17:13:06');
INSERT INTO `ruzhuxinxi` VALUES ('8', '678', '钟福', '441622173693682459', '213', '2019-04-17', '我是钟福客户入住房客的备注信息。', '是', '2019-04-02 17:14:04');
INSERT INTO `ruzhuxinxi` VALUES ('9', '820', '林凯', '441622173693689428', '99', '2019-04-01', '我是林凯客户入住房客的备注信息。', '是', '2019-04-02 17:15:15');
INSERT INTO `ruzhuxinxi` VALUES ('10', '618', '郑悦', '441622173693683914', '88', '2019-04-01', '我是郑悦客户入住房客的备注信息。', '是', '2019-04-02 17:16:23');
INSERT INTO `ruzhuxinxi` VALUES ('11', '899', '彭建', '441622199501161569', '303', '2019-03-26', '我是彭建的备注信息、', '是', '2019-04-02 17:17:42');
INSERT INTO `ruzhuxinxi` VALUES ('12', '707', '黎丽', '441622173693684812', '400', '2019-02-27', '我是黎丽客户入住房客的备注信息。', '是', '2019-04-02 17:23:13');
INSERT INTO `ruzhuxinxi` VALUES ('13', '555', '陈婉', '441622199501161263', '145', '2019-03-21', '我是陈婉客户入住房客的备注信息。', '是', '2019-04-02 17:33:25');
INSERT INTO `ruzhuxinxi` VALUES ('15', '345', '刘桓', '441622177601123456', '88', '2019-04-19', '客户喜欢安静、干净的客房，请安排好。', '是', '2019-04-21 23:28:08');
INSERT INTO `ruzhuxinxi` VALUES ('16', '567', '曾华', '441622188903123470', '199', '2019-04-22', '客户喜欢装饰好看点的客房', '是', '2019-04-23 22:39:18');

-- ----------------------------
-- Table structure for `toupiaojilu`
-- ----------------------------
DROP TABLE IF EXISTS `toupiaojilu`;
CREATE TABLE `toupiaojilu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `xx` varchar(2) DEFAULT NULL,
  `addby` varchar(10) DEFAULT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of toupiaojilu
-- ----------------------------
INSERT INTO `toupiaojilu` VALUES ('6', 'B', '555', '2019-02-14 09:29:20');
INSERT INTO `toupiaojilu` VALUES ('7', 'A', '555', '2019-02-13 09:29:23');
INSERT INTO `toupiaojilu` VALUES ('8', 'A', '555', '2019-02-15 13:14:11');
INSERT INTO `toupiaojilu` VALUES ('9', 'C', '555', '2019-02-15 09:40:59');
INSERT INTO `toupiaojilu` VALUES ('10', 'D', 'fs', '2019-02-14 10:01:22');

-- ----------------------------
-- Table structure for `xinwentongzhi`
-- ----------------------------
DROP TABLE IF EXISTS `xinwentongzhi`;
CREATE TABLE `xinwentongzhi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `biaoti` varchar(500) CHARACTER SET gb2312 DEFAULT NULL,
  `leibie` varchar(50) CHARACTER SET gb2312 DEFAULT NULL,
  `neirong` text CHARACTER SET gb2312,
  `tianjiaren` varchar(50) CHARACTER SET gb2312 DEFAULT NULL,
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `shouyetupian` varchar(50) DEFAULT NULL,
  `dianjilv` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of xinwentongzhi
-- ----------------------------
INSERT INTO `xinwentongzhi` VALUES ('54', '特价大床房', '酒店优惠', '我是情情侣大床房的备情侣大床房的备侣大床情侣大床情情侣大床房的备情侣大床房的备情侣大床房的备侣大床房的备房情侣大床房的备的备房的备的备。', 'admin', '2019-03-03 22:19:59', 'uploadfile/36.jpg', '57');
INSERT INTO `xinwentongzhi` VALUES ('55', '特大优惠双人房', '酒店优惠', '特大优惠双人房包含牙膏鞋子毛巾等物品。', 'admin', '2019-04-02 15:34:47', 'uploadfile/38.jpg', '129');
INSERT INTO `xinwentongzhi` VALUES ('56', '特价双人房', '酒店优惠', '特价双人房包含衣服鞋子书桌、多种规格电源插座、房内保险箱、空调、洗衣机、针线包、220V电压插座、遮光窗帘、手动窗帘、备用床具、床具:毯子或被子、沙发、房间内高速上网、客房WIFI覆盖。', 'admin', '2019-04-02 15:38:05', 'uploadfile/39.jpg', '136');
INSERT INTO `xinwentongzhi` VALUES ('57', '温馨海景房', '酒店优惠', '该房型支持闪住服务，在订单填写页勾选“闪住服务”，即可尊享。\r\n该房型支持闪住服务，在订单填写页勾选“闪住服务”，即可尊享。\r\n离店后按您授权的支付方式自动结账，无需排队付款。\r\n离店后按您授权的支付方式自动结账，无需排队付款。', 'admin', '2019-04-02 15:45:44', 'uploadfile/40.jpg', '5');
INSERT INTO `xinwentongzhi` VALUES ('58', '豪华双拼房', '酒店优惠', '离店后按您授权的支付方式自动结账，无需排队付款。&#8226; 离店后按您授权的支付方式自动结账，无需排队付款。&#8226; 离店后按您授权的支付方式自动结账，无需排队付款。&#8226; 离店后按您授权的支付方式自动结账，无需排队付款。&#8226; 离店后按您授权的支付方式自动结账，无需排队付款。&#8226; 离店后按您授权的支付方式自动结账，无需排队付款。&#8226; 离店后按您授权的支付方式自动结账，无需排队付款。', 'admin', '2019-04-02 15:48:15', 'uploadfile/41.jpg', '137');
INSERT INTO `xinwentongzhi` VALUES ('59', '摩羯座主题房', '酒店优惠', '我是摩羯座主题房房客的内容信息。', 'admin', '2019-04-02 17:58:54', 'uploadfile/53.jpg', '106');
INSERT INTO `xinwentongzhi` VALUES ('60', '处女座主题房', '酒店优惠', '我是处女座主题房房间的内容信息。', 'admin', '2019-04-02 19:19:57', 'uploadfile/54.jpg', '44');
INSERT INTO `xinwentongzhi` VALUES ('61', '个性大床房', '酒店优惠', '我是床房我是个床房我是个性床房我是个性性个床房我是个性性大床房我是个性大床房的备床房我是个性注床房我床房我是个性是个性信息的备注信息。', 'admin', '2019-04-04 15:26:38', 'uploadfile/56.jpg', '135');
INSERT INTO `xinwentongzhi` VALUES ('62', '精选大床房', '酒店优惠', '我是精选大床房的备注信息。', 'admin', '2019-04-04 15:27:16', 'uploadfile/57.jpg', '25');
INSERT INTO `xinwentongzhi` VALUES ('63', '精选套房', '酒店优惠', '我是精选套房的备注信息。', 'admin', '2019-04-04 15:27:55', 'uploadfile/58.jpg', '89');
INSERT INTO `xinwentongzhi` VALUES ('64', '标准单人房(经济房)', '酒店优惠', '我是标准单人房(经济房)的备注信息。', 'admin', '2019-04-04 15:28:36', 'uploadfile/59.jpg', '35');
INSERT INTO `xinwentongzhi` VALUES ('65', '家庭套房', '酒店优惠', '我是家庭套房的备注信息。', 'admin', '2019-04-04 15:29:31', 'uploadfile/60.jpg', '89');
INSERT INTO `xinwentongzhi` VALUES ('66', '标准大床房(无独卫)', '酒店优惠', '我准大床房(无独卫)的备注是标准大床房(无独卫)的备注准大床房(无独卫)的备注准大床准大床房(无独卫)的备注房(无独卫)的准大床房(无独卫)的备注备注信准大床房(无独卫)的备注息。', 'admin', '2019-04-04 15:31:24', 'uploadfile/61.jpg', '46');
INSERT INTO `xinwentongzhi` VALUES ('67', '情侣大床房', '酒店优惠', '我情侣大床房的备是情情侣大床房的备情侣大情侣大床房情侣大床房的备的备床房的备情侣情侣大床房的备大床房的备侣大床情侣大床房的备房的备注信息。', 'hzq', '2019-04-04 15:32:22', 'uploadfile/62.jpg', '68');
INSERT INTO `xinwentongzhi` VALUES ('68', '特色情侣房', '酒店优惠', '我是特色情侣房的备注特色情侣房的特色情侣房的备注信备注信信息。', 'admin', '2019-04-04 15:32:53', 'uploadfile/63.jpg', '85');
INSERT INTO `xinwentongzhi` VALUES ('69', '浪漫尊享房', '酒店优惠', '我是浪漫尊备注信我是浪漫我备注信我是浪漫我享房的备注信我是浪漫我是浪备注信我是浪漫备注信我是浪漫我备注信我是浪漫我我漫尊享房的备注信我是浪漫我备备注信我是浪漫我注信我是浪漫我备注信息房的备注备注信我是浪漫我信息息。', 'admin', '2019-04-04 15:34:28', 'uploadfile/64.jpg', '146');
INSERT INTO `xinwentongzhi` VALUES ('70', '复式豪华套房', '酒店优惠', '我是是复式豪华套房的备复式豪是复式豪华是复式豪华套房的备是复式豪华套房的备套房的备华套房的备是复式豪华套房的备注信息。', 'admin', '2019-04-04 15:35:18', 'uploadfile/65.jpg', '35');
INSERT INTO `xinwentongzhi` VALUES ('71', 'mini房', '酒店优惠', '我mini房的备mini房的备注信注信是mmini房的备注信ini房的备mini房的备注信注mini房的备注mini房的备注信信信息。', 'admin', '2019-04-04 15:35:48', 'uploadfile/66.jpg', '98');
INSERT INTO `xinwentongzhi` VALUES ('72', '休闲特色房', '酒店优惠', '我是休闲特色房的备注信息。', 'admin', '2019-04-04 15:36:12', 'uploadfile/79.jpg', '61');
INSERT INTO `xinwentongzhi` VALUES ('73', '雅致影音双床房', '酒店优惠', '我是雅致影音双床房的备注信息。我是雅致影音双床房的备注信息。我是雅致影音双床房的备注信息。', 'admin', '2019-04-04 15:37:01', 'uploadfile/68.jpg', '42');
INSERT INTO `xinwentongzhi` VALUES ('74', '海景影音双床间', '酒店优惠', '我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的备注信息。我是海景影音双床间的', 'admin', '2019-04-04 15:37:45', 'uploadfile/78.jpg', '39');
INSERT INTO `xinwentongzhi` VALUES ('75', '海景影音大床房', '酒店优惠', '我是海景影音大床房的备注信息。我是海景影音大床房的备注信息。我是海景影音大床房的备注信息。', 'hzq', '2019-04-04 15:50:17', 'uploadfile/70.jpg', '31');
INSERT INTO `xinwentongzhi` VALUES ('76', '棋牌双床房', '酒店优惠', '我是棋牌双床房的备注信息。我是棋牌双床房的备注信息。我是棋牌双床房的备注信息。我是棋牌双床房的备注信息。', 'hzq', '2019-04-04 15:51:33', 'uploadfile/77.jpg', '47');
INSERT INTO `xinwentongzhi` VALUES ('77', '行政套房', '酒店优惠', '我是行政套房的备注信息。我是行政套房的备注信息。我是行政套房的备注信息。', 'hzq', '2019-04-04 15:52:24', 'uploadfile/76.jpg', '133');
INSERT INTO `xinwentongzhi` VALUES ('78', '豪华单间', '酒店新闻', '我是豪华单间的备注信息我是豪单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信华单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信息我是豪华单间的备单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信息我是豪华单间的备注信注信息。', 'admin', '2019-04-04 16:09:17', 'uploadfile/119.jpg', '100');
INSERT INTO `xinwentongzhi` VALUES ('83', '客房资讯', '酒店优惠', '客房资讯详细信息。', 'admin', '2019-04-21 22:55:18', 'uploadfile/124.jpg', '108');
INSERT INTO `xinwentongzhi` VALUES ('84', '五一特惠房', '酒店优惠', '五一放长假你准备去哪玩？我要修改系统，哪也不去。', 'admin', '2019-04-23 19:26:46', 'uploadfile/133.jpg', '88');

-- ----------------------------
-- Table structure for `yonghuzhuce`
-- ----------------------------
DROP TABLE IF EXISTS `yonghuzhuce`;
CREATE TABLE `yonghuzhuce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zhanghao` varchar(50) NOT NULL,
  `mima` varchar(50) NOT NULL,
  `xingming` varchar(50) NOT NULL,
  `xingbie` varchar(50) DEFAULT NULL,
  `diqu` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `zhaopian` varchar(50) DEFAULT NULL,
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `issh` varchar(10) DEFAULT '否',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of yonghuzhuce
-- ----------------------------
INSERT INTO `yonghuzhuce` VALUES ('12', 'hzq2', '123456', '黄泽群', '女', '肇庆市', '13414851033@163.com', 'uploadfile/83.jpg', '2019-04-23 08:38:13', '是');
INSERT INTO `yonghuzhuce` VALUES ('16', 'hzq1', '123456', '张渡', '男', '茂名市', '13414851033@163.com', 'uploadfile/132.jpg', '2019-04-18 17:38:25', '是');
INSERT INTO `yonghuzhuce` VALUES ('17', 'hzq3', '123456', '李云龙', '男', '上海市', '13414851033@163.com', 'uploadfile/131.jpg', '2019-04-14 15:38:35', '是');
INSERT INTO `yonghuzhuce` VALUES ('18', 'zhangsan', '123456', '詹三', '女', '湛江市', '13414851033@163.com', 'uploadfile/128.jpg', '2019-04-05 20:39:13', '是');
INSERT INTO `yonghuzhuce` VALUES ('20', 'lisi', '123456', '李四', '男', '东莞市', '13414851033@163.com', '', '2019-04-02 08:39:07', '是');
INSERT INTO `yonghuzhuce` VALUES ('21', 'wnagwu', '123456', '王五', '男', '佛山市', '13414851033@163.com', 'uploadfile/130.jpg', '2019-03-25 08:38:54', '是');
INSERT INTO `yonghuzhuce` VALUES ('22', 'zhaoliu', '123456', '赵六', '女', '云浮市', '13414851033@163.com', 'uploadfile/129.jpg', '2019-03-21 08:38:48', '是');

-- ----------------------------
-- Table structure for `youqinglianjie`
-- ----------------------------
DROP TABLE IF EXISTS `youqinglianjie`;
CREATE TABLE `youqinglianjie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wangzhanmingcheng` varchar(50) DEFAULT NULL,
  `wangzhi` varchar(50) DEFAULT NULL,
  `addtime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of youqinglianjie
-- ----------------------------
INSERT INTO `youqinglianjie` VALUES ('11', '中国联通', 'http://www.by960.cn', '2019-03-21 14:47:19');
INSERT INTO `youqinglianjie` VALUES ('12', '中国网易', 'http://www.zgyimin.cn', '2019-03-21 13:11:13');
INSERT INTO `youqinglianjie` VALUES ('13', '中国新浪', 'http://www.bisow.cn', '2019-03-21 14:47:45');
INSERT INTO `youqinglianjie` VALUES ('14', '中国雅虎', 'http://www.ccbysj.cn', '2019-03-21 14:47:57');
INSERT INTO `youqinglianjie` VALUES ('15', '阿里巴巴中国', 'http://www.zgziliao.cn', '2019-03-22 14:48:15');

-- ----------------------------
-- Table structure for `yuangongxinxi`
-- ----------------------------
DROP TABLE IF EXISTS `yuangongxinxi`;
CREATE TABLE `yuangongxinxi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bianhao` varchar(50) DEFAULT NULL,
  `mingcheng` varchar(300) DEFAULT NULL,
  `chufadi` varchar(50) DEFAULT NULL,
  `mudedi` varchar(50) DEFAULT NULL,
  `chuxingshijian` varchar(50) DEFAULT NULL,
  `jiage` varchar(50) DEFAULT NULL,
  `chuxingshichang` varchar(50) DEFAULT NULL,
  `jiaotonggongju` varchar(50) DEFAULT NULL,
  `beizhu` varchar(500) DEFAULT NULL,
  `addtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=gb2312;

-- ----------------------------
-- Records of yuangongxinxi
-- ----------------------------
INSERT INTO `yuangongxinxi` VALUES ('1', '2015354129', '张三', '湛江市', '441622199501165490', '2019-03-02', '4.5K', '无', '服务员', '备注备注备注备注备注备注备注备注备注备注备注备注备注备', '2019-04-02 15:54:24');
INSERT INTO `yuangongxinxi` VALUES ('2', '2015354138', '李四', '肇庆市', '441622199501165499', '2019-04-02', '5.5K', '3年', '厨师', '我是备注备注', '2019-04-02 15:55:57');
INSERT INTO `yuangongxinxi` VALUES ('3', '2015354137', '王五', '惠州市', '441622199501162389', '2019-03-13', '9.0K', '1年', '经理', '我是入职的经理。', '2019-04-02 15:57:08');
INSERT INTO `yuangongxinxi` VALUES ('4', '2015354123', '赵六', '广州市', '441622199501172349', '2019-04-18', '4.9K', '无', '勤杂工', '我是勤杂工的备注。', '2019-04-02 16:00:37');
INSERT INTO `yuangongxinxi` VALUES ('5', '2015354189', '张八', '深圳市', '441622199501127690', '2019-04-05', '8.0K', '半年', '厨师', '我是张八厨师的备注信息。', '2019-04-02 16:03:05');
INSERT INTO `yuangongxinxi` VALUES ('6', '2015354170', '李九', '上海市', '441622199501287420', '2019-01-01', '2.5K', '无', '服务员', '我是李九服务员的备注信息', '2019-04-02 16:04:21');
INSERT INTO `yuangongxinxi` VALUES ('7', '2015354169', '王十', '北京市', '441622199502841035', '2019-02-02', '7K', '2年', '勤杂工', '我是王十员工的备注信息。', '2019-04-02 16:06:41');
INSERT INTO `yuangongxinxi` VALUES ('8', '2015354119', '黄中', '佛山市', '441622199501162392', '2019-03-23', '6.2K', '1年', '服务员', '我是黄中员工的备注信息。', '2019-04-02 16:14:21');
INSERT INTO `yuangongxinxi` VALUES ('9', '2015354112', '黄悦', '惠州市', '44162219921128421', '2019-04-01', '25K', '4年', '厨师', '我是黄悦厨师员工的备注信息。', '2019-04-02 16:16:29');
INSERT INTO `yuangongxinxi` VALUES ('10', '2015348194', '张图', '顺德市', '441622199201382380', '2019-03-12', '4.8K', '1年', '勤杂工', '我是战张图勤杂工的员工信息备注', '2019-04-02 16:18:13');
INSERT INTO `yuangongxinxi` VALUES ('12', '2015325127', '吴狄', '茂名市', '441622173693685672', '2018-03-13', '3.9K', '2年', '服务员', '我是吴狄服务员员工的备注信息', '2019-04-02 16:23:03');
INSERT INTO `yuangongxinxi` VALUES ('13', '2015354117', '陈生', '湛江市', '441633288410932345', '2019-02-25', '20.0K', '2年', '经理', '我是陈生经理员工的备注信息。', '2019-04-02 16:55:01');
INSERT INTO `yuangongxinxi` VALUES ('14', '2015354235', '刘诗', '惠州市', '441622133423460934', '2019-03-11', '9.9K', '1年', '服务员', '我是刘诗服务员员工的备注信息。', '2019-04-02 16:58:17');
INSERT INTO `yuangongxinxi` VALUES ('27', '2015354122', '赵航', '云浮市', '441622199501165493', '2019-04-18', '4.5K', '1年', '经理', '我是赵航的备注信息。。', '2019-04-20 00:27:24');
INSERT INTO `yuangongxinxi` VALUES ('29', '2015354113', '欧阳灿', '河源市', '441622144501123457', '2019-04-20', '4.5K', '半年', '服务员', '此员工有曾在某酒店工作半年。', '2019-04-21 23:13:43');
INSERT INTO `yuangongxinxi` VALUES ('30', '2015354149', '曲谷', '湛江市', '441622133710038590', '2019-04-23', '9.9K', '一年', '经理', '曾担任公司主管一年', '2019-04-23 21:41:08');
