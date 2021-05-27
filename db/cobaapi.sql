-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 06:43 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobaapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `item_id` int(11) NOT NULL,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` float NOT NULL,
  `item_type` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`item_id`, `item_brand`, `item_name`, `item_price`, `item_type`) VALUES
(1, 'Tag Heuer', 'Formula 1', 13000000, 'Men'),
(2, 'Tudor', 'Geneve', 15000000, 'Men'),
(3, 'Cartier', 'Classic 90', 16000000, 'Men'),
(4, 'Hamilton', 'Retro', 17000000, 'Men'),
(5, 'Patek Philippe', 'Ocean', 18000000, 'Men'),
(6, 'Omega', 'Speedmaster', 19000000, 'Men'),
(7, 'Rolex', 'Sea-Dweller', 15000000, 'Men'),
(8, 'Tag Heuer', 'Carrera', 12000000, 'Women'),
(9, 'Cartier', 'Vintage', 12000000, 'Women'),
(10, 'Cartier', 'Constellation', 19000000, 'Women'),
(11, 'Jaeger-LeCoultre', 'Classic P77', 18000000, 'Women'),
(12, 'Tudor', 'Prince Oysterdate', 16000000, 'Women'),
(13, 'Rolex', 'Oyster Perpetual', 11000000, 'Women'),
(14, 'Cartier', 'Classic 80', 12000000, 'Women'),
(23, 'cobapost11', 'cobapos22', 11122, 'Women'),
(24, 'cobapost112', 'cobapos221', 100000, 'Men');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `level` int(1) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'f865b53623b121fd34ee5426c792e5c33af8c227', 1),
(2, 'nanda', 'a91d0499a74296dcb8f5eef85e8e68a738ae5c88', 2),
(3, 'bobi', '84c02004bb0fc1e518269c57b94bacc47d1f13e4', 3),
(5, 'yuka', 'aa66a514d2c3814f3a77f71217ad69968d164df3', 3),
(6, 'tono', '09925cfd46f2827d51571d5be146bab5619c58b7', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
