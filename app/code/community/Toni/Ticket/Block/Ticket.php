<?php
class Toni_Ticket_Block_Ticket extends Mage_Core_Block_Template
{
    public function __construct() {

        $tickets = Array();
        try{
            $var = Mage::getResourceModel('ticket/ticket');
            echo $var;
        } catch (Exception $e){
            echo $e;
            die;
        }
        /*$tickets = Mage::getResourceModel('ticket/ticket_collection')
            ->addFieldToSelect('*')
            ->addFieldToFilter('customer_id', Mage::getSingleton('customer/session')->getCustomer()->getId())
            ->addFieldToFilter('state', array('in' => Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates()))
            ->setOrder('created_at', 'desc')
        ;
*/


        $this->setTickets($tickets);
    }
}