-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2021 at 10:51 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fms`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `f_id` int(11) NOT NULL,
  `folder_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `date_uploaded` varchar(100) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`f_id`, `folder_id`, `user_id`, `filename`, `file_type`, `date_uploaded`, `remarks`, `file_path`) VALUES
(7, 8, 3, 'cpuz3.jpg', 'jpg', '2021-10-28 16:34:08', 'test334', '../uploads/test34/cpuz3.jpg'),
(8, 0, 3, 'cpuz3.jpg', 'jpg', '2021-10-28 16:34:59', '', '../uploads/cpuz3.jpg'),
(9, 8, 3, 'cpuz2.jpg', 'jpg', '2021-10-28 16:35:13', '', '../uploads/test34/cpuz2.jpg'),
(10, 8, 3, 'cpuz.jpg', 'jpg', '2021-10-28 16:35:31', 'haha', '../uploads/test34/cpuz.jpg'),
(11, 9, 3, 'cpuz.jpg', 'jpg', '2021-10-28 16:50:03', '', '../uploads/test2/cpuz.jpg'),
(12, 9, 3, 'cpuz2.jpg', 'jpg', '2021-10-28 16:50:08', '', '../uploads/test2/cpuz2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `folder`
--

CREATE TABLE `folder` (
  `folder_id` int(255) NOT NULL,
  `user_id` int(10) NOT NULL,
  `folder_path` varchar(255) NOT NULL,
  `folder_name` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `folder`
--

INSERT INTO `folder` (`folder_id`, `user_id`, `folder_path`, `folder_name`, `desc`, `date_created`) VALUES
(8, 3, '../uploads/test34', 'test34', ' ', '2021-10-28 15:08:28'),
(9, 3, '../uploads/test2', 'test2', ' ', '2021-10-28 16:49:54');

-- --------------------------------------------------------

--
-- Table structure for table `share`
--

CREATE TABLE `share` (
  `share_id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `user_type` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `name`, `email`, `user_type`, `password`) VALUES
(2, '790', '23', '1231@123123', 'user', 'dff54615aaf85d9b65f74f912b29e429'),
(3, 'admin', 'admin', 'admin@asdasdw', 'admin', '827ccb0eea8a706c4c34a16891f84e7b'),
(11, '123', 'yaps', 'yaps@yaps', 'user', '202cb962ac59075b964b07152d234b70'),
(13, '123', 'test', 'test@gmail.com', 'admin', '202cb962ac59075b964b07152d234b70'),
(18, 'a', 'user a', '', 'user', '827ccb0eea8a706c4c34a16891f84e7b'),
(19, 'b', 'user b', '', 'user', '827ccb0eea8a706c4c34a16891f84e7b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `folder`
--
ALTER TABLE `folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indexes for table `share`
--
ALTER TABLE `share`
  ADD PRIMARY KEY (`share_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `folder`
--
ALTER TABLE `folder`
  MODIFY `folder_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `share`
--
ALTER TABLE `share`
  MODIFY `share_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
