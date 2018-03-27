/*
Navicat MySQL Data Transfer

Source Server         : mysql
Source Server Version : 50540
Source Host           : localhost:3306
Source Database       : shopping

Target Server Type    : MYSQL
Target Server Version : 50540
File Encoding         : 65001

Date: 2018-03-25 18:56:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_admin
-- ----------------------------
DROP TABLE IF EXISTS `shop_admin`;
CREATE TABLE `shop_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `sort` int(1) NOT NULL DEFAULT '1',
  `role_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf32;

-- ----------------------------
-- Records of shop_admin
-- ----------------------------
INSERT INTO `shop_admin` VALUES ('1', 'aaaaaa', '123456', '1', '1', '1521011947', '1521011947');
INSERT INTO `shop_admin` VALUES ('2', 'bbbbbb', '123456', '1', '2', '1521011947', '1521011947');
INSERT INTO `shop_admin` VALUES ('3', 'ccccccc', '123456', '1', '2', '1521011947', '1521011947');
INSERT INTO `shop_admin` VALUES ('4', 'dddddd', '111111', '1', '4', '1521011947', '1521011947');
INSERT INTO `shop_admin` VALUES ('5', 'eeeeee', '30d8e5a407d7ecb4868387cc3529f6b9', '1', '1', '1521012237', '1521012237');
INSERT INTO `shop_admin` VALUES ('8', 'admin1111', '074fd28eff0f5adea071694061739e55', '1', '5', '1521016317', '1521016317');
INSERT INTO `shop_admin` VALUES ('9', 'admin3222', '17e94cd7242c7f3b9022eacf5855fe91', '1', '2', '1521016607', '1521017024');
INSERT INTO `shop_admin` VALUES ('10', 'admin22222', '7c497868c9e6d3e4cf2e87396372cd3b', '1', '2', '1521093795', '1521093795');
INSERT INTO `shop_admin` VALUES ('11', 'admin55555', '0687b8866cf13d6eeed51336cfc0365c', '1', '1', '1521095164', '1521095164');
INSERT INTO `shop_admin` VALUES ('12', 'admin66666', 'e823be777ac3d8b1052e62c96c965049', '1', '3', '1521095556', '1521095556');
INSERT INTO `shop_admin` VALUES ('13', 'admin444444', 'e8360051233c63e47c98545f9e2baae2', '1', '6', '1521095600', '1521095600');

-- ----------------------------
-- Table structure for shop_brand
-- ----------------------------
DROP TABLE IF EXISTS `shop_brand`;
CREATE TABLE `shop_brand` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `site` varchar(255) NOT NULL,
  `sort` int(1) NOT NULL DEFAULT '0',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf32;

-- ----------------------------
-- Records of shop_brand
-- ----------------------------
INSERT INTO `shop_brand` VALUES ('1', '苹果', 'http://localhost/shopping/public/uploads/20180314\\0b7810955cb1de4351ba0b68f9fb5622.jpg', 'http://apple.com', '0', '1521026958', '1521026958');
INSERT INTO `shop_brand` VALUES ('3', '小米', 'http://localhost/shopping/public/uploads/20180314\\94f06a4954314e32e6b4ad3f2f0f50b7.jpg', 'http://mi.com', '0', '1521027832', '1521027832');
INSERT INTO `shop_brand` VALUES ('4', '华为', 'http://localhost/shopping/public/uploads/20180314\\0c5ff0eec13452c400db899da4b12576.jpg', 'http://huawei.com', '0', '1521028535', '1521028535');
INSERT INTO `shop_brand` VALUES ('5', '红米', 'http://localhost/shopping/public/uploads/20180314\\1cc5b94a1230d225531a58cf0096af0a.jpg', 'http://Hongmi.com', '0', '1521030061', '1521030061');

-- ----------------------------
-- Table structure for shop_power
-- ----------------------------
DROP TABLE IF EXISTS `shop_power`;
CREATE TABLE `shop_power` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `controller` varchar(20) NOT NULL,
  `action` varchar(20) NOT NULL,
  `is_show` int(1) NOT NULL DEFAULT '1' COMMENT '1-显示   2-不显示',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf32;

-- ----------------------------
-- Records of shop_power
-- ----------------------------
INSERT INTO `shop_power` VALUES ('1', '系统管理', 'admin', 'index', '1', '1521526357', '1521526357', '0');
INSERT INTO `shop_power` VALUES ('2', '商品管理', 'shop', 'index', '1', '1521526403', '1521526403', '0');
INSERT INTO `shop_power` VALUES ('4', '角色管理', 'role', 'index', '1', '1521526446', '1521526446', '1');
INSERT INTO `shop_power` VALUES ('5', '权限管理', 'power', 'index', '1', '1521526463', '1521526463', '0');
INSERT INTO `shop_power` VALUES ('6', '系统首页', 'index', 'index', '1', '1521526579', '1521526579', '0');
INSERT INTO `shop_power` VALUES ('7', '品牌管理', 'brand', 'index', '1', '1521526629', '1521526629', '2');
INSERT INTO `shop_power` VALUES ('9', '管理员修改', 'admin', 'edit', '2', '1521526818', '1521526818', '3');
INSERT INTO `shop_power` VALUES ('10', '管理员删除', 'admin', 'delete', '2', '1521526849', '1521526849', '3');
INSERT INTO `shop_power` VALUES ('11', '权限添加', 'power', 'add', '2', '1521526873', '1521526873', '6');
INSERT INTO `shop_power` VALUES ('12', '添加下一级', 'power', 'addchild', '2', '1521526912', '1521526912', '6');
INSERT INTO `shop_power` VALUES ('13', '品牌添加', 'brand', 'add', '1', '1521535017', '1521535017', '7');
INSERT INTO `shop_power` VALUES ('14', '管理员列表', 'admin', 'index', '2', '1521597703', '1521597703', '3');
INSERT INTO `shop_power` VALUES ('15', '角色添加', 'role', 'add', '1', '1521598471', '1521598471', '4');
INSERT INTO `shop_power` VALUES ('16', '角色修改', 'role', 'update', '1', '1521598491', '1521598491', '4');
INSERT INTO `shop_power` VALUES ('17', '角色删除', 'role', 'delete', '1', '1521598510', '1521598510', '4');
INSERT INTO `shop_power` VALUES ('18', '品牌修改', 'brand', 'update', '1', '1521598597', '1521598597', '7');
INSERT INTO `shop_power` VALUES ('19', '品牌删除', 'brand', 'delete', '1', '1521598618', '1521598618', '7');
INSERT INTO `shop_power` VALUES ('21', '分类管理', 'type', 'index', '1', '1521688472', '1521688472', '2');
INSERT INTO `shop_power` VALUES ('27', '商品管理', 'product', 'index', '1', '1521776375', '1521776375', '2');

-- ----------------------------
-- Table structure for shop_products
-- ----------------------------
DROP TABLE IF EXISTS `shop_products`;
CREATE TABLE `shop_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '商品名称',
  `upc` varchar(255) NOT NULL COMMENT '通用代码',
  `image` varchar(255) NOT NULL,
  `image_thumb` varchar(255) NOT NULL COMMENT '缩略图',
  `quantity` int(11) NOT NULL COMMENT '库存',
  `sku_id` int(11) NOT NULL COMMENT '库存单位',
  `stock_status_id` int(11) NOT NULL COMMENT '库存状态',
  `is_subtract` tinyint(4) NOT NULL COMMENT '扣减库存',
  `minimum` int(11) NOT NULL COMMENT '最少起送',
  `price` decimal(11,2) NOT NULL COMMENT '售价',
  `price_origin` decimal(11,2) NOT NULL COMMENT '成本',
  `is_shipping` tinyint(4) NOT NULL COMMENT '是否支持配送',
  `date_available` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '起售时间',
  `length` int(11) NOT NULL COMMENT '长',
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `lenght_unit_id` int(11) NOT NULL COMMENT '面积单位',
  `weight` int(11) NOT NULL,
  `weight_unit_id` int(11) NOT NULL COMMENT '重量单位',
  `is_sale` tinyint(4) NOT NULL COMMENT '是否上架',
  `productDesc` text NOT NULL COMMENT '描述',
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL COMMENT '类型',
  `attribute_group_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `static_url` varchar(255) NOT NULL COMMENT '图片地址',
  `admin_id` int(11) NOT NULL COMMENT '创建管理员Id',
  `meta_title` varchar(255) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(1024) NOT NULL COMMENT '描述',
  `sort` int(11) NOT NULL COMMENT '排序',
  `delete_time` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `update_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf32 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of shop_products
-- ----------------------------

-- ----------------------------
-- Table structure for shop_role
-- ----------------------------
DROP TABLE IF EXISTS `shop_role`;
CREATE TABLE `shop_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(33) NOT NULL,
  `description` varchar(33) NOT NULL COMMENT '描述',
  `is_super` int(1) NOT NULL DEFAULT '1' COMMENT '1-否  2-是',
  `sort` int(1) NOT NULL DEFAULT '0',
  `create_time` int(11) DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf32;

-- ----------------------------
-- Records of shop_role
-- ----------------------------
INSERT INTO `shop_role` VALUES ('1', '超级管理员', '超级管理员11', '2', '0', '1521020389', '1521020429');
INSERT INTO `shop_role` VALUES ('2', '管理员', '管理员ddd', '2', '0', '1521020389', '1521020389');
INSERT INTO `shop_role` VALUES ('3', '理货员', '理货员', '1', '0', '1521020389', '1521020389');
INSERT INTO `shop_role` VALUES ('4', '发货员', '发货员', '1', '0', '1521020389', '1521020389');
INSERT INTO `shop_role` VALUES ('5', '柜台管理员', '柜台管理员', '1', '0', '1521020389', '1521020389');
INSERT INTO `shop_role` VALUES ('6', '发票员', '发票员113', '2', '0', '1521020389', '1521020389');
INSERT INTO `shop_role` VALUES ('7', '收银员', '收银员', '1', '0', '1521973760', '1521973760');

-- ----------------------------
-- Table structure for shop_role_power
-- ----------------------------
DROP TABLE IF EXISTS `shop_role_power`;
CREATE TABLE `shop_role_power` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `power_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf32;

-- ----------------------------
-- Records of shop_role_power
-- ----------------------------
INSERT INTO `shop_role_power` VALUES ('120', '1', '2');
INSERT INTO `shop_role_power` VALUES ('121', '3', '2');
INSERT INTO `shop_role_power` VALUES ('122', '8', '2');
INSERT INTO `shop_role_power` VALUES ('123', '9', '2');
INSERT INTO `shop_role_power` VALUES ('124', '10', '2');
INSERT INTO `shop_role_power` VALUES ('125', '14', '2');
INSERT INTO `shop_role_power` VALUES ('126', '5', '2');
INSERT INTO `shop_role_power` VALUES ('127', '1', '4');
INSERT INTO `shop_role_power` VALUES ('128', '3', '4');
INSERT INTO `shop_role_power` VALUES ('129', '8', '4');
INSERT INTO `shop_role_power` VALUES ('130', '9', '4');
INSERT INTO `shop_role_power` VALUES ('131', '10', '4');
INSERT INTO `shop_role_power` VALUES ('132', '4', '4');
INSERT INTO `shop_role_power` VALUES ('133', '2', '4');
INSERT INTO `shop_role_power` VALUES ('134', '7', '4');
INSERT INTO `shop_role_power` VALUES ('135', '13', '4');
INSERT INTO `shop_role_power` VALUES ('136', '5', '4');
INSERT INTO `shop_role_power` VALUES ('137', '6', '4');
INSERT INTO `shop_role_power` VALUES ('138', '11', '4');
INSERT INTO `shop_role_power` VALUES ('139', '12', '4');
INSERT INTO `shop_role_power` VALUES ('172', '1', '1');
INSERT INTO `shop_role_power` VALUES ('173', '4', '1');
INSERT INTO `shop_role_power` VALUES ('174', '15', '1');
INSERT INTO `shop_role_power` VALUES ('175', '16', '1');
INSERT INTO `shop_role_power` VALUES ('176', '17', '1');
INSERT INTO `shop_role_power` VALUES ('177', '2', '1');
INSERT INTO `shop_role_power` VALUES ('178', '7', '1');
INSERT INTO `shop_role_power` VALUES ('179', '13', '1');
INSERT INTO `shop_role_power` VALUES ('180', '18', '1');
INSERT INTO `shop_role_power` VALUES ('181', '19', '1');
INSERT INTO `shop_role_power` VALUES ('182', '21', '1');
INSERT INTO `shop_role_power` VALUES ('183', '27', '1');
INSERT INTO `shop_role_power` VALUES ('184', '5', '1');
INSERT INTO `shop_role_power` VALUES ('185', '6', '1');
INSERT INTO `shop_role_power` VALUES ('186', '11', '1');

-- ----------------------------
-- Table structure for shop_type
-- ----------------------------
DROP TABLE IF EXISTS `shop_type`;
CREATE TABLE `shop_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `create_time` int(20) NOT NULL,
  `update_time` int(20) NOT NULL,
  `sort` varchar(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf32;

-- ----------------------------
-- Records of shop_type
-- ----------------------------
INSERT INTO `shop_type` VALUES ('1', '图书', '1521690723', '1521690723', '1', '0');
INSERT INTO `shop_type` VALUES ('2', '手机', '1521690757', '1521690757', '1', '0');
INSERT INTO `shop_type` VALUES ('3', '家具', '1521691022', '1521691022', '1', '0');
INSERT INTO `shop_type` VALUES ('4', '惊悚', '1521691039', '1521691039', '3', '1');
INSERT INTO `shop_type` VALUES ('5', '国产手机', '1521691087', '1521691087', '2', '2');
INSERT INTO `shop_type` VALUES ('6', 'oppo', '1521691127', '1521691127', '2', '5');
INSERT INTO `shop_type` VALUES ('7', '言情', '1521700125', '1521700125', '2', '1');
INSERT INTO `shop_type` VALUES ('8', '华为', '1521706439', '1521706439', '3', '5');
