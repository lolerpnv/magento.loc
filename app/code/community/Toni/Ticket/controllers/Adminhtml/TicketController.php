<?php

class Toni_Ticket_Adminhtml_TicketController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction() {
        echo 123;
    }

    protected function _validateSecretKey() {
        return true;
    }

}