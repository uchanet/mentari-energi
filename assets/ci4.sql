-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2020 at 10:19 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `title`, `picture`, `link`, `description`) VALUES
(1, '1', 'client_1.png', 'https://www.google.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.'),
(2, '2', 'client_2.png', 'https://www.google.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.'),
(3, '3', 'client_3.png', 'https://www.google.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.'),
(4, '4', 'client_4.png', 'https://www.google.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.'),
(5, '5', 'client_5.png', 'https://www.google.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.'),
(6, '6', 'client_6.png', 'https://www.google.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `target` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `seen` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N',
  `cc` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `attachment` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`, `target`, `date`, `subject`, `ip`, `seen`, `cc`, `attachment`) VALUES
(1, 'John Doe', 'john.doe@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.cillum dolore eu fugiat nulla pariatur.', 'mail@gmail.com', '2020-05-04 21:04:41', 'Information', '36.70.119.231', 'N', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forgot`
--

DROP TABLE IF EXISTS `forgot`;
CREATE TABLE `forgot` (
  `id` int(11) NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `label` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `link` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `target` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` int(11) NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `label`, `parent`, `link`, `target`, `icon`, `category`, `sort`) VALUES
(1, 'Home', 0, 'admin', '', 'fa fa-home', 1, 1),
(2, 'Blog', 0, '', '', 'fa fa-newspaper', 1, 2),
(3, 'Page', 0, 'admin/page', '', 'fa fa-file', 1, 7),
(4, 'Contact', 0, 'contact', '', '', 2, 9),
(5, 'Client', 0, 'admin/client', '', 'fa fa-users', 1, 10),
(6, 'User', 0, 'admin/user', '', 'fa fa-user', 1, 11),
(7, 'Role', 0, 'admin/role', '', 'fa fa-lock', 1, 12),
(8, 'Menu', 0, 'admin/menu', '', 'fa fa-list', 1, 13),
(9, 'Setting', 0, 'admin/setting', '', 'fa fa-cog', 1, 14),
(10, 'Post', 2, 'admin/post', '', '', 1, 3),
(11, 'Category', 2, 'admin/category', '', '', 1, 4),
(12, 'Comment', 2, 'admin/comment', '', '', 1, 5),
(13, 'Home', 0, '', '', '', 2, 1),
(14, 'Blog', 0, 'blog', '', '', 2, 2),
(15, 'Team', 0, 'team', '', '', 2, 5),
(16, 'About Us', 0, 'page/about-us', '', '', 2, 8),
(17, 'Contact', 0, 'admin/contact', '', 'fa fa-phone', 1, 6),
(18, 'News', 14, 'blog/category/news', '', '', 2, 3),
(19, 'Tech', 14, 'blog/category/tech', '', '', 2, 4),
(20, 'Sample Sub Sub Menu', 21, '#', '', '', 2, 7),
(21, 'Sample Sub Menu', 15, '#', '', '', 2, 6),
(22, 'Slider', 0, 'admin/slider', '', 'fa fa-image', 1, 8),
(23, 'Sponsor', 0, 'admin/sponsor', '', 'fa fa-ad', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `url`, `content`, `picture`, `active`) VALUES
(1, 'About Us', 'about-us', '<h1>XqipCMS</h1>\r\n<p>&nbsp;</p>\r\n<p><strong>Framework Codeigniter v4.0.3</strong></p>\r\n<p><strong>Frontend Template Lumire - Bootstrap 4</strong></p>\r\n<p><strong>Backend Template Cork - Bootstrap 4</strong></p>\r\n<p>&nbsp;</p>\r\n<h3>Feature</h3>\r\n<ul>\r\n<li>TinyMCE</li>\r\n<li>Responsive File Manager</li>\r\n<li>Datatables Serverside</li>\r\n<li>Menu Management Drag &amp; Drop</li>\r\n<li>Dynamic User Role Permission</li>\r\n<li>Easy Setting Management (site maintenance, favicon, logo, title, tag, description, smtp email, social media)</li>\r\n</ul>\r\n<h5>&nbsp;</h5>\r\n<h5>Xqip :)</h5>', 'CodeIgniter-620x350-c.png', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `tag` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `view` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `url`, `content`, `picture`, `active`, `category`, `tag`, `author`, `role`, `created`, `view`) VALUES
(1, 'Siapa Hacker yang Bobol Data Jutaan Akun Tokopedia', 'siapa-hacker-yang-bobol-data-jutaan-akun-tokopedia', '<p><strong>Jakarta</strong> - Sebanyak 15 juta informasi <a href=\"https://www.detik.com/tag/akun-tokopedia\">akun Tokopedia</a> dilaporkan dibobol oleh <a href=\"https://www.detik.com/tag/hacker\">hacker</a>. Bahkan pengamat mengatakan, total sebanyak 91 juta akun raksasa toko online itu sudah coba dijual di dark web senilai USD 5.000. Siapa kira-kira pelakunya?</p>\r\n<p>&nbsp;</p>\r\n<p>Jawabannya belum diketahui secara pasti sejauh ini. Laporan dari ZDnet menyebutkan, hacker yang masih belum terlacak itu mempublikasikan sebagian hasil hack Tokopedia di sebuah forum hacking terkenal.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Sang hacker mengklaim datanya diambil dalam serangan pada Maret 2020 dan (yang dipajang di forum) hanya bagian kecil dari seluruh database user yang diambil dalam hack,\" tulis ZDnet.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Pembocor itu mengatakan dia membagikan 15 juta sampel user dengan harapan seseorang bisa membantu menjebol password user, sehingga bisa digunakan untuk mengakses akun,\" papar media teknologi ini.</p>\r\n<p>&nbsp;</p>\r\n<p>Password akun Tokopedia memang masih terlindungi. Menurut Alfons Tanujaya, pengamat keamanan internet dari Vaksincom, password yang bocor tidak terbuka karena dalam bentuk hash yang dienkripsi dan untuk mengetahui kuncinya cukup sulit.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Password dengan hash itu, yang tidak bisa ditembus hacker, diamankan dengan algoritma hashing SHA2-384, saat ini dianggap aman, meskipun tidak sempurna,\" sebut ZDnet.</p>\r\n<p>&nbsp;</p>\r\n<p>Untuk pengamanan saat ini, user Tokopedia diminta mengganti password dan mengaktifkan two factor authentication. \"Dan ingat jangan pernah berikan kode verifikasi di WhatsApp dan SMS pada siapapun sekalipun dia mengaku dari Tokopedia,\" cetus Alfons.</p>\r\n<p>&nbsp;</p>\r\n<p>Tokopedia sendiri tengah menggelar investigasi. \"Saat ini, kami terus melakukan investigasi,\" kata VP of Corporate Communications Tokopedia, Nuraini Razak.</p>', '8b285991-43d4-479e-bde6-51033ee7a18e_43.jpg', 'Y', 2, 'hacker', 1, NULL, '2020-05-03 18:49:55', 21),
(2, 'Yamaha Patenkan Teknologi Keren: Sinyal Pelaporan Laka Lantas', 'yamaha-patenkan-teknologi-keren-sinyal-pelaporan-laka-lantas', '<p><strong>Suara.com - </strong>Perkembangan teknologi telah mendorong produsen otomotif berupaya menghadirkan fitur-fitur inovatif. Contohnya bisa dilihat pada <a href=\"https://www.suara.com/tag/yamaha\">Yamaha</a>.</p>\r\n<p>&nbsp;</p>\r\n<p>Dikutip dari <em>Visordown</em>, belum lama berselang, produsen berlogo garpu tala itu mematenkan sebuah teknologi keamanan terbaru. Yaitu sebuah sistem yang mampu mendeteksi kemungkinan pengendara terjatuh.</p>\r\n<figure class=\"image\"><img src=\"https://media.suara.com/pictures/653x366/2018/06/20/42845-detektor-keamanan-biker.png\" alt=\"Detektor keamanan buat biker [Grafis: Visordown].\" />\r\n<figcaption>Detektor keamanan buat biker. Sebagai ilustrasi [Grafis: Visordown].</figcaption>\r\n</figure>\r\n<p>Menariknya lagi, teknologi besutan Yamaha itu akan memberi sinyal kepada pihak ketiga saat pengendara terjatuh alias mengalami kecelakaan lalu lintas atau laka lantas. Dan dilengkapi dengan rincian lokasi kejadian. Tidak sampai di situ, sensor yang tertanam pada body motor akan segera memberikan sinyal kepada pengendara lain bila telah terjadi sebuah laka lantas di area sekitar kejadian.</p>\r\n<p>&nbsp;</p>\r\n<p>Keseluruhan kinerja sistem itu diwakili oleh sensor dan peranti pendukung buatan Yamaha dengan kemampuan mendeteksi motor saat bergerak tak normal, atau saat akan mengalami laka lantas. Namun soal spesifikasi Yamaha belum memerinci dengan jelas seperti apa sistem atau yang akan ditawarkan.</p>\r\n<p>&nbsp;</p>\r\n<p>Hanya disebutkan bahwa baru saja menanamkan teknologi keamanan terbaru itu pada motor sport produksinya. Dan bisa saja kelak akan disematkan untuk pelbagai model motor Yamaha lainnya.</p>\r\n<p>&nbsp;</p>\r\n<p>Sebagai catatan, sistem keamanan mutakhir seperti ini sebelumnya telah ditawarkan oleh BMW melalui teknologi BMW e-call system. Fungsinya memberi tanda bahaya saat berkendara. Namun Yamaha sedikit lebih unggul dengan teknologi yang mampu mengirim sinyal ke pihak ketiga.</p>\r\n<p>&nbsp;</p>\r\n<p>Kita nantikan bersama seperti apa kinerja dan spesifikasi teknisnya.</p>', '11878-logo-yamaha.jpg', 'Y', 2, 'motor', 1, NULL, '2020-05-03 18:52:30', 25),
(3, 'Update Corona RI 3 Mei: 11.192 Kasus Positif, 1.876 Sembuh, 845 Meninggal', 'update-corona-ri-3-mei-11-192-kasus-positif-1-876-sembuh-845-meninggal', '<p><strong>Jakarta</strong> - Pemerintah memperbarui data kasus <a href=\"https://www.detik.com/tag/virus-corona\">virus Corona</a> di wilayah Indonesia. Tercatat ada 11.192 kasus positif Corona per hari ini.</p>\r\n<p>Juru bicara pemerintah terkait penanganan virus Corona, Achmad Yurianto, memerinci data kasus Corona per Minggu (3/5/2020). Dari 11.192 kasus positif <a href=\"https://www.detik.com/tag/virus-corona\">Corona</a>, ada 1.876 pasien sembuh dan 845 meninggal dunia.</p>\r\n<p>&nbsp;</p>\r\n<p>Ini merupakan data yang dihimpun pemerintah pusat hingga pukul 12.00 WIB tadi. Data ini disampaikan Yuri dalam konferensi pers harian yang ditayangkan BNPB melalui kanal YouTube mereka.</p>\r\n<div class=\"clearfix\">&nbsp;</div>\r\n<p>Per Sabtu (2/5) kemarin, tercatat ada 10.843 kasus positif Corona di Indonesia. 1.665 pasien sembuh dan 831 orang meninggal dunia.</p>', '217f90f6-a6fc-4e5c-af34-2bb4ad055793_169.jpg', 'Y', 3, 'corona,indonesia', 1, NULL, '2020-05-03 18:56:59', 0),
(4, 'Populer Sepekan: Reemar Martin, Artis TikTok Filipina Dihujat Netizen +62', 'populer-sepekan-reemar-martin-artis-tiktok-filipina-dihujat-netizen-62', '<p><strong>Jakarta</strong> - Selama sepekan ini sosok Reemar Martin jadi berita terpopuler. Nama Reemar Martin mencuri perhatian publik setelah akun media sosialnya diserang oleh netizen Indonesia. Siapa Reemar Martin?</p>\r\n<p>&nbsp;</p>\r\n<div style=\"height: 0px; display: block;\">&nbsp;</div>\r\n<div id=\"_forkInArticleAdContainer\" style=\"width: 0px; height: 0px;\">&nbsp;</div>\r\n<p>Artis TikTok asal Filipina Reemar Martin dibanjiri ujaran kebencian dari netizen Indonesia terutama wanita. Namanya jadi perbincangan karena diduga banyak wanita Indonesia tak senang jika pacarnya mengidolakan Reemar Martin.</p>\r\n<p>&nbsp;</p>\r\n<p>Sosok Reemar Martin dengan parasnya yang cantik membuat dirinya populer di TikTok dan dikagumi pria. Para pria Indonesia yang mengidolakan kecantikan Reemar Martin ini lah dinilai sebagai penyebab dirinya dibenci oleh wanita Indonesia.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><img src=\"https://akcdn.detik.net.id/community/media/visual/2020/04/28/7c92715f-c78f-4f0a-bc95-bc92922d8ed6.jpeg?w=1080\" alt=\"\" width=\"50%\" /></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p>Pacar pria yang mengidolakan Reemar Martin ini merasa cemburu. Wanita Indonesia membenci Reemar Martin karena sosoknya membuat hubungan asmara dengan pacarnya berantakan.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Pakai pelet ya lu?\" komentar netizen Indonesia.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Eh inget ya gue ada dendam sama lu,\" tambah lainnya.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Fansnya orang Indo semua, tanpa orang Indo bisa apa lu,\" imbuh netizen Indonesia lainnya.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\"><img src=\"https://akcdn.detik.net.id/community/media/visual/2020/04/28/5a4a6b22-7215-4501-b29c-918dd8c5ed71.jpeg?w=1080\" alt=\"\" width=\"50%\" /></p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p>Tak sedikit dari netizen Indonesia mereport akun media sosial Reemar Martin hingga membuat media sosialnya keblokir. Reemar pun terpaksa harus membuat Facebook dan Instagram baru serta meminta netizen agar tak mereport akunnya lagi.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Ini akun baru aku @reemar.official18 . Akun Instagram dan Facebook ku diblokir. Jadi aku membuat yang baru lagi. Bisakah aku mendapatkan 500 ribu (followers) lagi,\" ungkap Reemar Martin di unggahan video TikToknya.</p>\r\n<p>&nbsp;</p>\r\n<p>Banyak netizen Indonesia lainnya menyayangkan rekan satu negara yang menghujat dan membenci Reemar Martin karena kecantikan yang dimilikinya. Tak sedikit dari mereka juga merasa malu.</p>\r\n<p>&nbsp;</p>\r\n<p>\"Maafin cewek Indo ya, mereka yang hate comment gue yang malu,\" komentar netizen.</p>', '541ae5ad-88ff-47de-8830-c17791995cd5_43.jpg', 'Y', 4, 'reemar,tiktok', 1, NULL, '2020-05-03 19:06:23', 13),
(5, 'Bandung Mencekam, Terekam CCTV Begal Sadis Beraksi, Korban Tabrak Rumah dan Terkapar di Jalan', 'bandung-mencekam-terekam-cctv-begal-sadis-beraksi-korban-tabrak-rumah-dan-terkapar-di-jalan', '<p><strong>GridMotor.id -&nbsp;</strong>Buat pemotor yang ingin keluar tengah malam, sebaiknya jangan dulu.</p>\r\n<p>&nbsp;</p>\r\n<p>Pasalnya, banyak aksi kriminal yang mengincar pemotor mulai dari <a href=\"https://gridmotor.motorplus-online.com/tag/begal\">begal</a>, maling, sampai jambret terjadi akhir-akhir ini.</p>\r\n<p>&nbsp;</p>\r\n<p>Namun, kalau memang terpaksa harus keluar tengah malam naik motor, pastikan memakai helm biar terhindar dari hal yang enggak diinginkan.</p>\r\n<p>&nbsp;</p>\r\n<p>Seperti pada video satu ini.</p>\r\n<p>&nbsp;</p>\r\n<p>Aksi begal kembali menyasar ke seorang pemotor di Bandung.</p>\r\n<p>&nbsp;</p>\r\n<p>Peristiwa itu pun terekam CCTV di lokasi kejadian dan diunggah akun Instagram @fakta.indo, Sabtu (2/5/2020).</p>\r\n<p>&nbsp;</p>\r\n<p>Kronologinya, sekitar jam 2.30 dini hari, dari stopan Jl. Rajawali korban dikejar-kejar oleh begal lalu ditendang.</p>\r\n<p>&nbsp;</p>\r\n<p>Tendangan pelaku begal membuat motor oleng dan menabrak dinding sebuah rumah.</p>\r\n<p>&nbsp;</p>\r\n<p>Korban akhirnya terjatuh di gapura Gg. Hasan Ali, Jl. Garuda, Kecamatan Andir, Kota Bandung.</p>\r\n<p>&nbsp;</p>\r\n<p>Usai menabrak, korban pun terkapar di jalan dan menahan sakit.</p>\r\n<p>&nbsp;</p>\r\n<p>Hal tersebut langsung dimanfaatkan pelaku begal untuk menggasak motor korban dan kabur.</p>\r\n<p>&nbsp;</p>\r\n<p>Beruntung, korban tidak mengalami luka serius.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: center;\">&nbsp;</p>\r\n<p style=\"text-align: center;\"><iframe id=\"instagram-embed-0\" class=\"instagram-media instagram-media-rendered\" style=\"background: white none repeat scroll 0% 0%; max-width: 540px; width: calc(100% - 2px); border-radius: 3px; border: 1px solid #dbdbdb; box-shadow: none; display: block; margin: 0px 0px 12px; min-width: 326px; padding: 0px;\" src=\"https://www.instagram.com/p/B_sJu96gDOW/embed/captioned/?cr=1&amp;v=12&amp;wp=518&amp;rd=https%3A%2F%2Fgridmotor.motorplus-online.com&amp;rp=%2Fread%2F292133906%2Fbandung-mencekam-terekam-cctv-begal-sadis-beraksi-korban-tabrak-rumah-dan-terkapar-di-jalan%3Fpage%3Dall#%7B%22ci%22%3A0%2C%22os%22%3A2435%7D\" height=\"686\" frameborder=\"0\" scrolling=\"no\" allowfullscreen=\"allowfullscreen\" data-instgrm-payload-id=\"instagram-media-payload-0\"></iframe></p>', '435478873.png', 'Y', 1, 'begal,motor,bandung', 1, NULL, '2020-05-03 19:11:33', 13),
(6, '3 Penjelasan soal Tonight Show Pamit, Benarkah Berakhir', '3-penjelasan-soal-tonight-show-pamit-benarkah-berakhir', '<p><strong>JawaPos.com</strong> &ndash; Program talk show komedi Tonight Show yang dipandu Desta dan Vincent memasuki episode terakhir pada Kamis malam (23/4). Namun, acara yang mengudara Senin&ndash;Jumat tiap pukul 21.00 itu tidak berhenti selamanya. &rsquo;&rsquo;Kami liburkan sementara di bulan puasa ini,&rsquo;&rsquo; ujar Vice President PR &amp; Corsec NET Dede Apriadi saat dihubungi kemarin sore (25/4).</p>\r\n<p>&nbsp;</p>\r\n<p>Penghentian sementara itu dilakukan untuk menyesuaikan pola prime time selama bulan puasa. &rsquo;&rsquo;Kalau malam, pas bulan puasa, biasanya orang udah enggak nonton TV,&rsquo;&rsquo; jelas Dede. Itu kali pertama program yang tayang sejak 2013 tersebut berhenti sementara.</p>\r\n<p>&nbsp;</p>\r\n<p>Terkait rencana setelah Ramadan, Dede belum bisa memastikan apakah Tonight Show akan tayang kembali atau tidak. &rsquo;&rsquo;Kita lihat nanti saja. Mungkin seminggu sebelum Lebaran kami umumkan,&rsquo;&rsquo; tambahnya.</p>\r\n<p>&nbsp;</p>\r\n<p>Di sisi lain, Desta, Vincent Rompies, Enzy Storia, dan Hesti Purwadinata selaku host dan co-host menerima kabar tentang penghentian tayang sementara itu sejak bulan lalu. &rsquo;&rsquo;Itung-itung biar fokus sama ibadah mereka selama puasa lah,&rsquo;&rsquo; kata Dede, normatif.</p>\r\n<p>&nbsp;</p>\r\n<p>Meski Tonight Show tak mengudara, Desta, Vincent, Enzy, dan Hesti tetap akan menghibur lewat platform lain. Kemarin malam, program Vincent &amp; Desta Show with Hesti Enzy tayang perdana di kanal YouTube Vincent &amp; Desta Show. Jam tayangnya sama dengan Tonight Show, yaitu pukul 21.00.</p>\r\n<p>&nbsp;</p>\r\n<p>Keket, manajer Hesti, menjelaskan bahwa Hesti tetap tampil bersama Vincent dan Desta di setiap episode. Konsep acara di YouTube juga dibuat persis dengan Tonight Show. &rsquo;&rsquo;Sebenarnya, bulan lalu pas dikasih tahu mau berhenti sementara (Hesti) sedih ya, karena sudah lama jadi bagian dari Tonight Show. Semoga program di YouTube ini bisa menghibur,&rsquo;&rsquo; ucap Keket saat dihubungi tadi malam.</p>\r\n<p>&nbsp;</p>\r\n<p>Sementara itu, program talk show komedi Ini Talkshow yang biasa tayang saat prime time (pukul 19.00) turut mengalami penyesuaian. Judulnya diubah menjadi Ini Ramadan dan tayang menjelang berbuka puasa. Yakni, pukul 16.30&ndash;18.00 WIB. &rsquo;&rsquo;Pas sahur kami tayangkan rerun-nya,&rsquo;&rsquo; imbuh Dede.<strong>&nbsp;</strong></p>', 'vincent-desta-640x446.jpg', 'Y', 4, 'tv', 1, NULL, '2020-05-03 19:24:24', 6);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

DROP TABLE IF EXISTS `post_category`;
CREATE TABLE `post_category` (
  `id` int(11) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` int(11) DEFAULT NULL,
  `url` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id`, `title`, `role`, `url`, `author`) VALUES
(1, 'News', NULL, 'news', NULL),
(2, 'Tech', NULL, 'tech', NULL),
(3, 'Health', NULL, 'health', NULL),
(4, 'Intermezzo', NULL, 'intermezzo', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_comment`
--

DROP TABLE IF EXISTS `post_comment`;
CREATE TABLE `post_comment` (
  `id` int(11) NOT NULL,
  `name` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `parent` int(11) DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post` int(11) NOT NULL,
  `seen` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comment`
--

INSERT INTO `post_comment` (`id`, `name`, `email`, `message`, `parent`, `date`, `post`, `seen`) VALUES
(1, 'John Doe', 'john.doe@gmail.com', 'sample comment', 0, '2020-05-04 21:05:37', 4, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `title` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `permission` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `title`, `permission`) VALUES
(1, 'Admin', '[[\"admin\",[\"1\",\"1\",\"1\"]],[\"admin\\/page\",[\"1\",\"1\",\"1\"]],[\"admin\\/client\",[\"1\",\"1\",\"1\"]],[\"admin\\/user\",[\"1\",\"1\",\"1\"]],[\"admin\\/role\",[\"1\",\"1\",\"1\"]],[\"admin\\/menu\",[\"1\",\"1\",\"1\"]],[\"admin\\/setting\",[\"1\",\"1\",\"1\"]],[\"admin\\/post\",[\"1\",\"1\",\"1\"]],[\"admin\\/category\",[\"1\",\"1\",\"1\"]],[\"admin\\/comment\",[\"1\",\"1\",\"1\"]],[\"admin\\/contact\",[\"1\",\"1\",\"1\"]],[\"admin\\/slider\",[\"1\",\"1\",\"1\"]],[\"admin\\/sponsor\",[\"1\",\"1\",\"1\"]]]'),
(2, 'Staff', '[[\"admin\",[\"2\",\"2\",\"2\"]],[\"admin\\/page\",[\"2\",\"2\",\"\"]],[\"admin\\/client\",[\"2\",\"2\",\"\"]],[\"admin\\/user\",[\"2\",\"2\",\"\"]],[\"admin\\/role\",[\"\",\"\",\"\"]],[\"admin\\/menu\",[\"\",\"\",\"\"]],[\"admin\\/setting\",[\"\",\"\",\"\"]],[\"admin\\/post\",[\"2\",\"2\",\"2\"]],[\"admin\\/category\",[\"2\",\"2\",\"2\"]],[\"admin\\/comment\",[\"2\",\"2\",\"\"]],[\"admin\\/contact\",[\"2\",\"2\",\"\"]],[\"admin\\/slider\",[\"2\",\"2\",\"\"]],[\"admin\\/sponsor\",[\"2\",\"2\",\"\"]]]'),
(3, 'Author', '[[\"admin\",[\"3\",\"3\",\"3\"]],[\"admin\\/page\",[\"\",\"\",\"\"]],[\"admin\\/client\",[\"\",\"\",\"\"]],[\"admin\\/user\",[\"\",\"\",\"\"]],[\"admin\\/role\",[\"\",\"\",\"\"]],[\"admin\\/menu\",[\"\",\"\",\"\"]],[\"admin\\/setting\",[\"\",\"\",\"\"]],[\"admin\\/post\",[\"3\",\"3\",\"3\"]],[\"admin\\/category\",[\"3\",\"3\",\"3\"]],[\"admin\\/comment\",[\"3\",\"3\",\"3\"]],[\"admin\\/contact\",[\"\",\"\",\"\"]],[\"admin\\/slider\",[\"\",\"\",\"\"]],[\"admin\\/sponsor\",[\"\",\"\",\"\"]]]');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `sitename` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Xqip',
  `sitetag` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitedescription` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitemail` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitephone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `siteaddress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitefacebook` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitetwitter` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `siteinstagram` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitelinkedin` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smtpmail` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smtppassword` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smtpuser` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smtpport` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitemaintenance` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N',
  `sitelogo` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `siteicon` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smtphost` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitegeolocation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sitemaintenancedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `sitename`, `sitetag`, `sitedescription`, `sitemail`, `sitephone`, `siteaddress`, `sitefacebook`, `sitetwitter`, `siteinstagram`, `sitelinkedin`, `smtpmail`, `smtppassword`, `smtpuser`, `smtpport`, `sitemaintenance`, `sitelogo`, `siteicon`, `smtphost`, `sitegeolocation`, `sitemaintenancedate`) VALUES
(1, 'XqipCMS', 'Xqip,CMS,Codeigniter 4,Indonesia,XqipCMS', 'This is a sample description of the XqipCMS.', 'mail@gmail.com', '62', 'tmii', 'fb', 'tw', 'igx', 'li', 'mail', 'password', 'mail@gmail.com', '465', '', 'sitelogo.png?v=8BFKxOXM6RJV5Yif', 'favicon.png?v=lp0IH2yFz6bo7BGw', 'smtp.gmail.com', '-6.301963, 106.895558', '2020-11-30 21:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `picture`, `description`) VALUES
(1, 'Marketing results you can measure', 'slider_Marketing_results_you_can_measure.png', 'The international language of marketing. The next generation of marketing. Creating more profitable customers. Quality without the cost.'),
(2, 'Accurate data for precision marketing', 'slider_Accurate_data_for_precision_marketing.png', 'Brand marketing that puts your vision into action! Putting vision into action. Accurate data for precision marketing. Your outsourced marketing team.');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

DROP TABLE IF EXISTS `sponsor`;
CREATE TABLE `sponsor` (
  `id` int(11) NOT NULL,
  `title` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expire` datetime DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `title`, `picture`, `link`, `expire`, `active`) VALUES
(5, 'Gojek: Ojek Online, Taksi Online, Pesan Makan', 'sponsor_Gojek.png', 'https:www.google.com', '2020-12-04 13:39:00', 'Y'),
(6, 'Tokopedia: Toko Online Terpercaya', 'sponsor_Tokopedia.png', 'https:www.google.com', '2020-09-04 15:39:00', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

DROP TABLE IF EXISTS `traffic`;
CREATE TABLE `traffic` (
  `id` int(11) NOT NULL,
  `ip` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `useragent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `impression` int(11) NOT NULL,
  `lastactivity` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `country` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `city` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isp` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`id`, `ip`, `useragent`, `impression`, `lastactivity`, `country`, `city`, `isp`) VALUES
(1, '127.0.0.1', 'test', 21, '2020-10-02 15:10:49', 'Indonesia', 'Jakarta', 'PT Telekomunikasi Indonesia'),
(2, '127.0.0.1', 'test', 12, '2020-10-03 15:18:55', 'Brazil', 'Sao Paulo', 'Telefonica Brasil S.a'),
(3, '127.0.0.1', 'test', 9, '2020-10-04 14:13:07', 'Burundi', 'Bujumbura', 'CBINET, Bujumbura, Burundi.'),
(4, '127.0.0.1', 'test', 21, '2020-10-05 00:26:39', 'China', 'Kunming', 'Tencent cloud computing Co., Ltd.'),
(5, '127.0.0.1', 'test', 17, '2020-10-06 22:08:09', 'Indonesia', 'Surabaya', 'Hutchison CP Telecommunications, PT'),
(6, '127.0.0.1', 'test', 13, '2020-10-07 00:40:13', 'China', 'Nanjing', 'ChinaNet'),
(7, '127.0.0.1', 'test', 24, '2020-10-08 15:08:58', 'United States', 'New York', 'DigitalOcean LLC'),
(8, '127.0.0.1', 'test', 6, '2020-10-09 13:20:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `picture` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'ava.jpg',
  `role` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '2',
  `registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lastlogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bio` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `email`, `password`, `picture`, `role`, `registered`, `lastlogin`, `active`, `facebook`, `twitter`, `bio`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'ava.jpg', '1', '2020-04-07 12:15:20', '2020-09-04 17:04:16', 'Y', 'fb', 'tw', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
(2, 'Staff', 'staff', 'staff@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'ava.jpg', '2', '2020-04-07 12:15:20', '2020-09-04 17:03:15', 'Y', 'facebook', 'twitter', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot`
--
ALTER TABLE `forgot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comment`
--
ALTER TABLE `post_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traffic`
--
ALTER TABLE `traffic`
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
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `forgot`
--
ALTER TABLE `forgot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_comment`
--
ALTER TABLE `post_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `traffic`
--
ALTER TABLE `traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
