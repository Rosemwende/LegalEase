-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 08:39 AM
-- Server version: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rose project`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `administrator_id` varchar(20) NOT NULL,
  `city` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`administrator_id`, `city`, `address`) VALUES
('Admin010101', 'Nairobi', '00100-Nairobi');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `client_id` varchar(20) NOT NULL,
  `lawyer_id` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `date`, `description`, `client_id`, `lawyer_id`, `status`) VALUES
(12, '2024-08-15', 'criminal case.', '66aadd7a536ae', '66aadc84ac71a', 'Pending'),
(13, '2024-08-22', 'company case', '66aadd7a536ae', '66aadcf2a5934', 'Accepted'),
(14, '2024-09-27', 'Writ Jurisdiction', '66aadd2fa5a97', '66aadc84ac71a', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` varchar(20) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `full_address` varchar(200) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `contact_number`, `full_address`, `city`, `zip_code`, `image`) VALUES
('66aadd2fa5a97', '0768908765', '00100-Nairobi', 'Nairobi', '00100', '20240517183326_6.jpg'),
('66aadd7a536ae', '0765432189', '800100-mombasa', 'Mombasa', '80100', '20240522073116_12.jpg'),
('66aae354f2143', '0765434567', '00100-Nairobi', 'Nairobi', '00100', '20240624152827_9.jpg'),
('66aae4502f425', '0765434567', '00100-Nairobi', 'Nairobi', '00100', '20240624152827_9.jpg'),
('66aae6864d3bf', '0765435678', '80100-mombasa', 'Mombasa', '80100-mombasa', '20240517183326_6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lawyer`
--

CREATE TABLE `lawyer` (
  `lawyer_id` varchar(20) NOT NULL,
  `contact_Number` varchar(15) NOT NULL,
  `university_College` varchar(50) NOT NULL,
  `degree` varchar(50) NOT NULL,
  `passing_year` varchar(40) NOT NULL,
  `full_address` varchar(50) NOT NULL,
  `city` varchar(40) NOT NULL,
  `zip_code` varchar(50) NOT NULL,
  `practise_Length` varchar(50) NOT NULL,
  `case_handle` varchar(200) NOT NULL,
  `speciality` varchar(100) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lawyer`
--

INSERT INTO `lawyer` (`lawyer_id`, `contact_Number`, `university_College`, `degree`, `passing_year`, `full_address`, `city`, `zip_code`, `practise_Length`, `case_handle`, `speciality`, `image`) VALUES
('66aad3ef2daf4', '0789098765', 'vgxdvswhb', 'LLM', '2008', '00100-Nairobi', 'Nairobi', '00100', '11-15 years', 'Writ Jurisdiction, Company law, Contract law, Commercial matter', 'Writ Jurisdiction', '3.jpg'),
('66aadcf2a5934', '0765674890', 'hwebs', 'LLM', '2009', '80100-mombasa', 'Mombasa', '80100-mombasa', '11-15 years', 'Company law, Contract law, Commercial matter', 'Company Law', '20240517175158_5.jpg'),
('66aae7c767dcf', '0789987654', 'ged23dd2', 'LLB', '2010', 'hgewf@gmail.com', 'Nairobi', '00100-Nairobi', 'Most Senior', 'Writ Jurisdiction, Company law, Contract law, Commercial matter', 'Company Law', '20240522073116_12.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `u_id` varchar(20) NOT NULL,
  `first_Name` varchar(50) NOT NULL,
  `last_Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`u_id`, `first_Name`, `last_Name`, `email`, `password`, `status`, `role`) VALUES
('66aadcf2a5934', 'jweiehsujcb', 'qwsnhjwbd ', 'gedt@gmail.com', 'Om*vZdwn', 'Active', 'Lawyer'),
('66aadd2fa5a97', 'lamskncb', 'knsjbdd v', 'hgsdadf@gmail.com', 'c1sH0%vA', 'Active', 'Client'),
('66aadd7a536ae', 'djdges', 'lmjshdwujak', 'jbn@gmail.com', 'I#NkQAmG', 'Active', 'Client'),
('66aae354f2143', 'whdgvxwsx', 'jnwshw nbdxhwsg', 'whwb@gmail.com', 'DKr2Z4B&', 'Active', 'Client'),
('66aae4502f425', 'whdgvxwsx', 'jnwshw nbdxhwsg', 'whwb@gmail.com', 'bvB)CspM', 'Active', 'Client'),
('66aae7c767dcf', 'dbwedshbz', 'hvgxwshj', 'gthy@gmail.com', 'tTdTFIv8', 'Active', 'Lawyer'),
('Admin010101', 'admin', 'admin', 'admin@gmail.com', 'admin', 'Active', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`administrator_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `lawyer`
--
ALTER TABLE `lawyer`
  ADD PRIMARY KEY (`lawyer_id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
