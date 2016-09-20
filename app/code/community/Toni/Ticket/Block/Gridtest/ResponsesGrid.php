<?php
class Toni_Ticket_Block_Gridtest_ResponsesGrid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId('responsesGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    protected function _getModel(){
        return Mage::registry('AdminTest');
    }
    protected function _prepareCollection()
    {
        $id = $this->_getModel()->getId();
        if(isset($id)) {
            $collection = Mage::getModel('ticket/response')->getCollection()->addFieldToFilter('ticket_id',$id);
            $this->setCollection($collection);
        }

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('ticket_id',
            array(
                'header'=> $this->__('Response_Id'),
                'width' => '5px',
                'index' => 'response_id'
            )
        );
        $this->addColumn('creator',
            array(
                'header'=> $this->__('Creator'),
                'width' => '100px',
                'index' => 'creator'
            )
        );
        $this->addColumn('response',
            array(
                'header'=> $this->__('Response'),
                'width' => '100px',
                'index' => 'response'
            )
        );

        $this->addExportType('*/*/exportCsv', $this->__('CSV'));

        $this->addExportType('*/*/exportExcel', $this->__('Excel XML'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $modelPk = Mage::getModel('ticket/ticket')->getResource()->getIdFieldName();
        $this->setMassactionIdField($modelPk);
        $this->getMassactionBlock()->setFormFieldName('ids');
        // $this->getMassactionBlock()->setUseSelectAll(false);
        $this->getMassactionBlock()->addItem('delete', array(
            'label'=> $this->__('Delete'),
            'url'  => $this->getUrl('*/*/massDelete'),
        ));
        return $this;
    }
}