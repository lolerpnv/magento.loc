<?php
class Toni_Ticket_TicketController extends Mage_Core_Controller_Front_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
        $action = $this->getRequest()->getActionName();
        $loginUrl = Mage::helper('customer')->getLoginUrl();

        if (!Mage::getSingleton('customer/session')->authenticate($this, $loginUrl)) {
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
        }
    }

    /**
     * Checks whether that user has access to current ticket
     * @return int
     */
    protected function checkAccess() {
        $id = $this->_request->getParam('entity_id');
        $ticket = Mage::getModel('ticket/ticket')->load($id);
        if($ticket->getData('entity_id') === null) {
            $this->_redirect('*/*/ticket');
        } if ($ticket->getData('user_id') != Mage::getModel('customer/session')->getCustomerId()) {
            $this->_redirect('*/*/ticket');
        }
        return 1;
    }

    /**
     * View Ticket list
     */
    public function ticketAction() {
        $this->_initLayout();
    }

    /**
     * View for Ticket
     */
    public function viewAction() {
        if($this->checkAccess())
            $this->_initLayout();
    }
    /**
     * Post new  ticket
     */
    public function postnewAction() {
        //Save
        $data = array(
            'user_id'=>Mage::getSingleton('customer/session')->getCustomer()->getId(),
            'subject'=>$this->_request->getParam('subject'),
            'message'=>$this->_request->getParam('message'),
            'active'=>1
        );


        $ticket = Mage::getModel('ticket/ticket');
        $ticket->setData($data);
        try{
            $ticket->save();
        } catch (Exception $e) {
            Mage::log($e->getMessage());
        }

        //Send Email confirmation
        $this->sendmail();

        //Redirect
        Mage::getSingleton('customer/session')->addSuccess(Mage::helper('contacts')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'));
        $this->_redirect('*/*/ticket');
    }
    /**
     * Sends Ticket confirmation email
     */
    public function sendmail() {

        $customer = Mage::getSingleton('customer/session')->getCustomer();

        /**Prep Email template
         *
         * @var Mage_Core_Model_Email_Queue $emailQueue
         * @var Mage_Core_Model_Email_Template $emailTemplate
         */
        $emailTemplate  = Mage::getModel('core/email_template')->load(1);
        $emailTemplate->setSenderName('lolerpnv@gmail.com');
        $emailTemplate->setSenderEmail('lolerpnv@gmail.com');
        $emailTemplate->setTemplateSubject('Ticket Confirmation');


        /**
         * Set Custim vars
         **/
        $this->setCustimVar('company','ZeenCoo');
        $this->setCustimVar('name',$customer->getName());


        /**     Prep queue
         *
         * @var $emailQueue Mage_Core_Model_Email_Queue
         * @var $customer Mage_Customer_Model_Customer
         */
        $emailQueue = Mage::getModel('core/email_queue');
        $emailQueue->setEntityId($customer->getEntityId())
            ->setEntityType($customer->getEntityType())
            ->setEventType('new ticket');
        /**
         * Add to queue
         */
        $emailTemplate->setQueue($emailQueue)->send($customer->getEmail());
    }
    /**
     * Sets html value of custim var
     */
    public function setCustimVar($code,$value) {
        $code = $code;
        $variable = Mage::getModel('core/variable')->loadByCode($code);
        $variable->setHtmlValue($value)
            ->save();
    }

    /**
     * Close Ticket Action
     */
    public function closeAction() {
        if(!$this->checkAccess()) {
            $this->_redirect('*/*/ticket');
            return;
        }
        //Close
        /**
         * @var Toni_Ticket_Model_Resource_Ticket_Collection $tickets
         * @var Toni_Ticket_Model_Ticket $ticket
         */
        $Id = $this->_request->getParam('entity_id');
        $tickets = Mage::getModel('ticket/ticket')->getCollection();
        $ticket = $tickets->load($Id);
        $ticket->setData(array(
            'active'=>0
        ));
        try {
            $ticket->setId($Id)->save();
        } catch (Exception $e){
            echo "Failed to close ticket";
            return;
        }

        $this->_redirect('*/*/ticket');

    }
    public function newresponseAction() {
        $this->checkAccess();
        //save
        $response = Mage::getModel("ticket/response");
        $response->setData(array(
            'creator'=>'user',
            'ticket_id'=>$this->_request->getParam('entity_id'),
            'response'=>$this->_request->getParam('response')
        ));
        try{
            $response->save();
        }catch (Exception $e) {
            Mage::log($e->getMessage());
        }
        $this->_redirect("*/*/view/",array('entity_id'=>$this->_request->getParam('entity_id')));
    }
    public function _initLayout() {
        $this->loadLayout();
        $this->_initLayoutMessages('catalog/session');

        $this->getLayout()->getBlock('head')->setTitle($this->__('My Tickets'));

        if ($block = $this->getLayout()->getBlock('customer.account.link.back')) {
            $block->setRefererUrl($this->_getRefererUrl());
        }
        $this->renderLayout();
    }
}