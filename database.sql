CREATE TABLE `countdown` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `start` int DEFAULT NULL,
  `end` int DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO countdown (id, text, start, end) VALUES
(1, 'Text číslo 1', 5, 7),
(2, 'Text číslo 2', 14, 18),
(3, 'Text číslo 3', 20, 4),
(4, 'Text číslo 4', 18, 19);