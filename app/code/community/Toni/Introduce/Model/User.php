<?php

class Toni_Introduce_Model_User extends Mage_Core_Model_Abstract
{
    protected $_eventPrefix = 'introduce_user';

    protected $_eventObject = 'user';

    protected function _construct() {
        $this->_init('introduce/user');
    }

}