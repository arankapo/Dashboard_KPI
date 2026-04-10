-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2024 at 01:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekinerja`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dept`
--

CREATE TABLE `tb_dept` (
  `Id_dept` varchar(10) NOT NULL,
  `nama_dept` varchar(20) NOT NULL,
  `sub_dept` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_dept`
--

INSERT INTO `tb_dept` (`Id_dept`, `nama_dept`, `sub_dept`) VALUES
('DR1', 'DIREKSI MEGA', 'DIREKSI'),
('HR03', 'HR Legal', 'HRGA'),
('HR04', 'HR', 'HRGA'),
('HR07', 'SIPIL', 'HRGA'),
('HR08', 'SIPIL', 'HRGA'),
('HR09', 'SIPIL', 'HRGA'),
('HR1', 'IT', 'HRGA'),
('HR2', 'HRGA', 'HRGA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_karyawan`
--

CREATE TABLE `tb_karyawan` (
  `nik_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(20) NOT NULL,
  `jabatan_karyawan` varchar(20) NOT NULL,
  `id_dept` varchar(20) NOT NULL,
  `nama_dept` varchar(20) NOT NULL,
  `unit_kerja` varchar(20) NOT NULL,
  `atasan_karyawan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_karyawan`
--

INSERT INTO `tb_karyawan` (`nik_karyawan`, `nama_karyawan`, `jabatan_karyawan`, `id_dept`, `nama_dept`, `unit_kerja`, `atasan_karyawan`) VALUES
('', '', '', '', 'HR04', 'A', ''),
('10001', 'MASLUKIN', 'IT SUPPORT', 'HR1', 'IT', 'MEGA JASEM', 'ADITYA'),
('10002', 'ADITYA', 'IT SUPERVISOR', 'HR1', 'IT', 'MEGA JASEM', 'SISWANTA'),
('10003', 'SISWANTA', 'IT SUPERVISOR', 'HR2', 'IT', 'MEGA JASEM', 'ERIC'),
('10004', 'ERIC', 'DIREKSI MEGA', 'DR1', 'DIREKSI MEGA', 'MEGA JASEM', 'ERIC'),
('10006', 'Sumpil', 'staff', 'HR1', 'IT', 'Mega Jasem', 'Siswanta'),
('10007', 'aditya bayu anggara', 'staff', '', 'HR Legal', 'Mega Jasem', 'Siswanta');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai`
--

CREATE TABLE `tb_nilai` (
  `no_dok` int(20) NOT NULL,
  `revisi` varchar(20) NOT NULL,
  `tanggal_efektif` varchar(20) NOT NULL,
  `nama_dept` varchar(20) NOT NULL,
  `unit_kerja` varchar(20) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `nama_karyawan` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `dept` varchar(20) NOT NULL,
  `nilaia1` int(20) NOT NULL,
  `skora` int(20) NOT NULL,
  `nilaib1` int(20) NOT NULL,
  `nilaib2` int(20) NOT NULL,
  `nilaib3` int(20) NOT NULL,
  `nilaib4` int(20) NOT NULL,
  `nilaib5` int(20) NOT NULL,
  `nilaib6` int(20) NOT NULL,
  `nilaib7` int(20) NOT NULL,
  `nilaib8` int(20) NOT NULL,
  `nilaib9` int(20) NOT NULL,
  `nilaib10` int(20) NOT NULL,
  `totalb` int(20) NOT NULL,
  `skorb` int(20) NOT NULL,
  `nilaic1` int(20) NOT NULL,
  `nilaic2` int(20) NOT NULL,
  `nilaic3` int(20) NOT NULL,
  `nilaic4` int(20) NOT NULL,
  `nilaic5` int(20) NOT NULL,
  `totalc` int(20) NOT NULL,
  `skorc` int(20) NOT NULL,
  `totalskor` int(20) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nilai`
--

INSERT INTO `tb_nilai` (`no_dok`, `revisi`, `tanggal_efektif`, `nama_dept`, `unit_kerja`, `periode`, `nama_karyawan`, `nik`, `jabatan`, `dept`, `nilaia1`, `skora`, `nilaib1`, `nilaib2`, `nilaib3`, `nilaib4`, `nilaib5`, `nilaib6`, `nilaib7`, `nilaib8`, `nilaib9`, `nilaib10`, `totalb`, `skorb`, `nilaic1`, `nilaic2`, `nilaic3`, `nilaic4`, `nilaic5`, `totalc`, `skorc`, `totalskor`, `catatan`) VALUES
(0, '', '', '', '', '', 'nama_karyawan', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_nilai_karyawan`
--

CREATE TABLE `tb_nilai_karyawan` (
  `no_dok` int(20) NOT NULL,
  `revisi` varchar(20) NOT NULL,
  `tanggal_efektif` varchar(20) NOT NULL,
  `nama_dept` varchar(20) NOT NULL,
  `unit_kerja` varchar(20) NOT NULL,
  `periode` varchar(20) NOT NULL,
  `nama_karyawan` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `sub_dept` varchar(20) NOT NULL,
  `nilaia1` int(20) NOT NULL,
  `skora` int(20) NOT NULL,
  `nilaib1` int(20) NOT NULL,
  `nilaib2` int(20) NOT NULL,
  `nilaib3` int(20) NOT NULL,
  `nilaib4` int(20) NOT NULL,
  `nilaib5` int(20) NOT NULL,
  `nilaib6` int(20) NOT NULL,
  `nilaib7` int(20) NOT NULL,
  `nilaib8` int(20) NOT NULL,
  `nilaib9` int(20) NOT NULL,
  `nilaib10` int(20) NOT NULL,
  `totalb` int(20) NOT NULL,
  `skorb` int(20) NOT NULL,
  `nilaic1` int(20) NOT NULL,
  `nilaic2` int(20) NOT NULL,
  `nilaic3` int(20) NOT NULL,
  `nilaic4` int(20) NOT NULL,
  `nilaic5` int(20) NOT NULL,
  `totalc` int(20) NOT NULL,
  `skorc` int(20) NOT NULL,
  `totalskor` int(20) NOT NULL,
  `catatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_nilai_karyawan`
--

INSERT INTO `tb_nilai_karyawan` (`no_dok`, `revisi`, `tanggal_efektif`, `nama_dept`, `unit_kerja`, `periode`, `nama_karyawan`, `nik`, `jabatan`, `sub_dept`, `nilaia1`, `skora`, `nilaib1`, `nilaib2`, `nilaib3`, `nilaib4`, `nilaib5`, `nilaib6`, `nilaib7`, `nilaib8`, `nilaib9`, `nilaib10`, `totalb`, `skorb`, `nilaic1`, `nilaic2`, `nilaic3`, `nilaic4`, `nilaic5`, `totalc`, `skorc`, `totalskor`, `catatan`) VALUES
(12, 'revisi', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
(1231, '', '', '', 'ad', 'asdsd', 'nama_karyawan', 'asd', 'asd', 'asd', 0, 1, 5, 5, 5, 5, 5, 5, 5, 5, 5, 5, 1, 0, 5, 5, 5, 5, 5, 1, 1, 1, 'asda'),
(0, 'revisi', 'tanggal_efektif', 'nama_dept', 'unit_kerja', 'periode', 'nama_karyawan', 'nik', 'jabatan', 'sub_dept', 1, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 20, 21, 1, 2, 3, 4, 5, 30, 31, 32, 'catatan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `Nik` int(8) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Jabatan` varchar(20) NOT NULL,
  `Divisi` varchar(20) NOT NULL,
  `Unit_Kerja` varchar(20) NOT NULL,
  `Level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`Nik`, `Nama`, `Jabatan`, `Divisi`, `Unit_Kerja`, `Level`) VALUES
(4010123, 'Lukin', 'IT Staff', 'IT', 'Mega Jasem', 'Staff'),
(4023099, 'Aditya', 'Supervisor IT', 'IT', 'MEGA JASEM', 'Supervisor'),
(4031001, 'Siswanta', 'Manajer HRGA', 'HRGA', 'Mega Jasem', 'Manajer'),
(9000009, 'Eric', 'Direktur', 'Direksi', 'Mega Jasem', 'Direksi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `Id` int(8) NOT NULL,
  `Nama` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`Id`, `Nama`, `Username`, `Password`, `Level`) VALUES
(1, 'Aditya', '10002', '12345', 'Supervisor'),
(2, 'Lukin', '10001', '12345', 'Staff'),
(3, 'Siswanta', '10003', '12345', 'Manajer'),
(4, 'Eric', '10004', '12345', 'Direksi'),
(5, 'Admin HRD', '10005', '12345', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dept`
--
ALTER TABLE `tb_dept`
  ADD PRIMARY KEY (`Id_dept`);

--
-- Indexes for table `tb_karyawan`
--
ALTER TABLE `tb_karyawan`
  ADD PRIMARY KEY (`nik_karyawan`);

--
-- Indexes for table `tb_nilai`
--
ALTER TABLE `tb_nilai`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_nilai_karyawan`
--
ALTER TABLE `tb_nilai_karyawan`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`Nik`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
