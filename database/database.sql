 CREATE TABLE IF NOT EXISTS language (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) UNIQUE NOT NULL,
                ISO_code varchar(255) UNIQUE NOT NULL,
                UNIQUE (id)
            );

CREATE TABLE IF NOT EXISTS serie (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                serie_img varchar(255) NOT NULL,
                platform_id INT NOT NULL,
                review text NOT NULL,
                UNIQUE (id)
            );

  CREATE TABLE IF NOT EXISTS platform (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                image varchar(255) NOT NULL,
                UNIQUE (id)

            );

 CREATE TABLE IF NOT EXISTS director (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                surname varchar(255) NOT NULL,
                birthdate DATE NOT NULL,
                nationality varchar(255) NOT NULL,
                UNIQUE (id)
            );

  CREATE TABLE IF NOT EXISTS actor (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                surname varchar(255) NOT NULL,
                birthdate DATE NOT NULL,
                nationality varchar(255) NOT NULL,
                UNIQUE (id)
            );

 CREATE TABLE IF NOT EXISTS actuacion (
                serie_id INT NOT NULL ,
                actor_id INT NOT NULL ,
                PRIMARY KEY (serie_id, actor_id)
            );

 CREATE TABLE IF NOT EXISTS direccion (
                director_id INT NOT NULL ,
                serie_id INT NOT NULL ,
                PRIMARY KEY (director_id, serie_id)
            );



 CREATE TABLE IF NOT EXISTS audio_languages (
                serie_id INT NOT NULL ,
                language_id INT NOT NULL ,
                PRIMARY KEY (serie_id, language_id)
            );

CREATE TABLE IF NOT EXISTS subtitles_languages (
                serie_id INT NOT NULL ,
                language_id INT NOT NULL ,
                PRIMARY KEY (serie_id, language_id)
            );

-- Ejemplo con CASCADE--
 ALTER TABLE serie
                ADD FOREIGN KEY (platform_id) REFERENCES platform (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE;

 
            ALTER TABLE actuacion
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE

            ALTER TABLE actuacion
                ADD FOREIGN KEY (actor_id) REFERENCES actor (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE

         
            ALTER TABLE direccion
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT

            ALTER TABLE direccion
                ADD FOREIGN KEY (director_id) REFERENCES director (id)
                    ON UPDATE CASCADE
                    ON DELETE RESTRICT

          
            ALTER TABLE audio_languages
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE

        
            ALTER TABLE audio_languages
                ADD FOREIGN KEY (language_id) REFERENCES language (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE

       
            ALTER TABLE subtitles_languages
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE

            ALTER TABLE subtitles_languages
                ADD FOREIGN KEY (language_id) REFERENCES language (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE

