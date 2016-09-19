<?php

class Toni_Ticket_Model_Resource_Response extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('ticket/response', 'response_id');

    }

}