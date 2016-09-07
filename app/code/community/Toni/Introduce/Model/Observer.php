<?php
class Toni_Introduce_Model_Observer
{
    public function updateTimer() {
        Mage::log('ping');
    }
    public function intercept($observer = null) {

        $event = $observer->getEvent();

        $controllerAction = $event->getControllerAction();

        $params = $controllerAction->getRequest()->getParams();

        Mage::log($params);

    }

}