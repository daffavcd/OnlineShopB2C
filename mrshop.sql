-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 05:23 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_produk`
--

CREATE TABLE `data_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_produk`
--

INSERT INTO `data_produk` (`id`, `nama_produk`, `stok`, `id_kategori`, `harga`, `deskripsi`, `gambar`) VALUES
(1, 'Iphone 10', 2, 5, 8500000, 'Produk iPhone terbaru dari Apple memiliki keunggulan yang menjadi tolok ukur baru, baik bagi konsumen maupun produsen. Meski begitu, masih menarik untuk menengok kembali iPhone generasi sebelumnya. Salah satu alasannya karena harganya yang sudah lebih terjangkau. \r\n\r\nDi 2021 ini, iPhone X tentunya masih sangat menarik untuk dipertimbangkan. Selain telah mengusung layar dengan bezel tipis, spesifikasinya yang masih terhitung tinggi, dan harga iPhone X, tentunya, sudah lebih murah dari awal kemunculannya. \r\n\r\nSelain unggul berkat inovasi desainnya, kelebihan iPhone X memiliki berhasil hadir sebagai pembanding saat smartphone dari merek lain dirilis. Meski kamu ingin membeli smartphone entry-level, mungkin kamu secara tidak sadar membandingkan fiturnya dengan iPhone X.', 'iphone10.png'),
(2, 'Nasi Goreng Pete ', 15, 6, 14000, 'Nasi goreng dengan petai dan daging kambing. Juga dilengkapi telur ceplok, acar, emping, irisan tomat dan mentimun, bawang goreng dan cabai. Restoran Hot Rocket, Sarinah Thamrin, Jakarta Pusat, Indonesia.', 'nasgor2.jpg'),
(3, 'ROG Strix 2023', 8, 5, 1600000, 'Spesifikasi ASUS ROG GL503GE EN023T\r\n\r\nDisplay : 15.6-inch Full HD (1920×1080) TN panel, 120Hz, 3ms, 94% NTSC\r\nProcessor : Intel® Core™ i7-8750H Processor 2.2 GHz (9M Cache, up to 4.1 GHz)\r\nMemory : 8GB DDR4, 2666MHz (up to 32 GB)\r\nHard Drive : 1TB SSHD\r\nGraphics : NVIDIA® GeForce® GTX1050Ti 4GB GDDR5 VRAM\r\nOptical Drive : –\r\nOperating System : Windows 10 Home\r\nNetworking :\r\n802.11ac 2×2 Wave 2 WLAN\r\nBluetooth 4.1\r\nBluetooth version may vary as the OS upgrades\r\n\r\nSlots/Interface :\r\n1 x USB 3.1 Gen 2 (Type-C)\r\n3 x USB 3.1 Gen1, 1 x USB 2.0\r\n1 x mDP 1.2\r\n1 x HDMI 1.4\r\n1 x RJ-45 Jack\r\n1 x SD card slot\r\n1 x 3.5mm headphone and microphone combo jack\r\n1 x Kensington lock\r\n\r\nAudio :\r\n2x 3.5W speaker with Smart AMP technology\r\nArray Microphones\r\nKeyboard : Backlit chiclet keyboard, RGB 4 zones\r\nBattery : 4 Cells 64 Whrs Battery\r\nWebcam : 720P HD Web Camera\r\nSystem Dimensions : 38.4 x 26.2 x 2.3 cm (WxDxH)\r\nWeight :  2.6 kg\r\nWarranty : 2 Years ASUS Global Warranty\r\nBonus : ROG Backpack + Mouse', 'rog.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori`
--

CREATE TABLE `master_kategori` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kategori`
--

INSERT INTO `master_kategori` (`id`, `nama_kategori`, `gambar_kategori`) VALUES
(3, 'Sepatu', 'sepatu.png'),
(4, 'Tas', 'tas.png'),
(5, 'Elektronik', 'komputer.png'),
(6, 'Makanan', 'nasgor1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `master_user`
--

CREATE TABLE `master_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `upass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_user`
--

INSERT INTO `master_user` (`id`, `email`, `nama_user`, `uname`, `upass`, `alamat`, `telepon`) VALUES
(1, 'daffavcd@gmail.com', 'Muhammad Daffa', 'daffavcd', 'a4010dd809e3693357a05204d2df7172', 'JL Singah Sekar Maju No 56', '0892341234');

-- --------------------------------------------------------

--
-- Table structure for table `opsi_transaksi`
--

CREATE TABLE `opsi_transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `komentar` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opsi_transaksi`
--

INSERT INTO `opsi_transaksi` (`id`, `id_produk`, `jumlah`, `kode_transaksi`, `rating`, `komentar`, `keterangan`) VALUES
(1, 1, 1, 'KT_211004051111', 5, 'Bagus bet sesuai', 'warna pink'),
(2, 1, 1, 'KT_211004051457', 5, 'beli ke dua kali', 'warna biru'),
(3, 2, 1, 'KT_211004052146', 5, 'nyamann', 'tidak pedas');

-- --------------------------------------------------------

--
-- Table structure for table `opsi_transaksi_temp`
--

CREATE TABLE `opsi_transaksi_temp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user` int(11) NOT NULL,
  `biaya_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bukti_transfer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Belum Dibayar','Menunggu','Diterima','Selesai','Dikirim','Ditolak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode_transaksi`, `id_user`, `biaya_total`, `bukti_transfer`, `status`, `tgl_transaksi`) VALUES
(1, 'KT_211004051111', 1, '8534000', 'BT_211004051212.jpg', 'Selesai', '2021-10-04 00:00:00'),
(2, 'KT_211004051457', 1, '8534000', 'BT_211004051508.jpg', 'Selesai', '2021-10-04 00:00:00'),
(3, 'KT_211004052146', 1, '48000', 'BT_211004052206.png', 'Selesai', '2021-10-04 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_produk`
--
ALTER TABLE `data_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_user`
--
ALTER TABLE `master_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `opsi_transaksi`
--
ALTER TABLE `opsi_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opsi_transaksi_temp`
--
ALTER TABLE `opsi_transaksi_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_produk`
--
ALTER TABLE `data_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_user`
--
ALTER TABLE `master_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `opsi_transaksi`
--
ALTER TABLE `opsi_transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `opsi_transaksi_temp`
--
ALTER TABLE `opsi_transaksi_temp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
