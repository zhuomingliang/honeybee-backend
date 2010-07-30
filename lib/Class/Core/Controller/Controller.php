<?php
abstract Class Controller {
    protected $_PATH_INFO;

    public function __construct() {
        $this->_PATH_INFO = isset($_GET['_PATH_INFO']) ? $_GET['_PATH_INFO'] : '';

        unset($_GET['_PATH_INFO']);
    }
}
?>