<?php
require HONEYBEE_DIR . 'lib/Class/Core/Base/Registry.php';

abstract class Action {
    protected $data = array();
    protected $form;
    protected $get;
    protected $cookie;

    public function __construct() {
        $this->get = new Registry();
        $this->cookie = new Registry();
        $this->form = new Registry();

        foreach ($_GET as $key => $value) {
            $this->get->$key = trim($value);
        }

        foreach ($_POST as $key =>$value) {
            $this->form->$key = check_plain($value);
        }

        foreach ($_COOKIE as $key => $value) {
            $this->cookie->$key = $value;
        }
    }

    public function __get($key) {
        if(isset(self::$_REQUEST[$key])) return self::$_REQUEST[$key];
        return null;
    }

    public function include_template($file_name) {
        include_once APP_DIR . 'Template/' . TEMPLATE_NAME . "/{$file_name}";
    }

    public function include_module($file_name) {
        echo "\n<!-- begin module {$file_name} -->\n";
        include_once APP_DIR . 'Template/' . TEMPLATE_NAME . "/inc/{$file_name}";
        echo "\n<!-- end module {$file_name} -->\n";
    }

    public function show() {

    }

    public function setMessage( $name, $value ) {
        $_SESSION['_MESSAGE_']["$name"] = $value;
    }

    public function getMessage( $name ) {
        if (isset($_SESSION['_MESSAGE_']["$name"])) {
            $name = $_SESSION['_MESSAGE_']["$name"];

            unset($_SESSION['_MESSAGE_']["$name"]);

            return $name;
        }

        return '';
    }
}

?>