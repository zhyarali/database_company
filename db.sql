-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2022 at 02:20 AM
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
(13, 'zhyar ufffffffffff', 'a9f744f1e591a1f0a8075ed40231ff0d', '0', '3alm', '61081638e214d1.40387889.jpg'),
(14, 'rzwan', '827ccb0eea8a706c4c34a16891f84e7b', '0', 'rzwan jalal', '61f31cebd4e3a8.86096203.jpg'),
(15, 'zhyar', '202cb962ac59075b964b07152d234b70', '1', 'zhyar', '622607be2bb072.78967756.jpg'),
(16, 'admin', '202cb962ac59075b964b07152d234b70', '0', 'admin', '62df06b41ffa88.70985174.jpg');

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
  `invoice_id` int(11) NOT NULL DEFAULT 1,
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

INSERT INTO `buy` (`id`, `invoice_id`, `dealer_id`, `cost_t`, `cost_co`, `num`, `type`, `cost_wasl`, `date`, `cost_fr`, `discount`, `unit`, `name_product`, `place`, `percentage`, `driver_id`, `buy_type`, `status`, `note`) VALUES
(1, 1, 1, '4000', '40000', '20', 'سپی', '30000', '2022-07-19', '5000', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'همممممممممممممم'),
(2, 2, 1, '4000', '12000', '3', ' تورکی', '10000', '2022-07-19', '1000', '0', 'دانە', 'کارتۆن مۆز', 'هەولێر', '', 0, 'qa3a', -1, '                                                                                                sdsdsd                                                                        '),
(3, 2, 1, '10000', '10000', '1', 'ئێرانی', '10000', '2022-07-19', '1000', '0', 'کیلۆ', 'sdsd', 'هەولێر', '', 0, 'qa3a', -1, '                                                                                                sdsdsd                                                                        '),
(4, 3, 3, '1000', '34000', '34', 'sdsd', '20000', '2022-07-20', '1000', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'dsfsd'),
(5, 4, 6, '10000', '20000', '2', 'تورکی', '10000', '2022-07-20', '1000', '0', 'دانە', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'asasasa'),
(6, 4, 6, '10000', '30000', '3', 'sdsd', '10000', '2022-07-20', '1000', '0', 'کیلۆ', 'ئاسن', 'هەولێر', '', 0, 'asn', -1, 'asasasa'),
(10, 18, 3, '10000', '20000', '2', 'سپی', '20000', '2022-07-21', '1000', '0', 'دانە', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'sdsd'),
(11, 18, 3, '10000', '920000', '92', 'سپی', '20000', '2022-07-21', '1000', '0', 'دانە', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, '                                                sdsd                                    '),
(12, 16, 7, '10000', '30000', '3', 'سپی', '20000', '2022-07-21', '1000', '0', 'دانە', 'عەلەف', 'هەولێر', '4', 9, '3alaf', 1, '                                                                sds                                                '),
(13, 24, 6, '10000', '20000', '2', 'popopo', '20000', '2022-07-22', '1000', '0', 'دانە', 'کارتۆن مۆزڤڤڤڤ', 'هەولێر', '', 0, 'qa3a', 1, 'سادسدسدسد'),
(14, 25, 1, '4000', '11000', '3', 'jajajajaja', '2000', '2022-07-23', '5000', '1000', 'مەتر', 'newww', 'هەولێر', '', 0, 'qa3a', 1, 'defd'),
(15, 26, 2, '90000', '180000', '2', 'popopo', '30000', '2022-07-23', '1000', '0', 'دانە', 'کارتۆن مۆزڤڤڤڤ', 'هەولێر', '', 0, 'qa3a', 1, 'sdsdsd'),
(16, 27, 2, '10000', '20000', '2', 'sdsd', '20000', '2022-07-23', '1000', '0', 'مەتر', 'کارتۆن مۆز', 'هەولێر', '', 0, 'qa3a', 1, 'hjhjhjhjh'),
(17, 32, 2, '10000', '20000', '2', 'سپی', '20000', '2022-07-25', '1000', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'sdsds'),
(18, 17, 2, '10000', '20000', '2', 'hahahha', '20000', '2022-07-25', '1000', '0', 'دانە', 'عەلەف', 'sss', '2', 8, '3alaf', 1, '                                                                                edfe                                                            '),
(19, 17, 2, '10000', '100000', '10', 'yyyyyyyyyyyyyyyyy', '20000', '2022-07-25', '1000', '0', 'دانە', 'عەلەف', 'sss', '2', 8, '3alaf', 1, '                                                                                edfe                                                            '),
(26, 30, 3, '10000', '30000', '3', '', '20000', '2022-07-25', '', '0', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, '                                                sdsdsdsd                                    '),
(27, 30, 3, '90000', '540000', '6', '', '20000', '2022-07-25', '', '0', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, '                                                sdsdsdsd                                    '),
(28, 31, 2, '10000', '30000', '4', 'سپی', '20000', '2022-07-25', '1000', '10000', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, '                                asasasas                        '),
(29, 31, 2, '90000', '530000', '6', 'سپی', '20000', '2022-07-25', '1000', '10000', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, '                                asasasas                        ');

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
-- Table structure for table `company_invoice`
--

CREATE TABLE `company_invoice` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company_invoice`
--

INSERT INTO `company_invoice` (`id`, `name`, `description`, `title`, `address`, `image`) VALUES
(1, 'کۆمپانیای ئارام', 'بۆ کێلگەی پەلەوەری و بینای ئاسن', 'پسولەی پڕۆژەی ستافەکان', 'سلێمانی - ڕانیە - دەربەند', '62df30dd4112d7.30738864.png');

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
(6, 'ساوێن سەردار سالار', '٠٧٧٠١٢١٠٠١٢', 'کۆڵێن سیتی', 'شەقڵاوە', 'خوشکی ژیلام', 'dollar'),
(7, 'ژیلا علی محموود', '07501234567', 'کۆڵین سیتی', 'بەردەم ماڵی خەوینی', 'ئەم کچە خوشکی ساوێن و خەوینە', 'dollar');

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
(27, 200, '2021-08-13', '2021-09-12', 0, 200, 5, 'شاناز عبدالواحید', '07501520479'),
(33, 20000, '2022-07-25', '2022-08-24', 20000, 0, 14, 'سۆما احمد عمر', '07823782738');

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
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `price` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `dealer_id` int(255) NOT NULL,
  `customer_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `date`, `price`, `type`, `note`, `status`, `dealer_id`, `customer_id`) VALUES
(1, '2022-07-25 03:10:40', 40000, 'buy_helka', 'همممممممممممممم', 1, 1, 0),
(2, '2022-07-25 21:26:23', 0, 'buy_qa3a', '                                                                                                                sdsdsd                                                                                    ', -1, 5, 0),
(3, '2022-07-25 03:10:33', 34000, 'buy_helka', 'dsfsd', 1, 3, 0),
(4, '2022-07-25 03:10:29', 50000, 'buy_asn', 'asasasa', 1, 6, 0),
(6, '2022-07-25 21:45:05', 0, 'sale_helka', '                                    ffffffffffffffffffff                    ', 1, 0, 2),
(10, '2022-07-25 03:11:49', 0, 'sale_helka', '                            ', 1, 0, 2),
(11, '2022-07-25 03:11:49', 0, 'sale_asn', '                                sdsdsdsdsdsd                        ', 1, 0, 2),
(13, '2022-07-25 03:11:49', 0, 'sale_3alaf', '                                                                                                                                                                                                                                                                                                                sdsd                                                                                                                                                                                                                                    ', 1, 0, 2),
(14, '2022-07-25 03:11:49', 70000, 'sale_3alaf', '                sdsd            ', 1, 0, 2),
(15, '2022-07-25 03:11:49', 49000, 'sale_3alaf', '                                                                                                                                                                                                                                                                                                                                dcdf                                                                                                                                                                                                                                                ', 1, 0, 2),
(16, '2022-07-25 03:09:53', 0, 'buy_3alaf', '                                                                sds                                                ', 1, 7, 0),
(17, '2022-07-25 03:09:48', 0, 'buy_3alaf', '                                                                                edfe                                                            ', 1, 2, 0),
(18, '2022-07-25 03:09:42', 940000, 'buy_asn', '                                                sdsd                                    ', 1, 3, 0),
(19, '2022-07-25 03:11:49', 40000, 'sale_asn', '                                                dsdsdsd                                    ', 1, 0, 2),
(20, '2022-07-25 03:11:49', 0, 'sale_helka', '                            ', 1, 0, 2),
(21, '2022-07-25 03:09:29', 10000, 'sale_helka', '                                فففففففففففففف                        ', 1, 0, 4),
(22, '2022-07-25 03:09:25', 0, 'sale_3alaf', '                                                                                sdsdsd                                                            ', -1, 0, 2),
(23, '2022-07-25 03:09:10', 0, 'sale_asn', '                                                                dfdfdfd                                                ', 1, 0, 4),
(24, '2022-07-25 03:09:02', 20000, 'buy_qa3a', 'سادسدسدسد', 1, 6, 0),
(25, '2022-07-25 03:08:58', 11000, 'buy_qa3a', 'defd', 1, 1, 0),
(26, '2022-07-25 03:08:55', 180000, 'buy_qa3a', 'sdsdsd', 1, 2, 0),
(27, '2022-07-25 03:08:50', 20000, 'buy_qa3a', 'hjhjhjhjh', 1, 2, 0),
(28, '2022-07-25 03:09:17', 20000, 'sale_qa3a', 'sdsd', -1, 0, 2),
(30, '2022-07-25 03:06:02', 0, 'buy_qa3a', '                                                sdsdsdsd                                    ', 1, 3, 0),
(31, '2022-07-25 21:27:41', 560000, 'buy_qa3a', '                                asasasas                        ', 1, 2, 0),
(32, '2022-07-25 02:10:57', 20000, 'buy_helka', 'sdsds', 1, 2, 0),
(33, '2022-07-25 03:06:29', 20000, 'sale_qa3a', 'sdsdsd', 1, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_phone`
--

CREATE TABLE `invoice_phone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_phone`
--

INSERT INTO `invoice_phone` (`id`, `name`) VALUES
(3, 'ئارام : 07501200241 - 07714550600'),
(5, 'ئاکام : 07501200238 - 07514550600');

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
  `qty` int(11) NOT NULL DEFAULT 1,
  `price` varchar(255) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `piece`
--

INSERT INTO `piece` (`id`, `name`, `qty`, `price`, `category_id`) VALUES
(26, 'sadsds', 9, '10000', 13),
(27, 'dddd', 10, '10000', 13),
(28, 'updated', 8, '10000', 14),
(29, 'updated', 10, '10000', 11),
(30, 'kkkk', 6, '10000', 15);

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
  `invoice_id` int(11) NOT NULL DEFAULT 1,
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
  `sale_status` varchar(255) NOT NULL DEFAULT 'null',
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `invoice_id`, `customer_id`, `cost_t`, `cost_co`, `num`, `type`, `cost_wasl`, `date`, `discount`, `unit`, `name_product`, `place`, `percentage`, `driver_id`, `sale_type`, `status`, `sale_status`, `note`) VALUES
(7, 1, 2, '10000', '30000', '3', 'سپی', '50000', '2021-08-15', '0', 'مەتر', 'مێز', 'ڕانیە', '', 0, 'qa3a', -1, 'null', 'تێبینی بنووسە'),
(8, 1, 2, '10000', '45000', '5', 'spy', '20000', '2021-08-15', '5000', 'دانە', '3alaf', 'slemany', '20', 6, '3alaf', -1, 'null', 'تێبینی'),
(9, 1, 3, '10000', '90000', '10', 'سپی', '50000', '2021-08-15', '10000', 'دانە', 'asn', 'ڕانیە', '', 0, 'asn', -1, 'null', 'tYbyny'),
(20, 1, 2, '5000', '25000', '5', 'سپی', '10000', '2022-03-05', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', -1, 'null', 'sds'),
(21, 1, 2, '5000', '35000', '7', 'spy', '15000', '2022-03-07', '0', 'مەتر', 'مێز', 'ڕانیە', '', 0, 'qa3a', -1, 'null', 'rtrt'),
(22, 1, 2, '5000', '5000', '1', 'سپی', '10000', '2022-03-07', '0', 'دانە', 'عەلەف', 'ڕانیە', '10', 5, '3alaf', -1, 'null', 'sds'),
(23, 1, 2, '10000', '10000', '1', 'سپی', '10000', '2022-07-12', '0', 'دانە', 'عەلەف', 'sss', '1', 5, '3alaf', 1, 'null', 'سدسد'),
(24, 1, 2, '10000', '10000', '1', 'iran', '10000', '2022-07-12', '0', 'دانە', 'ئاسن', 'sss', '', 0, 'asn', -1, 'null', 'sdsd'),
(27, 9, 2, '10000', '50000', '5', 'سپی', '20000', '2022-07-21', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', ''),
(29, 10, 2, '10000', '120000', '12', 'sdsd', '20000', '2022-07-21', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', -1, 'null', ''),
(30, 11, 3, '10000', '10000', '1', 'hahahha', '20000', '2022-07-21', '0', 'دانە', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', 'sdsdsdsdsdsd'),
(31, 11, 4, '10000', '10000', '1', 'hahahha', '20000', '2022-07-21', '0', 'دانە', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', '                                sdsdsdsdsdsd                        '),
(35, 14, 2, '10000', '70000', '7', 'سپی', '20000', '2022-07-21', '0', 'دانە', 'عەلەف', 'هەولێر', '2', 6, '3alaf', 1, 'null', 'sdsd'),
(39, 15, 4, '10000', '49000', '5', 'france', '2000', '2022-07-21', '1000', 'تەن', 'عەلەف', 'Ranye', '8', 6, '3alaf', 1, 'null', '                                                                                                                                                                                                                                                                                                                                dcdf                                                                                                                                                                                                                                                '),
(40, 13, 2, '10000', '30000', '3', 'sdsd', '20000', '2022-07-21', '0', 'دانە', 'عەلەف', 'هەولێر', '2', 8, '3alaf', 1, 'null', '                                                                                                                                                                                                                                                                                                                sdsd                                                                                                                                                                                                                                    '),
(47, 19, 3, '10000', '20000', '2', 'سپی', '20000', '2022-07-21', '0', 'کیلۆ', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', '                                                dsdsdsd                                    '),
(48, 19, 3, '10000', '20000', '2', 'france', '20000', '2022-07-21', '0', 'کیلۆ', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', '                                                dsdsdsd                                    '),
(49, 10, 4, '10000', '230000', '23', 'hahahha', '20000', '2022-07-21', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', '                            '),
(51, 20, 3, '10000', '50000', '5', 'سپی', '20000', '2022-07-22', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', '                            '),
(59, 0, 3, '10000', '20000', '2', 'yyyyyyyyyyyyyyyyy', '20000', '2022-07-22', '0', 'دانە', 'عەلەف', 'هەولێر', '2', 6, '3alaf', 1, 'null', '                sdsdsd            '),
(60, 28, 3, '40000', '40000', '1', 'hahahha', '20000', '2022-07-22', '0', 'دانە', 'عەلەف', 'هەولێر', '2', 6, '3alaf', 1, 'null', '                sdsdsd            '),
(61, 0, 3, '90000', '270000', '3', 'yyyyyyyyyyyyyyyyy', '20000', '2022-07-22', '0', 'تەن', 'عەلەف', 'هەولێر', '3', 6, '3alaf', 1, 'null', '                sdsdsd            '),
(65, 22, 3, '10000', '10000', '1', 'hahahha', '30000', '2022-07-22', '0', 'تەن', 'عەلەف', 'هەولێر', '2', 5, '3alaf', -1, 'null', '                                                                sdsdsd                                                '),
(77, 28, 3, '40000', '40000', '1', 'hahahha', '20000', '2022-07-22', '0', 'دانە', 'qa3a', 'هەولێر', '2', 6, 'qa3a', 1, 'null', '                sdsdsd            '),
(78, 30, 2, '10000', '30000', '3', 'sale_qa3a', '20000', '2022-07-25', '0', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, 'null', 'sdsdsdsd'),
(79, 30, 2, '90000', '540000', '6', 'sale_qa3a', '20000', '2022-07-25', '0', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, 'null', 'sdsdsdsd'),
(80, 31, 4, '10000', '30000', '4', 'sale_qa3a', '20000', '2022-07-25', '10000', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, 'null', 'asasasas'),
(81, 31, 4, '90000', '530000', '6', 'sale_qa3a', '20000', '2022-07-25', '10000', 'دانە', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, 'null', 'asasasas'),
(82, 21, 4, '10000', '10000', '1', 'سپی', '20000', '2022-07-25', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', '                                فففففففففففففف                        '),
(83, 22, 2, '40000', '80000', '2', 'yyyyyyyyyyyyyyyyy', '20000', '2022-07-25', '0', 'کیلۆ', 'عەلەف', 'هەولێر', '2', 5, '3alaf', 1, 'null', '                                                                                sdsdsd                                                            '),
(84, 23, 4, '10000', '30000', '3', 'سپی', '20000', '2022-07-25', '0', 'دانە', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', '                                                                dfdfdfd                                                '),
(85, 23, 4, '90000', '89000', '1', 'تورکی', '20000', '2022-07-25', '1000', 'کیلۆ', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', '                                                                dfdfdfd                                                '),
(86, 23, 4, '10000', '80000', '8', 'سپی', '20000', '2022-07-25', '0', 'تەن', 'ئاسن', 'هەولێر', '', 0, 'asn', 1, 'null', '                                                                dfdfdfd                                                '),
(87, 33, 4, '10000', '20000', '2', 'sale_qa3a', '20000', '2022-07-25', '0', 'مەتر', 'qa3a', 'هەولێر', '', 0, 'qa3a', 1, 'null', 'sdsdsd'),
(88, 6, 2, '10000', '20000', '2', 'سپی', '20000', '2022-07-25', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', '                                    ffffffffffffffffffff                    '),
(89, 6, 2, '10000', '20000', '2', 'سپی', '10000', '2022-07-25', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', '                                    ffffffffffffffffffff                    '),
(90, 6, 2, '2000', '2000', '1', 'سپی', '1000', '2022-07-25', '0', 'دانە', 'هێلکە', '', '', 0, 'helka', 1, 'null', '                                    ffffffffffffffffffff                    ');

-- --------------------------------------------------------

--
-- Table structure for table `sale_category`
--

CREATE TABLE `sale_category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_category`
--

INSERT INTO `sale_category` (`id`, `name`, `invoice_id`) VALUES
(13, 'tawezeh', 27),
(14, 'hmm', 27),
(15, 'nweee', 28);

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
-- Table structure for table `sale_piece`
--

CREATE TABLE `sale_piece` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `piece_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sale_piece`
--

INSERT INTO `sale_piece` (`id`, `name`, `number`, `price`, `piece_id`, `invoice_id`) VALUES
(16, 'sadsds', 1, '1000', 26, 28),
(17, 'dddd', 5, '1000', 27, 28),
(24, 'updated', 2, '1000', 28, 28),
(26, 'kkkk', 2, '10000', 30, 29),
(27, 'sadsds', 2, '10000', 26, 29),
(28, 'dddd', 2, '10000', 27, 29),
(29, 'sadsds', 2, '10000', 26, 29),
(30, 'dddd', 2, '10000', 27, 29),
(31, 'kkkk', 2, '10000', 30, 31),
(32, 'sadsds', 2, '10000', 26, 33),
(33, 'dddd', 1, '10000', 27, 33);

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
(1, 'سیستەمی کۆمپانیای هۆگر', '62df13cd3a37e9.89325240.jpg');

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
('803e66cf58328d996f8fe6b8443f691d611e6f05e1215', 11, 17),
('5841582af603866bc63248daefcc952e614f52a093c7b', 12, 18),
('80401f1fc07c03d1221d72b75195e42c61f31d0f348e7', 14, 19),
('e1957e9353afd2ec9e463f6a5fde12dc621d0ae53a60b', 11, 20),
('3b06857b193042441bde3bbacfa48b18622217b0e8c00', 11, 21),
('2aff00c2c7b407e4dfdc4902f4a7961162224b78020d4', 11, 22),
('cf9899ab62f80c1d344e645b8f0775346223a97dd5529', 11, 23),
('ab24dd43574f5732ea29361f8da6bc2f6223e38ebd4cf', 11, 24),
('2dc3f83a06a46c607d24c7d9c856e99462260804e6cd4', 15, 25),
('06b42e58b0515daa2ff59413020e7c2362c741bf3b8a6', 11, 26),
('88b42b9f30865a8c7411b1518f9d02e562d80a8244e69', 11, 27),
('dc8f50a67b40d8e94910197ba567f94662d80abff2a21', 15, 28),
('049b294dab94853a6182073e0f15bb9062dbe22e25be7', 15, 29),
('40875a0bc9e4173be78afea1133080d262df06c65e142', 16, 30),
('ee190fb342fd9cb66a275b0ad01db93562df138f01806', 15, 31);

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
-- Indexes for table `company_invoice`
--
ALTER TABLE `company_invoice`
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
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_phone`
--
ALTER TABLE `invoice_phone`
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
-- Indexes for table `sale_piece`
--
ALTER TABLE `sale_piece`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id_budget` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `buy`
--
ALTER TABLE `buy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `company_invoice`
--
ALTER TABLE `company_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `debt`
--
ALTER TABLE `debt`
  MODIFY `id_debt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `invoice_phone`
--
ALTER TABLE `invoice_phone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `sale_category`
--
ALTER TABLE `sale_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sale_meter`
--
ALTER TABLE `sale_meter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sale_piece`
--
ALTER TABLE `sale_piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
