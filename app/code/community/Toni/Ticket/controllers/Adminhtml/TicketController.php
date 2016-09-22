<?php

class Toni_Ticket_Adminhtml_TicketController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction() {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('ticket/gridtest'));
        $this->renderLayout();
    }

    public function closedAction() {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('ticket/closed'));
        $this->renderLayout();
    }
    public function viewAction() {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('ticket/viewContainer'));
        $this->renderLayout();
    }
    public function exportCsvAction() {
        $fileName = 'AdminTest_export.csv';
        $content = $this->getLayout()->createBlock('ticket/gridtest_grid')->getCsv();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportExcelAction() {
        $fileName = 'AdminTest_export.xml';
        $content = $this->getLayout()->createBlock('ticket/gridtest_grid')->getExcel();
        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massDeleteAction() {
        $ids = $this->getRequest()->getParam('ids');
        if (!is_array($ids)) {
            $this->_getSession()->addError($this->__('Please select AdminTest(s).'));
        } else {
            try {
                foreach ($ids as $id) {
                    $model = Mage::getSingleton('ticket/ticket')->load($id);
                    $model->delete();
                }

                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) have been deleted.', count($ids))
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('toni_ticket')->__('An error occurred while mass deleting items. Please review log and try again.')
                );
                Mage::logException($e);
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('ticket/ticket');
        $response = Mage::getModel('ticket/response');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->_getSession()->addError(
                    Mage::helper('toni_ticket')->__('This AdminTest no longer exists.')
                );
                $this->_redirect('*/*/');
                return;
            }
            $response = $response->getCollection()
                ->addFieldToSelect('*')
                ->addFieldToFilter('ticket_id',$id)
                ->load();
        }
        else {
            $this->_redirect('*/*/index');
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('AdminTest', $model);
        Mage::register('AdmintestResponses',$response->getData());

        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('ticket/gridtest_edit'));
        $this->renderLayout();
    }

    public function newTicketAction() {

    }

    public function saveAction()
    {
        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($data = $this->getRequest()->getPost()) {

            $id = $this->getRequest()->getParam('ticket_id');
            $model = Mage::getModel('ticket/ticket');
            $response = Mage::getModel('ticket/response');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    $this->_getSession()->addError(
                        Mage::helper('toni_ticket')->__('This AdminTest no longer exists.')
                    );
                    $this->_redirect('*/*/index');
                    return;
                }
            }

            // save response
            try {
                $data['creator'] = 'admin';
                $response->addData($data);
                $this->_getSession()->setFormData($data);
                $response->save();
                $this->_getSession()->setFormData(false);
                $this->_getSession()->addSuccess(
                    Mage::helper('toni_ticket')->__('The AdminTest has been saved.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $redirectBack = true;
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('toni_ticket')->__('Unable to save the AdminTest.'));
                $redirectBack = true;
                Mage::logException($e);
            }

            if ($redirectBack) {
                $this->_redirect('*/*/edit', array('id' => $data['ticket_id']));
                return;
            }
        }
        $this->_redirect('*/*/index');
    }

    public function deleteAction() {
        if ($id = $this->getRequest()->getParam('ticket_id')) {
            try {
                // init model and delete
                $model = Mage::getModel('ticket/ticket');
                $model->load($id);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('toni_ticket')->__('Unable to find a AdminTest to delete.'));
                }
                $model->delete();
                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('toni_ticket')->__('The AdminTest has been deleted.')
                );
                // go to grid
                $this->_redirect('*/*/index');
                return;
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addError(
                    Mage::helper('toni_ticket')->__('An error occurred while deleting AdminTest data. Please review log and try again.')
                );
                Mage::logException($e);
            }
            // redirect to edit form
            $this->_redirect('*/*/edit', array('id' => $id));
            return;
        }
    // display error message
        $this->_getSession()->addError(
            Mage::helper('toni_ticket')->__('Unable to find a AdminTest to delete.')
        );
    // go to grid
        $this->_redirect('*/*/index');
    }
    public function closeAction() {
        $id = $this->_request->getParam('id');
        $ticket = Mage::getModel('ticket/ticket');
        $ticket->load($id);
        $ticket->setData('active',0);
        $ticket->save();
        $this->_getSession()->addSuccess(
            Mage::helper('toni_ticket')->__('The Ticket was succesfully closed.')
        );
        $this->_redirect('*/*/index');
    }
}