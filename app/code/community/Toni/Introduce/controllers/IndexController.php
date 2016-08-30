<?php
class Toni_Introduce_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $this->loadLayout();

        $block = $this->getLayout()->createBlock('introduce/template');

        //$block->setText("Textual text");



        $this->getLayout()->getBlock('content')->insert($block);



        $this->renderLayout();
    }
    public function testUserSaveAction() {

        $user = Mage::getModel('introduce/user');



        $user->setFirstname('John');

        /* or: $user->setData('firstname', 'John'); */



        $user->setLastname('Doe');

        /* or: $user->setDatata('lastname', 'Doe'); */


        try {

            $user->save();

            echo 'Successfully saved user.';

        } catch (Exception $e) {

            echo $e->getMessage();

            Mage::logException($e);

            /* oror: Mage::log($e->getTraceAsString(), null, 'exception.log',

            true); */

        }

    }
}