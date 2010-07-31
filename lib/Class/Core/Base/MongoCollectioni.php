<?php
require_once 'MongoDBi.php';

abstract class MongoCollectioni {
    protected $_DbName = '_default';

    private static $_Collections = array();
    
    public function __construct() {
        if (isset(self::$_Collections["{$this->_DbName}_{$this->_CollectionName}"])) {
            return;
        }

        self::$_Collections["{$this->_DbName}_{$this->_CollectionName}"] = MongoDBi::connectDB($this->_DbName)->selectCollection($this->_CollectionName);
    }

    public function MapReduce($collection, $map, $reduce, $options = NULL ) {

    }
    
    public function __call( $method, $arguments ){
         return call_user_func_array(array(&self::$_Collections[$this->_CollectionName], $method), $arguments);
    }
}
?>
