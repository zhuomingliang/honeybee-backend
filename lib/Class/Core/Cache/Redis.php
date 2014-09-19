<?php
/**
 * 请用 Cache API，而不是直接调用该类
 * @author jimmy
 *
 */
class Redis {
    static private $connections = array();
    static private $redisInfo   = array();
    static private $activeKey   = 'default';

    private $target             = 'default';

    public function setActiveKey($key = 'default') {
        self::$activeKey = $key;

        return $this;
    }

    public function selectDB($db, array $options = array()) {
        if (!empty($options['target'])) {
            $this->target = $options['target'];
        }

        self::getConnection($this->target);

        phpiredis_command_bs(self::$connections[self::$activeKey][$this->target],
            array(
                'SELECT',
            (string) $db));

        return $this;
    }

    public function store($key, $value, $ttl = 0) {
        if ($ttl == 0) {
            return phpiredis_command_bs(self::$connections[self::$activeKey][$this->target],
                    array('SET', $key, $value));
        } else {
            return phpiredis_multi_command_bs(self::$connections[self::$activeKey][$this->target],
                array(
                     array('SET', $key, $value),
                     array('EXPIRE', $key,(string) $ttl)));
        }
    }

    public function add($key, $value, $ttl = 0) {
        return $this->store($key, $value, $ttl);
    }

    public function fetch($key) {
        return phpiredis_command_bs(self::$connections[self::$activeKey][$this->target],
            array('GET', $key));
    }

    public function delete($key) {
        return phpiredis_command_bs(self::$connections[self::$activeKey][$this->target],
            array('DEL', $key));
    }

    final private static function getConnection($target = 'default', $key = null, array $options = array()) {
        if (empty(self::$redisInfo))
            self::getRedisInfo();

        if (!isset($key)) {
            $key = self::$activeKey;
        }

        if (isset(self::$connections[$key][$target])) {
            return self::$connections[$key][$target];
        }

        if (!isset(self::$redisInfo[$key][$target])) {
            throw new Exception("不存在 \$Caches[\'redis\'][{$key}][{$target}] 配置");
        }

        $redis_info = self::$redisInfo[$key][$target];

        $redis_host = isset($redis_info['host']) ? $redis_info['host'] : '127.0.0.1';
        $reids_port = isset($redis_info['port']) ? $redis_info['port'] : '6379';

        $connection = phpiredis_connect($redis_host, $reids_port);

        if (empty($connection)) {
            throw new Exception("无法连接到 Redis 服务器（Host：{$redis_host}, Port：{$reids_port}）");
        }

        self::$connections[$key][$target] = $connection;
    }

    final private static function getRedisInfo() {
        global $Caches;

        self::$redisInfo = $Caches['redis'];
    }
}
?>