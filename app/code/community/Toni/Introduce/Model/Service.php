<?php
class Toni_Introduce_Model_Service
{
    public function ping() {
        Mage::log('ping', null, 'ping.log', true);
    }
}