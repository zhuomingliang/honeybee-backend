<?php
Class AppController {
    protected $_PATH_INFO = '';
    private static $_class = '';
    public function __construct() {
        self::$_class = isset($_GET['_CLASS_NAME']) ? ucfirst($_GET['_CLASS_NAME']) : 'index';
        $this->_PATH_INFO = isset($_GET['_PATH_INFO']) ? $_GET['_PATH_INFO'] : '';

        unset($_GET['_CLASS_NAME']);
        unset($_GET['_PATH_INFO']);
    }

    public static function CreateApp() {
        return new AppController();
    }

    public function run() {
        $class_file = APP_DIR . 'App/Controller/' . self::$_class . '.php';
        if (is_file($class_file)) {
            include_once $class_file;
        }

        if (class_exists(self::$_class, false)){
            new self::$_class();
        }
    }
}
?>