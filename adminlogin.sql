CREATE DATABASE IF NOT EXISTS `adminlogin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `adminlogin`;

DROP TABLE IF EXISTS `userName`;
CREATE TABLE IF NOT EXISTS `userName` (
  `UserNameID` int(9) NOT NULL AUTO_INCREMENT,
  `userName` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  PRIMARY KEY (`UserNameID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO `userName` (`UserNameID`, `userName`, `pass`) VALUES
(1, 'drkostas', '7945');
INSERT INTO `userName` (`UserNameID`, `userName`, `pass`) VALUES
(2,'zavos','pao13');
