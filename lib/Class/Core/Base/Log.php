<?php
class Log {
    public static function save($e) {
        //header('HTTP/1.1 500 Internal Server Error');

        if (is_object($e)) {
            echo 'Exception Code: ',$e->getCode(), '<br />';
            echo 'Exception Message: ', $e->getMessage(), '<br />';
            echo 'At File ', $e->getFile(), ', Line ', $e->getLine(), '<br />';
            echo 'Trace:<br /><pre>', $e->getTraceAsString(), '</pre><br />';
        } else {
            echo $e, '<br />';
        }

    }
}
?>