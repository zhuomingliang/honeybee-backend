<?php
require_once 'Mongoi.php';

class MongoDBi {
      private static $_MongoDBConnections = array();

      public static function connectDB( $db = '_default' ) {
        if (isset(self::$_MongoDBConnections[$db])) {
            return self::$_MongoDBConnections[$db];
        }
        
        if ($db = '_default') {
            $config = Config::get('MongoDB');
            if (!isset($config['db'])) {
                throw new Exception('There is no DB config in ini file, do you miss it?');
            }
        }

        return self::$_MongoDBConnections[$db] = Mongoi::getConnection()->selectDB($config['db']);
      }
}
?>
