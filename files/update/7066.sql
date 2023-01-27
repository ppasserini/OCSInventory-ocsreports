-- Create layouts table
CREATE TABLE IF NOT EXISTS `reports_notifications` (
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `GROUP_ID` INT NOT NULL,
    `RECURRENCE` VARCHAR(255) NOT NULL,
    `END_DATE` DATETIME DEFAULT NULL,
    `DATE_CREATED` DATETIME DEFAULT NULL,
    `WEEKDAY` VARCHAR(255) DEFAULT NULL,
    `LAST_EXEC` DATETIME DEFAULT NULL,
    `MAIL` VARCHAR(255) NOT NULL,
    `STATUS` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;