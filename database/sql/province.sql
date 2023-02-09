/*
 Navicat Premium Data Transfer

 Source Server         : MySQL
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : restaurant

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 26/09/2022 08:29:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of provinces
-- ----------------------------
INSERT INTO `provinces` VALUES (1, 'Thành phố Hà Nội', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (2, 'Tỉnh Hà Giang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (4, 'Tỉnh Cao Bằng', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (6, 'Tỉnh Bắc Kạn', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (8, 'Tỉnh Tuyên Quang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (10, 'Tỉnh Lào Cai', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (11, 'Tỉnh Điện Biên', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (12, 'Tỉnh Lai Châu', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (14, 'Tỉnh Sơn La', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (15, 'Tỉnh Yên Bái', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (17, 'Tỉnh Hoà Bình', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (19, 'Tỉnh Thái Nguyên', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (20, 'Tỉnh Lạng Sơn', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (22, 'Tỉnh Quảng Ninh', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (24, 'Tỉnh Bắc Giang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (25, 'Tỉnh Phú Thọ', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (26, 'Tỉnh Vĩnh Phúc', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (27, 'Tỉnh Bắc Ninh', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (30, 'Tỉnh Hải Dương', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (31, 'Thành phố Hải Phòng', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (33, 'Tỉnh Hưng Yên', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (34, 'Tỉnh Thái Bình', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (35, 'Tỉnh Hà Nam', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (36, 'Tỉnh Nam Định', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (37, 'Tỉnh Ninh Bình', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (38, 'Tỉnh Thanh Hóa', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (40, 'Tỉnh Nghệ An', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (42, 'Tỉnh Hà Tĩnh', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (44, 'Tỉnh Quảng Bình', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (45, 'Tỉnh Quảng Trị', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (46, 'Tỉnh Thừa Thiên Huế', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (48, 'Thành phố Đà Nẵng', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (49, 'Tỉnh Quảng Nam', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (51, 'Tỉnh Quảng Ngãi', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (52, 'Tỉnh Bình Định', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (54, 'Tỉnh Phú Yên', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (56, 'Tỉnh Khánh Hòa', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (58, 'Tỉnh Ninh Thuận', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (60, 'Tỉnh Bình Thuận', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (62, 'Tỉnh Kon Tum', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (64, 'Tỉnh Gia Lai', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (66, 'Tỉnh Đắk Lắk', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (67, 'Tỉnh Đắk Nông', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (68, 'Tỉnh Lâm Đồng', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (70, 'Tỉnh Bình Phước', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (72, 'Tỉnh Tây Ninh', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (74, 'Tỉnh Bình Dương', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (75, 'Tỉnh Đồng Nai', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (77, 'Tỉnh Bà Rịa - Vũng Tàu', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (79, 'Thành phố Hồ Chí Minh', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (80, 'Tỉnh Long An', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (82, 'Tỉnh Tiền Giang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (83, 'Tỉnh Bến Tre', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (84, 'Tỉnh Trà Vinh', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (86, 'Tỉnh Vĩnh Long', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (87, 'Tỉnh Đồng Tháp', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (89, 'Tỉnh An Giang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (91, 'Tỉnh Kiên Giang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (92, 'Thành phố Cần Thơ', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (93, 'Tỉnh Hậu Giang', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (94, 'Tỉnh Sóc Trăng', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (95, 'Tỉnh Bạc Liêu', '2022-02-25 14:44:28', '2022-02-25 14:44:28');
INSERT INTO `provinces` VALUES (96, 'Tỉnh Cà Mau', '2022-02-25 14:44:28', '2022-02-25 14:44:28');

SET FOREIGN_KEY_CHECKS = 1;
