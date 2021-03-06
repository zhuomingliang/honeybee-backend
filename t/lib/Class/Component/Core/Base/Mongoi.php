<?php

require_once 'Config.php';

class Mongoi {

    public static function getConnection( array $options = array('connect' => TRUE) ) {
        static $mongo_connection = null;
        
        if ($mongo_connection !== null) {
            return $mongo_connection; 
        }
         
        $config = Config::get('MongoDB'); 
        $server = isset($config['server']) ? $config['server'] : 'mongodb://localhost';

        $mongo_connection = new Mongo($server, $options);
        
        return $mongo_connection;
        
    }
}
?>
