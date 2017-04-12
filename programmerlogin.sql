CREATE DATABASE IF NOT EXISTS `programmerlogin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `programmerlogin`;

DROP TABLE IF EXISTS `userName`;
CREATE TABLE IF NOT EXISTS `userName` (
  `apikey` varchar(40) NOT NULL ,
  `userName` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  PRIMARY KEY (`apikey`)
);

DROP TABLE IF EXISTS statistics;
CREATE TABLE IF NOT EXISTS statistics(
`api` VARCHAR(40),
`req1count` int(9) NOT NULL DEFAULT 0,
`req2count` int(9) NOT NULL DEFAULT 0,
`req3count` int(9) NOT NULL DEFAULT 0,
`req4count` int(9) NOT NULL DEFAULT 0,
`req5count` int(9) NOT NULL DEFAULT 0,
PRIMARY KEY(`api`),
CONSTRAINT YO FOREIGN KEY(`api`) REFERENCES userName(`apikey`) ON DELETE CASCADE ON UPDATE CASCADE
);

