<?php
class Toni_Ticket_Model_Response extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'ticket_response';

    protected $_eventObject = 'response';


    protected function _construct() {
        $this->_init('ticket/response');
    }
    public function getTicketId() {
        return $this->getData('response_id');
    }
    public function getMessage() {
        return $this->getData('response');
    }
    public function getCreator() {
        return $this->getData('creator');
    }
    public function getCreatedAt() {
        //return $this->getData('entity_id');
    }
    public function getUpdatedAt() {
        //return $this->getData('entity_id');
    }
}