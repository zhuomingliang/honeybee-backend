<?php
require_once HONEYBEE_DIR . 'lib/Class/Core/Base/MongoCollectioni.php';

Class Tag extends MongoCollectioni {
    protected $_CollectionName = __CLASS__;

    public function getTags( $limit = 10, $fields = array('name', 'count') ) {
        return parent::find(array(), $fields)->limit($limit);
    }

    public function getHotTags( $limit = 10, $fields = array('name', 'count') ) {
        return $this->getTags($limit, $fields)->sort(array('count' => -1));
    }
}
