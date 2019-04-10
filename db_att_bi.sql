-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 10 Apr 2019 pada 15.18
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
  `status_in` varchar(7) NOT NULL,
  `status_out` varchar(17) NOT NULL,
  `note` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `date`, `time_in`, `time_out`, `status_in`, `status_out`, `note`) VALUES
(1, 1, '2019-03-26', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(3, 2, '2019-03-26', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(4, 1, '2019-03-27', '07:40:00', '', 'on time', '', 'Hadir'),
(5, 2, '2019-03-27', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(6, 1, '2019-03-28', '07:50:00', '17:00:00', 'telat', 'on time', 'Izin'),
(7, 2, '2019-03-28', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(8, 1, '2019-03-29', '07:40:00', '17:00:00', 'on time', 'on time', 'Alpha'),
(9, 2, '2019-03-29', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(10, 1, '2019-04-01', '07:40:00', '17:10:10', 'on time', 'on time', 'Hadir'),
(11, 2, '2019-04-01', '07:45:10', '17:05:00', 'telat', 'on time', 'Hadir');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `mentor_id` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`mentor_id`, `nip`, `name`) VALUES
(1, '123', 'asdf'),
(2, '567666', 'Asasdfajh ajshd kljhfl');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `qrcode_id` varchar(11) NOT NULL,
  `qrcode` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `id_number` varchar(35) NOT NULL,
  `name` varchar(75) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `collage` varchar(75) NOT NULL,
  `vocational` varchar(100) NOT NULL,
  `address` varchar(145) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `mentor_id`, `qrcode_id`, `qrcode`, `id_number`, `name`, `sex`, `collage`, `vocational`, `address`, `phone`, `active`) VALUES
(1, 2, '19SIMABI005', '5cadbd1edd43f.png', '1555301022', 'Elok Anugrah Alkhaliq', 'Laki-laki', 'Politeknik Caltex Riau', 'Teknik Informatika', 'Jl. Jalan', '08127', 'Aktif'),
(2, 1, '19SIMABI002', '5cadbce369cbb.png', '1455301082', 'Wahyu Adhi Setiantoro', 'Laki-laki', 'Politeknik Caltex RIau', '123', 'test', '123', 'Aktif'),
(3, 1, '19SIMABI003', '5cadbcec337ea.png', '1555301078', 'Selfia Firdaus', 'Perempuan', 'Politeknik Caltex Riau', 'ttt', 'ttt', '999', 'Non Aktif'),
(5, 1, '19SIMABI004', '5cadbcf830bb2.png', '155544203', 'Joko Widodo', 'Laki-laki', 'Universitas Gadjah Mada', 'Militer', 'g', '9999', 'Non Aktif'),
(6, 2, '19SIMABI005', '5cadbd007a8a5.png', '1555331290', 'Prabowo Subianto', 'Laki-laki', 'Akademi Militer Magelang', 'Militer', 'as', '9999', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `working_hours`
--

CREATE TABLE `working_hours` (
  `workinghours_id` int(11) NOT NULL,
  `time_in` varchar(5) NOT NULL,
  `time_out` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `working_hours`
--

INSERT INTO `working_hours` (`workinghours_id`, `time_in`, `time_out`) VALUES
(1, '07:45', '17:00');

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
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`mentor_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexes for table `working_hours`
--
ALTER TABLE `working_hours`
  ADD PRIMARY KEY (`workinghours_id`);

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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `mentor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `working_hours`
--
ALTER TABLE `working_hours`
  MODIFY `workinghours_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentor` (`mentor_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
