<?php

/**
 * @var Toni_Ticket_Model_Ticket $ticket
 * @var Toni_Ticket_Model_Resource_Ticket_Collection $tickets
 */
class Toni_Ticket_Block_Ticket extends Mage_Core_Block_Template
{
    public function __construct() {
        $tickets = Mage::getResourceModel('ticket/ticket_collection')
                    ->addFieldToSelect('*')
                    ->addFieldToFilter('user_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
                    ->addFieldToFilter('active',1)
                    ->load()
        ;

        /*$tickets = Mage::getResourceModel('ticket/ticket_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
            ->addFieldToFilter('state', array('in' => Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates()))
            ->setOrder('created_at', 'desc')
        ;
*/
        $this->setTickets($tickets);
    }
    public function getTicketViewUrl($ticket) {
        return $this->getUrl("*/*/view",array('entity_id' => $ticket->getEntityId()));
    }
    public function getNewTicketUrl() {
        return $this->getUrl("*/*/newticket");
    }
    public function getPostNewTicketUrl() {
        return $this->getUrl("*/*/postnew");
    }
}