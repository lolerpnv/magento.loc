<?php
/**
 * Created by PhpStorm.
 * User: toni
 * Date: 20/09/16
 * Time: 8.28
 */
class Toni_Ticket_Block_Gridtest_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct()
    {
        parent::__construct();
        $this->setId('openGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }
    protected function _getModel(){
        return Mage::registry('AdminTest');
    }
    protected function _prepareCollection()
    {
        $model = $this->_getModel();
        if(!isset($model) && !isset($model->getId)) {
            $collection = Mage::getModel('ticket/ticket')->getCollection()->addFieldToFilter('active',1);
            $this->setCollection($collection);
        } else {
            $this->setCollection($model->getCollection()->addFieldToSelect('*')->addFieldToFilter('entity_id',$model->getId()));
        }

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('ticket_id',
            array(
                'header'=> $this->__('Ticket_Id'),
                'width' => '5px',
                'index' => 'entity_id'
            )
        );
        $this->addColumn('subject',
            array(
                'header'=> $this->__('Subject'),
                'width' => '100px',
                'index' => 'subject'
            )
        );
        $this->addColumn('message',
            array(
                'header'=> $this->__('Message'),
                'width' => '100px',
                'index' => 'message'
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
