-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2020 at 08:06 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `faq`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `Title` varchar(100) NOT NULL,
  `Category` varchar(15) NOT NULL,
  `Frequency` tinyint(1) NOT NULL,
  `Detail` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Title`, `Category`, `Frequency`, `Detail`) VALUES
('Can I edit my Catered Order menu after it has been placed?', 'MENU', 0, 'Yes, you can edit an order after it’s been placed as long as there is enough notice. Check our Order Edit and Cancellation Policy here.'),
('Can I order any item from your menu for delivery?', 'MENU', 0, 'Yes. All our items are deliverable, so you can order any item.'),
('How can I place an order?', 'ORDER', 1, 'To place an order you must first Sign-in to make your account. Choose your Event type. Select a package or customize your order from the menu. Completing this you will be redirected to a form where you must fill out details of your event, including Delivery Date, Location and Time'),
('How far in advance can I place an order?', 'ORDER', 0, 'There is no limit to how far in advance you can place an order. Whether you\'re planning an event for next week or next year, order away! We\'ve got you covered.'),
('What is your delivery time window?', 'DELIVERY', 1, 'Our caterers will deliver your order within a 30-minute window, beginning 30 minutes prior to your order time. For example, if your order time is set to 11:30am, the delivery window will be between 11:00am-11:30am, to ensure that your food arrives on time.\r\n\r\nNote: All of our caterers are encouraged to deliver within the 30-minute window. However, there are sometimes circumstances that may cause them to be late. If your order is late, please contact us immediately.'),
('What services do you offer?', 'SERVICE', 1, 'Our services include: Preparing customized or bundled meal packages with the option to Pick-up from store or Delivery to your venue. If you choose Delivery option there will be Delivery Charges applied. Also there are geographical limitations to the Delivery.'),
('Who delivers the food?', 'DELIVERY', 0, 'Each restaurant or caterer is responsible for delivering their food. The majority of our caterers deliver their food themselves, but some rely on third-party delivery services.'),
('Who do you cater to?', 'SERVICE', 1, 'We broadly cater to: 1. Personal Events 2. Corporate Events'),
('Will I receive confirmation that my order has been placed?', 'ORDER', 0, 'Yes! You’ll receive an email summary of your order after it’s been checked out. You can also visit the \'Orders\' page to view the details for your upcoming order: ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`Title`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
