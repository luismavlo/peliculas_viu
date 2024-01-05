<?php
require_once 'models/Language.php';

class LanguageController {

    public function index(){
       
       //$id = isset($_GET['id']) ? trim($_GET['id']) : '';
       // echo "Controlador Directores, Acción Index:".$id;
       $language = new Language();
       $languages = $language->findAll();
        require_once 'views/language/languagePage.php';
    }


    public function create()
    {
       
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . base_url . "Language/index");
            $_SESSION['create_language'] = "failed";
            return;
        }
       
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $isoCode = isset($_POST['isoCode']) ? trim($_POST['isoCode']) : '';
       
        // Validación de campos
        if (empty($name) || empty($isoCode)) {
            $_SESSION['create_language'] = "failed";
            return;
        }

        echo "Controlador Language, Acción Index:".$name;
        // Puedes agregar más validaciones según tus necesidades

        $language = new Language();
        $language->setName($name);
        $language->setIsoCode($isoCode);
        
        if(isset($_GET['id'])){
            $language->setId($_GET['id']);
            $save = $language->update();
        }else {
            $save = $language->save();
        }

       
        if (!$save) {
            $_SESSION['create_language'] = "failed";
            header("Location: " . base_url . "Language/index");
            return;
        }

        $_SESSION['create_language'] = "completed";
        header("Location: " . base_url . "Language/index");
    }



    public function update()
    {
        if(!isset($_GET['id'])){
            $_SESSION['find_language'] = 'failed';
            header('Location:'.base_url.'Language/index');
        }

        $edit = true;
        $id = $_GET['id'];
        $language = new Language();
        $language->setId($id);
        $languageFoundIt = $language->findOne();

        require_once 'views/Language/languagePage.php';
    }

    public function delete()
    {
        if(!isset($_GET['id'])){
            $_SESSION['delete_language'] = 'failed';
        }

        $id = $_GET['id'];
        $language = new Language();
        $language->setId($id);
        $delete = $language->delete();

        if(!$delete){
            $_SESSION['delete_language'] = 'failed';
        }

        $_SESSION['delete_language'] = 'completed';

        header('Location:'.base_url.'Language/index');
    }



}