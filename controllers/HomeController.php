<?php
require_once __DIR__ .'/../models/Platform.php';
require_once __DIR__ . '/../models/Director.php';
require_once __DIR__ .'/../models/Serie.php';
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

    public function serieDetail(){
       
        if(!isset($_GET['id'])){
            $_SESSION['find_serie'] = 'failed';
            echo  $_SESSION['find_serie'];
            header('Location:'.base_url.'Serie/index');
        }
#181818
        $edit = true;
        $serieId = $_GET['id'];

        $serie = new Serie();
        $serie->setId($serieId);
;

        $serieFoundIt = $serie->findSerie($serieId);
         
        require_once 'views/serie/serieDetailPage.php';
    }
    public function load_database()
    {
        Database::load_db();
    }
}