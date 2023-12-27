<?php
require_once 'models/Actor.php';

class ActorController {

    public function index(){
       
       //$id = isset($_GET['id']) ? trim($_GET['id']) : '';
       // echo "Controlador Directores, Acción Index:".$id;
       $actor = new Actor();
       $actors = $actor->findAll();
        require_once 'views/actor/actorPage.php';
    }


    public function create()
    {
       
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . base_url . "Actor/index");
            $_SESSION['create_actor'] = "failed";
            return;
        }
       
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
        $birthdate = isset($_POST['birthdate']) ? trim($_POST['birthdate']) : '';
        $nationality = isset($_POST['nationality']) ? trim($_POST['nationality']) : '';
       

        // Validación de campos
        if (empty($name) || empty($surname)|| empty($birthdate)|| empty($nationality)) {
            $_SESSION['create_actor'] = "failed";
            return;
        }

        echo "Controlador Actores, Acción Index:".$birthdate;
        // Puedes agregar más validaciones según tus necesidades

        $actor = new Actor();
        $actor->setName($name);
        $actor->setSurname($surname);
        $actor->setBirthDate($birthdate);
        $actor->setNationality($nationality);

        if(isset($_GET['id'])){
            $actor->setId($_GET['id']);
            $save = $actor->update();
        }else {
            $save = $actor->save();
        }

       
        if (!$save) {
            $_SESSION['create_actor'] = "failed";
            header("Location: " . base_url . "Actor/index");
            return;
        }

        $_SESSION['create_actor'] = "completed";
        header("Location: " . base_url . "Actor/index");
    }



    public function update()
    {
        if(!isset($_GET['id'])){
            $_SESSION['find_actor'] = 'failed';
            header('Location:'.base_url.'Actor/index');
        }

        $edit = true;
        $id = $_GET['id'];
        $actor = new Actor();
        $actor->setId($id);
        $actorFoundIt = $actor->findOne();

        require_once 'views/Actor/actorPage.php';
    }

    public function delete()
    {
        if(!isset($_GET['id'])){
            $_SESSION['delete_actor'] = 'failed';
        }

        $id = $_GET['id'];
        $actor = new Actor();
        $actor->setId($id);
        $delete = $actor->delete();

        if(!$delete){
            $_SESSION['delete_actor'] = 'failed';
        }

        $_SESSION['delete_actor'] = 'completed';

        header('Location:'.base_url.'Actor/index');
    }



}