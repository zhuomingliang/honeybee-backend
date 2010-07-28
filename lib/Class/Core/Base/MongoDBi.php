<?php
require_once 'Mongoi.php';

class MongoDBi {
      private static $_MongoDBConnections = array();

      public static function connectDB( $db = null ) {
          if ($db === null) {
              if (isset(self::$_MongoDBConnections['_default'])) {
                  return self::$_MongoDBConnections['_default'];
              }
               
              $config = Config::get('MongoDB');

              if (!isset($config['db'])) {
                  throw new Exception('There is no DB config in ini file, do you miss it?');   
              }

              return self::$_MongoDBConnections['_default'] = Mongoi::getConnection()->selectDB($config['db']);
          }

          if (isset(self::$_MongoDBConnections[$db])) {
              return self::$_MongoDBConnections[$db];
          }
              
          return self::$_MongoDBConnections[$db] = Mongoi::getConnection()->selectDB($db);
      }
}
?>
