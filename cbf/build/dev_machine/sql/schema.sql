
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- userProfile
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `userProfile`;

CREATE TABLE `userProfile`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for the user account',
	`username` VARCHAR(100) NOT NULL COMMENT 'Username for the account',
	`password` CHAR(32) NOT NULL COMMENT 'Encrypted password for the account',
	`userType` TINYINT NOT NULL COMMENT 'Indicates why type of user a profile belongs to',
	`emailAddress` VARCHAR(100) NOT NULL COMMENT 'Email address for the account',
	`ip` VARCHAR(39) NOT NULL COMMENT 'IP address that the user last logged in with',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='User account information';

-- ---------------------------------------------------------------------
-- awaitingConfirmation
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `awaitingConfirmation`;

CREATE TABLE `awaitingConfirmation`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for confirmation',
	`confirmNum` CHAR(32) NOT NULL COMMENT 'The confirmation number for the account',
	`username` VARCHAR(100) NOT NULL COMMENT 'The username of the awaiting account',
	`password` CHAR(32) NOT NULL COMMENT 'Encrypted password for the awaiting account',
	`ttd` DATETIME NOT NULL COMMENT 'The time at which this confirmation expires',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='New users who have not yet confirmed their accounts';

-- ---------------------------------------------------------------------
-- awaitingProfiles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `awaitingProfiles`;

CREATE TABLE `awaitingProfiles`
(
	`id` INTEGER NOT NULL COMMENT 'ID for confirmation',
	`emailAddress` VARCHAR(100) NOT NULL COMMENT 'Email address of the user',
	PRIMARY KEY (`id`),
	CONSTRAINT `awaitingProfiles_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `awaitingConfirmation` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Profiles associated with new users who have not yet confirmed their accounts';

-- ---------------------------------------------------------------------
-- bannedEmails
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bannedEmails`;

CREATE TABLE `bannedEmails`
(
	`emailAddress` VARCHAR(100) NOT NULL COMMENT 'Email address that has been banned',
	`ttd` DATETIME NOT NULL COMMENT 'Time at which this ban expires',
	PRIMARY KEY (`emailAddress`)
) ENGINE=MyISAM COMMENT='Email addresses that have been banned from using the site';

-- ---------------------------------------------------------------------
-- bannedIPs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bannedIPs`;

CREATE TABLE `bannedIPs`
(
	`ip` INTEGER NOT NULL COMMENT 'IP address that has been banned',
	`shift` TINYINT NOT NULL COMMENT 'Number of bits that are shifted during search',
	`ttd` DATETIME NOT NULL COMMENT 'Time at which this ban expires',
	PRIMARY KEY (`ip`,`shift`)
) ENGINE=MyISAM COMMENT='IP addresses that have been banned from using the site';

-- ---------------------------------------------------------------------
-- bannedUsernames
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `bannedUsernames`;

CREATE TABLE `bannedUsernames`
(
	`username` VARCHAR(100) NOT NULL COMMENT 'Username that has been banned',
	`ttd` DATETIME NOT NULL COMMENT 'Time at which this ban expires',
	PRIMARY KEY (`username`)
) ENGINE=MyISAM COMMENT='Usernames that have banned from using the site';

-- ---------------------------------------------------------------------
-- names
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `names`;

CREATE TABLE `names`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for a celebrity',
	`name` VARCHAR(100) NOT NULL COMMENT 'Name of a celebrity',
	`reference` TEXT NOT NULL COMMENT 'The reference link for a celebrity',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='Names of celebrities';

-- ---------------------------------------------------------------------
-- pics
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `pics`;

CREATE TABLE `pics`
(
	`id` INTEGER NOT NULL COMMENT 'ID for a celebrity',
	`pic` VARCHAR(100) NOT NULL COMMENT 'Filename of pictures of a celebrity',
	PRIMARY KEY (`id`,`pic`),
	CONSTRAINT `pics_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `names` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Pictures of celebrities';

-- ---------------------------------------------------------------------
-- fights
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `fights`;

CREATE TABLE `fights`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for a fight',
	`oneID` INTEGER NOT NULL COMMENT 'ID for the first celebrity',
	`twoID` INTEGER NOT NULL COMMENT 'ID for the second celebrity',
	`oneWins` INTEGER NOT NULL COMMENT 'Wins for the first celebrity',
	`twoWins` INTEGER NOT NULL COMMENT 'Wins for the second celebrity',
	`active` TINYINT DEFAULT 1 COMMENT 'Indicates if the fight is currently active',
	PRIMARY KEY (`id`),
	INDEX `fights_FI_1` (`oneID`),
	INDEX `fights_FI_2` (`twoID`),
	CONSTRAINT `fights_FK_1`
		FOREIGN KEY (`oneID`)
		REFERENCES `names` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `fights_FK_2`
		FOREIGN KEY (`twoID`)
		REFERENCES `names` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Matches between celebrities';

-- ---------------------------------------------------------------------
-- posts
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for a post',
	`fightID` INTEGER NOT NULL COMMENT 'ID of the owning fight',
	`posterID` INTEGER NOT NULL COMMENT 'ID of the owning poster',
	`postDate` DATETIME NOT NULL COMMENT 'Date and time the post was made',
	`postText` TEXT NOT NULL COMMENT 'Body of the post',
	PRIMARY KEY (`id`),
	INDEX `posts_FI_1` (`fightID`),
	INDEX `posts_FI_2` (`posterID`),
	CONSTRAINT `posts_FK_1`
		FOREIGN KEY (`fightID`)
		REFERENCES `fights` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `posts_FK_2`
		FOREIGN KEY (`posterID`)
		REFERENCES `userProfile` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Posts made about celebrity fights';

-- ---------------------------------------------------------------------
-- image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for the image',
	`datatype` VARCHAR(100) DEFAULT 'application/octet-stream' NOT NULL COMMENT 'Image type',
	`name` VARCHAR(255) NOT NULL COMMENT 'Filename of the image',
	`size` BIGINT(20) NOT NULL COMMENT 'Size of the image',
	`date_added` DATETIME NOT NULL COMMENT 'Date the image was added',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='Metadata for stored images';

-- ---------------------------------------------------------------------
-- image_data
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `image_data`;

CREATE TABLE `image_data`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for the row',
	`image_id` INTEGER NOT NULL COMMENT 'ID of the image',
	`data` LONGBLOB NOT NULL COMMENT 'Data for this image node',
	PRIMARY KEY (`id`),
	INDEX `image_data_FI_1` (`image_id`),
	CONSTRAINT `image_data_FK_1`
		FOREIGN KEY (`image_id`)
		REFERENCES `image` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='The binary data of stored images';

-- ---------------------------------------------------------------------
-- ad
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ad`;

CREATE TABLE `ad`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID for the ad',
	`name` VARCHAR(100) COMMENT 'Assigned name to the ad.',
	`position` INTEGER NOT NULL COMMENT 'Indicates which ad position this ad can display in.',
	`date_added` DATETIME NOT NULL COMMENT 'Date when the ad was added.',
	`image_id` INTEGER COMMENT 'If the ad uses an image, this is the images\'s id number.',
	`code` TEXT NOT NULL COMMENT 'Display code for the ad',
	PRIMARY KEY (`id`),
	INDEX `ad_FI_1` (`image_id`),
	CONSTRAINT `ad_FK_1`
		FOREIGN KEY (`image_id`)
		REFERENCES `image` (`id`)
		ON DELETE SET NULL
) ENGINE=MyISAM COMMENT='Ad codes';

-- ---------------------------------------------------------------------
-- ad_selection_list
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `ad_selection_list`;

CREATE TABLE `ad_selection_list`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
	`ad_id` INTEGER NOT NULL COMMENT 'The ad that an element represents',
	PRIMARY KEY (`id`),
	INDEX `ad_selection_list_FI_1` (`ad_id`),
	CONSTRAINT `ad_selection_list_FK_1`
		FOREIGN KEY (`ad_id`)
		REFERENCES `ad` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='List used when randomly selecting an ad';

-- ---------------------------------------------------------------------
-- tourney_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tourney_status`;

CREATE TABLE `tourney_status`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID Number for the tournament.',
	`active` TINYINT(1) DEFAULT 0 COMMENT 'Indicates if the tourney is active.',
	`start_time` DATETIME NOT NULL COMMENT 'Records when the tournament started.',
	`end_time` DATETIME COMMENT 'Records when the tournament ended.',
	`round_number` INTEGER COMMENT 'Indicates which round of the tournament is occuring',
	`root` INTEGER COMMENT 'ID of the root node of the fight bracket.',
	PRIMARY KEY (`id`)
) ENGINE=MyISAM COMMENT='General status of the tournament.';

-- ---------------------------------------------------------------------
-- tourney_round_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tourney_round_status`;

CREATE TABLE `tourney_round_status`
(
	`tourney_id` INTEGER NOT NULL COMMENT 'ID of the parent tournament.',
	`round_number` INTEGER NOT NULL COMMENT 'The Round Number.',
	`round_start_time` DATETIME COMMENT 'Records when the current round started.',
	`round_end_time` DATETIME COMMENT 'Indicates when the current round should end.',
	PRIMARY KEY (`tourney_id`,`round_number`),
	INDEX `I_referenced_tourney_fights_FK_2_1` (`round_number`),
	CONSTRAINT `tourney_round_status_FK_1`
		FOREIGN KEY (`tourney_id`)
		REFERENCES `tourney_status` (`id`)
		ON DELETE CASCADE
) ENGINE=MyISAM COMMENT='Status of a round of the tournament.';

-- ---------------------------------------------------------------------
-- tourney_fighters
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tourney_fighters`;

CREATE TABLE `tourney_fighters`
(
	`tourney_id` INTEGER NOT NULL COMMENT 'ID of the tournament.',
	`fighter_id` INTEGER NOT NULL COMMENT 'ID of a participating fighter.',
	PRIMARY KEY (`tourney_id`,`fighter_id`),
	INDEX `tourney_fighters_FI_2` (`fighter_id`),
	CONSTRAINT `tourney_fighters_FK_1`
		FOREIGN KEY (`tourney_id`)
		REFERENCES `tourney_status` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `tourney_fighters_FK_2`
		FOREIGN KEY (`fighter_id`)
		REFERENCES `names` (`id`)
		ON DELETE RESTRICT
) ENGINE=MyISAM COMMENT='List of fighters participating in the tournament.';

-- ---------------------------------------------------------------------
-- tourney_fights
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tourney_fights`;

CREATE TABLE `tourney_fights`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID of the fight',
	`tourney_id` INTEGER NOT NULL COMMENT 'Tournament that the fight is apart of.',
	`round_number` INTEGER NOT NULL COMMENT 'Round number that the fight is in.',
	`general_fight_id` INTEGER NOT NULL COMMENT 'ID of the non-tournament fight that is related.',
	`oneID` INTEGER NOT NULL COMMENT 'ID of fighter one.',
	`twoID` INTEGER NOT NULL COMMENT 'ID of fighter two.',
	`oneWins` INTEGER DEFAULT 0 NOT NULL COMMENT 'Wins for fighter one.',
	`twoWins` INTEGER DEFAULT 0 NOT NULL COMMENT 'Wins for fighter two.',
	`child_right` INTEGER COMMENT 'ID of the right child.',
	`child_left` INTEGER COMMENT 'ID of the left child.',
	`parent` INTEGER COMMENT 'ID of the parent.',
	PRIMARY KEY (`id`),
	INDEX `tourney_fights_FI_1` (`tourney_id`),
	INDEX `tourney_fights_FI_2` (`round_number`),
	INDEX `tourney_fights_FI_3` (`general_fight_id`),
	INDEX `tourney_fights_FI_4` (`oneID`),
	INDEX `tourney_fights_FI_5` (`twoID`),
	CONSTRAINT `tourney_fights_FK_1`
		FOREIGN KEY (`tourney_id`)
		REFERENCES `tourney_round_status` (`tourney_id`)
		ON DELETE CASCADE,
	CONSTRAINT `tourney_fights_FK_2`
		FOREIGN KEY (`round_number`)
		REFERENCES `tourney_round_status` (`round_number`)
		ON DELETE CASCADE,
	CONSTRAINT `tourney_fights_FK_3`
		FOREIGN KEY (`general_fight_id`)
		REFERENCES `fights` (`id`)
		ON DELETE SET NULL,
	CONSTRAINT `tourney_fights_FK_4`
		FOREIGN KEY (`oneID`)
		REFERENCES `tourney_fighters` (`fighter_id`)
		ON DELETE RESTRICT,
	CONSTRAINT `tourney_fights_FK_5`
		FOREIGN KEY (`twoID`)
		REFERENCES `tourney_fighters` (`fighter_id`)
		ON DELETE RESTRICT
) ENGINE=MyISAM COMMENT='Listing and recording of tournament fights.';

-- ---------------------------------------------------------------------
-- tourney_user_action
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tourney_user_action`;

CREATE TABLE `tourney_user_action`
(
	`id` INTEGER NOT NULL AUTO_INCREMENT COMMENT 'ID key for the table',
	`user_id` INTEGER NOT NULL COMMENT 'ID of the user.',
	`fight_id` INTEGER NOT NULL COMMENT 'ID of the fight that occurred.',
	`result` INTEGER NOT NULL COMMENT 'ID of the fighter the user choose.',
	`time` DATETIME NOT NULL COMMENT 'Time that the user voted on the fight.',
	PRIMARY KEY (`id`),
	INDEX `tourney_user_action_FI_1` (`user_id`),
	INDEX `tourney_user_action_FI_2` (`fight_id`),
	INDEX `tourney_user_action_FI_3` (`result`),
	CONSTRAINT `tourney_user_action_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `userProfile` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `tourney_user_action_FK_2`
		FOREIGN KEY (`fight_id`)
		REFERENCES `tourney_fights` (`id`)
		ON DELETE CASCADE,
	CONSTRAINT `tourney_user_action_FK_3`
		FOREIGN KEY (`result`)
		REFERENCES `tourney_fighters` (`fighter_id`)
		ON DELETE SET NULL
) ENGINE=MyISAM COMMENT='Recording of users actions within a tournament.';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
