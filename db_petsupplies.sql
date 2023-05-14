-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 04:29 AM
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
-- Database: `db_petsupplies`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `id` int(11) NOT NULL,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `member_fee` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `code`, `name`, `discount`, `member_fee`) VALUES
(1, 'BCK', 'Black Card', 0.2, 10000000),
(2, 'PTC', 'Prestige Card', 0.1, 1500000),
(3, 'SLV', 'Silva Card', 0.08, 120000),
(4, 'NON', 'Non Member', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `gender` enum('L','P') DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `gender`, `phone`, `email`, `address`, `card_id`) VALUES
(1, 'Fakhirul', 'L', '085100001234', 'fakhirul@gmail.com', 'Depok', 1),
(2, 'Akmal', 'L', '081900120034', 'akmal@gmail.com', 'Depok', 2),
(3, 'Muhammad Sumbul', 'L', '082190234455', 'soemboel@gmail.com', 'Bogor', 4),
(4, 'Amalia Hasanah', 'P', '081318387621', 'lia.hasanah@gmail.com', 'Bogor', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_number` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_number`, `date`, `qty`, `total_price`, `customer_id`, `product_id`) VALUES
(1, 'PO001', '2023-02-02 00:00:00', 2, 432000, 1, 4),
(2, 'PO002', '2023-02-22 00:00:00', 3, 414000, 4, 3),
(3, 'PO003', '2023-02-23 00:00:00', 5, 950000, 3, 2),
(5, 'PO004', '2023-04-20 09:13:20', 1, 190000, 3, 2),
(6, 'PO005', '2023-04-20 09:14:43', 1, 190000, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `sku` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `purchase_price` int(11) DEFAULT NULL,
  `sell_price` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `min_stock` int(11) DEFAULT 0,
  `product_type_id` int(11) NOT NULL,
  `restock_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `sku`, `name`, `purchase_price`, `sell_price`, `stock`, `min_stock`, `product_type_id`, `restock_id`) VALUES
(1, 'SK001', 'Royal Canin Dog Foods', 100000, 140000, 21, 1, 1, 1),
(2, 'SK002', 'Marineland Aquarium', 120000, 190000, 18, 1, 5, 1),
(3, 'SK003', 'Body Fat Cat Fattener', 100000, 145000, 15, 1, 2, 3),
(4, 'SK004', 'Handmade Bird Cage', 230000, 270000, 23, 1, 4, 2),
(5, 'SK005', 'Whiskas Dry Ocean Fish', 150000, 215000, 6, 1, 1, 2),
(6, 'SK006', 'Play For Training Cat', 150000, 215000, 6, 1, 10, 2),
(7, 'SK007', 'Premium Cat Food', 80000, 120000, 8, 2, 1, 1),
(8, 'SK008', 'Healthy Dog Treats', 50000, 75000, 20, 5, 1, 2),
(9, 'SK009', 'Vitamin Supplement for Cats', 70000, 100000, 12, 3, 2, 1),
(10, 'SK010', 'Vitamin Supplement for Dogs', 80000, 120000, 15, 3, 2, 2),
(11, 'SK011', 'Leather Dog Collar', 50000, 75000, 5, 1, 3, 1),
(12, 'SK012', 'Retractable Dog Leash', 90000, 135000, 8, 2, 3, 2),
(13, 'SK013', 'Cat Harness and Leash Set', 60000, 90000, 7, 2, 3, 1),
(14, 'SK014', 'Pet Carrier Bag', 120000, 180000, 4, 1, 4, 3),
(15, 'SK015', 'Fish Tank with LED Light', 500000, 750000, 2, 1, 5, 2),
(16, 'SK016', 'Dog Shampoo', 80000, 100000, 10, 2, 6, 1),
(17, 'SK017', 'Cat Comb', 30000, 50000, 15, 5, 6, 2),
(18, 'SK018', 'Pet Grooming Gloves', 60000, 75000, 12, 3, 6, 3),
(19, 'SK019', 'Dog Hair Clipper', 200000, 250000, 8, 2, 6, 1),
(20, 'SK020', 'Pet Nail Clippers', 50000, 75000, 10, 2, 6, 2),
(21, 'SK021', 'Squeaky Ball', 15000, 25000, 30, 10, 7, 1),
(22, 'SK022', 'Cat Feather Wand', 25000, 35000, 20, 5, 7, 2),
(23, 'SK023', 'Interactive Dog Toy', 50000, 75000, 15, 3, 7, 3),
(24, 'SK024', 'Puzzle Toy', 75000, 100000, 10, 2, 7, 1),
(25, 'SK025', 'Rubber Chew Toy', 20000, 30000, 25, 5, 7, 2),
(26, 'SK026', 'Dog Bed', 150000, 200000, 8, 2, 8, 1),
(27, 'SK027', 'Cat Cave Bed', 100000, 150000, 12, 3, 8, 2),
(28, 'SK028', 'Pet Blanket', 40000, 60000, 20, 5, 8, 3),
(29, 'SK029', 'Dog Crate Mat', 80000, 100000, 10, 2, 8, 1),
(30, 'SK030', 'Pet Cooling Mat', 120000, 150000, 6, 1, 8, 2),
(31, 'SK031', 'Dog Raincoat', 75000, 100000, 10, 2, 9, 1),
(32, 'SK032', 'Cat Bow Tie', 20000, 35000, 15, 5, 9, 2),
(33, 'SK033', 'Pet T-shirt', 30000, 50000, 20, 5, 9, 3),
(34, 'SK034', 'Dog Winter Coat', 150000, 200000, 20, 8, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`) VALUES
(1, 'Food'),
(2, 'Vitamin'),
(3, 'Collar and Leash'),
(4, 'Cage'),
(5, 'Aquatic'),
(6, 'Grooming'),
(7, 'Toys'),
(8, 'Bedding'),
(9, 'Clothing'),
(10, 'Training');

-- --------------------------------------------------------

--
-- Table structure for table `restock`
--

CREATE TABLE `restock` (
  `id` int(11) NOT NULL,
  `restock_number` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `restock`
--

INSERT INTO `restock` (`id`, `restock_number`, `date`, `qty`, `price`, `supplier_id`) VALUES
(1, 'RS001', '2022-03-10 00:00:00', 20, 11500000, 3),
(2, 'RS002', '2022-04-05 00:00:00', 15, 20000000, 2),
(3, 'RS003', '2023-01-01 00:00:00', 41, 24000000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `address` longtext DEFAULT NULL,
  `contact_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `address`, `contact_name`) VALUES
(1, 'PT Prima Sentosa Indonesia', '081123456789', 'Surabaya', 'Dewi Kurniawati'),
(2, 'PT QNET Indonesia', '085678901234', 'Bandung', 'Andi Pratama'),
(3, 'PT Melia Sehat Sejahtera', '081234567890', 'Jakarta Timur', 'Dimas Sanjaya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_customer_card1` (`card_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `fk_order_customer` (`customer_id`),
  ADD KEY `fk_order_product1` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `fk_product_product_type1` (`product_type_id`),
  ADD KEY `fk_product_restock1` (`restock_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restock`
--
ALTER TABLE `restock`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `restock_number` (`restock_number`),
  ADD KEY `fk_restock_supplier1` (`supplier_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `restock`
--
ALTER TABLE `restock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_card1` FOREIGN KEY (`card_id`) REFERENCES `card` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_product_type1` FOREIGN KEY (`product_type_id`) REFERENCES `product_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_restock1` FOREIGN KEY (`restock_id`) REFERENCES `restock` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `restock`
--
ALTER TABLE `restock`
  ADD CONSTRAINT `fk_restock_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
