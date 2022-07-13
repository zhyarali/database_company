-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 09:56 AM
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
(13, 'zhyar ufffffffffff', 'a9f744f1e591a1f0a8075ed40231ff0d', '0', '3alm', '61081638e214d1.40387889.jpg'),
(14, 'rzwan', '827ccb0eea8a706c4c34a16891f84e7b', '0', 'rzwan jalal', '61f31cebd4e3a8.86096203.jpg'),
(15, 'zhyar', '202cb962ac59075b964b07152d234b70', '1', 'zhyar', '622607be2bb072.78967756.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE `budget` (
  `id_budget` int(11) NOT NULL,
  `budget_amount` float NOT NULL,
  `punish` float NOT NULL DEFAULT 0,
  `reward` int(255) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `work_for` varchar(255) NOT NULL,
  `clientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id_budget`, `budget_amount`, `punish`, `reward`, `date`, `work_for`, `clientid`) VALUES
(19, 410000, 20000, 90000, '2021-11-25', 'کۆمپانیا', 11),
(20, 20000, 0, 0, '2022-01-27', 'کۆمپانیا', 9),
(21, 0, 0, 0, '2022-03-02', 'کۆمپانیا', 11);

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
  `status` int(2) NOT NULL COMMENT '1 bo kren -1 bo garanawa',
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`id`, `dealer_id`, `cost_t`, `cost_co`, `num`, `type`, `cost_wasl`, `date`, `cost_fr`, `discount`, `unit`, `name_product`, `place`, `percentage`, `driver_id`, `buy_type`, `status`, `note`) VALUES
(11, 2, '10000', '49000', '5', 'iran', '20000', '2021-08-14', '25000', '1000', 'تەن', 'ئاسن', 'ڕانیە', '', 0, 'asn', 1, 'um'),
(16, 2, '7000', '34000', '5', 'سپی', '15000', '2021-08-15', '80000', '1000', 'دانە', 'helka', '', '', 0, 'helka', -1, 'note'),
(17, 1, '20000', '395000', '20', 'عەرەبی', '10000', '2021-08-15', '5000', '5000', 'کیلۆ', '3alaf', 'ڕانیە', '10', 6, '3alaf', -1, 'note'),
(18, 2, '10000', '199545', '20', 'عەرەبی', '50000', '2021-08-15', '5000', '455', 'دانە', 'مێز', 'ڕانیە', '', 0, 'qa3a', 1, 'تێبینی'),
(19, 2, '10000', '40000', '5', 'arabi', '40000', '2021-08-15', '5000', '10000', 'تەن', 'asn', 'slemany', '', 0, 'asn', -1, 'note'),
(31, 1, '10000', '100000', '10', 'سپی', '40000', '2022-03-04', '6000', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'azsas'),
(32, 1, '10000', '100000', '10', 'سپی', '40000', '2022-03-07', '6000', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', -1, 'azsas'),
(33, 1, '5000', '15000', '3', 'سپی', '15000', '2022-03-07', '5000', '0', 'دانە', 'عەلەف', 'ڕانیە', '5', 6, '3alaf', 1, 'sdsd'),
(34, 1, '10000', '20000', '2', 'dfd', '10000', '2022-07-12', '15000', '0', 'دانە', 'ئاسن', 'sss', '', 0, 'asn', -1, 'sdsdsdsd');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `date_start` date NOT NULL,
  `work_place` varchar(20) NOT NULL,
  `bry_para` varchar(255) NOT NULL DEFAULT '30000',
  `status` int(11) NOT NULL COMMENT '0 bo monthly | 1 bo daily',
  `currency_type` varchar(255) NOT NULL,
  `budget_month` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `image`, `phone`, `date_start`, `work_place`, `bry_para`, `status`, `currency_type`, `budget_month`) VALUES
(9, 'ژیار علی محمود', '6143d524c82c24.28865825.jpg', '07501520479', '2021-09-15', '1', '0', 0, 'dinar', 0),
(10, 'ئەبوبەکر محمد علی', '6143d4b60b17c8.05484271.jpg', '07501236788', '2021-09-13', 'کۆمپانیا', '30000', 1, 'dollar', 0),
(11, 'ڕەفیق عمر احمد', '6143d4935aa940.59500712.jpg', '07501236788', '2021-09-16', 'کۆمپانیا', '0', 0, 'dollar', 300000),
(12, 'تێست', '619f6a2a0f14b4.86176599.png', '07501520479', '2021-11-25', '3', '0', 0, 'dollar', 0),
(13, 'تێست ٢', '619f70f09da378.49078164.jpg', '07501236788', '2021-11-25', 'کۆمپانیا', '40000', 1, 'dinar', 0),
(14, 'سۆما احمد عمر', '6143d596917351.57205383.jpg', '07501233455', '2021-08-06', 'کۆمپانیا', '30000', 1, 'tman', 0),
(15, 'شاناز عبدالواحید', '6143d5599b8d69.27588488.jpg', '07501236788', '2021-08-10', 'کۆمپانیا', '0', 0, 'dinar', 0),
(17, 'tetete', '621fd46c94ce15.67118911.jpg', '07501520479', '2022-03-02', '3', '30000', 1, 'tman', 0),
(18, 'hmmm', '6220a8e45af789.31943332.jpg', '07501236788', '2022-03-03', 'کۆمپانیا', '0', 0, 'tman', 500000),
(19, 'rozhana', '6220a9655fc825.72057094.jpg', '07501236788', '2022-03-03', '1', '20000', 1, 'dollar', 0);

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
(1, '148000.00');

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
  `note` text NOT NULL,
  `currency_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `phone`, `address`, `work_place`, `note`, `currency_type`) VALUES
(2, 'ژیار علی کڕیار', '07501520479', 'سڵیمانی', 'کۆمپانیا', 'تێبینی', 'dinar'),
(3, 'میران حوسێن علی', '07501520479', 'سلێمانی', 'کۆمپانیا', 'تێبینی', 'tman'),
(4, 'هاوکار حمە حوسێن', '+9647501520', 'هەولێر', 'کۆمپانیا', 'بەڵی چۆنی', 'tman');

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
  `note` text NOT NULL,
  `currency_type` varchar(255) NOT NULL DEFAULT 'dollar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dealers`
--

INSERT INTO `dealers` (`id`, `name`, `phone`, `address`, `work_place`, `note`, `currency_type`) VALUES
(1, 'ژیار علی محمود', '07501520479', 'ڕانیە', 'کۆمپانیا', 'تێبینی', 'dinar'),
(2, 'شاناز عبدالواحید', '07501520479', 'چەمچەماڵ', 'کۆمپانیا', 'تێبینی بنووسە', 'dollar'),
(3, 'سۆڤین احمد محمد', '07501520479', 'سڵیمانی', 'کۆمپانیا', 'لە کۆمپانیای () گرێبەستی هەیە لەگەڵمان', 'tman'),
(5, 'کارمەند حمە علی', '07501520479', 'سلێمانی', 'کۆمپانیا', 'تێبینی .....', 'dollar'),
(6, 'ساوێن سەردار سالار', '٠٧٧٠١٢١٠٠١٢', 'کۆڵێن سیتی', 'شەقڵاوە', 'خوشکی ژیلام', 'dollar');

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
(26, 50000, '2021-08-20', '2021-09-19', 0, 100000, 2, 'محمد احمد محمد', '07501520479'),
(27, 200, '2021-08-13', '2021-09-12', 0, 200, 5, 'شاناز عبدالواحید', '07501520479');

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
  `money_owner` varchar(50) NOT NULL,
  `currency_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `car_type`, `car_model`, `car_number`, `phone`, `work_type`, `money_owner`, `currency_type`) VALUES
(5, 'zhyar ali mahmood', 'بچووک', 'Kia', 'G 8060 D', '07501520479', 'سەعات', 'ستاف', 'tman'),
(6, 'سەیوان پیرۆت', 'بچووک', 'sunny', 'MD123S45', '07501236788', 'بار', 'کۆمپانیا', 'dinar'),
(7, 'ali', 'گەورە', 'Kia', 'JKL123MNO', '07501236788', 'سەعات', 'کۆمپانیا', 'tman'),
(8, 'ژیار علی محمود', 'گەورە', 'Ford', 'CIA123', '07501520479', 'سەعات', 'کۆمپانیا', 'dinar'),
(9, 'tessssss', 'بچووک', 'kia', 'CIA123', '07501233455', 'سەعات', 'کۆمپانیا', 'tman');

-- --------------------------------------------------------

--
-- Table structure for table `driver_work`
--

CREATE TABLE `driver_work` (
  `id` int(11) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `price` int(255) NOT NULL,
  `money_owner` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `driver_id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver_work`
--

INSERT INTO `driver_work` (`id`, `from`, `to`, `time`, `price`, `money_owner`, `note`, `driver_id`, `date`) VALUES
(1, 'هەولێر', 'سلێمانی', 3, 30000, 'داواکار', 'ئەم بارە درەنگ گەیشت', 8, '2021-09-03'),
(3, 'ڕانیە', 'سلێمانی', 5, 10000, 'ستاف', 'nya', 8, '2021-09-01'),
(4, 'چەمچەماڵ', 'سلێمانی', 2, 30000, 'کۆمپانیا', 'nes', 8, '2021-09-21'),
(5, 'ڕانیە', 'سلێمانی', 5, 10000, 'کۆمپانیا', '5dfd', 8, '2021-09-21'),
(6, 'هەولێر', 'سلێمانی', 5, 30000, 'کۆمپانیا', '4erer', 5, '2021-09-29'),
(7, 'هەولێر', 'سلێمانی', 4, 10000, 'کۆمپانیا', 'sdwewe', 6, '2022-03-07'),
(8, 'هەولێر', 'سلێمانی', 2, 120000, 'داواکار', 'dwdsd', 5, '2022-03-07');

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
  `phone` varchar(11) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `name`, `phone`, `note`) VALUES
(1, 'کاوان پشتیوان محمد', '07501520479', 'لێرە تێبینی بنووسە'),
(2, 'عزیز علی عبداللە', '07501234567', 'ئەم کەسە قەرزێکی لایە بڕی ٢٠٠ هەزار'),
(4, 'سلێمان حمد پیرۆت', '07704567890', 'تێبینی بنووسە'),
(5, 'علی احمد حسن', '07501520479', '');

-- --------------------------------------------------------

--
-- Table structure for table `piece`
--

CREATE TABLE `piece` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `piece`
--

INSERT INTO `piece` (`id`, `name`, `category_id`) VALUES
(1, 'صەمونە', 1),
(2, 'بۆڕی تەوزیح دان', 1),
(3, 'دیلەمۆی تەوزیح دان', 2),
(4, ' عکس', 1),
(5, 'بەرینەی تەوزیح دان', 1),
(6, 'تەقسیم(سوور) + برغی ڕەقەم (١٠)', 1),
(7, 'hama', 1);

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `id` int(11) NOT NULL,
  `dealer_id` int(11) NOT NULL,
  `price` int(255) NOT NULL,
  `refund_type` enum('cash','7awala') NOT NULL DEFAULT 'cash',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `refund`
--

INSERT INTO `refund` (`id`, `dealer_id`, `price`, `refund_type`, `date`) VALUES
(1, 1, 10000, 'cash', '2022-03-05'),
(2, 1, 15000, 'cash', '2022-03-05'),
(3, 1, 10000, 'cash', '2022-03-05'),
(4, 1, 10000, '7awala', '2022-03-05'),
(5, 2, 10000, 'cash', '2022-03-05');

-- --------------------------------------------------------

--
-- Table structure for table `refund_customer`
--

CREATE TABLE `refund_customer` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `price` int(255) NOT NULL,
  `refund_type` enum('cash','7awala') NOT NULL DEFAULT 'cash',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `refund_customer`
--

INSERT INTO `refund_customer` (`id`, `customer_id`, `price`, `refund_type`, `date`) VALUES
(1, 2, 10000, 'cash', '2022-03-05');

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
  `status` int(2) NOT NULL DEFAULT 1,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `customer_id`, `cost_t`, `cost_co`, `num`, `type`, `cost_wasl`, `date`, `discount`, `unit`, `name_product`, `place`, `percentage`, `driver_id`, `sale_type`, `status`, `note`) VALUES
(7, 2, '10000', '30000', '3', 'سپی', '50000', '2021-08-15', '0', 'مەتر', 'مێز', 'ڕانیە', '', 0, 'qa3a', -1, 'تێبینی بنووسە'),
(8, 2, '10000', '45000', '5', 'spy', '20000', '2021-08-15', '5000', 'دانە', '3alaf', 'slemany', '20', 6, '3alaf', -1, 'تێبینی'),
(9, 3, '10000', '90000', '10', 'سپی', '50000', '2021-08-15', '10000', 'دانە', 'asn', 'ڕانیە', '', 0, 'asn', -1, 'tYbyny'),
(20, 2, '5000', '25000', '5', 'سپی', '10000', '2022-03-05', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', -1, 'sds'),
(21, 2, '5000', '35000', '7', 'spy', '15000', '2022-03-07', '0', 'مەتر', 'مێز', 'ڕانیە', '', 0, 'qa3a', -1, 'rtrt'),
(22, 2, '5000', '5000', '1', 'سپی', '10000', '2022-03-07', '0', 'دانە', 'عەلەف', 'ڕانیە', '10', 5, '3alaf', -1, 'sds'),
(23, 2, '10000', '10000', '1', 'سپی', '10000', '2022-07-12', '0', 'دانە', 'عەلەف', 'sss', '1', 5, '3alaf', 1, 'سدسد'),
(24, 2, '10000', '10000', '1', 'iran', '10000', '2022-07-12', '0', 'دانە', 'ئاسن', 'sss', '', 0, 'asn', -1, 'sdsd');

-- --------------------------------------------------------

--
-- Table structure for table `sale_category`
--

CREATE TABLE `sale_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_category`
--

INSERT INTO `sale_category` (`id`, `name`, `type`, `price`) VALUES
(1, 'تەوزیح دان', 'مەتر', 100000),
(2, 'نیپل', 'مەتر', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `sale_meter`
--

CREATE TABLE `sale_meter` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `piece` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `num_meter` int(11) NOT NULL,
  `discount` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `nrx_wasl` int(255) NOT NULL,
  `date` date NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_meter`
--

INSERT INTO `sale_meter` (`id`, `id_category`, `customer_id`, `piece`, `num_meter`, `discount`, `address`, `nrx_wasl`, `date`, `note`) VALUES
(19, 1, 2, 'صەمونە,بەرینەی تەوزیح دان,تەقسیم(سوور) + برغی ڕەقەم (١٠)', 1, 0, 'ڕانیە', 50000, '2021-09-25', 'dsds'),
(20, 2, 2, 'دیلەمۆی تەوزیح دان', 5, 0, 'ڕانیە', 50000, '2021-09-25', 'szdsd'),
(22, 1, 2, 'صەمونە,بۆڕی تەوزیح دان,تەقسیم(سوور) + برغی ڕەقەم (١٠)', 1, 0, 'ڕانیە', 40000, '2021-09-25', 'jhjhj'),
(23, 1, 2, 'صەمونە,بۆڕی تەوزیح دان', 1, 0, 'ڕانیە', 50000, '2021-09-25', 'jhjh');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `manager` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `note` text NOT NULL,
  `currency_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `manager`, `phone`, `note`, `currency_type`) VALUES
(1, 'بیرمەند', 'کاروان محمد عمر', '07503457896', 'note bnusa', 'dollar'),
(2, 'سماڕت', 'ژیار علی محمود', '07501520479', 'پێویستە زۆر چالاک بن', 'dollar'),
(4, 'teststaf', 'ali hassan', '07501236788', 'test test', 'tman');

-- --------------------------------------------------------

--
-- Table structure for table `staff_work`
--

CREATE TABLE `staff_work` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost_project` int(255) NOT NULL,
  `cost_fixed` int(255) NOT NULL,
  `cost_total` int(255) NOT NULL,
  `get_price` int(255) NOT NULL,
  `xarjy` int(255) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `staff_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff_work`
--

INSERT INTO `staff_work` (`id`, `name`, `cost_project`, `cost_fixed`, `cost_total`, `get_price`, `xarjy`, `date`, `address`, `owner`, `note`, `staff_id`) VALUES
(3, 'نەخۆشخانەی ئیمان لە هەولێر', 0, 0, 0, 1655000, 650000, '2021-09-19', 'هەولێر', 'کۆمپانیا', 'ئەم پڕۆژەیە پێویستە بە ڕیک و پێکی تەواو بکرێت.', 2),
(6, 'نەخۆشخانەی سماڕت', 0, 0, 0, 1200000, 650000, '2021-09-29', 'سلێمانی', 'ستاف', '........', 2),
(7, 'نەخۆشخانەی ئیمان لە هەولێر', 0, 0, 0, 1655000, 650000, '2022-03-03', 'Kurdistan, Rania', 'کۆمپانیا', 'dfdfdfdfdf', 1),
(8, 'هۆتێل ستار', 612000, 320000, 612000, 500000, 100000, '2022-03-06', 'سلێمانی', 'کۆمپانیا', 'wewewewewe', 1);

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
('803e66cf58328d996f8fe6b8443f691d611e6f05e1215', 11, 17),
('5841582af603866bc63248daefcc952e614f52a093c7b', 12, 18),
('80401f1fc07c03d1221d72b75195e42c61f31d0f348e7', 14, 19),
('e1957e9353afd2ec9e463f6a5fde12dc621d0ae53a60b', 11, 20),
('3b06857b193042441bde3bbacfa48b18622217b0e8c00', 11, 21),
('2aff00c2c7b407e4dfdc4902f4a7961162224b78020d4', 11, 22),
('cf9899ab62f80c1d344e645b8f0775346223a97dd5529', 11, 23),
('ab24dd43574f5732ea29361f8da6bc2f6223e38ebd4cf', 11, 24),
('2dc3f83a06a46c607d24c7d9c856e99462260804e6cd4', 15, 25),
('06b42e58b0515daa2ff59413020e7c2362c741bf3b8a6', 11, 26);

-- --------------------------------------------------------

--
-- Table structure for table `work_daily`
--

CREATE TABLE `work_daily` (
  `id_daily` int(11) NOT NULL,
  `work_hour` int(11) NOT NULL,
  `work_hour_amount` int(255) NOT NULL,
  `work_extra` int(11) NOT NULL DEFAULT 0,
  `budget` int(255) NOT NULL,
  `punish` int(255) NOT NULL DEFAULT 0,
  `reward` int(255) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `work_for` varchar(255) NOT NULL,
  `clientid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `work_daily`
--

INSERT INTO `work_daily` (`id_daily`, `work_hour`, `work_hour_amount`, `work_extra`, `budget`, `punish`, `reward`, `date`, `work_for`, `clientid`) VALUES
(11, 6, 3000, 0, 18000, 0, 0, '2021-11-25', 'کۆمپانیا', 10),
(12, 8, 4000, 1, 29000, 10000, 3000, '2021-11-25', 'کۆمپانیا', 13),
(13, 5, 4000, 1, 24000, 0, 0, '2021-11-25', 'کۆمپانیا', 13),
(14, 9, 3000, 1, 35000, 0, 5000, '2021-11-25', 'کۆمپانیا', 14),
(15, 2, 3000, 2, 32000, 0, 20000, '2022-03-02', 'کۆمپانیا', 10);

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
  `date` date NOT NULL,
  `currency_type` varchar(255) NOT NULL DEFAULT 'dinar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `xarjy`
--

INSERT INTO `xarjy` (`id`, `name_item`, `price`, `place`, `get_price`, `xarj_by`, `date`, `currency_type`) VALUES
(1, 'hhh', 250, 'سلێمانی', '40000', '1', '2021-08-06', 'dollar'),
(4, 'تێست', 10000, 'ڕانیە', '10000', '2', '2021-08-05', 'dinar'),
(5, 'test', 4500, 'هەولێر', '20000', '4', '2021-08-20', 'dinar'),
(6, 'نان خواردنی نیوەڕۆ نان خواردنی نیوەڕۆ نان خواردنی نیوەڕۆ نان خواردنی نیوەڕۆ نان خواردنی نیوەڕۆ نان خواردنی نیوەڕۆ', 30000, 'کۆمپانیا', '50000', '1', '2021-08-20', 'dinar'),
(7, 'xwardn', 20000, 'کۆمپانیا', '40000', '1', '2022-03-03', 'tman');

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
-- Indexes for table `driver_work`
--
ALTER TABLE `driver_work`
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
-- Indexes for table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_customer`
--
ALTER TABLE `refund_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_category`
--
ALTER TABLE `sale_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_meter`
--
ALTER TABLE `sale_meter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_work`
--
ALTER TABLE `staff_work`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `id_debt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `driver_work`
--
ALTER TABLE `driver_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- AUTO_INCREMENT for table `piece`
--
ALTER TABLE `piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `refund`
--
ALTER TABLE `refund`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `refund_customer`
--
ALTER TABLE `refund_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sale_category`
--
ALTER TABLE `sale_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_meter`
--
ALTER TABLE `sale_meter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff_work`
--
ALTER TABLE `staff_work`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `work_daily`
--
ALTER TABLE `work_daily`
  MODIFY `id_daily` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `xarjy`
--
ALTER TABLE `xarjy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
