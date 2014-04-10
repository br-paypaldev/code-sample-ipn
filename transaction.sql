CREATE SCHEMA IF NOT EXISTS `code_sample`;

USE `code_sample`;

CREATE  TABLE `transaction` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `invoice` VARCHAR(127) NULL DEFAULT NULL,
    `custom` VARCHAR(255) NULL DEFAULT NULL,
    `txn_type` VARCHAR(55) NOT NULL,
    `txn_id` INT NOT NULL,
    `payer_id` VARCHAR(13) NOT NULL,
    `currency` CHAR(3) NOT NULL,
    `gross` DECIMAL(10,2) NOT NULL,
    `fee` DECIMAL(10,2) NOT NULL,
    `handling` DECIMAL(10,2) NULL DEFAULT NULL,
    `shipping` DECIMAL(10,2) NULL DEFAULT NULL,
    `tax` DECIMAL(10,2) NULL DEFAULT NULL,
    `payment_status` VARCHAR(17) NULL DEFAULT NULL,
    `pending_reason` VARCHAR(17) NULL DEFAULT NULL,
    `reason_code` VARCHAR(31) NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    INDEX `payer` (`payer_id` ASC, `payment_status` ASC),
    INDEX `txn` (`txn_id` ASC, `payment_status` ASC),
    INDEX `custom` (`custom` ASC, `payment_status` ASC),
    INDEX `invoice` (`invoice` ASC, `payment_status` ASC)
);
