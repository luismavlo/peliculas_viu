<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/util.php';
require_once 'views/layout/navbar.php';

function show_error(){
    $error = new ErrorController();
    $error->index();
}

if(isset($_GET['controller'])){
    $name_controller = $_GET['controller'].'Controller';
} elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
    $name_controller = controller_default;
}else{
    show_error();
    exit();
}

if(class_exists($name_controller)){
    $controller = new $name_controller();
    if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
        $action = $_GET['action'];
        $controller->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])) {
        $action_default = action_default;
        $controller->$action_default();
    }else{
        show_error();
    }
}else{
    show_error();
}

require_once 'views/layout/footer.php';