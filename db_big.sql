-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Apr 2021 pada 06.08
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_big`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `nama_barang` varchar(225) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `foto_barang` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `nama_barang`, `harga_barang`, `keterangan`, `foto_barang`) VALUES
(20, 'barang A', 1200, 'berkualitas', 'apple-touch-icon.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `alamat_pemasangan` text NOT NULL,
  `tanggal_pemesanan` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_barang` varchar(225) NOT NULL,
  `harga_barang` int(11) NOT NULL,
  `panjang` int(11) NOT NULL,
  `lebar` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_pemesanan` varchar(100) NOT NULL,
  `bukti_pembayaran` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id_pemesanan`, `id_user`, `alamat_pemasangan`, `tanggal_pemesanan`, `nama_barang`, `harga_barang`, `panjang`, `lebar`, `total_harga`, `status_pemesanan`, `bukti_pembayaran`) VALUES
(20, 7, 'cikokol', '2021-04-11 03:04:55', 'barang A', 1200, 100, 100, 120000, 'Selesai', 'apple-touch-icon.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profil`
--

CREATE TABLE `tb_profil` (
  `id` int(11) NOT NULL,
  `tentang_perusahaan` text NOT NULL,
  `nama_website` varchar(125) NOT NULL,
  `logo_website` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_profil`
--

INSERT INTO `tb_profil` (`id`, `tentang_perusahaan`, `nama_website`, `logo_website`) VALUES
(1, 'Apakah Lorem Ipsum itu?\r\nLorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga telah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia mulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran Letraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring munculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga memiliki versi Lorem Ipsum.', 'BiG Company', 'office-building.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `password` varchar(225) NOT NULL,
  `foto` varchar(225) NOT NULL,
  `id_role` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `telepon`, `alamat`, `password`, `foto`, `id_role`, `date_created`) VALUES
(1, 'admin ganteng', 'admin@gmail.com', '0812119129', 'Kp kelapa', '$2y$10$HUf.okQfhUTQAD9JyVDmhuFZAOM57um5Qy7p5kRm73H8qlBQXZYli', 'produk_1584373086.jpg', 1, 1617180304),
(7, 'Atok Dalang', 'dalang@gmail.com', '08121212', 'Kp Rambutan Runtuh', '$2y$10$LhKaFtexJwjTpWeCKSOrs.sIlVbnTT4u9IwVO0koSNgKfH9s/oqIW', 'default.jpg', 2, 1618065031);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_access_menu`
--

CREATE TABLE `tb_user_access_menu` (
  `id_access` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_access_menu`
--

INSERT INTO `tb_user_access_menu` (`id_access`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 3),
(4, 1, 4),
(8, 1, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_menu`
--

CREATE TABLE `tb_user_menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_menu`
--

INSERT INTO `tb_user_menu` (`id_menu`, `menu`) VALUES
(1, 'Admin'),
(2, 'Barang'),
(3, 'User'),
(4, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user_sub_menu`
--

CREATE TABLE `tb_user_sub_menu` (
  `id_sub` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `submenu` varchar(150) NOT NULL,
  `url` varchar(200) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `urutan` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user_sub_menu`
--

INSERT INTO `tb_user_sub_menu` (`id_sub`, `id_menu`, `submenu`, `url`, `icon`, `urutan`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin/dashboard/index', 'fas fa-fw fa-tachometer-alt', 1, 1),
(2, 3, 'Home', 'user/dashboard', 'fas fa-fw fa-home', 1, 1),
(4, 3, 'About Us', 'user/about/index', 'fas fa-fw fa-archway', 2, 1),
(5, 2, 'Data Barang', 'admin/barang/index', 'fas fa-fw fa-shopping-cart', 1, 1),
(6, 3, 'Data Barang', 'user/barang/data_barang', 'fas fa-fw fa-shopping-cart', 3, 1),
(7, 3, 'Riwayat Pemesanan', 'user/barang/data_pemesanan', 'fas fa-fw fa-file-invoice', 4, 1),
(8, 2, 'Data Pemesanan', 'admin/barang/data_pemesanan', 'fas fa-fw fa-file-invoice', 2, 1),
(10, 1, 'Data User', 'admin/user/index', 'fas fa-fw fa-users', 2, 1),
(11, 1, 'About Us', 'admin/about/index', 'fas fa-fw fa-archway', 3, 1),
(12, 2, 'Transaksi Selesai', 'admin/barang/transaksi_selesai', 'fas fa-fw fa-list-alt', 3, 1),
(13, 4, 'Menu Management', 'admin/menu/index', 'fas fa-fw fa-bars', 1, 1),
(14, 4, 'Submenu Management', 'admin/menu/submenu', 'fas fa-fw fa-caret-square-down', 2, 1),
(15, 4, 'Menu Access', 'admin/menu/menu_akses', 'fas fa-fw fa-cog', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_variasi`
--

CREATE TABLE `tb_variasi` (
  `id_variasi` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `nama_variasi` varchar(225) DEFAULT NULL,
  `harga_variasi` int(11) DEFAULT NULL,
  `foto_variasi` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indeks untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_user_access_menu`
--
ALTER TABLE `tb_user_access_menu`
  ADD PRIMARY KEY (`id_access`);

--
-- Indeks untuk tabel `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  ADD PRIMARY KEY (`id_sub`);

--
-- Indeks untuk tabel `tb_variasi`
--
ALTER TABLE `tb_variasi`
  ADD PRIMARY KEY (`id_variasi`),
  ADD KEY `id_brg` (`id_brg`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_profil`
--
ALTER TABLE `tb_profil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_user_access_menu`
--
ALTER TABLE `tb_user_access_menu`
  MODIFY `id_access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_user_menu`
--
ALTER TABLE `tb_user_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_user_sub_menu`
--
ALTER TABLE `tb_user_sub_menu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_variasi`
--
ALTER TABLE `tb_variasi`
  MODIFY `id_variasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_variasi`
--
ALTER TABLE `tb_variasi`
  ADD CONSTRAINT `tb_variasi_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `tb_barang` (`id_brg`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
