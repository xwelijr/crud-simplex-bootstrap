-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Waktu pembuatan: 20 Nov 2023 pada 18.24
=======
-- Waktu pembuatan: 16 Nov 2023 pada 13.59
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647
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
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `item_id`) VALUES
(1, NULL, NULL),
(2, NULL, NULL),
(3, NULL, NULL),
<<<<<<< HEAD
(4, NULL, NULL),
(5, NULL, NULL),
(6, NULL, NULL),
(7, NULL, NULL),
(8, NULL, NULL),
(9, NULL, NULL);
=======
(4, NULL, NULL);
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `items`
--

<<<<<<< HEAD
INSERT INTO `items` (`id`, `name`, `price`, `image_url`) VALUES
(29, 'Iphone 12 pro', '1200000.00', 'uploads/Apple-iPhone-14-Pro-Max-Deep-Purple-100x100.jpg'),
(32, 'sedotan', '99999999.99', 'uploads/c4f20467-300f-4387-9e25-2129dec21f13.jpg'),
(33, 'Kamera DSLR', '5000000.00', 'uploads/Sewa-Kamera-DSLR-Canon-1300d-Batam-2-100x100.jpg'),
(34, 'Yudha Hartanto', '100.00', 'uploads/Vidnoz_AiFaceSwap_1698300573021.png');
=======
INSERT INTO `items` (`id`, `name`, `price`) VALUES
(23, 'Kamera DSLR', '5000000.00'),
(25, 'Rumah', '99999999.99'),
(26, 'Motor Scoopy', '15000000.00'),
(27, 'Iphone 15', '25000000.00'),
(28, 'Parfum', '12000.00');
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
<<<<<<< HEAD
  `cart_id` int(11) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
=======
  `cart_id` int(11) DEFAULT NULL
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

<<<<<<< HEAD
INSERT INTO `users` (`id`, `username`, `password`, `is_admin`, `cart_id`, `age`, `address`, `email`) VALUES
(35, 'rima', '$2y$10$RGEUX6e5giwbCTxzoaOGv.eyNliFlyVPg8hdHeFWZsRlyb/axvy6S', 0, 9, 25, 'Jalan Lubang Buaya', 'rima@gmail.com');
=======
INSERT INTO `users` (`id`, `username`, `password`, `is_admin`, `cart_id`) VALUES
(29, 'bejir', '$2y$10$IODbJBsqVLa0DSiJVgw3Cu4S6TlDGIbTdq7IS3QA6yH7hJjFO8peq', 0, 3),
(30, 'yudhabejir', '$2y$10$3qmhgbxItejCYJN5Cffv5..c2SCubKc5lh68dqvTNRI9U5sgEe2Ke', 0, 4);
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `item_id` (`item_id`);

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
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
>>>>>>> 842ec50ad3813c31edf6f866cee102e501e0d647

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
