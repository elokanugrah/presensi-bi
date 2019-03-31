-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 31 Mar 2019 pada 12.37
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_att_bi`
--
CREATE DATABASE IF NOT EXISTS `db_att_bi` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_att_bi`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `encrypted_password` varchar(100) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `encrypted_password`, `salt`, `name`, `email`) VALUES
(1, 'admin', 'uANbWIF3iE/pyO1F2cdh9aYXZ2xjNWFhOGM1ZjIx', 'c5aa8c5f21', 'Elok Anugrah', 'elok15ti@mahasiswa.pcr.ac.id');

-- --------------------------------------------------------

--
-- Struktur dari tabel `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_in` varchar(8) NOT NULL,
  `time_out` varchar(8) NOT NULL,
  `status` varchar(7) NOT NULL,
  `home_early` varchar(17) NOT NULL,
  `note` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `date`, `time_in`, `time_out`, `status`, `home_early`, `note`) VALUES
(1, 1, '2019-03-26', '07.40.00', '17.00.00', 'on time', 'tidak', ''),
(3, 2, '2019-03-26', '07.40.00', '17.00.00', 'lambat', 'tidak', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `id_number` varchar(35) NOT NULL,
  `name` varchar(75) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `collage` varchar(75) NOT NULL,
  `address` varchar(145) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `id_number`, `name`, `sex`, `collage`, `address`, `active`) VALUES
(1, '1555301022', 'Elok Anugrah Alkhaliq', 'Laki-laki', 'Politeknik Caltex Riau', '', 'Aktif'),
(2, '1455301082', 'Wahyu Adhi Setiantoro', 'Laki-laki', 'Politeknik Caltex RIau', '', 'Aktif'),
(3, '1555301078', 'Selfia Firdaus', 'Perempuan', 'Politeknik Caltex Riau', '', 'Non Aktif'),
(4, '1555301022', 'Fandy Hidayat', 'Laki-laki', 'Politeknik Caltex Riau', '', 'Non Aktif'),
(5, '155544203', 'Joko Widodo', 'Laki-laki', 'Universitas Gadjah Mada', '', 'Non Aktif'),
(6, '1555331290', 'Prabowo Subianto', 'Laki-laki', 'Universitas Calon Presiden', '', 'Non Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
