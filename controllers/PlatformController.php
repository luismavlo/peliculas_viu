<?php

require_once 'models/Platform.php';

class PlatformController {

    public function index(){
        $platform = new Platform();
        $platforms = $platform->findAll();

        require_once 'views/platforms/platformPage.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . base_url . "Platform/index");
            $_SESSION['create_platform'] = "failed";
            return;
        }

        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $image = isset($_POST['image']) ? trim($_POST['image']) : '';

        // Validación de campos
        if (empty($name) || empty($image)) {
            $_SESSION['create_platform'] = "failed";
            return;
        }

        $platform = new Platform();
        $platform->setName($name);
        $platform->setImage($image);

        if(isset($_GET['id'])){
            $platform->setId($_GET['id']);
            $save = $platform->update();
        }else {
            $save = $platform->save();
        }


        if (!$save) {
            $_SESSION['create_platform'] = "failed";
            header("Location: " . base_url . "Platform/index");
            return;
        }

        $_SESSION['create_platform'] = "completed";
        header("Location: " . base_url . "Platform/index");
    }
  

    public function update()
    {
        if(!isset($_GET['id'])){
            $_SESSION['find_platform'] = 'failed';
            header('Location:'.base_url.'Platform/index');
        }

        $edit = true;
        $id = $_GET['id'];
        $platform = new Platform();
        $platform->setId($id);
        $platformFoundIt = $platform->findOne();

        require_once 'views/platforms/platformPage.php';
    }

    public function delete()
    {
        if(!isset($_GET['id'])){
            $_SESSION['delete_platform'] = 'failed';
        }

        $id = $_GET['id'];
        $platform = new Platform();
        $platform->setId($id);
        $delete = $platform->delete();

        if(!$delete){
            $_SESSION['delete_platform'] = 'failed';
        }

        $_SESSION['delete_platform'] = 'completed';

        header('Location:'.base_url.'Platform/index');
    }

}
