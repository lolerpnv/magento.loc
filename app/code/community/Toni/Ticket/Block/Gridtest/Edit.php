<?php
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 20/09/16
 * Time: 8.28
 */
class Toni_Ticket_Block_Gridtest_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function _construct()
    {
        // $this->_objectId = 'id';
        parent::_construct();
        $this->_blockGroup      = 'ticket';
        $this->_controller      = 'gridtest';
        $this->_mode            = 'edit';
        $this->_updateButton('save', 'label', $this->_getHelper()->__("Save Response"));

        $this->_addButton('saveandcontinue', array(
            'label'     => $this->_getHelper()->__('Save Response and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
        $this->_addButton('close', array(
            'label'     => Mage::helper('adminhtml')->__('Close Ticket'),
            'class'     => 'delete',
            'onclick'   => 'deleteConfirm(\''
                . Mage::helper('core')->jsQuoteEscape(
                    Mage::helper('adminhtml')->__('Are you sure you want to do this?')
                )
                .'\', \''
                . $this->getCloseUrl()
                . '\')',
        ));
    }
    protected function getCloseUrl() {
        return $this->getUrl('*/*/close',array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }
    protected function _getHelper(){
        return Mage::helper('toni_ticket');
    }

    protected function _getModel(){
        return Mage::registry('AdminTest');
    }

    protected function _getModelTitle(){
        return 'AdminTest';
    }

    public function getHeaderText()
    {
        //Naslov Forme
        /*$model = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        if ($model && $model->getId()) {
           return $this->_getHelper()->__("Edit $modelTitle (ID: {$model->getId()})");
        }
        else {
           return $this->_getHelper()->__("New $modelTitle");
        }*/
    }


    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/index');
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', array($this->_objectId => $this->getRequest()->getParam($this->_objectId)));
    }

    /**
     * Get form save URL
     *
     * @deprecated
     * @see getFormActionUrl()
     * @return string
     */
    public function getSaveUrl()
    {
                $this->setData('form_action_url', 'save');
                return $this->getFormActionUrl();
    }


}
