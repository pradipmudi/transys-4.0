-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2016 at 05:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Name` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(30) NOT NULL,
  `type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Name`, `username`, `password`, `type`) VALUES
('Adhir Chinnaswamy Mondal', 'adhir', 'amazon', ''),
('Pradip Kumar Mudi', 'pradip', '1234', 'super');

-- --------------------------------------------------------

--
-- Table structure for table `cat_car`
--

CREATE TABLE `cat_car` (
  `id` bigint(20) NOT NULL,
  `subCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_car`
--

INSERT INTO `cat_car` (`id`, `subCategory`) VALUES
(1, 'sports');

-- --------------------------------------------------------

--
-- Table structure for table `cat_computer`
--

CREATE TABLE `cat_computer` (
  `id` bigint(20) NOT NULL,
  `subCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_computer`
--

INSERT INTO `cat_computer` (`id`, `subCategory`) VALUES
(1, 'monitor'),
(2, 'laptop'),
(3, 'Desktop'),
(4, 'keyboard'),
(5, 'mouse');

-- --------------------------------------------------------

--
-- Table structure for table `cat_electronics`
--

CREATE TABLE `cat_electronics` (
  `id` bigint(20) NOT NULL,
  `subCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_electronics`
--

INSERT INTO `cat_electronics` (`id`, `subCategory`) VALUES
(1, 'tv'),
(2, 'fridge'),
(3, 'ac'),
(4, 'air cooler'),
(5, 'heater'),
(6, 'geedger');

-- --------------------------------------------------------

--
-- Table structure for table `cat_mobile`
--

CREATE TABLE `cat_mobile` (
  `id` bigint(20) NOT NULL,
  `subCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_mobile`
--

INSERT INTO `cat_mobile` (`id`, `subCategory`) VALUES
(1, 'Touch'),
(2, 'keypad');

-- --------------------------------------------------------

--
-- Table structure for table `cat_others`
--

CREATE TABLE `cat_others` (
  `id` bigint(20) NOT NULL,
  `subCategory` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat_others`
--

INSERT INTO `cat_others` (`id`, `subCategory`) VALUES
(1, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` bigint(12) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `email` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dealer`
--

CREATE TABLE `dealer` (
  `id` int(11) NOT NULL,
  `bankName` varchar(30) DEFAULT NULL,
  `account` bigint(20) DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` bigint(10) DEFAULT NULL,
  `balance` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fullpaidcustomer`
--

CREATE TABLE `fullpaidcustomer` (
  `invoiceNo` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` bigint(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) NOT NULL,
  `dateTime` date NOT NULL,
  `customerID` varchar(40) NOT NULL,
  `serialNos` varchar(200) NOT NULL,
  `prices` double NOT NULL,
  `invoiceNo` varchar(30) NOT NULL,
  `profit` double NOT NULL,
  `tax` double NOT NULL,
  `creditCustomerId` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` bigint(10) NOT NULL,
  `entryDate` datetime NOT NULL,
  `dealerName` varchar(30) NOT NULL,
  `billingAmount` double NOT NULL,
  `cashReceipt` varchar(50) DEFAULT NULL,
  `username` varchar(20) NOT NULL,
  `dealerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profitmonth`
--

CREATE TABLE `profitmonth` (
  `period` date NOT NULL,
  `profit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profitmultiyear`
--

CREATE TABLE `profitmultiyear` (
  `period` int(4) NOT NULL,
  `profit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profitsingleyear`
--

CREATE TABLE `profitsingleyear` (
  `period` varchar(8) NOT NULL,
  `profit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dealer` varchar(30) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `purchaseDate` date NOT NULL,
  `entryDate` datetime NOT NULL,
  `bill` varchar(40) NOT NULL,
  `username` varchar(15) NOT NULL,
  `categorySubCategory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sellingprice`
--

CREATE TABLE `sellingprice` (
  `productName` varchar(40) NOT NULL,
  `serialNo` varchar(20) NOT NULL,
  `status` varchar(6) NOT NULL,
  `price` double NOT NULL,
  `categorySubCategory` varchar(100) NOT NULL,
  `vat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `serialno`
--

CREATE TABLE `serialno` (
  `productName` varchar(30) NOT NULL,
  `serialNo` varchar(20) NOT NULL,
  `soldStatus` varchar(6) NOT NULL,
  `price` double NOT NULL,
  `dealer` varchar(50) NOT NULL,
  `entryDate` datetime NOT NULL,
  `entryBy` varchar(30) NOT NULL,
  `categorySubCategory` varchar(100) NOT NULL,
  `vat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

CREATE TABLE `sold` (
  `productName` varchar(40) NOT NULL,
  `serialNo` bigint(20) NOT NULL,
  `price` double NOT NULL,
  `username` varchar(30) NOT NULL,
  `entryDate` datetime NOT NULL,
  `categorySubCategory` varchar(100) NOT NULL,
  `vat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `name` varchar(30) NOT NULL,
  `quantity` int(10) NOT NULL,
  `categorySubCategory` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `cat_car`
--
ALTER TABLE `cat_car`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_computer`
--
ALTER TABLE `cat_computer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_electronics`
--
ALTER TABLE `cat_electronics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_mobile`
--
ALTER TABLE `cat_mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cat_others`
--
ALTER TABLE `cat_others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `dealer`
--
ALTER TABLE `dealer`
  ADD PRIMARY KEY (`name`),
  ADD UNIQUE KEY `account` (`account`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `fullpaidcustomer`
--
ALTER TABLE `fullpaidcustomer`
  ADD PRIMARY KEY (`invoiceNo`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`serialNos`),
  ADD UNIQUE KEY `invoiceNo` (`invoiceNo`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`entryDate`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `profitmonth`
--
ALTER TABLE `profitmonth`
  ADD PRIMARY KEY (`period`);

--
-- Indexes for table `profitmultiyear`
--
ALTER TABLE `profitmultiyear`
  ADD PRIMARY KEY (`period`);

--
-- Indexes for table `profitsingleyear`
--
ALTER TABLE `profitsingleyear`
  ADD PRIMARY KEY (`period`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`entryDate`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `sellingprice`
--
ALTER TABLE `sellingprice`
  ADD PRIMARY KEY (`serialNo`);

--
-- Indexes for table `serialno`
--
ALTER TABLE `serialno`
  ADD PRIMARY KEY (`serialNo`);

--
-- Indexes for table `sold`
--
ALTER TABLE `sold`
  ADD PRIMARY KEY (`serialNo`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_car`
--
ALTER TABLE `cat_car`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `cat_computer`
--
ALTER TABLE `cat_computer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `cat_electronics`
--
ALTER TABLE `cat_electronics`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cat_mobile`
--
ALTER TABLE `cat_mobile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cat_others`
--
ALTER TABLE `cat_others`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dealer`
--
ALTER TABLE `dealer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
