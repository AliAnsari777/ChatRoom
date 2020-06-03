-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2017 at 12:32 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chatroom`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `contactID` varchar(30) NOT NULL,
  `request` tinyint(1) NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `displayed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `userName`, `contactID`, `request`, `approved`, `displayed`) VALUES
(3, 'Ali.DK', 'Majnon', 1, 1, 1),
(4, 'Majnon', 'Ali.DK', 1, 1, 0),
(7, 'Milad', 'Ali.DK', 1, 1, 1),
(8, 'Ali.DK', 'Milad', 1, 1, 1),
(9, 'Ali.DK', 'mohammad', 1, 0, 1),
(10, 'mohammad', 'Ali.DK', 0, 0, 0),
(13, 'sadiqsharify', 'Ali.DK', 1, 1, 1),
(14, 'Ali.DK', 'sadiqsharify', 1, 1, 1),
(15, 'test', 'Ahmad', 1, 1, 1),
(16, 'Ahmad', 'test', 1, 1, 1),
(17, '007', 'Majnon', 1, 0, 1),
(18, 'Majnon', '007', 0, 0, 1),
(19, 'Ali.DK', 'Ahmad', 1, 0, 1),
(20, 'Ahmad', 'Ali.DK', 0, 0, 0),
(21, 'vali_ahmadi', 'Ali.DK', 1, 0, 1),
(22, 'Ali.DK', 'vali_ahmadi', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `senderUserName` varchar(30) NOT NULL,
  `receiverUserName` varchar(30) NOT NULL,
  `message` text NOT NULL,
  `displayedToReciever` tinyint(1) NOT NULL,
  `displayedToSender` tinyint(1) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`date`, `senderUserName`, `receiverUserName`, `message`, `displayedToReciever`, `displayedToSender`) VALUES
('2016-02-23 11:17:22', 'Ali.DK', 'Ahmad', 'hello\n', 1, 1),
('2016-02-23 11:17:32', 'Ali.DK', 'Ahmad', 'how are you\n', 1, 1),
('2016-02-23 11:19:43', 'Ahmad', 'Ali.DK', 'Hi\n', 1, 1),
('2016-02-23 11:20:19', 'Ahmad', 'Ali.DK', 'i''m fine\n', 1, 1),
('2016-02-23 11:20:23', 'Ahmad', 'Ali.DK', 'how are you?\n', 1, 1),
('2016-02-23 11:21:09', 'Ali.DK', 'Ahmad', 'i''m fine thanks\n', 1, 1),
('2016-02-27 08:10:29', 'Ali.DK', 'Majnon', 'hello\n', 1, 1),
('2016-02-27 08:11:19', 'Milad', 'Ali.DK', 'SALAM\n', 1, 1),
('2016-02-27 08:11:55', 'Milad', 'Ali.DK', 'howdy\n', 1, 1),
('2016-02-27 08:12:33', 'Milad', 'Ali.DK', 'you there\n', 1, 1),
('2016-02-27 08:12:46', 'Milad', 'Ali.DK', 'how r u\n', 1, 1),
('2016-02-27 08:19:39', 'Milad', 'Ali.DK', 'hey \n', 1, 1),
('2016-02-27 08:19:54', 'Milad', 'Ali.DK', 'ok dont open it but next time dont you dare chat \n', 1, 1),
('2016-02-27 08:21:08', 'Milad', 'Ali.DK', 'gadaaaa\n', 1, 1),
('2016-02-27 08:23:19', 'Ali.DK', 'Milad', 'ok\n', 0, 1),
('2016-02-27 08:24:40', 'Ali.DK', 'Milad', 'i will consider your advice \n', 0, 1),
('2016-04-09 09:00:36', 'Ali.DK', 'Majnon', 'salam\n', 1, 1),
('2016-04-09 09:00:43', 'Ali.DK', 'Majnon', 'are you ok\n', 1, 1),
('2016-04-09 10:21:44', 'Ali.DK', 'sadiqsharify', 'salam\n', 1, 1),
('2016-04-09 10:22:19', 'sadiqsharify', 'Ali.DK', 'hi\n', 1, 1),
('2016-04-09 10:22:28', 'Ali.DK', 'sadiqsharify', 'how are you?\n', 1, 1),
('2016-12-07 13:40:13', 'Ahmad', 'test', 'salam\n', 0, 1),
('2016-12-07 13:40:27', 'Ahmad', 'test', 'hello\n', 0, 1),
('2017-07-05 06:40:45', 'Majnon', 'Ali.DK', 'salam\n', 1, 1),
('2017-07-05 06:43:02', 'Ali.DK', 'Majnon', 'h r u\n', 1, 1),
('2017-07-05 07:04:08', 'Ali.DK', 'Majnon', 'where are you\n', 1, 1),
('2017-07-05 07:04:42', 'Majnon', 'Ali.DK', 'I am in university \n', 1, 1),
('2017-07-05 07:42:26', 'Ali.DK', 'Majnon', 'when your time will be finish\n', 1, 1),
('2017-07-05 07:42:55', 'Majnon', 'Ali.DK', '11 oclock \n', 1, 1),
('2017-07-05 08:19:15', 'Majnon', 'Ali.DK', 'are you there\n', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(20) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` int(11) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `dateOfBirth` date DEFAULT NULL,
  `gender` varchar(7) NOT NULL,
  `country` varchar(30) DEFAULT NULL,
  `province` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `emotion` varchar(100) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `lastName`, `userName`, `password`, `phoneNumber`, `email`, `dateOfBirth`, `gender`, `country`, `province`, `city`, `emotion`, `photo`) VALUES
('ali', 'ansari', '007', '$2y$10$CHgkIkaGTb60njbdJN/H8eu/RwZwGCNPEk9wVIzilongbDfpWCtQa', 0, 'Ali@gmail.com', '0000-00-00', 'Male', '', '', '', '', '/FILES/images/FILE0162.JPG'),
('Ahmad', 'Sarwari', 'Ahmad', '$2y$10$vnvgJJ5zs1MinmJnv9TDRewJfSnFQCP9zsx0JUM2Qz6aZuOgzDTs2', 799233655, 'ahmad@gmail.com', '1993-01-02', 'Male', 'Afghanistan', 'Balkh', 'Mazar', 'Never Give Up*', '/FILES/images/dragon.jpg'),
('ali', 'ansari', 'ali.ansari', '$2y$10$XhLgl.0sRKlSabrqg6hv/.3FRicPOtJc.KavShhh8xDZk8KTabLfy', 779292649, 'Ali@gmail.com', '2016-04-09', 'Male', '', '', '', 'test', '/CSS/male.png'),
('Ali', 'DK', 'Ali.DK', '$2y$10$i03zqW1hmKgBvyJdBRMK/.H1oMVjTfjAwtY9o.9xP8rBpm61zv0Fm', 779292649, 'test@fas.se', '1991-01-31', 'Male', 'Afghanistan', 'Balkh', 'Mazar e Sharif', '', '/FILES/images/orange_rose-HD.jpg'),
('asd', 'asd', 'asd', '$2y$10$x7fe9BldG3LpPIHbL6Fhhe4PcWbQOdTRXU9746Alt4FmRZobtjLq6', 786300200, 'shinobi.af@gmail.com', '0000-00-00', 'Male', 'Afghanistan', 'Balkh', 'Mazar-i-Sharif', '', '/CSS/male.png'),
('Mahmod', 'Mojahed', 'mahmod', '$2y$10$LE5JpWFqAeLahHYIHqmKf.q9Lro3sqlq7HQW4VSY3960AcA3MzC/e', 0, 'mahmod@gmail.com', '1989-01-23', 'Male', '', '', '', '', '/CSS/male.png'),
('Majnon', 'Rasouly', 'Majnon', '$2y$10$F1lgcovOiuEjxiBckDw5muj3Y4iOFrlywMM9Z6oezd2YaIXOGXhN6', 700100200, 'majnon@gmail.com', '1990-01-01', 'Male', 'Afghanistan', 'Balkh', 'Mazar', 'Hello every body!!!', '/FILES/images/FILE0536.JPG'),
('Milad', 'baqi', 'Milad', '$2y$10$5pqqpzEUWEya0j.EG8kzAufln1WPvXmLWgsdskMSAFba7cw/gqA5S', 0, 'milad.baqi@gmail.com', '0000-00-00', 'Male', '', '', '', '', '/CSS/male.png'),
('mohammad', 'ansari', 'mohammad', '$2y$10$rB.riFGZnDpl3u0DkmwCIuG.tM0POoKlSistt8a.GwlH2heiXi1qu', 0, 'asdf@asf.sd', '2016-02-09', 'Male', '', '', '', '', '/FILES/images/assassins-creed-revelations-09.jpg'),
('sadiq', 'sharify', 'sadiqsharify', '$2y$10$6yH1CmuY6hXBM3uFsdoThu996lJGcLv3WK.qxVzBHN391jaukTgM.', 792757434, 'sadiqbalkhy@yahoo.com', '1999-11-02', 'Male', 'afghans', 'ww', 'ee', 'wew', '/CSS/male.png'),
('ali', 'ansari', 'test', '$2y$10$wiKLRlcZlW8xvvIPsL8vTuehOay04hbtCK7myCrKGm7dx1zjkWx5G', 0, 'test@fas.se', '0000-00-00', 'Male', '', '', '', '', '/FILES/images/681840.jpg'),
('vali', 'ahmadi', 'vali_ahmadi', '$2y$10$WnvFsxGxTe6zI/Be0bWKge8Q8j8svYISSx9PQrlXACpcThu2HmlZO', 0, 'vali.ahmadi@gmail.com', '2017-07-19', 'Male', 'afghanistan', 'balkh', 'mazar', '', '/FILES/images/35.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
