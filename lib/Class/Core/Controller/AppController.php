<?php
require_once 'Controller.php';

Class AppController extends Controller {
    private static $_class;

    public function __construct() {
        self::$_class = isset($_GET['_CLASS_NAME']) ? ucfirst($_GET['_CLASS_NAME']) : 'index';

        unset($_GET['_CLASS_NAME']);
    }

    public static function CreateApp() {
        return new AppController();
    }

    public function run() {
        $class_file = APP_DIR . 'App/Controller/' . self::$_class . '.php';
        if (!is_file($class_file)) {
            header('HTTP/1.1 404 Not Found');
            //header('status: 404 Not Found');
            exit;
        }
        
        include_once $class_file;
        if (class_exists(self::$_class, false)){
            $class = new self::$_class();
        }
    }
}
?>