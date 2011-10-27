<?php
class Log {
    public static function save($e) {
        if (is_object($e)) {
            if ($e->getCode() == 500 ) {
                header('HTTP/1.1 500 Internal Server Error');
                echo $e->getMessage();
                return;
            }

            if(defined('DEBUG')) {
                echo 'Exception Code: ',$e->getCode(), '<br />';
                echo 'Exception Message: ', $e->getMessage(), '<br />';
                echo 'At File ', $e->getFile(), ', Line ', $e->getLine(), '<br />';
                echo 'Trace:<br /><pre>', $e->getTraceAsString(), '</pre><br />';
            }
        } else {
            if(defined('DEBUG')) {
                echo $e, '<br />';
            }
        }
    }
}
?>