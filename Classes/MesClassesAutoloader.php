<?php

namespace Classes;

class MesClassesAutoloader
{
    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    private static function autoload($class) {
        require dirname(__DIR__) ."\\$class.php";
    }
}

MesClassesAutoloader::register();

?>