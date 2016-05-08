SET NAMES 'utf8';

SET default_storage_engine=INNODB;

DROP DATABASE IF EXISTS `real_estate_db`;

CREATE DATABASE `real_estate_db` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE `real_estate_db`;

CREATE TABLE ad
(
	ad_id                INTEGER NOT NULL AUTO_INCREMENT,
	city                 NVARCHAR(40) NOT NULL,
	muncipality          NVARCHAR(40) NOT NULL,
	address              NVARCHAR(80) NOT NULL,
	ad_type              ENUM('Renting','Selling') NOT NULL,
	real_estate_type_id  INTEGER NOT NULL,
	apartment_type_id    INTEGER NULL,
	floor_desc           INTEGER NULL,
	price                DECIMAL(12,2) NOT NULL,
	description          NVARCHAR(300) NULL,
	floor_area           FLOAT NOT NULL,
	num_of_rooms         INTEGER NOT NULL,
	num_of_bathrooms     INTEGER NOT NULL,
	construction_year    INTEGER NOT NULL,
	documentation        BOOLEAN NOT NULL,
	heating_option_id    INTEGER NOT NULL,
	parking_option_id    INTEGER NOT NULL,
	user_id              INTEGER NOT NULL,
	woodwork_type_id     INTEGER NOT NULL,
	note                 NVARCHAR(300) NULL,
	approvement_status   ENUM('Pending','Approved','Denied') NOT NULL,
	post_date            DATETIME NOT NULL,
	CONSTRAINT PKad PRIMARY KEY (ad_id)
);

CREATE TABLE addition
(
	addition_id          INTEGER NOT NULL,
	description          NVARCHAR(30) NOT NULL,
	CONSTRAINT PKaddition PRIMARY KEY (addition_id)
);

CREATE TABLE apartment_type
(
	apartment_type_id    INTEGER NOT NULL,
	type_name            NVARCHAR(30) NOT NULL,
	CONSTRAINT PKapartment_type PRIMARY KEY (apartment_type_id)
);

CREATE TABLE appointment
(
	appoitment_id        INTEGER NOT NULL AUTO_INCREMENT,
	user_id              INTEGER NOT NULL,
	agent_id             INTEGER NULL,
	appoitment_time      DATETIME NOT NULL,
	status               ENUM('Pending','Scheduled','Canceled','Completed') NOT NULL,
	user_note            NVARCHAR(300) NULL,
	ad_id                INTEGER NOT NULL,
	agent_note           NVARCHAR(300) NULL,
	CONSTRAINT PKappointment PRIMARY KEY (appoitment_id)
);

CREATE TABLE comment
(
	user_id              INTEGER NOT NULL,
	ad_id                INTEGER NOT NULL,
	comment_id           INTEGER NOT NULL AUTO_INCREMENT,
	post_date            DATE NOT NULL,
	reported             boolean NOT NULL,
	CONSTRAINT PKcomment PRIMARY KEY (comment_id)
);

CREATE TABLE floor_desc
(
	floor_desc           INTEGER NOT NULL,
	description          NVARCHAR(30) NOT NULL,
	CONSTRAINT PKfloor_desc PRIMARY KEY (floor_desc)
);

CREATE TABLE has_additions
(
	addition_id          INTEGER NOT NULL,
	ad_id                INTEGER NOT NULL,
	CONSTRAINT PKhas_additions PRIMARY KEY (addition_id,ad_id)
);

CREATE TABLE heating_option
(
	heating_option_id    INTEGER NOT NULL,
	option_name          NVARCHAR(30) NOT NULL,
	CONSTRAINT PKheating_option PRIMARY KEY (heating_option_id)
);

CREATE TABLE image
(
	image_id             INTEGER NOT NULL AUTO_INCREMENT,
	image_path           VARCHAR(2000) NOT NULL,
	ad_id                INTEGER NOT NULL,
	CONSTRAINT PKimage PRIMARY KEY (image_id)
);

CREATE TABLE parking_option
(
	parking_option_id    INTEGER NOT NULL,
	option_name          NVARCHAR(30) NOT NULL,
	CONSTRAINT PKparking_option PRIMARY KEY (parking_option_id)
);

CREATE TABLE real_estate_type
(
	real_estate_type_id  INTEGER NOT NULL,
	type_name            NVARCHAR(30) NOT NULL,
	CONSTRAINT PKreal_estate_type PRIMARY KEY (real_estate_type_id)
);

CREATE TABLE user
(
	user_id              INTEGER NOT NULL AUTO_INCREMENT,
	username             VARCHAR(20) NOT NULL UNIQUE,
	password             BINARY(60) NOT NULL,
	fullname             NVARCHAR(70) NOT NULL,
	email                VARCHAR(254) NOT NULL UNIQUE,
	telefon              VARCHAR(20) NULL,
	user_type_id         INTEGER NOT NULL,
	CONSTRAINT PKuser PRIMARY KEY (user_id)
);

CREATE TABLE user_type
(
	user_type_id         INTEGER NOT NULL,
	role_name            VARCHAR(20) NOT NULL,
	CONSTRAINT PKuser_type PRIMARY KEY (user_type_id)
);

CREATE TABLE woodwork_type
(
	woodwork_type_id     INTEGER NOT NULL,
	type_name            NVARCHAR(30) NOT NULL,
	CONSTRAINT PKwoodwork_type PRIMARY KEY (woodwork_type_id)
);

/*
	fk naming policy: %CHILD_FK_%PARENT[_rolename];
*/

ALTER TABLE ad
ADD CONSTRAINT ad_FK_real_estate_type FOREIGN KEY (real_estate_type_id) REFERENCES real_estate_type (real_estate_type_id) ON UPDATE CASCADE;

ALTER TABLE ad
ADD CONSTRAINT ad_FK_apartment_type FOREIGN KEY (apartment_type_id) REFERENCES apartment_type (apartment_type_id) ON UPDATE CASCADE;

ALTER TABLE ad
ADD CONSTRAINT ad_FK_floor_desc FOREIGN KEY (floor_desc) REFERENCES floor_desc (floor_desc) ON UPDATE CASCADE;

ALTER TABLE ad
ADD CONSTRAINT ad_FK_heating_option FOREIGN KEY (heating_option_id) REFERENCES heating_option (heating_option_id) ON UPDATE CASCADE;

ALTER TABLE ad
ADD CONSTRAINT ad_FK_parking_option FOREIGN KEY (parking_option_id) REFERENCES parking_option (parking_option_id) ON UPDATE CASCADE;

ALTER TABLE ad
ADD CONSTRAINT ad_FK_user FOREIGN KEY (user_id) REFERENCES user (user_id) ON UPDATE CASCADE;

ALTER TABLE ad
ADD CONSTRAINT ad_FK_woodwork_type FOREIGN KEY (woodwork_type_id) REFERENCES woodwork_type (woodwork_type_id) ON UPDATE CASCADE;

ALTER TABLE appointment
ADD CONSTRAINT appointment_FK_user_poster FOREIGN KEY (user_id) REFERENCES user (user_id) ON UPDATE CASCADE;

ALTER TABLE appointment
ADD CONSTRAINT appointment_FK_user_agent FOREIGN KEY (agent_id) REFERENCES user (user_id) ON UPDATE CASCADE;

ALTER TABLE appointment
ADD CONSTRAINT appointment_FK_ad FOREIGN KEY (ad_id) REFERENCES ad (ad_id) ON UPDATE CASCADE;

ALTER TABLE comment
ADD CONSTRAINT comment_FK_user FOREIGN KEY (user_id) REFERENCES user (user_id) ON UPDATE CASCADE;

ALTER TABLE comment
ADD CONSTRAINT comment_FK_ad FOREIGN KEY (ad_id) REFERENCES ad (ad_id) ON UPDATE CASCADE;

ALTER TABLE has_additions
ADD CONSTRAINT has_additions_FK_addition FOREIGN KEY (addition_id) REFERENCES addition (addition_id) ON UPDATE CASCADE;

ALTER TABLE has_additions
ADD CONSTRAINT has_additions_FK_ad FOREIGN KEY (ad_id) REFERENCES ad (ad_id) ON UPDATE CASCADE;

ALTER TABLE image
ADD CONSTRAINT image_FK_ad FOREIGN KEY (ad_id) REFERENCES ad (ad_id) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE user
ADD CONSTRAINT user_FK_user_type FOREIGN KEY (user_type_id) REFERENCES user_type (user_type_id) ON UPDATE CASCADE;

/*TODO: INSERT VALUES FOR LOOKUP TABLES*/
