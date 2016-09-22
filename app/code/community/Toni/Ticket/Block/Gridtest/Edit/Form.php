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
    protected function _getResponses() {
        return Mage::registry('AdmintestResponses');
    }
    protected function _prepareForm()
    {
        /**
         * @var Toni_Ticket_Model_Response $response
         * @var Toni_Ticket_Model_Ticket $model
         */
        $model  = $this->_getModel();
        $responses = $this->_getResponses();
        $modelTitle = $this->_getModelTitle();

        $form   = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post'
        ));

        $fieldset   = $form->addFieldset('base_fieldset', array(
            'legend'    => $this->_getHelper()->__("Ticket Indormation"),
            'class'     => 'fieldset-wide',
        ));

        $fieldset->addField('hidden_id','hidden',array(
            'name' => 'ticket_id',
            'value' => $model->getId()
        ));

        $fieldset->addField('entity_id','note',array(
            'name' => 'entity_id',
            'label' => Mage::helper('toni_ticket')->__('Ticket ID'),
            'text' => $model->getId()
         ));
        $fieldset->addField('subject','note',array(
            'name' => 'subject',
            'label' => 'Subject',
            'text' => $model->getTicketSubject()
        ));
        $fieldset->addField('message','note',array(
            'name' => 'message',
            'text' => nl2br($model->getTicketMessage()),
            'label' => 'Message'
        ));

        /**
         * @var array() $response
         */
        $fieldset->addField('label', 'label', array(
            'label' => Mage::helper('toni_ticket')->__('Conversation')
        ));
        foreach($responses as $response){
            $fieldset->addField($response['response_id'], 'note', array(
                'text'     => $response['creator'].':<br/>'.$response['response'].'<br/><br/>'
            ));
        }

        $fieldset->addField('id', 'textarea' , array(
            'name'      => 'response',
            'label'     => $this->_getHelper()->__('Response'),
            'title'     => $this->_getHelper()->__('Here you add response to user'),
            'required'  => true,
            'options'   => array( OPTION_VALUE => OPTION_TEXT, ),                 // used when type = "select"
            'values'    => array(array('label' => LABEL, 'value' => VALUE), ),    // used when type = "multiselect"
            'style'     => 'css rules',
            'class'     => 'css classes',
        ));
        /*if($model){
            $form->setValues($model->getData());
        }*/
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
