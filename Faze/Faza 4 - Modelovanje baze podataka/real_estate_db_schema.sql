SET NAMES 'utf8';

SET default_storage_engine=INNODB;

DROP DATABASE IF EXISTS `real_estate_db`;

CREATE DATABASE `real_estate_db` DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE `real_estate_db`;

CREATE TABLE ad
(
	ad_id                INTEGER NOT NULL AUTO_INCREMENT,
	city                 NVARCHAR(40) NOT NULL,
	municipality         NVARCHAR(40) NOT NULL,
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
	furniture_desc_id	 INTEGER NOT NULL,
	note                 NVARCHAR(300) NULL,
	approvement_status   ENUM('Pending','Approved','Denied') NOT NULL DEFAULT 'Pending',
	post_date            DATETIME NOT NULL DEFAULT NOW(),
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
	appointment_id        INTEGER NOT NULL AUTO_INCREMENT,
	user_id              INTEGER NOT NULL,
	agent_id             INTEGER NULL,
	appoitment_time      DATETIME NOT NULL,
	status               ENUM('Pending','Scheduled','Canceled','Completed') NOT NULL,
	user_note            NVARCHAR(300) NULL,
	ad_id                INTEGER NOT NULL,
	agent_note           NVARCHAR(300) NULL,
	CONSTRAINT PKappointment PRIMARY KEY (appointment_id)
);

CREATE TABLE comment
(
	user_id              INTEGER NOT NULL,
	ad_id                INTEGER NOT NULL,
	comment_id           INTEGER NOT NULL AUTO_INCREMENT,
	post_date            DATETIME NOT NULL DEFAULT NOW(),
	reported             BOOLEAN NOT NULL DEFAULT FALSE,
	body				 NVARCHAR(300) NOT NULL,
	CONSTRAINT PKcomment PRIMARY KEY (comment_id)
);

CREATE TABLE floor_desc
(
	floor_desc           INTEGER NOT NULL,
	description          NVARCHAR(30) NOT NULL,
	CONSTRAINT PKfloor_desc PRIMARY KEY (floor_desc)
);

CREATE TABLE furniture_desc
(
	furniture_desc_id    INTEGER NOT NULL,
	description          NVARCHAR(30) NOT NULL,
	CONSTRAINT PKfurniture_desc PRIMARY KEY (furniture_desc_id)
);

CREATE TABLE has_additions
(
	has_additions_id		 INTEGER NOT NULL AUTO_INCREMENT,
	addition_id          	 INTEGER NOT NULL,
	ad_id                    INTEGER NOT NULL,
	CONSTRAINT PKhas_additions PRIMARY KEY (has_additions_id)
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
	password             VARCHAR(255) NOT NULL,
	fullname             NVARCHAR(70) NOT NULL,
	email                VARCHAR(254) NOT NULL UNIQUE,
	telefon              VARCHAR(20) NULL,
	user_type_id         INTEGER NOT NULL DEFAULT 3,
	remember_token 		 VARCHAR(255),
	registration_date    DATETIME DEFAULT NOW(),
	last_login			 DATETIME NULL,
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
ADD CONSTRAINT ad_FK_furniture_desc FOREIGN KEY (furniture_desc_id) REFERENCES furniture_desc (furniture_desc_id) ON UPDATE CASCADE;

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

ALTER TABLE has_additions
ADD CONSTRAINT has_additions_unique_ad_addition UNIQUE(addition_id, ad_id);

/*lookup population*/
INSERT INTO user_type 
VALUES(1,"Administrator"),(2,"Moderator"),(3,"Klijent");
INSERT INTO real_estate_type 
VALUES(1, "Stan"),(2, "Kuća"),(3,"Poslovni prostor");
INSERT INTO apartment_type 
VALUES(1,"Garsonjera"),(2,"Jednosoban"),(3,"Dvosoban"),
(4,"Trosoban"),(5,"Četvorosoban"),(6,"Petosoban"),(7,"Ostalo");
INSERT INTO floor_desc 
VALUES(1, "Prizemlje"),(2,"Visoko prizemlje"),(3,"1. sprat"),
(4,"2. sprat"),(5,"3. sprat"),(6,"4. sprat"),(7,"5. sprat"),
(8,"6. sprat"),(9,"7. sprat"),(10,"8. sprat"),(11,"9. sprat")
,(12,"10. sprat"),(13,"Preko 10");
INSERT INTO heating_option 
VALUES(1, "Centralno grejanje"),(2,"Etažno grejanje"),(3,"Grejanje na struju"),
(4,"Podno grejanje"),(5, "Klima"),(6,"Ostalo");
INSERT INTO addition 
VALUES(1, "Lift"),(2,"Terasa"),(3,"Telefon"),
(4,"Internet"), (5,"Kablovska"),(6,"Klima"),(7,"Obezbeđenje"),
(8,"Alarm"),(9,"Kamere"),(10,"Interfon"),(11,"Rampa za invalide");
INSERT INTO parking_option 
VALUES(1, "Garaža"),(2, "Privatni parking"),(3, "Parking zgrade"),
(4, "Slobodna zona"),(5,"Zona");
INSERT INTO woodwork_type 
VALUES(1, "Aluminijum"),(2, "PVC"),(3, "Drvo"),
(4, "Metal"),(5, "Ostalo");
INSERT INTO furniture_desc 
VALUES (1, "Ekstra namešten"), (2, "Namešten"), (3, "Polunamešten"),
(4, "Prazan");

/*
	Dummy data za testiranje ovo menjajte kako god hocete da odgovara vasim testovima
	samo pazite da strane kljuceve lepo namestite ako koristitite ovo nad vec napravljenom tabelom
*/

/*Tri tipa korisnika*/
INSERT INTO `real_estate_db`.`user`
(`username`,
`password`,
`fullname`,
`email`,
`telefon`,
`user_type_id`)
VALUES(
	"admin", #username
	"$2a$10$Xw6uuT1kOziHK4BYy2kTuu1g/E2UBzRokq.FDtd5haOmQbjoy8CFm", #password admin123 https://www.dailycred.com/article/bcrypt-calculator
	"Admin Admin",
	"admin@retail.com",
	"0692323876",
	1
),(
	"moderator", #username
	"$2a$10$d35KQGYtUGMbLFAK9BeRI.6TjlpvzAtjzH.YuA8aeLeeg8r/uI7QO", #password moderator123
	"Mod Mod",
	"mod@retail.com",
	"0691234567",
	2
),(
	"korisnik", #username
	"$2a$10$SNj1Q.SrQNjWG5ls7oQVA.SAS.Qc.GpvYveEV5LZV2hMag9NAvcka", #password korisnik123
	"Pera Peric",
	"peric.pera@gmail.com",
	"0691112223",
	3
);

INSERT INTO `real_estate_db`.`ad`
(`city`,
`municipality`,
`address`,
`ad_type`,
`real_estate_type_id`,
`apartment_type_id`,
`floor_desc`,
`price`,
`description`,
`floor_area`,
`num_of_rooms`,
`num_of_bathrooms`,
`construction_year`,
`documentation`,
`heating_option_id`,
`parking_option_id`,
`user_id`,
`woodwork_type_id`,
`furniture_desc_id`,
`note`,
`approvement_status`,
`post_date`)
VALUES(
	"Beograd", #city
	"Savski Venac", #municipality
	"Kralja Milutina 50", #address
	"Renting", #ad_type
	1, #real_estate_type_id
	1, #apartment_type_id
	1, #floor_desc
	500.00, #price
	"Lorem ipsum dolor sit amet, et prompta feugiat nec, no audire consequuntur ius. Enim nusquam liberavisse ut quo, dicant vivendo vituperatoribus ius cu. Ex est aperiam facilisis rationibus. Modo homero sit ad, consul blandit at cum.", #description
	100, #floor area
	4, #num_of_rooms
	2, #num_of_bathrooms
	2008, #construction_year
	true, #documentation
	1, #heating_option
	1, #parking_option
	3, #user_id,
    1, #woodwork_type_id
	1, #furniture_desc_id
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea.
", #note
	"Approved", #approvement_status
	"2014-11-22 12:45:34" #post_date
),(
	"Beograd", #city
	"Stari Grad", #municipality
	"Karadjorjeva 20", #address
	"Selling", #ad_type
	1, #real_estate_type_id
	1, #apartment_type_id
	1, #floor_desc
	10000.00, #price
	"Pogled na reku malo ĆŽŠŽČ Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea }", #description
	100, #floor area
	4, #num_of_rooms
	2, #num_of_bathrooms
	2008, #construction_year
	true, #documentation
	1, #heating_option
	1, #parking_option
	3, #user_id,
    2, #woodwork_type_id
	2, #furniture_desc_id
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #note
	"Approved", #approvement_status
	NOW() #post_date
),(
	"Beograd", #city
	"Stari Grad", #municipality
	"Kraljevica Marka 20", #address
	"Selling", #ad_type
	1, #real_estate_type_id
	2, #apartment_type_id
	4, #floor_desc
	1500.02, #price
	"Pogled na reku malo ĆŽŠŽČ Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea }", #description
	122, #floor area
	5, #num_of_rooms
	6, #num_of_bathrooms
	2008, #construction_year
	true, #documentation
	2, #heating_option
	2, #parking_option
	3, #user_id,
    2, #woodwork_type_id
	2, #furniture_desc_id
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #note
	"Pending", #approvement_status
	"2015-04-23 13:45:34" #post_date
),(
	"Beograd", #city
	"Stari Grad", #municipality
	"Savska 10", #address
	"Selling", #ad_type
	1, #real_estate_type_id
	2, #apartment_type_id
	4, #floor_desc
	1500.02, #price
	"Pogled na reku malo ĆŽŠŽČ Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea }", #description
	122, #floor area
	5, #num_of_rooms
	6, #num_of_bathrooms
	2008, #construction_year
	true, #documentation
	2, #heating_option
	2, #parking_option
	3, #user_id,
    2, #woodwork_type_id
	2, #furniture_desc_id
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #note
	"Approved", #approvement_status
	"2015-05-21 16:45:34" #post_date
),(
	"Beograd", #city
	"Borča", #municipality
	"Andersenova 2", #address
	"Renting", #ad_type
	2, #real_estate_type_id
	null, #apartment_type_id
	null, #floor_desc
	1500.02, #price
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #description
	122, #floor area
	5, #num_of_rooms
	6, #num_of_bathrooms
	2008, #construction_year
	true, #documentation
	3, #heating_option
	3, #parking_option
	3, #user_id,
    4, #woodwork_type_id
	2, #furniture_desc_id
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #note
	"Approved", #approvement_status
	"2015-05-21 16:45:34" #post_date
);

INSERT INTO has_additions (addition_id, ad_id) 
VALUES(1,1),(2,1),(3,1),(4,1),
(9,2),(10,2),(11,2),
(1,3),(3,3),(5,3),(6,3),(9,3),
(1,4),(2,4),(3,4),(4,4),(5,4),(6,4),(7,4),(8,4),(9,4),(10,4),
(3,5),(2,5),(7,5);

INSERT INTO comment (ad_id, user_id, body) 
VALUES (1,3,"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit"),
(1,3,"Sadipscing deterruisset mei ei, qui consul saperet theophrastus");

INSERT INTO comment (ad_id, user_id, body, reported) VALUES (1,3,"mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", true);

INSERT INTO image(image_path,ad_id)
VALUES ('http://i.imgur.com/bOGu7hs.jpg' ,1),('http://i.imgur.com/bOGu7hs.jpg' ,1),
('http://i.imgur.com/bOGu7hs.jpg' ,1),('http://i.imgur.com/bOGu7hs.jpg' ,2),('http://i.imgur.com/bOGu7hs.jpg' ,2);

INSERT INTO `real_estate_db`.`appointment`
(
`user_id`,
`agent_id`,
`appoitment_time`,
`status`,
`user_note`,
`ad_id`,
`agent_note`
)
VALUES
(
	3, #user_id
	null, #agent_id`,
	"2016-11-22 12:45:00", #appoitment_time
	"Pending", #status
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #user_note
	1, #ad_id
	null #agent_note
),(
	3, #user_id
	2, #agent_id`,
	"2015-11-22 12:45:00", #appoitment_time
	"Completed", #status
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea", #user_note
	2, #ad_id
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea" #agent_note
),(
	3, #user_id
	2, #agent_id`,
	"2016-11-22 12:45:00", #appoitment_time
	"Scheduled", #status
	"Dolor appareat disputando ius ad. Ex mediocrem urbanitas scripserit eos. Sit paulo tempor altera ex. Sadipscing deterruisset mei ei, qui consul saperet theophrastus no. Ut mutat affert dolores cum, id graeco corpora tractatos eos, no solet nullam contentiones mea",#user_note
	5, #ad_id
	null #agent_note
);