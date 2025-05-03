-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 12:21 PM
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
-- Database: `expomatrixdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Admin_Name` varchar(20) DEFAULT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Admin_Name`, `password`) VALUES
(1, 'harsh', 'harsh@123'),
(2, 'bhargav', 'bhargav@123'),
(3, 'hemangi', 'hemangi@123'),
(4, 'hensi', 'hensi@123');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Booking_id` int(11) NOT NULL,
  `Stall_id` int(11) DEFAULT NULL,
  `Vendor_id` int(11) DEFAULT NULL,
  `Organizer_id` int(11) NOT NULL,
  `Status` varchar(20) DEFAULT NULL CHECK (`Status` in ('pending','Approved','rejected')),
  `Booking_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Booking_id`, `Stall_id`, `Vendor_id`, `Organizer_id`, `Status`, `Booking_date`) VALUES
(1, 13, 1, 1, 'Approved', '2025-04-26'),
(2, 3, 1, 1, 'rejected', '2025-04-26'),
(3, 20, 1, 1, 'pending', '2025-04-26'),
(4, 4, 2, 2, 'pending', '2025-04-26'),
(5, 5, 2, 2, 'pending', '2025-04-26'),
(6, 16, 3, 3, 'Approved', '2025-04-26'),
(7, 9, 3, 3, 'Approved', '2025-04-26'),
(8, 8, 3, 3, 'pending', '2025-04-26'),
(9, 1, 4, 4, 'rejected', '2025-04-26'),
(10, 7, 4, 4, 'pending', '2025-04-26'),
(11, 21, 5, 5, 'Approved', '2025-04-26'),
(12, 6, 5, 5, 'pending', '2025-04-26'),
(13, 18, 5, 5, 'pending', '2025-04-26');

-- --------------------------------------------------------

--
-- Table structure for table `exhibition`
--

CREATE TABLE `exhibition` (
  `Exhibition_id` int(11) NOT NULL,
  `Venue_id` int(11) DEFAULT NULL,
  `Organizer_id` int(11) DEFAULT NULL,
  `Exhibition_Name` varchar(30) NOT NULL,
  `Types` varchar(100) NOT NULL,
  `From_date` datetime NOT NULL,
  `To_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exhibition`
--

INSERT INTO `exhibition` (`Exhibition_id`, `Venue_id`, `Organizer_id`, `Exhibition_Name`, `Types`, `From_date`, `To_date`) VALUES
(1, 1, 1, 'AutoExpo ', 'Automotive', '2025-04-27 00:00:00', '2025-04-30 00:00:00'),
(2, 2, 2, 'PlastIndia ', 'Plastics', '2025-05-01 00:00:00', '2025-05-04 00:00:00'),
(3, 3, 3, 'IndiaWood ', 'Woodworking', '2025-05-07 00:00:00', '2025-05-12 00:00:00'),
(4, 4, 4, 'AcrexIndia ', 'HVAC&R (Cooling)', '2025-05-17 00:00:00', '2025-05-18 00:00:00'),
(5, 5, 5, 'FoodTech ', 'Foodprocessing', '2025-05-24 00:00:00', '2025-05-28 00:00:00'),
(6, 6, 1, 'magic of jwellery ', 'jwellwey', '2025-04-27 00:00:00', '2025-04-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`First_Name`, `Last_Name`, `Email`, `Message`) VALUES
('Harsh', 'Visaveliya', 'harshvisaveliya04@gmail.com', 'Hello! Food Expo was Amazing'),
('Abhi', 'Malaviya', 'abhi799@gmail.com', 'Enjoyed a lot at cooling expo');

-- --------------------------------------------------------

--
-- Table structure for table `layout`
--

CREATE TABLE `layout` (
  `Layout_id` int(11) NOT NULL,
  `Exhibition_id` int(11) DEFAULT NULL,
  `Length` decimal(30,0) NOT NULL,
  `Width` decimal(50,0) NOT NULL,
  `Area` decimal(50,0) NOT NULL,
  `Entry_point` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Entry_point`)),
  `Exit_point` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Exit_point`)),
  `layout_json` longtext DEFAULT NULL COMMENT 'Full JSON layout data',
  `grid_size` decimal(5,2) DEFAULT NULL,
  `layout_scale` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `layout`
--

INSERT INTO `layout` (`Layout_id`, `Exhibition_id`, `Length`, `Width`, `Area`, `Entry_point`, `Exit_point`, `layout_json`, `grid_size`, `layout_scale`) VALUES
(1, 1, 15, 15, 225, '{\"x\":11.4,\"y\":0,\"width\":0.8,\"height\":0.8}', '{\"x\":11.4,\"y\":14.2,\"width\":0.8,\"height\":0.8}', '{\"dimensions\":{\"width\":15,\"height\":15,\"area\":225,\"scaleFactor\":50,\"pixelsPerMeter\":50},\"settings\":{\"smallStallSize\":2,\"largeStallSize\":3,\"staffSpace\":0.8,\"gateWidth\":0.8,\"walkingSpace\":0.8,\"stallGap\":0.4},\"entryPoint\":{\"x\":11.4,\"y\":0,\"width\":0.8,\"height\":0.8},\"exitPoint\":{\"x\":11.4,\"y\":14.2,\"width\":0.8,\"height\":0.8},\"stalls\":[{\"id\":\"stall-0\",\"name\":\"AUTO-02\",\"position\":{\"left\":3.4499999999999997,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-02\"},{\"id\":\"stall-1\",\"name\":\"AUTO-03\",\"position\":{\"left\":6.1,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-03\"},{\"id\":\"stall-2\",\"name\":\"AUTO-04\",\"position\":{\"left\":8.75,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-04\"},{\"id\":\"stall-3\",\"name\":\"AUTO-12\",\"position\":{\"left\":3.4499999999999997,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-12\"},{\"id\":\"stall-4\",\"name\":\"AUTO-11\",\"position\":{\"left\":6.1,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-11\"},{\"id\":\"stall-5\",\"name\":\"AUTO-10\",\"position\":{\"left\":8.75,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-10\"},{\"id\":\"stall-6\",\"name\":\"AUTO-16\",\"position\":{\"left\":0.8,\"top\":3.65,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-16\"},{\"id\":\"stall-7\",\"name\":\"AUTO-15\",\"position\":{\"left\":0.8,\"top\":6.5,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-15\"},{\"id\":\"stall-8\",\"name\":\"AUTO-14\",\"position\":{\"left\":0.8,\"top\":9.35,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-14\"},{\"id\":\"stall-9\",\"name\":\"AUTO-06\",\"position\":{\"left\":12.2,\"top\":3.65,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-06\"},{\"id\":\"stall-10\",\"name\":\"AUTO-07\",\"position\":{\"left\":12.2,\"top\":6.5,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-07\"},{\"id\":\"stall-11\",\"name\":\"AUTO-08\",\"position\":{\"left\":12.2,\"top\":9.35,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-08\"},{\"id\":\"stall-12\",\"name\":\"AUTO-01\",\"position\":{\"left\":0.8,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-01\"},{\"id\":\"stall-13\",\"name\":\"AUTO-05\",\"position\":{\"left\":12.2,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-05\"},{\"id\":\"stall-14\",\"name\":\"AUTO-13\",\"position\":{\"left\":0.8,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-13\"},{\"id\":\"stall-15\",\"name\":\"AUTO-09\",\"position\":{\"left\":12.2,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"AUTO-09\"},{\"id\":\"stall-16\",\"name\":\"AUTO-17\",\"position\":{\"left\":4.2,\"top\":4.2,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"AUTO-17\"},{\"id\":\"stall-17\",\"name\":\"AUTO-18\",\"position\":{\"left\":7.800000000000001,\"top\":4.2,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"AUTO-18\"},{\"id\":\"stall-18\",\"name\":\"AUTO-20\",\"position\":{\"left\":4.2,\"top\":7.800000000000001,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"AUTO-20\"},{\"id\":\"stall-19\",\"name\":\"AUTO-19\",\"position\":{\"left\":7.800000000000001,\"top\":7.800000000000001,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"AUTO-19\"}],\"statistics\":{\"totalStalls\":20,\"smallStallsCount\":16,\"largeStallsCount\":4,\"totalStallArea\":100,\"walkingArea\":79.56}}', 2.00, 50.00),
(2, 2, 16, 16, 256, '[{\"id\":\"gate-1745639973462\",\"type\":\"ENTRY\",\"position\":{\"left\":3.6,\"top\":0,\"width\":1.2,\"height\":0.4}}]', '[{\"id\":\"gate-1745639992116\",\"type\":\"EXIT\",\"position\":{\"left\":12.200000000000001,\"top\":15.599999999999998,\"width\":1.2,\"height\":0.4}}]', '{\"dimensions\":{\"width\":16,\"height\":16},\"elements\":{\"stalls\":[{\"id\":\"stall-1745640036993\",\"name\":\"PLST-01\",\"size\":3,\"position\":{\"left\":6.1000000000000005,\"top\":0.7000000000000002,\"width\":3,\"height\":3}},{\"id\":\"stall-1745640044110\",\"name\":\"PLST-02\",\"size\":3,\"position\":{\"left\":9.700000000000001,\"top\":0.7000000000000002,\"width\":3,\"height\":3}},{\"id\":\"stall-1745640076945\",\"name\":\"PLST-03\",\"size\":4,\"position\":{\"left\":0.6000000000000001,\"top\":5,\"width\":4,\"height\":4}},{\"id\":\"stall-1745640104738\",\"name\":\"PLST-04\",\"size\":4,\"position\":{\"left\":0.6000000000000001,\"top\":9.799999999999995,\"width\":4,\"height\":4}},{\"id\":\"stall-1745640123314\",\"name\":\"PLST-05\",\"size\":5,\"position\":{\"left\":6.300000000000001,\"top\":6.300000000000001,\"width\":5,\"height\":5}}],\"gates\":[{\"id\":\"gate-1745639973462\",\"type\":\"ENTRY\",\"position\":{\"left\":3.6,\"top\":0,\"width\":1.2,\"height\":0.4}},{\"id\":\"gate-1745639992116\",\"type\":\"EXIT\",\"position\":{\"left\":12.200000000000001,\"top\":15.599999999999998,\"width\":1.2,\"height\":0.4}}]}}', 0.20, 50.00),
(3, 3, 15, 20, 300, '{\"x\":15.4,\"y\":0,\"width\":0.8,\"height\":0.8}', '{\"x\":15.4,\"y\":14.2,\"width\":0.8,\"height\":0.8}', '{\"dimensions\":{\"width\":20,\"height\":15,\"area\":300,\"scaleFactor\":50,\"pixelsPerMeter\":50},\"settings\":{\"smallStallSize\":3,\"largeStallSize\":4,\"staffSpace\":0.8,\"gateWidth\":0.8,\"walkingSpace\":0.8,\"stallGap\":0.4},\"entryPoint\":{\"x\":15.4,\"y\":0,\"width\":0.8,\"height\":0.8},\"exitPoint\":{\"x\":15.4,\"y\":14.2,\"width\":0.8,\"height\":0.8},\"stalls\":[{\"id\":\"stall-0\",\"name\":\"WOOD-02\",\"position\":{\"left\":4.449999999999999,\"top\":0.8,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-02\"},{\"id\":\"stall-1\",\"name\":\"WOOD-03\",\"position\":{\"left\":8.099999999999998,\"top\":0.8,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-03\"},{\"id\":\"stall-2\",\"name\":\"WOOD-04\",\"position\":{\"left\":11.749999999999996,\"top\":0.8,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-04\"},{\"id\":\"stall-3\",\"name\":\"WOOD-11\",\"position\":{\"left\":4.449999999999999,\"top\":11.2,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-11\"},{\"id\":\"stall-4\",\"name\":\"WOOD-10\",\"position\":{\"left\":8.099999999999998,\"top\":11.2,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-10\"},{\"id\":\"stall-5\",\"name\":\"WOOD-09\",\"position\":{\"left\":11.749999999999996,\"top\":11.2,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-09\"},{\"id\":\"stall-6\",\"name\":\"WOOD-14\",\"position\":{\"left\":0.8,\"top\":4.266666666666667,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-14\"},{\"id\":\"stall-7\",\"name\":\"WOOD-13\",\"position\":{\"left\":0.8,\"top\":7.733333333333333,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-13\"},{\"id\":\"stall-8\",\"name\":\"WOOD-06\",\"position\":{\"left\":16.2,\"top\":4.266666666666667,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-06\"},{\"id\":\"stall-9\",\"name\":\"WOOD-07\",\"position\":{\"left\":16.2,\"top\":7.733333333333333,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-07\"},{\"id\":\"stall-10\",\"name\":\"WOOD-01\",\"position\":{\"left\":0.8,\"top\":0.8,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-01\"},{\"id\":\"stall-11\",\"name\":\"WOOD-05\",\"position\":{\"left\":16.2,\"top\":0.8,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-05\"},{\"id\":\"stall-12\",\"name\":\"WOOD-12\",\"position\":{\"left\":0.8,\"top\":11.2,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-12\"},{\"id\":\"stall-13\",\"name\":\"WOOD-08\",\"position\":{\"left\":16.2,\"top\":11.2,\"width\":3,\"height\":3},\"isSmall\":true,\"size\":3,\"type\":\"WOOD-08\"},{\"id\":\"stall-14\",\"name\":\"WOOD-15\",\"position\":{\"left\":5.533333333333333,\"top\":5.5,\"width\":4,\"height\":4},\"isSmall\":false,\"size\":4,\"type\":\"WOOD-15\"},{\"id\":\"stall-15\",\"name\":\"WOOD-16\",\"position\":{\"left\":10.466666666666667,\"top\":5.5,\"width\":4,\"height\":4},\"isSmall\":false,\"size\":4,\"type\":\"WOOD-16\"}],\"statistics\":{\"totalStalls\":16,\"smallStallsCount\":14,\"largeStallsCount\":2,\"totalStallArea\":158,\"walkingArea\":88.56}}', 3.00, 50.00),
(4, 4, 12, 12, 144, '[{\"id\":\"gate-1745640629883\",\"type\":\"ENTRY\",\"position\":{\"left\":0,\"top\":3.2000000000000006,\"width\":1.2,\"height\":0.4}}]', '[{\"id\":\"gate-1745640656738\",\"type\":\"EXIT\",\"position\":{\"left\":0,\"top\":8.799999999999999,\"width\":1.2,\"height\":0.4}}]', '{\"dimensions\":{\"width\":12,\"height\":12},\"elements\":{\"stalls\":[{\"id\":\"stall-1745640699744\",\"name\":\"ACRX-01\",\"size\":2,\"position\":{\"left\":2.4000000000000004,\"top\":0.40000000000000013,\"width\":2,\"height\":2}},{\"id\":\"stall-1745640719514\",\"name\":\"ACRX-02\",\"size\":2,\"position\":{\"left\":4.800000000000001,\"top\":0.40000000000000013,\"width\":2,\"height\":2}},{\"id\":\"stall-1745640727957\",\"name\":\"ACRX-03\",\"size\":2,\"position\":{\"left\":7.200000000000001,\"top\":0.40000000000000013,\"width\":2,\"height\":2}},{\"id\":\"stall-1745640735851\",\"name\":\"ACRX-04\",\"size\":2,\"position\":{\"left\":9.600000000000001,\"top\":0.40000000000000013,\"width\":2,\"height\":2}},{\"id\":\"stall-1745640747666\",\"name\":\"ACRX-05\",\"size\":4,\"position\":{\"left\":7.4,\"top\":3.6000000000000005,\"width\":4,\"height\":4}},{\"id\":\"stall-1745640755762\",\"name\":\"ACRX-06\",\"size\":3,\"position\":{\"left\":7.4,\"top\":8.4,\"width\":3,\"height\":3}},{\"id\":\"stall-1745640782522\",\"name\":\"ACRX-07\",\"size\":3,\"position\":{\"left\":3.2,\"top\":8.4,\"width\":3,\"height\":3}}],\"gates\":[{\"id\":\"gate-1745640629883\",\"type\":\"ENTRY\",\"position\":{\"left\":0,\"top\":3.2000000000000006,\"width\":1.2,\"height\":0.4}},{\"id\":\"gate-1745640656738\",\"type\":\"EXIT\",\"position\":{\"left\":0,\"top\":8.799999999999999,\"width\":1.2,\"height\":0.4}}]}}', 0.20, 50.00),
(5, 5, 15, 20, 300, '{\"x\":16.4,\"y\":0,\"width\":0.8,\"height\":0.8}', '{\"x\":16.4,\"y\":14.2,\"width\":0.8,\"height\":0.8}', '{\"dimensions\":{\"width\":20,\"height\":15,\"area\":300,\"scaleFactor\":50,\"pixelsPerMeter\":50},\"settings\":{\"smallStallSize\":2,\"largeStallSize\":3,\"staffSpace\":0.8,\"gateWidth\":0.8,\"walkingSpace\":0.8,\"stallGap\":0.4},\"entryPoint\":{\"x\":16.4,\"y\":0,\"width\":0.8,\"height\":0.8},\"exitPoint\":{\"x\":16.4,\"y\":14.2,\"width\":0.8,\"height\":0.8},\"stalls\":[{\"id\":\"stall-0\",\"name\":\"FOOD-02\",\"position\":{\"left\":3.3999999999999995,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-02\"},{\"id\":\"stall-1\",\"name\":\"FOOD-03\",\"position\":{\"left\":5.999999999999999,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-03\"},{\"id\":\"stall-2\",\"name\":\"FOOD-04\",\"position\":{\"left\":8.599999999999998,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-04\"},{\"id\":\"stall-3\",\"name\":\"FOOD-05\",\"position\":{\"left\":11.199999999999998,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-05\"},{\"id\":\"stall-4\",\"name\":\"FOOD-06\",\"position\":{\"left\":13.799999999999997,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-06\"},{\"id\":\"stall-5\",\"name\":\"FOOD-16\",\"position\":{\"left\":3.3999999999999995,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-16\"},{\"id\":\"stall-6\",\"name\":\"FOOD-15\",\"position\":{\"left\":5.999999999999999,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-15\"},{\"id\":\"stall-7\",\"name\":\"FOOD-14\",\"position\":{\"left\":8.599999999999998,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-14\"},{\"id\":\"stall-8\",\"name\":\"FOOD-13\",\"position\":{\"left\":11.199999999999998,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-13\"},{\"id\":\"stall-9\",\"name\":\"FOOD-12\",\"position\":{\"left\":13.799999999999997,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-12\"},{\"id\":\"stall-10\",\"name\":\"FOOD-20\",\"position\":{\"left\":0.8,\"top\":3.65,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-20\"},{\"id\":\"stall-11\",\"name\":\"FOOD-19\",\"position\":{\"left\":0.8,\"top\":6.5,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-19\"},{\"id\":\"stall-12\",\"name\":\"FOOD-18\",\"position\":{\"left\":0.8,\"top\":9.35,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-18\"},{\"id\":\"stall-13\",\"name\":\"FOOD-08\",\"position\":{\"left\":17.2,\"top\":3.65,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-08\"},{\"id\":\"stall-14\",\"name\":\"FOOD-09\",\"position\":{\"left\":17.2,\"top\":6.5,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-09\"},{\"id\":\"stall-15\",\"name\":\"FOOD-10\",\"position\":{\"left\":17.2,\"top\":9.35,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-10\"},{\"id\":\"stall-16\",\"name\":\"FOOD-01\",\"position\":{\"left\":0.8,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-01\"},{\"id\":\"stall-17\",\"name\":\"FOOD-07\",\"position\":{\"left\":17.2,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-07\"},{\"id\":\"stall-18\",\"name\":\"FOOD-17\",\"position\":{\"left\":0.8,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-17\"},{\"id\":\"stall-19\",\"name\":\"FOOD-11\",\"position\":{\"left\":17.2,\"top\":12.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"FOOD-11\"},{\"id\":\"stall-20\",\"name\":\"FOOD-21\",\"position\":{\"left\":4.55,\"top\":4.2,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"FOOD-21\"},{\"id\":\"stall-21\",\"name\":\"FOOD-22\",\"position\":{\"left\":8.5,\"top\":4.2,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"FOOD-22\"},{\"id\":\"stall-22\",\"name\":\"FOOD-23\",\"position\":{\"left\":12.45,\"top\":4.2,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"FOOD-23\"},{\"id\":\"stall-23\",\"name\":\"FOOD-26\",\"position\":{\"left\":4.55,\"top\":7.800000000000001,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"FOOD-26\"},{\"id\":\"stall-24\",\"name\":\"FOOD-25\",\"position\":{\"left\":8.5,\"top\":7.800000000000001,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"FOOD-25\"},{\"id\":\"stall-25\",\"name\":\"FOOD-24\",\"position\":{\"left\":12.45,\"top\":7.800000000000001,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"FOOD-24\"}],\"statistics\":{\"totalStalls\":26,\"smallStallsCount\":20,\"largeStallsCount\":6,\"totalStallArea\":134,\"walkingArea\":112.56}}', 2.00, 50.00),
(6, 6, 12, 12, 144, '{\"x\":8.4,\"y\":0,\"width\":0.8,\"height\":0.8}', '{\"x\":8.4,\"y\":11.2,\"width\":0.8,\"height\":0.8}', '{\"dimensions\":{\"width\":12,\"height\":12,\"area\":144,\"scaleFactor\":50,\"pixelsPerMeter\":50},\"settings\":{\"smallStallSize\":2,\"largeStallSize\":3,\"staffSpace\":0.8,\"gateWidth\":0.8,\"walkingSpace\":0.8,\"stallGap\":0.4},\"entryPoint\":{\"x\":8.4,\"y\":0,\"width\":0.8,\"height\":0.8},\"exitPoint\":{\"x\":8.4,\"y\":11.2,\"width\":0.8,\"height\":0.8},\"stalls\":[{\"id\":\"stall-0\",\"name\":\"Stall T1\",\"position\":{\"left\":3.333333333333333,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall T1\"},{\"id\":\"stall-1\",\"name\":\"Stall T2\",\"position\":{\"left\":5.866666666666666,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall T2\"},{\"id\":\"stall-2\",\"name\":\"Stall B1\",\"position\":{\"left\":3.333333333333333,\"top\":9.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall B1\"},{\"id\":\"stall-3\",\"name\":\"Stall B2\",\"position\":{\"left\":5.866666666666666,\"top\":9.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall B2\"},{\"id\":\"stall-4\",\"name\":\"Stall L1\",\"position\":{\"left\":0.8,\"top\":3.6,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall L1\"},{\"id\":\"stall-5\",\"name\":\"Stall L2\",\"position\":{\"left\":0.8,\"top\":6.4,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall L2\"},{\"id\":\"stall-6\",\"name\":\"Stall R1\",\"position\":{\"left\":9.2,\"top\":3.6,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall R1\"},{\"id\":\"stall-7\",\"name\":\"Stall R2\",\"position\":{\"left\":9.2,\"top\":6.4,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall R2\"},{\"id\":\"stall-8\",\"name\":\"Stall TL\",\"position\":{\"left\":0.8,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall TL\"},{\"id\":\"stall-9\",\"name\":\"Stall TR\",\"position\":{\"left\":9.2,\"top\":0.8,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall TR\"},{\"id\":\"stall-10\",\"name\":\"Stall BL\",\"position\":{\"left\":0.8,\"top\":9.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall BL\"},{\"id\":\"stall-11\",\"name\":\"Stall BR\",\"position\":{\"left\":9.2,\"top\":9.2,\"width\":2,\"height\":2},\"isSmall\":true,\"size\":2,\"type\":\"Stall BR\"},{\"id\":\"stall-12\",\"name\":\"Stall M1-1\",\"position\":{\"left\":4.5,\"top\":4.5,\"width\":3,\"height\":3},\"isSmall\":false,\"size\":3,\"type\":\"Stall M1-1\"}],\"statistics\":{\"totalStalls\":13,\"smallStallsCount\":12,\"largeStallsCount\":1,\"totalStallArea\":57,\"walkingArea\":51.16}}', 2.00, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE `organizer` (
  `Organizer_id` int(11) NOT NULL,
  `User_Name` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `Full_Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone_Number` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`Organizer_id`, `User_Name`, `password`, `Full_Name`, `Email`, `Phone_Number`) VALUES
(1, 'sahil', 'sahil@123', 'sahil akoliya', 'sahil200@gmail.com', 7896325410),
(2, 'harsh', 'harsh@123', 'harsh mangukiya', 'harshvisaveliya04@gmail.com', 9023841284),
(3, 'nancy', 'nancy@123', 'nancy ramani', 'nancy555@gmail.com', 1203697845),
(4, 'meet', 'meet@123', 'meet gajera', 'meet333@gmail.com', 6983214570),
(5, 'akshar', 'akshar@123', 'akshar lad', 'akshar444@gmail.com', 2014789365);

-- --------------------------------------------------------

--
-- Table structure for table `stalls`
--

CREATE TABLE `stalls` (
  `Stall_id` int(11) NOT NULL,
  `Layout_id` int(11) DEFAULT NULL,
  `Size` varchar(20) NOT NULL,
  `Stall_type` varchar(20) NOT NULL,
  `Price` decimal(20,0) NOT NULL,
  `Status` varchar(30) DEFAULT NULL CHECK (`Status` in ('available','booked'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stalls`
--

INSERT INTO `stalls` (`Stall_id`, `Layout_id`, `Size`, `Stall_type`, `Price`, `Status`) VALUES
(1, 1, '2x2', 'AUTO-02', 800, 'available'),
(2, 1, '2x2', 'AUTO-03', 800, 'available'),
(3, 1, '2x2', 'AUTO-04', 800, 'available'),
(4, 1, '2x2', 'AUTO-12', 800, 'available'),
(5, 1, '2x2', 'AUTO-11', 800, 'available'),
(6, 1, '2x2', 'AUTO-10', 800, 'available'),
(7, 1, '2x2', 'AUTO-16', 800, 'available'),
(8, 1, '2x2', 'AUTO-15', 800, 'available'),
(9, 1, '2x2', 'AUTO-14', 800, 'booked'),
(10, 1, '2x2', 'AUTO-06', 800, 'available'),
(11, 1, '2x2', 'AUTO-07', 800, 'available'),
(12, 1, '2x2', 'AUTO-08', 800, 'available'),
(13, 1, '2x2', 'AUTO-01', 800, 'booked'),
(14, 1, '2x2', 'AUTO-05', 800, 'available'),
(15, 1, '2x2', 'AUTO-13', 800, 'available'),
(16, 1, '2x2', 'AUTO-09', 800, 'booked'),
(17, 1, '3x3', 'AUTO-17', 800, 'available'),
(18, 1, '3x3', 'AUTO-18', 800, 'available'),
(19, 1, '3x3', 'AUTO-20', 800, 'available'),
(20, 1, '3x3', 'AUTO-19', 800, 'available'),
(21, 2, '3', 'PLST-01', 3000, 'booked'),
(22, 2, '3', 'PLST-02', 3000, 'available'),
(23, 2, '4', 'PLST-03', 4000, 'available'),
(24, 2, '4', 'PLST-04', 4000, 'available'),
(25, 2, '5', 'PLST-05', 5000, 'available'),
(26, 3, '3x3', 'WOOD-02', 800, 'available'),
(27, 3, '3x3', 'WOOD-03', 800, 'available'),
(28, 3, '3x3', 'WOOD-04', 800, 'available'),
(29, 3, '3x3', 'WOOD-11', 800, 'available'),
(30, 3, '3x3', 'WOOD-10', 800, 'available'),
(31, 3, '3x3', 'WOOD-09', 800, 'available'),
(32, 3, '3x3', 'WOOD-14', 800, 'available'),
(33, 3, '3x3', 'WOOD-13', 800, 'available'),
(34, 3, '3x3', 'WOOD-06', 800, 'available'),
(35, 3, '3x3', 'WOOD-07', 800, 'available'),
(36, 3, '3x3', 'WOOD-01', 800, 'available'),
(37, 3, '3x3', 'WOOD-05', 800, 'available'),
(38, 3, '3x3', 'WOOD-12', 800, 'available'),
(39, 3, '3x3', 'WOOD-08', 800, 'available'),
(40, 3, '4x4', 'WOOD-15', 800, 'available'),
(41, 3, '4x4', 'WOOD-16', 800, 'available'),
(42, 4, '2', 'ACRX-01', 2000, 'available'),
(43, 4, '2', 'ACRX-02', 2000, 'available'),
(44, 4, '2', 'ACRX-03', 2000, 'available'),
(45, 4, '2', 'ACRX-04', 2000, 'available'),
(46, 4, '4', 'ACRX-05', 4000, 'available'),
(47, 4, '3', 'ACRX-06', 3000, 'available'),
(48, 4, '3', 'ACRX-07', 3000, 'available'),
(49, 5, '2x2', 'FOOD-02', 800, 'available'),
(50, 5, '2x2', 'FOOD-03', 800, 'available'),
(51, 5, '2x2', 'FOOD-04', 800, 'available'),
(52, 5, '2x2', 'FOOD-05', 800, 'available'),
(53, 5, '2x2', 'FOOD-06', 800, 'available'),
(54, 5, '2x2', 'FOOD-16', 800, 'available'),
(55, 5, '2x2', 'FOOD-15', 800, 'available'),
(56, 5, '2x2', 'FOOD-14', 800, 'available'),
(57, 5, '2x2', 'FOOD-13', 800, 'available'),
(58, 5, '2x2', 'FOOD-12', 800, 'available'),
(59, 5, '2x2', 'FOOD-20', 800, 'available'),
(60, 5, '2x2', 'FOOD-19', 800, 'available'),
(61, 5, '2x2', 'FOOD-18', 800, 'available'),
(62, 5, '2x2', 'FOOD-08', 800, 'available'),
(63, 5, '2x2', 'FOOD-09', 800, 'available'),
(64, 5, '2x2', 'FOOD-10', 800, 'available'),
(65, 5, '2x2', 'FOOD-01', 800, 'available'),
(66, 5, '2x2', 'FOOD-07', 800, 'available'),
(67, 5, '2x2', 'FOOD-17', 800, 'available'),
(68, 5, '2x2', 'FOOD-11', 800, 'available'),
(69, 5, '3x3', 'FOOD-21', 800, 'available'),
(70, 5, '3x3', 'FOOD-22', 800, 'available'),
(71, 5, '3x3', 'FOOD-23', 800, 'available'),
(72, 5, '3x3', 'FOOD-26', 800, 'available'),
(73, 5, '3x3', 'FOOD-25', 800, 'available'),
(74, 5, '3x3', 'FOOD-24', 800, 'available'),
(75, 6, '2x2', 'Stall T1', 800, 'available'),
(76, 6, '2x2', 'Stall T2', 800, 'available'),
(77, 6, '2x2', 'Stall B1', 800, 'available'),
(78, 6, '2x2', 'Stall B2', 800, 'available'),
(79, 6, '2x2', 'Stall L1', 800, 'available'),
(80, 6, '2x2', 'Stall L2', 800, 'available'),
(81, 6, '2x2', 'Stall R1', 800, 'available'),
(82, 6, '2x2', 'Stall R2', 800, 'available'),
(83, 6, '2x2', 'Stall TL', 800, 'available'),
(84, 6, '2x2', 'Stall TR', 800, 'available'),
(85, 6, '2x2', 'Stall BL', 800, 'available'),
(86, 6, '2x2', 'Stall BR', 800, 'available'),
(87, 6, '3x3', 'Stall M1-1', 800, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `Vendor_id` int(11) NOT NULL,
  `User_Name` varchar(30) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `Full_Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone_Number` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`Vendor_id`, `User_Name`, `password`, `Full_Name`, `Email`, `Phone_Number`) VALUES
(1, 'prince', 'prince@123', 'prince dhaduk', 'harshvisaveliya04@gmail.com', 3698741250),
(2, 'darshan', 'darshan@123', 'darshan korat', 'darshan000@gmail.com', 8520369741),
(3, 'nirav', 'nirav@123', 'nirav visaveliya', 'nirav999@gmail.com', 3012674589),
(4, 'abhi', 'abhi@123', 'abhi malaviya', 'abhi799@gmail.com', 5012364789),
(5, 'ugam', 'ugam@123', 'ugam bhesdadiya', 'ugam255@gmail.com', 9023547831);

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `Venue_id` int(11) NOT NULL,
  `Venue_name` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`Venue_id`, `Venue_name`, `location`) VALUES
(1, 'Pragati Maidan', 'Delhi'),
(2, 'Bangalore International Exhibition Centre', 'Bangalore'),
(3, 'Bombay Exhibition Centre', 'Mumbai'),
(4, 'Hitex ', 'Hyderabad'),
(5, 'Codissia ', 'Coimbatore'),
(6, 'helipadground', 'gandinagar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`),
  ADD UNIQUE KEY `Admin_Name` (`Admin_Name`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Booking_id`),
  ADD KEY `Stall_id` (`Stall_id`),
  ADD KEY `Vendor_id` (`Vendor_id`),
  ADD KEY `owner_of_stall` (`Organizer_id`);

--
-- Indexes for table `exhibition`
--
ALTER TABLE `exhibition`
  ADD PRIMARY KEY (`Exhibition_id`),
  ADD KEY `Venue_id` (`Venue_id`),
  ADD KEY `Organizer_id` (`Organizer_id`);

--
-- Indexes for table `layout`
--
ALTER TABLE `layout`
  ADD PRIMARY KEY (`Layout_id`),
  ADD KEY `Exhibition_id` (`Exhibition_id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
  ADD PRIMARY KEY (`Organizer_id`),
  ADD UNIQUE KEY `User_Name` (`User_Name`);

--
-- Indexes for table `stalls`
--
ALTER TABLE `stalls`
  ADD PRIMARY KEY (`Stall_id`),
  ADD KEY `Layout_id` (`Layout_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`Vendor_id`),
  ADD UNIQUE KEY `User_Name` (`User_Name`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`Venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exhibition`
--
ALTER TABLE `exhibition`
  MODIFY `Exhibition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `layout`
--
ALTER TABLE `layout`
  MODIFY `Layout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
  MODIFY `Organizer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stalls`
--
ALTER TABLE `stalls`
  MODIFY `Stall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `Vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `Venue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`Stall_id`) REFERENCES `stalls` (`Stall_id`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`Vendor_id`) REFERENCES `vendor` (`Vendor_id`),
  ADD CONSTRAINT `owner_of_stall` FOREIGN KEY (`Organizer_id`) REFERENCES `organizer` (`Organizer_id`);

--
-- Constraints for table `exhibition`
--
ALTER TABLE `exhibition`
  ADD CONSTRAINT `exhibition_ibfk_1` FOREIGN KEY (`Venue_id`) REFERENCES `venues` (`Venue_id`),
  ADD CONSTRAINT `exhibition_ibfk_2` FOREIGN KEY (`Organizer_id`) REFERENCES `organizer` (`Organizer_id`);

--
-- Constraints for table `layout`
--
ALTER TABLE `layout`
  ADD CONSTRAINT `layout_ibfk_1` FOREIGN KEY (`Exhibition_id`) REFERENCES `exhibition` (`Exhibition_id`);

--
-- Constraints for table `stalls`
--
ALTER TABLE `stalls`
  ADD CONSTRAINT `stalls_ibfk_1` FOREIGN KEY (`Layout_id`) REFERENCES `layout` (`Layout_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
