DROP DATABASE IF EXISTS labyrintheSilex;

CREATE DATABASE labyrintheSilex DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

use labyrintheSilex

CREATE TABLE parameter(
	width INT UNSIGNED NOT NULL,
	height INT UNSIGNED NOT NULL,
	color VARCHAR(20) NOT NULL
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO parameter (width, height, color)
VALUES
(5, 5, '#0F0F0F')
;