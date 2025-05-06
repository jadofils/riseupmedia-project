-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2025 at 07:41 PM
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
-- Database: `etsk`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` varchar(223) NOT NULL,
  `file` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `lname`, `email`, `file`, `password`, `Date`) VALUES
(1, 'Jado', 'SEZIKEYE', 'sezikeyejadofils100@gmail.com', '', 'Jado123', '2025-05-06 09:53:26'),
(2, 'Kigeli', 'ruth', 'ruth@gmail.com', '', 'Jado123', '2025-05-06 14:41:26'),
(3, 'Anne', 'Marie', 'annee@gmail.com', '', 'Anne', '2025-05-06 10:11:01'),
(4, 'milleire', 'Ishimwe', 'ishimwe@gmail.com', '', '1234', '2025-05-06 10:12:48'),
(5, 'milleire', 'Ishimwe', 'ishimwe@gmail.com', '', '1234', '2025-05-06 10:15:38'),
(6, 'Brainey', 'Mucyo', 'mucyo@gmail.com', '', '123', '2025-05-06 10:18:37'),
(11, 'luis', 'alice', 'kamana@gmail.com', '../uploads/file_681a3ca58ad0a.pdf', '1234', '2025-05-06 16:45:25'),
(12, 'Aime', 'Shema', 'Shema@gmail.com', '../uploads/file_681a3c8ba539c.jpg', '$2y$10$nGMc8dEXiCwXpRjDWw4HreY5oZ94w7bT/LL75jOnhfdjV0H0.ck.G', '2025-05-06 16:44:59'),
(14, 'Cynthia', 'sano', 'Cynthia@gmail.com', '../uploads/file_681a3b06661ff.jpg', '$2y$10$G6kxhAls8u0quy6WPRX0LuGEqz/GKtYCNQ8oHrpFx5nOOOskpoqv6', '2025-05-06 16:38:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
