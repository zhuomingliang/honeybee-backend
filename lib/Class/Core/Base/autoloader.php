<?php

class Autoloader {

    public static function init() {
        static $loader = null;
        if ($loader == null)
            $loader = new self();

        return $loader;
    }

    public function __construct() {
        spl_autoload_register(array($this,'model'));

        // Don't use too many stack here to avoid unnecessary is_file conditions,
        // since we always include a controller and an action every request,
        // so it's done by the AppController and Controller.
        //spl_autoload_register(array($this,'controller'));
        //spl_autoload_register(array($this,'helper'));
        //spl_autoload_register(array($this,'library'));
    }

    public function model($class) {
        $class_file = APP_DIR . 'App/Model/' . $class . '.php';
        if (!is_file($class_file)) {
            throw new Exception('Couldn\'t find \'' . $class . '.php\' , are you visiting wrong file?');
        }

        include $class_file;
        if (!class_exists($class, false)){
            throw new Exception('Couldn\'t find \'' . $class . '\' class, are you writting wrong class name?');
        }
    }

    /*
    public function controller($class) {
        echo $class, ' Controller;<br>';
        $file_name  = substr_replace($class, '', -10, 10);
        $class_file = APP_DIR . 'App/Controller/' . $file_name . '.php';

        if (!is_file($class_file)) {
            if(substr($class, -10, 10) != 'Controller') return;
            header('HTTP/1.1 404 Not Found');
            throw new Exception('Couldn\'t find \'' . $file_name . '.php\' , are you visiting wrong file?');
        }

        include $class_file;
    }

    public function library($class) {
        set_include_path(get_include_path().PATH_SEPARATOR.'/lib/');
        spl_autoload_extensions('.library.php');
        spl_autoload($class);
    }

    public function helper($class) {
        $class = preg_replace('/_helper$/ui','',$class);

        set_include_path(get_include_path().PATH_SEPARATOR.'/helper/');
        spl_autoload_extensions('.helper.php');
        spl_autoload($class);
    }
    */

}
?>