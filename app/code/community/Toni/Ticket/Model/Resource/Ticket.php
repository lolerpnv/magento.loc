<?php

/**
 * Class Toni_Ticket_Model_Resource_Ticket
 * @var Toni_Ticket_Model_Ticket $ticket
 */
class Toni_Ticket_Model_Resource_Ticket extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('ticket/ticket', 'entity_id');
    }
}