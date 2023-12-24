<?php

class HomeController
{
    public function index(){
        require_once 'views/home/index.php';
    }

    public function load_database()
    {
        Database::load_db();
    }
}