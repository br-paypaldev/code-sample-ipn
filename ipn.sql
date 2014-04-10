CREATE SCHEMA IF NOT EXISTS `code_sample`;

USE `code_sample`;

CREATE TABLE `ipn` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `txn_id` INT UNSIGNED DEFAULT NULL,
    `txn_type` VARCHAR(55) DEFAULT NULL,
    `receiver_email` VARCHAR(127) NOT NULL,
    `payment_status` VARCHAR(17) DEFAULT NULL,
    `pending_reason` VARCHAR(17) DEFAULT NULL,
    `reason_code` VARCHAR(31) DEFAULT NULL,
    `custom` VARCHAR(45) DEFAULT NULL,
    `invoice` VARCHAR(45) DEFAULT NULL,
    `notification` MEDIUMTEXT NOT NULL,
    `hash` CHAR(32) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `hash_UNIQUE` (`hash`),
    KEY `custom` (`custom`,`payment_status`),
    KEY `invoice` (`invoice`,`payment_status`),
    KEY `type` (`txn_type`,`payment_status`),
    KEY `id` (`txn_id`,`payment_status`)
);
