<?php
class Log {
    public static function save($e) {
        
        header('HTTP/1.1 500 Internal Server Error');

        if (is_object($e)) {
            echo $e->getCode(), "\n";
            echo $e->getMessage(), "\n";
            echo $e->getFile(), "\n";
            echo $e->getLine(), "\n";
            echo $e->getTraceAsString(), "\n";
        } else {
            echo $e, "\n";
        }

    }
}
?>
