alter table userProfile drop foreign key userProfile_ibfk_1;
alter table userProfile drop primary key;
alter table userProfile change column id id int primary key auto_increment;
alter table userProfile add column username varchar(100) unique after id;
alter table userProfile add column password char(32) after username;
alter table userProfile add column userType tinyint default 0 not null after password;
alter table userProfile add column ip varchar(39) after userType;

alter table awaitingConfirmation change column ttd ttd DATETIME not null;
alter table bannedEmails change column ttd ttd DATETIME not null;
delete from bannedIPs;
alter table bannedIPs change column ip ip integer unsigned not null;
alter table bannedIPs add column shift tinyint not null after ip;
alter table bannedIPs change column ttd ttd DATETIME not null;
alter table bannedIPs drop primary key;
alter table bannedIPs add primary key(ip, shift);
alter table bannedUsernames change column ttd ttd DATETIME not null;

alter table fights drop column oneMessage;
alter table fights drop column twoMessage;

alter table posts change column postDate postDate DATETIME not null;
delete from posts where posterID = 2;
alter table posts add foreign key (posterID) references userProfile(id) on delete cascade on update cascade;

CREATE TABLE `image`
(
    `id` INTEGER  NOT NULL AUTO_INCREMENT COMMENT 'ID for the image',
    `datatype` VARCHAR(100) default 'application/octet-stream' NOT NULL COMMENT 'Image type',
    `name` VARCHAR(255)  NOT NULL COMMENT 'Filename of the image',
    `size` BIGINT(20)  NOT NULL COMMENT 'Size of the image',
    `date_added` DATETIME  NOT NULL COMMENT 'Date the image was added',
    PRIMARY KEY (`id`)
)Type=MyISAM COMMENT='Metadata for stored images';

CREATE TABLE `image_data`
(
    `id` INTEGER  NOT NULL AUTO_INCREMENT COMMENT 'ID for the row',
    `image_id` INTEGER  NOT NULL COMMENT 'ID of the image',
    `data` LONGBLOB  NOT NULL COMMENT 'Data for this image node',
    PRIMARY KEY (`id`),
    INDEX `image_data_FI_1` (`image_id`),
    CONSTRAINT `image_data_FK_1`
        FOREIGN KEY (`image_id`)
        REFERENCES `image` (`id`)
        ON DELETE CASCADE
)Type=MyISAM COMMENT='The binary data of stored images';

CREATE TABLE `ad`
(
    `id` INTEGER  NOT NULL AUTO_INCREMENT COMMENT 'ID for the ad',
    `name` VARCHAR(100) COMMENT 'Assigned name to the ad.',
    `position` INTEGER  NOT NULL COMMENT 'Indicates which ad position this ad can display in.',
    `date_added` DATETIME  NOT NULL COMMENT 'Date when the ad was added.',
    `image_id` INTEGER COMMENT 'If the ad uses an image, this is the images\'s id number.',
    `code` TEXT  NOT NULL COMMENT 'Display code for the ad',
    PRIMARY KEY (`id`),
    INDEX `ad_FI_1` (`image_id`),
    CONSTRAINT `ad_FK_1`
        FOREIGN KEY (`image_id`)
        REFERENCES `image` (`id`)
        ON DELETE SET NULL
)Type=MyISAM COMMENT='Ad codes';

CREATE TABLE `ad_selection_list`
(
    `id` INTEGER  NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
    `ad_id` INTEGER  NOT NULL COMMENT 'The ad that an element represents',
    PRIMARY KEY (`id`),
    INDEX `ad_selection_list_FI_1` (`ad_id`),
    CONSTRAINT `ad_selection_list_FK_1`
        FOREIGN KEY (`ad_id`)
        REFERENCES `ad` (`id`)
        ON DELETE CASCADE
)Type=MyISAM COMMENT='List used when randomly selecting an ad';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;