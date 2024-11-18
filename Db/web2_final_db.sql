-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 05:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web2_final_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(64, 'Cars'),
(67, 'Colthes'),
(66, 'IT'),
(65, 'Resturants');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `img` varchar(100) DEFAULT NULL,
  `changes` enum('i','d') DEFAULT 'd'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `phone`, `address`, `category`, `img`, `changes`) VALUES
(37, 'Al-Beak', '+91111111', 'UAE,Dubai', 65, 'IMG-646640ba5c5b25.19112816.jpeg', 'i'),
(38, 'Cocacola', '+92222222', 'USA,San Andreas', 65, 'IMG-64659732b59f51.79282555.jpeg', 'i'),
(39, 'Pepsi', '+93333333', 'USA,San Andreas', 65, 'IMG-6465974ca4c7b3.20513101.jpeg', 'i'),
(40, 'Pizzahut', '+94446665', 'UK,London', 65, 'IMG-64659773ad6e12.96258402.jpeg', 'd'),
(41, 'Macdonalds', '+98731112', 'USA,Los Angelos', 65, 'IMG-646597e7b3c974.28229784.jpeg', 'i'),
(42, 'Starbucks', '+98733105', 'Australia', 65, 'IMG-64659818e94358.82715326.jpeg', 'i'),
(43, 'KFC', '+97629813', 'Egybt,Alqahera', 65, 'IMG-6465983c282ec8.03341913.jpeg', 'i'),
(44, 'Hp', '+00982130', 'Uk,England', 66, 'IMG-646598a6877148.52668620.jpeg', 'i'),
(45, 'Intel', '+12980980', 'Uk,London', 66, 'IMG-646598bed69e27.71452171.jpeg', 'i'),
(46, 'Microsoft', '+89113335', 'Germany,Menchine', 66, 'IMG-646598f32fe7a9.21564828.jpeg', 'i'),
(47, 'Apple', '+10999221', 'USA,San Andreas', 66, 'IMG-6465990cdcbd90.41843229.jpeg', 'i'),
(48, 'Adidas', '+12345679', 'Palestine,Gaza', 67, 'IMG-64659967c72183.19912084.jpeg', 'i'),
(49, 'Nike', '+23112229', 'Palestine,Jerusalem', 67, 'IMG-64659983d700c8.95299107.jpeg', 'd'),
(50, 'BMW', '+89999612', 'Germany', 64, 'IMG-64659a5761f223.65311682.jpeg', 'i'),
(51, 'Marcides', '+97203339', 'Germany,S', 64, 'IMG-64659dbe17c589.00904862.jpeg', 'i'),
(52, 'Audi', '+91887773', 'Germaany,X', 64, 'IMG-64659de4e456e3.45219574.jpeg', 'i'),
(53, 'Volvo', '+10009998', 'France,Paris', 64, 'IMG-64659dfdd093c6.66961918.jpeg', 'i');

-- --------------------------------------------------------

--
-- Table structure for table `stores_ratings`
--

CREATE TABLE `stores_ratings` (
  `ip` varchar(100) NOT NULL,
  `sid` int(11) NOT NULL,
  `rating` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stores_ratings`
--

INSERT INTO `stores_ratings` (`ip`, `sid`, `rating`) VALUES
('1', 43, 1),
('::1', 37, 3),
('::1', 38, 3),
('::1', 39, 4),
('::1', 40, 2),
('::1', 41, 4),
('::1', 42, 3),
('::1', 43, 4),
('::1', 44, 4),
('::1', 45, 3),
('::1', 46, 4),
('::1', 47, 5),
('::1', 48, 4),
('::1', 49, 2),
('::1', 50, 5),
('::1', 51, 3),
('::1', 52, 4),
('::1', 53, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(150) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`) VALUES
('admin@gmail.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `user_ids`
--

CREATE TABLE `user_ids` (
  `ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_ids`
--

INSERT INTO `user_ids` (`ip`) VALUES
('1'),
('2'),
('3'),
('4'),
('5'),
('6'),
('::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cat_pk` (`name`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_cat_key` (`category`);

--
-- Indexes for table `stores_ratings`
--
ALTER TABLE `stores_ratings`
  ADD PRIMARY KEY (`ip`,`sid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `user_ids`
--
ALTER TABLE `user_ids`
  ADD PRIMARY KEY (`ip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `constraint_cat_key` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cat_store` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`);

--
-- Constraints for table `stores_ratings`
--
ALTER TABLE `stores_ratings`
  ADD CONSTRAINT `stores_ratings_ibfk_1` FOREIGN KEY (`ip`) REFERENCES `user_ids` (`ip`),
  ADD CONSTRAINT `stores_ratings_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `stores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
