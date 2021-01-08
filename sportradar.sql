-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2021 at 12:47 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sportradar`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `calendar`
-- (See below for the actual view)
--
CREATE TABLE `calendar` (
`DateTime` datetime
,`League` varchar(60)
,`Sport` varchar(60)
,`HomeTeam` varchar(60)
,`AwayTeam` varchar(60)
);

-- --------------------------------------------------------

--
-- Table structure for table `clubs`
--

CREATE TABLE `clubs` (
  `ClubID` int(11) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `City` varchar(60) NOT NULL,
  `Country` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clubs`
--

INSERT INTO `clubs` (`ClubID`, `Name`, `City`, `Country`) VALUES
(1, 'Real Madrid FC', 'Madrid', 'Spain'),
(2, 'Paris SG', 'Paris', 'France'),
(3, 'FC Barcelona', 'Barcelona', 'Spain'),
(4, 'FC Bayern München', 'München', 'Germany'),
(5, 'New England Patriots', 'Boston', 'USA'),
(6, 'Atlanta Falcons', 'Atlanta', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `League` varchar(60) NOT NULL,
  `Sport` varchar(60) NOT NULL,
  `_HomeTeam` int(11) NOT NULL,
  `_AwayTeam` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `DateTime`, `League`, `Sport`, `_HomeTeam`, `_AwayTeam`) VALUES
(1, '2021-01-24 18:00:00', 'La Liga', 'Football', 3, 1),
(2, '2021-02-15 22:00:00', 'Champion League', 'Football', 4, 2),
(3, '2021-01-26 23:54:00', 'NFL', 'American Football', 5, 6);

-- --------------------------------------------------------

--
-- Structure for view `calendar`
--
DROP TABLE IF EXISTS `calendar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `calendar`  AS SELECT `events`.`DateTime` AS `DateTime`, `events`.`League` AS `League`, `events`.`Sport` AS `Sport`, `club1`.`Name` AS `HomeTeam`, `club2`.`Name` AS `AwayTeam` FROM ((`events` join `clubs` `club1` on(`events`.`_HomeTeam` = `club1`.`ClubID`)) join `clubs` `club2` on(`events`.`_AwayTeam` = `club2`.`ClubID`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`ClubID`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `_HomeTeam` (`_HomeTeam`),
  ADD KEY `_AwayTeam` (`_AwayTeam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clubs`
--
ALTER TABLE `clubs`
  MODIFY `ClubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`_HomeTeam`) REFERENCES `clubs` (`ClubID`),
  ADD CONSTRAINT `events_ibfk_2` FOREIGN KEY (`_AwayTeam`) REFERENCES `clubs` (`ClubID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
