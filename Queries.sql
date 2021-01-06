CREATE TABLE `sportradar`.`events`(
    `EventID` INT NOT NULL AUTO_INCREMENT,
    `DateTime` DATETIME NOT NULL,
    `League` VARCHAR(60) NOT NULL,
    `Sport` VARCHAR(60) NOT NULL,
    `_HomeTeam` INT NOT NULL,
    `_AwayTeam` INT NOT NULL,
    PRIMARY KEY(`EventID`)
);

CREATE TABLE `sportradar`.`clubs`(
    `ClubID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(60) NOT NULL,
    `City` VARCHAR(60) NOT NULL,
    `Country` VARCHAR(60) NOT NULL,
    PRIMARY KEY(`ClubID`)
);

ALTER TABLE
    `events` ADD FOREIGN KEY(`_HomeTeam`) REFERENCES `clubs`(`ClubID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE
    `events` ADD FOREIGN KEY(`_AwayTeam`) REFERENCES `clubs`(`ClubID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

INSERT INTO `clubs`(`ClubID`, `Name`, `City`, `Country`)
VALUES(
    NULL,
    'Real Madrid FC',
    'Madrid',
    'Spain'
),(NULL, 'Paris SG', 'Paris', 'France'),(
    NULL,
    'FC Barcelona',
    'Barcelona',
    'Spain'
),(
    NULL,
    'FC Bayern München',
    'München',
    'Germany'
);