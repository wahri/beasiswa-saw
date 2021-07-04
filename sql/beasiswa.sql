-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 04 Jul 2021 pada 19.36
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beasiswa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_kriteria`
--

CREATE TABLE `input_kriteria` (
  `id_kriteria` varchar(32) NOT NULL,
  `min` double NOT NULL,
  `max` double NOT NULL,
  `urutan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `input_kriteria`
--

INSERT INTO `input_kriteria` (`id_kriteria`, `min`, `max`, `urutan`) VALUES
('K01', 3, 3.25, 0),
('K01', 3.26, 3.5, 1),
('K01', 3.56, 3.75, 2),
('K05', 1, 3, 0),
('K05', 4, 6, 1),
('K05', 7, 100, 2),
('K02', 0, 1000000, 0),
('K02', 1000001, 2000000, 1),
('K02', 2000001, 3000000, 2),
('K02', 3000001, 4000000, 3),
('K02', 4000001, 100000000, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(32) NOT NULL,
  `nama_kriteria` varchar(64) NOT NULL,
  `judul_kriteria` varchar(128) NOT NULL,
  `bobot` double NOT NULL,
  `b/c` varchar(1) NOT NULL,
  `jenis_pertanyaan` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `judul_kriteria`, `bobot`, `b/c`, `jenis_pertanyaan`) VALUES
('K01', 'IPK', 'IPK Mahasiswa', 0.25, 'b', 'Input'),
('K02', 'Penghasilan', 'Penghasilan Orang Tua', 0.2, 'c', 'Input'),
('K03', 'Pekerjaan', 'Pekerjaan Orang Tua ', 0.15, 'c', 'Pilihan'),
('K04', 'Tanggungan', 'Tanggungan Orang Tua', 0.15, 'b', 'Pilihan'),
('K05', 'Ekstrakulikuler', 'Ekstrakulikuler', 0.1, 'b', 'Input'),
('K06', 'Organisasi', 'Jabatan Organisasi', 0.15, 'b', 'Pilihan'),
('K07', 'tes', 'tes', 2.15, 'b', 'Pilihan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` varchar(32) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `tempat_lahir` varchar(32) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `angkatan` varchar(4) DEFAULT NULL,
  `foto` varchar(128) DEFAULT NULL,
  `berkas` varchar(128) DEFAULT NULL,
  `rank` int(11) DEFAULT NULL,
  `total` double DEFAULT NULL,
  `accept` tinyint(1) NOT NULL DEFAULT 0,
  `K01` double DEFAULT NULL,
  `K02` double DEFAULT NULL,
  `K04` double DEFAULT NULL,
  `K05` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `password`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `angkatan`, `foto`, `berkas`, `rank`, `total`, `accept`, `K01`, `K02`, `K04`, `K05`) VALUES
('001', 'Lina', '$2y$10$ZOVttQAa6DnW.LHTAVbmZeEV9rhPqErcVZEmE5bmzZwX/mxOroykG', 'Pekanbaru', '2020-02-12', 'Singgalang', '2015', NULL, NULL, 4, 0.36547619047619, 0, 3.5, 2000000, 4, 7),
('002', 'Vina', '$2y$10$LilKfVol/lNaey5ZoMua4eMpPHYORRHUkhvmp/47k2hhDD1Zosqzi', 'Pekanbaru', '2020-02-12', 'Pekanbaru', '2015', NULL, NULL, 8, 0.28690476190476, 0, 3.5, 2000000, 3, 3),
('003', 'dinia', '$2y$10$kX88EMvHASaQri36jnZCa.nTc6wio9UXWmMOtZsfscx7EOJZrdOCC', 'Pekanbaru', '2020-02-13', 'pekanbaru', '2015', NULL, NULL, 17, 0.14285714285714, 0, 3.25, 2000000, 3, 4),
('004', 'dila', '$2y$10$71VJ7gj.v/4Y6aXf3/IP7eriAtwJgtzp2wTbaXwp9Dn/tJqhrEP8m', 'pekanbaru', '2020-01-30', 'pekanbaru', '2015', NULL, NULL, 2, 0.42380952380952, 0, 3.75, 2000000, 2, 7),
('005', 'sasha', '$2y$10$QgAHywoTviyfP64ETTak7OLNSykQMy6zNNIvnkIfrYZXhFa07hOxu', 'Pekanbaru', '2020-02-15', 'pekanbaru', '2015', NULL, NULL, 19, 0.11190476190476, 0, 3.4, 1500000, 1, 3),
('006', 'Sishi', '$2y$10$cnQqZ4CsFNZI.EV3A0CbWOfxsPg9De0It26ubYEvSf5xQNldjFm4m', 'Pekanbaru', '2020-02-12', 'Pekanbaru', '2015', NULL, NULL, 10, 0.22619047619047, 0, 3.4, 2500000, 3, 4),
('007', 'Intan', '$2y$10$1Ag3F80ERaQrW3Li6uiv3u7IMmJc1qqbFXSdBURfvenFNm49w1Txq', 'Pekanbaru', '2020-02-25', 'Pekanbaru', '2015', NULL, NULL, 16, 0.16190476190476, 0, 3.35, 3000000, 2, 3),
('008', 'Reza', '$2y$10$i5yFBlJyeNWF0iUnUmzDXOD3bNgBb0lQwJTRj46Ogd.8Wrk5NlsN2', 'Pekanbaru', '2020-02-06', 'Pekanbaru', '2015', NULL, NULL, 12, 0.20357142857143, 0, 3, 2500000, 3, 3),
('009', 'Rabby', '$2y$10$xODV8YVduKtJIhl5d2HjKu4xkeipTjJCdYfwercY4uU8OhbIyweLG', 'Pekanbaru', '2020-02-19', 'Pekanbaru', '2015', NULL, NULL, 9, 0.26190476190476, 0, 3.5, 1500000, 4, 3),
('010', 'Djodi', '$2y$10$wm/oO3Qa06xTh97J7zTVoeiCnfd6801Z/WXPgSwmDvXBqNhJgA99O', 'Pekanbaru', '2020-02-14', 'Pekanbaru', '2015', NULL, NULL, 20, 0.092857142857141, 0, 3, 2000000, 2, 5),
('011', 'Dika', '$2y$10$blV/s2SCmJUSGXpurdatbuWw4dVxQLByopDruDwBlr/yPWluP3UB2', 'Pekanbaru', '2020-02-19', 'Pekanbaru', '2015', NULL, NULL, 15, 0.16190476190476, 0, 3.5, 4000000, 2, 3),
('012', 'Akbi', '$2y$10$JAwJnSLHJvXDiySvAxruNOYfzkhGKj6m8faeFp1/wI0z7stcgw...', 'Pekanbaru', '2020-02-18', 'Pekanbaru', '2015', NULL, NULL, 13, 0.17857142857143, 0, 3, 3000000, 4, 3),
('013', 'ilham', '$2y$10$xthq87yJ.Gdf06s0LwDRKuzr2AagFAz.qrd62f7XScueqrX4HcXbK', 'Pekanbaru', '2020-02-25', 'pekanbaru', '2015', NULL, NULL, 5, 0.35952380952381, 0, 3.75, 2500000, 5, 5),
('014', 'dede', '$2y$10$kqGCNRyDI/jQTASLXi5Swe4Vi3Roqa1mfoL7tJhH2rQX0sBOFUZzW', 'Pekanbaru', '2020-02-05', 'pekanbaru', '2015', NULL, NULL, 7, 0.30952380952381, 0, 3.6, 1500000, 3, 5),
('015', 'erik', '$2y$10$oIv3V/IZkuen.tMcakV1zO4biLXsXGYeqfpVo6n6XU0PPUJWnVbZi', 'pekanbaru', '2020-02-18', 'pekanbaru', '2015', NULL, NULL, 3, 0.3702380952381, 0, 3.75, 1500000, 3, 3),
('016', 'romi', '$2y$10$e3tfcDf88B58aGEbyniiKOMLdeHoIVFuC.ogvDeHgLfHKZY6a2NGC', 'Pekanbaru', '2020-02-04', 'pekanbaru', '2015', NULL, NULL, 6, 0.32857142857143, 0, 3, 2000000, 4, 3),
('017', 'andri', '$2y$10$7k4vsZlth/Yq6t/4Pzihue1ezL6Zzh1tPh4iuDSKBsrKjgWXsg14O', 'pekanbaru', '2020-02-13', 'pekanbaru', '2015', NULL, NULL, 14, 0.16190476190476, 0, 3.4, 3000000, 2, 3),
('018', 'denin', '$2y$10$sdPNOw5IPEHQ5Jh6lPsLt.32EIeULZpdNlzD2dbCc4fUgNC9GNxzG', 'Pekanbaru', '2020-01-31', 'pekanbaru', '2015', NULL, NULL, 11, 0.21785714285714, 0, 3, 2500000, 3, 4),
('019', 'topan', '$2y$10$DkBkdFAjABJERlAiDVe0BeoADp3cIlH46BZCIhwsgydDI7fcpkeAa', 'pekanbaru', '2020-02-27', 'pekanbaru', '2015', NULL, NULL, 1, 0.4952380952381, 0, 3.75, 2000000, 5, 3),
('020', 'rio', '$2y$10$rIeF5LxglrSxNBYFX8l/2OLAxndwYxRiRDzp5HI734stQxxIL238e', 'Pekanbaru', '2020-02-15', 'pekanbaru', '2015', NULL, NULL, 18, 0.12857142857143, 0, 3.25, 1500000, 3, 3),
('180401187', 'Wahyu Nuzul Bahri', '$2y$10$jRDe18X.nNS6vM5SUPtlIuzb7mgc9ZrE/714bBlnJvVC4wi2n8ElK', NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerima_beasiswa`
--

CREATE TABLE `penerima_beasiswa` (
  `nim` varchar(32) NOT NULL,
  `tahun` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pilihan_kriteria`
--

CREATE TABLE `pilihan_kriteria` (
  `id_kriteria` varchar(32) NOT NULL,
  `nama_pilihan` varchar(64) NOT NULL,
  `urutan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pilihan_kriteria`
--

INSERT INTO `pilihan_kriteria` (`id_kriteria`, `nama_pilihan`, `urutan`) VALUES
('K03', 'Almarhum', 0),
('K03', 'Tani/Buruh/Pensiunan', 1),
('K03', 'Wiraswasta', 2),
('K03', 'PNS/Peg.BUMN/TNI/POLRI', 3),
('K06', 'Pengurus Lainnya', 0),
('K06', 'Sekretaris/Bendahara', 1),
('K06', 'Ketua', 2),
('K04', '1', 0),
('K04', '2', 1),
('K04', '3', 2),
('K04', '4', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rel_mhs_kriteria`
--

CREATE TABLE `rel_mhs_kriteria` (
  `nim` varchar(32) NOT NULL,
  `id_kriteria` varchar(32) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rel_mhs_kriteria`
--

INSERT INTO `rel_mhs_kriteria` (`nim`, `id_kriteria`, `nilai`) VALUES
('001', 'K03', 0.25),
('001', 'K06', 0.5),
('001', 'K01', 0.33333333333333),
('001', 'K02', 0.14285714285714),
('001', 'K04', 1),
('001', 'K05', 0.28571428571429),
('002', 'K03', 0),
('002', 'K06', 0.5),
('002', 'K01', 0.33333333333333),
('002', 'K02', 0.14285714285714),
('002', 'K04', 0.66666666666667),
('002', 'K05', 0),
('003', 'K03', 0.5),
('003', 'K06', 0),
('003', 'K01', 0),
('003', 'K02', 0.14285714285714),
('003', 'K04', 0.66666666666667),
('003', 'K05', 0.14285714285714),
('004', 'K03', 0.5),
('004', 'K06', 1),
('004', 'K01', 0.66666666666667),
('004', 'K02', 0.14285714285714),
('004', 'K04', 0.33333333333333),
('004', 'K05', 0.28571428571429),
('005', 'K03', 0.5),
('005', 'K06', 0),
('005', 'K01', 0.33333333333333),
('005', 'K02', 0.14285714285714),
('005', 'K04', 0),
('005', 'K05', 0),
('006', 'K03', 0.5),
('006', 'K06', 0),
('006', 'K01', 0.33333333333333),
('006', 'K02', 0.28571428571429),
('006', 'K04', 0.66666666666667),
('006', 'K05', 0.14285714285714),
('007', 'K03', 0.75),
('007', 'K06', 0),
('007', 'K01', 0.33333333333333),
('007', 'K02', 0.28571428571429),
('007', 'K04', 0.33333333333333),
('007', 'K05', 0),
('008', 'K03', 0.5),
('008', 'K06', 0.5),
('008', 'K01', 0),
('008', 'K02', 0.28571428571429),
('008', 'K04', 0.66666666666667),
('008', 'K05', 0),
('009', 'K03', 0.25),
('009', 'K06', 0),
('009', 'K01', 0.33333333333333),
('009', 'K02', 0.14285714285714),
('009', 'K04', 1),
('009', 'K05', 0),
('010', 'K03', 0.5),
('010', 'K06', 0),
('010', 'K01', 0),
('010', 'K02', 0.14285714285714),
('010', 'K04', 0.33333333333333),
('010', 'K05', 0.14285714285714),
('011', 'K03', 0.75),
('011', 'K06', 0),
('011', 'K01', 0.33333333333333),
('011', 'K02', 0.42857142857143),
('011', 'K04', 0.33333333333333),
('011', 'K05', 0),
('012', 'K03', 0.75),
('012', 'K06', 0),
('012', 'K01', 0),
('012', 'K02', 0.28571428571429),
('012', 'K04', 1),
('012', 'K05', 0),
('013', 'K03', 0.5),
('013', 'K06', 0),
('013', 'K01', 0.66666666666667),
('013', 'K02', 0.28571428571429),
('013', 'K04', 1),
('013', 'K05', 0.14285714285714),
('014', 'K03', 0.25),
('014', 'K06', 0),
('014', 'K01', 0.66666666666667),
('014', 'K02', 0.14285714285714),
('014', 'K04', 0.66666666666667),
('014', 'K05', 0.14285714285714),
('015', 'K03', 0),
('015', 'K06', 0.5),
('015', 'K01', 0.66666666666667),
('015', 'K02', 0.14285714285714),
('015', 'K04', 0.66666666666667),
('015', 'K05', 0),
('016', 'K03', 0.5),
('016', 'K06', 1),
('016', 'K01', 0),
('016', 'K02', 0.14285714285714),
('016', 'K04', 1),
('016', 'K05', 0),
('017', 'K03', 0.5),
('017', 'K06', 0),
('017', 'K01', 0.33333333333333),
('017', 'K02', 0.28571428571429),
('017', 'K04', 0.33333333333333),
('017', 'K05', 0),
('018', 'K03', 0),
('018', 'K06', 0.5),
('018', 'K01', 0),
('018', 'K02', 0.28571428571429),
('018', 'K04', 0.66666666666667),
('018', 'K05', 0.14285714285714),
('019', 'K03', 0.25),
('019', 'K06', 1),
('019', 'K01', 0.66666666666667),
('019', 'K02', 0.14285714285714),
('019', 'K04', 1),
('019', 'K05', 0),
('020', 'K03', 0.25),
('020', 'K06', 0),
('020', 'K01', 0),
('020', 'K02', 0.14285714285714),
('020', 'K04', 0.66666666666667),
('020', 'K05', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `user_id` varchar(32) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `pendaftaran` tinyint(1) NOT NULL DEFAULT 0,
  `berkas` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`user_id`, `nama`, `password`, `publish`, `pendaftaran`, `berkas`) VALUES
('12345', 'BAAK', '$2y$10$HJQ.MSeggjvWkg.mWC0zGeGn0DmMJd96sRyIkszqg3/vkJHAqisTu', 0, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `penerima_beasiswa`
--
ALTER TABLE `penerima_beasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
