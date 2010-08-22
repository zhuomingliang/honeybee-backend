<?php
Class PDOi {
    public static function getConnection( $dsn = '', $username = '', $password = '', $driver_options = array() ) {
        static $pdo_connection = null;

        if ($pdo_connection !== null) {
            return $pdo_connection;
        }

        $config = Config::get('PDO');

        if ($dsn === '') {
            $dsn = isset($config['dsn']) ? $config['dsn'] : 'mysql:host=localhost';
        }

        if ($username === '') {
            $username = isset($config['username']) ? $config['username'] : 'root';
        }

        if ($password === '') {
            $password = isset($config['password']) ? $config['password'] : '';
        }

        if (!isset($driver_options[PDO::MYSQL_ATTR_INIT_COMMAND])) {
            $charset = isset($config['charset']) ? $config['charset'] : 'UTF8';

            $driver_options[PDO::MYSQL_ATTR_INIT_COMMAND] = "SET NAMES '{$charset}'";
        }

        return $pdo_connection = new PDO($dsn, $username, $password, $driver_options);
    }
}

?>
