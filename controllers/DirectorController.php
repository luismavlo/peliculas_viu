<?php
require_once 'models/Director.php';

class DirectorController {

    public function index(){
       
       //$id = isset($_GET['id']) ? trim($_GET['id']) : '';
       // echo "Controlador Directores, Acción Index:".$id;
       $director = new Director();
       $directors = $director->findAll();
        require_once 'views/director/directorPage.php';
    }


    public function create()
    {
       
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . base_url . "Director/index");
            $_SESSION['create_director'] = "failed";
            return;
        }
       
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $surname = isset($_POST['surname']) ? trim($_POST['surname']) : '';
        $birthdate = isset($_POST['birthdate']) ? trim($_POST['birthdate']) : '';
        $nationality = isset($_POST['nationality']) ? trim($_POST['nationality']) : '';
       

        // Validación de campos
        if (empty($name) || empty($surname)|| empty($birthdate)|| empty($nationality)) {
            $_SESSION['create_director'] = "failed";
            return;
        }

        echo "Controlador Directores, Acción Index:".$birthdate;
        // Puedes agregar más validaciones según tus necesidades

        $director = new Director();
        $director->setName($name);
        $director->setSurname($surname);
        $director->setBirthDate($birthdate);
        $director->setNationality($nationality);

        if(isset($_GET['id'])){
            $director->setId($_GET['id']);
            $save = $director->update();
        }else {
            $save = $director->save();
        }

       
        if (!$save) {
            $_SESSION['create_director'] = "failed";
            header("Location: " . base_url . "Director/index");
            return;
        }

        $_SESSION['create_director'] = "completed";
        header("Location: " . base_url . "Director/index");
    }



    public function update()
    {
        if(!isset($_GET['id'])){
            $_SESSION['find_director'] = 'failed';
            header('Location:'.base_url.'Director/index');
        }

        $edit = true;
        $id = $_GET['id'];
        $director = new Director();
        $director->setId($id);
        $directorFoundIt = $director->findOne();

        require_once 'views/Director/directorPage.php';
    }

    public function delete()
    {
        if(!isset($_GET['id'])){
            $_SESSION['delete_director'] = 'failed';
        }

        $id = $_GET['id'];
        $director = new Director();
        $director->setId($id);
        $delete = $director->delete();

        if(!$delete){
            $_SESSION['delete_director'] = 'failed';
        }

        $_SESSION['delete_director'] = 'completed';

        header('Location:'.base_url.'Director/index');
    }



}