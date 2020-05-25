-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2020 at 07:18 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatlog`
--

-- --------------------------------------------------------

--
-- Table structure for table `messagerecipients`
--

CREATE TABLE `messagerecipients` (
  `messageID` int(11) NOT NULL,
  `toUserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messagerecipients`
--

INSERT INTO `messagerecipients` (`messageID`, `toUserID`) VALUES
(0, 1),
(1, 1),
(2, 6),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(7, 1),
(8, 3),
(9, 3),
(13, 3),
(14, 3),
(15, 6),
(16, 6),
(17, 4),
(18, 3),
(19, 3),
(20, 3),
(21, 4),
(22, 6),
(23, 6),
(24, 6),
(25, 6),
(26, 4),
(27, 6),
(28, 5),
(29, 1),
(30, 1),
(31, 3),
(32, 3),
(33, 36),
(34, 6),
(35, 6),
(36, 38),
(37, 38),
(38, 1),
(39, 1),
(40, 4);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageID` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `fromUserID` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`messageID`, `subject`, `body`, `fromUserID`, `time`) VALUES
(1, 'Hello World', 'Hi!!!', 3, '2020-05-24 02:24:54'),
(2, 'Boring', 'Second message', 2, '2020-05-19 01:17:41'),
(3, 'Yah', 'Hello', 6, '2020-05-19 01:17:41'),
(4, 'Bruh', 'No', 6, '2020-05-19 01:17:41'),
(5, 'BB', 'EE', 4, '2020-05-19 01:13:02'),
(6, 'Lee', 'Two', 5, '2020-05-19 01:17:41'),
(7, 'I need your help!', 'Nigerian Prince', 3, '2020-05-19 01:17:41'),
(8, 'subject', 'body', 1, '2020-05-19 01:17:43'),
(9, 'subject', 'body', 1, '2020-05-19 01:17:41'),
(13, '', 'srsh', 1, '2020-05-24 10:46:23'),
(14, '', 'blah blah blah', 1, '2020-05-24 10:46:47'),
(15, '', 'Hey guys', 1, '2020-05-24 11:11:23'),
(16, '', 'This is pretty Cool!', 1, '2020-05-24 11:11:28'),
(17, '', 'Moon base!', 1, '2020-05-24 11:11:40'),
(18, '', 'i think this works!', 1, '2020-05-24 19:45:30'),
(19, '', 'test', 1, '2020-05-24 19:46:51'),
(20, '', 'geaaeg', 1, '2020-05-24 19:46:55'),
(21, '', 'bruh', 1, '2020-05-24 19:47:10'),
(22, '', 'hey hey hey!', 1, '2020-05-24 19:47:53'),
(23, '', 'not YOU', 1, '2020-05-24 20:05:13'),
(24, '', 'What happens if I go over multiple lines? like this where i just go on and on and on and lorem ipsum dolor and what not that would be pretty swell right?', 1, '2020-05-24 20:05:52'),
(25, '', 'yo yo yo', 1, '2020-05-24 20:17:57'),
(26, '', 'Test', 3, '2020-05-24 22:54:09'),
(27, '', 'Hey ', 3, '2020-05-24 23:01:01'),
(28, '', 'Yo yo yo!', 3, '2020-05-24 23:01:37'),
(29, '', 'I totally agree.', 3, '2020-05-24 23:01:46'),
(30, '', 'I think we should go ahead and eat the potatos.', 3, '2020-05-24 23:01:55'),
(31, '', 'Yes we should!', 1, '2020-05-24 23:02:31'),
(32, '', 'Lets do it!', 1, '2020-05-24 23:02:35'),
(33, '', 'Hi John, this is potato, just checking in with you', 1, '2020-05-25 00:15:21'),
(34, '', 'please respond to me :(', 1, '2020-05-25 00:17:16'),
(35, '', 'please', 1, '2020-05-25 00:17:20'),
(36, '', 'Hey whats up! Welcome to chat.', 1, '2020-05-25 05:03:24'),
(37, '', 'wadw', 1, '2020-05-25 05:04:06'),
(38, '', 'wadawd', 38, '2020-05-25 05:04:08'),
(39, '', 'Hey! How does this work?', 38, '2020-05-25 05:04:15'),
(40, '', 'Hey', 38, '2020-05-25 05:04:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `createDate` date NOT NULL DEFAULT current_timestamp(),
  `isActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `firstName`, `lastName`, `createDate`, `isActive`) VALUES
(1, 'potato', 'phone', 'p@p.com', 'potato', 'alsoPotato', '2020-05-07', 1),
(2, 'nathancs10', 'banana', 'ncsariowan@gmail.com', 'Nathan', 'Sariowan', '2020-05-07', 1),
(3, 'mmaunu', 'ilovesql', 'mmaunu@francisparker.org', 'Michael', 'Maunu', '2020-05-07', 1),
(4, 'Stealthwhale80', 'minecraft', 'abell@francisparker.org', 'Aidan', 'Bell', '2020-05-07', 0),
(5, 'anon', 'hacker8', 'anon@gmail.com', 'Anonymous', 'Hacker', '2020-05-07', 0),
(6, 'kokomo', 'aejfja', 'easd@gmail.com', 'Kokomo', 'Boys', '2020-05-07', 0),
(7, 'username', 'password', 'email@gmail.com', 'firstName', 'lastName', '2020-05-07', 0),
(8, 'usernafchme', 'password', 'email@gmail.com', 'firstName', 'lastName', '2020-05-07', 0),
(9, 'usernamedr', 'password', 'email@gmail.com', 'firstName', 'lastName', '2020-05-07', 0),
(10, 'nathancs11', 'JvdengGkFMQ5b8j', 'ncsariowan@gmail.com', 'Nathan', 'Sariowan', '2020-05-07', 0),
(36, 'jdoe', 'SHbk29mWLVQ7zw3', 'jdoe@gmail.com', 'John', 'Doe', '2020-05-07', 0),
(38, 'lmaas', 'jajaja', 'lmaas@something.org', 'Louie', 'Maas', '2020-05-24', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messagerecipients`
--
ALTER TABLE `messagerecipients`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
