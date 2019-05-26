-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26 Mei 2019 pada 10.44
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
(1, 'admin', 'DmJQTfL/NJuGFAOlmfTV+qf2Wz8xZGQzODg4NTll', '1dd388859e', 'Elok Anugrah', 'elok15ti@mahasiswa.pcr.ac.id');

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
(4, 1, '2019-03-27', '07:40:00', '11:00:00', 'on time', 'lebih awal', 'Izin'),
(5, 2, '2019-03-27', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(6, 1, '2019-03-28', '07:40:00', '17:00:00', 'on time', 'on time', 'Izin'),
(7, 2, '2019-03-28', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(8, 1, '2019-03-29', '07:45:00', '11:00:00', 'on time', 'lebih awal', 'Izin'),
(9, 2, '2019-03-29', '07:40:00', '17:00:00', 'on time', 'on time', 'Hadir'),
(176, 1, '2019-04-18', '15:21:10', '15:22:30', 'telat', 'lebih awal', 'Hadir'),
(177, 2, '2019-04-18', '15:21:31', '15:22:06', 'telat', 'lebih awal', 'Alpha'),
(178, 1, '2019-04-23', '10:08:16', '17:12:37', 'telat', 'on time', 'Hadir'),
(179, 2, '2019-04-23', '16:15:17', '16:40:14', 'telat', 'lebih awal', 'Sakit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `edulvl`
--

CREATE TABLE `edulvl` (
  `edulvl_id` int(11) NOT NULL,
  `edulvl_name` varchar(145) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `edulvl`
--

INSERT INTO `edulvl` (`edulvl_id`, `edulvl_name`) VALUES
(1, 'SMA/SMK Sederajat'),
(2, 'Perguruan Tinggi');

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
(1, '123', 'asdfggg'),
(2, '567666', 'Asasdfajh ajshd kljhfl');

-- --------------------------------------------------------

--
-- Struktur dari tabel `regis`
--

CREATE TABLE `regis` (
  `regis_id` int(11) NOT NULL,
  `edulvl_id` int(11) NOT NULL,
  `registered_name` varchar(45) NOT NULL,
  `idsch_num` varchar(25) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `pob` varchar(45) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `origin` varchar(45) NOT NULL,
  `vocational` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `story` text NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `resume` text NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `already_read` tinyint(1) NOT NULL,
  `date_received` date NOT NULL,
  `date_sent` date NOT NULL,
  `invitation_date` date NOT NULL,
  `invitation_time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `regis`
--

INSERT INTO `regis` (`regis_id`, `edulvl_id`, `registered_name`, `idsch_num`, `sex`, `pob`, `dob`, `email`, `phone`, `origin`, `vocational`, `address`, `story`, `start`, `end`, `resume`, `approve`, `already_read`, `date_received`, `date_sent`, `invitation_date`, `invitation_time`) VALUES
(46, 2, 'elok anugrah alkhliq', '1555301022', 'Laki-laki', 'pekalongan', '1997-11-24', 'elok15ti@mahasiswa.pcr.ac.id', '081278515123', 'politeknik caltex riau', 'teknik informatika', 'Jl. Nuansa, Komp. Nuansa Residence', 'Saya anak pertama dari 2 bersaudara', '2019-07-01', '2019-09-01', 'elok_anugrah_alkhliq_politeknik_caltex_riau_5ce74f935334d.pdf', 1, 1, '2019-05-24', '2019-05-24', '2019-05-30', '15:40'),
(47, 2, 'selvia firdaus', '1555301078', 'Perempuan', 'Bukittinggi', '1997-09-29', 'selvia15ti@mahasiswa.pcr.ac.id', '081372659081', 'Politeknik Caltex Riau', 'Teknik Informatika', 'Rumbai', 'saya seorang AERI', '2019-08-01', '2019-10-01', 'selvia_firdaus_Politeknik_Caltex_Riau_5ce774ee207b4.pdf', 1, 1, '2019-05-24', '2019-05-24', '2019-05-27', '14:00'),
(48, 2, 'hahahaha', '123123', 'Laki-laki', 'asdf', '2019-05-27', 'elok15ti@mahasiswa.pcr.ac.id', '12313212312', 'adsfasdfasd', 'adsfasdfasdf', 'asdfasdfa', 'asdfasdfa', '2019-07-01', '2019-09-01', 'hahahaha_adsfasdfasd_5ce7a2b827d1f.pdf', 0, 1, '2019-05-24', '0000-00-00', '0000-00-00', ''),
(49, 2, 'Ssadf', '123123', 'Laki-laki', 'Pekalongan', '2019-05-28', 'elok15ti@mahasiswa.pcr.ac.id', '123123123', 'Asddd', 'Asdfasdf', 'asdf', 'asdf', '2019-07-01', '2019-09-01', 'ssadf_asddd_5ce7a37ea55dc.pdf', 0, 1, '2019-05-24', '0000-00-00', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `regis_auto`
--

CREATE TABLE `regis_auto` (
  `regisauto_id` int(11) NOT NULL,
  `slot` int(11) NOT NULL,
  `regis_auto` tinyint(1) NOT NULL,
  `regis_open` tinyint(1) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `regis_auto`
--

INSERT INTO `regis_auto` (`regisauto_id`, `slot`, `regis_auto`, `regis_open`, `start`, `end`) VALUES
(1, 4, 0, 1, '2019-05-23', '2019-06-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `edulvl_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `qrcode_id` varchar(11) NOT NULL,
  `qrcode` varchar(100) NOT NULL DEFAULT 'default.jpg',
  `id_number` varchar(35) NOT NULL,
  `name` varchar(75) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `collage` varchar(75) NOT NULL,
  `vocational` varchar(100) NOT NULL,
  `address` varchar(145) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `student`
--

INSERT INTO `student` (`student_id`, `mentor_id`, `edulvl_id`, `unit_id`, `qrcode_id`, `qrcode`, `id_number`, `name`, `sex`, `collage`, `vocational`, `address`, `phone`, `date_in`, `date_out`, `active`) VALUES
(1, 2, 2, 5, 'M-21-0001', '5cb05325b61b3.png', '1555301022', 'Elok Anugrah Alkhaliq', 'Laki-laki', 'Politeknik Caltex Riau', 'Teknik Informatika', 'Jl. Jalan', '08127', '2019-03-11', '2019-07-11', 'Aktif'),
(2, 1, 2, 7, 'M-21-0002', '5cb05330060f9.png', '1455301082', 'Wahyu Adhi Setiantoro', 'Laki-laki', 'Politeknik Caltex RIau', '123', 'test', '123', '2019-03-11', '2019-07-11', 'Aktif'),
(3, 1, 1, 7, 'M-21-0003', '5cb053392f8ba.png', '1555301078', 'Selfia Firdaus', 'Perempuan', 'SMA 666', 'ttt', 'ttt', '999', '2019-03-11', '2019-07-11', 'Aktif'),
(5, 1, 2, 7, 'M-21-0004', '5cb0533fea098.png', '155544203', 'Joko Widodo', 'Laki-laki', 'Universitas Gadjah Mada', 'Kehutanan', 'g', '9999', '2018-11-01', '2019-04-30', 'Non Aktif'),
(17, 1, 1, 6, 'M-21-0005', 'default.jpg', '666', 'Prabowo Subianto', 'Laki-laki', 'Akademi Militer', 'Strategi Perang', 'sadf', '88888', '2019-05-01', '2019-05-18', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `token_id` int(11) NOT NULL,
  `token` varchar(90) NOT NULL,
  `salt` varchar(30) NOT NULL,
  `email` varchar(75) NOT NULL,
  `time` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`token_id`, `token`, `salt`, `email`, `time`) VALUES
(2, 'QdcJH1yYFXKx31dKAYhpeBMsYBIyNThiYWM4MDM2ODAzN2Y5YjM2ODg0ODRiYWI0YTE=', '258bac80368037f9b3688484bab4a1', 'elok15ti@mahasiswa.pcr.ac', '15.00'),
(3, 's3/svi7AsRpR/K84xCDPEDtZSGIwYWE0YmJjNmJlZWMzNzAwNmM5NjE3NTA2M2YyODU=', '0aa4bbc6beec37006c96175063f285', 'elok15ti@mahasiswa.pcr.ac', '09.45'),
(4, 's3/svi7AsRpR/K84xCDPEDtZSGJjZGFiODk2M2EwZTE4YjI5YmEwZGE3N2RmYmMwYTM=', 'cdab8963a0e18b29ba0da77dfbc0a3', 'elok15ti@mahasiswa.pcr.ac', '09.45'),
(5, 's3/svi7AsRpR/K84xCDPEDtZSGI3ZjgxMWI2YzEwZDRmMjhlMDY0ODYyNzc3YjFlYzU=', '7f811b6c10d4f28e064862777b1ec5', 'elok15ti@mahasiswa.pcr.ac', '09.47'),
(6, 's3/svi7AsRpR/K84xCDPEDtZSGJiN2RhYWNmZTkxNDJhM2MzN2JlMmUyZjUzZDI3YjA=', 'b7daacfe9142a3c37be2e2f53d27b0', 'elok15ti@mahasiswa.pcr.ac', '09.49'),
(7, 's3/svi7AsRpR/K84xCDPEDtZSGIwYTk1OThjZGFkOGM2NTgwNWI3ODg2MzA1YzZjYjc=', '0a9598cdad8c65805b7886305c6cb7', 'elok15ti@mahasiswa.pcr.ac', '09.50'),
(8, 's3/svi7AsRpR/K84xCDPEDtZSGIzY2Q3YTM4YTQzNmY4YzIxMzk2NjhiNDc0M2YyMGE=', '3cd7a38a436f8c2139668b4743f20a', 'elok15ti@mahasiswa.pcr.ac', '09.50'),
(9, 's3/svi7AsRpR/K84xCDPEDtZSGI0YTcxODg0ZWI5M2Q5YzEyZTlkNTYzOWM2MjgxYTM=', '4a71884eb93d9c12e9d5639c6281a3', 'elok15ti@mahasiswa.pcr.ac', '09.51'),
(10, 's3/svi7AsRpR/K84xCDPEDtZSGIxOTJiYjZkMjhkYWUwZDBmMjM0YjU2OTQzYTg1NTY=', '192bb6d28dae0d0f234b56943a8556', 'elok15ti@mahasiswa.pcr.ac', '09.51'),
(11, 's3/svi7AsRpR/K84xCDPEDtZSGI2ZDY4MmU5MGQ2MTExZTZhMmU4ZWZjZTRkZTEwNjg=', '6d682e90d6111e6a2e8efce4de1068', 'elok15ti@mahasiswa.pcr.ac', '09.53'),
(12, 's3/svi7AsRpR/K84xCDPEDtZSGJmOThhOTBiNDQ3NjgzZjg0NzEyNzYyMGRjODM4YTA=', 'f98a90b447683f847127620dc838a0', 'elok15ti@mahasiswa.pcr.ac', '09.53'),
(13, 's3/svi7AsRpR/K84xCDPEDtZSGI3ODVhNzkyNTM2M2JmMTMzYTdjNTQxM2M1NjNmMzM=', '785a7925363bf133a7c5413c563f33', 'elok15ti@mahasiswa.pcr.ac', '09.53'),
(14, 'MjAxOS0wNS0xN2UzZjcxZGFmM2E2ZmRiNWJkZTM5NmQ4Mzk4YzgyMQ==', 'e3f71daf3a6fdb5bde396d8398c821', 'elok15ti@mahasiswa.pcr.ac', '09.56'),
(16, 's3/svi7AsRpR/K84xCDPEDtZSGI1NmU2NGUyNmNhNDM5MjBkNTNjZjdjY2EyN2VjNzM=', '56e64e26ca43920d53cf7cca27ec73', 'elok15ti@mahasiswa.pcr.ac.id', '09.59'),
(17, 's3/svi7AsRpR/K84xCDPEDtZSGJkNTA3NGMyOGIxYjliNTZkY2I4MDNjODE5OTczYmE=', 'd5074c28b1b9b56dcb803c819973ba', 'elok15ti@mahasiswa.pcr.ac.id', '09.59'),
(18, 'MjAxOS0wNS0yNDM1YTQ1YjNjZjk1NjcyM2FjM2VlNzU3YTk3Y2ViMQ==', '35a45b3cf956723ac3ee757a97ceb1', 'elok15ti@mahasiswa.pcr.ac.id', '10.47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(145) NOT NULL,
  `unit_icon` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_name`, `unit_icon`, `description`, `active`) VALUES
(5, 'Tim PUR dan Operasional SP', '5cd52d1093cc6.png', '<h4>Tim PUR dan Operasional SP</h4><p>Selain Divisi Advisory dan Pengembangan Ekonomi, KPw BI Provinsi Riau juga memiliki Divisi SP,PUR Layanan dan Administrasi. Dalam Divisi SP, PUR Layanan dan Administrasi, terdapat keterkaitan antar unit.</p><p>Pertama, unit PUR dalam tugasnya melakukan koordinasi dengan Unit Operasional SP dalam hal administrasi warkat. Unit PUR menerima uang yang masuk ke khasanah dan mengeluarkan laporan-laporan yang harus diperiksa dan diserahkan pada Unit Operasional SP. Unit Operasional SP bertugas layaknya akuntan untuk memastikan bahwa angka keluar dan masuknya uang sesuai dengan jumlah yang sebenarnya. Operasional SP memastikan bahwa angka keluar dan masuknya uang sesuai dengan jumlah yang sebenarnya. Operasional SP memastikan bahwa angka keluar dan masuknya uang sesuai dengan jumlah yang sebenarnya. Operasional SP memastikan bahwa jumlah uang yang diterima unit PUR di khasanah berjumlah sesuai dengan data yang masuk.</p><p>Kedua, unit perizinan dan pengawasan SP PUR memiliki keterkaitan dengan unit PUR dalam pengelolaan kas titipan dan KUPVA BB. Unit Analisis SP PUR, KI, dan Perlindungan Konsumen memiliki keterkaitan pada FAES dan FDSEK dalam hal pemenuhan data terkait program keuangan inklusif.</p><p>Dan yang terakhir, fungsi SLA memiliki keterkaitan dengan seluruh unit kerja. Fungsi Sekretariat langsung terkait dengan seluruh unit diatur oleh Fungsi Sekretariat. Fungsi Pengamanan terutama terkait dengan Unit PUR. Pengamanan diperlukan saat dilakukan pemindahan dan pengeluaran uang dari KPwDN.</p>', 1),
(6, 'Tim Pengembangan Ekonomi', '5cd52ce40d926.png', '<h4>Fungsi Koordinasi<br>dan Komunikasi Kebijakan (FK3)</h4><p>1. Melaksanakan koordinasi dengan stakeholders (sekelompok masyarakat yang memiliki hubungan dengan sebuah perusahaan baik sebagai pihak yang mempengaruhi atau terpengaruh) dalam rangka pengendalian inflasi dalam wilayah kerja dan/atau antar wilayah kerja.</p><p>2. Melakukan koordinasi dan program kerjasama dalam rangka pengembangan ekonomi daerah dan hubungan investor.</p><p>3. Menyusun dan melaksanakan program komunikasi kebijakan dan isu strategis BI , termasuk menfasilitasi atau mengkoordinasikan pelaksanaan komunikasi satuan kerja Kantor Pusat di daerah</p><p>4. Menyusun dan melaksanakan program komunikasi hasil kajian dan isu regional lainnya, termasuk melakukan penyesuaian terhadap materi/publikasi eksternal sesuai dengan kebutuhan daerah.</p><p>5. Melaksanakan forum-forum terkait dengan pengembangan dan kerjasama ekonomi yang melibatkan stakeholders daerah.</p><p>6. Melakukankegiatan sosialisasi dan capacitybuilding(Pengembangan Kapasitas)kepada stakeholders.</p><p>7. Menyediakan Layanan Informasi Publik (termasuk Pejabat Pengelola Informasi dan Dokumentasi/PPID daerah)</p><p>8. Mengelola Pelaksanaan Program Sosial Bank Indoesia (PSBI), termasuk beasiswa.</p><p>9. Melaksanakan edukasi kebanksentralan, termasuk program magang.</p><p>10. Mengelola perpustakaan Bank Indonesia.</p><br><h4>Fungsi Pelaksanaan Pengembangan UMKM (FPPU)</h4><p>1. Melaksanakan program pengembangan UMKM dalam rangka peningkatan kapasitas ekonomi daerah dan pengendalian inflasi.</p><p>2. Melakukan kegiatan dalam rangka peningkatan akses keuangan UMKM a.l. melalui dukungan penguatan infrastruktur keuangan, fasilitasi program pemerintah yang memberikan nilai tambah, dan penyalurah kredit UMKM (Usaha Mikro Kecil dan Menengah).</p><p>3. Melaksanakan penyediaan dan diseminasi informasi terkait pengembangan UMKM.</p><p>4. Melakukan kegiatan koordinasi dan kerjasama dengan stakeholders setempat dalam rangka pengembangan UMKM.</p><p>5. Melakukan penatausahaan dan pengelolaan administrasi Sistem Pembayaran.</p><p>6. Mengelola pembukuan transaksi internal dan eksternal.</p><p>7. Melakukan fasilitasii pertukaran warkat debet (koordinator pertukaran warkat debet).</p><p>8. Mengelola BCP SP (Business Continuity Plan Sistem Pembayaran)</p><p>9. Mengelola administrasi dan tata usaha Kredit Likuiditas Bank Indonesia (KLBI) dan Two Step Loan (TSL).</p><br><h4>Fungsi Perizinan dan Pengawasan Sistem Pembayaran PUR (FPPSP)</h4><p>1. Melaksanakan Perizinan ( Pembukaan, Perpanjangan, dan Pencabutan) Kegiatan Layanan Uang (KLU)</p><p>2. Melaksanakan Pengawasan Kegiatan Layanan Uang (KLU)</p><p>3. Memberikan rekomendasi pembukaan dan perpanjangan/penutupan, serta melaksanakan pengawasan kas titipan</p><br><h4>Fungsi Analisis SP dan PUR serta Keuangan Inklusif dan Perlindungan Konsumen</h4><p>1. Mengelola data dan informasi SP dan PUR serta Kl.</p><p>2. Menghitung Estimasi Kebutuhan Uang (EKU).</p><p>3. Menyusun analisis/kajian terkait SP dan PUR serta Kl.</p><p>4. Merencanakan dan melaksanakan program Kl.</p><p>5. Merencanakan koordinasi/kerjasama dan/atau implementasi program Kl.</p><p>6. Memberikan layanan informasi dan mediasi perlindungan konsumen SP.</p><br><h4>Unit Satuan Layanan dan Administrasi (SLA)</h4><p>Satuan Layanan dan Aministrasi memiliki tugas pokok pada pelaksanaan fungsi SDM, logistic, Anggaran, Sekretariat, Protokol dan pengamanan.<br>Adapun tugas pokok tersebut adalah sebagai berikut:</p><p>1. Melakukan administrasi data dan informasi SDM di satuan kerja.</p><p>2. Mengelola SDM non-organik</p><p>3. Melakukan perencanaan, pemenuhan, penatausahaan, dan pemeliharaan, pengadaan barang dan jasa, termasuk inventaris kantor, alat tulis kantor (ATK) satuan kerja.</p><p>4. Melakukan fungsi Pelaksana Anggaran (PA) dan administrasi pajak satuankerja.</p><p>5. Melakukan penghitungan, Koreksi, Penyetoran dan pelaporan pajak Kantor Perwakilan Bank Indonesia.</p><p>6. Mengelola Administrasi Perjalanan dinas satuan kerja.</p><p>7. Melaksanakan tugas-tugas kesekretariatan satuan kerja.</p><p>8. Mengelola kegiatan protokoler.</p><p>9. Menyediakan akomodasi, transportasi, perizinan, sarana dan prasarana dalam rangka kegiatan keprotokolan di wilayah kerjanya.</p><p>10. Melaksanakan kegiatan operasional pengamanan personil, materil, lingkungan dan acara kedinasan yang diselenggarakan oleh pihak internal dan/atau eksternal, diwilayah kerjanya.</p><p>11. Melaksanakan pengelolaan peralatan pengamanan di wilayah kerjanya.</p><br><h4>Internal Control Officer (ICO) dan Performance Manager (PM)</h4><p>1. Internal Control Officer (ICO) bertanggung jawab mengelola pengendalian intern dan melakukan mitigasi risiko di satuan kerja.</p><p>2. Performance Manager (PM) bertanggung jawab dalam melaksanakan pengelolaan kinerja, pengelolaan anggaran, pengelolaan SDM (pengembangan, cascading IKI, dan budaya kerja), dan pengelolaan program strategis satuan kerja.</p><br><h4>Hubungan Tugas Antar Divisi dan Tim</h4><p>Setiap unit memiliki keterkaitan tugas antar satu dengan lainnya. Fungsi Data dan Statistik Ekonomi dan Keuangan (FDSEK) menyediakan data-data statistik baik dari hasil survei maupun olahan pihak ketiga dan mengolah hasil liasion menjadi data. Data –data yang disusun FDSEK nantinya akan menjadi sumber dan dianalisis Fungsi Asesmen Ekonomi dan Surveilans (FAES) untuk pembuatan kajian-kajian ekonomi regional.</p>', 1),
(7, 'Tim Advisory Ekonomi dan Keuangan', '5cd52cb3423ed.png', '<p>\r\n\r\n</p><h4>Fungsi Data Statistik Ekonomi<br>dan Keuangan ( FDSEK )</h4><p></p><p>\r\n\r\n</p>\r\n\r\n<p>1. Mengumpulkan informasi, mengolah dan menyusun statistik ekonomi dan keuangan daerah untuk kebutuhan stakeholders internal dan eksternal.</p><p>2. Melaksanakan survei dalam rangka mendukung perumusan kebijakan Bank Indonesia dan fungsi advisory.</p><p>3. Melaksanakan kegiatan liaison dalam rangka mendukung perumusan kebijakan Bank Indonesia dan fungsi advisory.</p><p>4. Menyusun RFA( Regional Financial Account dan/atau RBS (Regional Balance Sheet).</p><p>5. Mengelola dan menatausahakan laporan bank dan non bank (a.l. sandi dan hak akses, absensi, validasi kewajaran data, pembinaan dan layanan helpdesk).</p><p>6. Mengelola pelayanan IDI dan penanganan keluhan terkait data SID.</p>\r\n\r\n\r\n\r\n<h4>Fungsi Asesmen Statistik Ekonomi<br>dan Surveilans ( FAES )</h4><p>1. Melakukan pengumpulan informasi ekonomi strategis serta asesmen ekonomi dan keuangan untuk mendukung perumusan rekomendasi kebijakan kepada Kantor Pusat Bank Indonesia dan/atau pemerintah Daerah.</p><p>2. Melakukan fasilitasi upaya penyelesaian permasalahan perekonomian daerah yang membutuhkan penyelesaian dari pemerintah pusat.</p><p>3. Melaksanakan Regional Financial Surveillance (RFS).</p><p>4. Menyusun proyeksi makro ekonomi daerah.</p><p>5. kebijakan ekonomi dan keuangan daerah berdasarkan hasil asesmen dan kajianMenyusun rekomendasi.</p>', 0);

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
-- Indexes for table `edulvl`
--
ALTER TABLE `edulvl`
  ADD PRIMARY KEY (`edulvl_id`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`mentor_id`);

--
-- Indexes for table `regis`
--
ALTER TABLE `regis`
  ADD PRIMARY KEY (`regis_id`),
  ADD KEY `edulvl_id` (`edulvl_id`);

--
-- Indexes for table `regis_auto`
--
ALTER TABLE `regis_auto`
  ADD PRIMARY KEY (`regisauto_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `qrcode_id` (`qrcode_id`),
  ADD KEY `mentor_id` (`mentor_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `edulvl_id` (`edulvl_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

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
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `edulvl`
--
ALTER TABLE `edulvl`
  MODIFY `edulvl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `mentor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `regis`
--
ALTER TABLE `regis`
  MODIFY `regis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `regis_auto`
--
ALTER TABLE `regis_auto`
  MODIFY `regisauto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
-- Ketidakleluasaan untuk tabel `regis`
--
ALTER TABLE `regis`
  ADD CONSTRAINT `fk_edulvl` FOREIGN KEY (`edulvl_id`) REFERENCES `edulvl` (`edulvl_id`);

--
-- Ketidakleluasaan untuk tabel `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_level` FOREIGN KEY (`edulvl_id`) REFERENCES `edulvl` (`edulvl_id`),
  ADD CONSTRAINT `fk_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentor` (`mentor_id`),
  ADD CONSTRAINT `fk_unit` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
