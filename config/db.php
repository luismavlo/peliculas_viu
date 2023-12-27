<?php


class Database {

    public static function connect()
    {
        $db = new mysqli('localhost', 'root', 'pass1234', 'seriesdb', 3308);

        // Verificar errores de conexión
        if ($db->connect_error) {
            die('Error de conexión (' . $db->connect_errno . '): ' . $db->connect_error);
        }

        // Establecer juego de caracteres UTF-8
        $db->query("SET NAMES 'utf8'");

        return $db;
    }


    public static function load_db()
    {
        $db = self::connect();

        // Iniciar la transacción
        $db->begin_transaction();

        try {
            $db->query("
            CREATE TABLE IF NOT EXISTS language (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) UNIQUE NOT NULL,
                ISO_code varchar(255) UNIQUE NOT NULL,
                UNIQUE (id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS serie (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                title varchar(255) NOT NULL,
                platform_id INT NOT NULL,
                review text NOT NULL,
                UNIQUE (id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS platform (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                image varchar(255) NOT NULL,
                UNIQUE (id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS director (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                surname varchar(255) NOT NULL,
                birthdate DATE NOT NULL,
                nationality varchar(255) NOT NULL,
                UNIQUE (id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS actor (
                id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name varchar(255) NOT NULL,
                surname varchar(255) NOT NULL,
                birthdate DATE NOT NULL,
                nationality varchar(255) NOT NULL,
                UNIQUE (id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS actuacion (
                serie_id INT NOT NULL ,
                actor_id INT NOT NULL ,
                PRIMARY KEY (serie_id, actor_id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS direccion (
                director_id INT NOT NULL ,
                serie_id INT NOT NULL ,
                PRIMARY KEY (director_id, serie_id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS available_in (
                serie_id INT NOT NULL ,
                platform_id INT NOT NULL ,
                PRIMARY KEY (serie_id, platform_id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS audio_languages (
                serie_id INT NOT NULL ,
                language_id INT NOT NULL ,
                PRIMARY KEY (serie_id, language_id)
            )");

            $db->query("
            CREATE TABLE IF NOT EXISTS subtitles_languages (
                serie_id INT NOT NULL ,
                language_id INT NOT NULL ,
                PRIMARY KEY (serie_id, language_id)
            )");

            // Añadir restricciones de clave externa
            $db->query("
            ALTER TABLE available_in
                ADD FOREIGN KEY (platform_id) REFERENCES platform (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE available_in
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE actuacion
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE actuacion
                ADD FOREIGN KEY (actor_id) REFERENCES actor (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE direccion
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE direccion
                ADD FOREIGN KEY (director_id) REFERENCES director (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE audio_languages
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE audio_languages
                ADD FOREIGN KEY (language_id) REFERENCES language (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE subtitles_languages
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
            ALTER TABLE subtitles_languages
                ADD FOREIGN KEY (language_id) REFERENCES language (id)
                    ON UPDATE RESTRICT
                    ON DELETE RESTRICT");

            $db->query("
                INSERT INTO language (name, ISO_code) VALUES
                ('English', 'en'),
                ('Spanish', 'es'),
                ('French', 'fr')");

            // Insertar datos en la tabla serie
            $db->query("
                INSERT INTO serie (title, platform_id, review) VALUES
                ('Stranger Things', 1, 'Great series!'),
                ('The Crown', 3, 'Historical drama'),
                ('Fleabag', 2, 'Comedy-drama')");

            // Insertar datos en la tabla platform
            $db->query("
                INSERT INTO platform (name, image) VALUES
                ('Netflix', 'netflix.png'),
                ('Hulu', 'hulu.png'),
                ('Amazon Prime', 'amazon.png')");

            // Insertar datos en la tabla director
            $db->query("
                INSERT INTO director (name, surname, birthdate, nationality) VALUES
                ('Steven', 'Spielberg', '1946-12-18', 'American'),
                ('Christopher', 'Nolan', '1970-07-30', 'British'),
                ('Quentin', 'Tarantino', '1963-03-27', 'American')");

            // Insertar datos en la tabla actor
            $db->query("
                INSERT INTO actor (name, surname, birthdate, nationality) VALUES
                ('Tom', 'Hanks', '1956-07-09', 'American'),
                ('Scarlett', 'Johansson', '1984-11-22', 'American'),
                ('Leonardo', 'DiCaprio', '1974-11-11', 'American')");

            // Insertar datos en la tabla actuacion
            $db->query("
                INSERT INTO actuacion (serie_id, actor_id) VALUES
                (1, 1),
                (1, 2),
                (2, 3)");

            // Insertar datos en la tabla direccion
            $db->query("
                INSERT INTO direccion (director_id, serie_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3)");

            // Insertar datos en la tabla available_in
            $db->query("
                INSERT INTO available_in (serie_id, platform_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3)");

            // Insertar datos en la tabla audio_languages
            $db->query("
                INSERT INTO audio_languages (serie_id, language_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3)");

            // Insertar datos en la tabla subtitles_languages
            $db->query("
                INSERT INTO subtitles_languages (serie_id, language_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3)");

            $db->commit();
        } catch (Exception $e) {
            print_r($e);
            $db->rollback();
        } finally {
            $db->close();
        }
    }
}