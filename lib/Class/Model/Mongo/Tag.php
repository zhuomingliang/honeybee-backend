<?php
require_once ROOT_DIR . 'lib/Class/Base/MongoCollectioni.php';

Class Tag extends MongoCollectioni {
    protected $_CollectionName = __CLASS__;
    

    public function getHotTags( $limit = 10, $fields = array('name', 'count') ) {
        return parent::find(array(), $fields)->sort(array('count' => -1))->limit($limit);
    }
}
