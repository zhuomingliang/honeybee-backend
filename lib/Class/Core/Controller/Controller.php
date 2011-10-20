<?php
abstract Class Controller {
    protected $_PATH_INFO;

    public function __construct() {
        $this->_PATH_INFO = isset($_GET['_PATH_INFO']) ? $_GET['_PATH_INFO'] : '';

        unset($_GET['_PATH_INFO']);
    }

    public function setMessage( $name, $value ) {
        $_SESSION['_MESSAGE']["$name"] = $value;
    }

    public function getMessage( $name ) {
        if (isset($_SESSION['_MESSAGE']["$name"])) {
            $name = $_SESSION['_MESSAGE']["$name"];

            unset($_SESSION['_MESSAGE']["$name"]);

            return $name;
        }

        return '';
    }
}
?>
