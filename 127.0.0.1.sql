-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 24 Des 2014 pada 06.08
-- Versi Server: 5.5.27
-- Versi PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `pemilu`
--
CREATE DATABASE `pemilu` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pemilu`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `caleg`
--

CREATE TABLE IF NOT EXISTS `caleg` (
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `website` varchar(30) NOT NULL,
  `partai` varchar(20) NOT NULL,
  `dapil` varchar(20) NOT NULL,
  `visi` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `caleg`
--

INSERT INTO `caleg` (`username`, `password`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `website`, `partai`, `dapil`, `visi`, `foto`) VALUES
('alvian', '8359d1b6e816f56c4c8850a7311ffb73', 'Alvian Yudha Prawira', 'Pemalang', '1994-12-16', 'Pemalang', 'alvian@yahoo.com', 'http://alvianyp.com', 'GOLKAR', 'Semarang Selatan', 'asda', 'caleg/image.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `voter`
--

CREATE TABLE IF NOT EXISTS `voter` (
  `username` varchar(20) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `no_ktp` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `dapil` varchar(20) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `voter`
--

INSERT INTO `voter` (`username`, `nama_lengkap`, `no_ktp`, `password`, `alamat`, `email`, `dapil`) VALUES
('Rizal', 'Delva Rizal', '123456789', '372857c3cb7136fc4209acbe5202949d', 'Riau', 'delvarizal@gmail.com', 'Semarang Tengah');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
