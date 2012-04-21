
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- company
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `company`;


CREATE TABLE `company`
(
	`cid` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255),
	`image_small` VARCHAR(128),
	`image_large` VARCHAR(128),
	PRIMARY KEY (`cid`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- policy
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `policy`;


CREATE TABLE `policy`
(
	`pid` INTEGER  NOT NULL AUTO_INCREMENT,
	`cid` INTEGER  NOT NULL,
	`name` VARCHAR(255) default '' NOT NULL,
	`url` VARCHAR(255) default '' NOT NULL,
	`scrapeMethod` TINYINT default 0 NOT NULL,
	`scrapeData` TEXT default '' NOT NULL,
	`spoof` VARCHAR(255),
	`pre` TINYINT  NOT NULL,
	PRIMARY KEY (`pid`),
	INDEX `policy_FI_1` (`cid`),
	CONSTRAINT `policy_FK_1`
		FOREIGN KEY (`cid`)
		REFERENCES `company` (`cid`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- version
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `version`;


CREATE TABLE `version`
(
	`vid` INTEGER  NOT NULL AUTO_INCREMENT,
	`pid` INTEGER  NOT NULL,
	`retrievedAt` DATETIME  NOT NULL,
	`flags` INTEGER(2) default 0 NOT NULL,
	`content` LONGTEXT  NOT NULL,
	PRIMARY KEY (`vid`),
	INDEX `version_FI_1` (`pid`),
	CONSTRAINT `version_FK_1`
		FOREIGN KEY (`pid`)
		REFERENCES `policy` (`pid`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- log
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `log`;


CREATE TABLE `log`
(
	`sid` INTEGER  NOT NULL AUTO_INCREMENT,
	`pid` INTEGER  NOT NULL,
	`timestamp` DATETIME  NOT NULL,
	`outcome` INTEGER  NOT NULL,
	`message` TEXT,
	PRIMARY KEY (`sid`),
	INDEX `log_FI_1` (`pid`),
	CONSTRAINT `log_FK_1`
		FOREIGN KEY (`pid`)
		REFERENCES `policy` (`pid`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`uid` INTEGER  NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(64)  NOT NULL,
	`password` VARCHAR(64)  NOT NULL,
	PRIMARY KEY (`uid`),
	KEY `user_I_1`(`username`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- session
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `session`;


CREATE TABLE `session`
(
	`sid` INTEGER  NOT NULL AUTO_INCREMENT,
	`uid` INTEGER default 0 NOT NULL,
	`timestamp` DATETIME  NOT NULL,
	PRIMARY KEY (`sid`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- TOS
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `TOS`;


CREATE TABLE `TOS`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`url` TEXT  NOT NULL,
	`content` LONGTEXT  NOT NULL,
	`tos` INTEGER  NOT NULL,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
