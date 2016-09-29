<?php
/**
 * Class Toni_Ticket_Block_View
 * @var Toni_Ticket_Model_Ticket $ticket
 */
class Toni_Ticket_Block_View extends Mage_Core_Block_Template
{
    public function __construct(array $args){
        parent::__construct($args);
        $entity_id = $this->getRequest()->getParam('entity_id');
        $this->setTicketId($entity_id);
    }
    public function prepTicket() {
        return Mage::getModel('ticket/ticket')->load($this->getTicketId());
    }
    public function getResponses() {
        return $this->prepTicket()->getResponses();
    }
    public function getCloseTicketUrl() {
        return $this->getUrl("*/*/close");
    }
    public function getNewResponseUrl() {
        return $this->getUrl("*/*/newresponse");
    }
}