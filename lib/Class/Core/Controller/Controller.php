<?php
abstract Class Controller {
    public $PATH_INFO;
    protected $_routes = array();

    public function __construct() {
        $this->PATH_INFO = isset($_GET['_PATH_INFO']) ? strtolower(trim($_GET['_PATH_INFO'])) : '';
        unset($_GET['_PATH_INFO']);
    }

    public function routeClass($class, $class_file) {
        if (!is_file($class_file)) {
            header('HTTP/1.1 404 Not Found');
            throw new Exception('Couldn\'t find \'' . $class_file . '\' , are you visiting wrong file?');
        }
        include $class_file;
        if (!class_exists($class, false)){
            throw new Exception('Couldn\'t find \'' . $class . '\' class, are you writting wrong class name?');
        }

        $class = new $class($this->PATH_INFO);
        $class->show();
    }

    public function route($class = 'Index') {
        if($this->PATH_INFO) {
            foreach ($this->_routes as $_route => $_class) {
                if(!preg_match($_route, $this->PATH_INFO)) continue;

                $class_file = APP_DIR . 'App/Action/' . $class . '/' . $_class . '.php';

                $this->routeClass($_class . 'Action', $class_file);

                return;
            }
        }

        $class_file = APP_DIR . 'App/Action/' . $class . '.php';
        $this->routeClass($class . 'Action', $class_file);
    }
}
?>
