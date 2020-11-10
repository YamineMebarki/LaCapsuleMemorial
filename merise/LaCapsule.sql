/*sudo chown www-data:www-data -R ckeditor commande des droits avec recursion*/
#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------

CREATE DATABASE `lacapsule` CHARACTER SET utf8;

USE `lacapsule`;

#------------------------------------------------------------
# Table: ya_role
#------------------------------------------------------------

CREATE TABLE ya_role(
        id   Int  Auto_increment  NOT NULL ,
        name Varchar (100) NOT NULL
	,CONSTRAINT ya_role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;

INSERT INTO `ya_role`(name) VALUES('admin');
INSERT INTO `ya_role`(name) VALUES('moderator');
INSERT INTO `ya_role`(name) VALUES('user');

#------------------------------------------------------------
# Table: ya_users
#------------------------------------------------------------

CREATE TABLE ya_users(
        id         Int  Auto_increment  NOT NULL ,
        lastname   Varchar (50) NOT NULL ,
        firstname  Varchar (50) NOT NULL ,
        mail       Varchar (100) NOT NULL ,
        pass       Varchar (255) NOT NULL ,
       datehour    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        id_ya_role Int NOT NULL
	,CONSTRAINT ya_users_PK PRIMARY KEY (id)

	,CONSTRAINT ya_users_ya_role_FK FOREIGN KEY (id_ya_role) REFERENCES ya_role(id)
)ENGINE=InnoDB;
ALTER TABLE ya_users ADD CONSTRAINT fk_ya_role_id FOREIGN KEY (id_ya_role) REFERENCES ya_role(id) ON DELETE CASCADE;
#------------------------------------------------------------
# Table: ya_flashcontent
#------------------------------------------------------------

CREATE TABLE ya_flashcontent(
        id          Int  Auto_increment  NOT NULL ,
        biography   Longtext NULL ,
        avatar      Varchar (30) NULL ,
        qrcode      Varchar (255) NOT NULL ,
        datehour    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        id_ya_users Int NOT NULL
	,CONSTRAINT ya_flashcontent_PK PRIMARY KEY (id)

	,CONSTRAINT ya_flashcontent_ya_users_FK FOREIGN KEY (id_ya_users) REFERENCES ya_users(id)
	,CONSTRAINT ya_flashcontent_ya_users_AK UNIQUE (id_ya_users)
)ENGINE=InnoDB;
ALTER TABLE ya_flashcontent ADD CONSTRAINT fk_ya_users_id FOREIGN KEY (id_ya_users) REFERENCES ya_users(id) ON DELETE CASCADE;
#------------------------------------------------------------
# Table: ya_commentstate
#------------------------------------------------------------

CREATE TABLE ya_commentstate(
        id    Int  Auto_increment  NOT NULL ,
        state Varchar (100) NOT NULL
	,CONSTRAINT ya_commentstate_PK PRIMARY KEY (id)
)ENGINE=InnoDB;

INSERT INTO `ya_commentstate`(state) VALUES('Attente');
INSERT INTO `ya_commentstate`(state) VALUES('Validé');
INSERT INTO `ya_commentstate`(state) VALUES('Effacer');

#------------------------------------------------------------
# Table: ya_comments
#------------------------------------------------------------

CREATE TABLE ya_comments(
        id                 Int  Auto_increment  NOT NULL ,
        username           Varchar (100) NOT NULL ,
        comments           Longtext NOT NULL ,
        datehour    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
        id_ya_users        Int NOT NULL ,
        id_ya_flashcontent Int NOT NULL ,
        id_ya_commentstate Int NOT NULL
	,CONSTRAINT ya_comments_PK PRIMARY KEY (id)

	,CONSTRAINT ya_comments_ya_users_FK FOREIGN KEY (id_ya_users) REFERENCES ya_users(id)
	,CONSTRAINT ya_comments_ya_flashcontent0_FK FOREIGN KEY (id_ya_flashcontent) REFERENCES ya_flashcontent(id)
	,CONSTRAINT ya_comments_ya_commentstate1_FK FOREIGN KEY (id_ya_commentstate) REFERENCES ya_commentstate(id)
)ENGINE=InnoDB;
ALTER TABLE ya_comments ADD CONSTRAINT fk_ya_flashcontent_id FOREIGN KEY (id_ya_flashcontent) REFERENCES ya_flashcontent(id) ON DELETE CASCADE;
 UPDATE `ya_role` SET `id` = '35' WHERE `ya_role`.`id` = 1;

ALTER TABLE ya_users ADD tokenUser VARCHAR(255) NULL;

ALTER TABLE ya_flashcontent ADD state INT(11) NULL;

CREATE TABLE `ya_paypal` (
 `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 `adresse` varchar(255) NOT NULL,
 `postal_code` IN NOT NULL,
 `city` VARCHAR(255)NOT NULL,
 `datehour` datetime NOT NULL,
 `id_ya_users` INT(11)  NOT NULL,
 `success` INT(11) NULL
);
