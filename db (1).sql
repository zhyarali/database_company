-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2021 at 11:42 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`, `type`, `name`, `avatar`) VALUES
(11, 'zarda', '526eeeda337d4f5c42efe210c81ccd4f', '1', 'زەردە دیڤ', '60fed6be33a022.03406613.png'),
(12, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 'ئەدمین', '60feda87d180d2.94392251.png'),
(13, 'zhyar ufffffffffff', 'a9f744f1e591a1f0a8075ed40231ff0d', '0', '3alm', '61081638e214d1.40387889.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id_budget` int(11) NOT NULL,
  `budget_amount` float NOT NULL,
  `punish` float NOT NULL,
  `date` date NOT NULL,
  `clientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id_budget`, `budget_amount`, `punish`, `date`, `clientid`) VALUES
(2, 20000, 1, '2021-08-07', 1),
(3, 120000, 20000, '2021-08-08', 1),
(5, 0, 0, '2021-08-08', 2),
(7, 260000, 0, '2021-08-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `cost_t` varchar(255) NOT NULL,
  `cost_co` varchar(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cost_wasl` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `cost_fr` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `buy_type` enum('3alaf','helka','panel','qa3a','asn') NOT NULL DEFAULT 'helka',
  `status` int(2) NOT NULL COMMENT '1 bo kren -1 bo garanawa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`id`, `dealer_id`, `cost_t`, `cost_co`, `num`, `type`, `cost_wasl`, `date`, `cost_fr`, `discount`, `unit`, `name_product`, `place`, `percentage`, `driver_id`, `buy_type`, `status`) VALUES
(1, 1, '4000', '30000', '10', 'سپی', '20000', '2021-07-31', '6000', '10000', 'دانە', 'هێلکە', '', '', 0, 'helka', 1),
(6, 1, '5000', '50000', '10', 'سپی', '10000', '2021-08-14', '5000', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1),
(10, 2, '5000', '45000', '10', 'spy', '20000', '2021-08-14', '6000', '5000', 'دانە', 'مێز', 'سلێمانی', '', 0, 'qa3a', 1),
(11, 2, '10000', '49000', '5', 'iran', '20000', '2021-08-14', '25000', '1000', 'تەن', 'ئاسن', 'ڕانیە', '', 0, 'asn', 1),
(14, 1, '20000', '90000', '5', 'عەرەبی', '40000', '2021-08-14', '25000', '10000', 'تەن', 'عەلەف', 'ڕانیە', '10', 6, '3alaf', 1),
(16, 2, '7000', '34000', '5', 'سپی', '15000', '2021-08-15', '80000', '1000', 'دانە', 'helka', '', '', 0, 'helka', -1),
(17, 1, '20000', '395000', '20', 'عەرەبی', '10000', '2021-08-15', '5000', '5000', 'کیلۆ', '3alaf', 'ڕانیە', '10', 6, '3alaf', -1),
(18, 2, '10000', '199545', '20', 'عەرەبی', '50000', '2021-08-15', '5000', '455', 'دانە', 'مێز', 'ڕانیە', '', 0, 'qa3a', -1),
(19, 2, '10000', '40000', '5', 'arabi', '40000', '2021-08-15', '5000', '10000', 'تەن', 'asn', 'slemany', '', 0, 'asn', -1),
(20, 1, '5000', '10000', '20', 'تورکی', '40000', '2021-08-19', '6000', '0', 'دانە', 'قاپ', 'ڕانیە', '', 0, 'qa3a', 1),
(21, 1, '5000', '25000', '5', 'عەرەبی', '20000', '2021-08-19', '5000', '0', 'دانە', 'قاپ', 'ڕانیە', '', 0, 'qa3a', 1),
(22, 1, '20000', '100000', '5', 'تورکی', '40000', '2021-08-20', '25000', '0', 'دانە', 'ئاسن', 'ڕانیە', '', 0, 'asn', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `date_start` date NOT NULL,
  `work_place` varchar(20) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 bo monthly | 1 bo daily'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `phone`, `date_start`, `work_place`, `status`) VALUES
(1, 'ژیار علی محمود', '07501520479', '2021-08-06', 'ستاف', 0),
(2, 'محمد احمد محمد', '07501233455', '2021-08-06', 'کۆمپانیا', 1),
(5, 'شاناز عبدالواحید', '07501236788', '2021-08-10', 'کۆمپانیا', 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `dolar` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `dolar`) VALUES
(1, '146000.00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `work_place` varchar(100) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `address`, `work_place`, `note`) VALUES
(2, 'ژیار علی کڕیار', '07501520479', 'سڵیمانی', 'کۆمپانیا', 'کاژسداسسهدژسهدژسهدژ'),
(3, 'میران حوسێن علی', '07501520479', 'سلێمانی', 'کۆمپانیا', 'ژاسهژاهسژاهسژاس');

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `work_place` varchar(100) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `phone`, `address`, `work_place`, `note`) VALUES
(1, 'ژیار علی محمود', '07501520479', 'ڕانیە', 'کۆمپانیا', 'تێبینی'),
(2, 'شاناز عبدالواحید', '07501520479', 'چەمچەماڵ', 'کۆمپانیا', 'تێبینی بنووسە'),
(3, 'سۆڤین احمد محمد', '07501520479', 'سڵیمانی', 'کۆمپانیا', 'لە کۆمپانیای () گرێبەستی هەیە لەگەڵمان');

-- --------------------------------------------------------

--
-- Table structure for table `debt`
--

CREATE TABLE `debt` (
  `id_debt` int(11) NOT NULL,
  `debt_amount` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `gerawa` int(11) NOT NULL,
  `mawa` int(11) NOT NULL,
  `clientid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `debt`
--

INSERT INTO `debt` (`id_debt`, `debt_amount`, `date_start`, `date_end`, `gerawa`, `mawa`, `clientid`, `name`, `phone`) VALUES
(23, 50000, '2021-07-16', '2021-08-15', 300000, 100000, 1, 'ژیار علی محمود', '07501520479'),
(24, 25000, '2021-08-17', '2021-09-30', 100000, 0, 0, 'حسن حسێن', '123'),
(26, 50000, '2021-08-20', '2021-09-19', 0, 100000, 2, 'محمد احمد محمد', '07501520479');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `car_type` varchar(50) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `car_number` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `work_type` varchar(50) NOT NULL,
  `money_owner` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `car_type`, `car_model`, `car_number`, `phone`, `work_type`, `money_owner`) VALUES
(5, 'zhyar', 'گەورە', 'Kia', 'G 8060 D', '07501520479', 'سەعات', 'ستاف'),
(6, 'سەیوان پیرۆت', 'بچووک', 'sunny', 'MD123S45', '07501236788', 'بار', 'کۆمپانیا'),
(7, 'ali', 'گەورە', 'Kia', 'JKL123MNO', '07501236788', 'سەعات', 'کۆمپانیا');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `name`) VALUES
(4, 'شتومەکی قاعە'),
(10, 'هێلکە');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `name`, `phone`) VALUES
(1, 'کاوان پشتیوان محمد', '07501520479'),
(2, 'عزیز علی عبداللە', '07501234567'),
(4, 'سلێمان حمد پیرۆت', '07704567890'),
(5, 'علی احمد حسن', '07501520479');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `cost_t` varchar(255) NOT NULL,
  `cost_co` varchar(255) NOT NULL,
  `num` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `cost_wasl` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `discount` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `sale_type` enum('3alaf','helka','panel','qa3a','asn') NOT NULL DEFAULT 'helka',
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `customer_id`, `cost_t`, `cost_co`, `num`, `type`, `cost_wasl`, `date`, `discount`, `unit`, `name_product`, `place`, `percentage`, `driver_id`, `sale_type`, `status`) VALUES
(6, 2, '20000', '120000', '6', 'سپی', '20000', '2021-08-15', '0', 'دانە', 'helka', '', '', 0, 'helka', -1),
(7, 2, '10000', '30000', '3', 'سپی', '50000', '2021-08-15', '0', 'مەتر', 'مێز', 'ڕانیە', '', 0, 'qa3a', -1),
(8, 2, '10000', '45000', '5', 'spy', '20000', '2021-08-15', '5000', 'دانە', '3alaf', 'slemany', '20', 6, '3alaf', -1),
(9, 3, '10000', '90000', '10', 'سپی', '50000', '2021-08-15', '10000', 'دانە', 'asn', 'ڕانیە', '', 0, 'asn', -1),
(12, 2, '5000', '10000', '4', 'عەرەبی', '50000', '2021-08-19', '10000', 'دانە', 'عەلەف', 'ڕانیە', '10', 5, '3alaf', 1),
(14, 3, '4000', '50000', '1', 'تورکی', '40000', '2021-08-20', '0', 'دانە', 'ئاسن', 'ڕانیە', '', 0, 'asn', 1),
(15, 2, '5000', '80000', '16', 'سپی', '40000', '2021-08-20', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1);

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `name`, `avatar`) VALUES
(1, 'سیستەمی کۆمپانیای هۆگر', '60ff3af1e57b71.29844427.png');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `token` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`token`, `user_id`, `id`) VALUES
('7fdccc40bf7ddbc9b15dd69a84979e386108169952411', 12, 16),
('803e66cf58328d996f8fe6b8443f691d611e6f05e1215', 11, 17);

-- --------------------------------------------------------

--
-- Table structure for table `work_daily`
--

CREATE TABLE `work_daily` (
  `id_daily` int(11) NOT NULL,
  `work_hour` int(11) NOT NULL,
  `work_hour_amount` int(255) NOT NULL,
  `work_extra` int(11) NOT NULL,
  `budget` int(255) NOT NULL,
  `punish` int(255) NOT NULL,
  `date` date NOT NULL,
  `clientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_daily`
--

INSERT INTO `work_daily` (`id_daily`, `work_hour`, `work_hour_amount`, `work_extra`, `budget`, `punish`, `date`, `clientid`) VALUES
(2, 7, 5000, 2, 45000, 0, '2021-08-10', 2),
(3, 4, 30000, 3, 205000, 5000, '2021-08-10', 2);

-- --------------------------------------------------------

--
-- Table structure for table `xarjy`
--

CREATE TABLE `xarjy` (
  `id` int(11) NOT NULL,
  `name_item` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `place` varchar(255) NOT NULL,
  `get_price` varchar(255) NOT NULL,
  `xarj_by` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xarjy`
--

INSERT INTO `xarjy` (`id`, `name_item`, `price`, `place`, `get_price`, `xarj_by`, `date`) VALUES
(1, 'hhh', 250, 'سلێمانی', '40000', '1', '2021-08-06'),
(4, 'تێست', 10000, 'ڕانیە', '10000', '2', '2021-08-05'),
(5, 'test', 4500, 'هەولێر', '20000', '4', '2021-08-20'),
(6, 'نان خواردنی نیوەڕۆ', 30000, 'کۆمپانیا', '50000', '1', '2021-08-20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id_budget`);

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debt`
--
ALTER TABLE `debt`
  ADD PRIMARY KEY (`id_debt`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_daily`
--
ALTER TABLE `work_daily`
  ADD PRIMARY KEY (`id_daily`);

--
-- Indexes for table `xarjy`
--
ALTER TABLE `xarjy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `id_debt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `work_daily`
--
ALTER TABLE `work_daily`
  MODIFY `id_daily` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `xarjy`
--
ALTER TABLE `xarjy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
