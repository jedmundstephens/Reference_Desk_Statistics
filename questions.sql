SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `reference`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID` int(8) NOT NULL auto_increment,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Research` tinyint(1) NOT NULL,
  `Directional` tinyint(1) NOT NULL,
  `Computer_Help` tinyint(1) NOT NULL,
  `Print_Copy` tinyint(1) NOT NULL,
  `eLearning` tinyint(1) NOT NULL,
  `Consultation` tinyint(1) NOT NULL,
  `Notes` text NOT NULL,
  `Librarian` text NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5704 ;