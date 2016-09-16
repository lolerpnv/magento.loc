<?php
class Toni_Ticket_Block_View extends Mage_Core_Block_Template
{
    public function __construct(array $args){
        parent::__construct($args);
        $this->setTemplate('ticket/view.phtml');
        $entity_id = $this->getRequest()->getParam('entity_id');

        $tickets = Mage::getResourceModel('ticket/ticket_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('entity_id', $entity_id)
            ->load()
        ;
        $ticket = $tickets->getItems()[1];

        //Get Responses
        $responses = array();
        //


        $this->setTicket($ticket);
        $this->setResponses($responses);
    }
}