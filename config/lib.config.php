<?php
define('HONEYBEE_DIR', dirname(__FILE__) . '/../');

require HONEYBEE_DIR . 'lib/Class/Core/Base/autoloader.php';
require HONEYBEE_DIR . 'include/database/database.inc';
require HONEYBEE_DIR . 'lib/Class/Core/Action/Action.php';
require HONEYBEE_DIR . 'lib/Class/Core/Controller/AppController.php';

autoloader::init();
?>
