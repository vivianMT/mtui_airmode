-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2026 at 07:10 AM
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
-- Database: `mtui_airmode_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `trip_type` enum('one-way','round-trip') DEFAULT 'one-way',
  `return_date` date DEFAULT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','paid') DEFAULT 'pending',
  `payment_reference` varchar(100) DEFAULT NULL,
  `ticket_number` varchar(50) DEFAULT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `flight_id`, `trip_type`, `return_date`, `total_amount`, `payment_status`, `payment_reference`, `ticket_number`, `booked_at`) VALUES
(1, 1, 3, 'one-way', NULL, 80000.00, 'paid', NULL, 'MTUI-28930', '2026-06-07 09:13:41'),
(2, 1, 2, 'one-way', NULL, 120000.00, 'pending', NULL, 'MTUI-77287', '2026-06-07 09:14:54'),
(3, 1, 2, 'one-way', NULL, 120000.00, 'pending', NULL, 'MTUI-77478', '2026-06-07 09:15:11'),
(4, 1, 2, 'one-way', NULL, 120000.00, 'pending', NULL, 'MTUI-17106', '2026-06-07 10:30:23'),
(5, 1, 1, 'one-way', NULL, 150000.00, 'paid', NULL, 'MTUI-71738', '2026-06-07 10:31:21'),
(6, 1, 2, 'one-way', NULL, 120000.00, 'pending', NULL, 'MTUI-57221', '2026-06-07 11:58:04'),
(7, 1, 3, 'one-way', NULL, 80000.00, 'pending', NULL, 'MTUI-91440', '2026-06-07 12:04:23'),
(8, 1, 4, 'one-way', NULL, 0.00, 'pending', NULL, 'MTUI-53484', '2026-06-07 12:27:20'),
(9, 1, 4, 'one-way', NULL, 0.00, 'paid', NULL, 'MTUI-76806', '2026-06-07 12:57:57');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `flight_number` varchar(20) NOT NULL,
  `origin` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time NOT NULL,
  `price_economy` decimal(10,2) NOT NULL,
  `price_business` decimal(10,2) NOT NULL,
  `seats_available` int(11) NOT NULL,
  `status` enum('scheduled','delayed','cancelled') DEFAULT 'scheduled',
  `price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `flight_number`, `origin`, `destination`, `departure_date`, `departure_time`, `price_economy`, `price_business`, `seats_available`, `status`, `price`) VALUES
(1, 'TM101', 'Dar es Salaam', 'Mwanza', '2026-06-10', '10:00:00', 150000.00, 0.00, 40, 'scheduled', 120000),
(2, 'TM202', 'Dar es Salaam', 'Arusha', '2026-06-11', '14:00:00', 120000.00, 0.00, 30, 'scheduled', 180000),
(3, 'TM303', 'Dar es Salaam', 'Zanzibar', '2026-06-12', '09:30:00', 80000.00, 0.00, 50, 'scheduled', 250000),
(4, 'MT101', 'Dar es Salaam', 'Mwanza', '2026-06-10', '10:00:00', 0.00, 0.00, 0, 'scheduled', 150000);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message_content` text NOT NULL,
  `status` enum('unread','read') DEFAULT 'unread',
  `message_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','passenger') DEFAULT 'passenger',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Vivian Mtui', 'vivianmtui01@gmail.com', '$2y$10$vQURwEM.CHk4V4te5tP5kuWyr/K1oDTLelomOT.Ggy/7abcccYIca', 'passenger', '2026-06-07 06:31:16'),
(4, 'Admin MTUI', 'admin@mtui.com', '$2y$10$abcdefghijklmnopqrstuv1234567890abcdef', 'admin', '2026-06-07 12:56:07'),
(5, '', 'caca@gmail.com', '$2y$10$utZ9xK/IzgpMXTZcQgIP/.ForT/cH/5ptDj9f23U5nMtrAcOqnrw6', '', '2026-06-07 13:09:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticket_number` (`ticket_number`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flights` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
