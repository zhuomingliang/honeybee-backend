<?php

class Config {
    private static $_config = null;


    private static function _construct( $config_name = 'default' ) {
        if (self::$_config !== null) {
            return;
        }

        self::$_config = apc_fetch($config_name);

        if (self::$_config === false) {
            $config_file = HONEYBEE_DIR . '/config/' . $config_name . '.ini';

            if (is_file($config_file)) {
                self::$_config = parse_ini_file($config_file, true );

                $apc_ttl = isset(self::$_config['APC']['ttl']) ? self::$_config['APC']['ttl'] : 3600;

                if (!apc_store($config_name, self::$_config, $apc_ttl)) {
                    throw new Exception('apc store failed, it makes your site more slow, why I can\'t stort things into apc?');
                }
            } else {
                throw new Exception('config ini file doesn\'t exist, where is it?');
            }
        }
    }

    public static function get( $block = null , $config_name = 'default' ) {
        self::_construct($config_name);

        if ($block === null) {
            return self::$_config;
        }

        if (isset(self::$_config[$block])) {
            return self::$_config[$block];
        }

        return array();
    }
}
?>
