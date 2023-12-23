<?php



class Util
{

    public static function deleteSession($name)
    {
        if(!isset($_SESSION[$name])){
            return $name;
        }

        $_SESSION[$name] = null;
        unset($_SESSION[$name]);
        return $name;
    }

}