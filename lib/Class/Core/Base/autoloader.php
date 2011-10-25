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
        //spl_autoload_register(array($this,'helper'));
        //spl_autoload_register(array($this,'controller'));
        //spl_autoload_register(array($this,'library'));
    }

    public function model($class) {
        include_once APP_DIR . 'App/Model/' . $class . '.php';
    }

    /*
    public function library($class) {
        set_include_path(get_include_path().PATH_SEPARATOR.'/lib/');
        spl_autoload_extensions('.library.php');
        spl_autoload($class);
    }

    public function controller($class) {
        $class = preg_replace('/_controller$/ui','',$class);

        set_include_path(get_include_path().PATH_SEPARATOR.'/controller/');
        spl_autoload_extensions('.controller.php');
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