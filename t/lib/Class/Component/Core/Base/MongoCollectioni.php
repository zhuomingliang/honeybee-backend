<?php
require_once 'MongoDBi.php';

abstract class MongoCollectioni {
    private static $_Collections = array();
    
    public function __construct() {
        if (isset(self::$_Collections[$this->_CollectionName])) {
            return;
        }

        self::$_Collections[$this->_CollectionName] = MongoDBi::connectDB()->selectCollection($this->_CollectionName);
    }

    public static function MapReduce($collection, $map, $reduce, $options = NULL ) {

    }
    
    public function __call( $method, $arguments ){
         return call_user_func_array(array(&self::$_Collections[$this->_CollectionName], $method), $arguments);
    }
}
?>
