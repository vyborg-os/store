-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 05, 2023 at 04:29 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `access` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `pass`, `access`, `date`) VALUES
(1, 'vhk', 'c15498ee22590aef7312236fa6c32fa8', '', 1, '2021-08-07 23:17:51'),
(9, 'vyborg', '6de4659459c90eb26d7fc4e7f307055f', 'vhk', 0, '2021-08-08 07:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `escrow`
--

CREATE TABLE `escrow` (
  `id` int(11) NOT NULL,
  `productid` varchar(100) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `productdescription` varchar(300) NOT NULL,
  `productprice` int(11) NOT NULL,
  `productsize` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `token` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `username`, `token`, `date`) VALUES
(1, 'vhk', '7b03683b5400398d46567f23e54c0f5521fbc787df5f0557a27bc9161fbce860a172f39fec3de3928aca2ae5ddddcf5884b2fc24a737eb32434cb7ba87223c46', '2023-07-05 13:42:54'),
(2, 'vyborg', 'a60db82325c1f661b6aaf1b3229dd92ace5f4398d656570032d1b7cdf369fa63f55a14016d5726abe45e7e0d68084f1dcc1ae18780e5abf2572ccda6df7caceb', '2023-07-05 13:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `pointsale`
--

CREATE TABLE `pointsale` (
  `id` int(11) NOT NULL,
  `tid` varchar(100) NOT NULL,
  `productid` varchar(100) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `productdescription` varchar(300) NOT NULL,
  `productprice` int(11) NOT NULL,
  `productsize` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pmethod` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `validatedate` varchar(150) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pointsale`
--

INSERT INTO `pointsale` (`id`, `tid`, `productid`, `productname`, `productdescription`, `productprice`, `productsize`, `qty`, `amount`, `username`, `pmethod`, `status`, `dateadded`, `validatedate`, `date`) VALUES
(35, 'trstn0808210135', 'prodt129430', 'shtie kd', 'jbjbjb', 8700, 'small', 6, '52200', 'vhk', '', 'sold', 'August 08, 2021 01:35:18pm', 'August082021', '2021-08-08 11:35:18'),
(36, 'trstn0808210135', 'prodt327495', 'special tick', 'the new latest brand of fowl feed', 12000, 'other', 3, '36000', 'vhk', '', 'sold', 'August 08, 2021 01:35:18pm', 'August082021', '2021-08-08 11:35:19'),
(37, 'trstn0808210135', 'prodt327495', 'special tick', 'the new latest brand of fowl feed', 12000, 'other', 2, '24000', 'vhk', '', 'sold', 'August 08, 2021 01:35:19pm', 'August082021', '2021-08-08 11:35:19'),
(38, 'trstn0507230335', 'prodt807641', 'chicken feed', 'jkj jkkjn j', 7500, 'other', 2, '15000', 'vyborg', 'Transfer', 'sold', 'July 05, 2023 03:35:13pm', 'July052023', '2023-07-05 13:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productid` varchar(50) NOT NULL,
  `productname` varchar(100) NOT NULL,
  `productdescription` varchar(300) NOT NULL,
  `productprice` int(200) NOT NULL,
  `productquantity` int(200) NOT NULL,
  `productsize` varchar(200) NOT NULL,
  `dateadded` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productid`, `productname`, `productdescription`, `productprice`, `productquantity`, `productsize`, `dateadded`, `date`, `username`) VALUES
(18, 'prodt807641', 'chicken feed', 'jkj jkkjn j', 7500, 13, 'other', 'August 07, 2021 09:48:07pm', '2023-07-05 13:35:13', 'vhk'),
(19, 'prodt129430', 'shtie kd', 'jbjbjb', 8700, 18, 'small', 'August 07, 2021 09:48:35pm', '2021-08-08 11:35:18', 'vhk'),
(20, 'prodt027486', 'jkbk hbhb njbh', 'hjbh h', 750, 11, 'big', 'August 07, 2021 09:49:00pm', '2021-08-08 11:23:30', 'vhk'),
(21, 'prodt327495', 'special tick', 'the new latest brand of fowl feed', 12000, 1, 'other', 'August 08, 2021 12:25:29pm', '2021-08-08 11:35:19', 'vhk'),
(22, 'prodt814750', 'grower milk', 'kdkd kdlskd kslkdn kldd', 18900, 4, 'small', 'August 08, 2021 12:27:15pm', '2021-08-08 11:25:56', 'vhk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `escrow`
--
ALTER TABLE `escrow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pointsale`
--
ALTER TABLE `pointsale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `escrow`
--
ALTER TABLE `escrow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pointsale`
--
ALTER TABLE `pointsale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
