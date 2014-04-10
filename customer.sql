CREATE SCHEMA IF NOT EXISTS `code_sample`;

USE `code_sample`;

CREATE TABLE `customer` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `address_country` VARCHAR(64) DEFAULT NULL,
    `address_city` VARCHAR(40) DEFAULT NULL,
    `address_country_code` CHAR(2) DEFAULT NULL,
    `address_name` VARCHAR(128) DEFAULT NULL,
    `address_state` VARCHAR(40) DEFAULT NULL,
    `address_status` VARCHAR(11) DEFAULT NULL,
    `address_street` VARCHAR(200) DEFAULT NULL,
    `address_zip` VARCHAR(20) DEFAULT NULL,
    `contact_phone` VARCHAR(20) DEFAULT NULL,
    `first_name` VARCHAR(64) DEFAULT NULL,
    `last_name` VARCHAR(64) DEFAULT NULL,
    `business_name` VARCHAR(127) DEFAULT NULL,
    `email` VARCHAR(127) NOT NULL,
    `paypal_id` VARCHAR(13) NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE INDEX `email_UNIQUE` (`email` ASC),
    UNIQUE INDEX `paypal_id_UNIQUE` (`paypal_id` ASC)
);
