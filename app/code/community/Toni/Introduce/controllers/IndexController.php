<?php
class Toni_Introduce_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction() {
        $this->loadLayout();

        $block = $this->getLayout()->createBlock('introduce/index');

        $block->setText("Textual text");



        $this->getLayout()->getBlock('content')->insert($block);



        $this->renderLayout();
    }
}