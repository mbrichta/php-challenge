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

CREATE VIEW Calendar AS SELECT EVENTS
    .DateTime,
    EVENTS.League,
    EVENTS.Sport,
    club1.Name AS "HomeTeam",
    club2.Name AS "AwayTeam"
FROM EVENTS
JOIN clubs club1 ON EVENTS
    ._HomeTeam = club1.ClubID
JOIN clubs club2 ON EVENTS
    ._AwayTeam = club2.ClubID;

INSERT INTO `events`(
    `EventID`,
    `DateTime`,
    `League`,
    `Sport`,
    `_HomeTeam`,
    `_AwayTeam`
)
VALUES(
    NULL,
    '2021-01-24 18:00:00',
    'La Liga',
    'Football',
    '3',
    '1'
),(
    NULL,
    '2021-02-15 22:00:00',
    'Champion League',
    'Football',
    '4',
    '2'
);