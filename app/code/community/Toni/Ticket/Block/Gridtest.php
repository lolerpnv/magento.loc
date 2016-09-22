<?php
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 20/09/16
 * Time: 8.28
 */
class Toni_Ticket_Block_Gridtest extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct()
    {
        $this->_blockGroup      = 'ticket';
        $this->_controller      = 'gridtest';
        $this->_headerText      = $this->__('Open Tickets');
        $this->_addButtonLabel  = $this->__('Add Ticket');
        parent::__construct();
    }
    public function getCreateUrl()
    {
        return $this->getUrl('*/*/newticket');
    }

}

