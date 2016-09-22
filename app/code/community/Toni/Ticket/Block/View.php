<?php



class Toni_Ticket_Block_View extends Mage_Core_Block_Template
{
    public function __construct(array $args){
        /**
         * Class Toni_Ticket_Block_View
         * @var Toni_Ticket_Model_Ticket $ticket
         */
        parent::__construct($args);
        $this->setTemplate('ticket/view.phtml');
        $entity_id = $this->getRequest()->getParam('entity_id');

        //get said ticket
        $tickets = Mage::getResourceModel('ticket/ticket_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('entity_id', $entity_id)
            ->load()
        ;
        $ticket = $tickets->getItems()[$entity_id];

        //Get Responses
        $responses = Mage::getResourceModel('ticket/response_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('ticket_id',$entity_id)
            ->load()
        ;


        $this->setTicket($ticket);
        $this->setResponses($responses);
    }
    public function getCloseTicketUrl() {
        return $this->getUrl("*/*/close");
    }
    public function getNewResponseUrl() {
        return $this->getUrl("*/*/newresponse");
    }
}