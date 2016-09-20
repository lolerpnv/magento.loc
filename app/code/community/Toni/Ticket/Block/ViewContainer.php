<?php
class Toni_Ticket_Block_ViewContainer extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct(array $args)
    {
        $this->_blockGroup      = 'ticket';
        //$this->_controller      = 'adminhtml';
        $this->_headerText      = $this->__('Open Tickets');
        $this->_addButtonLabel  = $this->__('Add Ticket');
        parent::__construct($args);
    }
}