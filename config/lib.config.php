<?php
define('ROOT_DIR', dirname(__FILE__) . '/../');

require_once ROOT_DIR . 'lib/Class/Base/Log.php';


set_exception_handler('Log::save');
?>
