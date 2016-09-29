<?php
class Toni_Ticket_Model_Ticket extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'ticket_ticket';

    protected $_eventObject = 'ticket';
    protected $responses ;


    protected function _construct() {
        $this->_init('ticket/ticket');
    }
    public function _getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
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
    public function setTimeStamp($time) {
        $this->setData('timestamp',$time);
    }
    public function _beforeSave()
    {
        if(!$this->getTimeStamp()) {
            $timestamp = date('Y-m-d H:i:s');
            $this->setTimeStamp($timestamp);
        }
        return parent::_beforeSave(); // TODO: Change the autogenerated stub
    }

    public function getResponses()
    {
        if(!$this->getId()) {
            return;
        }else {
            $this->responses = Mage::getModel('ticket/response')->getCollection()
                                ->addFieldToSelect('*')
                                ->addFieldToFilter('ticket_id', $this->getId());
        }
        return $this->responses->load();
    }


}