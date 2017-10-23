-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2017 at 04:41 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wd2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(30) NOT NULL DEFAULT 'buyer'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `first_name`, `last_name`, `company_name`, `username`, `email`, `password`, `user_type`) VALUES
(1, 'John', 'Doe', '', 'johndoe', 'john@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'buyer'),
(2, 'Jane', 'Doe', '', 'janedoe', 'jane@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'buyer'),
(3, '', '', 'Activ Creation', 'activcreation', 'activ@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'vendor'),
(4, 'Syahnur', 'Nizam', '', 'syahnur', 'syahnur@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'buyer'),
(5, '', '', 'NewGatePlus', 'newgateplus', 'newgateplus@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'vendor'),
(10, 'Syahnur', 'Nizam', '', 'syahnur197', 'syahnur197@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
