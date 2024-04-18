-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2024 pada 10.25
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sertifikat_online`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate`
--

CREATE TABLE `certificate` (
  `certificate_id` int(11) NOT NULL,
  `participant_name` varchar(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `certificate_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `certificate`
--

INSERT INTO `certificate` (`certificate_id`, `participant_name`, `event_name`, `event_date`, `certificate_text`, `created_at`) VALUES
(1, '1', 'karate', '2024-04-18', 'ujian kenaikan sabuk', '2024-04-18 02:32:43'),
(2, 'intann', 'seminar', '2024-04-18', 'seminar', '2024-04-18 02:49:55'),
(3, 'siskaa', 'karate', '2024-04-18', 'latihan cabang', '2024-04-18 03:06:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate_assignment`
--

CREATE TABLE `certificate_assignment` (
  `assignment_id` int(11) NOT NULL,
  `certificate_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `assigned_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `certificate_assignment`
--

INSERT INTO `certificate_assignment` (`assignment_id`, `certificate_id`, `user_id`, `event_id`, `assigned_at`) VALUES
(1, 1, 1, 1, '2024-04-18 02:47:15'),
(2, 2, 2, 2, '2024-04-18 02:50:11'),
(3, 3, 3, 3, '2024-04-18 03:06:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `organizer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_date`, `location`, `organizer`, `created_at`) VALUES
(1, 'karate', '2024-04-18', 'depok', 'dojo trysan', '2024-04-18 02:32:17'),
(2, 'seminar', '2024-04-18', 'depok', 'yaj', '2024-04-18 02:49:38'),
(3, 'karate', '2024-04-18', 'smkyaj', 'dojo trysan', '2024-04-18 03:05:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `level` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `email`, `created_at`, `level`) VALUES
(0, 'admin', '111', 'admin', 'admin@gmail.com', '2024-02-01 07:34:03', 'admin'),
(1, 'amanda', '222', 'amanda', 'amanda@gmail.com', '2024-04-18 02:31:32', 'user'),
(2, 'intan', '111', 'intann', 'intan@gmail.com', '2024-04-18 02:49:09', 'user'),
(3, 'siska', '111', 'siskaa', 'siska@gmail.com', '2024-04-18 03:02:19', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `certificate`
--
ALTER TABLE `certificate`
  ADD PRIMARY KEY (`certificate_id`);

--
-- Indeks untuk tabel `certificate_assignment`
--
ALTER TABLE `certificate_assignment`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `certificate_id` (`certificate_id`) USING BTREE,
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `event_id` (`event_id`) USING BTREE;

--
-- Indeks untuk tabel `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `certificate`
--
ALTER TABLE `certificate`
  MODIFY `certificate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `certificate_assignment`
--
ALTER TABLE `certificate_assignment`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `certificate_assignment`
--
ALTER TABLE `certificate_assignment`
  ADD CONSTRAINT `certificate_assignment_ibfk_1` FOREIGN KEY (`certificate_id`) REFERENCES `certificate` (`certificate_id`),
  ADD CONSTRAINT `certificate_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `certificate_assignment_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
