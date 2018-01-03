-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2018 at 03:20 AM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `DBMS_Project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cat_from_pin` (IN `pid` INT(5))  begin set @sql = concat('Select CatName FROM Categories where CatId = (select CatId from Pin WHERE PinId=',pid,')'); PREPARE stmt from @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt; end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pin_info` (IN `pid` INT(5), IN `colname` VARCHAR(10))  begin set @sql = concat('SELECT ',colname,' FROM Pin WHERE PinId=',pid); PREPARE stmt from @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt; end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_from_pin` (IN `pid` INT(5))  begin set @sql = concat('Select * FROM User where UserId = (select UserId from Pin WHERE PinId=',pid,')'); PREPARE stmt from @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt; end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `user_info` (IN `uid` INT(5), IN `colname` VARCHAR(10))  begin set @sql = concat('SELECT ',colname,' FROM User WHERE UserId=',uid); PREPARE stmt from @sql; EXECUTE stmt; DEALLOCATE PREPARE stmt; end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Art`
--

CREATE TABLE `Art` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Art`
--

INSERT INTO `Art` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 1, 0, '2017-09-13 13:29:31'),
(4, 14, 0, '2017-09-13 14:49:30'),
(5, 29, 0, '2017-09-15 00:54:15'),
(6, 30, 0, '2017-09-15 09:08:00'),
(7, 31, 0, '2017-09-15 09:12:09'),
(8, 33, 0, '2017-09-16 21:48:29'),
(9, 34, 0, '2017-09-16 21:49:01'),
(10, 35, 0, '2017-09-16 21:49:10'),
(11, 46, 0, '2017-09-22 17:30:22'),
(12, 47, 0, '2017-09-23 04:53:49'),
(13, 50, 0, '2017-09-23 18:21:23'),
(14, 55, 0, '2017-11-06 12:41:35'),
(15, 56, 0, '2017-12-03 21:08:46'),
(16, 57, 0, '2017-12-25 05:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `Board`
--

CREATE TABLE `Board` (
  `BoardId` int(5) NOT NULL,
  `BoardName` varchar(20) NOT NULL,
  `NumPin` int(5) DEFAULT '0',
  `UserId` int(5) DEFAULT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Board`
--

INSERT INTO `Board` (`BoardId`, `BoardName`, `NumPin`, `UserId`, `CreatedOn`, `UpdatedOn`) VALUES
(2, 'tgrfuhyt', 3, 2, '2017-09-14 15:44:36', '2017-09-14 15:44:36'),
(3, 'hy', 2, 2, '2017-09-15 10:28:18', '2017-09-15 10:28:18'),
(4, 'books', 1, 2, '2017-09-22 10:28:11', '2017-09-22 10:28:11'),
(5, 'gveed', 2, 2, '2017-09-22 17:00:46', '2017-09-22 17:00:46'),
(6, 'te4t', 2, 2, '2017-09-22 17:01:48', '2017-09-22 17:01:48'),
(7, 'gedtg', 3, 2, '2017-09-22 17:10:44', '2017-09-22 17:10:44'),
(8, '', 1, 13, '2017-09-23 04:51:27', '2017-09-23 04:51:27'),
(9, 'Qwerty', 1, 18, '2017-12-03 21:10:26', '2017-12-03 21:10:26'),
(10, 'My board', 1, 21, '2018-01-03 14:46:43', '2018-01-03 14:46:43'),
(11, 'My favourites', 1, 28, '2018-01-03 21:15:00', '2018-01-03 21:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `BoardPins`
--

CREATE TABLE `BoardPins` (
  `PinId` int(5) NOT NULL,
  `Pic` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BoardPins`
--

INSERT INTO `BoardPins` (`PinId`, `Pic`) VALUES
(1, 'uploads/8881fef0ac4e5e0752393d9c3fed43bf.jpg'),
(2, 'uploads/28df11c0d7b3bb5799894d391c2b1919.jpg'),
(3, 'uploads/5ea1bb751894bc99434dab3d1b08743c.jpg'),
(4, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(5, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(6, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(7, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(8, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(9, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(10, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(11, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(12, 'uploads/b006558e0b6533fbd72bc7e9f2caed48.jpg'),
(13, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(14, 'uploads/b006558e0b6533fbd72bc7e9f2caed48.jpg'),
(15, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(16, 'uploads/b006558e0b6533fbd72bc7e9f2caed48.jpg'),
(17, 'uploads/08333083077d8543d235f0e7fdc6945b.jpg'),
(18, 'uploads/b006558e0b6533fbd72bc7e9f2caed48.jpg'),
(19, 'uploads/be1499f3a2ca89e7cf5043622f05bb98.jpg'),
(20, 'uploads/8881fef0ac4e5e0752393d9c3fed43bf.jpg'),
(21, 'uploads/be1499f3a2ca89e7cf5043622f05bb98.jpg'),
(22, 'uploads/8505aa1b7f73fd6811eb85bfbb0d946c.jpg'),
(23, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(24, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(25, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(26, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(27, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(28, 'uploads/bfbd1766a3bd04301811eab1b223a308.jpg'),
(29, 'uploads/8881fef0ac4e5e0752393d9c3fed43bf.jpg'),
(30, 'uploads/travel14.jpg'),
(31, 'uploads/travel44.jpg'),
(32, 'uploads/travel39.jpg'),
(33, 'uploads/travel34.jpg'),
(34, 'uploads/travel39.jpg'),
(35, 'uploads/35.png'),
(36, 'uploads/36.png'),
(37, 'uploads/37'),
(38, 'uploads/38.png'),
(39, 'uploads/39');

-- --------------------------------------------------------

--
-- Table structure for table `BuyPin`
--

CREATE TABLE `BuyPin` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `UserId` int(5) NOT NULL,
  `Status` int(2) NOT NULL DEFAULT '0',
  `Quantity` int(11) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `BuyPin`
--

INSERT INTO `BuyPin` (`SrNo`, `PinId`, `UserId`, `Status`, `Quantity`, `TimeStamp`) VALUES
(4, 20, 4, 1, 0, '2017-11-06 13:32:03'),
(5, 1, 4, 1, 0, '2017-11-06 13:32:03'),
(6, 1, 4, 1, 0, '2017-11-06 13:32:03'),
(7, 1, 4, 1, 0, '2017-11-06 13:32:03'),
(8, 50, 13, 1, 0, '2017-11-06 13:32:03'),
(9, 52, 13, 1, 0, '2017-11-06 13:32:03'),
(10, 55, 4, 1, 3, '2017-11-06 13:32:03'),
(11, 56, 19, 1, 3, '2017-12-03 21:16:07'),
(12, 57, 2, 1, 1, '2017-12-25 05:20:35'),
(13, 1, 24, 1, 3, '2018-01-03 03:04:13'),
(14, 59, 2, 1, 2, '2018-01-03 21:17:17');

--
-- Triggers `BuyPin`
--
DELIMITER $$
CREATE TRIGGER `ApproveBuyNotification` AFTER UPDATE ON `BuyPin` FOR EACH ROW BEGIN
DECLARE uid INT; DECLARE uname varchar(50); SELECT UserID FROM Pin WHERE PinId=NEW.PinId INTO uid; SELECT UserName FROM User WHERE UserId=uid INTO uname; INSERT INTO Notification (UserId,PinId,Description,SEEN)VALUES(NEW.UserId,NEW.PinId,CONCAT(uname,' has sold you his pin'),0); END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BuyNotification` AFTER INSERT ON `BuyPin` FOR EACH ROW BEGIN
DECLARE uid INT; DECLARE uname varchar(50); SELECT UserID FROM Pin WHERE PinId=NEW.PinId INTO uid; SELECT UserName FROM User WHERE UserId=NEW.UserId INTO uname; INSERT INTO Notification (UserId,PinId,Description,SEEN)VALUES(uid,NEW.PinId,CONCAT(uname,' has requested to buy your Pin'),0); END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DelBuyNotification` BEFORE DELETE ON `BuyPin` FOR EACH ROW BEGIN
DECLARE uid INT; SELECT UserID FROM Pin WHERE PinId=OLD.PinId INTO uid; DELETE FROM Notification WHERE UserId=uid AND PinId=OLD.PinId AND (Description LIKE '%requested%' OR Description LIKE '%sold%'); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `CarsAndMotorcycles`
--

CREATE TABLE `CarsAndMotorcycles` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CarsAndMotorcycles`
--

INSERT INTO `CarsAndMotorcycles` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 2, 0, '2017-09-13 13:31:11'),
(2, 15, 0, '2017-09-13 14:50:05'),
(3, 19, 0, '2017-09-14 15:25:53'),
(4, 45, 0, '2017-09-22 17:10:21'),
(5, 49, 0, '2017-09-23 18:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE `Categories` (
  `CatId` int(5) NOT NULL,
  `CatName` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Categories`
--

INSERT INTO `Categories` (`CatId`, `CatName`) VALUES
(1, 'Art'),
(2, 'CarsAndMotorcycles'),
(3, 'Celebrities'),
(4, 'Education'),
(5, 'FoodDrink'),
(6, 'Humour'),
(7, 'Outdoors'),
(8, 'Photography'),
(9, 'Quotes'),
(10, 'Sports'),
(11, 'Tech'),
(12, 'Travel');

-- --------------------------------------------------------

--
-- Table structure for table `Celebrities`
--

CREATE TABLE `Celebrities` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Celebrities`
--

INSERT INTO `Celebrities` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 3, 0, '2017-09-13 13:31:56'),
(2, 18, 0, '2017-09-13 17:28:19'),
(5, 25, 0, '2017-09-15 00:01:57'),
(6, 26, 0, '2017-09-15 00:03:27'),
(7, 37, 0, '2017-09-17 00:23:17'),
(8, 59, 0, '2018-01-03 21:14:30');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `srno` int(4) NOT NULL,
  `Receiver` int(4) NOT NULL,
  `Sender` int(4) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `TimeSent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`srno`, `Receiver`, `Sender`, `Message`, `TimeSent`) VALUES
(1, 2, 4, 'Hello Tony', '2018-01-02 04:09:37'),
(5, 2, 4, 'Chal chod', '2018-01-02 11:13:43'),
(6, 4, 2, 'Kesa hai bhai?', '2018-01-02 11:14:48'),
(7, 2, 4, 'Mast', '2018-01-02 11:15:11'),
(8, 2, 4, 'helllooooooooo', '2018-01-02 11:40:18'),
(9, 2, 4, 'hello', '2018-01-02 12:38:10'),
(10, 2, 4, 'Chal raha kya', '2018-01-02 12:41:05'),
(11, 4, 2, 'Ha shayad .. chal raha acche se', '2018-01-02 12:42:24'),
(12, 4, 2, 'Abe sachme chal raha bhai', '2018-01-02 12:42:43'),
(13, 4, 2, 'Send karne k baad page refresh nahi hona chahiye', '2018-01-02 12:43:15'),
(14, 4, 2, 'Jaise retrieve kar raha vese hi send bhi kar', '2018-01-02 12:43:44'),
(28, 20, 2, 'Hi', '2018-01-02 18:26:44'),
(29, 20, 2, 'Supp?', '2018-01-02 18:26:51'),
(30, 20, 2, 'Chala?', '2018-01-02 18:33:27'),
(31, 20, 2, 'Chala?', '2018-01-02 18:33:27'),
(32, 20, 2, 'Oyyee.. refresh mt ho yaar', '2018-01-02 18:33:44'),
(33, 20, 2, 'Oyyee.. refresh mt ho yaar', '2018-01-02 18:33:44'),
(34, 20, 2, 'Data print kar', '2018-01-02 18:34:16'),
(35, 20, 2, 'Data print kar', '2018-01-02 18:34:16'),
(36, 20, 2, 'Ab hua?', '2018-01-02 18:39:43'),
(37, 20, 2, 'Please chal jaaaaaa', '2018-01-02 18:55:20'),
(38, 20, 2, 'Yayyyyyyyyyyyyyyyiiiiieeeoeooooooeoeoeo', '2018-01-02 18:55:39'),
(39, 4, 2, 'Hii', '2018-01-02 19:00:31'),
(40, 2, 4, 'Hello', '2018-01-02 19:00:38'),
(41, 2, 4, 'Hows Barbosa', '2018-01-02 19:00:52'),
(42, 4, 2, 'Bathroom madhe aahe', '2018-01-02 19:01:07'),
(43, 2, 4, 'Kahi kaam hota ka?', '2018-01-02 19:03:41'),
(44, 2, 4, 'Pagal ho gaya kya', '2018-01-02 19:03:53'),
(45, 2, 4, 'Acha thik aahe', '2018-01-02 19:06:24'),
(46, 2, 4, 'helllooooooooo', '2018-01-02 19:10:39'),
(47, 2, 4, 'Hhiiiiiiii', '2018-01-02 19:10:44'),
(48, 4, 2, 'Hii', '2018-01-02 19:13:46'),
(49, 2, 4, 'Hiiiiiiii', '2018-01-02 19:13:54'),
(50, 4, 2, 'Nice', '2018-01-02 19:14:07'),
(51, 4, 2, 'Good going', '2018-01-02 19:14:17'),
(52, 2, 4, 'Thanks', '2018-01-02 19:14:27'),
(53, 4, 2, 'Yaaaaaaaaaaarr', '2018-01-02 19:14:36'),
(54, 4, 2, 'Kitna mastt banaya tune', '2018-01-02 19:14:43'),
(55, 4, 2, 'Upar i guess session id hai', '2018-01-02 19:15:05'),
(56, 4, 2, 'Usse comment kr de', '2018-01-02 19:15:13'),
(57, 2, 4, 'Na', '2018-01-02 19:15:14'),
(58, 2, 4, 'Userid', '2018-01-02 19:15:21'),
(59, 4, 2, 'Ha jo bhi', '2018-01-02 19:15:34'),
(60, 2, 4, 'Hmm', '2018-01-02 19:15:43'),
(61, 4, 2, 'My name is Bhaumik Patel?', '2018-01-02 19:15:54'),
(62, 2, 4, 'Iska front end baaki hai', '2018-01-02 19:15:56'),
(63, 2, 4, 'Arey naam mat dekh na abhi', '2018-01-02 19:16:08'),
(64, 2, 4, 'See only msgs', '2018-01-02 19:16:15'),
(65, 4, 2, 'Hmm.. okay', '2018-01-02 19:16:16'),
(66, 4, 2, 'Sarah ko bataya kya?', '2018-01-02 19:16:26'),
(67, 2, 4, 'Nahi abhi tk', '2018-01-02 19:16:35'),
(68, 4, 2, 'Kaha se uthaya code?', '2018-01-02 19:16:43'),
(69, 2, 4, 'Usko bhi link bhejta hu', '2018-01-02 19:16:48'),
(70, 2, 4, 'Aeeeeeeeee', '2018-01-02 19:16:58'),
(71, 2, 4, 'Sirf front end uthaya', '2018-01-02 19:17:05'),
(72, 2, 4, 'Baaki khudse kiya aaj subah', '2018-01-02 19:17:13'),
(73, 4, 2, 'Ohk', '2018-01-02 19:17:15'),
(74, 4, 2, 'Good', '2018-01-02 19:17:28'),
(75, 4, 2, 'Aaj na', '2018-01-02 19:17:39'),
(76, 2, 4, 'Whatsapp pe baat krte... mera database bhar jayega :p', '2018-01-02 19:18:06'),
(77, 4, 2, 'Hmm.. sorry', '2018-01-02 19:18:17'),
(78, 2, 4, 'Bye', '2018-01-02 19:18:23'),
(79, 2, 4, 'Log out', '2018-01-02 19:18:31'),
(80, 2, 4, 'Baaki site dekhni ho toh bata', '2018-01-02 19:18:44'),
(81, 2, 4, 'Server chalu rakhna oadega', '2018-01-02 19:18:54'),
(82, 2, 4, '*padega', '2018-01-02 19:18:58'),
(83, 2, 4, ';(', '2018-01-02 19:19:50'),
(84, 2, 4, 'Gayab ho gayi??', '2018-01-02 19:19:55'),
(85, 2, 4, 'Last seen add karna padega :/', '2018-01-02 19:20:04'),
(86, 2, 4, '{heart}', '2018-01-02 22:25:18'),
(87, 2, 4, '{heart}', '2018-01-02 22:28:41'),
(88, 2, 4, 'Hello', '2018-01-02 22:32:11'),
(89, 2, 4, '{heart}', '2018-01-02 22:32:27'),
(90, 4, 2, 'ðŸ˜„', '2018-01-02 23:03:23'),
(91, 4, 2, 'ðŸ™ˆ', '2018-01-02 23:05:38'),
(92, 2, 4, 'Nothing next', '2018-01-02 23:22:28'),
(93, 2, 4, 'Bas yehi tha', '2018-01-02 23:22:41'),
(94, 2, 4, 'Â ðŸ™ˆðŸ™ˆ', '2018-01-02 23:22:54'),
(95, 2, 4, 'Â Such a lame reaction dudeðŸ˜¢', '2018-01-02 23:23:11'),
(96, 4, 2, 'sorry', '2018-01-02 23:24:21'),
(97, 4, 2, 'i didnt realize this was you texting me', '2018-01-02 23:24:57'),
(98, 2, 4, 'Wth!', '2018-01-02 23:25:06'),
(99, 2, 4, 'ðŸ™ˆðŸ™ˆ', '2018-01-02 23:25:29'),
(100, 4, 2, 'arey it doesnt scroll down', '2018-01-02 23:25:30'),
(101, 2, 4, 'YeahðŸ™ˆ', '2018-01-02 23:25:45'),
(102, 4, 2, 'dude this is so cool', '2018-01-02 23:25:47'),
(103, 2, 4, 'Hmm', '2018-01-02 23:26:26'),
(104, 4, 2, '', '2018-01-02 23:26:29'),
(105, 4, 2, 'when did you do this?', '2018-01-02 23:26:37'),
(106, 2, 4, 'Today morning', '2018-01-02 23:26:51'),
(107, 4, 2, 'seriously?', '2018-01-02 23:27:13'),
(108, 2, 4, 'Actually..all day..except the lab', '2018-01-02 23:27:16'),
(109, 4, 2, 'fuckÂ ', '2018-01-02 23:28:29'),
(110, 4, 2, '', '2018-01-02 23:28:57'),
(111, 2, 4, '', '2018-01-02 23:29:43'),
(112, 2, 4, '', '2018-01-02 23:29:49'),
(113, 2, 4, '', '2018-01-02 23:29:49'),
(114, 2, 4, '', '2018-01-02 23:29:49'),
(115, 2, 4, '', '2018-01-02 23:29:50'),
(116, 2, 4, '', '2018-01-02 23:29:50'),
(117, 2, 4, '', '2018-01-02 23:29:50'),
(118, 4, 2, '', '2018-01-02 23:30:01'),
(119, 2, 4, 'ByeðŸ‘‹', '2018-01-02 23:30:54'),
(120, 4, 2, 'Junaid4ï¸âƒ£7ï¸âƒ£', '2018-01-02 23:45:26'),
(121, 13, 2, 'hello', '2018-01-03 01:33:54'),
(122, 13, 2, 'Helllo', '2018-01-03 01:41:21'),
(123, 2, 4, 'Hello TonyðŸ˜„', '2018-01-03 08:38:05'),
(124, 4, 2, 'Hey Ani', '2018-01-03 08:38:31'),
(125, 2, 21, 'HelloðŸ˜ž', '2018-01-03 20:14:44'),
(126, 21, 2, 'Hi Vivek', '2018-01-03 20:15:26'),
(127, 2, 21, 'Bye', '2018-01-03 20:15:33'),
(128, 6, 2, 'yO', '2018-01-04 00:14:32'),
(129, 2, 22, 'Hey tony', '2018-01-04 00:39:39'),
(130, 22, 2, 'Yo Juno .. Wassup nigga?', '2018-01-04 00:40:31'),
(131, 4, 2, 'Wassup?', '2018-01-04 01:20:35'),
(132, 4, 25, 'HelloðŸ˜‰', '2018-01-04 01:44:18'),
(133, 2, 28, 'Hello TonyðŸ˜', '2018-01-04 02:50:57'),
(134, 28, 2, 'Hey Anuj', '2018-01-04 02:51:12'),
(135, 4, 2, 'Yolo', '2018-01-04 03:18:14');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `SrNo` int(11) NOT NULL,
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UserId` int(11) NOT NULL,
  `PinId` int(11) NOT NULL,
  `Content` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`SrNo`, `CreatedOn`, `UserId`, `PinId`, `Content`) VALUES
(6, '2017-09-16 19:01:49', 2, 1, 'Add your comment here...'),
(7, '2017-09-16 19:34:20', 2, 1, 'fdjsged'),
(8, '2017-09-16 20:09:51', 2, 32, 'ygygh'),
(9, '2017-09-16 20:10:47', 2, 32, 'tgerj'),
(10, '2017-09-16 21:22:07', 2, 29, 'hello'),
(11, '2017-09-16 22:09:39', 2, 20, 'Add your comment here... This has to be a placeholder!!\r\n'),
(12, '2017-09-17 01:32:19', 2, 1, 'sdfasjdkf'),
(13, '2017-09-24 11:30:52', 2, 35, 'fswjdfpiws'),
(14, '2017-12-25 05:21:07', 2, 57, 'dkfjnsjkdf'),
(15, '2018-01-03 21:15:56', 2, 59, 'Its so cool');

--
-- Triggers `Comments`
--
DELIMITER $$
CREATE TRIGGER `CommentNotification` AFTER INSERT ON `Comments` FOR EACH ROW BEGIN
DECLARE uid INT; DECLARE uname varchar(50); SELECT UserID FROM Pin WHERE PinId=NEW.PinId INTO uid; SELECT UserName FROM User WHERE UserId=NEW.UserId INTO uname; INSERT INTO Notification (UserId,PinId,Description,SEEN)VALUES(uid,NEW.PinId,CONCAT(uname,' has commented on your pin'),0); END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `DelCommentNotification` BEFORE DELETE ON `Comments` FOR EACH ROW BEGIN
DECLARE uid INT;  SELECT UserID FROM Pin WHERE PinId=OLD.PinId INTO uid; DELETE FROM Notification WHERE UserId=uid AND PinId=OLD.PinId AND Description LIKE '%commented%'; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Education`
--

CREATE TABLE `Education` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Education`
--

INSERT INTO `Education` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 4, 0, '2017-09-13 13:32:14'),
(2, 20, 0, '2017-09-14 15:38:20'),
(3, 27, 0, '2017-09-15 00:14:05'),
(4, 28, 0, '2017-09-15 00:15:04'),
(5, 36, 0, '2017-09-16 23:42:48'),
(6, 51, 0, '2017-09-29 12:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `FollowBoard`
--

CREATE TABLE `FollowBoard` (
  `SrNo` int(5) NOT NULL,
  `BoardId` int(5) DEFAULT NULL,
  `PinId` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FollowBoard`
--

INSERT INTO `FollowBoard` (`SrNo`, `BoardId`, `PinId`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 28),
(5, 3, 29),
(6, 4, 30),
(7, 7, 31),
(8, 7, 32),
(9, 7, 33),
(10, 8, 34),
(11, 9, 35),
(12, 10, 36),
(13, 10, 37),
(14, 11, 38),
(15, 11, 39);

-- --------------------------------------------------------

--
-- Table structure for table `FollowCat`
--

CREATE TABLE `FollowCat` (
  `SrNo` int(5) NOT NULL,
  `CatId` int(5) NOT NULL,
  `UserId` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FollowCat`
--

INSERT INTO `FollowCat` (`SrNo`, `CatId`, `UserId`) VALUES
(3, 3, 2),
(4, 4, 2),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2),
(8, 1, 13),
(9, 2, 13),
(10, 3, 13),
(11, 4, 13),
(12, 5, 13),
(25, 2, 2),
(26, 9, 2),
(27, 10, 2),
(28, 12, 2),
(31, 1, 14),
(32, 2, 14),
(33, 3, 14),
(34, 4, 14),
(35, 5, 14),
(36, 6, 14),
(37, 7, 14),
(38, 8, 14),
(39, 9, 14),
(40, 10, 14),
(41, 11, 14),
(42, 12, 14),
(43, 8, 2),
(44, 11, 2),
(45, 2, 16),
(46, 3, 16),
(47, 4, 16),
(48, 5, 16),
(49, 6, 16),
(50, 1, 19),
(51, 2, 19),
(52, 9, 19),
(53, 10, 19),
(54, 11, 19),
(55, 1, 18),
(56, 2, 18),
(57, 4, 18),
(58, 10, 18),
(59, 11, 18),
(60, 12, 18),
(61, 2, 20),
(62, 5, 20),
(63, 7, 20),
(64, 8, 20),
(65, 12, 20),
(66, 6, 21),
(67, 7, 21),
(68, 8, 21),
(69, 9, 21),
(70, 10, 21),
(71, 11, 21),
(72, 1, 22),
(73, 2, 22),
(74, 3, 22),
(75, 5, 22),
(76, 6, 22),
(77, 1, 23),
(78, 2, 23),
(79, 3, 23),
(80, 4, 23),
(81, 5, 23),
(82, 1, 24),
(83, 2, 24),
(84, 5, 24),
(85, 6, 24),
(86, 8, 24),
(87, 9, 24),
(88, 7, 24),
(89, 2, 25),
(90, 3, 25),
(91, 5, 25),
(92, 7, 25),
(93, 9, 25),
(94, 3, 26),
(95, 5, 26),
(96, 6, 26),
(97, 8, 26),
(98, 11, 26),
(99, 5, 27),
(100, 6, 27),
(101, 8, 27),
(102, 9, 27),
(103, 11, 27),
(104, 12, 27),
(105, 3, 28),
(106, 5, 28),
(107, 6, 28),
(108, 7, 28),
(109, 9, 28),
(110, 11, 28),
(111, 2, 28);

-- --------------------------------------------------------

--
-- Table structure for table `FollowUser`
--

CREATE TABLE `FollowUser` (
  `SrNo` int(5) NOT NULL,
  `UserId1` int(5) NOT NULL COMMENT 'Follower',
  `UserId2` int(5) NOT NULL COMMENT 'Followed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FollowUser`
--

INSERT INTO `FollowUser` (`SrNo`, `UserId1`, `UserId2`) VALUES
(30, 2, 6),
(33, 10, 2),
(35, 2, 13),
(36, 13, 2),
(53, 2, 4),
(55, 4, 2),
(56, 18, 19),
(57, 19, 18),
(58, 2, 20),
(59, 20, 2),
(60, 4, 18),
(61, 2, 19),
(62, 24, 2),
(63, 4, 24),
(65, 25, 4),
(66, 28, 2),
(67, 2, 28),
(68, 28, 4);

--
-- Triggers `FollowUser`
--
DELIMITER $$
CREATE TRIGGER `DelUserNotification` BEFORE DELETE ON `FollowUser` FOR EACH ROW DELETE FROM Notification WHERE UserId=OLD.UserId2
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UserNotification` AFTER INSERT ON `FollowUser` FOR EACH ROW BEGIN DECLARE uname varchar(50); SELECT UserName FROM User WHERE UserId=NEW.UserId1 INTO uname; INSERT INTO Notification(UserId,UserId2,Description,Seen) VALUES (NEW.UserId2,NEW.UserId1,CONCAT(uname,' has started following you'),0); END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `FoodDrink`
--

CREATE TABLE `FoodDrink` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FoodDrink`
--

INSERT INTO `FoodDrink` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 5, 0, '2017-09-13 13:32:33'),
(3, 17, 0, '2017-09-13 17:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `Humour`
--

CREATE TABLE `Humour` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Humour`
--

INSERT INTO `Humour` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(5, 13, 0, '2017-09-13 14:32:05'),
(6, 16, 0, '2017-09-13 17:10:49'),
(7, 48, 0, '2017-09-23 05:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `LikePin`
--

CREATE TABLE `LikePin` (
  `SrNo` int(11) NOT NULL,
  `PinId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `LikePin`
--

INSERT INTO `LikePin` (`SrNo`, `PinId`, `UserId`) VALUES
(16, 26, 2),
(18, 20, 2),
(19, 17, 2),
(20, 29, 2),
(24, 27, 2),
(25, 18, 2),
(26, 1, 4),
(30, 31, 2),
(32, 23, 2),
(33, 35, 2),
(34, 2, 2),
(35, 39, 2),
(36, 13, 2),
(37, 46, 2),
(38, 50, 2),
(39, 3, 2),
(43, 1, 2),
(44, 16, 2),
(45, 56, 19),
(46, 57, 2),
(47, 1, 24),
(48, 2, 21),
(49, 59, 2);

--
-- Triggers `LikePin`
--
DELIMITER $$
CREATE TRIGGER `DelLikeNotification` BEFORE DELETE ON `LikePin` FOR EACH ROW BEGIN
DECLARE uid INT;  SELECT UserID FROM Pin WHERE PinId=OLD.PinId INTO uid; DELETE FROM Notification WHERE UserId=uid AND PinId=OLD.PinId AND Description LIKE '%liked%'; 
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `LikeNotification` AFTER INSERT ON `LikePin` FOR EACH ROW BEGIN
DECLARE uid INT; DECLARE uname varchar(50); SELECT UserID FROM Pin WHERE PinId=NEW.PinId INTO uid; SELECT UserName FROM User WHERE UserId=NEW.UserId INTO uname; INSERT INTO Notification (UserId,PinId,Description,SEEN)VALUES(uid,NEW.PinId,CONCAT(uname,' has liked your pin'),0);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Notification`
--

CREATE TABLE `Notification` (
  `SrNo` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `PinId` int(11) NOT NULL DEFAULT '0',
  `UserId2` int(11) NOT NULL DEFAULT '0',
  `Description` varchar(100) NOT NULL,
  `Seen` int(11) NOT NULL DEFAULT '0',
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Notification`
--

INSERT INTO `Notification` (`SrNo`, `UserId`, `PinId`, `UserId2`, `Description`, `Seen`, `Time`) VALUES
(5, 4, 39, 0, 'tonystark has liked your pin', 1, '2017-09-25 21:13:16'),
(7, 4, 0, 2, 'tonystark has started following you', 1, '2017-09-25 21:13:16'),
(17, 13, 50, 0, 'tonystark has sold you his pin', 1, '2017-10-01 15:24:59'),
(19, 13, 52, 0, 'tonystark has sold you his pin', 1, '2017-10-01 15:27:01'),
(21, 4, 55, 0, 'tonystark has sold you his pin', 1, '2017-11-06 13:02:45'),
(22, 19, 0, 18, 'Shubham Revanwar has started following you', 0, '2017-12-03 21:09:00'),
(23, 18, 0, 19, 'siddharth has started following you', 0, '2017-12-03 21:09:12'),
(24, 18, 56, 0, 'siddharth has liked your pin', 0, '2017-12-03 21:14:53'),
(25, 18, 56, 0, 'siddharth has requested to buy your Pin', 0, '2017-12-03 21:15:40'),
(26, 19, 56, 0, 'Shubham Revanwar has sold you his pin', 0, '2017-12-03 21:16:07'),
(27, 20, 0, 2, 'tonystark has started following you', 1, '2017-12-25 05:15:08'),
(29, 20, 57, 0, 'tonystark has requested to buy your Pin', 0, '2017-12-25 05:19:35'),
(31, 20, 57, 0, 'tonystark has commented on your pin', 0, '2017-12-25 05:21:07'),
(32, 20, 57, 0, 'tonystark has liked your pin', 0, '2017-12-25 05:21:16'),
(33, 18, 0, 4, 'Aniruddha has started following you', 0, '2018-01-01 19:16:59'),
(34, 19, 0, 2, 'tonystark has started following you', 0, '2018-01-02 20:01:38'),
(37, 24, 0, 4, 'Aniruddha has started following you', 0, '2018-01-03 03:00:56'),
(39, 24, 1, 0, 'tonystark has sold you his pin', 0, '2018-01-03 03:04:13'),
(41, 2, 2, 0, 'Vivek has liked your pin', 0, '2018-01-03 14:48:03'),
(42, 4, 0, 25, 'Rohit has started following you', 0, '2018-01-03 20:13:33'),
(43, 2, 0, 28, 'Anuj Pahade has started following you', 1, '2018-01-03 21:11:21'),
(44, 28, 0, 2, 'tonystark has started following you', 0, '2018-01-03 21:11:58'),
(45, 28, 59, 0, 'tonystark has liked your pin', 0, '2018-01-03 21:15:35'),
(46, 28, 59, 0, 'tonystark has commented on your pin', 0, '2018-01-03 21:15:56'),
(47, 28, 59, 0, 'tonystark has requested to buy your Pin', 0, '2018-01-03 21:16:36'),
(48, 2, 59, 0, 'Anuj Pahade has sold you his pin', 0, '2018-01-03 21:17:17'),
(49, 4, 0, 28, 'Anuj Pahade has started following you', 0, '2018-01-03 21:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `Outdoors`
--

CREATE TABLE `Outdoors` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Photography`
--

CREATE TABLE `Photography` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Photography`
--

INSERT INTO `Photography` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 38, 0, '2017-09-17 01:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `Pin`
--

CREATE TABLE `Pin` (
  `PinId` int(5) NOT NULL,
  `Pic` varchar(512) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(512) NOT NULL,
  `CanBuy` int(2) NOT NULL DEFAULT '0' COMMENT 'To sell pins',
  `Stock` int(100) DEFAULT NULL COMMENT 'Available stock for buyers',
  `Price` int(11) DEFAULT NULL,
  `Likes` int(5) NOT NULL DEFAULT '0',
  `UserId` int(5) NOT NULL,
  `CatId` int(5) NOT NULL,
  `Share` tinyint(2) DEFAULT '0',
  `NumReport` tinyint(3) DEFAULT '0',
  `Status` tinyint(1) DEFAULT '1',
  `Score` int(11) NOT NULL DEFAULT '0',
  `Download` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Pin`
--

INSERT INTO `Pin` (`PinId`, `Pic`, `Name`, `Description`, `CanBuy`, `Stock`, `Price`, `Likes`, `UserId`, `CatId`, `Share`, `NumReport`, `Status`, `Score`, `Download`) VALUES
(1, 'uploads/1.jpg', 'rfgs', 'edf', 1, 7, 250, 5, 2, 1, 4, 1, 1, 1, 1),
(2, 'uploads/2.jpg', 'dsfds', 'edw3r', 0, 0, NULL, 2, 2, 2, 0, 0, 1, 1, 1),
(3, 'uploads/3.jpg', 'bgfgf', 'frfg', 0, 0, NULL, 1, 2, 3, 0, 0, 1, 0, 1),
(4, 'uploads/4.jpg', 'ye5y54', '6yjuy', 0, 0, NULL, 0, 2, 4, 0, 0, 1, 0, 1),
(5, 'uploads/5.jpg', 'hy76i', 'jk8y', 0, 0, NULL, 0, 2, 5, 0, 0, 1, 0, 1),
(13, 'uploads/6.jpg', 'tghgt', 'rfgfd', 0, 0, NULL, 1, 2, 6, 0, 0, 1, 0, 1),
(14, 'uploads/7.jpg', 'ghg', 'hfg', 0, 0, NULL, 0, 2, 1, 0, 0, 1, 0, 1),
(15, 'uploads/8.jpg', 'grfg', 'rfgfr', 0, 0, NULL, 0, 2, 2, 0, 0, 1, 0, 1),
(16, 'uploads/9.jpg', 'feds', 'sdcs', 0, 0, NULL, 1, 2, 6, 0, 0, 1, 0, 1),
(17, 'uploads/10.jpg', 'frgr', 'swdws', 0, 0, NULL, 1, 2, 5, 0, 0, 1, 0, 1),
(18, 'uploads/11.jpg', 'rt4ew', '3w2qe', 0, 0, NULL, 9, 2, 3, 1, 0, 1, 0, 1),
(19, 'uploads/12.jpg', 'rfgf', 'sxsz', 0, 0, NULL, 0, 2, 2, 0, 0, 1, 0, 1),
(20, 'uploads/13.jpg', 'jhjh', 'juklj', 1, 7, NULL, 1, 2, 4, 0, 2, 1, 0, 1),
(23, 'uploads/11.jpg', 'rt4ew', 'des', 0, 0, NULL, 9, 2, 3, 0, 0, 1, 0, 1),
(25, 'uploads/16.jpg', 'rt4ew', 'des', 1, 5, NULL, 9, 2, 3, 0, 0, 1, 0, 1),
(26, 'uploads/16.jpg', 'rt4ew', 'des', 0, 0, NULL, 10, 2, 3, 0, 1, 1, 0, 1),
(27, 'uploads/17.jpg', 'jhjh', 'des', 1, 6, NULL, 1, 2, 4, 1, 0, 1, 0, 1),
(28, 'uploads/18.jpg', 'jhjh', 'des', 0, 0, NULL, 0, 2, 4, 0, 0, 1, 0, 1),
(29, 'uploads/19.jpg', 'grge', 'dxcs', 1, 6, NULL, 1, 13, 1, 1, 1, 1, 0, 1),
(30, 'uploads/20.jpg', 'rfgs', 'des', 0, 0, NULL, 0, 2, 1, 0, 0, 1, 0, 1),
(31, 'uploads/21.jpg', 'grge', 'des', 0, 0, NULL, 1, 2, 1, 1, 0, 1, 0, 1),
(32, 'uploads/22.jpg', 'frstgfr', 'frhyrr', 0, 0, NULL, 0, 2, 12, 0, 0, 1, 0, 1),
(33, 'uploads/23.jpg', 'rfgs', 'des', 0, 0, NULL, 0, 2, 1, 1, 0, 1, 0, 1),
(34, 'uploads/24.jpg', 'rfgs', 'des', 0, 0, NULL, 0, 2, 1, 2, 0, 1, 0, 1),
(35, 'uploads/25.jpg', 'rfgs', 'des', 0, 0, NULL, 0, 2, 1, 3, 0, 1, 0, 1),
(36, 'uploads/26.jpg', 'jhjh', 'des', 0, 0, NULL, 0, 2, 4, 0, 0, 1, 0, 1),
(37, 'uploads/27.jpg', 'rt4ew', 'des', 0, 0, NULL, 0, 2, 3, 0, 0, 1, 0, 1),
(38, 'uploads/28.jpg', 'Aniruddha', 'New Pin', 0, 0, NULL, 0, 2, 8, 0, 0, 1, 0, 1),
(39, 'uploads/29.jpg', 'asdfghj', 'travel', 1, 0, NULL, 1, 4, 12, 3, 0, 1, 0, 1),
(40, 'uploads/30.jpg', 'zxcvbnm', 'creepy', 0, 0, NULL, 0, 4, 12, 0, 0, 1, 0, 1),
(41, 'uploads/31.jpg', 'm..mm', 'ooijlk', 1, 12, 123, 0, 4, 10, 0, 0, 1, 0, 1),
(42, 'uploads/32.jpg', 'asdfghj', 'des', 0, NULL, NULL, 0, 4, 12, 0, 0, 1, 0, 1),
(43, 'uploads/33.jpg', 'asdfghj', 'des', 0, NULL, NULL, 0, 4, 12, 1, 0, 1, 0, 1),
(44, 'uploads/34.jpg', 'asdfghj', ' swaxds', 0, NULL, NULL, 0, 4, 12, 2, 0, 1, 0, 1),
(45, 'uploads/35.jpg', 'yrte', 'gter', 0, 12, 123, 0, 2, 2, 0, 0, 1, 0, 1),
(46, 'uploads/36.jpg', 'grge', ' fvsd', 0, NULL, NULL, 1, 2, 1, 0, 0, 1, 0, 1),
(47, 'uploads/37.jpg', '33', '66528525285', 1, 66, 66, 0, 13, 1, 0, 0, 1, 0, 1),
(48, 'uploads/38.jpg', 'frwrfe', 'uyhhuj', 1, 12, 123, 0, 13, 6, 0, 0, 1, 0, 1),
(49, 'uploads/39.jpg', 'swrfe', 'rtyfryt', 1, 12, 123, 0, 2, 2, 0, 0, 1, 0, 0),
(50, 'uploads/40.jpg', 'dswed', 'hjlik', 1, 121, 1234, 1, 2, 1, 0, 0, 1, 0, 0),
(51, 'uploads/41.jpg', 'rf3erf', 'de', 1, 123, 2343, 0, 2, 4, 0, 0, 1, 0, 1),
(52, 'uploads/42.jpg', 'fh', 'ujhkj', 1, 122, 235, 0, 2, 11, 0, 0, 1, 0, 1),
(53, 'uploads/43.jpg', 'dxs', 'dqas', 1, 123, 234, 0, 2, 10, 0, 0, 1, 0, 1),
(54, 'uploads/44.jpg', 'few', 'gfgegtf', 0, 0, 0, 0, 2, 10, 0, 0, 1, 0, 1),
(55, 'uploads/45.jpg', 'Buy thisss', 'Ouuuu', 1, 35, 500, 0, 2, 1, 0, 0, 1, 0, 1),
(56, 'uploads/46.png', 'Hello', 'Birthday', 1, 397, 500, 1, 18, 1, 0, 0, 1, 1, 1),
(57, 'uploads/47.jpg', 'gygg', 'ijjvlkksdlkmvl', 1, 1, 5000, 1, 20, 1, 0, 0, 1, 1, 0),
(58, 'uploads/48.png', 'My random pin', 'I love it', 1, 22, 400, 0, 25, 10, 0, 0, 1, 0, 1),
(59, 'uploads/49.jpg', 'Avengers', 'Civil War', 1, 7, 250, 1, 28, 3, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Quotes`
--

CREATE TABLE `Quotes` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `SponsorPins`
--

CREATE TABLE `SponsorPins` (
  `PinId` int(11) NOT NULL,
  `Pic` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `UserId` int(11) NOT NULL,
  `NumVisits` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Seen` int(11) NOT NULL DEFAULT '1',
  `Timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SponsorPins`
--

INSERT INTO `SponsorPins` (`PinId`, `Pic`, `Name`, `Description`, `UserId`, `NumVisits`, `Status`, `Seen`, `Timestamp`) VALUES
(1, 'sponsoruploads/1.jpg', 'r3erf3wer', 'wer3we', 16, 4, 1, 1, '2017-12-25 05:25:02'),
(3, 'sponsoruploads/3.jpg', 'wsdws', 'adws', 16, 1, 1, 1, '2017-10-02 05:42:02'),
(4, 'sponsoruploads/4.jpg', 'dwdws', 'wsw', 16, 2, 1, 1, '2017-12-23 11:34:22'),
(5, 'sponsoruploads/5.jpg', 'fdwdw', 'vdfcde', 16, 0, 1, 1, '2017-10-02 05:50:24'),
(6, 'sponsoruploads/6.jpg', 'fdged', 'he4tgr4t', 16, 2, 1, 1, '2017-10-02 05:52:35'),
(7, 'sponsoruploads/7.jpg', 'dwsdswd', 'dcwsds', 16, 0, 0, 1, '2017-10-02 05:50:30'),
(8, 'sponsoruploads/8.jpg', 'grtge4', 'efee', 16, 0, 0, 0, '2017-09-30 15:08:59'),
(9, 'sponsoruploads/9.jpg', 'u6576', 't5y5', 16, 0, 0, 0, '2017-09-30 15:10:47'),
(10, 'sponsoruploads/10.jpg', 'edrfswred', 'grgrf', 16, 0, 0, 0, '2017-09-30 15:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `Sports`
--

CREATE TABLE `Sports` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Sports`
--

INSERT INTO `Sports` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 41, 0, '2017-09-22 08:53:48'),
(2, 53, 0, '2017-09-29 12:58:40'),
(3, 54, 0, '2017-09-29 12:58:58'),
(4, 58, 0, '2018-01-03 20:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `Tech`
--

CREATE TABLE `Tech` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tech`
--

INSERT INTO `Tech` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 52, 0, '2017-09-29 12:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `Travel`
--

CREATE TABLE `Travel` (
  `SrNo` int(5) NOT NULL,
  `PinId` int(5) NOT NULL,
  `likes` int(5) NOT NULL DEFAULT '0',
  `CreatedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Travel`
--

INSERT INTO `Travel` (`SrNo`, `PinId`, `likes`, `CreatedOn`) VALUES
(1, 32, 0, '2017-09-15 10:30:12'),
(2, 39, 0, '2017-09-21 10:57:42'),
(3, 40, 0, '2017-09-21 11:01:11'),
(4, 42, 0, '2017-09-22 09:19:14'),
(5, 43, 0, '2017-09-22 09:19:52'),
(6, 44, 0, '2017-09-22 09:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserId` int(5) NOT NULL,
  `UserName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Pwd` varchar(20) NOT NULL,
  `Type` int(5) NOT NULL DEFAULT '0' COMMENT '0 is user, 1 is admin',
  `Dp` varchar(512) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `NumLikedPins` int(5) DEFAULT '0',
  `NumBoards` int(10) DEFAULT '0',
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0: blocked;1: active',
  `Online` varchar(40) NOT NULL DEFAULT 'Away',
  `LastSeen` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `TimeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserId`, `UserName`, `Email`, `Pwd`, `Type`, `Dp`, `Address`, `NumLikedPins`, `NumBoards`, `Status`, `Online`, `LastSeen`, `TimeStamp`, `Website`) VALUES
(1, 'username', 'email', 'password', 0, '/hello', NULL, 0, 0, 0, 'Away', '2018-01-02 20:24:18', '2017-09-22 16:37:03', ''),
(2, 'tonystark', 'tony@stark.com', 'tony', 0, 'myname.png', 'Pune', 19, 6, 1, 'Away', '2018-01-04 03:18:37', '2018-01-03 21:48:37', ''),
(3, 'canteen', 'canteen@gmail.com', 'canteen', 1, 'ironman.png', NULL, 0, 0, 1, 'Away', '2018-01-04 02:53:56', '2018-01-03 21:23:56', ''),
(4, 'Aniruddha', 'ani@gmail.com', 'hello', 0, 'WBS.png', 'Pune', 0, 0, 1, 'Away', '2018-01-04 02:34:04', '2018-01-03 21:04:04', ''),
(5, 'werlghwerljgwerg', 'email@gmail.com', 'email', 0, 'keystore1.png', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 07:50:46', ''),
(6, 'qweqwrqwr', 'asdf@gmail.com', 'qwe', 0, 'm2.png', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 07:54:17', ''),
(7, 'sarahnaik', 'a@b.com', '1234', 0, '', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 18:44:39', ''),
(8, 'ss', '12@12.com', '1234', 0, 'cf8fe14224d7ce835a0c346f0c440b42.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 18:45:33', ''),
(9, 'ssrb', 'abc@xyz.com', '1234', 0, 'cf8fe14224d7ce835a0c346f0c440b42.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 19:01:25', ''),
(10, 'erty', 'as@re.com', '1234', 0, 'cf8fe14224d7ce835a0c346f0c440b42.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 19:02:51', ''),
(11, 'dfg', 'po@iu.com', 'poiu', 0, 'cf8fe14224d7ce835a0c346f0c440b42.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 19:18:59', ''),
(12, '7uo98', 'lk@jh', 'lkjh', 0, 'bfbd1766a3bd04301811eab1b223a308.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-07 19:21:33', ''),
(13, 'eryy', 'we@we.com', 'wewe', 0, 'm2.png', '', 0, 1, 1, 'Away', '2018-01-02 20:24:18', '2017-10-01 14:36:06', ''),
(14, 'Rutuja', 'p@gmail.com', '123456', 0, 'm2.png', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-22 10:19:16', ''),
(15, 'dwd', 'qw@er', 'qwer', 0, 'sport48.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-29 13:26:31', NULL),
(16, 'wer', 'we@r.com', 'wer', 2, 'sport47.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-09-29 13:27:53', 'www.google.com'),
(17, 'sanah', 'sa@nah.com', 'sanah', 2, 'travel11.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-10-01 09:12:56', 'www.pinterest.com'),
(18, 'Shubham Revanwar', 's@r.com', '1234', 0, 'freeheh.png', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-12-03 21:03:47', NULL),
(19, 'siddharth', 's@b.com', '123', 0, 'freehehh.png', 'Pune', 1, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-12-03 21:15:40', NULL),
(20, 'hpahade', 'harshalpahade@gmail.com', 'Pinstagram@1', 0, 'Photo Scan.jpg', NULL, 0, 0, 1, 'Away', '2018-01-02 20:24:18', '2017-12-25 05:12:31', NULL),
(21, 'Vivek', 'v@gmail.com', 'hello', 0, 'ironman.png', NULL, 1, 0, 1, 'Away', '2018-01-04 00:38:29', '2018-01-03 19:08:29', NULL),
(22, 'Junaid', 'j@gmail.com', 'hello', 0, 'm2.png', NULL, 0, 0, 1, 'Away', '2018-01-04 01:24:04', '2018-01-03 19:54:04', NULL),
(23, 'Sagar', 's@gmail.com', 'hello', 0, 'stackoverflow1.png', NULL, 0, 0, 1, 'Away', '2018-01-03 08:11:20', '2018-01-03 02:41:20', NULL),
(24, 'Anuj', 'a@gmail.com', 'hello', 0, 'man1.png', 'Hello', 1, 0, 1, 'Away', '2018-01-03 08:35:09', '2018-01-03 20:19:54', NULL),
(25, 'Rohit', 'rs@gmail.com', 'hello', 0, 'rohitsharma.jpeg', NULL, 0, 0, 1, 'Away', '2018-01-04 02:32:08', '2018-01-03 21:02:08', NULL),
(26, 'Amitabh', 'ab@gmail.com', 'hello', 0, 'amitabh.jpg', NULL, 0, 0, 1, 'Away', '2018-01-04 02:07:45', '2018-01-03 20:37:45', NULL),
(27, 'Sachin T', 'srt@gmail.com', 'hello', 0, 'girl.png', NULL, 0, 0, 1, 'Away', '2018-01-04 02:13:58', '2018-01-03 20:43:58', NULL),
(28, 'Anuj Pahade', 'apahade@gmail.com', 'hello', 0, 'anujdpfb.jpg', NULL, 0, 0, 1, 'Away', '2018-01-04 02:52:01', '2018-01-03 21:22:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Art`
--
ALTER TABLE `Art`
  ADD PRIMARY KEY (`SrNo`),
  ADD UNIQUE KEY `PinId` (`PinId`);

--
-- Indexes for table `Board`
--
ALTER TABLE `Board`
  ADD PRIMARY KEY (`BoardId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `BoardPins`
--
ALTER TABLE `BoardPins`
  ADD PRIMARY KEY (`PinId`);

--
-- Indexes for table `BuyPin`
--
ALTER TABLE `BuyPin`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `CarsAndMotorcycles`
--
ALTER TABLE `CarsAndMotorcycles`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`CatId`),
  ADD UNIQUE KEY `CatName` (`CatName`);

--
-- Indexes for table `Celebrities`
--
ALTER TABLE `Celebrities`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`srno`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Education`
--
ALTER TABLE `Education`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `FollowBoard`
--
ALTER TABLE `FollowBoard`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`),
  ADD KEY `BoardId` (`BoardId`);

--
-- Indexes for table `FollowCat`
--
ALTER TABLE `FollowCat`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `CatId` (`CatId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `FollowUser`
--
ALTER TABLE `FollowUser`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `UserId1` (`UserId1`);

--
-- Indexes for table `FoodDrink`
--
ALTER TABLE `FoodDrink`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Humour`
--
ALTER TABLE `Humour`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `LikePin`
--
ALTER TABLE `LikePin`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `Notification`
--
ALTER TABLE `Notification`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Outdoors`
--
ALTER TABLE `Outdoors`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Photography`
--
ALTER TABLE `Photography`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Pin`
--
ALTER TABLE `Pin`
  ADD PRIMARY KEY (`PinId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `CatId` (`CatId`);

--
-- Indexes for table `Quotes`
--
ALTER TABLE `Quotes`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `SponsorPins`
--
ALTER TABLE `SponsorPins`
  ADD PRIMARY KEY (`PinId`);

--
-- Indexes for table `Sports`
--
ALTER TABLE `Sports`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Tech`
--
ALTER TABLE `Tech`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `Travel`
--
ALTER TABLE `Travel`
  ADD PRIMARY KEY (`SrNo`),
  ADD KEY `PinId` (`PinId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `NumLikedPins` (`NumLikedPins`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Art`
--
ALTER TABLE `Art`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `Board`
--
ALTER TABLE `Board`
  MODIFY `BoardId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `BoardPins`
--
ALTER TABLE `BoardPins`
  MODIFY `PinId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `BuyPin`
--
ALTER TABLE `BuyPin`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `CarsAndMotorcycles`
--
ALTER TABLE `CarsAndMotorcycles`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `CatId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Celebrities`
--
ALTER TABLE `Celebrities`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `srno` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `SrNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `Education`
--
ALTER TABLE `Education`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `FollowBoard`
--
ALTER TABLE `FollowBoard`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `FollowCat`
--
ALTER TABLE `FollowCat`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `FollowUser`
--
ALTER TABLE `FollowUser`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `FoodDrink`
--
ALTER TABLE `FoodDrink`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Humour`
--
ALTER TABLE `Humour`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `LikePin`
--
ALTER TABLE `LikePin`
  MODIFY `SrNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `Notification`
--
ALTER TABLE `Notification`
  MODIFY `SrNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `Outdoors`
--
ALTER TABLE `Outdoors`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Photography`
--
ALTER TABLE `Photography`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Pin`
--
ALTER TABLE `Pin`
  MODIFY `PinId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `Quotes`
--
ALTER TABLE `Quotes`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SponsorPins`
--
ALTER TABLE `SponsorPins`
  MODIFY `PinId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `Sports`
--
ALTER TABLE `Sports`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `Tech`
--
ALTER TABLE `Tech`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Travel`
--
ALTER TABLE `Travel`
  MODIFY `SrNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserId` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Art`
--
ALTER TABLE `Art`
  ADD CONSTRAINT `Art_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Board`
--
ALTER TABLE `Board`
  ADD CONSTRAINT `Board_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `BuyPin`
--
ALTER TABLE `BuyPin`
  ADD CONSTRAINT `BuyPin_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`),
  ADD CONSTRAINT `BuyPin_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `CarsAndMotorcycles`
--
ALTER TABLE `CarsAndMotorcycles`
  ADD CONSTRAINT `CarsAndMotorcycles_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Celebrities`
--
ALTER TABLE `Celebrities`
  ADD CONSTRAINT `Celebrities_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`),
  ADD CONSTRAINT `Comments_ibfk_2` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Education`
--
ALTER TABLE `Education`
  ADD CONSTRAINT `Education_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `FollowBoard`
--
ALTER TABLE `FollowBoard`
  ADD CONSTRAINT `FollowBoard_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `BoardPins` (`PinId`),
  ADD CONSTRAINT `FollowBoard_ibfk_2` FOREIGN KEY (`BoardId`) REFERENCES `Board` (`BoardId`);

--
-- Constraints for table `FollowCat`
--
ALTER TABLE `FollowCat`
  ADD CONSTRAINT `FollowCat_ibfk_1` FOREIGN KEY (`CatId`) REFERENCES `Categories` (`CatId`),
  ADD CONSTRAINT `FollowCat_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `FollowUser`
--
ALTER TABLE `FollowUser`
  ADD CONSTRAINT `FollowUser_ibfk_1` FOREIGN KEY (`UserId1`) REFERENCES `User` (`UserId`),
  ADD CONSTRAINT `FollowUser_ibfk_2` FOREIGN KEY (`UserId1`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `FoodDrink`
--
ALTER TABLE `FoodDrink`
  ADD CONSTRAINT `FoodDrink_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Humour`
--
ALTER TABLE `Humour`
  ADD CONSTRAINT `Humour_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `LikePin`
--
ALTER TABLE `LikePin`
  ADD CONSTRAINT `LikePin_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`),
  ADD CONSTRAINT `LikePin_ibfk_2` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `Notification`
--
ALTER TABLE `Notification`
  ADD CONSTRAINT `Notification_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`);

--
-- Constraints for table `Outdoors`
--
ALTER TABLE `Outdoors`
  ADD CONSTRAINT `Outdoors_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Photography`
--
ALTER TABLE `Photography`
  ADD CONSTRAINT `Photography_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Pin`
--
ALTER TABLE `Pin`
  ADD CONSTRAINT `Pin_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `User` (`UserId`),
  ADD CONSTRAINT `Pin_ibfk_2` FOREIGN KEY (`CatId`) REFERENCES `Categories` (`CatId`);

--
-- Constraints for table `Quotes`
--
ALTER TABLE `Quotes`
  ADD CONSTRAINT `Quotes_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Sports`
--
ALTER TABLE `Sports`
  ADD CONSTRAINT `Sports_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Tech`
--
ALTER TABLE `Tech`
  ADD CONSTRAINT `Tech_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

--
-- Constraints for table `Travel`
--
ALTER TABLE `Travel`
  ADD CONSTRAINT `Travel_ibfk_1` FOREIGN KEY (`PinId`) REFERENCES `Pin` (`PinId`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `POM` ON SCHEDULE EVERY 1 MINUTE STARTS '2017-10-02 09:00:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
UPDATE Pin SET Score=0; END$$

CREATE DEFINER=`root`@`localhost` EVENT `Seen` ON SCHEDULE EVERY 1 MINUTE STARTS '2017-10-02 10:08:00' ON COMPLETION PRESERVE ENABLE DO BEGIN
UPDATE SponsorPins SET Seen=0 WHERE CURRENT_TIMESTAMP>(Timestamp+INTERVAL'2' HOUR); END$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
