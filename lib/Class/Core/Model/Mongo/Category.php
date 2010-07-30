<?php
require_once HONEYBEE_DIR . 'lib/Class/Core/Model/Mongo/MongoCollectioni.php';

class Category extends MongoCollectioni {
    protected $_CollectionName = __CLASS__;


    public function save($category) {
         parent::save($category);
    }
}
?>
