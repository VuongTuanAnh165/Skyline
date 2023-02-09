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

 Date: 28/09/2022 14:15:42
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for banks
-- ----------------------------
DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shortName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `transferSupported` int(11) NOT NULL,
  `lookupSupported` int(11) NOT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `support` int(11) NULL DEFAULT NULL,
  `isTransfer` int(11) NULL DEFAULT NULL,
  `swift_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of banks
-- ----------------------------
INSERT INTO `banks` VALUES (1, 'Ngân hàng TMCP An Bình', 'ABB', '970425', 'ABBANK', 'https://api.vietqr.io/img/ABB.png', 1, 1, 'ABBANK', 3, 1, 'ABBKVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (2, 'Ngân hàng TMCP Á Châu', 'ACB', '970416', 'ACB', 'https://api.vietqr.io/img/ACB.png', 1, 1, 'ACB', 3, 1, 'ASCBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (3, 'Ngân hàng TMCP Bắc Á', 'BAB', '970409', 'BacABank', 'https://api.vietqr.io/img/BAB.png', 1, 1, 'BacABank', 3, 1, 'NASCVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (4, 'Ngân hàng TMCP Đầu tư và Phát triển Việt Nam', 'BIDV', '970418', 'BIDV', 'https://api.vietqr.io/img/BIDV.png', 1, 1, 'BIDV', 3, 1, 'BIDVVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (5, 'Ngân hàng TMCP Bảo Việt', 'BVB', '970438', 'BaoVietBank', 'https://api.vietqr.io/img/BVB.png', 1, 1, 'BaoVietBank', 3, 1, 'BVBVVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (6, 'Ngân hàng Thương mại TNHH MTV Xây dựng Việt Nam', 'CBB', '970444', 'CBBank', 'https://api.vietqr.io/img/CBB.png', 0, 0, 'CBBank', 0, 0, 'GTBAVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (7, 'Ngân hàng TNHH MTV CIMB Việt Nam', 'CIMB', '422589', 'CIMB', 'https://api.vietqr.io/img/CIMB.png', 1, 1, 'CIMB', 0, 1, 'CIBBVNVN', NULL, NULL);
INSERT INTO `banks` VALUES (8, 'DBS Bank Ltd - Chi nhánh Thành phố Hồ Chí Minh', 'DBS', '796500', 'DBSBank', 'https://api.vietqr.io/img/DBS.png', 0, 0, 'DBSBank', 0, 0, 'DBSSVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (9, 'Ngân hàng TMCP Đông Á', 'DOB', '970406', 'DongABank', 'https://api.vietqr.io/img/DOB.png', 0, 1, 'DongABank', 0, 0, 'EACBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (10, 'Ngân hàng TMCP Xuất Nhập khẩu Việt Nam', 'EIB', '970431', 'Eximbank', 'https://api.vietqr.io/img/EIB.png', 1, 1, 'Eximbank', 3, 1, 'EBVIVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (11, 'Ngân hàng Thương mại TNHH MTV Dầu Khí Toàn Cầu', 'GPB', '970408', 'GPBank', 'https://api.vietqr.io/img/GPB.png', 0, 1, 'GPBank', 0, 0, 'GBNKVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (12, 'Ngân hàng TMCP Phát triển Thành phố Hồ Chí Minh', 'HDB', '970437', 'HDBank', 'https://api.vietqr.io/img/HDB.png', 1, 1, 'HDBank', 3, 1, 'HDBCVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (13, 'Ngân hàng TNHH MTV Hong Leong Việt Nam', 'HLBVN', '970442', 'HongLeong', 'https://api.vietqr.io/img/HLBVN.png', 0, 0, 'HongLeong', 0, 0, 'HLBBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (14, 'Ngân hàng TNHH MTV HSBC (Việt Nam)', 'HSBC', '458761', 'HSBC', 'https://api.vietqr.io/img/HSBC.png', 0, 1, 'HSBC', 0, 0, 'HSBCVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (15, 'Ngân hàng Công nghiệp Hàn Quốc - Chi nhánh Hà Nội', 'IBK - HN', '970455', 'IBKHN', 'https://api.vietqr.io/img/IBK.png', 0, 0, 'IBKHN', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (16, 'Ngân hàng Công nghiệp Hàn Quốc - Chi nhánh TP. Hồ Chí Minh', 'IBK - HCM', '970456', 'IBKHCM', 'https://api.vietqr.io/img/IBK.png', 0, 0, 'IBKHCM', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (17, 'Ngân hàng TMCP Công thương Việt Nam', 'ICB', '970415', 'VietinBank', 'https://api.vietqr.io/img/ICB.png', 1, 1, 'VietinBank', 3, 1, 'ICBVVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (18, 'Ngân hàng TNHH Indovina', 'IVB', '970434', 'IndovinaBank', 'https://api.vietqr.io/img/IVB.png', 0, 1, 'IndovinaBank', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (19, 'Ngân hàng TMCP Kiên Long', 'KLB', '970452', 'KienLongBank', 'https://api.vietqr.io/img/KLB.png', 1, 1, 'KienLongBank', 3, 1, 'KLBKVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (20, 'Ngân hàng TMCP Bưu Điện Liên Việt', 'LPB', '970449', 'LienVietPostBank', 'https://api.vietqr.io/img/LPB.png', 1, 1, 'LienVietPostBank', 3, 1, 'LVBKVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (21, 'Ngân hàng TMCP Quân đội', 'MB', '970422', 'MBBank', 'https://api.vietqr.io/img/MB.png', 1, 1, 'MBBank', 3, 1, 'MSCBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (22, 'Ngân hàng TMCP Hàng Hải', 'MSB', '970426', 'MSB', 'https://api.vietqr.io/img/MSB.png', 1, 1, 'MSB', 3, 1, 'MCOBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (23, 'Ngân hàng TMCP Nam Á', 'NAB', '970428', 'NamABank', 'https://api.vietqr.io/img/NAB.png', 1, 1, 'NamABank', 3, 1, 'NAMAVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (24, 'Ngân hàng TMCP Quốc Dân', 'NCB', '970419', 'NCB', 'https://api.vietqr.io/img/NCB.png', 1, 1, 'NCB', 3, 1, 'NVBAVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (25, 'Ngân hàng Nonghyup - Chi nhánh Hà Nội', 'NHB HN', '801011', 'Nonghyup', 'https://api.vietqr.io/img/NHB.png', 0, 0, 'Nonghyup', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (26, 'Ngân hàng TMCP Phương Đông', 'OCB', '970448', 'OCB', 'https://api.vietqr.io/img/OCB.png', 1, 1, 'OCB', 3, 1, 'ORCOVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (27, 'Ngân hàng Thương mại TNHH MTV Đại Dương', 'Oceanbank', '970414', 'Oceanbank', 'https://api.vietqr.io/img/OCEANBANK.png', 1, 1, 'Oceanbank', 3, 1, 'OCBKUS3M', NULL, NULL);
INSERT INTO `banks` VALUES (28, 'Ngân hàng TNHH MTV Public Việt Nam', 'PBVN', '970439', 'PublicBank', 'https://api.vietqr.io/img/PBVN.png', 0, 1, 'PublicBank', 0, 0, 'VIDPVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (29, 'Ngân hàng TMCP Xăng dầu Petrolimex', 'PGB', '970430', 'PGBank', 'https://api.vietqr.io/img/PGB.png', 1, 1, 'PGBank', 3, 1, 'PGBLVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (30, 'Ngân hàng TMCP Đại Chúng Việt Nam', 'PVCB', '970412', 'PVcomBank', 'https://api.vietqr.io/img/PVCB.png', 1, 1, 'PVcomBank', 3, 1, 'WBVNVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (31, 'Ngân hàng TMCP Sài Gòn', 'SCB', '970429', 'SCB', 'https://api.vietqr.io/img/SCB.png', 1, 1, 'SCB', 3, 1, 'SACLVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (32, 'Ngân hàng TNHH MTV Standard Chartered Bank Việt Nam', 'SCVN', '970410', 'StandardChartered', 'https://api.vietqr.io/img/SCVN.png', 0, 1, 'StandardChartered', 0, 0, 'SCBLVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (33, 'Ngân hàng TMCP Đông Nam Á', 'SEAB', '970440', 'SeABank', 'https://api.vietqr.io/img/SEAB.png', 1, 1, 'SeABank', 3, 1, 'SEAVVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (34, 'Ngân hàng TMCP Sài Gòn Công Thương', 'SGICB', '970400', 'SaigonBank', 'https://api.vietqr.io/img/SGICB.png', 1, 1, 'SaigonBank', 3, 1, 'SBITVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (35, 'Ngân hàng TMCP Sài Gòn - Hà Nội', 'SHB', '970443', 'SHB', 'https://api.vietqr.io/img/SHB.png', 1, 1, 'SHB', 3, 1, 'SHBAVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (36, 'Ngân hàng TMCP Sài Gòn Thương Tín', 'STB', '970403', 'Sacombank', 'https://api.vietqr.io/img/STB.png', 1, 1, 'Sacombank', 3, 1, 'SGTTVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (37, 'Ngân hàng TNHH MTV Shinhan Việt Nam', 'SHBVN', '970424', 'ShinhanBank', 'https://api.vietqr.io/img/SHBVN.png', 1, 1, 'ShinhanBank', 3, 1, 'SHBKVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (38, 'Ngân hàng TMCP Kỹ thương Việt Nam', 'TCB', '970407', 'Techcombank', 'https://api.vietqr.io/img/TCB.png', 1, 1, 'Techcombank', 3, 1, 'VTCBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (39, 'Ngân hàng TMCP Tiên Phong', 'TPB', '970423', 'TPBank', 'https://api.vietqr.io/img/TPB.png', 1, 1, 'TPBank', 3, 1, 'TPBVVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (40, 'Ngân hàng United Overseas - Chi nhánh TP. Hồ Chí Minh', 'UOB', '970458', 'UnitedOverseas', 'https://api.vietqr.io/img/UOB.png', 0, 1, 'UnitedOverseas', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (41, 'Ngân hàng TMCP Việt Á', 'VAB', '970427', 'VietABank', 'https://api.vietqr.io/img/VAB.png', 1, 1, 'VietABank', 3, 1, 'VNACVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (42, 'Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam', 'VBA', '970405', 'Agribank', 'https://api.vietqr.io/img/VBA.png', 1, 1, 'Agribank', 3, 1, 'VBAAVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (43, 'Ngân hàng TMCP Ngoại Thương Việt Nam', 'VCB', '970436', 'Vietcombank', 'https://api.vietqr.io/img/VCB.png', 1, 1, 'Vietcombank', 3, 1, 'BFTVVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (44, 'Ngân hàng TMCP Bản Việt', 'VCCB', '970454', 'VietCapitalBank', 'https://api.vietqr.io/img/VCCB.png', 1, 1, 'VietCapitalBank', 3, 1, 'VCBCVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (45, 'Ngân hàng TMCP Quốc tế Việt Nam', 'VIB', '970441', 'VIB', 'https://api.vietqr.io/img/VIB.png', 1, 1, 'VIB', 3, 1, 'VNIBVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (46, 'Ngân hàng TMCP Việt Nam Thương Tín', 'VIETBANK', '970433', 'VietBank', 'https://api.vietqr.io/img/VIETBANK.png', 1, 1, 'VietBank', 3, 1, 'VNTTVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (47, 'Ngân hàng TMCP Việt Nam Thịnh Vượng', 'VPB', '970432', 'VPBank', 'https://api.vietqr.io/img/VPB.png', 1, 1, 'VPBank', 3, 1, 'VPBKVNVX', NULL, NULL);
INSERT INTO `banks` VALUES (48, 'Ngân hàng Liên doanh Việt - Nga', 'VRB', '970421', 'VRB', 'https://api.vietqr.io/img/VRB.png', 0, 1, 'VRB', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (49, 'Ngân hàng TNHH MTV Woori Việt Nam', 'WVN', '970457', 'Woori', 'https://api.vietqr.io/img/WVN.png', 1, 1, 'Woori', 0, 1, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (50, 'Ngân hàng Kookmin - Chi nhánh Hà Nội', 'KBHN', '970462', 'KookminHN', 'https://api.vietqr.io/img/KBHN.png', 0, 0, 'KookminHN', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (51, 'Ngân hàng Kookmin - Chi nhánh Thành phố Hồ Chí Minh', 'KBHCM', '970463', 'KookminHCM', 'https://api.vietqr.io/img/KBHCM.png', 0, 0, 'KookminHCM', 0, 0, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (52, 'Ngân hàng Hợp tác xã Việt Nam', 'COOPBANK', '970446', 'COOPBANK', 'https://api.vietqr.io/img/COOPBANK.png', 1, 1, 'COOPBANK', 3, 1, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (53, 'TMCP Việt Nam Thịnh Vượng - Ngân hàng số CAKE by VPBank', 'CAKE', '546034', 'CAKE', 'https://api.vietqr.io/img/CAKE.png', 1, 1, 'CAKE', 3, 1, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (54, 'TMCP Việt Nam Thịnh Vượng - Ngân hàng số Ubank by VPBank', 'Ubank', '546035', 'Ubank', 'https://api.vietqr.io/img/UBANK.png', 1, 1, 'Ubank', 3, 1, NULL, NULL, NULL);
INSERT INTO `banks` VALUES (55, 'Ngân hàng Đại chúng TNHH Kasikornbank', 'KBank', '668888', 'KBank', 'https://api.vietqr.io/img/KBANK.png', 1, 0, 'KBank', 3, 1, 'KASIVNVX', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
