<?php
require_once __DIR__ .'/../models/Platform.php';
require_once __DIR__ . '/../models/Director.php';
require_once __DIR__ .'/../models/Serie.php';
require_once __DIR__ . '/../models/Serie.php';
require_once __DIR__ . '/../models/Actor.php';
require_once __DIR__ . '/../models/Language.php';

class HomeController
{
    public function index(){
        $platform = new Platform();
        $platforms = $platform->findAllPlatformWithCountSeries();
        $serie = new Serie();
        $series = $serie->findAll();
        $director = new Director();
        $directors = $director->findAllDirectors();
        $actor = new Actor();
        $actors = $actor->findAllActors();
        $language = new Language();
        $languages = $language->findAllLanguages();
        require_once 'views/home/index.php';
    }

    public function load_database()
    {
        Database::load_db();
    }
}