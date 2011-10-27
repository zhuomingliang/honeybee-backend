<?php
define('HONEYBEE_DIR', dirname(__FILE__) . '/../');

require HONEYBEE_DIR . 'include/database/database.inc';
require HONEYBEE_DIR . 'lib/Class/Core/Base/autoloader.php';
require HONEYBEE_DIR . 'lib/Class/Core/Controller/Controller.php';
require HONEYBEE_DIR . 'lib/Class/Core/Controller/AppController.php';
require HONEYBEE_DIR . 'lib/Class/Core/Action/Action.php';

mb_internal_encoding('utf-8');
mb_language('uni');
autoloader::init();
?>
