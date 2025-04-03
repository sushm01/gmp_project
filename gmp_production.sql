-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 06:27 AM
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
-- Database: `gmp_production`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_mfd_stock`
--

CREATE TABLE `daily_mfd_stock` (
  `id` int(100) NOT NULL,
  `product_name_id` int(50) NOT NULL,
  `pieces_packet` varchar(50) NOT NULL,
  `qty_in_kg` float(10,2) NOT NULL,
  `qty_in_pieces` float(10,2) NOT NULL,
  `qty_in_packet` float(10,2) NOT NULL,
  `qty_in_dozens` float(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_mfd_stock`
--

INSERT INTO `daily_mfd_stock` (`id`, `product_name_id`, `pieces_packet`, `qty_in_kg`, `qty_in_pieces`, `qty_in_packet`, `qty_in_dozens`, `date`) VALUES
(81, 112, '12', 2.00, 1680.00, 42.00, 3.50, '2025-01-17'),
(82, 112, '12', 10.00, 8400.00, 210.00, 17.50, '2025-01-23'),
(83, 113, '12', 5.00, 4200.00, 105.00, 8.80, '2025-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`) VALUES
(1, 'GMP', 'gmp@gmail.com', 'gmp@123');

-- --------------------------------------------------------

--
-- Table structure for table `master_pieces`
--

CREATE TABLE `master_pieces` (
  `id` int(100) NOT NULL,
  `pieces_pp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_pieces`
--

INSERT INTO `master_pieces` (`id`, `pieces_pp`) VALUES
(12, '40');

-- --------------------------------------------------------

--
-- Table structure for table `master_raw`
--

CREATE TABLE `master_raw` (
  `id` int(100) NOT NULL,
  `raw_materials` varchar(50) NOT NULL,
  `unit_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_raw`
--

INSERT INTO `master_raw` (`id`, `raw_materials`, `unit_id`) VALUES
(17, 'Perfume', '41'),
(18, 'Powder', '40'),
(19, 'Oil', '41'),
(20, 'Stick', '40');

-- --------------------------------------------------------

--
-- Table structure for table `master_unit`
--

CREATE TABLE `master_unit` (
  `id` int(100) NOT NULL,
  `units` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_unit`
--

INSERT INTO `master_unit` (`id`, `units`) VALUES
(40, 'KG'),
(41, 'LTR'),
(42, 'pcs');

-- --------------------------------------------------------

--
-- Table structure for table `mfd_stock`
--

CREATE TABLE `mfd_stock` (
  `id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `hsn_code` varchar(120) NOT NULL,
  `pieces_packet` varchar(110) NOT NULL,
  `qty_in_kg` decimal(10,2) NOT NULL,
  `qty_in_pieces` decimal(10,2) NOT NULL,
  `qty_in_packet` decimal(10,2) NOT NULL,
  `qty_in_dozens` decimal(10,2) NOT NULL,
  `wholesale_price` decimal(10,2) NOT NULL,
  `retail_price` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mfd_stock`
--

INSERT INTO `mfd_stock` (`id`, `product_name`, `hsn_code`, `pieces_packet`, `qty_in_kg`, `qty_in_pieces`, `qty_in_packet`, `qty_in_dozens`, `wholesale_price`, `retail_price`, `sgst`, `cgst`, `date`) VALUES
(112, 'Mogra', '0001', '12', 1.00, 840.00, 21.00, 1.80, 500.00, 700.00, 2.50, 2.50, '2025-01-17'),
(113, 'Rose Agarbatti', '0002', '12', 1.00, 840.00, 21.00, 1.80, 650.00, 630.00, 4.50, 4.50, '2025-01-23'),
(114, 'Hibiscus Agarbatti', '0003', '12', 1.00, 840.00, 21.00, 1.75, 1500.00, 1300.00, 3.00, 3.00, '2025-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `mfd_stock_details`
--

CREATE TABLE `mfd_stock_details` (
  `id` int(100) NOT NULL,
  `mfd_stock_id` int(100) NOT NULL,
  `materials` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `units` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mfd_stock_details`
--

INSERT INTO `mfd_stock_details` (`id`, `mfd_stock_id`, `materials`, `quantity`, `units`) VALUES
(153, 112, '17', '1', 'KG'),
(154, 112, '18', '1', 'KG'),
(155, 112, '19', '1', 'LTR'),
(156, 112, '20', '1', 'KG'),
(157, 113, '17', '2', 'LTR'),
(158, 113, '18', '2', 'KG'),
(159, 113, '19', '2', 'LTR'),
(160, 113, '20', '2', 'KG'),
(161, 114, '17', '0.5', 'LTR'),
(162, 114, '19', '2.5', 'KG');

-- --------------------------------------------------------

--
-- Table structure for table `product_sales`
--

CREATE TABLE `product_sales` (
  `id` int(100) NOT NULL,
  `product_sale_detail_id` int(100) NOT NULL,
  `sl_no` int(100) NOT NULL,
  `product_name_id` int(100) NOT NULL,
  `s_hsn_code` varchar(50) NOT NULL,
  `s_pieces_pkt` decimal(10,2) NOT NULL,
  `s_pkt_avl` decimal(10,2) NOT NULL,
  `s_dzn_avl` decimal(10,2) NOT NULL,
  `s_dozens` decimal(10,2) NOT NULL,
  `s_net_qty` decimal(10,2) NOT NULL,
  `s_price_dzn` decimal(10,2) NOT NULL,
  `s_price_pkt` decimal(10,2) NOT NULL,
  `s_gross_amt` decimal(10,2) NOT NULL,
  `s_sgst` decimal(10,2) NOT NULL,
  `s_cgst` decimal(10,2) NOT NULL,
  `s_gst_amt` decimal(10,2) NOT NULL,
  `s_line_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sales`
--

INSERT INTO `product_sales` (`id`, `product_sale_detail_id`, `sl_no`, `product_name_id`, `s_hsn_code`, `s_pieces_pkt`, `s_pkt_avl`, `s_dzn_avl`, `s_dozens`, `s_net_qty`, `s_price_dzn`, `s_price_pkt`, `s_gross_amt`, `s_sgst`, `s_cgst`, `s_gst_amt`, `s_line_total`) VALUES
(81, 112, 0, 112, '0001', 40.00, 42.00, 3.50, 2.00, 24.00, 700.00, 58.30, 1308.40, 3.50, 3.50, 91.60, 1400.00),
(82, 113, 0, 112, '0001', 40.00, 42.00, 3.50, 1.00, 12.00, 500.00, 41.70, 476.20, 2.50, 2.50, 23.80, 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_sales_details`
--

CREATE TABLE `product_sales_details` (
  `id` int(100) NOT NULL,
  `bill_date` date NOT NULL,
  `s_supplier_id` int(100) NOT NULL,
  `s_payment_mode` varchar(50) NOT NULL,
  `s_total_amt` decimal(10,2) NOT NULL,
  `s_cash_discount` decimal(10,2) NOT NULL,
  `s_payable_amt` decimal(10,2) NOT NULL,
  `s_paid_amt` decimal(10,2) NOT NULL,
  `s_balance_amt` decimal(10,2) NOT NULL,
  `bill_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sales_details`
--

INSERT INTO `product_sales_details` (`id`, `bill_date`, `s_supplier_id`, `s_payment_mode`, `s_total_amt`, `s_cash_discount`, `s_payable_amt`, `s_paid_amt`, `s_balance_amt`, `bill_no`) VALUES
(112, '2025-01-23', 4, 'cash', 1400.00, 35.00, 850.46, 200.00, 650.50, '1'),
(113, '2025-01-23', 3, 'cash', 500.00, 10.00, 428.58, 100.00, 328.60, '2');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_entry`
--

CREATE TABLE `purchase_entry` (
  `id` int(100) NOT NULL,
  `invoice_no` varchar(50) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `date_time` varchar(50) NOT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_entry`
--

INSERT INTO `purchase_entry` (`id`, `invoice_no`, `supplier_name`, `amount`, `payment_mode`, `date_time`, `remarks`) VALUES
(72, '101', 'Shahista', '65.00', 'upi', '2025-01-17T16:49', ''),
(73, '101', 'Shahista', '200.00', 'cash', '2025-01-17T16:49', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` int(100) NOT NULL,
  `bill_date` date NOT NULL,
  `supplier_id` int(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `total_amt` decimal(10,2) NOT NULL,
  `cash_discount` decimal(10,2) NOT NULL,
  `payable_amt` decimal(10,2) NOT NULL,
  `paid_amt` decimal(10,2) NOT NULL,
  `balance_amt` decimal(10,2) NOT NULL,
  `invoice_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `bill_date`, `supplier_id`, `payment_mode`, `total_amt`, `cash_discount`, `payable_amt`, `paid_amt`, `balance_amt`, `invoice_no`) VALUES
(90, '2025-01-17', 6, 'upi', 9135.00, 5.00, 8265.00, 8000.00, 265.00, '101'),
(91, '2025-01-23', 2, 'cash', 2590000.00, 65.00, 875000.00, 800000.00, 75000.00, '102');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(100) NOT NULL,
  `sl_no` int(100) NOT NULL,
  `material_id` int(50) NOT NULL,
  `unit_id` int(50) NOT NULL,
  `purchase_price` varchar(100) NOT NULL,
  `qty` decimal(10,2) NOT NULL,
  `gross_amt` decimal(10,2) NOT NULL,
  `sgst` decimal(10,2) NOT NULL,
  `cgst` decimal(10,2) NOT NULL,
  `gst_amt` decimal(10,2) NOT NULL,
  `line_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`id`, `purchase_order_id`, `sl_no`, `material_id`, `unit_id`, `purchase_price`, `qty`, `gross_amt`, `sgst`, `cgst`, `gst_amt`, `line_total`) VALUES
(89, 90, 0, 17, 41, '200', 10.00, 2000.00, 2.50, 2.50, 100.00, 2100.00),
(90, 90, 0, 18, 40, '450', 10.00, 4500.00, 2.50, 2.50, 225.00, 4725.00),
(91, 90, 0, 19, 41, '200', 5.00, 1000.00, 2.50, 2.50, 50.00, 1050.00),
(92, 90, 0, 20, 40, '150', 8.00, 1200.00, 2.50, 2.50, 60.00, 1260.00),
(93, 91, 0, 17, 41, '1500', 250.00, 375000.00, 2.50, 2.50, 18750.00, 393750.00),
(94, 91, 0, 18, 40, '1500', 250.00, 375000.00, 2.50, 2.50, 18750.00, 393750.00),
(95, 91, 0, 19, 41, '2500', 350.00, 875000.00, 1.50, 1.50, 26250.00, 901250.00),
(96, 91, 0, 20, 40, '2500', 350.00, 875000.00, 1.50, 1.50, 26250.00, 901250.00);

-- --------------------------------------------------------

--
-- Table structure for table `reg_customer`
--

CREATE TABLE `reg_customer` (
  `id` int(100) NOT NULL,
  `cust_name` varchar(100) NOT NULL,
  `cust_mobile_no` varchar(100) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `cust_gstin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_customer`
--

INSERT INTO `reg_customer` (`id`, `cust_name`, `cust_mobile_no`, `cust_address`, `cust_gstin`) VALUES
(14, 'Sushma', '0987654321', 'bijapur', '3453453453453');

-- --------------------------------------------------------

--
-- Table structure for table `reg_labour`
--

CREATE TABLE `reg_labour` (
  `id` int(100) NOT NULL,
  `lab_name` varchar(50) NOT NULL,
  `lab_mobile_no` varchar(50) NOT NULL,
  `lab_address` varchar(50) NOT NULL,
  `lab_salary` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_labour`
--

INSERT INTO `reg_labour` (`id`, `lab_name`, `lab_mobile_no`, `lab_address`, `lab_salary`) VALUES
(5, 'bnhgv', '6548654147', 'bijapur', '75000');

-- --------------------------------------------------------

--
-- Table structure for table `reg_supplier`
--

CREATE TABLE `reg_supplier` (
  `id` int(100) NOT NULL,
  `supp_name` varchar(50) NOT NULL,
  `supp_mobile_no` varchar(50) NOT NULL,
  `supp_address` varchar(50) NOT NULL,
  `supp_gstin` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reg_supplier`
--

INSERT INTO `reg_supplier` (`id`, `supp_name`, `supp_mobile_no`, `supp_address`, `supp_gstin`) VALUES
(2, 'Sushma', '7760017131', 'pune', '5425'),
(3, 'Shahista', '1563245897', 'banglore', '5632'),
(4, 'Waheeda', '9632653652', 'mumbai', '0120'),
(6, 'Shahista', '5489654785', 'kkkkkkkkk', '5632');

-- --------------------------------------------------------

--
-- Table structure for table `sales_entry`
--

CREATE TABLE `sales_entry` (
  `id` int(100) NOT NULL,
  `bill_no` varchar(100) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `payment_mode` varchar(100) NOT NULL,
  `date_time` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_entry`
--

INSERT INTO `sales_entry` (`id`, `bill_no`, `amount`, `supplier_name`, `payment_mode`, `date_time`) VALUES
(21, '1', 200.00, 'Shahista', 'cash', '2025-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(100) NOT NULL,
  `pieces_per_kg` varchar(100) NOT NULL,
  `plastic_packet_per_kg` varchar(100) NOT NULL,
  `mfd_critical_stock` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `pieces_per_kg`, `plastic_packet_per_kg`, `mfd_critical_stock`) VALUES
(6, '840', '200', '100');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_mfd_stock`
--
ALTER TABLE `daily_mfd_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pieces`
--
ALTER TABLE `master_pieces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_raw`
--
ALTER TABLE `master_raw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_unit`
--
ALTER TABLE `master_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mfd_stock`
--
ALTER TABLE `mfd_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mfd_stock_details`
--
ALTER TABLE `mfd_stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales`
--
ALTER TABLE `product_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_sales_details`
--
ALTER TABLE `product_sales_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_entry`
--
ALTER TABLE `purchase_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_customer`
--
ALTER TABLE `reg_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_labour`
--
ALTER TABLE `reg_labour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_supplier`
--
ALTER TABLE `reg_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_entry`
--
ALTER TABLE `sales_entry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_mfd_stock`
--
ALTER TABLE `daily_mfd_stock`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_pieces`
--
ALTER TABLE `master_pieces`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `master_raw`
--
ALTER TABLE `master_raw`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `master_unit`
--
ALTER TABLE `master_unit`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `mfd_stock`
--
ALTER TABLE `mfd_stock`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `mfd_stock_details`
--
ALTER TABLE `mfd_stock_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `product_sales`
--
ALTER TABLE `product_sales`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `product_sales_details`
--
ALTER TABLE `product_sales_details`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `purchase_entry`
--
ALTER TABLE `purchase_entry`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `reg_customer`
--
ALTER TABLE `reg_customer`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `reg_labour`
--
ALTER TABLE `reg_labour`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reg_supplier`
--
ALTER TABLE `reg_supplier`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_entry`
--
ALTER TABLE `sales_entry`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
