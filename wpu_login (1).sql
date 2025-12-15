-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2025 at 05:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wpu_login`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwal`
--

CREATE TABLE `detail_jadwal` (
  `id` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `deskripsi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_jadwal`
--

INSERT INTO `detail_jadwal` (`id`, `id_mapel`, `deskripsi`) VALUES
(1, 1, 'Membuat puisi'),
(3, 1, 'Merangkum materi karya ilmiahh'),
(4, 3, 'Materi Simple Past Tense'),
(6, 4, 'Fungsi Linier ');

-- --------------------------------------------------------

--
-- Table structure for table `m_jadwal`
--

CREATE TABLE `m_jadwal` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `hari` varchar(128) NOT NULL,
  `semester` varchar(128) NOT NULL,
  `tahun_ajaran` varchar(128) NOT NULL,
  `id_jam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_jadwal`
--

INSERT INTO `m_jadwal` (`id`, `id_kelas`, `id_mapel`, `hari`, `semester`, `tahun_ajaran`, `id_jam`) VALUES
(1, 4, 1, 'Senin', 'Ganjil', '2025/2026', 0),
(2, 4, 1, 'Senin', 'Ganjil', '2025/2026', 0),
(3, 4, 3, 'Senin', 'Ganjil', '2025/2026', 0),
(4, 4, 4, 'Senin', 'Ganjil', '2025/2026', 0),
(5, 5, 6, 'Senin', 'Ganjil', '2025/2026', 0),
(6, 4, 4, 'Rabu', 'Ganjil', '2025/2026', 0),
(7, 5, 5, 'Selasa', 'Ganjil', '2025/2026', 0),
(8, 4, 5, 'Kamis', 'Ganjil', '2025/2026', 0),
(9, 4, 1, 'Jumat', 'Ganjil', '2025/2026', 0),
(10, 2, 1, 'Selasa', 'Ganjil', '2025/2026', 0),
(11, 6, 3, 'Senin', 'Ganjil', '2025/2026', 2),
(12, 6, 6, 'Kamis', 'Ganjil', '2025/2026', 1),
(13, 4, 1, 'Senin', 'Ganjil', '2025/2026', 5),
(14, 4, 6, 'Senin', 'Ganjil', '2025/2026', 2),
(15, 2, 5, 'Jumat', 'Ganjil', '2025/2026', 5),
(16, 4, 4, 'Senin', 'Ganjil', '2025/2026', 1),
(17, 4, 3, 'Selasa', 'Ganjil', '2025/2026', 5),
(18, 4, 5, 'Selasa', 'Ganjil', '2025/2026', 1),
(19, 4, 5, 'Selasa', 'Ganjil', '2025/2026', 1),
(20, 4, 5, 'Selasa', 'Ganjil', '2025/2026', 1),
(21, 4, 1, 'Selasa', 'Ganjil', '2025/2026', 2),
(22, 4, 1, 'Rabu', 'Ganjil', '2025/2026', 5),
(23, 4, 4, 'Rabu', 'Ganjil', '2025/2026', 1),
(24, 4, 6, 'Rabu', 'Ganjil', '2025/2026', 2),
(25, 4, 3, 'Kamis', 'Ganjil', '2025/2026', 5),
(26, 4, 4, 'Kamis', 'Ganjil', '2025/2026', 1),
(27, 4, 5, 'Kamis', 'Ganjil', '2025/2026', 2),
(28, 4, 4, 'Jumat', 'Ganjil', '2025/2026', 5),
(29, 4, 1, 'Jumat', 'Ganjil', '2025/2026', 1),
(30, 4, 6, 'Jumat', 'Ganjil', '2025/2026', 2),
(31, 4, 6, 'Jumat', 'Ganjil', '2025/2026', 2),
(32, 5, 1, 'Senin', 'Ganjil', '2025/2026', 5),
(33, 5, 3, 'Senin', 'Ganjil', '2025/2026', 1),
(34, 5, 4, 'Senin', 'Ganjil', '2025/2026', 2),
(35, 5, 8, 'Selasa', 'Ganjil', '2025/2026', 5),
(36, 5, 7, 'Selasa', 'Ganjil', '2025/2026', 1),
(37, 5, 6, 'Selasa', 'Ganjil', '2025/2026', 2),
(38, 5, 9, 'Rabu', 'Ganjil', '2025/2026', 5),
(39, 5, 1, 'Rabu', 'Ganjil', '2025/2026', 1),
(40, 5, 4, 'Rabu', 'Ganjil', '2025/2026', 2),
(41, 5, 7, 'Kamis', 'Ganjil', '2025/2026', 5),
(42, 5, 1, 'Kamis', 'Ganjil', '2025/2026', 2),
(43, 5, 5, 'Kamis', 'Ganjil', '2025/2026', 1),
(44, 5, 4, 'Jumat', 'Ganjil', '2025/2026', 5),
(45, 5, 8, 'Jumat', 'Ganjil', '2025/2026', 1),
(46, 5, 7, 'Jumat', 'Ganjil', '2025/2026', 2),
(47, 2, 1, 'Senin', 'Ganjil', '2025/2026', 5),
(48, 2, 3, 'Senin', 'Ganjil', '2025/2026', 1),
(49, 2, 4, 'Senin', 'Ganjil', '2025/2026', 2),
(50, 2, 5, 'Selasa', 'Ganjil', '2025/2026', 5),
(51, 2, 6, 'Selasa', 'Ganjil', '2025/2026', 1),
(52, 2, 7, 'Selasa', 'Ganjil', '2025/2026', 2),
(53, 2, 8, 'Rabu', 'Ganjil', '2025/2026', 5),
(54, 2, 9, 'Rabu', 'Ganjil', '2025/2026', 1),
(55, 2, 1, 'Rabu', 'Ganjil', '2025/2026', 2),
(56, 2, 3, 'Kamis', 'Ganjil', '2025/2026', 5),
(57, 2, 4, 'Kamis', 'Ganjil', '2025/2026', 1),
(58, 2, 6, 'Kamis', 'Ganjil', '2025/2026', 1),
(59, 2, 9, 'Kamis', 'Ganjil', '2025/2026', 2),
(60, 2, 6, 'Jumat', 'Ganjil', '2025/2026', 1),
(61, 2, 3, 'Jumat', 'Ganjil', '2025/2026', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_jam_pelajaran`
--

CREATE TABLE `m_jam_pelajaran` (
  `id` int(11) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_jam_pelajaran`
--

INSERT INTO `m_jam_pelajaran` (`id`, `jam_mulai`, `jam_selesai`) VALUES
(1, '08:20:00', '10:15:00'),
(2, '10:20:00', '12:15:00'),
(5, '07:00:00', '08:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `m_jurusan`
--

CREATE TABLE `m_jurusan` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `code_jurusan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_jurusan`
--

INSERT INTO `m_jurusan` (`id`, `name`, `deskripsi`, `code_jurusan`) VALUES
(1, 'PPLG', 'Pemrograman Perangkat Lunak dan GIM', '02'),
(3, 'DKV', 'Desain Komunikasi Visual', '03'),
(6, 'AKL', 'Akuntansi dan Keuangan Lembagaa', '04'),
(7, 'TKJ', 'Teknik Komputer dan Jaringan', '05'),
(8, 'ELEKTRO', 'Elektroo', '06');

-- --------------------------------------------------------

--
-- Table structure for table `m_kelas`
--

CREATE TABLE `m_kelas` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `code_kelas` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_kelas`
--

INSERT INTO `m_kelas` (`id`, `name`, `id_jurusan`, `code_kelas`) VALUES
(2, 'XII', 1, '01'),
(4, 'X', 3, '12'),
(5, 'XI', 6, '06'),
(6, 'XII', 8, '09');

-- --------------------------------------------------------

--
-- Table structure for table `m_mapel`
--

CREATE TABLE `m_mapel` (
  `id` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `name_mapel` varchar(128) NOT NULL,
  `code_mapel` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_mapel`
--

INSERT INTO `m_mapel` (`id`, `id_kelas`, `name_mapel`, `code_mapel`) VALUES
(1, 2, 'Bahasa Indonesia', '01'),
(3, 4, 'Bahasa Inggris', '03'),
(4, 5, 'Matematika', '02'),
(5, 6, 'Sejarah', '04'),
(6, 4, 'PPKn', '05'),
(7, 2, 'Seni Budaya', '06'),
(8, 5, 'Ipas', '07'),
(9, 5, 'Agama', '08');

-- --------------------------------------------------------

--
-- Table structure for table `m_siswa`
--

CREATE TABLE `m_siswa` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `m_siswa`
--

INSERT INTO `m_siswa` (`id`, `id_user`, `id_kelas`, `tanggal_lahir`) VALUES
(1, 4, 4, '2008-12-05'),
(3, 9, 4, '2009-04-01'),
(7, 5, 6, '2008-03-15'),
(8, 6, 5, '2008-09-12'),
(9, 11, 4, '2008-05-15'),
(10, 12, 4, '2008-02-10');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_wa` varchar(20) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `no_wa`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Fairuz Nayla', 'naylanay623@gmail.com', '', 'cat.jpg', '$2y$10$iDGe6Cg99Y45NOP7XhxWD.07AVL7NdRd17APZSxO4rHZXbaSwjgeK', 1, 1, 1759387645),
(4, 'Tasya Hasna', 'hasnatsya776@gmail.com', '', 'default.jpg', '$2y$10$FhjMx1LDTZft6ebmSQ0JKeKH4cmFOTdQ9kb6FHStycbH6T5UG4hrG', 2, 1, 1759389074),
(5, 'Dinda Danindra', 'dindadin789@gmail.com', '', 'default.jpg', '$2y$10$ELyYxCV8QoxM6Uz2Q6UODOFrRwQXw1VfwrTta/NuB6qNATKqzMsoO', 2, 1, 1760119686),
(6, 'Rizki', 'rizki@gmail.com', '', 'default.jpg', '$2y$10$FQwwXmSBhNBA.ZNaCDzVUudRIoH.cxO0bxrU.07Aq5XojjCUlSylW', 2, 1, 1760190535),
(9, 'Fadhila', 'lalafadhila108@gmail.com', '', 'default.jpg', '$2y$10$MXriB.rj8pRQ8W0MOYccpu2pl/bMkr75Q03iKKj46VR2UGb6cmP6K', 2, 1, 1760270261),
(10, 'Davi nanda', 'davinanda@gmail.com', '', 'default.jpg', '$2y$10$sQsVHFvr8g.JqlSz5BfbrujkuvowMpcM1R2r2rKWJPMkWsYIRcyOa', 2, 1, 1761019915),
(11, 'Nadila Lala', 'nadila@gmail.com', '6289649474381', 'default.jpg', '$2y$10$9GWvyt0tgbg113SdJV9Ob.8vomHyDCsuSx.Kj5Of8eD.xrzjKScC6', 2, 1, 1763088774),
(12, 'Fairuz Nay', 'fairuz@gmail.com', '6288232549892', 'default.jpg', '$2y$10$8FrEu/fDW/1j9Qq5oF2XrOMQKbi2cc1W.OwFgyPz5dbyKz9JXuRKq', 2, 1, 1763429700);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(7, 1, 3),
(8, 1, 2),
(11, 1, 25),
(12, 1, 28),
(14, 2, 29);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu'),
(25, 'Master Data'),
(28, 'Manajemen Jadwal'),
(29, 'Jadwal');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fa-solid fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fa-solid fa-fw fa-user-pen', 1),
(4, 3, 'Menu Management', 'menu', 'fa-solid fa-fw fa-folder-closed', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fa-solid fa-fw fa-folder-open', 1),
(8, 1, 'Role', 'admin/role', 'fa-solid fa-fw fa-user-tie', 1),
(9, 2, 'Change Password', 'user/changepassword', 'fa-solid fa-fw fa-key', 1),
(11, 25, 'Jurusan', 'jurusan', 'fas fa-fw fa-graduation-cap', 1),
(12, 25, 'Kelas', 'kelas', 'fas fa-fw fa-school', 1),
(13, 25, 'Mapel', 'mapel', 'fa-solid fa-fw fa-book', 1),
(14, 25, 'Siswa', 'siswa', 'fa-solid fa-fw fa-users', 1),
(15, 28, 'Jadwal', 'jadwal', 'fa-solid fa-fw fa-calendar-days', 1),
(16, 25, 'Input Jadwal', 'manajemenjadwal', 'fa-solid fa-fw fa-calendar-plus', 1),
(17, 25, 'Jam Pelajaran', 'jam', 'fa-solid fa-fw fa-clock', 1),
(18, 29, 'Jadwal Saya', 'user/jadwal', 'fa-solid fa-fw fa-address-book', 1),
(19, 28, 'Kirim Pengingat ', 'Reminder', 'fa-solid fa-fw fa-bell', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(4, 'lalafadhila108@gmail.com', 'gtLkt+ICantTOAq0n7WrUBhgfSkfvrzykEOvdnotpZE=', 1760282197),
(5, 'davinanda@gmail.com', 'DCnNS9xZqw8rjrpKg2iP6xHlYv9L4lHlk11vbLvJyrc=', 1761019915),
(6, 'nadila@gmail.com', 'VaPZgO4eOSMz2XZNGu5e+NaWL9Cv/hJcXo3VLVbjl+E=', 1763088774),
(7, 'fairuz@gmail.com', '0DiBLJXo7AJb8Y16BYPWf9xesKB2qtdfrWRlED08VZ4=', 1763429700);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jadwal`
--
ALTER TABLE `m_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jam_pelajaran`
--
ALTER TABLE `m_jam_pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kelas`
--
ALTER TABLE `m_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_mapel`
--
ALTER TABLE `m_mapel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_siswa`
--
ALTER TABLE `m_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_jadwal`
--
ALTER TABLE `detail_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_jadwal`
--
ALTER TABLE `m_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `m_jam_pelajaran`
--
ALTER TABLE `m_jam_pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_jurusan`
--
ALTER TABLE `m_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `m_kelas`
--
ALTER TABLE `m_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `m_mapel`
--
ALTER TABLE `m_mapel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `m_siswa`
--
ALTER TABLE `m_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
