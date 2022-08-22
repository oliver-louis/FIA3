-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2022 at 02:18 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `covidtracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `AttendanceID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ClassID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`AttendanceID`, `UserID`, `ClassID`) VALUES
(202, 0, 0),
(274, 1, 8),
(344, 1, 15),
(366, 1, 17),
(203, 2, 1),
(263, 2, 7),
(293, 2, 10),
(323, 2, 13),
(373, 2, 18),
(204, 3, 1),
(214, 3, 2),
(224, 3, 3),
(275, 3, 8),
(345, 3, 15),
(367, 3, 17),
(387, 3, 19),
(402, 3, 20),
(213, 4, 2),
(243, 4, 5),
(313, 4, 12),
(333, 4, 14),
(383, 4, 19),
(205, 8, 1),
(215, 8, 2),
(225, 8, 3),
(276, 8, 8),
(346, 8, 15),
(368, 8, 17),
(380, 8, 18),
(206, 9, 1),
(216, 9, 2),
(226, 9, 3),
(244, 9, 5),
(277, 9, 8),
(347, 9, 15),
(381, 9, 18),
(207, 11, 1),
(217, 11, 2),
(227, 11, 3),
(245, 11, 5),
(278, 11, 8),
(324, 11, 13),
(358, 11, 16),
(382, 11, 18),
(384, 11, 19),
(208, 13, 1),
(218, 13, 2),
(228, 13, 3),
(246, 13, 5),
(279, 13, 8),
(284, 13, 9),
(325, 13, 13),
(359, 13, 16),
(385, 13, 19),
(394, 13, 20),
(209, 15, 1),
(219, 15, 2),
(229, 15, 3),
(247, 15, 5),
(280, 15, 8),
(285, 15, 9),
(326, 15, 13),
(360, 15, 16),
(369, 15, 17),
(386, 15, 19),
(395, 15, 20),
(210, 16, 1),
(220, 16, 2),
(230, 16, 3),
(248, 16, 5),
(264, 16, 7),
(281, 16, 8),
(286, 16, 9),
(327, 16, 13),
(361, 16, 16),
(370, 16, 17),
(211, 19, 1),
(221, 19, 2),
(231, 19, 3),
(249, 19, 5),
(265, 19, 7),
(282, 19, 8),
(287, 19, 9),
(328, 19, 13),
(362, 19, 16),
(377, 19, 18),
(388, 19, 19),
(233, 20, 4),
(253, 20, 6),
(303, 20, 11),
(343, 20, 15),
(363, 20, 17),
(212, 21, 1),
(222, 21, 2),
(232, 21, 3),
(234, 21, 4),
(250, 21, 5),
(266, 21, 7),
(288, 21, 9),
(314, 21, 12),
(329, 21, 13),
(378, 21, 18),
(235, 22, 4),
(251, 22, 5),
(267, 22, 7),
(289, 22, 9),
(294, 22, 10),
(315, 22, 12),
(330, 22, 13),
(349, 22, 15),
(379, 22, 18),
(396, 22, 20),
(236, 24, 4),
(252, 24, 5),
(268, 24, 7),
(290, 24, 9),
(295, 24, 10),
(316, 24, 12),
(331, 24, 13),
(350, 24, 15),
(389, 24, 19),
(237, 29, 4),
(269, 29, 7),
(291, 29, 9),
(296, 29, 10),
(317, 29, 12),
(332, 29, 13),
(351, 29, 15),
(371, 29, 17),
(238, 31, 4),
(270, 31, 7),
(292, 31, 9),
(297, 31, 10),
(318, 31, 12),
(352, 31, 15),
(391, 31, 19),
(239, 32, 4),
(254, 32, 6),
(271, 32, 7),
(298, 32, 10),
(319, 32, 12),
(240, 33, 4),
(255, 33, 6),
(272, 33, 7),
(299, 33, 10),
(304, 33, 11),
(320, 33, 12),
(342, 33, 14),
(372, 33, 17),
(397, 33, 20),
(241, 35, 4),
(256, 35, 6),
(300, 35, 10),
(305, 35, 11),
(321, 35, 12),
(334, 35, 14),
(242, 36, 4),
(257, 36, 6),
(301, 36, 10),
(306, 36, 11),
(322, 36, 12),
(335, 36, 14),
(355, 36, 16),
(390, 36, 19),
(398, 36, 20),
(223, 37, 3),
(273, 37, 8),
(283, 37, 9),
(353, 37, 16),
(393, 37, 20),
(258, 41, 6),
(302, 41, 10),
(307, 41, 11),
(336, 41, 14),
(356, 41, 16),
(399, 41, 20),
(259, 42, 6),
(308, 42, 11),
(337, 42, 14),
(357, 42, 16),
(374, 42, 18),
(392, 42, 19),
(400, 42, 20),
(260, 45, 6),
(309, 45, 11),
(338, 45, 14),
(375, 45, 18),
(261, 47, 6),
(310, 47, 11),
(339, 47, 14),
(364, 47, 17),
(376, 47, 18),
(401, 47, 20),
(262, 48, 6),
(311, 48, 11),
(340, 48, 14),
(365, 48, 17),
(312, 50, 11),
(341, 50, 14),
(348, 50, 15),
(354, 50, 16);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `ClassID` int(8) NOT NULL,
  `Day` int(8) NOT NULL,
  `Period` int(8) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Room` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`ClassID`, `Day`, `Period`, `Subject`, `Room`) VALUES
(2, 1, 1, 'Digital Solutions', 'S2.3'),
(3, 1, 2, 'English', 'W1'),
(4, 1, 3, 'Maths', 'T1'),
(5, 1, 4, 'Science', 'S1'),
(6, 2, 1, 'English', 'W1'),
(7, 2, 2, 'Science', 'S1'),
(8, 2, 3, 'Digital Solutions', 'S2.3'),
(9, 2, 4, 'Maths', 'T1'),
(10, 3, 1, 'Maths', 'T1'),
(11, 3, 2, 'Digital Solutions', 'S2.3'),
(12, 3, 3, 'Science', 'S1'),
(13, 3, 4, 'English', 'W1'),
(14, 4, 1, 'Digital Solutions', 'S2.3'),
(15, 4, 2, 'English', 'W1'),
(16, 4, 3, 'Science', 'S1'),
(17, 4, 4, 'Maths', 'T1'),
(18, 5, 1, 'Science', 'S1'),
(19, 5, 2, 'Digital Solutions', 'S2.3'),
(20, 5, 3, 'English', 'W1'),
(21, 5, 4, 'Maths', 'T1');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `StatusID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL,
  `IsoStart` date NOT NULL,
  `IsoEnd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusID`, `UserID`, `Status`, `IsoStart`, `IsoEnd`) VALUES
(69, 54, 1, '2022-08-04', '2022-08-18'),
(75, 4, 1, '2022-08-02', '2022-08-16'),
(123, 53, 1, '2022-08-17', '2022-08-31'),
(124, 23, 1, '2022-08-21', '2022-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Staff` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `Surname`, `Email`, `Password`, `Staff`) VALUES
(2, 'Virgilio', 'Sincock', 'vsincock0@naver.com', 'BqAEz6NgPx', 0),
(3, 'Koressa', 'Alpes', 'kalpes1@eepurl.com', 'QXC9tS', 1),
(4, 'Briant', 'Skuce', 'bskuce2@google.com.hk', 'v4jMtYcVn', 0),
(5, 'Ruben', 'Bechley', 'rbechley3@slate.com', 'ZSMAjMsT', 1),
(6, 'Theodore', 'Veryan', 'tveryan4@mtv.com', '1DeyWViF9JvS', 1),
(7, 'Ashly', 'Rubra', 'arubra5@dedecms.com', 'FZxsWMsvIk', 1),
(8, 'Danny', 'Marple', 'dmarple6@lulu.com', 'IJM3U7rb43z', 1),
(9, 'Fran', 'Reinmar', 'freinmar7@taobao.com', 'TvEKzDwu', 0),
(10, 'Judi', 'Franz-Schoninger', 'jfranzschoninger8@answers.com', '7SLB5M3yF4nt', 0),
(11, 'Cordey', 'Joontjes', 'cjoontjes9@163.com', '0AM2xL', 1),
(12, 'Kaia', 'McKeran', 'kmckerana@merriam-webster.com', 'SBy392XxXaQF', 0),
(13, 'Peggy', 'Newlin', 'pnewlinb@360.cn', '8EMgDea9utH', 1),
(14, 'Bunny', 'Brafield', 'bbrafieldc@soundcloud.com', 'KngAze', 0),
(15, 'Abbott', 'Dimberline', 'adimberlined@gov.uk', 'Owa2u5Ss', 1),
(16, 'Glyn', 'Lantiffe', 'glantiffee@npr.org', 'despngJcGU8', 0),
(17, 'Estel', 'Benoiton', 'ebenoitonf@google.pl', '1f829cZcNbRU', 0),
(18, 'Fanchon', 'Diggle', 'fdiggleg@smugmug.com', 'Qe1y7Y7Qa', 1),
(19, 'Joli', 'Flageul', 'jflageulh@google.com.hk', 'lKg64meVc', 1),
(20, 'Ashly', 'Goford', 'agofordi@dell.com', 'RtZ1lf4l', 0),
(21, 'Blinnie', 'Birkin', 'bbirkinj@berkeley.edu', 'kH308i6wput', 1),
(22, 'Kris', 'Boik', 'kboikk@wiley.com', 'WFxaJP', 0),
(23, 'Winnah', 'Verity', 'wverityl@springer.com', '6HVBZllQ', 0),
(24, 'Izaak', 'Milley', 'imilleym@tuttocitta.it', '556B59y3Y7Wm', 1),
(25, 'Halsy', 'Schukraft', 'hschukraftn@live.com', 'wSb0aI', 0),
(26, 'Millie', 'Pauluzzi', 'mpauluzzio@scribd.com', '83f12X', 1),
(27, 'Colette', 'Zorener', 'czorenerp@about.com', 'GtGJk4', 1),
(28, 'Dorotea', 'Brabbs', 'dbrabbsq@nytimes.com', 'y2c53YlMsNL', 1),
(29, 'Tallou', 'La Wille', 'tlawiller@sogou.com', 'MlLheH9g6gm', 1),
(30, 'Westleigh', 'Langton', 'wlangtons@cargocollective.com', '2m2clBu5ht', 0),
(31, 'Donnell', 'Tayt', 'dtaytt@mayoclinic.com', 'oM281l', 1),
(32, 'Emerson', 'Adam', 'eadamu@ovh.net', 'RbLqJv', 0),
(33, 'Cherye', 'Abramsky', 'cabramskyv@domainmarket.com', 'PU93eOTuZ2r', 0),
(34, 'Alma', 'O''Hartigan', 'aohartiganw@mac.com', 'cJPnDSg', 0),
(35, 'Kirstyn', 'Presser', 'kpresserx@lulu.com', 'b7n4xwAFT8', 1),
(36, 'Ransom', 'Raynham', 'rraynhamy@sbwire.com', 'EUe4Qo3rL2N', 0),
(37, 'Hansiain', 'Sandeson', 'hsandesonz@slate.com', 'Z80li91Zw0', 0),
(38, 'Britta', 'Oakenfall', 'boakenfall10@berkeley.edu', 'tIdKDdYE3AF', 1),
(39, 'Alexei', 'Asals', 'aasals11@epa.gov', 'hi3RM0', 1),
(40, 'Moore', 'Parratt', 'mparratt12@4shared.com', 'EQfJKK', 1),
(41, 'Otho', 'Pasterfield', 'opasterfield13@stumbleupon.com', 'bN9VUQ', 1),
(42, 'Rinaldo', 'MacWilliam', 'rmacwilliam14@eventbrite.com', 'dqAnG8nXW', 0),
(43, 'Ogdan', 'Elderkin', 'oelderkin15@webeden.co.uk', '7t2Xm5ufv', 0),
(44, 'Rubina', 'Jiggens', 'rjiggens16@vinaora.com', 'nlvZQJ', 1),
(45, 'Farrell', 'Leele', 'fleele17@ifeng.com', 'OKjpQPL1pf', 1),
(46, 'Dido', 'Doone', 'ddoone18@si.edu', 'a2bCfGV4WvqG', 0),
(47, 'Skipper', 'Oulner', 'soulner19@t.co', '7JBVGc', 1),
(48, 'Aurel', 'Misselbrook', 'amisselbrook1a@mediafire.com', 'DxWzVepRH', 0),
(49, 'Krysta', 'Turvie', 'kturvie1b@vinaora.com', 'jH0JyBMH27', 0),
(50, 'Imogene', 'Tollmache', 'itollmache1c@dedecms.com', 'YG33g4Zovt', 1),
(51, 'Iosep', 'Shipp', 'ishipp1d@hibu.com', 'bizgGLJEMcKp', 0),
(52, 'test', 'user', 'admin', 'admin', 1),
(53, 'student', 'test', 'student', 'student', 0),
(54, 'positive', 'student', 'positive', 'positive', 0),
(55, 'Jack', 'McLuckie', 'jackowacko@methlab.com.au', '7777777', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`AttendanceID`),
  ADD KEY `ClassID` (`UserID`,`ClassID`),
  ADD KEY `user no action` (`ClassID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `AttendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;
--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `ClassID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `class no action` FOREIGN KEY (`UserID`) REFERENCES `classes` (`ClassID`),
  ADD CONSTRAINT `user no action` FOREIGN KEY (`ClassID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`StatusID`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
