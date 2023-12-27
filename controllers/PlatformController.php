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

        $save = $platform->save();

        if (!$save) {
            $_SESSION['create_platform'] = "failed";
            header("Location: " . base_url . "Platform/index");
            return;
        }

        $_SESSION['create_platform'] = "completed";
        header("Location: " . base_url . "Platform/index");
    }

    public function findAll(){

    }

}
