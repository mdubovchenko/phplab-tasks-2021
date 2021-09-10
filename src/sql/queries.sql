USE `onlineshop`;

// DISTINCT
SELECT DISTINCT `customerFirstName` FROM `order`;

// RIGHT JOIN
SELECT `orderID`, `productID`, `name`, `price`
FROM `orderLine` RIGHT JOIN `products`
ON `productID` = `products`.`ID`
WHERE `orderID` IS NULL;

// LEFT JOIN, NOT
SELECT `orderID`, `productID`, `name`, `price`
FROM `products` LEFT JOIN `orderLine`
ON `productID` = `products`.`ID`
WHERE `productID` IS NOT NULL;

// WHERE, INNER JOIN, SUM, GROUP BY, AND, Subquerie
SELECT T1.`person`, T1.`total`
	FROM (SELECT `orderLine`.`ID`, `orderID`, CONCAT (`customerFirstName`, ' ', `customerLastName`) AS `person`, `name` AS 'product', SUM(`quantity`*`price`) AS 'total', `quantity` 
			FROM `order` JOIN `products` JOIN `orderLine` 
			ON `orderLine`.`orderID` = `order`.`ID` AND `orderLine`.`productID` = `products`.`ID`
			GROUP BY `orderLine`.`ID`) AS T1
    WHERE T1.`Total` > 100 AND T1.`Total` < 500;

// LIMIT, BETWEEN, UNION
SELECT `ID`, `customerFirstName` FROM `order` LIMIT 5
UNION
SELECT `ID`, `customerFirstName` FROM `order` WHERE ID BETWEEN 6 AND 10;

// IN, LIKE, UNION ALL
SELECT `ID`, `name` FROM `products` WHERE `name` IN ('iPhone', 'Xiaomi MI10')
UNION ALL
SELECT `ID`, `name` FROM `products` WHERE `name` LIKE 'i%';
 
// AVG, HAVING, ORDER BY, DESC
SELECT `productID`, `name`, AVG(`quantity`*`price`) FROM `orderLine` JOIN `products`
ON `productID` = `products`.`ID`
GROUP BY `productID` HAVING AVG(`quantity`*`price`) > 400
ORDER BY AVG(`quantity`*`price`) DESC;

// MIN, MAX. COUNT
SELECT MIN(`price`) AS 'minPrice', MAX(`price`) AS 'maxPrice', COUNT(`name`) AS 'quantityOfGoods' FROM `products`;

// View
CREATE VIEW `customers` AS
SELECT `ID`, concat(`customerFirstName`, ' ', `customerLastName`) AS `customer`
FROM `order`;
SELECT * FROM `customers`;

