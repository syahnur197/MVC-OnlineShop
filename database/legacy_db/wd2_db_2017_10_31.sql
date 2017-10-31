-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 06:56 PM
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
-- Table structure for table `address_table`
--

CREATE TABLE `address_table` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `town` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address_table`
--

INSERT INTO `address_table` (`address_id`, `user_id`, `country`, `postcode`, `address`, `town`) VALUES
(8, 4, 'Brunei Darussalam', 'BE3119', 'No 48', 'BSB');

-- --------------------------------------------------------

--
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_buy` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_table`
--

INSERT INTO `cart_table` (`cart_id`, `user_id`, `date_buy`, `flag`) VALUES
(9, 4, '2017-10-27 22:52:48', 1),
(10, 2, '2017-10-28 00:08:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_table`
--

CREATE TABLE `category_table` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `parent_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_table`
--

INSERT INTO `category_table` (`category_id`, `category_name`, `parent_category_id`) VALUES
(1, 'Apparels', 0),
(2, 'Electronics', 0),
(3, 'Stationaries', 0),
(4, 'Consumables', 0),
(5, 'T-Shirt', 1),
(6, 'Jeans', 1),
(7, 'Pen', 3),
(8, 'Book', 3),
(9, 'Calculator', 3),
(10, 'Multi-Vitamin', 4),
(11, 'Ink-Printer', 4),
(12, 'Protein', 4),
(15, 'Kerusi', 0),
(16, 'Sofa', 15),
(17, 'Accessories', 0),
(18, 'Bracelet', 17);

-- --------------------------------------------------------

--
-- Table structure for table `history_table`
--

CREATE TABLE `history_table` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `time_viewed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_table`
--

INSERT INTO `history_table` (`history_id`, `user_id`, `product_id`, `time_viewed`) VALUES
(1, 1, 1, '2017-10-09 05:11:16'),
(2, 1, 4, '2017-10-09 05:11:19'),
(3, 2, 2, '2017-10-09 05:11:20'),
(4, 2, 3, '2017-10-09 05:11:22'),
(5, 4, 1, '2017-10-09 05:11:24'),
(6, 4, 4, '2017-10-09 05:11:26'),
(7, 4, 3, '2017-10-09 05:11:28'),
(8, 4, 2, '2017-10-09 05:11:30'),
(9, 1, 3, '2017-10-09 05:12:01');

-- --------------------------------------------------------

--
-- Table structure for table `popular_table`
--

CREATE TABLE `popular_table` (
  `popular_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `hits` int(11) NOT NULL,
  `date_hits` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `popular_table`
--

INSERT INTO `popular_table` (`popular_id`, `product_id`, `hits`, `date_hits`) VALUES
(1, 4, 111, '2017-10-06'),
(2, 4, 231, '2017-10-07'),
(3, 4, 99, '2017-10-08'),
(4, 2, 156, '2017-10-08'),
(5, 2, 78, '2017-10-07'),
(6, 1, 33, '2017-10-07'),
(7, 1, 222, '2017-10-08'),
(8, 3, 111, '2017-10-08'),
(9, 3, 146, '2017-10-07'),
(10, 4, 88, '2017-10-06');

-- --------------------------------------------------------

--
-- Table structure for table `product_cart_table`
--

CREATE TABLE `product_cart_table` (
  `product_cart_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_cart_table`
--

INSERT INTO `product_cart_table` (`product_cart_id`, `cart_id`, `product_id`, `quantity`, `add_time`) VALUES
(6, 9, 2, 10, '2017-10-26 01:53:01'),
(8, 9, 2, 10, '2017-10-26 01:58:27'),
(12, 9, 16, 10, '2017-10-25 21:54:50'),
(14, 9, 4, 500, '2017-10-27 13:34:46'),
(17, 9, 16, 1, '2017-10-27 13:35:34'),
(18, 9, 4, 10, '2017-10-27 13:35:38'),
(19, 9, 20, 30, '2017-10-27 13:36:12'),
(20, 9, 14, 1, '2017-10-27 13:37:29'),
(21, 9, 14, 1, '2017-10-27 13:38:16'),
(34, 10, 14, 1, '2017-10-27 15:35:13'),
(35, 10, 14, 1, '2017-10-27 15:45:10'),
(36, 10, 14, 1, '2017-10-27 15:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_images_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_images_id`, `product_id`, `image_link`) VALUES
(2, 14, 'uploads/Oracle_Campus_Analyic_Students_Financing_(1).png'),
(4, 16, 'uploads/farmto_table2.png'),
(7, 4, 'uploads/Harry_Potter_and_the_Philosophers_Stone_Book_Cover2.jpg'),
(8, 19, 'uploads/qnwvxo1416925098679.jpg'),
(13, 20, 'uploads/21272585_190708898136882_5711301978557311206_n.jpg'),
(14, 1, 'uploads/collared_shirt.jpeg'),
(15, 2, 'uploads/prisoner_suit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `short_desc` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`product_id`, `category_id`, `seller_id`, `product_name`, `price`, `short_desc`, `description`, `add_time`, `active_flag`) VALUES
(1, 5, 3, 'Collared shirt', '25.00', 'White Shirt From Korea', '<ul>\r\n	<li>Cotton Shirt From Korea</li>\r\n	<li>Make of Silk</li>\r\n	<li>100% LEGIT</li>\r\n	<li>MAKE FROM COW SILK</li>\r\n	<li>Berdasarkan Sunnah</li>\r\n</ul>\r\n', '2017-10-26 03:00:36', 0),
(2, 5, 5, 'Prisoner suit', '17.50', 'Striped shirt made of leather.', '<p>Striped shirt made of leather.</p>\r\n\r\n<p>Striped shirt made of leather.</p>\r\n\r\n<p>Striped shirt made of leather.</p>\r\n\r\n<p>Striped shirt made of leather.</p>\r\n\r\n<p>Striped shirt made of leather.</p>\r\n', '2017-10-24 00:53:20', 0),
(3, 8, 5, 'Harry Potter and the Sorcerer\'s stone', '20.00', 'The first volume of Harry Potter.', '<p>The first volume of Harry Potter.</p>\r\n\r\n<p>The first volume of Harry Potter.</p>\r\n\r\n<p>The first volume of Harry Potter.</p>\r\n\r\n<p>The first volume of Harry Potter.</p>\r\n', '2017-10-24 00:32:46', 0),
(4, 8, 5, 'Harry Potter and the Chamber of Secrets', '20.00', 'The third volume of Harry Potter.', '<p>You did not select a file to upload.</p>\r\n\r\n<p>You did not select a file to upload.</p>\r\n\r\n<p>You did not select a file to upload.</p>\r\n\r\n<p>You did not select a file to upload.</p>\r\n', '2017-10-24 00:29:02', 0),
(5, 6, 4, 'Harry Potter\'s Jeans', '15.00', 'Jean made for Harry Potter', '', '2017-10-23 15:19:21', 0),
(6, 5, 4, 'Harry Potter t-shirt', '20.00', 't-shirt that was worn by Harry Potter', '', '2017-10-23 15:19:26', 0),
(7, 16, 10, 'Sofa Ajaib', '50.00', 'Ini adalah sofa ajaib yang disayangi doraemon', '', '2017-10-23 15:19:33', 0),
(8, 8, 10, 'Calendar Serbaguna', '7.00', 'Calendar Memutar Waktu', '<ul>\r\n	<li>7 Inchi Lebar</li>\r\n	<li>7 Inchi Tinggi</li>\r\n	<li>Sesuai untuk semua umur</li>\r\n	<li>Sesuai untuk penjaja yang suka berjaja</li>\r\n</ul>\r\n', '2017-10-23 15:20:38', 0),
(14, 5, 10, 'Oracle People Soft Solution', '50.00', 'Oracle People Soft Solution is so good', '<ul>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n	<li>Oracle People Soft Solution is so good</li>\r\n</ul>\r\n', '2017-10-25 21:50:34', 0),
(16, 12, 10, 'Karipap Hajah Kamariah Binti Abdullah', '5.00', 'Karipap Diperbuat Daripada Ubi', '<p>Karipap Diperbuat Daripada Ubi dan Daging Kari Yang Sedap Menarik</p>\r\n', '2017-10-23 17:29:30', 0),
(19, 8, 10, 'Harry Potter First Book', '50.00', 'Harry Potter first book', '<p>Harry Potter first book</p>\r\n\r\n<p>Harry Potter first book</p>\r\n\r\n<p>Harry Potter first book</p>\r\n\r\n<p>Harry Potter first book</p>\r\n', '2017-10-24 00:37:40', 0),
(20, 18, 10, 'Owl Bracelet From Memento Collection Collector\'s Edition', '15.00', 'Natural Lava Stone with Golden Bracelet', '<p>Natural Lava Stone with Golden Bracelet</p>\r\n\r\n<ul>\r\n	<li>Made From Natural Stone</li>\r\n	<li>Made From Lava</li>\r\n	<li>Lapis Lazuli</li>\r\n	<li>Healing Benefit</li>\r\n</ul>\r\n', '2017-10-24 01:34:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating_table`
--

CREATE TABLE `rating_table` (
  `rating_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rater_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating_table`
--

INSERT INTO `rating_table` (`rating_id`, `product_id`, `rater_id`, `rate`) VALUES
(1, 4, 2, 4),
(2, 4, 1, 3),
(3, 4, 4, 5),
(4, 2, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `review` varchar(100) NOT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `product_id`, `user_id`, `review`, `post_time`) VALUES
(1, 4, 4, 'The plot is quite bad. Slow start. I like the first book.', '2017-10-09 04:57:42'),
(2, 3, 4, 'Awesome book. Highly recommended.', '2017-10-09 05:05:23'),
(3, 2, 2, 'The suit fits me well. But the material is causing rashes. Hmm', '2017-10-09 05:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `test_table`
--

CREATE TABLE `test_table` (
  `ID` int(11) NOT NULL,
  `field_1` varchar(50) NOT NULL,
  `field_2` varchar(50) NOT NULL,
  `field_3` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_table`
--

INSERT INTO `test_table` (`ID`, `field_1`, `field_2`, `field_3`) VALUES
(1, 'the id is 1, the field is 1', 'the id is 1, the field is 2', 'the id is 1, the field is 3'),
(2, 'the id is 2, the field is 1', 'the id is 2, the field is 2', 'the id is 2, the field is 3'),
(3, 'the id is 3, the field is 1', 'the id is 3, the field is 2', 'the id is 3, the field is 3'),
(4, 'the id is 4, the field is 1', 'the id is 4, the field is 2', 'the id is 4, the field is 3');

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
  `user_type` varchar(30) NOT NULL DEFAULT 'buyer',
  `ban_flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `first_name`, `last_name`, `company_name`, `username`, `email`, `password`, `user_type`, `ban_flag`) VALUES
(1, 'John', 'Doe', '', 'johndoe', 'john@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'user', 0),
(2, 'Jane', 'Doe', '', 'janedoe', 'jane@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'user', 0),
(3, '', '', 'Activ Creation', 'activcreation', 'activ@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'user', 0),
(4, 'Syahnur', 'Nizam', '', 'syahnur', 'syahnur@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'user', 0),
(5, '', '', 'NewGatePlus', 'newgateplus', 'newgateplus@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'admin', 0),
(10, 'Syahnur', 'Nizam', '', 'syahnur197', 'syahnur197@gmail.com', '$2y$10$AwmO51CDFLkGjZhpYYypN.p1w27yLuW2Sp0rXprORCjhlCs29MJo2', 'admin', 0),
(11, 'Minato', 'Namikaze', '', 'yellowFlash', 'yellowFlash@konoha.com', '$2y$10$u/D189a535CDuGJFaBy4R.G7hxD2GBZ2Ol1.TfH8fICzJp8BWWnfe', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist_table`
--

CREATE TABLE `wishlist_table` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist_table`
--

INSERT INTO `wishlist_table` (`wishlist_id`, `user_id`, `product_id`, `add_time`) VALUES
(1, 2, 1, '2017-10-07 17:10:00'),
(2, 1, 2, '2017-10-06 23:02:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_table`
--
ALTER TABLE `address_table`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `category_table`
--
ALTER TABLE `category_table`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `history_table`
--
ALTER TABLE `history_table`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `popular_table`
--
ALTER TABLE `popular_table`
  ADD PRIMARY KEY (`popular_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_cart_table`
--
ALTER TABLE `product_cart_table`
  ADD PRIMARY KEY (`product_cart_id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_images_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `rating_table`
--
ALTER TABLE `rating_table`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `rater_id` (`rater_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `test_table`
--
ALTER TABLE `test_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist_table`
--
ALTER TABLE `wishlist_table`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_table`
--
ALTER TABLE `address_table`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `category_table`
--
ALTER TABLE `category_table`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `history_table`
--
ALTER TABLE `history_table`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `popular_table`
--
ALTER TABLE `popular_table`
  MODIFY `popular_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_cart_table`
--
ALTER TABLE `product_cart_table`
  MODIFY `product_cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `product_images_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `rating_table`
--
ALTER TABLE `rating_table`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `test_table`
--
ALTER TABLE `test_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `wishlist_table`
--
ALTER TABLE `wishlist_table`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_table`
--
ALTER TABLE `address_table`
  ADD CONSTRAINT `user_address` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD CONSTRAINT `user_cart` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `history_table`
--
ALTER TABLE `history_table`
  ADD CONSTRAINT `product_history` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_history` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `popular_table`
--
ALTER TABLE `popular_table`
  ADD CONSTRAINT `product_popular` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_cart_table`
--
ALTER TABLE `product_cart_table`
  ADD CONSTRAINT `product_cart_table_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart_table` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_cart_table_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_table`
--
ALTER TABLE `product_table`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category_table` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_product` FOREIGN KEY (`seller_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_table`
--
ALTER TABLE `rating_table`
  ADD CONSTRAINT `product_rating` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rating` FOREIGN KEY (`rater_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review_table`
--
ALTER TABLE `review_table`
  ADD CONSTRAINT `product_review` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_review` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wishlist_table`
--
ALTER TABLE `wishlist_table`
  ADD CONSTRAINT `product_wishlist` FOREIGN KEY (`product_id`) REFERENCES `product_table` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_wishlist` FOREIGN KEY (`user_id`) REFERENCES `user_table` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
