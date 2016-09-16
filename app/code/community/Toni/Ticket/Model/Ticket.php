<?php
class Toni_Ticket_Model_Ticket extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'ticket_ticket';

    protected $_eventObject = 'ticket';


    protected function _construct() {
        $this->_init('ticket/ticket');
    }
    public function getTicketSubject() {
        return $this->getData('subject');
    }
    public function isOpen() {
        return $this->getData('active');
    }
    public function getTicketMessage() {
        return $this->getData('message');
    }
    public function getTimeStamp() {
        return $this->getData('timestamp');
    }
}