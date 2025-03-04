-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 31, 2025 at 07:23 PM
-- Server version: 8.0.35
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_menu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `dressing`
--

CREATE TABLE `dressing` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dressing`
--

INSERT INTO `dressing` (`id`, `item_name`, `price`) VALUES
(1, 'Italian Dressing', 0.00),
(2, 'French Dressing', 0.00),
(3, 'Ranch Dressing', 0.00),
(4, 'Blue Cheese Dressing', 0.00),
(5, 'Honey Mustard', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`id`, `item_name`, `price`, `image_link`) VALUES
(1, 'Hot Coffee', 0.00, NULL),
(2, 'Hot Tea', 0.00, NULL),
(3, 'Hot Chocolate', 0.00, NULL),
(4, 'Soda (can)', 1.00, NULL),
(5, 'Soda (bottle)', 2.00, NULL),
(6, 'Water', 1.25, NULL),
(7, 'Thai Tea', 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drink_option`
--

CREATE TABLE `drink_option` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drink_option`
--

INSERT INTO `drink_option` (`id`, `item_name`, `price`) VALUES
(1, 'Small', 3.00),
(2, 'Large', 3.50);

-- --------------------------------------------------------

--
-- Table structure for table `patries`
--

CREATE TABLE `patries` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patries`
--

INSERT INTO `patries` (`id`, `item_name`, `price`, `image_link`) VALUES
(1, 'Bagel with Cream Cheese', 2.50, ''),
(2, 'Muffin', 2.50, ''),
(3, 'Chips', 0.75, ''),
(4, 'Hashbrown', 1.50, '');

-- --------------------------------------------------------

--
-- Table structure for table `patries_option`
--

CREATE TABLE `patries_option` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patries_option`
--

INSERT INTO `patries_option` (`id`, `item_name`, `price`) VALUES
(1, 'Toasted', 0.00),
(2, 'Not Toasted', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `salad`
--

CREATE TABLE `salad` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salad`
--

INSERT INTO `salad` (`id`, `item_name`, `price`, `image_link`) VALUES
(1, 'Garden', 4.50, ''),
(2, 'Grilled Chicken', 7.50, ''),
(3, 'Tuna Salad', 7.50, ''),
(4, 'Chef Salad', 7.50, ''),
(5, 'Chicken Salad', 7.50, '');

-- --------------------------------------------------------

--
-- Table structure for table `sandwiches`
--

CREATE TABLE `sandwiches` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sandwiches`
--

INSERT INTO `sandwiches` (`id`, `item_name`, `price`, `image_link`) VALUES
(1, 'Egg &amp; Cheese', 4.50, ''),
(2, 'Grilled Cheese', 3.50, ''),
(3, 'B.L.T', 6.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `sandwich_addon`
--

CREATE TABLE `sandwich_addon` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sandwich_option`
--

CREATE TABLE `sandwich_option` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sandwich_option`
--

INSERT INTO `sandwich_option` (`id`, `item_name`, `price`) VALUES
(1, 'White', 0.00),
(2, 'Wheat', 0.00),
(3, 'Bagel', 0.00),
(4, 'Croissant', 0.00),
(5, 'Wrap', 0.00),
(6, 'Pita', 0.00),
(7, 'Hoagie', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `sandwich_topping`
--

CREATE TABLE `sandwich_topping` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sandwich_topping`
--

INSERT INTO `sandwich_topping` (`id`, `item_name`, `price`, `image_link`) VALUES
(1, 'Salt', 0.00, NULL),
(2, 'Pepper', 0.00, NULL),
(3, 'Ketchup', 0.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `steak`
--

CREATE TABLE `steak` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steak`
--

INSERT INTO `steak` (`id`, `item_name`, `price`, `image_link`) VALUES
(1, 'Cheese Steak', 7.00, ''),
(2, 'Pizza Steak', 8.00, ''),
(3, 'Mushroom Steak', 8.00, ''),
(4, 'Buffalo Chicken Cheese Steak', 8.00, ''),
(5, 'Pepperoni Cheese Steak', 8.00, '');

-- --------------------------------------------------------

--
-- Table structure for table `steak_option`
--

CREATE TABLE `steak_option` (
  `id` int NOT NULL,
  `item_name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `steak_option`
--

INSERT INTO `steak_option` (`id`, `item_name`, `price`) VALUES
(1, 'Hoagie', 0.00),
(2, 'Pita', 0.00),
(3, 'Wrap', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dressing`
--
ALTER TABLE `dressing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drink_option`
--
ALTER TABLE `drink_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patries`
--
ALTER TABLE `patries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patries_option`
--
ALTER TABLE `patries_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salad`
--
ALTER TABLE `salad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sandwiches`
--
ALTER TABLE `sandwiches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sandwich_addon`
--
ALTER TABLE `sandwich_addon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sandwich_option`
--
ALTER TABLE `sandwich_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sandwich_topping`
--
ALTER TABLE `sandwich_topping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steak`
--
ALTER TABLE `steak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steak_option`
--
ALTER TABLE `steak_option`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dressing`
--
ALTER TABLE `dressing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drink`
--
ALTER TABLE `drink`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drink_option`
--
ALTER TABLE `drink_option`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patries`
--
ALTER TABLE `patries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `patries_option`
--
ALTER TABLE `patries_option`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `salad`
--
ALTER TABLE `salad`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sandwiches`
--
ALTER TABLE `sandwiches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sandwich_addon`
--
ALTER TABLE `sandwich_addon`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sandwich_option`
--
ALTER TABLE `sandwich_option`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sandwich_topping`
--
ALTER TABLE `sandwich_topping`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `steak`
--
ALTER TABLE `steak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `steak_option`
--
ALTER TABLE `steak_option`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
