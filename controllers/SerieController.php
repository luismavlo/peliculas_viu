<?php
require_once __DIR__ . '/../models/Director.php';
require_once './models/Serie.php';
require_once __DIR__ . '/../models/Serie.php';
require_once __DIR__ . '/../models/Platform.php';
require_once __DIR__ . '/../models/Actor.php';


class SerieController {

    public function index(){
        $serie = new Serie();
        $series = $serie->findAll();
        $platform = new Platform();
        $platforms = $platform->findAll();
        $director = new Director();
        $directors = $director->findAllDirectors();
        $actor = new Actor();
        $actors = $actor->findAllActors();

        require_once 'views/serie/seriePage.php';
     }
     public function create()
    {
     
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . base_url . "Serie/index");
            $_SESSION['create_serie'] = "failed";
            return;
        }


        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $platformId = isset($_POST['platform']) ? trim($_POST['platform']) : '';
        $review = isset($_POST['review'])  ? ($_POST['review']): '' ;
        $actorIds = isset($_POST['actors'])  ? ($_POST['actors']): '' ;
        $directorId = isset($_POST['director']) ? trim($_POST['director']) : '';

      $serie = new Serie();

      if(isset($_GET['id'])){
        if (empty($name) || empty($review) ) {
          $_SESSION['create_serie'] = "failed";
          return;
        }

        $serie->setName($name);
        $serie->setReview($review);

        $serie->setId($_GET['id']);
        $save = $serie->update();
      }else {
        if (empty($name) || empty($review)|| empty($platformId) || empty($directorId) || count($actorIds) == 0 ) {
          $_SESSION['create_serie'] = "failed";
          return;
        }

        $actorIds = array_map('intval', explode(',', implode(',', $actorIds)));
        $directorId = intval($directorId);
        $platformId = intval($platformId);


        if(!is_numeric($directorId) || !is_numeric($platformId)){
          $_SESSION['create_serie'] = "failed";
          return;
        }

        $serie->addActors($actorIds);
        $serie->setName($name);
        $serie->setPlatformId($platformId);
        $serie->setReview($review);

        $director= new Director();

        $director= $director->findDirector($directorId);
        $serie->setDirector($director);

        $save = $serie->save();
        $serieId = $serie->findSerieIdByName($serie->getName());
        $serie->setId($serieId);

        $serie->savePerformance();
        $serie->saveDirect();
      }

        if (!$save) {
            $_SESSION['create_serie'] = "failed";
            header("Location: " . base_url . "Serie/index");
            return;
        }

        $_SESSION['create_serie'] = "completed";
        header("Location: " . base_url . "Serie/index");
    }



    public function update()
    {
        
        if(!isset($_GET['id'])){
            $_SESSION['find_serie'] = 'failed';
            echo  $_SESSION['find_serie'];
            header('Location:'.base_url.'Serie/index');
        }

        $edit = true;
        $serieId = $_GET['id'];

        $serie = new Serie();
        $serie->setId($serieId);
        $serieFoundIt = $serie->findSerie($serieId);


        $platform = new Platform();
        $platforms = $platform->findAll();
        $director = new Director();
        $directors = $director->findAllDirectors();
        $actor = new Actor();
        $actors = $actor->findAllActors();

        $directorSelected = $serie->findDirectorOfSerie($serieId);



        require_once 'views/serie/seriePage.php';
    }

    public function delete()
    {
    
        if(!isset($_GET['id'])){
            $_SESSION['delete_serie'] = 'failed';
    
        }

        $id = $_GET['id'];
        $serie = new Serie();
        $serie->setId($id);
        $delete = $serie->delete();

        if(!$delete){
            $_SESSION['delete_serie'] = 'failed';
        }

        $_SESSION['delete_serie'] = 'completed';

        header('Location:'.base_url.'Serie/index');
    }

    public static function findActorsInSerie($serie)
    {
      $actor = new Actor();
      return $actor->printActors($serie->getActors());
    }

}


