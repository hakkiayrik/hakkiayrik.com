/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : hakkiayrik

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2018-01-17 23:59:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ha_categories`
-- ----------------------------
DROP TABLE IF EXISTS `ha_categories`;
CREATE TABLE `ha_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `short_description` varchar(250) DEFAULT NULL,
  `url_key` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ha_categories
-- ----------------------------
INSERT INTO `ha_categories` VALUES ('1', 'PHP', 'Lorem ipsum sit a met', '/php');
INSERT INTO `ha_categories` VALUES ('2', 'CSS', 'Lorem ipsum sit a met', '/css');
INSERT INTO `ha_categories` VALUES ('3', 'HTML', 'Lorem ipsum sit a met', '/html');

-- ----------------------------
-- Table structure for `ha_posts`
-- ----------------------------
DROP TABLE IF EXISTS `ha_posts`;
CREATE TABLE `ha_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `like_count` int(11) NOT NULL DEFAULT '0',
  `dislike_count` int(11) NOT NULL DEFAULT '0',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `image_path` varchar(255) DEFAULT NULL,
  `tag_ids` varchar(255) NOT NULL,
  `cat_ids` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ha_posts
-- ----------------------------
INSERT INTO `ha_posts` VALUES ('9', '1', 'Lorem Ipsum', '<p><strong>Lorem ipsum sit a met</strong></p>\r\n\r\n<p><em><span style=\"color:#c0392b\">Lorem ipsum sit a met</span></em></p>\r\n\r\n<p><u>Lorem ipsum sit a met</u></p>\r\n', '1', '0', '0', '2018-01-16 00:20:58', '2018-01-16 00:20:58', null, '6,5,7', '1,2');
INSERT INTO `ha_posts` VALUES ('11', '1', 'asdasdasd dsdsdsad asasdsad', '<p><s>asdas dsad</s> <em>asdasdsa </em><strong>dasdasdasdsa dsadasdsadsa</strong></p>\r\n', '1', '0', '0', '2018-01-17 23:57:52', '2018-01-17 23:57:52', null, '9,10', '1,2,3');
INSERT INTO `ha_posts` VALUES ('12', '1', 'Merhaba Arkadaşlar', '<p><strong>Merhaba Arkadaşlar,</strong></p>\r\n\r\n<p>Bu benim ilk yazım ve umarım son yazım olmaz :). Bu alanda sizlerle bildiğim &ouml;ğrendiğim şeyleri paylaşmak i&ccedil;in &ccedil;aba g&ouml;stereceğim. Sizlerinde desteği ile genişleyen bir blog sayfası ', '1', '0', '0', '2018-01-17 23:02:51', '2018-01-17 23:02:51', null, '11,12,7', '1');

-- ----------------------------
-- Table structure for `ha_tags`
-- ----------------------------
DROP TABLE IF EXISTS `ha_tags`;
CREATE TABLE `ha_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `description` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ha_tags
-- ----------------------------
INSERT INTO `ha_tags` VALUES ('1', 'php', null);
INSERT INTO `ha_tags` VALUES ('2', 'css', null);
INSERT INTO `ha_tags` VALUES ('3', 'html', null);
INSERT INTO `ha_tags` VALUES ('4', 'javascript', null);
INSERT INTO `ha_tags` VALUES ('5', 'deneme', null);
INSERT INTO `ha_tags` VALUES ('6', 'lorem', null);
INSERT INTO `ha_tags` VALUES ('7', 'test', null);
INSERT INTO `ha_tags` VALUES ('8', 'mysql', 'Mysql Komutları ve Kullanımları');
INSERT INTO `ha_tags` VALUES ('9', 'lalalalala', null);
INSERT INTO `ha_tags` VALUES ('10', 'lilili', null);
INSERT INTO `ha_tags` VALUES ('11', 'selam', null);
INSERT INTO `ha_tags` VALUES ('12', 'ilk yazı', null);

-- ----------------------------
-- Table structure for `ha_users`
-- ----------------------------
DROP TABLE IF EXISTS `ha_users`;
CREATE TABLE `ha_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(16) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `last_entry` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`,`user_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ha_users
-- ----------------------------
INSERT INTO `ha_users` VALUES ('1', 'hakkı', 'ayrık', 'admin', '12345', '1', '2018-01-09 00:23:08', '2018-01-17 23:43:02', '2018-01-09 00:23:08');
