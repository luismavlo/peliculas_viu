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
                serie_img varchar(255) NOT NULL,
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
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE available_in
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE actuacion
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE actuacion
                ADD FOREIGN KEY (actor_id) REFERENCES actor (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE direccion
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE direccion
                ADD FOREIGN KEY (director_id) REFERENCES director (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE audio_languages
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE audio_languages
                ADD FOREIGN KEY (language_id) REFERENCES language (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE subtitles_languages
                ADD FOREIGN KEY (serie_id) REFERENCES serie (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
            ALTER TABLE subtitles_languages
                ADD FOREIGN KEY (language_id) REFERENCES language (id)
                    ON UPDATE CASCADE
                    ON DELETE CASCADE");

            $db->query("
                INSERT INTO language (name, ISO_code) VALUES
                ('English', 'en'),
                ('Spanish', 'es'),
                ('French', 'fr'),
                ('German', 'de'),
                ('Italian', 'it'),
                ('Japanese', 'ja')");

            // Insertar datos en la tabla serie
            $db->query("
                INSERT INTO serie (title, serie_img ,platform_id, review) VALUES
                ('Stranger Things', 'https://deadline.com/wp-content/uploads/2023/05/StrangerThings_StrangerThings4_9_02_14_28_08.jpg?w=681&h=383&crop=1' ,1, 'Great series!'),
                ('The Crown', 'https://hips.hearstapps.com/hmg-prod/images/the-crown-serie-netflix-reinas-657d8498a1182.jpg?crop=1xw:1xh;center,top&resize=1200:*',3, 'Historical drama'),
                ('Fleabag','https://www.blogenserie.com/wp-content/uploads/2019/09/fleabag-01.jpg', 2, 'Comedy-drama'),
                ('Breaking Bad', 'https://occ-0-2794-2219.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABbFI2wcwiGkHDdGWaw58hWgLETOBsbqqv6GbKnZFn3s_Y4fjw0Ys9DNYD5txnfV3oj9tgsBeaSnPcBOwQqQnpHVqHeQr9FtvVzaL.jpg?r=776', 1, 'High school chemistry teacher turned methamphetamine manufacturer'),
                ('The Mandalorian', 'https://cl.buscafs.com/www.tomatazos.com/public/uploads/images/426171/426171.jpeg', 1, 'Space Western'),
                ('Peaky Blinders', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2022/01/peaky-blinders-2591523.jpg?tf=3840x', 2, 'Crime drama')",
            );

            // Insertar datos en la tabla platform
            $db->query("
                INSERT INTO platform (name, image) VALUES
                ('Netflix', 'https://i.pcmag.com/imagery/reviews/05cItXL96l4LE9n02WfDR0h-5.fit_scale.size_760x427.v1582751026.png'),
                ('Hulu', 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2020/12/hulu-logo-2167439.jpg'),
                ('Prime video', 'https://zonasyc.com/wp-content/uploads/2023/09/amazon-prime-video-identidad-1200x670-1.webp'),
                ('Disney+', 'https://www.internetmatters.org/wp-content/uploads/2020/04/disney-plus-logo-1143358.jpeg'),
                ('BBC', 'https://ichef.bbci.co.uk/images/ic/1920x1080/p09xtmrp.jpg')");

            // Insertar datos en la tabla director
            $db->query("
                INSERT INTO director (name, surname, birthdate, nationality) VALUES
                ('Steven', 'Spielberg', '1946-12-18', 'American'),
                ('Christopher', 'Nolan', '1970-07-30', 'British'),
                ('Quentin', 'Tarantino', '1963-03-27', 'American'),
                ('Vince', 'Gilligan', '1967-02-10', 'American'),
                ('Jon', 'Favreau', '1966-10-19', 'American'),
                ('Steven', 'Knight', '1959-02-17', 'British')");

            // Insertar datos en la tabla actor
            $db->query("
                INSERT INTO actor (name, surname, birthdate, nationality) VALUES
                ('Tom', 'Hanks', '1956-07-09', 'American'),
                ('Scarlett', 'Johansson', '1984-11-22', 'American'),
                ('Leonardo', 'DiCaprio', '1974-11-11', 'American'),
                ('Bryan', 'Cranston', '1956-03-07', 'American'),
                ('Pedro', 'Pascal', '1975-04-02', 'Chilean-American'),
                ('Cillian', 'Murphy', '1976-05-25', 'Irish')");

            // Insertar datos en la tabla actuacion
            $db->query("
                INSERT INTO actuacion (serie_id, actor_id) VALUES
                (1, 1),
                (1, 2),
                (2, 3),
                (4, 4),
                (5, 5),
                (6, 6)");

            // Insertar datos en la tabla direccion
            $db->query("
                INSERT INTO direccion (director_id, serie_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3),
                (4, 4),
                (5, 5),
                (6, 6)");

            // Insertar datos en la tabla available_in
            $db->query("
                INSERT INTO available_in (serie_id, platform_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3),
                (4, 1),
                (5, 1),
                (6, 2)");

            // Insertar datos en la tabla audio_languages
            $db->query("
                INSERT INTO audio_languages (serie_id, language_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3),
                (4, 1),
                (5, 2),
                (6, 3)");

            // Insertar datos en la tabla subtitles_languages
            $db->query("
                INSERT INTO subtitles_languages (serie_id, language_id) VALUES
                (1, 1),
                (2, 2),
                (3, 3),
                (4, 2),
                (5, 3),
                (6, 1)");

            $db->commit();
        } catch (Exception $e) {
            print_r($e);
            $db->rollback();
        } finally {
            $db->close();
        }
    }
}