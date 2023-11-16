-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Nov 2023 pada 07.17
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
-- Database: `crud_simple`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `name`, `price`) VALUES
(7, 'IPHONE 15', '20000000.00'),
(8, 'LENSA KAMERA', '5000000.00'),
(11, 'Iphone XR', '9000000.00'),
(15, 'tes', '4500000.00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(18, 'yudhabejir12345', '$2y$10$leHZixC3IfdKIvDoW.bzgO1YW/.qnVAFvF9iJvRgjxKhXU5Dsf..u', 0),
(19, 'yudhabejir123', '$2y$10$WILT81FPZuXI2zjYPxCu9.tZPyV6yWHFnJyCh1d.BnqSUHHtt84mW', 0),
(20, 'yudhabejir123', '$2y$10$ThFQ03S4NW/UguhY9q1Y/uCLDDDsflVi8ySWNwYIklaBbjqzBPeNe', 0),
(21, 'yudha123bejir123', '$2y$10$VSXPizO7gWjsuXtmAvsF.OziPbq3HNvAWasreKoK2MGNWF65EzkSW', 0),
(22, 'yudha\\', '$2y$10$COU.xCuzlNZ3SkczvLp3lu8xSkJhTjaaxFtmFjChckxAhoVACLzR.', 0),
(23, 'yudha', '$2y$10$2QdA/dn/VXg8XfW6drlSMezT2/15CpHfuvxF1xsB.zYkYeCaS7au2', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
