CREATE TABLE language (
                          id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
                          name varchar(255) UNIQUE NOT NULL,
                          ISO_code varchar(255) UNIQUE NOT NULL
);

CREATE TABLE serie (
                       id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       title varchar(255) NOT NULL,
                       platform_id integer NOT NULL,
                       review text NOT NULL
);

CREATE TABLE platform (
                          id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
                          name varchar(255) NOT NULL,
                          image varchar(255) NOT NULL
);

CREATE TABLE director (
                          id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
                          name varchar(255) NOT NULL,
                          surname varchar(255) NOT NULL,
                          birthdate timestamp NOT NULL,
                          nationality varchar(255) NOT NULL
);

CREATE TABLE actor (
                       id integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       name varchar(255) NOT NULL,
                       surname varchar(255) NOT NULL,
                       birthdate timestamp NOT NULL,
                       nationality varchar(255) NOT NULL
);

CREATE TABLE actuacion (
                           serie_id integer NOT NULL ,
                           actor_id integer NOT NULL ,
                           PRIMARY KEY (serie_id, actor_id)
);

CREATE TABLE direccion (
                           director_id integer NOT NULL ,
                           serie_id integer NOT NULL ,
                           PRIMARY KEY (director_id, serie_id)
);

CREATE TABLE available_in (
                              serie_id integer NOT NULL ,
                              platform_id integer NOT NULL ,
                              PRIMARY KEY (serie_id, platform_id)
);

CREATE TABLE audio_languages (
                                 serie_id integer NOT NULL ,
                                 language_id integer NOT NULL ,
                                 PRIMARY KEY (serie_id, language_id)
);

CREATE TABLE subtitles_languages (
                                     serie_id integer NOT NULL ,
                                     language_id integer NOT NULL ,
                                     PRIMARY KEY (serie_id, language_id)
);

-- Ejemplo con RESTRICT
ALTER TABLE available_in
    ADD FOREIGN KEY (platform_id) REFERENCES platform (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE available_in
    ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE actuacion
    ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE actuacion
    ADD FOREIGN KEY (actor_id) REFERENCES actor (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE direccion
    ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE direccion
    ADD FOREIGN KEY (director_id) REFERENCES director (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE audio_languages
    ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE audio_languages
    ADD FOREIGN KEY (language_id) REFERENCES language (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE subtitles_languages
    ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

ALTER TABLE subtitles_languages
    ADD FOREIGN KEY (language_id) REFERENCES language (id)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT;

