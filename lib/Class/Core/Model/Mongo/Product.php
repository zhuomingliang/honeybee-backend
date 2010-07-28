<?php
require_once ROOT_DIR . 'lib/Class/Base/MongoCollectioni.php';

class Product extends MongoCollectioni {
    protected $_CollectionName = __CLASS__;

    public function getProductbyId( $id ) {
    
    }

    public function getProductbyPage( $page_count, $page_number  = 1 ) {

    }
}
?>
