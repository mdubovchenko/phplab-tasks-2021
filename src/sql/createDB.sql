CREATE DATABASE IF NOT EXISTS onlineShop;

CREATE TABLE IF NOT EXISTS `order` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerFirstName` varchar(255) NOT NULL,
  `customerLastName` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE IF NOT EXISTS `orderLine` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderID` int(10) unsigned NOT NULL DEFAULT '0',
  `productID` int(10) unsigned NOT NULL DEFAULT '0',
  `quantity` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
);

CREATE TABLE IF NOT EXISTS `products` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
);

INSERT INTO `order` (`ID`, `customerFirstName`, `customerLastName`) VALUES
(1, 'Bob', 'Smith'),
(2, 'Jhon', 'Ivanov'),
(3, 'Jane', 'Smith'),
(4, 'Anna', 'Tran'),
(5, 'Linda', 'Lawrence'),
(6, 'Jane', 'Cooper'),
(7, 'Jack', 'Milles'),
(8, 'Katy', 'Green'),
(9, 'Bob', 'Brown'),
(10, 'Polly', 'Pan');

INSERT INTO `orderLine` (`ID`, `orderID`, `productID`, `quantity`) VALUES
(1, 1, 1, 2),
(2, 1, 3, 4),
(3, 2, 4, 1),
(4, 3, 1, 2),
(5, 4, 5, 4),
(6, 5, 2, 3),
(7, 5, 1, 2),
(8, 6, 4, 7),
(9, 7, 5, 5),
(10, 8, 1, 10),
(11, 9, 3, 4),
(12, 10, 3, 1),
(13, 10, 2, 8);

INSERT INTO `products` (`ID`, `name`, `price`) VALUES
(1, 'iPhone', 101.99),
(2, 'Samsung Galaxy', 92.99),
(3, 'Lenovo P2', 88.79),
(4, 'HP Pavilion', 98.79),
(5, 'Xiaomi MI10', 90),
(6, 'Xiaomi Note 5', 95),
(7, 'Lg L90', 85);

ALTER TABLE `orderLine`
ADD FOREIGN KEY (`orderID`)
REFERENCES `order` (`ID`);

ALTER TABLE `orderLine`
ADD FOREIGN KEY (`productID`)
REFERENCES `products` (`ID`);
