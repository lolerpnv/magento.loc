<?php
class Toni_Introduce_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $this->loadLayout();

        //$block = $this->getLayout()->createBlock('introduce/template');

        //$this->getLayout()->getBlock('content')->insert($block);

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
    public function test1Action()
    {
        //Mage::log("123", null, "toni.log", true);

        $user=Mage::getModel("introduce/user");

        $collection = $user->getCollection();
        $collection
            ->addFieldToFilter("firstname", array("in" => array("Pero", "lol")));


        foreach ($collection as $item){
            var_dump($item);
        }

        var_dump($collection);
    }
    public function setHelperAction() {

        $data = Mage::helper('introduce');
        $data->da = "da";
        var_dump($data);
    }
}