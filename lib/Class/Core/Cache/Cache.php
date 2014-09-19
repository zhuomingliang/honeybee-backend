<?php
require HONEYBEE_PATH . 'lib/Class/Core/Cache/APC.php';
require HONEYBEE_PATH . 'lib/Class/Core/Cache/Redis.php';

/**
 * Cache 缓存类
 * @author jimmy
 *
 */
class Cache {
    const APC   = 'APC';
    const Redis = 'Redis';

    /**
     * 对根据参数，对函数的结果进行缓存，一般用于数据库 API 缓存
     *
     * @param const $type 缓存类型，有 Cache::APC 以及 Cache::Redis
     * @param mixed $function 函数，格式为：'function_name', 或者 array(&$instace, 'method_name')
     * @param array $args 函数参数数组
     * @param number $ttl 过期时间，单位：秒
     * @param array $options 额外参数
     * @throws Exception
     * @return mixed 返回执行 $function 返回的结果
     */
    public static function cachedFunction($type, $function, array $args = array(), $ttl = 0, array $options = array()) {
        self::checkType($type);

        $serialized_args = serialize($args);

        $function_key = $function;
        if (is_array($function)) {
            if (isset($function[0]) && is_object($function[0]) && isset($function[1])) {
                $function_key = $function[1];
            } else {
                throw new Exception("非法参数：\$function 必须为函数名，或者是 array(\$class_instance, \$funcion_name) 的格式");
            }
        }

        if (!is_string($function_key)) {
            throw new Exception('非法参数：函数名必须为字符串');
        }

        $cache_instance = new $type();

        if (isset($options['key'])) {
            $cache_instance->setActiveKey($options['key']);
        }

        $cache_key = (is_array($function)
                ? (get_class($function[0]) . '_')
                : '') . $function_key . '_' . crc32($serialized_args);

        $result = $cache_instance->selectDB(11, $options)->fetch($cache_key);

        if (!empty($result)) {
            // $debug = debug_backtrace();
            // echo "<font color=\"red\">Fetched: $cache_key, Called by file name: {$debug[1]['file']}, line: {$debug[1]['line']}</font></br>";
            return unserialize($result);
        }

        $result = call_user_func_array($function, $args);

        $cache_instance->store($cache_key, serialize($result), $ttl);

        if (isset($options['key'])) {
            $cache_instance->setActiveKey();   // 返回默认 Key
        }

        return $result;
    }

    /**
     * 对数据进行缓存
     *
     * @param const $type 缓存类型，有 Cache::APC 以及 Cache::Redis
     * @param string $key 缓存 Key
     * @param string $value 需要缓存的数据
     * @param number $ttl 过期时间，单位：秒
     * @param array $options 额外参数
     * @return mixed 返回是否成功
     */
    public static function store($type, $key, $value, $ttl = 0, array $options = array('db' => 10)) {
        self::checkType($type);

        $cache_instance = new $type();

        if (isset($options['key'])) {
            $cache_instance->setActiveKey($options['key']);
        }

        $result = $cache_instance->selectDB($options['db'], $options)->store($key, $value, $ttl);

        if (isset($options['key'])) {
            $cache_instance->setActiveKey();   // 返回默认 Key
        }

        return $result;
    }

    /**
     *
     * @param const $type  缓存类型，有 Cache::APC 以及 Cache::Redis
     * @param unknown $key 缓存 Key
     * @param array $options 额外参数
     * @return mixed 返回获取的数据
     */
    public static function fetch($type, $key, array $options = array('db' => 10)) {
        self::checkType($type);

        $cache_instance = new $type();

        if (isset($options['key'])) {
            $cache_instance->setActiveKey($options['key']);
        }

        $result = $cache_instance->selectDB($options['db'], $options)->fetch($key);

        if (isset($options['key'])) {
            $cache_instance->setActiveKey();   // 返回默认 Key
        }

        return $result;

    }

    private static function checkType($type) {
        switch ($type) {
            case self::APC:
                break;
            case self::Redis:
                break;
            default:
                throw new Exception('未知的缓存类型');
        }
    }
}

/*
class Foo {
    function test($a, $b) {
        return $a + $b;
    }
}

$foo = new Foo();

$r = Cache::cachedFunction(Cache::Redis, array(&$foo, 'test'), array(1, 6), 5);

// */
?>
