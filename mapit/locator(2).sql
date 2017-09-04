-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2017 at 06:34 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `locator`
--

-- --------------------------------------------------------

--
-- Table structure for table `institutions`
--

CREATE TABLE `institutions` (
  `institution_id` varchar(255) NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutions`
--

INSERT INTO `institutions` (`institution_id`, `institution_name`, `created_at`, `modified_at`, `deleted`) VALUES
('INS-59a8f2c1048c0', 'nineteen38 Technologies', '2017-09-01 05:40:17', '2017-09-01 05:40:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `map_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `map_doc_id` varchar(255) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maps`
--

INSERT INTO `maps` (`map_id`, `name`, `map_doc_id`, `institution_id`, `created_at`, `modified_at`, `deleted`, `created_by`) VALUES
('MAP-59a8f8497af00', 'Regional Offices', 'MPD-59a8f7f80f681', 'INS-59a8f2c1048c0', '2017-09-01 06:03:53', '2017-09-01 06:03:53', 0, 'USR-59a8f2c1048c7');

-- --------------------------------------------------------

--
-- Table structure for table `map_docs`
--

CREATE TABLE `map_docs` (
  `map_doc_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_docs`
--

INSERT INTO `map_docs` (`map_doc_id`, `name`, `institution_id`, `created_at`, `modified_at`, `deleted`, `created_by`) VALUES
('MPD-59a8f7f80f681', 'Offices', 'INS-59a8f2c1048c0', '2017-09-01 06:02:32', '2017-09-01 06:02:32', 0, 'USR-59a8f2c1048c7');

-- --------------------------------------------------------

--
-- Table structure for table `map_users`
--

CREATE TABLE `map_users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `map_id` varchar(255) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `map_users`
--

INSERT INTO `map_users` (`id`, `user_id`, `map_id`, `institution_id`, `created_at`, `deleted`) VALUES
(1, 'USR-59a8f9e1a0048', 'MAP-59a8f8497af00', 'INS-59a8f2c1048c0', '2017-09-01 06:10:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `place_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `map_id` varchar(255) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `email`, `password`, `phone`, `created_at`, `modified_at`, `deleted`, `active`, `hash`) VALUES
('USR-59a8f2c1048c7', 'Joshua Kperator', 'jkperator@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0202415292', '2017-09-01 05:40:17', '2017-09-01 05:40:17', 0, 0, 'e609c2f3f166cda8376bbaa418e45497'),
('USR-59a8f37b09548', 'Kofi Abanga', 'kofi@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0273624211', '2017-09-01 05:43:23', '2017-09-01 05:43:23', 0, 1, ''),
('USR-59a8f9e1a0048', 'client one', 'client1@gmail.com', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '0123456789', '2017-09-01 06:10:41', '2017-09-01 06:10:41', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_institutions`
--

CREATE TABLE `user_institutions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_institutions`
--

INSERT INTO `user_institutions` (`id`, `user_id`, `institution_id`, `access_level`) VALUES
(1, 'USR-59a8f2c1048c7', 'INS-59a8f2c1048c0', 1),
(3, 'USR-59a8f37b09548', 'INS-59a8f2c1048c0', 2),
(5, 'USR-59a8f9e1a0048', 'INS-59a8f2c1048c0', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institutions`
--
ALTER TABLE `institutions`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `map_docs`
--
ALTER TABLE `map_docs`
  ADD PRIMARY KEY (`map_doc_id`);

--
-- Indexes for table `map_users`
--
ALTER TABLE `map_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_institutions`
--
ALTER TABLE `user_institutions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `map_users`
--
ALTER TABLE `map_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_institutions`
--
ALTER TABLE `user_institutions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
