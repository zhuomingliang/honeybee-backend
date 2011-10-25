<?php

abstract class Action {
    protected $data = array();

    function include_template($file_name) {
        include_once APP_DIR . 'Template/' . TEMPLATE_NAME . "/{$file_name}";
    }

    function include_module($file_name) {
        echo "\n<!-- begin module {$file_name} -->\n";
        include_once APP_DIR . 'Template/' . TEMPLATE_NAME . "/inc/{$file_name}";
        echo "\n<!-- end module {$file_name} -->\n";
    }
}

?>