-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2022 at 12:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `donasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama_bank` varchar(200) NOT NULL,
  `no_rekening` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`, `no_rekening`) VALUES
(1, 'BRI', '08090405551029');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `target` int(11) NOT NULL,
  `kekurangan` int(11) NOT NULL,
  `terkumpul` int(11) NOT NULL,
  `id_bencana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `target`, `kekurangan`, `terkumpul`, `id_bencana`) VALUES
(6, 'Beras', 500, 450, 50, 13),
(7, 'Sembako', 100, 10, 90, 14),
(8, 'beras', 200, 50, 150, 15);

-- --------------------------------------------------------

--
-- Table structure for table `bencana`
--

CREATE TABLE `bencana` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `id_daerah` int(11) NOT NULL,
  `bencana` varchar(200) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `target` int(11) NOT NULL,
  `kekurangan` int(11) NOT NULL,
  `terkumpul` int(11) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `konfirmasi` int(1) NOT NULL,
  `id_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bencana`
--

INSERT INTO `bencana` (`id`, `tanggal`, `id_daerah`, `bencana`, `deskripsi`, `id_user`, `target`, `kekurangan`, `terkumpul`, `gambar`, `konfirmasi`, `id_barang`) VALUES
(12, '2022-03-17', 1, 'banjir', 'menyebabkan jalanan licin, sehingga di harapkan warga hati-hati saat berkendara', 1, 1000000, 700000, 300000, 'default.png', 1, 0),
(13, '2022-03-17', 2, 'gempa', 'gempa menyebabkan beberapa rumah warga rusak', 1, 10000000, 10000000, 0, 'default.png', 1, 6),
(14, '2022-03-17', 3, 'longsor', 'longsor menutupi jalan sehingga warga harus putar arah', 1, 5000000, 5000000, 0, 'default.png', 1, 7),
(15, '2022-03-17', 4, 'Kebakaran', 'banyak rumah warga yang ikut hangus terbakar', 1, 20000000, 6999877, 13000123, 'default.png', 1, 8),
(16, '2022-03-20', 89, 'longsor susulan', 'Longsor menyebabkan jalanan tertutup', 1, 7000000, 0, 0, 'default.png', 1, 0),
(17, '2022-03-20', 14, 'banjir', 'knnhubububu', 1, 0, 0, 0, 'default.png', 0, 0),
(18, '2022-03-28', 9, 'banjir', 'rehwriuhi', 1, 0, 0, 0, 'default.png', 0, 0),
(19, '2022-03-28', 14, 'longsor', 'Rekaman video yang di-posting oleh CDAA menunjukkan tebing yang menjulang tinggi runtuh ke tambang di bawah. Longsor itu menimbulkan awan debu besar. Sementara para pekerja di bawah tebing itu terdeng', 1, 10000000, 0, 0, 'default.png', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `daerah`
--

CREATE TABLE `daerah` (
  `id` int(11) NOT NULL,
  `kode_pos` int(11) NOT NULL,
  `kecamatan` varchar(200) NOT NULL,
  `desa` varchar(200) NOT NULL,
  `longtitude` varchar(200) DEFAULT NULL,
  `latitude` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daerah`
--

INSERT INTO `daerah` (`id`, `kode_pos`, `kecamatan`, `desa`, `longtitude`, `latitude`) VALUES
(1, 56151, 'Bandongan', 'Bandongan', '110.184626', '-7.470175'),
(2, 56151, 'Bandongan', 'Banyuwangi', '110.193659', '-7.484064'),
(3, 56151, 'Bandongan', 'Gandusari', '110.184932', '-7.447979'),
(4, 56151, 'Bandongan', 'Kalegen', '110.15211937', '-7.45234957'),
(5, 56151, 'Bandongan', 'Kebonagung', NULL, NULL),
(6, 56151, 'Bandongan', 'Kedungsari', NULL, NULL),
(7, 56151, 'Bandongan', 'Ngepanrejo', '110.161106', '-7.438856'),
(8, 56151, 'Bandongan', 'Rejosari', '110.181311', '-7.46749'),
(9, 56151, 'Bandongan', 'Salamkanci', '110.178976', '-7.489263'),
(10, 56151, 'Bandongan', 'Sidorejo', NULL, NULL),
(11, 56151, 'Bandongan', 'Sukodadi', NULL, NULL),
(12, 56151, 'Bandongan', 'Sukosari', '110.181636', '-7.506641'),
(13, 56151, 'Bandongan', 'Tonoboyo', NULL, NULL),
(14, 56151, 'Bandongan', 'Trasan', '110.202802', '-7.467629'),
(15, 56553, 'Borobudur', 'Bigaran', NULL, NULL),
(16, 56553, 'Borobudur', 'Borobudur', '110.20138', '-7.60574'),
(17, 56553, 'Borobudur', 'Bumiharjo', NULL, NULL),
(18, 56553, 'Borobudur', 'Candirejo', NULL, NULL),
(19, 56553, 'Borobudur', 'Giripurno', NULL, NULL),
(20, 56553, 'Borobudur', 'Giritengah', '110.184932', '-7.637826'),
(21, 56553, 'Borobudur', 'Karanganyar', NULL, NULL),
(22, 56553, 'Borobudur', 'Karangrejo', NULL, NULL),
(23, 56553, 'Borobudur', 'Kebonsari', '110.159545', '-7.598782'),
(24, 56553, 'Borobudur', 'Kembanglimus', '110.180465', '-7.598231'),
(25, 56553, 'Borobudur', 'Kenalan', '110.226629', '-7.64608'),
(26, 56553, 'Borobudur', 'Majaksingi', NULL, NULL),
(27, 56553, 'Borobudur', 'Ngadiharjo', '110.167063', '-7.618138'),
(28, 56553, 'Borobudur', 'Ngargogondo', '110.214716', '-7.626109'),
(29, 56553, 'Borobudur', 'Sumbeng', NULL, NULL),
(30, 56553, 'Borobudur', 'Tanjungsari', NULL, NULL),
(31, 56553, 'Borobudur', 'Tegalarum', '110.165574', '-7.591244'),
(32, 56553, 'Borobudur', 'Tuksongo', '110.204291', '-7.620192'),
(33, 56553, 'Borobudur', 'Wanurejo', '110.220673', '-7.615548'),
(34, 56553, 'Borobudur', 'Wringinputih', '110.190889', '-7.586175'),
(35, 56191, 'Candimulyo', 'Bateh', NULL, NULL),
(36, 56191, 'Candimulyo', 'Candimulyo', NULL, NULL),
(37, 56191, 'Candimulyo', 'Giyanti', NULL, NULL),
(38, 56191, 'Candimulyo', 'Kebonrejo', NULL, NULL),
(39, 56191, 'Candimulyo', 'Kembaran', '110.269578', '-7.501307'),
(40, 56191, 'Candimulyo', 'Mejing', NULL, NULL),
(41, 56191, 'Candimulyo', 'Podosoko', '110.26153', '-7.528857'),
(42, 56191, 'Candimulyo', 'Purworejo', NULL, NULL),
(43, 56191, 'Candimulyo', 'Sidomulyo', NULL, NULL),
(44, 56191, 'Candimulyo', 'Sonorejo', '110.31003', '-7.483019'),
(45, 56191, 'Candimulyo', 'Surodadi', NULL, NULL),
(46, 56191, 'Candimulyo', 'Surojoyo', NULL, NULL),
(47, 56191, 'Candimulyo', 'Tampirkulon', NULL, NULL),
(48, 56191, 'Candimulyo', 'Tampirwetan', NULL, NULL),
(49, 56191, 'Candimulyo', 'Tegalsari', NULL, NULL),
(50, 56191, 'Candimulyo', 'Tambelang', NULL, NULL),
(51, 56191, 'Candimulyo', 'Tempak', '110.25547', '-7.509708'),
(52, 56191, 'Candimulyo', 'Tempursari', NULL, NULL),
(53, 56191, 'Candimulyo', 'Treten', '110.298115', '-7.49896'),
(54, 56482, 'Dukun', 'Banyubiru', NULL, NULL),
(55, 56482, 'Dukun', 'Banyudono', '110.31582', '-7.5468'),
(56, 56482, 'Dukun', 'Dukun', NULL, NULL),
(57, 56482, 'Dukun', 'Kalibening', NULL, NULL),
(58, 56482, 'Dukun', 'Keningar', '110.380033', '-7.539863'),
(59, 56482, 'Dukun', 'Ketunggeng', '110.31003', '-7.570165'),
(60, 56482, 'Dukun', 'Krinjing', NULL, NULL),
(61, 56482, 'Dukun', 'Mangunsoko', '110.356202', '-7.535888'),
(62, 56482, 'Dukun', 'Ngadipuro', '110.323434', '-7.560542'),
(63, 56482, 'Dukun', 'Ngargomulyo', '110.375956', '-7.553119'),
(64, 56482, 'Dukun', 'Paten', '110.369607', '-7.526273'),
(65, 56482, 'Dukun', 'Sengi', '110.368118', '-7.519939'),
(66, 56482, 'Dukun', 'Sewukan', NULL, NULL),
(67, 56482, 'Dukun', 'Sumber', '110.359545', '-7.544715'),
(68, 56482, 'Dukun', 'Wates', NULL, NULL),
(69, 56196, 'Grabag', 'Baleagung', '110.313009', '-7.393292'),
(70, 56196, 'Grabag', 'Banaran', '110.333023', '-7.39918'),
(71, 56196, 'Grabag', 'Banjarsari', NULL, NULL),
(72, 56196, 'Grabag', 'Banyusari', '110.308208', '-7.396996'),
(73, 56196, 'Grabag', 'Citrosono', NULL, NULL),
(74, 56196, 'Grabag', 'Cokro', '110.296626', '-7.410695'),
(75, 56196, 'Grabag', 'Giriwetan', NULL, NULL),
(76, 56196, 'Grabag', 'Grabag', NULL, NULL),
(77, 56196, 'Grabag', 'Kalikuto', NULL, NULL),
(78, 56196, 'Grabag', 'Kalipucang', NULL, NULL),
(79, 56196, 'Grabag', 'Kartoharjo', NULL, NULL),
(80, 56196, 'Grabag', 'Ketawang', '110.327903', '-7.410493'),
(81, 56196, 'Grabag', 'Klegen', '110.296626', '-7.400461'),
(82, 56196, 'Grabag', 'Kleteran', NULL, NULL),
(83, 56196, 'Grabag', 'Lebak', NULL, NULL),
(84, 56196, 'Grabag', 'Losari', NULL, NULL),
(85, 56196, 'Grabag', 'Ngasinan', '110.345776', '-7.384071'),
(86, 56196, 'Grabag', 'Ngrancah', NULL, NULL),
(87, 56196, 'Grabag', 'Pesidi', '110.31003', '-7.421575'),
(88, 56196, 'Grabag', 'Pucungsari', NULL, NULL),
(89, 56196, 'Grabag', 'Salam', '110.307612', '-7.412365'),
(90, 56196, 'Grabag', 'Sambungrejo', '110.363649', '-7.357665'),
(91, 56196, 'Grabag', 'Seworan', '110.338329', '-7.344801'),
(92, 56196, 'Grabag', 'Sidogede', '110.321945', '-7.354516'),
(93, 56196, 'Grabag', 'Sugihmas', NULL, NULL),
(94, 56196, 'Grabag', 'Sumurarum', '110.327903', '-7.384916'),
(95, 56196, 'Grabag', 'Tirto', '110.35385', '-7.37798'),
(96, 56196, 'Grabag', 'Tlogorejo', '110.353223', '-7.369658'),
(97, 56163, 'Kajoran', 'Bambusari', '110.071766', '-7.519999'),
(98, 56163, 'Kajoran', 'Bangsri', NULL, NULL),
(99, 56163, 'Kajoran', 'Banjaragung', NULL, NULL),
(100, 56163, 'Kajoran', 'Banjaretno', '110.111968', '-7.519374'),
(101, 56163, 'Kajoran', 'Bumiayu', '110.089397', '-7.52901'),
(102, 56163, 'Kajoran', 'Kajoran', '110.098154', '-7.511475'),
(103, 56163, 'Kajoran', 'Krinjing', '110.125369', '-7.507193'),
(104, 56163, 'Kajoran', 'Krumpakan', '110.085166', '-7.500121'),
(105, 56163, 'Kajoran', 'Kwaderan', NULL, NULL),
(106, 56163, 'Kajoran', 'Lesanpuro', '110.106012', '-7.537619'),
(107, 56163, 'Kajoran', 'Madugondo', NULL, NULL),
(108, 56163, 'Kajoran', 'Madukoro', NULL, NULL),
(109, 56163, 'Kajoran', 'Mangunrejo', NULL, NULL),
(110, 56163, 'Kajoran', 'Ngargosari', '110.097078', '-7.543177'),
(111, 56163, 'Kajoran', 'Ngendrosari', NULL, NULL),
(112, 56163, 'Kajoran', 'Pandanretno', NULL, NULL),
(113, 56163, 'Kajoran', 'Pandansari', NULL, NULL),
(114, 56163, 'Kajoran', 'Pucungroto', '110.111968', '-7.491158'),
(115, 56163, 'Kajoran', 'Sambak', NULL, NULL),
(116, 56163, 'Kajoran', 'Sangen', NULL, NULL),
(117, 56163, 'Kajoran', 'Sidorejo', NULL, NULL),
(118, 56163, 'Kajoran', 'Sidowangi', '110.100056', '-7.4789'),
(119, 56163, 'Kajoran', 'Sukomulyo', NULL, NULL),
(120, 56163, 'Kajoran', 'Sukomakmur', NULL, NULL),
(121, 56163, 'Kajoran', 'Sukorejo', NULL, NULL),
(122, 56163, 'Kajoran', 'Sutopati', NULL, NULL),
(123, 56163, 'Kajoran', 'Wadas', NULL, NULL),
(124, 56163, 'Kajoran', 'Wonogiri', '110.065123', '-7.551759'),
(125, 56163, 'Kajoran', 'Wuwuharjo', '110.053899', '-7.525978'),
(126, 56153, 'Kaliangkrik', 'Balekerto', NULL, NULL),
(127, 56153, 'Kaliangkrik', 'Balerejo', NULL, NULL),
(128, 56153, 'Kaliangkrik', 'Banjarejo', NULL, NULL),
(129, 56153, 'Kaliangkrik', 'Beseran', NULL, NULL),
(130, 56153, 'Kaliangkrik', 'Bumirejo', NULL, NULL),
(131, 56153, 'Kaliangkrik', 'Girirejo', NULL, NULL),
(132, 56153, 'Kaliangkrik', 'Giriwarno', NULL, NULL),
(133, 56153, 'Kaliangkrik', 'Kaliangkrik', NULL, NULL),
(134, 56153, 'Kaliangkrik', 'Kebonlegi', NULL, NULL),
(135, 56153, 'Kaliangkrik', 'Ketangi', NULL, NULL),
(136, 56153, 'Kaliangkrik', 'Maduretno', NULL, NULL),
(137, 56153, 'Kaliangkrik', 'Mangli', NULL, NULL),
(138, 56153, 'Kaliangkrik', 'Munggangsari', NULL, NULL),
(139, 56153, 'Kaliangkrik', 'Ngargosoko', NULL, NULL),
(140, 56153, 'Kaliangkrik', 'Ngawonggo', NULL, NULL),
(141, 56153, 'Kaliangkrik', 'Ngendrokilo', NULL, NULL),
(142, 56153, 'Kaliangkrik', 'Pengarengan', NULL, NULL),
(143, 56153, 'Kaliangkrik', 'Selomoyo', NULL, NULL),
(144, 56153, 'Kaliangkrik', 'Temanggung', NULL, NULL),
(145, 56172, 'Mertoyudan', 'Banjarnegoro', NULL, NULL),
(146, 56172, 'Mertoyudan', 'Banyurojo', NULL, NULL),
(147, 56172, 'Mertoyudan', 'Bondowoso', NULL, NULL),
(148, 56172, 'Mertoyudan', 'Bulurejo', NULL, NULL),
(149, 56172, 'Mertoyudan', 'Danurejo', NULL, NULL),
(150, 56172, 'Mertoyudan', 'Deyangan', NULL, NULL),
(151, 56172, 'Mertoyudan', 'Donorojo', NULL, NULL),
(152, 56172, 'Mertoyudan', 'Jogonegoro', NULL, NULL),
(153, 56172, 'Mertoyudan', 'Kalinegoro', NULL, NULL),
(154, 56172, 'Mertoyudan', 'Mertoyudan', NULL, NULL),
(155, 56172, 'Mertoyudan', 'Pasuruhan', NULL, NULL),
(156, 56172, 'Mertoyudan', 'Sukorejo', NULL, NULL),
(157, 56512, 'Mungkid', 'Ambartawang', NULL, NULL),
(158, 56512, 'Mungkid', 'Mungkid', NULL, NULL),
(159, 56512, 'Mungkid', 'Blondo', NULL, NULL),
(160, 56512, 'Mungkid', 'Bumirejo', NULL, NULL),
(161, 56512, 'Mungkid', 'Gondang', NULL, NULL),
(162, 56512, 'Mungkid', 'Ngrajek', NULL, NULL),
(163, 56512, 'Mungkid', 'Pabelan', NULL, NULL),
(164, 56512, 'Mungkid', 'Pagersari', NULL, NULL),
(165, 56512, 'Mungkid', 'Paremono', NULL, NULL),
(166, 56512, 'Mungkid', 'Progowati', NULL, NULL),
(167, 56512, 'Mungkid', 'Rambeanak', NULL, NULL),
(168, 56512, 'Mungkid', 'Senden', NULL, NULL),
(169, 56512, 'Mungkid', 'Treko', NULL, NULL),
(170, 56412, 'Muntilan', 'Adikarto', NULL, NULL),
(171, 56412, 'Muntilan', 'Congkrang', NULL, NULL),
(172, 56412, 'Muntilan', 'Gondosuli', NULL, NULL),
(173, 56412, 'Muntilan', 'Gunungpring', NULL, NULL),
(174, 56412, 'Muntilan', 'Keji', NULL, NULL),
(175, 56412, 'Muntilan', 'Menayu', NULL, NULL),
(176, 56412, 'Muntilan', 'Ngawen', NULL, NULL),
(177, 56412, 'Muntilan', 'Pucungrejo', NULL, NULL),
(178, 56412, 'Muntilan', 'Sedayu', NULL, NULL),
(179, 56412, 'Muntilan', 'Sokorini', NULL, NULL),
(180, 56412, 'Muntilan', 'Sriwedari', NULL, NULL),
(181, 56412, 'Muntilan', 'Tamanagung', NULL, NULL),
(182, 56412, 'Muntilan', 'Tanjung', NULL, NULL),
(183, 56194, 'Ngablak', 'Bandungrejo', NULL, NULL),
(184, 56194, 'Ngablak', 'Genikan', NULL, NULL),
(185, 56194, 'Ngablak', 'Girirejo', NULL, NULL),
(186, 56194, 'Ngablak', 'Jogonayan', NULL, NULL),
(187, 56194, 'Ngablak', 'Jogoyasan', NULL, NULL),
(188, 56194, 'Ngablak', 'Kanigoro', NULL, NULL),
(189, 56194, 'Ngablak', 'Keditan', NULL, NULL),
(190, 56194, 'Ngablak', 'Madyogondo', NULL, NULL),
(191, 56194, 'Ngablak', 'Magersari', NULL, NULL),
(192, 56194, 'Ngablak', 'Ngablak', NULL, NULL),
(193, 56194, 'Ngablak', 'Pagergunung', NULL, NULL),
(194, 56194, 'Ngablak', 'Pandean', NULL, NULL),
(195, 56194, 'Ngablak', 'Selomirah', NULL, NULL),
(196, 56194, 'Ngablak', 'Seloprojo', NULL, NULL),
(197, 56194, 'Ngablak', 'Sumberejo', NULL, NULL),
(198, 56194, 'Ngablak', 'Tejosari', NULL, NULL),
(199, 56485, 'Ngluwar', 'Bligo', NULL, NULL),
(200, 56485, 'Ngluwar', 'Blongkeng', NULL, NULL),
(201, 56485, 'Ngluwar', 'Jamuskauman', NULL, NULL),
(202, 56485, 'Ngluwar', 'Karangtalun', NULL, NULL),
(203, 56485, 'Ngluwar', 'Ngluwar', NULL, NULL),
(204, 56485, 'Ngluwar', 'Pakunden', NULL, NULL),
(205, 56485, 'Ngluwar', 'Plosogede', NULL, NULL),
(206, 56485, 'Ngluwar', 'Somokaton', NULL, NULL),
(207, 56193, 'Pakis', 'Banyusidi', NULL, NULL),
(208, 56193, 'Pakis', 'Bawang', NULL, NULL),
(209, 56193, 'Pakis', 'Daleman Kidul', NULL, NULL),
(210, 56193, 'Pakis', 'Daseh', NULL, NULL),
(211, 56193, 'Pakis', 'Gejagan', NULL, NULL),
(212, 56193, 'Pakis', 'Gondangsari', NULL, NULL),
(213, 56193, 'Pakis', 'Gumelem', NULL, NULL),
(214, 56193, 'Pakis', 'Jambewangi', NULL, NULL),
(215, 56193, 'Pakis', 'Kajangkoso', NULL, NULL),
(216, 56193, 'Pakis', 'Kaponan', NULL, NULL),
(217, 56193, 'Pakis', 'Kenalan', NULL, NULL),
(218, 56193, 'Pakis', 'Ketundan', NULL, NULL),
(219, 56193, 'Pakis', 'Kragilan', NULL, NULL),
(220, 56193, 'Pakis', 'Losari', NULL, NULL),
(221, 56193, 'Pakis', 'Muneng', NULL, NULL),
(222, 56193, 'Pakis', 'Muneng Warangan', NULL, NULL),
(223, 56193, 'Pakis', 'Pakis', NULL, NULL),
(224, 56193, 'Pakis', 'Petung', NULL, NULL),
(225, 56193, 'Pakis', 'Pogalan', NULL, NULL),
(226, 56193, 'Pakis', 'Rejosari', NULL, NULL),
(227, 56484, 'Salam', 'Baturono', NULL, NULL),
(228, 56484, 'Salam', 'Gulon', NULL, NULL),
(229, 56484, 'Salam', 'Jumoyo', NULL, NULL),
(230, 56484, 'Salam', 'Kadiluwih', NULL, NULL),
(231, 56484, 'Salam', 'Mantingan', NULL, NULL),
(232, 56484, 'Salam', 'Salam', NULL, NULL),
(233, 56484, 'Salam', 'Seloboro', NULL, NULL),
(234, 56484, 'Salam', 'Sirahan', NULL, NULL),
(235, 56484, 'Salam', 'Somoketro', NULL, NULL),
(236, 56484, 'Salam', 'Sucen', NULL, NULL),
(237, 56484, 'Salam', 'Tersangede', NULL, NULL),
(238, 56484, 'Salam', 'Tirto', NULL, NULL),
(239, 56162, 'Salaman', 'Banjarharjo', NULL, NULL),
(240, 56162, 'Salaman', 'Jebengsari', NULL, NULL),
(241, 56162, 'Salaman', 'Kaliabu', NULL, NULL),
(242, 56162, 'Salaman', 'Kalirejo', NULL, NULL),
(243, 56162, 'Salaman', 'Kalisalak', NULL, NULL),
(244, 56162, 'Salaman', 'Kebonrejo', NULL, NULL),
(245, 56162, 'Salaman', 'Krasak', NULL, NULL),
(246, 56162, 'Salaman', 'Margoyoso', NULL, NULL),
(247, 56162, 'Salaman', 'Menoreh', NULL, NULL),
(248, 56162, 'Salaman', 'Ngadirejo', NULL, NULL),
(249, 56162, 'Salaman', 'Ngampeldento', NULL, NULL),
(250, 56162, 'Salaman', 'Ngargoretno', NULL, NULL),
(251, 56162, 'Salaman', 'Paripurno', NULL, NULL),
(252, 56162, 'Salaman', 'Purwosari', NULL, NULL),
(253, 56162, 'Salaman', 'Salaman', NULL, NULL),
(254, 56162, 'Salaman', 'Sawangargo', NULL, NULL),
(255, 56162, 'Salaman', 'Sidomulyo', NULL, NULL),
(256, 56162, 'Salaman', 'Sidosari', NULL, NULL),
(257, 56162, 'Salaman', 'Sriwedari', NULL, NULL),
(258, 56162, 'Salaman', 'Tanjunganom', NULL, NULL),
(259, 56481, 'Sawangan', 'Banyuroto', NULL, NULL),
(260, 56481, 'Sawangan', 'BUtuh', NULL, NULL),
(261, 56481, 'Sawangan', 'Gantang', NULL, NULL),
(262, 56481, 'Sawangan', 'Gondowangi', NULL, NULL),
(263, 56481, 'Sawangan', 'Jati', NULL, NULL),
(264, 56481, 'Sawangan', 'Kapuhan', NULL, NULL),
(265, 56481, 'Sawangan', 'Ketep', NULL, NULL),
(266, 56481, 'Sawangan', 'Krogowanan', NULL, NULL),
(267, 56481, 'Sawangan', 'Mangunsari', NULL, NULL),
(268, 56481, 'Sawangan', 'Podosoko', NULL, NULL),
(269, 56481, 'Sawangan', 'Sawangan', NULL, NULL),
(270, 56481, 'Sawangan', 'Soronalan', NULL, NULL),
(271, 56481, 'Sawangan', 'Tirtosari', NULL, NULL),
(272, 56481, 'Sawangan', 'Wonolelo', NULL, NULL),
(273, 56481, 'Sawangan', 'Wulung Gunung', NULL, NULL),
(274, 56195, 'Secang', 'Candiretno', NULL, NULL),
(275, 56195, 'Secang', 'Candisari', NULL, NULL),
(276, 56195, 'Secang', 'Donomulyo', NULL, NULL),
(277, 56195, 'Secang', 'Donorejo', NULL, NULL),
(278, 56195, 'Secang', 'Girikulon', NULL, NULL),
(279, 56195, 'Secang', 'Jambewangi', NULL, NULL),
(280, 56195, 'Secang', 'Kalijoso', NULL, NULL),
(281, 56195, 'Secang', 'Karangkajen', NULL, NULL),
(282, 56195, 'Secang', 'Krincing', NULL, NULL),
(283, 56195, 'Secang', 'Madiocondro', NULL, NULL),
(284, 56195, 'Secang', 'Madusari', NULL, NULL),
(285, 56195, 'Secang', 'Ngabean', NULL, NULL),
(286, 56195, 'Secang', 'Ngadirojo', NULL, NULL),
(287, 56195, 'Secang', 'Pancuranmas', NULL, NULL),
(288, 56195, 'Secang', 'Payaman', NULL, NULL),
(289, 56195, 'Secang', 'Pirikan', NULL, NULL),
(290, 56195, 'Secang', 'Pucang', NULL, NULL),
(291, 56195, 'Secang', 'Purwosari', NULL, NULL),
(292, 56195, 'Secang', 'Sidomulyo', NULL, NULL),
(293, 56483, 'Srumbung', 'Banyuadem', NULL, NULL),
(294, 56483, 'Srumbung', 'Bringin', NULL, NULL),
(295, 56483, 'Srumbung', 'Jerukagung', NULL, NULL),
(296, 56483, 'Srumbung', 'Kaliurang', NULL, NULL),
(297, 56483, 'Srumbung', 'Kamongan', NULL, NULL),
(298, 56483, 'Srumbung', 'Kemiren', NULL, NULL),
(299, 56483, 'Srumbung', 'Kradenan', NULL, NULL),
(300, 56483, 'Srumbung', 'Mranggen', NULL, NULL),
(301, 56483, 'Srumbung', 'Ngablak', NULL, NULL),
(302, 56483, 'Srumbung', 'Ngargosoko', NULL, NULL),
(303, 56483, 'Srumbung', 'Nglumut', NULL, NULL),
(304, 56483, 'Srumbung', 'Pandanretno', NULL, NULL),
(305, 56483, 'Srumbung', 'Polengan', NULL, NULL),
(306, 56483, 'Srumbung', 'Pucanganom', NULL, NULL),
(307, 56483, 'Srumbung', 'Srumbung', NULL, NULL),
(308, 56483, 'Srumbung', 'Sudimoro', NULL, NULL),
(309, 56483, 'Srumbung', 'Tegalrandu', NULL, NULL),
(310, 56192, 'Tegalrejo', 'Bayusari', NULL, NULL),
(311, 56192, 'Tegalrejo', 'Banyuurip', NULL, NULL),
(312, 56192, 'Tegalrejo', 'Dawung', NULL, NULL),
(313, 56192, 'Tegalrejo', 'Dlimas', NULL, NULL),
(314, 56192, 'Tegalrejo', 'Donorojo', NULL, NULL),
(315, 56192, 'Tegalrejo', 'Girirejo', NULL, NULL),
(316, 56192, 'Tegalrejo', 'Glagahombo', NULL, NULL),
(317, 56192, 'Tegalrejo', 'Japan', NULL, NULL),
(318, 56192, 'Tegalrejo', 'Kebonagung', NULL, NULL),
(319, 56192, 'Tegalrejo', 'Klopo', NULL, NULL),
(320, 56192, 'Tegalrejo', 'Mangunrejo', NULL, NULL),
(321, 56192, 'Tegalrejo', 'Ngadirejo', NULL, NULL),
(322, 56192, 'Tegalrejo', 'Ngasem', NULL, NULL),
(323, 56192, 'Tegalrejo', 'Purwodadi', NULL, NULL),
(324, 56192, 'Tegalrejo', 'Purwosari', NULL, NULL),
(325, 56192, 'Tegalrejo', 'Sidorejo', NULL, NULL),
(326, 56192, 'Tegalrejo', 'Soroyudan', NULL, NULL),
(327, 56192, 'Tegalrejo', 'Sukorejo', NULL, NULL),
(328, 56192, 'Tegalrejo', 'Tampingan', NULL, NULL),
(329, 56192, 'Tegalrejo', 'Tegalrejo', NULL, NULL),
(330, 56192, 'Tegalrejo', 'Wonokerto', NULL, NULL),
(331, 56161, 'Tempuran', 'Bawang', NULL, NULL),
(332, 56161, 'Tempuran', 'Girirejo', NULL, NULL),
(333, 56161, 'Tempuran', 'Growong', NULL, NULL),
(334, 56161, 'Tempuran', 'Jogomulyo', NULL, NULL),
(335, 56161, 'Tempuran', 'Kalisari', NULL, NULL),
(336, 56161, 'Tempuran', 'Kemutuk', NULL, NULL),
(337, 56161, 'Tempuran', 'Prajeksari', NULL, NULL),
(338, 56161, 'Tempuran', 'Prigombo', NULL, NULL),
(339, 56161, 'Tempuran', 'Ringinanom', NULL, NULL),
(340, 56161, 'Tempuran', 'Sidoagung', NULL, NULL),
(341, 56161, 'Tempuran', 'Sumberarum', NULL, NULL),
(342, 56161, 'Tempuran', 'Tanggulrejo', NULL, NULL),
(343, 56161, 'Tempuran', 'Temanggal', NULL, NULL),
(344, 56161, 'Tempuran', 'Tempurejo', NULL, NULL),
(345, 56161, 'Tempuran', 'Tugurejo', NULL, NULL),
(346, 56152, 'Windusari', 'Balesari', NULL, NULL),
(347, 56152, 'Windusari', 'Bandarsedayu', NULL, NULL),
(348, 56152, 'Windusari', 'Banjarsari', NULL, NULL),
(349, 56152, 'Windusari', 'Candisari', NULL, NULL),
(350, 56152, 'Windusari', 'Dampit', NULL, NULL),
(351, 56152, 'Windusari', 'Genito', NULL, NULL),
(352, 56152, 'Windusari', 'Girimulyo', NULL, NULL),
(353, 56152, 'Windusari', 'Gondangrejo', NULL, NULL),
(354, 56152, 'Windusari', 'Gunungsari', NULL, NULL),
(355, 56152, 'Windusari', 'Kalijoso', NULL, NULL),
(356, 56152, 'Windusari', 'Kembangkuning', NULL, NULL),
(357, 56152, 'Windusari', 'Kentengsari', NULL, NULL),
(358, 56152, 'Windusari', 'Mangunsari', NULL, NULL),
(359, 56152, 'Windusari', 'Ngemplak', NULL, NULL),
(360, 56152, 'Windusari', 'Pasangsari', NULL, NULL),
(361, 56152, 'Windusari', 'Semen', NULL, NULL),
(362, 56152, 'Windusari', 'Tanjungsari', NULL, NULL),
(363, 56152, 'Windusari', 'Umbulsari', NULL, NULL),
(364, 56152, 'Windusari', 'Windusari', NULL, NULL),
(365, 56152, 'Windusari', 'Wonoroto', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `donasi`
--

CREATE TABLE `donasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `donasi_uang` int(11) NOT NULL,
  `bukti` varchar(200) NOT NULL,
  `konfirmasi` int(1) NOT NULL,
  `konfirmasi_kurir` int(1) NOT NULL,
  `status_kurir` int(11) DEFAULT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `id_bencana` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donasi`
--

INSERT INTO `donasi` (`id`, `nama`, `no_hp`, `alamat`, `donasi_uang`, `bukti`, `konfirmasi`, `konfirmasi_kurir`, `status_kurir`, `jumlah_barang`, `id_bencana`, `id_user`) VALUES
(36, 'Ahmad Husain', '', '', 300000, 'Bukti-Transfer-PSB-El-tahfidz.jpeg', 1, 0, NULL, 0, 12, NULL),
(37, 'Rudi', '', '', 0, 'default.png', 1, 1, 1, 5, 14, NULL),
(38, 'Zara', '', '', 2000000, '2_juta.jpeg', 0, 0, NULL, 0, 14, NULL),
(39, 'Syahrul', '', '', 0, 'default.png', 1, 1, 1, 10, 14, NULL),
(40, 'Beni', '111', 'Sawitan', 0, 'default.png', 1, 0, 1, 10, 13, 8),
(41, 'zaki', '', '', 2000000, 'minimal-samurai-wallpaper.png', 1, 1, 1, 100, 15, NULL),
(42, 'admin', '', '', 123, 'teahub_io-21x9-wallpaper-2178838.jpg', 1, 0, NULL, 0, 15, NULL),
(43, 'testa', '321', 'Mungkid', 5500000, 'bukti.jpg', 1, 0, NULL, 0, 15, NULL),
(44, 'testa', '321', 'Mungkid', 0, 'default.png', 1, 1, 1, 40, 13, NULL),
(45, 'nisa', '123', 'Mertoyudan', 5500000, 'bukti1.jpg', 1, 0, 1, 50, 15, 8),
(46, 'doni', '888', 'Secang', 0, 'default.png', 1, 0, 2, 15, 14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'relawan'),
(3, 'kurir');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `no_hp` int(15) NOT NULL,
  `gambar` varchar(200) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_bank` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `alamat`, `no_hp`, `gambar`, `id_role`, `id_bank`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Magelang', 12345, '410685-russian-wallpaper-top-free-russian-background1.jpg', 1, 1),
(7, 'relawan', '626c9488745bc8691a99fae8f227b6ce', 'relawan', 'Mungkid', 12345, 'default.png', 2, NULL),
(8, 'kurir', 'bb31e9f1f03ad601eb8fb53e4f663039', 'kurir', 'Mertoyudan', 12345, 'default.png', 3, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bencana`
--
ALTER TABLE `bencana`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daerah`
--
ALTER TABLE `daerah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bencana`
--
ALTER TABLE `bencana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `daerah`
--
ALTER TABLE `daerah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

--
-- AUTO_INCREMENT for table `donasi`
--
ALTER TABLE `donasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
