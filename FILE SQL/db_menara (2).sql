-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2023 at 11:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_menara`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_access`
--

CREATE TABLE `tb_access` (
  `kode_access` int(11) NOT NULL,
  `kode_role` int(11) NOT NULL,
  `akses` varchar(50) NOT NULL,
  `hak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_access`
--

INSERT INTO `tb_access` (`kode_access`, `kode_role`, `akses`, `hak`) VALUES
(25, 2, 'beranda', 'edit'),
(26, 2, 'kecamatan', 'read'),
(27, 2, 'pegawai', 'read'),
(28, 2, 'menara', 'read'),
(29, 2, 'zona', 'read'),
(30, 2, 'map', 'read'),
(42, 5, 'pegawai', 'manage'),
(43, 5, 'role', 'manage'),
(44, 5, 'beranda', 'manage'),
(45, 5, 'atribut', 'manage'),
(46, 5, 'kecamatan', 'manage'),
(47, 5, 'provider', 'manage'),
(48, 5, 'menara', 'manage'),
(49, 5, 'zona', 'manage'),
(50, 5, 'map', 'manage'),
(68, 2, 'provider', 'read'),
(69, 2, 'role', 'read'),
(70, 2, 'findmap', 'manage'),
(71, 5, 'findmap', 'manage');

-- --------------------------------------------------------

--
-- Table structure for table `tb_atribut`
--

CREATE TABLE `tb_atribut` (
  `kode_atribut` int(11) NOT NULL,
  `nama_atribut` varchar(50) NOT NULL,
  `file_atribut` varchar(50) NOT NULL,
  `tahun_sumber` varchar(15) NOT NULL,
  `warna_atribut` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_atribut`
--

INSERT INTO `tb_atribut` (`kode_atribut`, `nama_atribut`, `file_atribut`, `tahun_sumber`, `warna_atribut`) VALUES
(1, 'Pemukiman Penduduk', 'pemukimanarea1.geojson', '2022', '#050505');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `kode_kecamatan` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `nama_kecamatan` varchar(50) CHARACTER SET utf8mb4 DEFAULT 'unknow',
  `jumlah_penduduk` int(11) DEFAULT NULL,
  `laju_pertumbuhan` float DEFAULT NULL,
  `luas_wilayah` float DEFAULT NULL,
  `kepadatan_penduduk` float DEFAULT NULL,
  `jumlah_zona_new` int(11) DEFAULT 0,
  `jumlah_zona_eksisting` int(11) DEFAULT 0,
  `geojson` varchar(50) DEFAULT NULL,
  `warna` varchar(50) DEFAULT NULL,
  `sumber_data` varchar(15) NOT NULL,
  `teledensitas` float DEFAULT NULL,
  `ratarata_pngl` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id_kecamatan`, `kode_kecamatan`, `nama_kecamatan`, `jumlah_penduduk`, `laju_pertumbuhan`, `luas_wilayah`, `kepadatan_penduduk`, `jumlah_zona_new`, `jumlah_zona_eksisting`, `geojson`, `warna`, `sumber_data`, `teledensitas`, `ratarata_pngl`) VALUES
(1, 'BTRB', 'Baturaja Barat', 37611, 1.61, 117.4, 301, 1, 10, 'BTRB.geojson', NULL, '2020', 60.68, 45),
(2, 'BTRT', 'Baturaja Timur', 104488, 1.44, 109.96, 948, 3, 18, 'BTRT.geojson', NULL, '2020', 60.68, 60),
(3, 'KPNR', 'Kedaton Peninjauan Raya', 12723, 1.26, 296, 69, 2, 0, 'KPNR.geojson', NULL, '2020', 60.68, 45),
(4, 'LBBT', 'Lubuk Batang', 32975, 1.98, 747, 45, 6, 12, 'LBBT.geojson', NULL, '2020', 60.68, 45),
(5, 'LBRJ', 'Lubuk Raja', 30781, 1.13, 68.71, 443, 2, 7, 'LBRJ.geojson', NULL, '2020', 60.68, 45),
(6, 'LGKT', 'Lengkiti', 25032, -0.13, 481.06, 49, 3, 6, 'LGKT.geojson', NULL, '2020', 60.68, 45),
(7, 'MRJY', 'Muara Jaya', 7438, 1.18, 334.93, 283, 5, 0, 'MRJY.geojson', NULL, '2020', 60.68, 45),
(8, 'PNGD', 'Pengandonan', 10220, 1.2, 249, 19, 5, 4, 'PNGD.geojson', NULL, '2020', 60.68, 45),
(9, 'PNNJ', 'Peninjauan', 32435, 1.26, 618.68, 45, 6, 13, 'PNNJ.geojson', NULL, '2020', 60.68, 45),
(10, 'SMDA', 'Semidang Aji', 28195, 1.32, 714, 40, 7, 10, 'SMDA.geojson', NULL, '2020', 60.68, 45),
(11, 'SPNJ', 'Sinar Peninjauan', 22978, 1.1, 85.32, 271, 2, 8, 'SPNJ.geojson', NULL, '2020', 60.68, 45),
(12, 'SSBR', 'Sosoh Buay Rayap', 13762, 1.49, 375, 36, 1, 5, 'SSBR.geojson', NULL, '2020', 60.68, 45),
(13, 'ULOG', 'Ulu Ogan', 8965, 0.29, 600, 15, 0, 3, 'ULOG.geojson', NULL, '2020', 60.68, 45);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menara`
--

CREATE TABLE `tb_menara` (
  `kode_menara` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `sumber_data` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `site_id` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kode_jenis_menara` varchar(10) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kode_provider` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kelurahan` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `kode_kecamatan` varchar(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 NOT NULL,
  `tinggi_menara` int(11) DEFAULT NULL,
  `latitude` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `longitude` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `jumlah_operator` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_menara`
--

INSERT INTO `tb_menara` (`kode_menara`, `sumber_data`, `site_id`, `kode_jenis_menara`, `kode_provider`, `kelurahan`, `kode_kecamatan`, `alamat`, `tinggi_menara`, `latitude`, `longitude`, `jumlah_operator`) VALUES
('BTRBDYMTv2021100', '2021', 'OKU_136', 'GF', 'DYMTv', 'Batu Kuning', 'BTRB', 'jl. Talang Ribang RT.013 RW.005', 42, '-4.08008', '104.15954', '1'),
('BTRBDYMTv2022100', '2022', 'OKU_136', 'GF', 'DYMTv', 'Batu Kuning', 'BTRB', 'Jl. Talang Ribang RT013/RW005', 42, '-4.08008', '104.15954', '1'),
('BTRBIBSJv2021100', '2021', 'OKU_045', 'GF', 'IBSJv', 'Pusar', 'BTRB', 'jl. Batu Kuning No.8', 72, '-4.106889', '104.145667', '1'),
('BTRBIBSJv2022100', '2022', 'OKU_045', 'GF', 'IBSJv', 'Pusar', 'BTRB', 'Jl. Batu Kuning No.8', 72, '-4.106889', '104.145667', '1'),
('BTRBPRTLv2021100', '2021', 'OKU_040', 'GF', 'PRTLv', 'Pusar', 'BTRB', 'jl. Kol. H. Burlian No.298 RT.03 RW.06', 54, '-4.12603', '104.14553', '1'),
('BTRBPRTLv2021101', '2021', 'OKU_053', 'GF', 'PRTLv', 'Batu Putih', 'BTRB', 'jl. Lintas Muara Dua Dusun I', 64, '-4.16525', '104.13175', '1'),
('BTRBPRTLv2021102', '2021', 'OKU_044', 'GF', 'PRTLv', 'Batu Kuning', 'BTRB', 'jl. Lintas Muara Enim RT.04 RW.11', 53, '-4.10747', '104.13512', '1'),
('BTRBPRTLv2022100', '2022', 'OKU_040', 'GF', 'PRTLv', 'Pusar', 'BTRB', 'JL. Kol. H. Burlian No.298 RT.03/RW.06', 54, '-4.12603', '104.14553', '1'),
('BTRBPRTLv2022101', '2022', 'OKU_053', 'GF', 'PRTLv', 'Batu Putih', 'BTRB', 'Jl. Lintas Muara Dua Dusun I', 64, '-4.16525', '104.13175', '1'),
('BTRBPRTLv2022102', '2022', 'OKU_044', 'GF', 'PRTLv', 'Batu Kuning', 'BTRB', 'Jl. Lintas Muara Enim Rt 04 Rw 11', 53, '-4.10747', '104.13512', '1'),
('BTRBSTPRv2021100', '2021', 'OKU_038', 'GF', 'STPRv', 'Air Gading', 'BTRB', 'jl. Kapten Tendean, Air Gading RT.14 RW.04', 42, '-4.12107', '104.16089', '1'),
('BTRBSTPRv2021101', '2021', 'OKU_053', 'GF', 'STPRv', 'Batu Putih', 'BTRB', 'jl. Lintas Muara II Dusun II No.55', 52, '-4.1643', '104.13506', '1'),
('BTRBSTPRv2022100', '2022', 'OKU_038', 'GF', 'STPRv', 'Air Gading', 'BTRB', 'Jl. Kapten Tendean, Air Gading RT 14/04', 42, '-4.12107', '104.16089', '1'),
('BTRBSTPRv2022101', '2022', 'OKU_053', 'GF', 'STPRv', 'Batu Putih', 'BTRB', 'Jl. Lintas Muara II Dusun II No. 55', 52, '-4.1643', '104.13506', '1'),
('BTRBTBGRv2021100', '2021', 'OKU_045', 'GF', 'TBGRv', 'Batu Kuning', 'BTRB', 'Komplek RM 3 Saudara', 72, '-4.10487', '104.14044', '1'),
('BTRBTBGRv2021101', '2021', 'OKU_054', 'GF', 'TBGRv', 'Batu Putih', 'BTRB', 'Kampung III', 62, '-4.15683', '104.13684', '1'),
('BTRBTBGRv2021102', '2021', 'OKU_136', 'GF', 'TBGRv', 'Batu Kuning', 'BTRB', 'jl. Baturaja - BatuKuning', 42, '-4.09829', '104.15214', '1'),
('BTRBTBGRv2021103', '2021', 'OKU_039', 'GF', 'TBGRv', 'Tanjung Agung', 'BTRB', 'jl. Kol. Berlian No.44', 55, '-4.13224', '104.15581', '1'),
('BTRBTBGRv2021104', '2021', 'OKU_025', 'GF', 'TBGRv', 'Sukamaju', 'BTRB', 'Dusun Baturaja', 72, '-4.21838', '104.25609', '1'),
('BTRBTBGRv2022100', '2022', 'OKU_045', 'GF', 'TBGRv', 'Batu Kuning', 'BTRB', 'Komplek RM 3 Saudara', 72, '-4.10487', '104.14044', '1'),
('BTRBTBGRv2022101', '2022', 'OKU_054', 'GF', 'TBGRv', 'Batu Putih', 'BTRB', 'Kampung III', 62, '-4.15683', '104.13684', '1'),
('BTRBTBGRv2022102', '2022', 'OKU_136', 'GF', 'TBGRv', 'Batu Kuning', 'BTRB', 'Jl. Baturaja - Batukuning ', 42, '-4.09829', '104.15214', '1'),
('BTRBTBGRv2022103', '2022', 'OKU_039', 'GF', 'TBGRv', 'Tanjung Agung', 'BTRB', 'Jl. Kol. Berlian No.44', 55, '-4.13224', '104.15581', '1'),
('BTRBTBGRv2022104', '2022', 'OKU_025', 'GF', 'TBGRv', 'Sukamaju', 'BTRB', 'Dusun Baturaja', 72, '-4.21838', '104.25609', '1'),
('BTRBTLKMv2021100', '2021', 'OKU_053', 'GF', 'TLKMv', 'Batu Putih', 'BTRB', 'Dusun V', 62, '-4.16513889', '104.1328889', '1'),
('BTRBTLKMv2021101', '2021', 'OKU_044', 'GF', 'TLKMv', 'Batu Kuning', 'BTRB', 'jl. Lintas Sumatera', 72, '-4.10802778', '104.1315', '1'),
('BTRBTLKMv2022100', '2022', 'OKU_053', 'GF', 'TLKMv', 'Batu Putih', 'BTRB', 'Dusun V', 62, '-4.16513889', '104.1328889', '1'),
('BTRBTLKMv2022101', '2022', 'OKU_044', 'GF', 'TLKMv', 'Batu Kuning', 'BTRB', 'Jl. Lintas Sumatera', 72, '-4.10802778', '104.1315', '1'),
('BTRTDYMTv2021100', '2021', 'OKU_036', 'GF', 'DYMTv', 'Baturaja Lama', 'BTRT', 'jl. Gajah Mada Kota Baturaja', 32, '-4.12449', '104.16904', '1'),
('BTRTDYMTv2021101', '2021', 'OKU_028', 'GF', 'DYMTv', 'Baturaja Lama', 'BTRT', 'jl. A. Yani Belakang RM Sopoyono KM.7', 70, '-4.16391', '104.194889', '1'),
('BTRTDYMTv2021102', '2021', 'OKU_023', 'GF', 'DYMTv', 'Batumarta I', 'BTRT', 'jl. Desa Batumarta', 70, '-4.18644', '104.28978', '1'),
('BTRTDYMTv2022100', '2022', 'OKU_036', 'GF', 'DYMTv', 'Baturaja Lama', 'BTRT', 'Jl. Gajah Mada Kota Baturaja  ', 32, '-4.12449', '104.16904', '1'),
('BTRTDYMTv2022101', '2022', 'OKU_028', 'GF', 'DYMTv', 'Baturaja Lama', 'BTRT', 'Jl. A. Yani Belakang RM Sopoyono KM. 7 ', 70, '-4.16391', '104.194889', '1'),
('BTRTDYMTv2022102', '2022', 'OKU_023', 'GF', 'DYMTv', 'Batumarta I', 'BTRT', 'Jl. Desa Batumarta I', 70, '-4.18644', '104.28978', '1'),
('BTRTHCPTv2021100', '2021', 'OKU_037', 'GF', 'HCPTv', 'Sukaraya', 'BTRT', 'Jl. Prof. Dr. Hamka Rt.03 Rw.03', 32, '-4.12231', '104.17852', '1'),
('BTRTHCPTv2021101', '2021', 'OKU_038', 'GF', 'HCPTv', 'Pasar Baru', 'BTRT', 'Jl. Pahlawan Kemarung Rt.006 Rw.002', 32, '-4.12683', '104.16328', '1'),
('BTRTHCPTv2021102', '2021', 'OKU_042', 'GF', 'HCPTv', 'Kemalaraja', 'BTRT', 'jl. Moh. Hatta Lorong Tawakal 2 No. 810 Rt.11 Rw. 5', 32, '-4.11349', '104.17593', '1'),
('BTRTHCPTv2022100', '2022', 'OKU_073', 'GF', 'HCPTv', 'Sukaraya', 'BTRT', 'Jl. Prof Dr. Hamka RT.03 RW.03', 32, '-4.12231', '103.17852', '1'),
('BTRTHCPTv2022101', '2022', 'OKU_038', 'GF', 'HCPTv', 'Pasar Baru', 'BTRT', 'Jl. Pahlawan Kemarung RT.006/RW.002', 32, '-4.12683', '104.16328', '1'),
('BTRTHCPTv2022102', '2022', 'OKU_042', 'GF', 'HCPTv', 'Kemalaraja', 'BTRT', 'Jl. Moh. Hatta Lorong Tawakal 2 No. 810 RT.11/RW.5', 32, '-4.11349', '104.17593', '1'),
('BTRTINDOv2021100', '2021', 'OKU_035', 'GF', 'INDOv', 'sukaraya', 'BTRT', 'jl. letnan hasan basari', 70, '-4.1260556', '104.176222', '1'),
('BTRTINDOv2021101', '2021', 'OKU_038', 'RT', 'INDOv', 'Pasar Baru', 'BTRT', 'Jl. Pahlawan Kemarung', 6, '-4.126722', '104.162611', '1'),
('BTRTINDOv2022100', '2022', 'OKU_035', 'GF', 'INDOv', 'Sukaraya', 'BTRT', 'Jl. Let Hasan Basri', 70, '-4.1260556', '104.176222', '1'),
('BTRTINDOv2022101', '2022', 'OKU_038', 'RT', 'INDOv', 'Pasar Baru', 'BTRT', 'Jl. Pahlawan Kemarung', 6, '-4.126722', '104.162611', '1'),
('BTRTPRTLv2021100', '2021', 'OKU_029', 'GF', 'PRTLv', 'Kemelak', 'BTRT', 'jl. Jend. Ahmad Yani Rt. 001 Rw..001', 100, '-4.14342', '104.18153', '1'),
('BTRTPRTLv2021101', '2021', 'OKU_035', 'GF', 'PRTLv', 'Tanjung Baru', 'BTRT', 'jl. A Yani No. 160 RT. 04 RW 02, Dusun Air Karang', 48, '-4.12956', '104.17683', '1'),
('BTRTPRTLv2021102', '2021', 'OKU_026', 'GF', 'PRTLv', 'Sepancar', 'BTRT', 'jl. Lintas Sumatera Kab. OKU', 64, '-4.19417', '104.22552', '1'),
('BTRTPRTLv2021103', '2021', 'OKU_037', 'RT', 'PRTLv', 'Kemalajaya', 'BTRT', 'jl. Ogan RT.15 Kampung Baru', 15, '-4.11966', '104.17245', '1'),
('BTRTPRTLv2021104', '2021', 'OKU_034', 'RT', 'PRTLv', 'Air Paoh', 'BTRT', 'jl. Imam Bonjol Lr. A. Derpai RT.02 RW. 04', 30, '-4.12097', '104.18449', '1'),
('BTRTPRTLv2021105', '2021', 'OKU_133', 'GF', 'PRTLv', 'Kemelak - Bindung Langit', 'BTRT', 'jl. Jend Ahmad Yani', 40, '-4.15823', '104.18705', '1'),
('BTRTPRTLv2021106', '2021', 'OKU_031', 'GF', 'PRTLv', 'Sukaraya', 'BTRT', 'jl. Imam Bonjol RT05 RW05, Saranglang', 51, '-4.12449', '104.20223', '1'),
('BTRTPRTLv2021107', '2021', 'OKU_033', 'GF', 'PRTLv', 'Sekar Jaya', 'BTRT', 'jl. Padat Karya RT01, Dusun I', 51, '-4.1149', '104.18643', '1'),
('BTRTPRTLv2021108', '2021', 'OKU_028', 'GF', 'PRTLv', 'Kemelak - Bindung Langit', 'BTRT', 'Jl. A. Yani Km 7,5', 51, '-4.1673', '104.19782', '1'),
('BTRTPRTLv2021109', '2021', 'OKU_030', 'GF', 'PRTLv', 'Tanjung Baru', 'BTRT', 'jl. Syeh Khaliyudin Gang Familiy RT 002', 50, '-4.13636667', '104.1871556', '1'),
('BTRTPRTLv2022100', '2022', 'OKU_029', 'GF', 'PRTLv', 'Kemelak', 'BTRT', 'Jl. Jend. Ahmad Yani RT.001/RW.001', 100, '-4.14342', '104.18153', '1'),
('BTRTPRTLv2022101', '2022', 'OKU_035', 'GF', 'PRTLv', 'Tanjung Baru', 'BTRT', 'Jl. A. Yani No. 160 RT 04 RW 02, Dusun Air Karang', 48, '-4.12956', '104.17683', '1'),
('BTRTPRTLv2022102', '2022', 'OKU_026', 'GF', 'PRTLv', 'Sepancar', 'BTRT', 'Jl. Lintas Sumatera Kab. Oku', 64, '-4.19417', '104.22552', '1'),
('BTRTPRTLv2022103', '2022', 'OKU_037', 'RT', 'PRTLv', 'Kemalajaya', 'BTRT', 'Jl. Ogan  RT 15 Kampung Baru', 15, '-4.11966', '104.17245', '1'),
('BTRTPRTLv2022104', '2022', 'OKU_034', 'RT', 'PRTLv', 'Air Paoh', 'BTRT', 'Jl. Imam Bonjol Lr. A. Derpai RT. 02 RW. 04', 30, '-4.12097', '104.18449', '1'),
('BTRTPRTLv2022105', '2022', 'OKU_133', 'GF', 'PRTLv', 'Kemelak - Bindung Langit', 'BTRT', 'JL.Jend Ahmad Yani', 40, '-4.15823', '104.18705', '1'),
('BTRTPRTLv2022106', '2022', 'OKU_031', 'GF', 'PRTLv', 'Sukaraya', 'BTRT', 'Jl. Imam Bonjol RT05 RW05, Saranglang', 51, '-4.12449', '104.20223', '1'),
('BTRTPRTLv2022107', '2022', 'OKU_033', 'GF', 'PRTLv', 'Sekarjaya', 'BTRT', 'Jl. Padat Karya RT01, Dusun I', 51, '-4.1149', '104.18643', '1'),
('BTRTPRTLv2022108', '2022', 'OKU_028', 'GF', 'PRTLv', 'Kemelak - Bindung Langit', 'BTRT', 'Jl. A. Yani KM 7,5', 51, '-4.1673', '104.19782', '1'),
('BTRTPRTLv2022109', '2022', 'OKU_030', 'GF', 'PRTLv', 'Tanjung Baru', 'BTRT', 'Jalan Syeh Kaliyudin Gang Familiy RT 002', 50, '-4.13636667', '104.1871556', '1'),
('BTRTSTPRv2021100', '2021', 'OKU_049', 'GF', 'STPRv', 'Tanjung Kemala', 'BTRT', 'jl. Raya Dr. Sutomo', 71, '-4.09694', '104.19141', '1'),
('BTRTSTPRv2021101', '2021', 'OKU_074', 'GF', 'STPRv', 'Sukajadi', 'BTRT', 'Desa Sukajadi', 71, '-4.10833', '103.76643', '1'),
('BTRTSTPRv2022100', '2022', 'OKU_049', 'GF', 'STPRv', 'Tanjung Kemala', 'BTRT', 'Jl. Raya Dr. Sutomo ', 71, '-4.09694', '104.19141', '1'),
('BTRTSTPRv2022101', '2022', 'OKU_074', 'GF', 'STPRv', 'Sukajadi', 'BTRT', 'Desa Sukajadi', 71, '-4.10833', '103.76643', '1'),
('BTRTTBGRv2021100', '2021', 'OKU_021', 'GF', 'TBGRv', 'Batumarta II', 'LBRJ', 'jl. Poros Trans Dsn Gotong Royong RT.012 RW.005', 55, '-4.14296', '104.30942', '1'),
('BTRTTBGRv2021101', '2021', 'OKU_042', 'RT', 'TBGRv', 'Kemalaraja', 'BTRT', 'jl. Dr. M. Hatta, RT.011 RW.005', 20, '-4.11196', '104.17623', '1'),
('BTRTTBGRv2021102', '2021', 'OKU_034', 'RT', 'TBGRv', 'Sukaraya', 'BTRT', 'jl. Lintas Baturaja, Dr. M. Hatta, RT.003 RW.003', 20, '-4.12301', '104.18346', '1'),
('BTRTTBGRv2021103', '2021', 'OKU_034', 'RT', 'TBGRv', 'Air Paoh', 'BTRT', 'jl. Lintas Garuda , RT.001 RW.007', 9, '-4.12728', '104.18633', '1'),
('BTRTTBGRv2021104', '2021', 'OKU_036', 'GF', 'TBGRv', 'Pasar Lama', 'BTRT', 'jl. Darmo Sugondo RT.009 RW.003', 36, '-4.1289', '104.16872', '1'),
('BTRTTBGRv2021105', '2021', 'OKU_032', 'GF', 'TBGRv', 'Air Paoh', 'BTRT', 'jl. Imam Bonjol Lorong Resmi RT.002 Dusun V', 52, '-4.12015', '104.19202', '1'),
('BTRTTBGRv2021106', '2021', 'OKU_036', 'RT', 'TBGRv', 'Kemalaraja', 'BTRT', 'jl. A. Yani RT.001 RW.001', 12, '-4.12538', '104.1721', '1'),
('BTRTTBGRv2021107', '2021', 'OKU_041', 'GF', 'TBGRv', 'Sukajadi', 'BTRT', 'jl. Pangeran Hijab 3 RT.004 RW.002', 42, '-4.11485', '104.16721', '1'),
('BTRTTBGRv2021108', '2021', 'OKU_031', 'GF', 'TBGRv', 'Air Paoh', 'BTRT', 'jl. Imam Bonjol RT.001 RW.006', 62, '-4.12418', '104.20128', '1'),
('BTRTTBGRv2021109', '2021', 'OKU_078', 'GF', 'TBGRv', 'Sekarjaya', 'BTRT', 'jl. Padat Karya 2 RT.004 RW.001', 42, '-4.11005', '104.19939', '1'),
('BTRTTBGRv2021110', '2021', 'OKU_031', 'GF', 'TBGRv', 'Tanjung Baru', 'BTRT', 'RT.005 Dusun IV', 42, '-4.131743', '104.20448', '1'),
('BTRTTBGRv2021111', '2021', 'OKU_077', 'GF', 'TBGRv', 'Terusan', 'BTRT', 'jl. Dr. Sutomo No.65', 72, '-4.10449', '104.17268', '1'),
('BTRTTBGRv2022100', '2022', 'OKU_021', 'GF', 'TBGRv', 'Batumarta II', 'BTRT', 'Jalan Poros Trans Dsn Gotong Royong RT.012/RW.005', 55, '-4.14296', '104.30942', '1'),
('BTRTTBGRv2022101', '2022', 'OKU_042', 'RT', 'TBGRv', 'Kemalaraja', 'BTRT', 'Jl. Dr. M. Hatta, RT.011/RW.005', 20, '-4.11196', '104.17623', '1'),
('BTRTTBGRv2022102', '2022', 'OKU_034', 'RT', 'TBGRv', 'Sukaraya', 'BTRT', 'Jl. Lintas Baturaja, Dr. M. Hatta, RT.003/RW.003', 20, '-4.12301', '104.18346', '1'),
('BTRTTBGRv2022103', '2022', 'OKU_034', 'RT', 'TBGRv', 'Air Paoh', 'BTRT', 'Jl. Lintas Garuda, RT.001/RW.007', 9, '-4.12728', '104.18633', '1'),
('BTRTTBGRv2022104', '2022', 'OKU_036', 'GF', 'TBGRv', 'Pasar Lama', 'BTRT', 'JL. Darmo Sugondo RT.009/RW.003', 36, '-4.1289', '104.16872', '1'),
('BTRTTBGRv2022105', '2022', 'OKU_030', 'GF', 'TBGRv', 'Tanjung Baru', 'BTRT', 'Hotel Sherin Jl. Garuda Km. 2 No. 005', 25, '-4.13466', '104.18697', '1'),
('BTRTTBGRv2022106', '2022', 'OKU_032', 'GF', 'TBGRv', 'Air Paoh', 'BTRT', 'JL Iman Bonjol Lorong Resmi RT.002 Dusun V', 52, '-4.12015', '104.19202', '1'),
('BTRTTBGRv2022107', '2022', 'OKU_036', 'RT', 'TBGRv', 'Kemalaraja', 'BTRT', 'Jl. A. Yani RT.001/RW.001', 12, '-4.12538', '104.1721', '1'),
('BTRTTBGRv2022108', '2022', 'OKU_041', 'GF', 'TBGRv', 'Sukajadi', 'BTRT', 'Jl. Pangeran Hijab 3 RT.004/RW.002', 42, '-4.11485', '104.16721', '1'),
('BTRTTBGRv2022109', '2022', 'OKU_031', 'GF', 'TBGRv', 'Air Paoh', 'BTRT', 'Jl. Imam Bonjol RT.001/RW.006', 62, '-4.12418', '104.20128', '1'),
('BTRTTBGRv2022110', '2022', 'OKU_078', 'GF', 'TBGRv', 'Sekarjaya', 'BTRT', 'Jln. Padat Karya 2 RT.004/RW.001', 42, '-4.11005', '104.19939', '1'),
('BTRTTBGRv2022111', '2022', 'OKU_031', 'GF', 'TBGRv', 'Tanjung Baru', 'BTRT', 'RT.005 Dusun IV', 42, '-4.131743', '104.20448', '1'),
('BTRTTBGRv2022112', '2022', 'OKU_077', 'GF', 'TBGRv', 'Terusan', 'BTRT', 'Jl. Dr. Sutomo No. 65', 72, '-4.10449', '104.17268', '1'),
('BTRTTLKMv2021100', '2021', 'OKU_032', 'GF', 'TLKMv', 'Sukaraya', 'BTRT', 'jl. Imam Bonjol Simpang STM Baturaja (Depan Wartel Anugerah)', 112, '-4.11986', '104.189', '1'),
('BTRTTLKMv2021101', '2021', 'OKU_037', 'GF', 'TLKMv', 'Sukaraya', 'BTRT', 'jl. DI Panjaitan No. 424 RT.01 RW.04', 42, '-4.12066667', '104.1754444', '1'),
('BTRTTLKMv2021102', '2021', 'OKU_031', 'GF', 'TLKMv', 'Sekar Jaya', 'BTRT', 'jl. Imam Bonjol No. 265 RT.006 RW.017', 62, '-4.11933333', '104.2057222', '1'),
('BTRTTLKMv2021103', '2021', 'OKU_038', 'RT', 'TLKMv', 'Pasar Baru', 'BTRT', 'jl. R.E. Martadinata No. 840 RT.016 RW.005', 20, '-4.12664', '104.165', '1'),
('BTRTTLKMv2021104', '2021', 'OKU_027', 'GF', 'TLKMv', 'Kemelak', 'BTRT', 'Lingkungan Kemelak', 72, '-4.170278', '104.2025', '1'),
('BTRTTLKMv2021105', '2021', 'OKU_025', 'GF', 'TLKMv', 'Batumarta I', 'BTRT', 'jl. Lintas Sumatera', 72, '-4.22113889', '104.2574444', '1'),
('BTRTTLKMv2021106', '2021', 'OKU_029', 'RT', 'TLKMv', 'Karang Sari', 'BTRT', 'jl. Ki Ratu Penghulu No.045', 6, '-4.1412154', '104.17588', '1'),
('BTRTTLKMv2021107', '2021', 'OKU_037', 'RT', 'TLKMv', 'Kemalaraja', 'BTRT', 'jl. R.A. Hanan No.16 RT.020 RW.003', 6, '-4.11703', '104.1752', '1'),
('BTRTTLKMv2022100', '2022', 'OKU_032', 'GF', 'TLKMv', 'Sukaraya', 'BTRT', 'Jl. Imam Bonjol Simpang STM Baturaja  ( Depan Wartel Anugerah )', 112, '-4.11986', '104.189', '1'),
('BTRTTLKMv2022101', '2022', 'OKU_037', 'GF', 'TLKMv', 'Sukaraya', 'BTRT', 'Jl.DI Panjaitan No.424 Rt.01 RW.04', 42, '-4.12066667', '104.1754444', '1'),
('BTRTTLKMv2022102', '2022', 'OKU_031', 'GF', 'TLKMv', 'Sekarjaya', 'BTRT', 'Jl. Imam Bonjol No 265 RT. 006/RW.017 ', 62, '-4.11933333', '104.2057222', '1'),
('BTRTTLKMv2022103', '2022', 'OKU_038', 'RT', 'TLKMv', 'Pasar Baru', 'BTRT', 'Jl. R.E. Martadinata No. 840 RT.016/RW.005', 20, '-4.12664', '104.165', '1'),
('BTRTTLKMv2022104', '2022', 'OKU_027', 'GF', 'TLKMv', 'Kemelak', 'BTRT', 'Lingkungan Kemelak', 72, '-4.170278', '104.2025', '1'),
('BTRTTLKMv2022105', '2022', 'OKU_025', 'GF', 'TLKMv', 'Batumarta I', 'BTRT', 'Jl. Lintas Sumatera', 72, '-4.22113889', '104.2574444', '1'),
('BTRTTLKMv2022106', '2022', 'OKU_029', 'RT', 'TLKMv', 'Karang Sari', 'BTRT', 'Jl. Ki Ratu Penghulu No.045', 6, '-4.1412154', '104.17588', '1'),
('BTRTTLKMv2022107', '2022', 'OKU_037', 'RT', 'TLKMv', 'Kemalaraja', 'BTRT', 'Jl. R.A. Hanan No. 16 RT. 020 RW. 003', 6, '-4.11703', '104.1752', '1'),
('BTRTXLXTv2021100', '2021', '', 'GF', 'XLXTv', 'Kemalaraja', 'BTRT', 'Desa Kemalaraja', 90, '0', '0', '1'),
('BTRTXLXTv2022100', '2022', '', 'GF', 'XLXTv', 'Kemalaraja', 'BTRT', 'Desa Kemalaraja', 90, '0', '0', '1'),
('KPNRSTPRv2021100', '2021', 'OKU_018', 'GF', 'STPRv', 'Kedaton', 'KPNR', 'jl. Raya Kedaton', 71, '-3.82634', '104.46301', '1'),
('KPNRSTPRv2022100', '2022', 'OKU_018', 'GF', 'STPRv', 'Kedaton', 'KPNR', 'Jl. Raya Kedaton', 71, '-3.82634', '104.46301', '1'),
('KPNRTBGRv2021100', '2021', 'OKU_090', 'GF', 'TBGRv', 'Sinar Kedaton', 'KPNR', 'Dusun I', 42, '-3.763680', '104.438250', '1'),
('KPNRTBGRv2021101', '2021', 'OKU_092', 'GF', 'TBGRv', 'Bunglai', 'KPNR', 'Desa Bunglai RT.009', 42, '-3.84144', '104.43284', '1'),
('KPNRTBGRv2021102', '2021', 'OKU_084', 'GF', 'TBGRv', 'Suka Pindah', 'KPNR', 'Dusun IV', 42, '-3.784900', '104.496020', '1'),
('KPNRTBGRv2022100', '2022', 'OKU_090', 'GF', 'TBGRv', 'Sinar Kedaton', 'KPNR', 'Dusun I', 42, '-3.763680', '104.438250', '1'),
('KPNRTBGRv2022101', '2022', 'OKU_092', 'GF', 'TBGRv', 'Bunglai', 'KPNR', 'Desa Bunglai RT.009', 42, '-3.84144', '104.43284', '1'),
('KPNRTBGRv2022102', '2022', 'OKU_084', 'GF', 'TBGRv', 'Suka Pindah', 'KPNR', 'Dusun IV', 42, '-3.784900', '104.496020', '1'),
('LBBTCMIDv2021100', '2021', '', 'GF', 'CMIDv', 'Lubuk Batang', 'LBBT', 'jl. Lintas Palembang - Lubuk Batang', 71, '0', '0', '1'),
('LBBTCMIDv2022100', '2022', '', 'GF', 'CMIDv', 'Lubuk Batang', 'LBBT', 'Jl. Lintas Palembang-Lubuk Batang', 71, '0', '0', '1'),
('LBBTDYMTv2021100', '2021', 'OKU_008', 'GF', 'DYMTv', 'Belatung', 'LBBT', 'Desa Belatung', 72, '-4.027020', '104.229300', '1'),
('LBBTDYMTv2021101', '2021', 'OKU_128', 'GF', 'DYMTv', 'Sumber Bahagia', 'LBBT', 'Desa Sumber Bahagia', 72, '-3.958770', '104.089900', '1'),
('LBBTDYMTv2021102', '2021', 'OKU_125', 'GF', 'DYMTv', 'Lunggaian', 'LBBT', 'Dusun I', 72, '-3.95643', '104.23045', '1'),
('LBBTDYMTv2021103', '2021', 'OKU_047', 'GF', 'DYMTv', 'Tanjung Dalam', 'LBBT', 'jl. Raya Prabumulih - Baturaja 2, Dusun II', 70, '-4.06442', '104.21275', '1'),
('LBBTDYMTv2021104', '2021', 'OKU_048', 'GF', 'DYMTv', 'Banunyu', 'LBBT', 'Dusun IV', 72, '-4.07249', '104.20763', '1'),
('LBBTDYMTv2022100', '2022', 'OKU_008', 'GF', 'DYMTv', 'Belatung', 'LBBT', 'Desa Belatung', 72, '-4.027020', '104.229300', '1'),
('LBBTDYMTv2022101', '2022', 'OKU_128', 'GF', 'DYMTv', 'Sumber Bahagia', 'LBBT', 'Desa Sumber Bahagia', 72, '-3.958770', '104.089900', '1'),
('LBBTDYMTv2022102', '2022', 'OKU_125', 'GF', 'DYMTv', 'Lunggaian', 'LBBT', 'Dusun I', 72, '-3.95643', '104.23045', '1'),
('LBBTDYMTv2022103', '2022', 'OKU_047', 'GF', 'DYMTv', 'Tanjung Dalam', 'LBBT', 'Jl. Raya Prabumulih - Baturaja 2, Dusun II', 70, '-4.06442', '104.21275', '1'),
('LBBTDYMTv2022104', '2022', 'OKU_048', 'GF', 'DYMTv', 'Banuayu', 'LBBT', 'Dusun IV', 72, '-4.07249', '104.20763', '1'),
('LBBTPRTLv2021100', '2021', 'OKU_075', 'GF', 'PRTLv', 'Gunung Meraksa', 'LBBT', 'Dusun I', 100, '-3.95108', '104.12337', '1'),
('LBBTPRTLv2021101', '2021', 'OKU_009', 'GF', 'PRTLv', 'Lubuk Batang', 'LBBT', 'Dusun I', 100, '-4.05297', '104.22106', '1'),
('LBBTPRTLv2021102', '2021', 'OKU_076', 'GF', 'PRTLv', 'Gunung Meraksa', 'LBBT', 'jl. Lintas Sumatera Ds. I Ramabi Lubai Palembang', 72, '-3.90059', '104.11436', '1'),
('LBBTPRTLv2021103', '2021', 'OKU_009', 'GF', 'PRTLv', 'Lubuk Batang Baru', 'LBBT', 'jl. Raya Palembang - Baturaja Dn.02 - Baturaja OKU Palembang', 54, '-4.05576', '104.22041', '1'),
('LBBTPRTLv2022100', '2022', 'OKU_075', 'GF', 'PRTLv', 'Gunung Meraksa', 'LBBT', 'Dusun I', 100, '-3.95108', '104.12337', '1'),
('LBBTPRTLv2022101', '2022', 'OKU_009', 'GF', 'PRTLv', 'Lubuk Batang', 'LBBT', 'Dusun I', 100, '-4.05297', '104.22106', '1'),
('LBBTPRTLv2022102', '2022', 'OKU_076', 'GF', 'PRTLv', 'Gunung Meraksa', 'LBBT', 'Jl. Lintas Sumatera Ds. I Ramabi Lubai Palembang', 72, '-3.90059', '104.11436', '1'),
('LBBTPRTLv2022103', '2022', 'OKU_009', 'GF', 'PRTLv', 'Lubuk Batang Baru', 'LBBT', 'Jl Raya Palembang - Batu Raja  Dn. 02  -  Baturaja Oku Palembang', 54, '-4.05576', '104.22041', '1'),
('LBBTSTPRv2021100', '2021', 'OKU_075', 'GF', 'STPRv', 'Gunung Meraksa', 'LBBT', 'Desa Gunung Meraksa', 71, '-3.95213', '104.12271', '1'),
('LBBTSTPRv2022100', '2022', 'OKU_075', 'GF', 'STPRv', 'Gunung Meraksa', 'LBBT', 'Desa Gunung Meraksa', 71, '-3.95213', '104.12271', '1'),
('LBBTTBGRv2021100', '2021', 'OKU_137', 'GF', 'TBGRv', 'Bandar Agung', 'LBBT', 'Dusun III Bandar Agung Desa Bandar Agung', 72, '-3.94898', '104.15162', '1'),
('LBBTTBGRv2022100', '2022', 'OKU_137', 'GF', 'TBGRv', 'Bandar Agung', 'LBBT', 'Dusun III Bandar Agung Desa Bandar Agung', 72, '-3.94898', '104.15162', '1'),
('LBBTTLKMv2021100', '2021', 'OKU_001', 'GF', 'TLKMv', 'Lekis Rejo', 'LBBT', 'Dusun Trimulyo', 72, '-4.06258333', '104.2898611', '1'),
('LBBTTLKMv2021101', '2021', 'OKU_075', 'GF', 'TLKMv', 'Gunung Meraksa', 'LBBT', 'jl. Baturaja-Prabumulih KM.33 Kampung I', 72, '-3.95177778', '104.123', '1'),
('LBBTTLKMv2022100', '2022', 'OKU_001', 'GF', 'TLKMv', 'Lekis Rejo', 'LBBT', 'Desa Trimulyo', 72, '-4.06258333', '104.2898611', '1'),
('LBBTTLKMv2022101', '2022', 'OKU_075', 'GF', 'TLKMv', 'Gunung Meraksa', 'LBBT', 'Jl. Baturaja-Prabumulih KM.33 Kampung I', 72, '-3.95177778', '104.123', '1'),
('LBRJDYMTv2021100', '2021', 'OKU_002', 'GF', 'DYMTv', 'Lubuk Banjar', 'LBRJ', 'Desa Lubuk Banjar, RT.003 RW.003', 72, '-4.033720', '104.305890', '1'),
('LBRJDYMTv2021101', '2021', 'OKU_020', 'GF', 'DYMTv', 'Batumarta II', 'LBRJ', 'Dusun Trimulyo, Desa Marta Jaya Batumarta II', 72, '-4.13379', '104.29249', '1'),
('LBRJDYMTv2022100', '2022', 'OKU_002', 'GF', 'DYMTv', 'Lubuk Banjar', 'LBRJ', 'Desa Lubuk Banjar, RT/ RW 003/003', 72, '-4.033720', '104.305890', '1'),
('LBRJDYMTv2022101', '2022', 'OKU_020', 'GF', 'DYMTv', 'Batumarta II', 'LBRJ', 'Dusun Trimulyo, Desa Marta Jaya Batumarta II', 72, '-4.13379', '104.29249', '1'),
('LBRJIBSJv2021100', '2021', '', 'GF', 'IBSJv', 'Batumarta I', 'LBRJ', 'Tegal Sari RT.02A RW.001', 72, '0', '0', '1'),
('LBRJIBSJv2022100', '2022', 'OKU_070', 'GF', 'IBSJv', 'Batumarta I', 'LBRJ', 'Tegal Sari RT.02A/001', 72, '-3.2735', '102.958778', '1'),
('LBRJPRTLv2021100', '2021', 'OKU_024', 'GF', 'PRTLv', 'Batumarta I', 'LBRJ', 'jl. Desa Pasar Batumarta I, RT.02, Dusun 03 Pasar', 32, '-4.20412', '104.27342', '1'),
('LBRJPRTLv2022100', '2022', 'OKU_024', 'GF', 'PRTLv', 'Batumarta I', 'LBRJ', 'Jl. Desa Pasar Batumarta I, RT 02, Dusun 03 Pasar', 32, '-4.20412', '104.27342', '1'),
('LBRJSTPRv2021100', '2021', 'OKU_021', 'GF', 'STPRv', 'Batumarta II', 'LBRJ', 'Dusun Trimulyo, Batumarta II, RT.01 RW.01', 71, '-4.1432', '104.30708', '1'),
('LBRJSTPRv2022100', '2022', 'OKU_021', 'GF', 'STPRv', 'Batumarta II', 'LBRJ', 'Dusun Trimulyo, Batu Marta II, RT 01 RW 01', 71, '-4.1432', '104.30708', '1'),
('LBRJTBGRv2021100', '2021', 'OKU_021', 'GF', 'TBGRv', 'Batumarta II', 'LBRJ', 'jl. Poros Batu Marta Desa Batu Marta II', 72, '-4.13993', '104.33692', '1'),
('LBRJTBGRv2021101', '2021', 'OKU_001', 'GF', 'TBGRv', 'Lubuk Raja', 'LBRJ', 'Lubuk Raja', 72, '-4.06292', '104.29001', '1'),
('LBRJTBGRv2021102', '2021', 'OKU_021', 'GF', 'TBGRv', 'Batumarta II', 'LBRJ', 'Dusun Purwodono RT.006 RW.003', 42, '-4.14248', '104.31823', '1'),
('LBRJTBGRv2022100', '2022', 'OKU_021', 'GF', 'TBGRv', 'Batumarta II', 'LBRJ', 'Jl. Poros Batu Marta Desa Batu Marta II', 72, '-4.13993', '104.33692', '1'),
('LBRJTBGRv2022101', '2022', 'OKU_001', 'GF', 'TBGRv', 'Lubuk Raja', 'LBRJ', 'Lubuk Raja', 72, '-4.06292', '104.29001', '1'),
('LBRJTBGRv2022102', '2022', 'OKU_021', 'GF', 'TBGRv', 'Batumarta II', 'LBRJ', 'Dusun Purwodono RT.006/RW.003', 42, '-4.14248', '104.31823', '1'),
('LBRJTLKMv2021100', '2021', 'OKU_023', 'GF', 'TLKMv', 'Batuwinangun', 'LBRJ', 'jl. Raya Batumarta Blok L Dusun Cimalaya', 72, '-4.184777', '104.28775', '1'),
('LBRJTLKMv2022100', '2022', 'OKU_023', 'GF', 'TLKMv', 'Batuwinangun', 'LBRJ', 'Jalan Raya Batumarta Blok L Dusun Cimalaya', 72, '-4.184777', '104.28775', '1'),
('LGKTPRTLv2021100', '2021', 'OKU_058', 'GF', 'PRTLv', 'Lubuk Dalam', 'LGKT', 'Kampung I RT.001 RW.001', 70, '-4.32175', '104.08717', '1'),
('LGKTPRTLv2021101', '2021', 'OKU_058', 'GF', 'PRTLv', 'Tanjung Lengkayap', 'LGKT', 'Dusun Tanjung Kayap', 71, '-4.32337', '104.08717', '1'),
('LGKTPRTLv2022100', '2022', 'OKU_058', 'GF', 'PRTLv', 'Lubuk Dalam', 'LGKT', 'Kampung I RT.01/RW.01', 70, '-4.32175', '104.08717', '1'),
('LGKTPRTLv2022101', '2022', 'OKU_058', 'GF', 'PRTLv', 'Tanjung Lengkayap', 'LGKT', 'Dusun Tanjung Kayap', 71, '-4.32337', '104.0903', '1'),
('LGKTSTPRv2021100', '2021', 'OKU_059', 'GF', 'STPRv', 'Karang Endah', 'LGKT', 'Dusun II', 71, '-4.35515', '104.11239', '1'),
('LGKTSTPRv2022100', '2022', 'OKU_059', 'GF', 'STPRv', 'Karang Endah', 'LGKT', 'Dusun II', 71, '-4.35515', '104.11239', '1'),
('LGKTTBGRv2021100', '2021', 'OKU_061', 'GF', 'TBGRv', 'Gedung Pakuon', 'LGKT', 'Desa Gedung Pakuan RT.001 RW.001', 100, '-4.31075', '104.01034', '1'),
('LGKTTBGRv2021101', '2021', 'OKU_059', 'GF', 'TBGRv', 'Karang Endah', 'LGKT', 'Dusun Karang Endah', 72, '-4.35643', '104.11333', '1'),
('LGKTTBGRv2021102', '2021', 'OKU_058', 'GF', 'TBGRv', 'Lubuk Dalam', 'LGKT', 'Kampung III', 72, '-4.32279', '104.08717', '1'),
('LGKTTBGRv2021103', '2021', 'OKU_122', 'GF', 'TBGRv', 'Tihang', 'LGKT', 'jl. Tihang Dusun II, RT.004 RW.004', 72, '-4.22579', '104.05895', '1'),
('LGKTTBGRv2022100', '2022', 'OKU_061', 'GF', 'TBGRv', 'Gedung Pakuon', 'LGKT', 'Ds. Gedung Pakuan RT.001/RW.001', 100, '-4.31075', '104.01034', '1'),
('LGKTTBGRv2022101', '2022', 'OKU_059', 'GF', 'TBGRv', 'Karang Endah', 'LGKT', 'Dusun Karang Endah', 72, '-4.35643', '104.11333', '1'),
('LGKTTBGRv2022102', '2022', 'OKU_058', 'GF', 'TBGRv', 'Lubuk Dalam', 'LGKT', 'Kampung III', 72, '-4.32279', '104.08717', '1'),
('LGKTTBGRv2022103', '2022', 'OKU_122', 'GF', 'TBGRv', 'Tihang', 'LGKT', 'Jl. Tihang Dusun II, RT.004/RW.004', 72, '-4.22579', '104.05895', '1'),
('LGKTTLKMv2021100', '2021', 'OKU_060', 'GF', 'TLKMv', 'Fajar Bulan', 'LGKT', 'jl. Baturaja Simpang / Desa Fajar Bulan Kampung III', 72, '-4.40258333', '104.1399722', '1'),
('LGKTTLKMv2021101', '2021', 'OKU_058', 'GF', 'TLKMv', 'Lubuk Dalam', 'LGKT', 'jl. Lintas Sundan (samping PDAM)', 72, '-4.32255556', '104.0875833', '1'),
('LGKTTLKMv2021102', '2021', 'OKU_056', 'GF', 'TLKMv', 'Bandar Jaya', 'LGKT', 'jl. Lintas Muara Dua', 72, '-4.2394', '104.1058', '1'),
('LGKTTLKMv2022100', '2022', 'OKU_060', 'GF', 'TLKMv', 'Fajar Bulan', 'LGKT', 'JL.Baturaja Simpang/Desa Pajar Bulan Kampung III', 72, '-4.40258333', '104.1399722', '1'),
('LGKTTLKMv2022101', '2022', 'OKU_058', 'GF', 'TLKMv', 'Lubuk Dalam', 'LGKT', 'JL.Lintas Sundan (samping PDAM) ', 72, '-4.32255556', '104.0875833', '1'),
('LGKTTLKMv2022102', '2022', 'OKU_122', 'GF', 'TLKMv', 'Bandar Jaya', 'LGKT', 'Jl. Lintas Muara Dua', 72, '-4.24589', '104.06765', '1'),
('PNGDDYMTv2021100', '2021', 'OKU_068', 'GF', 'DYMTv', 'Semanding', 'PNGD', 'Desa Semanding', 70, '-4.05450', '103.87478', '1'),
('PNGDDYMTv2022100', '2022', 'OKU_068', 'GF', 'DYMTv', 'Semanding', 'PNGD', 'Desa Semanding', 70, '-4.05450', '103.87478', '1'),
('PNGDTLKMv2021100', '2021', 'OKU_068', 'GF', 'TLKMv', 'Ujan Mas', 'PNGD', 'Dusun IV', 82, '-4.05413889', '103.8806111', '1'),
('PNGDTLKMv2021101', '2021', 'OKU_069', 'GF', 'TLKMv', 'Ujan Mas', 'PNGD', 'jl. trans Sumatera', 72, '-4.06283333', '103.8378056', '1'),
('PNGDTLKMv2022100', '2022', 'OKU_068', 'GF', 'TLKMv', 'Ujan Mas', 'PNGD', 'Dusun IV', 82, '-4.05413889', '103.8806111', '1'),
('PNGDTLKMv2022101', '2022', 'OKU_069', 'GF', 'TLKMv', 'Ujan Mas', 'PNGD', 'Jl. Trans Sumatera', 72, '-4.06283333', '103.8378056', '1'),
('PNGDXLXTv2021100', '2021', 'OKU_068', 'GF', 'XLXTv', 'Semanding', 'PNGD', 'jl. Raya Lintas Baturaja - Muara Enim', 71, '-4.05469', '103.87458', '1'),
('PNGDXLXTv2022100', '2022', 'OKU_068', 'GF', 'XLXTv', 'Semanding', 'PNGD', 'Jl. Raya lintas  Baturaja - Muara Enim', 71, '-4.05469', '103.87458', '1'),
('PNNJDYMTv2021100', '2021', 'OKU_096', 'GF', 'DYMTv', 'Mitra Kencana', 'PNNJ', 'Blok A RT.001', 72, '-3.77518', '104.36102', '1'),
('PNNJDYMTv2021101', '2021', 'OKU_017', 'GF', 'DYMTv', 'Peninjauan', 'PNNJ', 'jl. Putri Candi Dusun I', 100, '-3.87244', '104.37900', '1'),
('PNNJDYMTv2021102', '2021', 'OKU_100', 'GF', 'DYMTv', 'Penilikan', 'PNNJ', 'Blog G, RT.002 RW.004', 42, '-3.86033', '104.35503', '1'),
('PNNJDYMTv2021103', '2021', 'OKU_016', 'GF', 'DYMTv', 'Mendala', 'PNNJ', 'jl. Lintas Peninjauan Baturaja Dusun III', 100, '-3.88459', '104.37875', '1'),
('PNNJDYMTv2021104', '2021', 'OKU_022', 'GF', 'DYMTv', 'Lekis Rejo', 'PNNJ', 'Dusun Wanarata Batumarta II RT.009 RW. 004', 72, '-4.15116', '104.30200', '1'),
('PNNJDYMTv2022100', '2022', 'OKU_096', 'GF', 'DYMTv', 'Mitra Kencana', 'PNNJ', 'Blok A RT 001', 72, '-3.77518', '104.36102', '1'),
('PNNJDYMTv2022101', '2022', 'OKU_017', 'GF', 'DYMTv', 'Peninjauan', 'PNNJ', 'Jl. Putri Candi Dusun I', 100, '-3.87244', '104.37900', '1'),
('PNNJDYMTv2022102', '2022', 'OKU_100', 'GF', 'DYMTv', 'Penilikan', 'PNNJ', 'Blok G, RT002/RW004', 42, '-3.86033', '104.35503', '1'),
('PNNJDYMTv2022103', '2022', 'OKU_016', 'GF', 'DYMTv', 'Mendala', 'PNNJ', 'Jl. Lintas Peninjauan Baturaja Dusun III', 100, '-3.88459', '104.37875', '1'),
('PNNJDYMTv2022104', '2022', 'OKU_022', 'GF', 'DYMTv', 'Lekis Rejo', 'PNNJ', 'Dusun Wanarata Batumarta II RT.009/RW.004', 72, '-4.15116', '104.30200', '1'),
('PNNJPRTLv2021100', '2021', 'OKU_007', 'GF', 'PRTLv', 'Kepayang', 'PNNJ', 'Ds. Kepayang RT.01 RW.06', 64, '-4.01584', '104.2603', '1'),
('PNNJPRTLv2021101', '2021', 'OKU_016', 'GF', 'PRTLv', 'Mendala', 'PNNJ', 'Kel. Mendala', 100, '-3.88224', '104.37712', '1'),
('PNNJPRTLv2022100', '2022', 'OKU_007', 'GF', 'PRTLv', 'Kepayang', 'PNNJ', 'Ds. Kepayang Rt 01/06', 64, '-4.01584', '104.2603', '1'),
('PNNJPRTLv2022101', '2022', 'OKU_016', 'GF', 'PRTLv', 'Mendala', 'PNNJ', 'Kel. Mendala', 100, '-3.88224', '104.37712', '1'),
('PNNJSTPRv2021100', '2021', 'OKU_005', 'GF', 'STPRv', 'Kedondong', 'PNNJ', 'jl. Raya Peninjauan, Dusun I', 71, '-3.99532', '104.28762', '1'),
('PNNJSTPRv2022100', '2022', 'OKU_005', 'GF', 'STPRv', 'Kedondong', 'PNNJ', 'Jl. Raya Peninjauan, Dusun I', 71, '-3.99532', '104.28762', '1'),
('PNNJTBGRv2021100', '2021', 'OKU_109', 'GF', 'TBGRv', 'Durian', 'PNNJ', 'Dusun IV', 42, '-3.961870', '104.313760', '1'),
('PNNJTBGRv2021101', '2021', 'OKU_012', 'GF', 'TBGRv', 'Lubuk Rukam', 'PNNJ', 'Dusun I', 72, '-3.93792', '104.33926', '1'),
('PNNJTBGRv2021102', '2021', 'OKU_019', 'GF', 'TBGRv', 'Mekartijaya', 'PNNJ', 'jl. Blok F', 72, '-3.80739', '104.30817', '1'),
('PNNJTBGRv2021103', '2021', 'OKU_015', 'GF', 'TBGRv', 'Karang Dapo', 'PNNJ', 'Dusun I', 52, '-3.90169', '104.36035', '1'),
('PNNJTBGRv2021104', '2021', 'OKU_092', 'GF', 'TBGRv', 'Saung Naga', 'PNNJ', 'Dusun IV RT.002 Desa Saung Naga', 42, '-3.860040', '104.410730', '1'),
('PNNJTBGRv2022100', '2022', 'OKU_109', 'GF', 'TBGRv', 'Durian', 'PNNJ', 'Dusun IV', 42, '-3.961870', '104.313760', '1'),
('PNNJTBGRv2022101', '2022', 'OKU_012', 'GF', 'TBGRv', 'Lubuk Rukam', 'PNNJ', 'Dusun 1', 72, '-3.93792', '104.33926', '1'),
('PNNJTBGRv2022102', '2022', 'OKU_019', 'GF', 'TBGRv', 'Mekartijaya', 'PNNJ', 'Jln Blok  F', 72, '-3.80739', '104.30817', '1'),
('PNNJTBGRv2022103', '2022', 'OKU_015', 'GF', 'TBGRv', 'Karang Dapo', 'PNNJ', 'Dusun I', 52, '-3.90169', '104.36035', '1'),
('PNNJTBGRv2022104', '2022', 'OKU_092', 'GF', 'TBGRv', 'Saung Naga', 'PNNJ', 'Dusun IV RT.002 Desa Saung Naga', 42, '-3.860040', '104.410730', '1'),
('PNNJTLKMv2021100', '2021', 'OKU_006', 'GF', 'TLKMv', 'Kepayang', 'PNNJ', 'Dusun III', 72, '-4.01233333', '104.2696667', '1'),
('PNNJTLKMv2021101', '2021', 'OKU_012', 'GF', 'TLKMv', 'Lubuk Rukam', 'PNNJ', 'Desa I', 72, '-3.93788889', '104.3387778', '1'),
('PNNJTLKMv2021102', '2021', 'OKU_046', 'GF', 'TLKMv', 'Lubuk Batang Baru', 'PNNJ', 'jl. Raya Beringin', 72, '-4.04847', '104.195', '1'),
('PNNJTLKMv2021103', '2021', 'OKU_017', 'GF', 'TLKMv', 'Peninjauan', 'PNNJ', 'Desa Peninjauan, Kampung I No.8', 72, '-3.873', '104.38', '1'),
('PNNJTLKMv2021104', '2021', 'OKU_018', 'GF', 'TLKMv', 'Kedaton', 'PNNJ', 'jl. Protokol Kedaton', 72, '-3.82975', '104.46275', '1'),
('PNNJTLKMv2022100', '2022', 'OKU_006', 'GF', 'TLKMv', 'Kepayang', 'PNNJ', 'Dusun III', 72, '-4.01233333', '104.2696667', '1'),
('PNNJTLKMv2022101', '2022', 'OKU_012', 'GF', 'TLKMv', 'Lubuk Rukam', 'PNNJ', 'Desa I', 72, '-3.93788889', '104.3387778', '1'),
('PNNJTLKMv2022102', '2022', 'OKU_046', 'GF', 'TLKMv', 'Lubuk Batang Baru', 'PNNJ', 'Jl. Raya Beringin', 72, '-4.04847', '104.195', '1'),
('PNNJTLKMv2022103', '2022', 'OKU_017', 'GF', 'TLKMv', 'Peninjauan', 'PNNJ', 'Desa Peninjauan, Kampung I No. 8', 72, '-3.873', '104.38', '1'),
('PNNJTLKMv2022104', '2022', 'OKU_018', 'GF', 'TLKMv', 'Kedaton', 'PNNJ', 'Jl. Protokol Kedaton', 72, '-3.82975', '104.46275', '1'),
('SMDACMIDv2021100', '2021', '', 'GF', 'CMIDv', 'Ulak Pandan', 'SMDA', 'jl. Lintas Baturaja, Muara Enim', 71, '0', '0', '1'),
('SMDACMIDv2022100', '2022', '', 'GF', 'CMIDv', 'Ulak Pandan', 'SMDA', 'Jl. Lintas Baturaja, Muara Enim', 71, '0', '0', '1'),
('SMDADYMTv2021100', '2021', 'OKU_066', 'GF', 'DYMTv', 'Tubuhan', 'SMDA', 'Dusun IV', 72, '-4.07277', '103.99869', '1'),
('SMDADYMTv2021101', '2021', 'OKU_103', 'GF', 'DYMTv', 'Batanghari', 'SMDA', 'jl. Lintas Sumatera RT.002', 52, '-4.04775', '103.91798', '1'),
('SMDADYMTv2022100', '2022', 'OKU_066', 'GF', 'DYMTv', 'Tubuhan', 'SMDA', 'Dusun IV', 72, '-4.07277', '103.99869', '1'),
('SMDADYMTv2022101', '2022', 'OKU_103', 'GF', 'DYMTv', 'Batanghari', 'SMDA', 'Jl. Lintas Sumatera RT002', 52, '-4.04775', '103.91798', '1'),
('SMDAIBSJv2021100', '2021', 'OKU_064', 'GF', 'IBSJv', 'Reksa Jiwa', 'SMDA', 'jl. Lintas Sumatera', 72, '-4.075111', '104.027028', '1'),
('SMDAIBSJv2021101', '2021', '', 'GF', 'IBSJv', 'Pandan Dulang', 'SMDA', 'Pandan Dulang', 0, '0', '0', '1'),
('SMDAIBSJv2022100', '2022', 'OKU_064', 'GF', 'IBSJv', 'Reksa Jiwa', 'SMDA', 'Jl. Lintas Sumatera', 72, '-4.075111', '104.027028', '1'),
('SMDAINDOv2021100', '2021', 'OKU_063', 'GF', 'INDOv', 'Seleman', 'SMDA', 'Desa Seleman', 70, '-4.079778', '104.041667', '1'),
('SMDAINDOv2021101', '2021', 'OKU_051', 'GF', 'INDOv', 'Banjar Sari', 'SMDA', 'Dusun Banjar Sari', 72, '-4.091889', '104.086583', '1'),
('SMDAINDOv2022100', '2022', 'OKU_063', 'GF', 'INDOv', 'Seleman', 'SMDA', 'Desa Seleman', 70, '-4.079778', '104.041667', '1'),
('SMDAINDOv2022101', '2022', 'OKU_051', 'GF', 'INDOv', 'Banjar Sari', 'SMDA', 'Dusun Banjar Sari', 72, '-4.091889', '104.086583', '1'),
('SMDAPRTLv2021100', '2021', 'OKU_066', 'GF', 'PRTLv', 'Tebing Kampung', 'SMDA', 'Tebing Kampung', 63, '-4.0655', '104.00961', '1'),
('SMDAPRTLv2021101', '2021', 'OKU_052', 'GF', 'PRTLv', 'Pengaringan', 'SMDA', 'jl. Lintas Sumatera KM.18 Dusun II', 40, '-4.08368', '104.07617', '1'),
('SMDAPRTLv2022100', '2022', 'OKU_066', 'GF', 'PRTLv', 'Tebing Kampung', 'SMDA', 'Tebing Kampung', 63, '-4.0655', '104.00961', '1'),
('SMDAPRTLv2022101', '2022', 'OKU_052', 'GF', 'PRTLv', 'Pengaringan', 'SMDA', 'JL. Lintas Sumatra KM 18 Dusun II', 40, '-4.08368', '104.07617', '1'),
('SMDASTPRv2021100', '2021', 'OKU_049', 'GF', 'STPRv', 'Seleman', 'SMDA', 'Kampung II', 71, '-4.09694', '104.19141', '1'),
('SMDASTPRv2021101', '2021', 'OKU_067', 'GF', 'STPRv', 'Padang Bindu', 'SMDA', 'jl. Lintas Sumatera', 71, '-4.06472', '103.9336', '1'),
('SMDASTPRv2021102', '2021', 'OKU_050', 'GF', 'STPRv', 'Pandan Dulang', 'SMDA', 'Dusun II', 71, '-4.09733', '104.09758', '1'),
('SMDASTPRv2022100', '2022', 'OKU_049', 'GF', 'STPRv', 'Seleman', 'SMDA', 'Kampung II', 71, '-4.09694', '104.19141', '1'),
('SMDASTPRv2022101', '2022', 'OKU_067', 'GF', 'STPRv', 'Padang Bindu', 'SMDA', 'Jl. Lintas Sumatera', 71, '-4.06472', '103.9336', '1'),
('SMDASTPRv2022102', '2022', 'OKU_050', 'GF', 'STPRv', 'Pandan Dulang', 'SMDA', 'Dusun II', 71, '-4.09733', '104.09758', '1'),
('SMDATBGRv2021100', '2021', 'OKU_067', 'GF', 'TBGRv', 'Padang Bindu', 'SMDA', 'jl. Lintas Sumatera Desa Padang Bindu Arah ke Goa Putri KPV', 72, '-4.06477', '103.93147', '1'),
('SMDATBGRv2021101', '2021', 'OKU_065', 'GF', 'TBGRv', 'Ulak Pandan', 'SMDA', 'Kampung Ulak Pandan', 72, '-4.08186', '103.97121', '1'),
('SMDATBGRv2022100', '2022', 'OKU_067', 'GF', 'TBGRv', 'Padang Bindu', 'SMDA', 'Jl. Lintas Sumatera Desa Padang Bindu Arah ke Goa putri KPV', 72, '-4.06477', '103.93147', '1'),
('SMDATBGRv2022101', '2022', 'OKU_065', 'GF', 'TBGRv', 'Ulak Pandan', 'SMDA', 'Kampung Ulak Pandan', 72, '-4.08186', '103.97121', '1'),
('SMDATLKMv2021100', '2021', 'OKU_065', 'GF', 'TLKMv', 'Ulak Pandan', 'SMDA', 'jl. Lintas Sumatera Dusun II', 72, '-4.08202778', '103.9711667', '1'),
('SMDATLKMv2021101', '2021', 'OKU_062', 'GF', 'TLKMv', 'Singapura', 'SMDA', 'jl. Lintas Sumatera', 72, '-4.08497222', '104.0529167', '1'),
('SMDATLKMv2022100', '2022', 'OKU_065', 'GF', 'TLKMv', 'Ulak Pandan', 'SMDA', 'Jl. Lintas Sumatera Dusun II', 72, '-4.08202778', '103.9711667', '1'),
('SMDATLKMv2022101', '2022', 'OKU_062', 'GF', 'TLKMv', 'Tangsi Lontar', 'SMDA', 'Jl. Lintas Sumatera', 72, '-4.08497222', '104.0529167', '1'),
('SPNJCMIDv2021100', '2021', '', 'GF', 'CMIDv', 'Karya Mukti', 'SPNJ', 'Dusun V Lubuk Rahayu', 71, '0', '0', '1'),
('SPNJCMIDv2022100', '2022', '', 'GF', 'CMIDv', 'Karya Mukti', 'SPNJ', 'Dusun V Lubuk Rahayu', 71, '0', '0', '1'),
('SPNJIBSJv2021100', '2021', 'OKU_004', 'GF', 'IBSJv', 'Marga Bhakti', 'SPNJ', 'Dusun III', 72, '-3.98674', '104.36253', '1'),
('SPNJIBSJv2022100', '2022', 'OKU_004', 'GF', 'IBSJv', 'Marga Bhakti', 'SPNJ', 'Dusun III', 72, '-3.98674', '104.36253', '1'),
('SPNJPRTLv2021100', '2021', 'OKU_013', 'GF', 'PRTLv', 'Sri Mulya', 'SPNJ', 'Blog H. Sri Mulya RT.08 RW.03', 35, '-3.90594', '104.40493', '1'),
('SPNJPRTLv2021101', '2021', 'OKU_088', 'GF', 'PRTLv', 'Karya Jaya', 'SPNJ', 'Kampung Baru RT.07 RW.02', 70, '-3.94549', '104.43233', '1'),
('SPNJPRTLv2022100', '2022', 'OKU_013', 'GF', 'PRTLv', 'Sri Mulya', 'SPNJ', 'Blok H. Sri Mulya RT 08 / 03 ', 35, '-3.90594', '104.40493', '1'),
('SPNJPRTLv2022101', '2022', 'OKU_088', 'GF', 'PRTLv', 'Karya Jaya', 'SPNJ', 'Kampung Baru RT.07/02', 70, '-3.94549', '104.43233', '1'),
('SPNJSTPRv2021100', '2021', 'OKU_004', 'GF', 'STPRv', 'Marga Bhakti', 'SPNJ', 'jl. Batu Marta II Blok E RT.01 RW.03 Dusun III', 71, '-3.98695', '104.36121', '1'),
('SPNJSTPRv2021101', '2021', 'OKU_014', 'GF', 'STPRv', 'Marga Mulya', 'SPNJ', 'jl. Raya Batu Marta Marga Mulya RT.015 RW.006', 71, '-3.88638', '104.43995', '1'),
('SPNJSTPRv2022100', '2022', 'OKU_004', 'GF', 'STPRv', 'Marga Bhakti', 'SPNJ', 'Jl. Batu Marta II Blok E RT.01/RW03 Dusun III', 71, '-3.98695', '104.36121', '1'),
('SPNJSTPRv2022101', '2022', 'OKU_014', 'GF', 'STPRv', 'Marga Mulya', 'SPNJ', 'Jl. Raya Batu Marta Marga Mulya RT 015/006', 71, '-3.88638', '104.43995', '1'),
('SPNJTBGRv2021100', '2021', 'OKU_011', 'GF', 'TBGRv', 'Karya Mukti', 'SPNJ', 'jl. Poros Batu Marta Lorong BPP RT.04 RW.05', 72, '-3.93609', '104.3919', '1'),
('SPNJTBGRv2021101', '2021', 'OKU_004', 'GF', 'TBGRv', 'Marga Bhakti', 'SPNJ', 'jl. Poros Desa Marga Bhakti RT.05 RW.03', 72, '-3.987', '104.36139', '1'),
('SPNJTBGRv2021102', '2021', 'OKU_086', 'GF', 'TBGRv', 'Tanjung Makmur', 'SPNJ', 'jl. Poros Desa TJ. Makmur (SP 3), Blok G Dsn. III, Ds. Tanjung Makmur', 72, '-3.90179', '104.47711', '1'),
('SPNJTBGRv2022100', '2022', 'OKU_011', 'GF', 'TBGRv', 'Karya Mukti', 'SPNJ', 'Jl. Poros Batu Marta Lorong BPP RT. 04/05', 72, '-3.93609', '104.3919', '1'),
('SPNJTBGRv2022101', '2022', 'OKU_004', 'GF', 'TBGRv', 'Marga Bhakti', 'SPNJ', 'Jl. Poros Desa Marga Bakti RT 05 RW 03', 72, '-3.987', '104.36139', '1'),
('SPNJTBGRv2022102', '2022', 'OKU_086', 'GF', 'TBGRv', 'Tanjung Makmur', 'SPNJ', 'Jl.Poros Ds.TJ.Makmur (SP 3),Blok G Dsn. III, Ds.Tanjung Makmur', 72, '-3.90179', '104.47711', '1'),
('SPNJTLKMv2021100', '2021', 'OKU_010', 'GF', 'TLKMv', 'Karya Mukti', 'SPNJ', 'Unit 12 Desa Karya Mukti', 72, '-3.96022222', '104.4063333', '1'),
('SPNJTLKMv2021101', '2021', 'OKU_003', 'GF', 'TLKMv', 'Marga Bhakti', 'SPNJ', 'Desa Marga Bhakti', 72, '-4.00083333', '104.3371944', '1'),
('SPNJTLKMv2022100', '2022', 'OKU_010', 'GF', 'TLKMv', 'Karya Mukti', 'SPNJ', 'Unit 12 Desa Karya Mukti ', 72, '-3.96022222', '104.4063333', '1'),
('SPNJTLKMv2022101', '2022', 'OKU_003', 'GF', 'TLKMv', 'Marga Bhakti', 'SPNJ', 'Desa Marga Bhakti', 72, '-4.00083333', '104.3371944', '1'),
('SSBRDYMTv2021100', '2021', 'OKU_057', 'GF', 'DYMTv', 'Persiapan Penantian', 'SSBR', 'jl. Baturaja Muara 2 Km 10, Dusun I', 71, '-4.19746', '104.12392', '1'),
('SSBRDYMTv2022100', '2022', 'OKU_057', 'GF', 'DYMTv', 'Persiapan Penantian', 'SSBR', 'Jl. Baturaja Muara 2 Km 10, Dusun I', 71, '-4.19746', '104.12392', '1'),
('SSBRIBSJv2021100', '2021', 'OKU_055', 'GF', 'IBSJv', 'Penantian', 'SSBR', 'Dusun III, RT.008', 52, '-4.18655', '104.11934', '1'),
('SSBRIBSJv2022100', '2022', 'OKU_055', 'GF', 'IBSJv', 'Penantian', 'SSBR', 'Dusun III, RT.008', 52, '-4.18655', '104.11934', '1'),
('SSBRIBSJv2022101', '2022', 'OKU_055', 'GF', 'IBSJv', 'Penantian', 'SSBR', 'Jl. Muara Dua', 73, '-4.18760', '104.12356', '1'),
('SSBRPRTLv2021100', '2021', 'OKU_055', 'GF', 'PRTLv', 'Penantian', 'SSBR', 'Desa Penantian RT.- RW.- Dusun III', 42, '-4.18467', '104.11844', '1'),
('SSBRPRTLv2022100', '2022', 'OKU_055', 'GF', 'PRTLv', 'Penantian', 'SSBR', 'Desa Penantian RT - /RW - Dusun III', 42, '-4.18467', '104.11844', '1'),
('SSBRTBGRv2021100', '2021', 'OKU_130', 'GF', 'TBGRv', 'Mekar Jaya', 'SSBR', 'Dusun II RT.003', 42, '-4.15623', '104.08766', '1'),
('SSBRTBGRv2021101', '2021', 'OKU_057', 'GF', 'TBGRv', 'Penyandingan', 'SSBR', 'Kampung I RT.001 RW.001', 72, '-4.20297', '104.12471', '1'),
('SSBRTBGRv2022100', '2022', 'OKU_130', 'GF', 'TBGRv', 'Mekar Jaya', 'SSBR', 'Dusun II RT.003', 42, '-4.15623', '104.08766', '1'),
('SSBRTBGRv2022101', '2022', 'OKU_057', 'GF', 'TBGRv', 'Penyandingan', 'SSBR', 'Kampung I RT.001/RW.001', 72, '-4.20297', '104.12471', '1'),
('SSBRTLKMv2021100', '2021', 'OKU_057', 'GF', 'TLKMv', 'Penyandingan', 'SSBR', 'jl. Pramuka No.33 Kampung I', 72, '-4.20341667', '104.1251111', '1'),
('SSBRTLKMv2022100', '2022', 'OKU_057', 'GF', 'TLKMv', 'Penyandingan', 'SSBR', 'Jl.Pramuka No.33 Kampung I', 72, '-4.20341667', '104.1251111', '1'),
('SSBRTRIIv2022100', '2022', 'OKU_057', 'GF', 'TRIIv', 'Lubuk Baru', 'SSBR', 'Jl. Lintas Muara Dua , Km. 9 (simpang Trans Rantau Kumpai)', 74, '-4.19564', '104.125235', '1'),
('ULOGINDOv2021100', '2021', 'OKU_071', 'GF', 'INDOv', 'Pedataran', 'ULOG', 'Desa Pedataran', 70, '-4.065783', '103.780096', '1'),
('ULOGINDOv2022100', '2022', 'OKU_071', 'GF', 'INDOv', 'Pedataran', 'ULOG', 'Desa Pedataran', 70, '-4.065783', '103.780096', '1'),
('ULOGPRTLv2021100', '2021', 'OKU_071', 'GF', 'PRTLv', 'Pedataran', 'ULOG', 'jl. Ulu Ogan', 70, '-4.06567', '103.78005', '1'),
('ULOGPRTLv2022100', '2022', 'OKU_071', 'GF', 'PRTLv', 'Pedataran', 'ULOG', 'Jl. Ulu Ogan', 70, '-4.06567', '103.78005', '1'),
('ULOGTLKMv2021100', '2021', 'OKU_072', 'GF', 'TLKMv', 'Pedataran', 'ULOG', 'Desa Pedataran', 112, '-4.07613889', '103.7650278', '1'),
('ULOGTLKMv2021101', '2021', 'OKU_074', 'GF', 'TLKMv', 'Sukajadi', 'ULOG', 'Desa Sukajadi', 72, '-4.10780556', '103.7665833', '1'),
('ULOGTLKMv2022100', '2022', 'OKU_072', 'GF', 'TLKMv', 'Pedataran', 'ULOG', 'Desa Pedataran ', 112, '-4.07613889', '103.7650278', '1'),
('ULOGTLKMv2022101', '2022', 'OKU_074', 'GF', 'TLKMv', 'Sukajadi', 'ULOG', 'Desa Sukajadi', 72, '-4.10780556', '103.7665833', '1'),
('ULOGXLXTv2021100', '2021', '', 'GF', 'XLXTv', 'Pedataran', 'ULOG', 'jl. Simpang Gerohong', 0, '0', '0', '1'),
('ULOGXLXTv2022100', '2022', '', 'GF', 'XLXTv', 'Pedataran', 'ULOG', 'Jl. Simpang Gerohong', 0, '0', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` varchar(50) NOT NULL DEFAULT '',
  `nama_pegawai` varchar(50) NOT NULL,
  `password` varchar(350) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `kode_role` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `status_akun` int(11) NOT NULL,
  `token` varchar(300) NOT NULL,
  `date_create` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nama_pegawai`, `password`, `no_hp`, `kode_role`, `alamat`, `status_akun`, `token`, `date_create`) VALUES
('090311818230099', 'SULTAN ARBAI', '$2y$10$vwjD97iZId.4OtrIM3ksVe1O2.scCqvOlzonAoWbWyTyRFuTnCTuy', '082217033655', '5', 'desa kebon sahang kec rambutan kab banyuasin', 1, '', 0),
('123', 'Sultan', '$2y$10$hRSGejpy.IFv.lvJLL.vXONsb9I57fQSzBLWYVEyoOO6zScQDZOf2', '085266779322', '2', 'address example', 1, '884701', 1654726562),
('12345', 'Putri Melati', '$2y$10$7YzQ3CsA/ZcHoqruXtUI0egMMDU3CHjODSHOhlgyqdb40DFg2/7Hu', '082217033655', '2', 'address example', 1, '461399', 1654734288),
('123456', 'Richard De Morgan', '$2y$10$hO8CXhmpCMeqsqyQ5EMPVuZEprMi9fHc1Lx7.eTgtiO.5dq9/IWp2', '082217033655', '2', 'address example', 1, '390034', 1654734386),
('1234567', 'Achmad Subarjoe', '$2y$10$8YQLg.uictMjW9jzU6ot5ucPLYRCTmMC4g7seJEA6AF6B0Wf74vvK', '082217033655', '2', 'jl. Pegangsaan Bujur Sangkar', 1, '973508', 1654734437);

-- --------------------------------------------------------

--
-- Table structure for table `tb_provider`
--

CREATE TABLE `tb_provider` (
  `kode_provider` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `nama_provider` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `alamat_perusahaan` text CHARACTER SET utf8mb4 NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_provider`
--

INSERT INTO `tb_provider` (`kode_provider`, `nama_provider`, `alamat_perusahaan`, `icon`) VALUES
('CMIDv', 'CENTRATAMA MENARA INDONESIA', 'baturaja timur selalu', 'icon_5.png'),
('DYMTv', 'DAYA MITRA TELEKOMUNIKASI', 'baturaja', 'icon_2.png'),
('HCPTv', 'HCPT3', 'baturaja', 'icon_3.png'),
('IBSJv', 'INTI BANGUN SEJAHTERA', 'baturaja', 'icon_11.png'),
('INDOv', 'INDOSAT', 'baturaja', 'icon_8.png'),
('PRTLv', 'PROTELINDO', 'baturaja', 'icon_6.png'),
('STPRv', 'SOLUSI TUNAS PRATAMA', 'baturaja', 'icon_7.png'),
('TBGRv', 'TOWER BERSAMA GROUP', 'baturaja', 'icon_9.png'),
('TLKMv', 'TELKOMSEL', 'baturaja', 'icon_1.png'),
('TRIIv', '3', 'baturaja', 'new_icon_png.png'),
('XLXTv', 'XL AXIATA', 'baturaja', 'icon_4.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `kode_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`kode_role`, `nama_role`) VALUES
(2, 'pimpinan'),
(5, 'operator');

-- --------------------------------------------------------

--
-- Table structure for table `tb_zona`
--

CREATE TABLE `tb_zona` (
  `site_id` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `kode_kecamatan` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `latitude` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `longitude` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `jumlah_menara` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_zona`
--

INSERT INTO `tb_zona` (`site_id`, `status`, `kode_kecamatan`, `latitude`, `longitude`, `jumlah_menara`) VALUES
('OKU_001', 'eksisting', 'LBRJ', '-4.06301', '104.289', 11),
('OKU_002', 'eksisting', 'LBRJ', '-4.03434', '104.306', 2),
('OKU_003', 'eksisting', 'SPNJ', '-4.00094', '104.337', 2),
('OKU_004', 'eksisting', 'SPNJ', '-3.98743', '104.361', 6),
('OKU_005', 'eksisting', 'PNNJ', '-3.99668', '104.287', 2),
('OKU_006', 'eksisting', 'LBBT', '-4.01208', '104.269', 2),
('OKU_007', 'eksisting', 'LBBT', '-4.01658', '104.26', 2),
('OKU_008', 'eksisting', 'LBBT', '-4.02674', '104.229', 2),
('OKU_009', 'eksisting', 'LBBT', '-4.05435', '104.22', 4),
('OKU_010', 'eksisting', 'SPNJ', '-3.96019', '104.406', 2),
('OKU_011', 'eksisting', 'SPNJ', '-3.9365', '104.391', 2),
('OKU_012', 'eksisting', 'PNNJ', '-3.93863', '104.339', 4),
('OKU_013', 'eksisting', 'SPNJ', '-3.90617', '104.405', 2),
('OKU_014', 'eksisting', 'SPNJ', '-3.88699', '104.44', 2),
('OKU_015', 'eksisting', 'PNNJ', '-3.90238', '104.36', 2),
('OKU_016', 'eksisting', 'PNNJ', '-3.88272', '104.377', 4),
('OKU_017', 'eksisting', 'PNNJ', '-3.87289', '104.38', 4),
('OKU_018', 'eksisting', 'PNNJ', '-3.82503', '104.463', 4),
('OKU_019', 'eksisting', 'PNNJ', '-3.80915', '104.308', 2),
('OKU_020', 'eksisting', 'LBRJ', '-4.1341', '104.292', 2),
('OKU_021', 'eksisting', 'LBRJ', '-4.14334', '104.308', 8),
('OKU_022', 'eksisting', 'LBRJ', '-4.15424', '104.303', 2),
('OKU_023', 'eksisting', 'LBRJ', '-4.18576', '104.288', 4),
('OKU_024', 'eksisting', 'LBRJ', '-4.20448', '104.273', 2),
('OKU_025', 'eksisting', 'BTRT', '-4.21964', '104.256', 4),
('OKU_026', 'eksisting', 'BTRT', '-4.19547', '104.225', 2),
('OKU_027', 'eksisting', 'BTRT', '-4.17216', '104.205', 2),
('OKU_028', 'eksisting', 'BTRT', '-4.16514', '104.197', 4),
('OKU_029', 'eksisting', 'BTRT', '-4.14355', '104.18', 4),
('OKU_030', 'eksisting', 'BTRT', '-4.13189', '104.189', 3),
('OKU_031', 'eksisting', 'BTRT', '-4.12463', '104.204', 8),
('OKU_032', 'eksisting', 'BTRT', '-4.12014', '104.192', 4),
('OKU_033', 'eksisting', 'BTRT', '-4.11412', '104.186', 2),
('OKU_034', 'eksisting', 'BTRT', '-4.12272', '104.184', 6),
('OKU_035', 'eksisting', 'BTRB', '-4.12807', '104.178', 5),
('OKU_036', 'eksisting', 'BTRT', '-4.12492', '104.171', 6),
('OKU_037', 'eksisting', 'BTRT', '-4.11895', '104.176', 7),
('OKU_038', 'eksisting', 'BTRT', '-4.1274', '104.163', 8),
('OKU_039', 'eksisting', 'BTRB', '-4.13227', '104.156', 2),
('OKU_040', 'eksisting', 'BTRB', '-4.12611', '104.145', 2),
('OKU_041', 'eksisting', 'BTRT', '-4.1145', '104.167', 2),
('OKU_042', 'eksisting', 'BTRT', '-4.11082', '104.176', 4),
('OKU_043', 'eksisting', 'BTRB', '-4.11971', '104.135', 0),
('OKU_044', 'eksisting', 'BTRB', '-4.10834', '104.133', 4),
('OKU_045', 'eksisting', 'BTRB', '-4.10633', '104.143', 4),
('OKU_046', 'eksisting', 'LBBT', '-4.0488', '104.195', 2),
('OKU_047', 'eksisting', 'LBBT', '-4.06467', '104.212', 2),
('OKU_048', 'eksisting', 'LBBT', '-4.07279', '104.207', 2),
('OKU_049', 'eksisting', 'BTRT', '-4.09687', '104.191', 4),
('OKU_050', 'eksisting', 'SMDA', '-4.0984', '104.097', 2),
('OKU_051', 'eksisting', 'SMDA', '-4.09228', '104.086', 2),
('OKU_052', 'eksisting', 'SMDA', '-4.08406', '104.076', 2),
('OKU_053', 'eksisting', 'BTRB', '-4.16572', '104.135', 6),
('OKU_054', 'eksisting', 'BTRB', '-4.15654', '104.137', 2),
('OKU_055', 'eksisting', 'SSBR', '-4.1854', '104.118', 5),
('OKU_056', 'eksisting', 'SSBR', '-4.24015', '104.106', 1),
('OKU_057', 'eksisting', 'SSBR', '-4.20107', '104.124', 7),
('OKU_058', 'eksisting', 'LGKT', '-4.32318', '104.089', 8),
('OKU_059', 'eksisting', 'LGKT', '-4.3568', '104.114', 4),
('OKU_060', 'eksisting', 'LGKT', '-4.40343', '104.14', 2),
('OKU_061', 'eksisting', 'LGKT', '-4.31076', '104.01', 2),
('OKU_062', 'eksisting', 'SMDA', '-4.08521', '104.054', 2),
('OKU_063', 'eksisting', 'SMDA', '-4.08043', '104.043', 2),
('OKU_064', 'eksisting', 'SMDA', '-4.07604', '104.027', 2),
('OKU_065', 'eksisting', 'SMDA', '-4.08206', '103.971', 4),
('OKU_066', 'eksisting', 'SMDA', '-4.06639', '104.009', 4),
('OKU_067', 'eksisting', 'SMDA', '-4.06466', '103.932', 4),
('OKU_068', 'eksisting', 'PNGD', '-4.05463', '103.878', 6),
('OKU_069', 'eksisting', 'PNGD', '-4.06304', '103.838', 2),
('OKU_070', 'eksisting', 'PNGD', '-4.04679', '103.789', 1),
('OKU_071', 'eksisting', 'PNGD', '-4.0661', '103.78', 4),
('OKU_072', 'eksisting', 'ULOG', '-4.0769', '103.766', 2),
('OKU_073', 'eksisting', 'ULOG', '-4.08292', '103.757', 2),
('OKU_074', 'eksisting', 'ULOG', '-4.10853', '103.767', 4),
('OKU_075', 'eksisting', 'LBBT', '-3.95209', '104.122', 6),
('OKU_076', 'eksisting', 'LBBT', '-3.90086', '104.114', 2),
('OKU_077', 'eksisting', 'BTRT', '-4.10351', '104.172', 2),
('OKU_078', 'eksisting', 'BTRT', '-4.11005', '104.19939', 2),
('OKU_079', 'new', 'LGKT', '-4.41539', '103.925', 0),
('OKU_080', 'new', 'KPNR', '-3.80848', '104.519', 0),
('OKU_081', 'new', 'MRJY', '-4.1374', '103.781', 0),
('OKU_082', 'new', 'KPNR', '-3.8545', '104.514', 0),
('OKU_083', 'new', 'MRJY', '-4.12385', '103.829', 0),
('OKU_084', 'eksisting', 'PNNJ', '-3.78286', '104.493', 2),
('OKU_085', 'new', 'PNGD', '-4.03214', '103.829', 0),
('OKU_086', 'eksisting', 'SPNJ', '-3.90457', '104.476', 2),
('OKU_087', 'new', 'MRJY', '-4.09226', '103.849', 0),
('OKU_088', 'eksisting', 'SPNJ', '-3.93946', '104.441', 2),
('OKU_089', 'new', 'PNGD', '-4.03718', '103.872', 0),
('OKU_090', 'eksisting', 'PNNJ', '-3.78564', '104.439', 2),
('OKU_091', 'new', 'MRJY', '-4.08936', '103.876', 0),
('OKU_092', 'eksisting', 'PNNJ', '-3.84024', '104.434', 4),
('OKU_093', 'new', 'SMDA', '-3.98515', '103.88', 0),
('OKU_094', 'new', 'PNNJ', '-3.80528', '104.379', 0),
('OKU_095', 'new', 'MRJY', '-4.13815', '103.886', 0),
('OKU_096', 'eksisting', 'PNNJ', '-3.78351', '104.358', 2),
('OKU_097', 'new', 'SMDA', '-4.01488', '103.904', 0),
('OKU_098', 'new', 'SPNJ', '-3.95924', '104.356', 0),
('OKU_099', 'new', 'SMDA', '-3.94611', '103.91', 0),
('OKU_100', 'eksisting', 'PNNJ', '-3.85753', '104.35', 2),
('OKU_101', 'new', 'PNGD', '-4.08612', '103.919', 0),
('OKU_102', 'new', 'PNNJ', '-3.81515', '104.341', 0),
('OKU_103', 'eksisting', 'SMDA', '-4.04898', '103.919', 2),
('OKU_104', 'new', 'PNNJ', '-3.89287', '104.324', 0),
('OKU_105', 'new', 'PNNJ', '-3.83851', '104.322', 0),
('OKU_106', 'new', 'LGKT', '-4.28931', '103.966', 0),
('OKU_107', 'new', 'SPNJ', '-4.0122', '104.319', 0),
('OKU_108', 'new', 'PNGD', '-4.11693', '103.97', 0),
('OKU_109', 'eksisting', 'PNNJ', '-3.96269', '104.313', 2),
('OKU_110', 'new', 'PNGD', '-4.95914', '103.976', 0),
('OKU_111', 'new', 'LBRJ', '-4.16831', '104.298', 0),
('OKU_112', 'new', 'LGKT', '-4.33442', '103.988', 0),
('OKU_113', 'new', 'PNNJ', '-3.76898', '104.288', 0),
('OKU_114', 'new', 'SMDA', '-3.92428', '103.992', 0),
('OKU_115', 'new', 'LBRJ', '-4.10137', '104.285', 0),
('OKU_116', 'new', 'SMDA', '-4.09964', '104.017', 0),
('OKU_117', 'new', 'LBBT', '-3.9088', '104.273', 0),
('OKU_118', 'new', 'SSBR', '-4.16465', '104.036', 0),
('OKU_119', 'new', 'PNNJ', '-3.82156', '104.259', 0),
('OKU_120', 'new', 'SMDA', '-4.02264', '104.042', 0),
('OKU_121', 'new', 'BTRT', '-4.12513', '104.252', 0),
('OKU_122', 'eksisting', 'LGKT', '-4.22583', '104.058', 3),
('OKU_123', 'new', 'BTRT', '-4.19883', '104.251', 0),
('OKU_124', 'new', 'SMDA', '-4.11347', '104.058', 0),
('OKU_125', 'eksisting', 'LBBT', '-3.97274', '104.246', 2),
('OKU_126', 'new', 'LBBT', '-3.91847', '104.063', 0),
('OKU_127', 'new', 'LBBT', '-3.86119', '104.244', 0),
('OKU_128', 'eksisting', 'LBBT', '-3.9697', '104.075', 2),
('OKU_129', 'new', 'BTRT', '-4.14079', '104.22', 0),
('OKU_130', 'eksisting', 'SSBR', '-4.15912', '104.097', 2),
('OKU_131', 'new', 'LBBT', '-3.94784', '104.208', 0),
('OKU_132', 'new', 'BTRB', '-4.06232', '104.122', 0),
('OKU_133', 'eksisting', 'SSBR', '-4.16048', '104.185', 2),
('OKU_134', 'new', 'LBBT', '-4.04374', '104.147', 0),
('OKU_135', 'new', 'LBBT', '-4.0164', '104.182', 0),
('OKU_136', 'eksisting', 'BTRB', '-4.10214', '104.156', 4),
('OKU_137', 'eksisting', 'LBBT', '-3.94917', '104.167', 2),
('OKU_999', 'eksisting', 'LGKT', '-4.285751295678592', '104.14764404296875', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_access`
--
ALTER TABLE `tb_access`
  ADD PRIMARY KEY (`kode_access`);

--
-- Indexes for table `tb_atribut`
--
ALTER TABLE `tb_atribut`
  ADD PRIMARY KEY (`kode_atribut`);

--
-- Indexes for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`),
  ADD UNIQUE KEY `kode_kecamatan` (`kode_kecamatan`);

--
-- Indexes for table `tb_menara`
--
ALTER TABLE `tb_menara`
  ADD PRIMARY KEY (`kode_menara`) USING BTREE;

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_provider`
--
ALTER TABLE `tb_provider`
  ADD PRIMARY KEY (`kode_provider`) USING BTREE;

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`kode_role`);

--
-- Indexes for table `tb_zona`
--
ALTER TABLE `tb_zona`
  ADD PRIMARY KEY (`site_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_access`
--
ALTER TABLE `tb_access`
  MODIFY `kode_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `tb_atribut`
--
ALTER TABLE `tb_atribut`
  MODIFY `kode_atribut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `kode_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
