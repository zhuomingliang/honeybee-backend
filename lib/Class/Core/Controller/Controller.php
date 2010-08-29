<?php
abstract Class Controller {
    protected $_PATH_INFO;

    public function __construct() {
        $this->_PATH_INFO = isset($_GET['_PATH_INFO']) ? $_GET['_PATH_INFO'] : '';

        unset($_GET['_PATH_INFO']);
    }

    public function setFlash( $name, $value ) {
        $_SESSION['_FLASH']["$name"] = $value;
    }

    public function getFlash( $name ) {
        if (isset($_SESSION['_FLASH']["$name"])) {
            $name = $_SESSION['_FLASH']["$name"];

            unset($_SESSION['_FLASH']["$name"]);

            return $name;
        }

        return '';
    }
}
?>
