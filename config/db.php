<?php


class Database {

    public static function connect()
    {
        $db = new mysqli('localhost', 'root', 'pass1234', 'seriesdb', 3308);
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}