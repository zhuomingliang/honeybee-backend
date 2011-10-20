<?php
require_once 'Controller.php';

Class AppController extends Controller {
    private static $_class;

    public function __construct() {
        self::$_class = isset($_GET['_CLASS_NAME']) ? $_GET['_CLASS_NAME'] : 'index';

        unset($_GET['_CLASS_NAME']);
    }

    public static function CreateApp() {
        return new AppController();
    }

    public function run() {
        $class_file = APP_DIR . 'App/Controller/' . self::$_class . '.php';
        if (!is_file($class_file)) {
            header('HTTP/1.1 404 Not Found');
            throw new Exception('Couldn\'t find \'' . self::$_class . '.php\' , are you visiting wrong file?');
        }

        include_once $class_file;
        if (!class_exists(self::$_class, false)){
            throw new Exception('Couldn\'t find \'' . self::$_class . '\' class, are you writting wrong class name?');
        }

        $class = new self::$_class();
    }
}
?>