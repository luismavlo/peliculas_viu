<?php
require_once 'C:/xampp/htdocs/actividad1-viu/models/Director.php';
require_once 'models/Serie.php';
require_once 'C:/xampp/htdocs/actividad1-viu/models/Serie.php';
require_once 'C:/xampp/htdocs/actividad1-viu/models/Platform.php';
require_once 'C:/xampp/htdocs/actividad1-viu/models/Actor.php';
require_once 'C:/xampp/htdocs/actividad1-viu/models/Director.php';

class SerieController {

    public function index(){
       
        //$id = isset($_GET['id']) ? trim($_GET['id']) : '';
        // echo "Controlador Serie, Acción Index:".$id;
        $serie = new Serie();
        $series = $serie->findAll();
         require_once 'views/serie/seriePage.php';
     }
     public function create()
    {
     
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header("Location: " . base_url . "Serie/index");
            $_SESSION['create_serie'] = "failed";
            return;
        }
        $serie = new Serie();
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $platformId = isset($_POST['platform']) ? trim($_POST['platform']) : '';
        $review = isset($_POST['review'])  ? ($_POST['review']): '' ;
        $actors = isset($_POST['actors'])  ? ($_POST['actors']): '' ;
        $director = isset($_POST['director']) ? trim($_POST['director']) : '';
        $r='';
      
    
        if(is_array($review)){
            $r=implode(", ",$review);
        }
                         
        $review=$r;
        $serie->addActors($actors);

 

        if (empty($name) || empty($review)|| empty($platformId)) {

            $_SESSION['create_serie'] = "failed";
           
            return;
        }
      
        echo "Controlador Serie, Acción Index:".$name;
        // Puedes agregar más validaciones según tus necesidades

       
        $serie->setName($name);
        $serie->setPlatformId($platformId);
        $serie->setReview($review);
        $d=new Director();
        $d= $d->findDirector($director);
        $serie->setDirector($d);
    
        if(isset($_GET['id'])){
            $serie->setId($_GET['id']);
            $save = $serie->update();
        }else {
            $save = $serie->save();
            $id=$serie->findId($serie->getName());
            $serie->setId($id);
            
            $p=$serie->savePerformance();   
            $d=$serie->saveDirect();
            
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
        $id = $_GET['id'];
        $serie = new Serie();
        $serie->setId($id);
        $serieFoundIt = $serie->findSerie($id);

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



}

