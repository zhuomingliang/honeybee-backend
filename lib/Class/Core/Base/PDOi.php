<?php
Class PDOi {
    public static function getConnection( $dsn = '', $username = '', $password = '', $driver_options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'') ) {
        static $pdo_connection = null;

        if ($pdo_connection !== null) {
            return $pdo_connection;
        }

        $config = Config::get('PDO');
        $dsn = isset($config['dsn']) ? $config['dsn'] : $dsn;

        $pdo_connection = new PDO($dsn, $username, $password, $driver_options);

        return $pdo_connection;
    }
}

?>
