CREATE TABLE `ohrm_ws_consumer` (
    `app_id` INT UNSIGNED AUTO_INCREMENT,
    `app_token` VARCHAR(10) NOT NULL,
    `app_name` VARCHAR(50) DEFAULT NULL,
    `status` TINYINT NOT NULL DEFAULT 1,
    PRIMARY KEY(`app_id`)
);