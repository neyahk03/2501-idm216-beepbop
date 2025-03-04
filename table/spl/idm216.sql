-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 04, 2025 at 12:00 AM
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
-- Database: `idm216`
--

-- --------------------------------------------------------

--
-- Table structure for table `bread`
--

CREATE TABLE `bread` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bread`
--

INSERT INTO `bread` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'White', 0.00),
(2, 'Wheat', 0.00),
(3, 'Bagel', 0.00),
(4, 'Croissant', 0.00),
(5, 'Wrap', 0.00),
(6, 'Pita', 0.00),
(7, 'Hoagie', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `cheesesteaks`
--

CREATE TABLE `cheesesteaks` (
  `id` int NOT NULL,
  `menu_item` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cheesesteaks`
--

INSERT INTO `cheesesteaks` (`id`, `menu_item`, `price`, `image_link`) VALUES
(1, 'Cheese Steak', 7.00, 'cheese-steak.jpg'),
(2, 'Pizza Steak', 8.00, 'pizza-steak.jpg'),
(3, 'Mushroom Steak', 8.00, 'mushroom-cheese-steak.jpg'),
(4, 'Buffalo Chicken Cheese Steak', 7.50, 'buffalo-chicken-cheese-steak.jpg'),
(5, 'Pepperoni Cheese Steak', 8.00, 'pepperoni-cheese-steak.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cheesesteak_bread`
--

CREATE TABLE `cheesesteak_bread` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cheesesteak_bread`
--

INSERT INTO `cheesesteak_bread` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'Hoagie', 0.00),
(2, 'Pita', 0.00),
(3, 'Wrap', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `condiments`
--

CREATE TABLE `condiments` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL,
  `image_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `condiments`
--

INSERT INTO `condiments` (`item_id`, `item_name`, `item_price`, `image_link`) VALUES
(1, 'Salt', 0.00, NULL),
(2, 'Pepper', 0.00, NULL),
(3, 'Ketchup', 0.00, NULL),
(4, 'Mayo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dressing`
--

CREATE TABLE `dressing` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dressing`
--

INSERT INTO `dressing` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'Italian Dressing', 0.00),
(2, 'French Dressing', 0.00),
(3, 'Ranch Dressing', 0.00),
(4, 'Blue Cheese Dressing', 0.00),
(5, 'Honey Mustard', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `drinks`
--

CREATE TABLE `drinks` (
  `id` int NOT NULL,
  `menu_item` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drinks`
--

INSERT INTO `drinks` (`id`, `menu_item`, `price`, `image_link`) VALUES
(1, 'Hot Coffee', 1.50, 'hot-coffee.jpg'),
(2, 'Hot Tea', 1.50, 'hot-tea.jpg'),
(3, 'Hot Chocolate', 1.50, 'hot-chocolate.jpg'),
(4, 'Soda', 1.50, 'soda.png'),
(5, 'Water', 1.50, 'water.jpg'),
(6, 'Thai Tea', 3.00, 'thai-tea.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `drink_option`
--

CREATE TABLE `drink_option` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drink_option`
--

INSERT INTO `drink_option` (`item_id`, `item_name`, `item_price`) VALUES
(3, 'Can', 1.50),
(4, 'Bottle', 2.50);

-- --------------------------------------------------------

--
-- Table structure for table `drink_size`
--

CREATE TABLE `drink_size` (
  `item_id` int NOT NULL,
  `item_name` text,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drink_size`
--

INSERT INTO `drink_size` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'Small', NULL),
(2, 'Large', 1.00);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE `menu_item` (
  `id` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`id`, `name`, `price`, `image`) VALUES
(1, 'Breakfast Sandwich', 7.00, 'sandwich.jpg'),
(2, 'Muffin', 3.99, 'muffin.jpg'),
(3, 'Water', 1.99, 'water.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pastries`
--

CREATE TABLE `pastries` (
  `id` int NOT NULL,
  `menu_item` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pastries`
--

INSERT INTO `pastries` (`id`, `menu_item`, `price`, `image_link`) VALUES
(1, 'Bagel with Cream Cheese', 2.50, 'bagel-and-cream-cheese.jpg'),
(2, 'Muffin', 2.50, 'muffin.jpg'),
(3, 'Chips', 0.75, 'chips.jpg'),
(4, 'Hashbrown', 1.50, 'hashbrown.png');

-- --------------------------------------------------------

--
-- Table structure for table `preparation_option`
--

CREATE TABLE `preparation_option` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `preparation_option`
--

INSERT INTO `preparation_option` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'Toasted', 0.00),
(2, 'Not Toasted', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `protein`
--

CREATE TABLE `protein` (
  `item_id` int NOT NULL,
  `item_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `item_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `protein`
--

INSERT INTO `protein` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'Bacon', 1.50),
(2, 'Turkey Bacon', 1.50),
(3, 'Ham', 1.50),
(4, 'Sausage', 1.50),
(5, 'Pork Roll', 1.50),
(6, 'Hash Brown', 1.00),
(7, 'Tomato', 0.50);

-- --------------------------------------------------------

--
-- Table structure for table `salads`
--

CREATE TABLE `salads` (
  `id` int NOT NULL,
  `menu_item` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salads`
--

INSERT INTO `salads` (`id`, `menu_item`, `price`, `image_link`) VALUES
(1, 'Garden', 4.50, 'garden-salad.jpg'),
(2, 'Grilled Chicken', 7.50, 'grilled-chicken-salad.jpg'),
(3, 'Tuna Salad', 7.50, 'tuna-salad.jpg'),
(4, 'Chef Salad', 7.50, 'chef-salad.jpg'),
(5, 'Chicken Salad', 7.50, 'chicken-salad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sandwiches`
--

CREATE TABLE `sandwiches` (
  `id` int NOT NULL,
  `menu_item` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sandwiches`
--

INSERT INTO `sandwiches` (`id`, `menu_item`, `price`, `image_link`) VALUES
(1, 'Egg & Cheese', 4.50, 'egg-and-cheese.jpg'),
(2, 'Grilled Cheese', 3.50, 'grilled-cheese.jpg'),
(3, 'B.L.T', 6.00, 'bacon-lettuce-tomato.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `soda_type`
--

CREATE TABLE `soda_type` (
  `item_id` int NOT NULL,
  `item_name` text NOT NULL,
  `item_price` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `soda_type`
--

INSERT INTO `soda_type` (`item_id`, `item_name`, `item_price`) VALUES
(1, 'Coke', NULL),
(2, 'Sprite', NULL),
(3, 'Fanta ', NULL),
(4, 'Ginger Ale', NULL),
(5, 'Brisk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` text COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` text COLLATE utf8mb4_general_ci NOT NULL,
  `username` text COLLATE utf8mb4_general_ci NOT NULL,
  `password` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Sreeja', 'Satish', 'sreeja', 'abc1234', 'sreeja@drexel.edu', '2025-01-19 01:49:20', '2025-01-19 01:49:20'),
(2, 'Yihuan', 'Yang', 'yihuan', 'abc1234', 'yihuan@drexel.edu', '2025-01-19 01:51:32', '2025-01-19 01:51:32'),
(3, 'Yen', 'Luong', 'yen', 'abc1234', '', '2025-01-19 01:52:06', '2025-01-19 01:52:06'),
(4, 'Fei', 'Young', 'fei', 'abc1234', 'fei@drexel.edu', '2025-01-19 01:52:23', '2025-01-19 01:52:23'),
(5, 'Maple', 'Tieu', 'maple', 'abc1234', 'maple@drexel.edu', '2025-01-19 01:52:41', '2025-01-19 01:52:41'),
(6, '', '', 'beepbop', '12345678', '', '2025-02-26 15:29:26', '2025-02-26 15:29:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bread`
--
ALTER TABLE `bread`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `cheesesteaks`
--
ALTER TABLE `cheesesteaks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cheesesteak_bread`
--
ALTER TABLE `cheesesteak_bread`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `condiments`
--
ALTER TABLE `condiments`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `dressing`
--
ALTER TABLE `dressing`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `drinks`
--
ALTER TABLE `drinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drink_option`
--
ALTER TABLE `drink_option`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `drink_size`
--
ALTER TABLE `drink_size`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pastries`
--
ALTER TABLE `pastries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preparation_option`
--
ALTER TABLE `preparation_option`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `protein`
--
ALTER TABLE `protein`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `salads`
--
ALTER TABLE `salads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sandwiches`
--
ALTER TABLE `sandwiches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soda_type`
--
ALTER TABLE `soda_type`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bread`
--
ALTER TABLE `bread`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cheesesteaks`
--
ALTER TABLE `cheesesteaks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cheesesteak_bread`
--
ALTER TABLE `cheesesteak_bread`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `condiments`
--
ALTER TABLE `condiments`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dressing`
--
ALTER TABLE `dressing`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `drinks`
--
ALTER TABLE `drinks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drink_option`
--
ALTER TABLE `drink_option`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drink_size`
--
ALTER TABLE `drink_size`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `menu_item`
--
ALTER TABLE `menu_item`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pastries`
--
ALTER TABLE `pastries`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `preparation_option`
--
ALTER TABLE `preparation_option`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `protein`
--
ALTER TABLE `protein`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salads`
--
ALTER TABLE `salads`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sandwiches`
--
ALTER TABLE `sandwiches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soda_type`
--
ALTER TABLE `soda_type`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
