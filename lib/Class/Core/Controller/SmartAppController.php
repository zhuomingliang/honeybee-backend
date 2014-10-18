<?php
Class SmartAppController extends AppController {
    public static function CreateApp() {
        return new SmartAppController();
    }

    public function run() {
        $class_file = APP_DIR . 'App/Controller/' . self::$_class . '.php';
        if (!is_file($class_file)) {
            // header('HTTP/1.1 404 Not Found');
            // throw new Exception('Couldn\'t find \'' . $class_file . '\' , are you visiting wrong file?');
            $this->route(ucfirst(self::$_class));
            return;
        }

        include $class_file;
        $class_name = self::$_class . 'Controller';
        if (!class_exists($class_name, false)){
            throw new Exception('Couldn\'t find \'' . $class_name . '\' class, are you writting wrong class name?');
        }

        $class = new $class_name();
        $class->route();
    }
}
?>