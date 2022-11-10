/*
 Navicat Premium Data Transfer

 Source Server         : lokal
 Source Server Type    : MariaDB
 Source Server Version : 100421 (10.4.21-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : edokumen

 Target Server Type    : MariaDB
 Target Server Version : 100421 (10.4.21-MariaDB)
 File Encoding         : 65001

 Date: 10/11/2022 15:16:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for berkas_pegawai
-- ----------------------------
DROP TABLE IF EXISTS `berkas_pegawai`;
CREATE TABLE `berkas_pegawai`  (
  `id_berkaspegawai` int(5) NOT NULL,
  `nik_pegawai` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_berkas` smallint(50) NOT NULL,
  `nama_berkas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_berkas` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_berlaku` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `upload_berkas` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_berkas` enum('Masih Berlaku','Tidak Berlaku','Proses Pengajuan','Akan Habis') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_berkaspegawai`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of berkas_pegawai
-- ----------------------------

-- ----------------------------
-- Table structure for cuti
-- ----------------------------
DROP TABLE IF EXISTS `cuti`;
CREATE TABLE `cuti`  (
  `id_cuti` int(5) NOT NULL AUTO_INCREMENT,
  `nomor_surat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_jenis_cuti` int(5) NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kepentingan` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_awal` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `jumlah` int(3) NOT NULL,
  `nik_pj` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Proses Pengajuan','Disetujui','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  `qrcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_cuti`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cuti
-- ----------------------------
INSERT INTO `cuti` VALUES (8, 'SF20221109001', '278.21.11.2018', 2, '1', 'Jalan Jalan', '2022-11-10', '2022-11-12', 2, '28.26.07.2009', 'Proses Pengajuan', '2022-11-09', '');

-- ----------------------------
-- Table structure for disposisi
-- ----------------------------
DROP TABLE IF EXISTS `disposisi`;
CREATE TABLE `disposisi`  (
  `id_disposisi` int(5) NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik_disposisi_dari` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik_disposisi_ke` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan_disposisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qrcode_disposisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_disposisi` date NOT NULL,
  PRIMARY KEY (`id_disposisi`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of disposisi
-- ----------------------------
INSERT INTO `disposisi` VALUES (1, 'SK20221104001', '194.04.01.2017', '03.09.07.1998,12.12.10.2005', 'Silahkan Diteruskan', '194.04.01.2017_SK20221104001.png', '2022-11-09');

-- ----------------------------
-- Table structure for dokumen
-- ----------------------------
DROP TABLE IF EXISTS `dokumen`;
CREATE TABLE `dokumen`  (
  `id_dokumen` int(5) NOT NULL AUTO_INCREMENT,
  `nomor_dokumen` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_dokumen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_unit` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_jenis_dokumen` int(5) NOT NULL,
  `id_lemari` int(5) NOT NULL,
  `id_rak` int(5) NOT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_dokumen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of dokumen
-- ----------------------------
INSERT INTO `dokumen` VALUES (1, 'P35/2000/2022', 'Perjanjian Kerja', '2022-10-20', '2022-10-31', '03.09.07.1998', '1', 2, 1, 1, 'UNDANGAN_MONEV_SISRUTE_13_OKT_2022_.pdf');
INSERT INTO `dokumen` VALUES (2, '12', 'SK Berpetualang', '2022-10-21', '2022-10-22', '278.21.11.2018', '1', 4, 1, 1, 'UNDANGAN_MONEV_SISRUTE_13_OKT_2022_1.pdf');
INSERT INTO `dokumen` VALUES (3, 'RS’ASF/04/SPO/IF/I/III/2018', 'PROSEDUR RETURN PERBEKALAN FARMASI PASIEN RAWAT INAP DAN PASIEN KELUAR RUMAH SAKIT (KRS)', '2018-03-27', '2021-03-27', '278.21.11.2018', '1', 3, 1, 1, 'SPO_REVISI_PROSEDUR_RETURN_PERBEKALAN_FARMASI_PASIEN_RAWAT_INAP_DAN_PASIEN_KELUAR_RUMAH_SAKIT_(KRS).pdf');
INSERT INTO `dokumen` VALUES (4, '22', '22', '2022-10-29', '2022-10-31', '278.21.11.2018', '1,3,4', 3, 1, 1, 'surat_pengajuan2.pdf');

-- ----------------------------
-- Table structure for hak_akses
-- ----------------------------
DROP TABLE IF EXISTS `hak_akses`;
CREATE TABLE `hak_akses`  (
  `id_hak_akses` int(5) NOT NULL AUTO_INCREMENT,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `hak_akses` enum('User','Admin','Super Admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_unit` int(5) NOT NULL,
  PRIMARY KEY (`id_hak_akses`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hak_akses
-- ----------------------------
INSERT INTO `hak_akses` VALUES (2, '278.21.11.2018', '278.21.11.2018', 'Super Admin', 1);
INSERT INTO `hak_akses` VALUES (3, '03.09.07.1998', '03.09.07.1998', 'Admin', 4);
INSERT INTO `hak_akses` VALUES (4, '28.26.07.2009', '28.26.07.2009', 'Admin', 3);
INSERT INTO `hak_akses` VALUES (5, '194.04.01.2017', '194.04.01.2017', 'Admin', 8);

-- ----------------------------
-- Table structure for jenis_berkas
-- ----------------------------
DROP TABLE IF EXISTS `jenis_berkas`;
CREATE TABLE `jenis_berkas`  (
  `id_jenis_berkas` int(20) NOT NULL,
  `jenis_berkas` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_jenis_berkas`) USING BTREE,
  INDEX `jenis_berkas`(`jenis_berkas`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_berkas
-- ----------------------------
INSERT INTO `jenis_berkas` VALUES (0, 'STR');

-- ----------------------------
-- Table structure for jenis_cuti
-- ----------------------------
DROP TABLE IF EXISTS `jenis_cuti`;
CREATE TABLE `jenis_cuti`  (
  `id_jenis_cuti` int(5) NOT NULL AUTO_INCREMENT,
  `jenis_cuti` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_jenis_cuti`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_cuti
-- ----------------------------
INSERT INTO `jenis_cuti` VALUES (2, 'Tahunan');
INSERT INTO `jenis_cuti` VALUES (3, 'Melahirkan');
INSERT INTO `jenis_cuti` VALUES (4, 'Ambil Libur');
INSERT INTO `jenis_cuti` VALUES (5, 'Menikah');

-- ----------------------------
-- Table structure for jenis_dokumen
-- ----------------------------
DROP TABLE IF EXISTS `jenis_dokumen`;
CREATE TABLE `jenis_dokumen`  (
  `id_jenis_dokumen` int(5) NOT NULL AUTO_INCREMENT,
  `jenis_dokumen` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sifat_dokumen` enum('Terbuka','Rahasia') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_jenis_dokumen`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jenis_dokumen
-- ----------------------------
INSERT INTO `jenis_dokumen` VALUES (1, 'Surat Keputusan', 'Terbuka');
INSERT INTO `jenis_dokumen` VALUES (2, 'Perjanjian', 'Rahasia');
INSERT INTO `jenis_dokumen` VALUES (3, 'SPO', 'Terbuka');
INSERT INTO `jenis_dokumen` VALUES (4, 'Pedoman', 'Terbuka');

-- ----------------------------
-- Table structure for lemari
-- ----------------------------
DROP TABLE IF EXISTS `lemari`;
CREATE TABLE `lemari`  (
  `id_lemari` int(5) NOT NULL AUTO_INCREMENT,
  `nama_lemari` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_lemari`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lemari
-- ----------------------------
INSERT INTO `lemari` VALUES (1, 'Lemari Besi');

-- ----------------------------
-- Table structure for rak
-- ----------------------------
DROP TABLE IF EXISTS `rak`;
CREATE TABLE `rak`  (
  `id_rak` int(5) NOT NULL AUTO_INCREMENT,
  `nama_rak` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rak`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rak
-- ----------------------------
INSERT INTO `rak` VALUES (1, 'R001');

-- ----------------------------
-- Table structure for sifat
-- ----------------------------
DROP TABLE IF EXISTS `sifat`;
CREATE TABLE `sifat`  (
  `id_sifat` int(5) NOT NULL AUTO_INCREMENT,
  `nama_sifat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_sifat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sifat
-- ----------------------------
INSERT INTO `sifat` VALUES (1, 'Biasa');
INSERT INTO `sifat` VALUES (2, 'Rutin');
INSERT INTO `sifat` VALUES (3, 'Penting');
INSERT INTO `sifat` VALUES (4, 'Rahasia');

-- ----------------------------
-- Table structure for surat
-- ----------------------------
DROP TABLE IF EXISTS `surat`;
CREATE TABLE `surat`  (
  `id_surat` int(12) NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_surat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_sifat` int(5) NOT NULL,
  `judul_surat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_surat` date NOT NULL,
  `nik_pengirim` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik_penerima` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `isi_surat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lampiran` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Belum Dibaca','Sudah Dibaca','Disposisi') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qrcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik_disposisi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_surat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of surat
-- ----------------------------
INSERT INTO `surat` VALUES (2, 'SK20221104001', 'RS’ASF/08/MI-IT/I/2019', 1, 'Pemeliharaan Server SIMRS Khanza dan Jaringan yang dilakukan Selama 2 hari', '2022-11-08', '278.21.11.2018', '28.26.07.2009,194.04.01.2017', '<p class=\"MsoNormal\" style=\"margin-bottom: 10.0pt; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Yang Terhormat</span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"IN\" style=\"font-size: 12.0pt; line-height: 115%;\"> :</span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> Dari :</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; color: black; mso-ansi-language: EN-US;\">dr. Tjatur Prijambodo, M.Kes<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"IN\" style=\"font-size: 12.0pt; line-height: 115%; color: black;\"><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> <span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; color: black; mso-ansi-language: EN-US;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span>Imam Ahmadi, S.Kom</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"mso-add-space: auto; text-indent: -255.15pt; line-height: 115%; margin: 0in 0in 0in 255.15pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; color: black; mso-ansi-language: EN-US;\">Direktur<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"FI\" style=\"font-size: 12.0pt; line-height: 115%; color: black; mso-ansi-language: FI;\">IT </span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"FI\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: FI;\">RS &rsquo;Aisyiyah</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"FI\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: FI;\">RS &rsquo;Aisyiyah Siti Fatimah Tulangan<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span> Siti Fatimah Tulangan</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"mso-add-space: auto; text-indent: -255.15pt; line-height: 115%; margin: 0in 0in 0in 255.15pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; color: black; mso-ansi-language: EN-US;\"><span style=\"mso-spacerun: yes;\">&nbsp;</span><span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"FI\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: FI;\"><span style=\"mso-spacerun: yes;\">&nbsp; </span></span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span lang=\"FI\" style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: FI;\">&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; line-height: 115%; tab-stops: 42.55pt 312.85pt;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Tanggal<span style=\"mso-tab-count: 1;\">&nbsp; </span>: 22 Maret 2019<span style=\"mso-tab-count: 1;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">&nbsp;</span></p>\r\n<table class=\"MsoNormalTable\" style=\"border-collapse: collapse; border: none; mso-border-alt: solid black .5pt; mso-padding-alt: 0in 5.4pt 0in 5.4pt; mso-border-insideh: .5pt solid black; mso-border-insidev: .5pt solid black;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"mso-yfti-irow: 0; mso-yfti-firstrow: yes; mso-yfti-lastrow: yes; height: 32.05pt;\">\r\n<td style=\"width: 487.35pt; border: solid black 1.0pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt; height: 32.05pt;\" valign=\"top\" width=\"650\">\r\n<p class=\"MsoNormal\" style=\"text-align: justify; text-justify: inter-ideograph; text-indent: -56.7pt; line-height: 115%; tab-stops: 56.7pt; margin: 0in 0in 0in 56.7pt;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Perihal<span style=\"mso-spacerun: yes;\">&nbsp;&nbsp; </span>: Pemeliharaan Server SIMRS Khanza dan Jaringan yang dilakukan Selama 2 hari.</span></strong></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Assalamu&rsquo;alaikum</span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%;\"> </span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Warahmatullahi Wabarakaatuh.</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; margin-top: 0in; mso-margin-bottom-alt: 8.0pt; mso-margin-top-alt: 0in; mso-add-space: auto; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">&nbsp;</span></strong></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; text-indent: .5in; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">Sehubungan dengan pemeliharaan server SIMRS Khanza dan Jaringan maka kami selaku IT RS &lsquo;Aisyiyah Siti Fatimah Tulangan memberitahukan akan ada kegiatan perbaikan SIMRS Khanza dan Jaringan Rumah sakit yang InsyaAllah dilaksanakan pada :</span></p>\r\n<table class=\"MsoTableGrid\" style=\"border-collapse: collapse; border: none; height: 127px; width: 92.7105%;\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr style=\"mso-yfti-irow: 0; mso-yfti-firstrow: yes;\">\r\n<td style=\"width: 13.4146%; padding: 0in 5.4pt;\" valign=\"top\" width=\"163\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Hari</span></p>\r\n</td>\r\n<td style=\"width: 3.34976%; padding: 0in 5.4pt;\" valign=\"top\" width=\"42\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">:</span></p>\r\n</td>\r\n<td style=\"width: 83.2356%; padding: 0in 5.4pt;\" valign=\"top\" width=\"418\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Jum&rsquo;at - Sabtu</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 1;\">\r\n<td style=\"width: 13.4146%; padding: 0in 5.4pt;\" valign=\"top\" width=\"163\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Tanggal</span></p>\r\n</td>\r\n<td style=\"width: 3.34976%; padding: 0in 5.4pt;\" valign=\"top\" width=\"42\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">:</span></p>\r\n</td>\r\n<td style=\"width: 83.2356%; padding: 0in 5.4pt;\" valign=\"top\" width=\"418\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">22 -23 Maret 2019</span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 2;\">\r\n<td style=\"width: 13.4146%; padding: 0in 5.4pt;\" valign=\"top\" width=\"163\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Pukul</span></p>\r\n</td>\r\n<td style=\"width: 3.34976%; padding: 0in 5.4pt;\" valign=\"top\" width=\"42\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">:</span></p>\r\n</td>\r\n<td style=\"width: 83.2356%; padding: 0in 5.4pt;\" valign=\"top\" width=\"418\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">12.00 WIB &ndash; 05.00<span style=\"mso-spacerun: yes;\">&nbsp;&nbsp; </span></span></p>\r\n</td>\r\n</tr>\r\n<tr style=\"mso-yfti-irow: 3; mso-yfti-lastrow: yes;\">\r\n<td style=\"width: 13.4146%; padding: 0in 5.4pt;\" valign=\"top\" width=\"163\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Dampak</span></p>\r\n</td>\r\n<td style=\"width: 3.34976%; padding: 0in 5.4pt;\" valign=\"top\" width=\"42\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">:</span></p>\r\n</td>\r\n<td style=\"width: 83.2356%; padding: 0in 5.4pt;\" valign=\"top\" width=\"418\">\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Layanan SIMRS Khanza &amp; sistem jaringan rumah sakit mengalami penurunan performa</span></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">Demikian informasi ini kami sampaikan, Atas perhatian dan kerjasamanya saya ucapkan trima kasih.</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">&nbsp;</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 0in; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US;\">Nashrun Minallah Wa Fathun Qorib</span></p>\r\n<p class=\"MsoNormal\" style=\"margin-bottom: 6.0pt; text-align: justify; text-justify: inter-ideograph; line-height: 115%;\"><strong><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-ansi-language: EN-US; mso-bidi-font-style: italic;\">Wassalamu&rsquo;alaikum</span></strong><strong><span style=\"font-size: 12.0pt; line-height: 115%; mso-fareast-font-family: \'Times New Roman\'; mso-bidi-font-style: italic;\"> </span></strong><strong style=\"mso-bidi-font-weight: normal;\"><span style=\"font-size: 12.0pt; line-height: 115%; mso-ansi-language: EN-US;\">Warahmatullahi Wabarakaatuh.</span></strong></p>', '1', 'Disposisi', '278.21.11.2018_SK20221104001.png', '03.09.07.1998', '2022-11-09 18:58:23');
INSERT INTO `surat` VALUES (3, '', 'SF20221109001', 0, 'Cuti Tahunan', '2022-11-09', '278.21.11.2018', '28.26.07.2009', '', '', 'Belum Dibaca', '', '', '2022-11-09 16:14:34');

-- ----------------------------
-- Table structure for unit
-- ----------------------------
DROP TABLE IF EXISTS `unit`;
CREATE TABLE `unit`  (
  `id_unit` int(5) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_unit`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unit
-- ----------------------------
INSERT INTO `unit` VALUES (1, 'IT');
INSERT INTO `unit` VALUES (3, 'Keuangan');
INSERT INTO `unit` VALUES (4, 'Umum');
INSERT INTO `unit` VALUES (5, 'Rawat Inap 1');
INSERT INTO `unit` VALUES (6, 'Front Office');
INSERT INTO `unit` VALUES (7, 'Rawat Inap 2');
INSERT INTO `unit` VALUES (8, 'Direktur');

-- ----------------------------
-- Table structure for verifikasi_surat
-- ----------------------------
DROP TABLE IF EXISTS `verifikasi_surat`;
CREATE TABLE `verifikasi_surat`  (
  `id_verifikasi_surat` int(5) NOT NULL AUTO_INCREMENT,
  `kode_surat` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nik` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status_verifikasi` enum('Proses Verifikasi','Disetujui','Ditolak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qrcode` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_verifikasi_surat`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of verifikasi_surat
-- ----------------------------
INSERT INTO `verifikasi_surat` VALUES (3, 'SK20221104001', '28.26.07.2009', 'Segera Dilaksanakan', 'Disetujui', '28.26.07.2009_SK20221104001.png', '2022-11-09');
INSERT INTO `verifikasi_surat` VALUES (4, 'SK20221104001', '194.04.01.2017', 'Silahkan Diteruskan', 'Disetujui', '194.04.01.2017_SK20221104001.png', '2022-11-09');

SET FOREIGN_KEY_CHECKS = 1;
