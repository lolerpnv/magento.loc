<?php
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 20/09/16
 * Time: 8.28
 */
class Toni_Ticket_Block_Gridtest_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _getModel(){
        return Mage::registry('AdminTest');
    }

    protected function _getHelper(){
        return Mage::helper('toni_ticket');
    }

    protected function _getModelTitle(){
        return 'AdminTest';
    }

    protected function _prepareForm()
    {
        $model  = $this->_getModel();
        $modelTitle = $this->_getModelTitle();
        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->_getHelper()->__("$modelTitle Information"),
            'class'     => 'fieldset-wide',
        ));

        if ($model && $model->getId()) {
            $modelPk = $model->getResource()->getIdFieldName();
            $fieldset->addField($modelPk, 'hidden', array(
                'name' => $modelPk,
            ));
        }

        $fieldset->addField('name', 'textarea' /* select | multiselect | hidden | password | ...  */, array(
            'name'      => 'name',
            'label'     => $this->_getHelper()->__('Response'),
            'title'     => $this->_getHelper()->__('Here you add response to user'),
            'required'  => true,
            'options'   => array( OPTION_VALUE => OPTION_TEXT, ),                 // used when type = "select"
            'values'    => array(array('label' => LABEL, 'value' => VALUE), ),    // used when type = "multiselect"
           'style'     => 'css rules',
            'class'     => 'css classes',
       ));
          // custom renderer (optional)
          //$renderer = $this->getLayout()->createBlock('Block implementing Varien_Data_Form_Element_Renderer_Interface');
          //$field->setRenderer($renderer);

      // New Form type element (extends Varien_Data_Form_Element_Abstract)
        $fieldset->addType('custom_element','MyCompany_MyModule_Block_Form_Element_Custom');  // you can use "custom_element" as the type now in ::addField([name], [HERE], ...)


        if($model){
            $form->setValues($model->getData());
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
