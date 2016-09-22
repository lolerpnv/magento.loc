<?php
class Toni_Ticket_Block_Closed extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {
        $this->_blockGroup      = 'ticket';
        $this->_controller      = 'closed';
        $this->_headerText      = $this->__('Closed Tickets');
        //$this->_addButtonLabel  = $this->__('Add Button Label');
        parent::__construct();
        $this->removeButton('add');
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/');
    }

}
