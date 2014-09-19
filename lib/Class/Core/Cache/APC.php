<?php
/**
 * 请用 Cache API，而不是直接调用该类
 * @author jimmy
 *
 */
class APC {
    public function setActiveKey($key = 'default') {
        return $this;
    }

    public function selectDB($db = 0, array $options = array()) {
        return $this;
    }

    public function fetch($key) {
        return apc_fetch($key);
    }

    public function exists($key) {
        return apc_exists($key);
    }

    public function add($key, $var, $ttl = 0) {
        return apc_add($key, $var, $ttl);
    }

    public function store($key, $var, $ttl = 0) {
        return apc_store($key, $var, $ttl);
    }

    public function delete($key) {
        return apc_delete($key);
    }
}

?>