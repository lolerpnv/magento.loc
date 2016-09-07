<?php

class Toni_Logger_Adminhtml_Toni_LoggerController

    extends Mage_Adminhtml_Controller_Action

{

    public function indexAction()

    {

        $this->loadLayout()->_setActiveMenu('system/tools/toni_logger');

        $this->_addContent($this->getLayout()->createBlock('toni_logger/adminhtml_edit'));

        $this->renderLayout();

}



    public function gridAction()

    {

        $this->getResponse()->setBody(

            $this->getLayout()->createBlock(

            'toni_logger/adminhtml_edit_grid')->toHtml()

);

}

}