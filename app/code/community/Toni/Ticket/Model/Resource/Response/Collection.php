<?php

class Toni_Ticket_Model_Resource_Response_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
    public function _construct() {
        $this->_init('ticket/response');
    }
}