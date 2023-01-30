-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 26, 2023 at 07:40 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` enum('scienc-fiction','fantasy','poetry','comedy','comix') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publisher` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ISBN` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` enum('CHF','USD') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `out_of_print` tinyint(1) NOT NULL,
  `modification_date` date DEFAULT NULL,
  `modification_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `genre`, `author`, `description`, `publisher`, `ISBN`, `price`, `currency`, `out_of_print`, `modification_date`, `modification_time`) VALUES
(1, '\"2000 Miles under the Sea\"', 'fantasy', 'Jules Verne', 'Captain Nemo travels as alone warrior against war in a Submarine under the Sea. A group of passengers that went overboard a boat in a storm are been taken in by Cpt. Nemo.', 'Penguin Books', '978-3-219-11884-1', '10.00', 'CHF', 0, '2023-01-24', '08:40:33'),
(2, '\"Lord Of The RIng\" The Fellowship', 'fantasy', 'J. R. R. Tolkien', 'no comment', 'Kindle Books', '978-0-261-10325-2', '20.00', 'USD', 1, '2015-01-21', '77:58:22'),
(3, '\"Lord Of The Rings\" The Two Towers', 'fantasy', 'J. R. R. Tolkien', 'No Comment', 'Penguin Books', '978-0-261-25325-2', '25.00', 'USD', 0, '2030-01-10', '99:59:06'),
(4, '\"Lord Of The Rings\" - No 3', 'fantasy', 'Tolkien', 'No Comment', 'Books ltd.', '978-0-331-10455-2', '13.00', 'USD', 0, '2023-01-18', '09:01:00'),
(5, '\"The Grinch\"', 'fantasy', 'Dr. Suess', 'Funny Child stuff', 'Dr. Suess Roylty Books', '978-0-261-10455-4', '23.00', 'USD', 0, '2023-01-01', '09:01:20'),
(6, '\"Lord Of The Rings\" - The Fellowship Of The Ring', 'fantasy', 'J. R. R. Tolkien', '\"This Book needs no description\".', 'Kindle Edition', '978-0-261-10325-2', '38.00', 'CHF', 1, '2026-01-28', '09:02:05'),
(7, '\"No Sleep Til Brooklyn\" - Beastie Boys Saga', 'comedy', 'BB Boys, Adam Jauch', 'B-Boys Do their thing....', 'NY Brooklyn Books ltd.', '978-0-261-10565-2', '25.99', 'USD', 0, '2023-01-26', '09:02:38'),
(8, 'Bible 2 - the Sequel', 'scienc-fiction', 'God', 'MAh Holy Book', 'But Mah Holy Buk Ltd', '666-0-261-10325-3', '66.66', 'CHF', 0, '2023-01-27', '09:03:03'),
(9, 'The Holy Buk', 'comix', 'God', 'Cough Cough', 'Jeebus', '333-0-261-10455-2', '20.00', 'USD', 0, '2023-01-19', '09:27:39'),
(10, 'Star Wars - Old Republic: Glossary', 'scienc-fiction', 'John Doe', 'Glossary Star Wars Lore etc', 'SCi Fi-Bks_Goo', '978-0-261-166525-3', '23.99', 'USD', 0, '2016-01-13', '09:04:19'),
(33, 'asdf', 'scienc-fiction', 'asdf', 'adsfas', 'adfsadf', 'asdfasdf', '10.00', 'USD', 0, '2023-01-10', '13:41:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
