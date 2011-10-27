<?php

class Registry {
    private $_data = array();

    function __set($key, $value) {
        $this->_data[$key] = $value;
    }

    function __get($key) {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }
}

?>