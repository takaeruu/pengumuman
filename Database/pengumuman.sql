/*
 Navicat Premium Dump SQL

 Source Server         : yoga
 Source Server Type    : MySQL
 Source Server Version : 100428 (10.4.28-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : pengumuman

 Target Server Type    : MySQL
 Target Server Version : 100428 (10.4.28-MariaDB)
 File Encoding         : 65001

 Date: 12/01/2025 15:55:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for jurusan
-- ----------------------------
DROP TABLE IF EXISTS `jurusan`;
CREATE TABLE `jurusan`  (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `nama_jurusan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of jurusan
-- ----------------------------
INSERT INTO `jurusan` VALUES (1, 'RPL');
INSERT INTO `jurusan` VALUES (2, 'AKL');
INSERT INTO `jurusan` VALUES (3, 'BDP');

-- ----------------------------
-- Table structure for kelas
-- ----------------------------
DROP TABLE IF EXISTS `kelas`;
CREATE TABLE `kelas`  (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `id_jurusan` int NULL DEFAULT NULL,
  `id_user` int NULL DEFAULT NULL,
  `nama_kelas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_kelas`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kelas
-- ----------------------------
INSERT INTO `kelas` VALUES (1, 1, 2, 'RPL XII B');
INSERT INTO `kelas` VALUES (2, 2, 3, 'AKL XII');
INSERT INTO `kelas` VALUES (3, 3, 4, 'BDP XII');
INSERT INTO `kelas` VALUES (4, 1, 1, 'RPL XII C');

-- ----------------------------
-- Table structure for pengumuman
-- ----------------------------
DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman`  (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `id_kelas` int NULL DEFAULT NULL,
  `tanggal` datetime NULL DEFAULT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `isi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `created_by` int NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_pengumuman`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 72 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengumuman
-- ----------------------------
INSERT INTO `pengumuman` VALUES (2, NULL, NULL, 'Libur', 'Libur aja klen, ga usa masuk', NULL, NULL, NULL);
INSERT INTO `pengumuman` VALUES (3, NULL, '2025-01-08 06:33:23', 'INFO PENTING !!!!', 'BESOK BAWA LAPTOP YA!', 'RobloxScreenShot20240914_121113845.png', 2, NULL);
INSERT INTO `pengumuman` VALUES (4, NULL, '2025-01-08 06:41:14', 'INFO PENTING !!!!', 'Libur aja klen, ga usa masukasdasdasd', '1736340074_7c9a1e6e16de3b105c5d.png', NULL, NULL);
INSERT INTO `pengumuman` VALUES (5, NULL, '2025-01-08 06:42:23', 'INFO PENTING !!!!', 'adas', '1736340143_a2a213aa0db09a3c22d4.png', NULL, NULL);
INSERT INTO `pengumuman` VALUES (6, NULL, '2025-01-08 06:42:48', 'INFO PENTING BANGET LOOO', 'gada.', '1736340168_0ab4fb568d93460f1893.png', NULL, NULL);
INSERT INTO `pengumuman` VALUES (7, NULL, '2025-01-09 05:16:15', 'p', 'ads', '1736421375_63f65e58ca398d7bfd53.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (8, NULL, '2025-01-09 07:32:14', 'test', 'test', '1736429534_bc4f86f33b59399c9442.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (9, NULL, '2025-01-09 07:34:45', 'INFO PENTING !!!!', 'Libur aja klen, ga usa masuk', '1736429685_2a907901429cc57e2952.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (10, NULL, '2025-01-09 07:49:37', 'INFO PENTING !!!!', 'yuro ada cewe baru!', '1736430577_ef1c66728da66a95d872.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (11, NULL, '2025-01-09 07:50:45', 'INFO PENTING !!!!', 'yuro ada cewe baru!', '1736430645_afc8b94ce041d8ad7dd7.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (12, NULL, '2025-01-09 08:39:08', 'INFO PENTING', 'Besok tak usa masuk ya ges', '1736433548_adb2e4e769b93587e432.pdf', 1, '2025-01-09 08:39:08');
INSERT INTO `pengumuman` VALUES (13, NULL, '2025-01-09 08:57:59', 'INFO PENTING !!!!', 'kalian di kelas aja ya dlu.', '1736434679_34e6016b9df21db6ecdc.pdf', 1, '2025-01-09 08:57:59');
INSERT INTO `pengumuman` VALUES (14, NULL, '2025-01-09 08:58:16', 'INFO PENTING !!!!', 'kalian di kelas aja ya dlu. okeee', '1736434696_431c4a359c64a29dbea4.pdf', 1, '2025-01-09 08:58:16');
INSERT INTO `pengumuman` VALUES (15, NULL, '2025-01-09 08:59:28', 'INFO PENTING !!!!', 'kalian di kelas aja ya dlu. okeee', '1736434768_102b672cd8aa772d1f7b.pdf', 1, '2025-01-09 08:59:28');
INSERT INTO `pengumuman` VALUES (16, NULL, '2025-01-09 09:03:00', 'info penting lo ini', 'klian di kls aja', '1736434980_247d946292ee8adfbcf5.pdf', 1, '2025-01-09 09:03:00');
INSERT INTO `pengumuman` VALUES (17, NULL, '2025-01-11 08:27:20', 'test', 'test', '1736605640_11f2a3be21f8821372d5.pdf', 1, '2025-01-11 08:27:20');
INSERT INTO `pengumuman` VALUES (18, NULL, '2025-01-11 08:33:43', 'test', 'test', '1736606023_8e33b669789607c6cb67.pdf', 1, '2025-01-11 08:33:43');
INSERT INTO `pengumuman` VALUES (19, NULL, '2025-01-11 08:33:57', 'test', 'test', '1736606037_2a97e01266ac187c20b7.pdf', 1, '2025-01-11 08:33:57');
INSERT INTO `pengumuman` VALUES (37, NULL, '2025-01-11 09:15:07', 'sadasdasdasasdasd', 'sadasdasdasasdasd', '1736608507_1d76962a02d641dc5711.pdf', NULL, '2025-01-11 09:15:07');
INSERT INTO `pengumuman` VALUES (38, NULL, '2025-01-11 09:17:01', 'mantap bg', 'mantap bg', '1736608621_fcfa6e2dfb7727c7ac98.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (39, NULL, '2025-01-11 09:18:02', 'asd', 'asd', '1736608682_1bfb56b8f4b3b667d732.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (40, NULL, '2025-01-11 09:20:18', 'infoo', 'gada', '1736608818_252ce9a4bb906ce141c8.pdf', NULL, '2025-01-11 09:20:18');
INSERT INTO `pengumuman` VALUES (41, NULL, '2025-01-11 09:21:00', 'semua', 'semua', '1736608860_52daf2b65158be0550c2.pdf', NULL, '2025-01-11 09:21:00');
INSERT INTO `pengumuman` VALUES (42, NULL, '2025-01-11 09:24:51', 'xcvxcvxc', 'vxcvxv', '1736609091_cfc9aa21dc0852ab2d14.pdf', NULL, '2025-01-11 09:24:51');
INSERT INTO `pengumuman` VALUES (43, NULL, '2025-01-11 09:26:36', 'aczxczxczxcc', 'zxczxczxcxz', '1736609196_9787b67ad5f2cb0872bf.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (44, NULL, '2025-01-11 09:28:19', 'aczxczxczxcc', 'zxczxczxcxz', '1736609299_77a3f352176cad01bdd1.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (45, NULL, '2025-01-11 09:29:54', 'zxcvbnm', 'zxcvbnm', '1736609394_14ff2ab73c63fda30004.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (46, NULL, '2025-01-11 09:35:04', 'sdsdfgfsadf', 'sdfggdsdfghg', '1736609704_49da233a3a26830a6576.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (47, NULL, '2025-01-11 09:36:17', 'INFO PENTING !!!!', 'sadasdasdasdasdasdasd', '1736609777_25b690fb3784355f1c81.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (48, NULL, '2025-01-11 09:39:24', 'ok', 'ok', '1736609964_e2c4db699fdff21a2e55.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (49, NULL, '2025-01-11 09:39:57', 'ko', 'ko', '1736609997_58a60a72caeaf647e0d7.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (50, NULL, '2025-01-11 09:41:00', 'ko', 'ko', '1736610060_ad8afdce096f094f2380.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (51, NULL, '2025-01-11 09:44:58', 'd', 'd', '1736610298_8c60bbd6beaaf9e494eb.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (52, NULL, '2025-01-11 09:49:01', 'g', 'g', '1736610541_1cd940b9df278b23aff5.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (53, NULL, '2025-01-11 09:51:27', 'w', 'w', '1736610687_84f4aa0e6fff32ecdcdd.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (54, NULL, '2025-01-11 09:53:09', 'a', 'a', '1736610789_9e00139a7364bdbcb2b0.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (55, NULL, '2025-01-11 09:54:08', 'q', 'q', '1736610848_a26ef4a561007849e48d.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (56, NULL, '2025-01-12 00:29:50', 'halo', 'halo', '1736663390_714e19bf9167693497bd.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (57, NULL, '2025-01-12 00:31:56', 'adsdas', 'asdda', '1736663516_993d0845ddeecb86dcd0.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (58, NULL, '2025-01-12 00:32:37', 'sad', 'asd', '1736663557_9131e4fee1434eefb8e9.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (59, NULL, '2025-01-12 00:34:11', 'infoo', 'gada', '1736663651_3b670657c80b5407de7a.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (60, NULL, '2025-01-12 00:34:40', 'ko', 'ko', '1736663680_0b16d51f1b5305c416f3.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (61, NULL, '2025-01-12 00:37:52', 'INFO PENTING !!!!', 'Libur aja klen, ga usa masuk', '1736663872_9a96fb2dcc8244dddddf.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (62, NULL, '2025-01-12 00:45:24', 'ss', 's', '1736664324_ee242eaf01d375085a84.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (63, NULL, '2025-01-12 00:47:17', 'w', 'w', '1736664437_20c39e6e5c292444fdf9.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (64, NULL, '2025-01-12 00:49:32', 'infoo', 'gada', '1736664572_05d897e8df7587ad548e.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (65, NULL, '2025-01-12 00:50:43', 'asd', 'sad', '1736664643_cd660977c73620cc045e.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (66, NULL, '2025-01-12 00:52:52', 'infoo', 'gada', '1736664772_ade0c025557e891e0a0d.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (67, NULL, '2025-01-12 00:53:18', 'asd', 'ad', NULL, NULL, NULL);
INSERT INTO `pengumuman` VALUES (68, NULL, '2025-01-12 00:57:58', 'c', 'c', '1736665078_4f58ff6fe052a6c81823.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (69, NULL, '2025-01-12 01:00:53', 's', 's', '1736665253_825bfb90011ecde87e53.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (70, NULL, '2025-01-12 01:18:27', 'c', 'c', '1736666307_49f16c8712438c3c27f6.pdf', NULL, NULL);
INSERT INTO `pengumuman` VALUES (71, NULL, '2025-01-12 01:23:50', 'x', 'z', '1736666630_dbba42923fc54741c5c1.pdf', NULL, NULL);

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id_setting` int NOT NULL AUTO_INCREMENT,
  `nama_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `logo_website` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tab_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `login_icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `create_by` int NULL DEFAULT NULL,
  `update_by` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `create_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_setting`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (1, 'Permata Harapan School', '1736302192_b01cf886986dc4918782.png', '1736302192_298b11863dbbbc32ba6b.png', '1736302192_2f569ed25053ac632369.png', NULL, 1, NULL, NULL, '2025-01-07 20:09:52', NULL);

-- ----------------------------
-- Table structure for siswa
-- ----------------------------
DROP TABLE IF EXISTS `siswa`;
CREATE TABLE `siswa`  (
  `id_siswa` int NOT NULL AUTO_INCREMENT,
  `id_kelas` int NULL DEFAULT NULL,
  `nama_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email_siswa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_ortu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email_ortu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_siswa`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of siswa
-- ----------------------------
INSERT INTO `siswa` VALUES (1, 1, 'yoga gans', '0811223344', 'yogaaaab@gmail.com', '6287788030949', 'yuserfpool@gmail.com');
INSERT INTO `siswa` VALUES (2, 1, 'yogurt', '087711111111', 'yogagautama12@gmail.com', '6285376027033', 'yogaaab@gmail.com');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','kepsek','wakepsek','guru','siswa','ortu') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_siswa` int NULL DEFAULT NULL,
  `deleted_by` int NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  `updated_by` int NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'c4ca4238a0b923820dcc509a6f75849b', 'yogagautama12@gmail.com', '+6287788030949', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (2, 'bobi', 'c4ca4238a0b923820dcc509a6f75849b', 'zentosph@gmail.com', '6287788030949', 'guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (3, 'joni', 'c4ca4238a0b923820dcc509a6f75849b', 'joni@gmail.com', '6285376027033', 'guru', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (4, 'elman', 'c4ca4238a0b923820dcc509a6f75849b', 'elman@gmail.com', '08112209123', 'guru', NULL, NULL, NULL, NULL, NULL, 1, '2025-01-12 02:25:12');
INSERT INTO `user` VALUES (5, 'bob saputra1', '5b7579069280fe8db6f7823769b1094c', 'karyawan5@gmail.com', '0899111245', 'wakepsek', NULL, NULL, '2025-01-12 01:39:04', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for user_activity
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity`  (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_user` int NULL DEFAULT NULL,
  `menu` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `time` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_log`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 680 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_activity
-- ----------------------------
INSERT INTO `user_activity` VALUES (626, 1, 'Masuk ke Dashboard', '2025-01-12 01:29:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (627, 1, 'Masuk ke Log Activity', '2025-01-12 01:29:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (628, 1, 'Masuk ke Jurusan', '2025-01-12 01:29:47', NULL, NULL);
INSERT INTO `user_activity` VALUES (629, 1, 'Masuk ke Log Activity', '2025-01-12 01:29:48', NULL, NULL);
INSERT INTO `user_activity` VALUES (630, 1, 'Masuk ke Log Activity', '2025-01-12 01:30:25', NULL, NULL);
INSERT INTO `user_activity` VALUES (631, 1, 'Masuk ke Log Activity', '2025-01-12 01:30:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (632, 1, 'Masuk ke Log Activity', '2025-01-12 01:30:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (633, 1, 'Masuk ke User', '2025-01-12 01:30:32', NULL, NULL);
INSERT INTO `user_activity` VALUES (634, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:30:35', NULL, NULL);
INSERT INTO `user_activity` VALUES (635, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (636, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:17', NULL, NULL);
INSERT INTO `user_activity` VALUES (637, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:20', NULL, NULL);
INSERT INTO `user_activity` VALUES (638, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:22', NULL, NULL);
INSERT INTO `user_activity` VALUES (639, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:24', NULL, NULL);
INSERT INTO `user_activity` VALUES (640, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (641, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:32:59', NULL, NULL);
INSERT INTO `user_activity` VALUES (642, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:33:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (643, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:33:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (644, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:33:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (645, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:33:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (646, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:33:33', NULL, NULL);
INSERT INTO `user_activity` VALUES (647, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:33:34', NULL, NULL);
INSERT INTO `user_activity` VALUES (648, 1, 'Masuk ke Pengumuman Umum', '2025-01-12 01:36:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (649, 1, 'Masuk ke Jurusan', '2025-01-12 01:36:11', NULL, NULL);
INSERT INTO `user_activity` VALUES (650, 1, 'Masuk ke Kelas', '2025-01-12 01:36:13', NULL, NULL);
INSERT INTO `user_activity` VALUES (651, 1, 'Masuk ke Siswa', '2025-01-12 01:36:14', NULL, NULL);
INSERT INTO `user_activity` VALUES (652, 1, 'Masuk ke User', '2025-01-12 01:36:15', NULL, NULL);
INSERT INTO `user_activity` VALUES (653, 1, 'Masuk ke User', '2025-01-12 01:38:58', NULL, NULL);
INSERT INTO `user_activity` VALUES (654, 1, 'Masuk ke User', '2025-01-12 01:39:01', NULL, NULL);
INSERT INTO `user_activity` VALUES (655, 1, 'Masuk ke User', '2025-01-12 01:39:05', NULL, NULL);
INSERT INTO `user_activity` VALUES (656, 1, 'Masuk ke User', '2025-01-12 01:39:30', NULL, NULL);
INSERT INTO `user_activity` VALUES (657, 1, 'Masuk ke User', '2025-01-12 01:40:28', NULL, NULL);
INSERT INTO `user_activity` VALUES (658, 1, 'Masuk ke Soft Delete', '2025-01-12 01:40:29', NULL, NULL);
INSERT INTO `user_activity` VALUES (659, 1, 'Masuk ke Soft Delete', '2025-01-12 01:42:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (660, 1, 'Masuk ke User', '2025-01-12 01:42:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (661, 1, 'Masuk ke User', '2025-01-12 01:42:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (662, 1, 'Masuk ke User', '2025-01-12 02:19:43', NULL, NULL);
INSERT INTO `user_activity` VALUES (663, 1, 'Masuk ke User', '2025-01-12 02:19:44', NULL, NULL);
INSERT INTO `user_activity` VALUES (664, 1, 'Masuk ke Edit User', '2025-01-12 02:19:45', NULL, NULL);
INSERT INTO `user_activity` VALUES (665, 1, 'Masuk ke User', '2025-01-12 02:20:50', NULL, NULL);
INSERT INTO `user_activity` VALUES (666, 1, 'Masuk ke User', '2025-01-12 02:23:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (667, 1, 'Masuk ke User', '2025-01-12 02:23:06', NULL, NULL);
INSERT INTO `user_activity` VALUES (668, 1, 'Masuk ke User', '2025-01-12 02:24:00', NULL, NULL);
INSERT INTO `user_activity` VALUES (669, 1, 'Masuk ke Restore Edit User', '2025-01-12 02:24:02', NULL, NULL);
INSERT INTO `user_activity` VALUES (670, 1, 'Masuk ke Restore Edit User', '2025-01-12 02:25:07', NULL, NULL);
INSERT INTO `user_activity` VALUES (671, 1, 'Masuk ke User', '2025-01-12 02:25:08', NULL, NULL);
INSERT INTO `user_activity` VALUES (672, 1, 'Masuk ke Edit User', '2025-01-12 02:25:10', NULL, NULL);
INSERT INTO `user_activity` VALUES (673, 1, 'Masuk ke User', '2025-01-12 02:25:12', NULL, NULL);
INSERT INTO `user_activity` VALUES (674, 1, 'Masuk ke Restore Edit User', '2025-01-12 02:25:16', NULL, NULL);
INSERT INTO `user_activity` VALUES (675, 1, 'Masuk ke User', '2025-01-12 02:25:18', NULL, NULL);
INSERT INTO `user_activity` VALUES (676, 1, 'Masuk ke User', '2025-01-12 02:28:26', NULL, NULL);
INSERT INTO `user_activity` VALUES (677, 1, 'Masuk ke Dashboard', '2025-01-12 02:28:27', NULL, NULL);
INSERT INTO `user_activity` VALUES (678, 1, 'Masuk ke Soft Delete', '2025-01-12 02:51:49', NULL, NULL);
INSERT INTO `user_activity` VALUES (679, 1, 'Masuk ke Restore Edit User', '2025-01-12 02:52:23', NULL, NULL);

-- ----------------------------
-- Table structure for user_backup
-- ----------------------------
DROP TABLE IF EXISTS `user_backup`;
CREATE TABLE `user_backup`  (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `level` enum('admin','kepsek','wakepsek','guru','siswa','ortu') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_siswa` int NULL DEFAULT NULL,
  `backup_by` int NULL DEFAULT NULL,
  `backup_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_backup
-- ----------------------------
INSERT INTO `user_backup` VALUES (4, 'elman', NULL, 'elman@gmail.com', '08112209123', 'guru', NULL, NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
