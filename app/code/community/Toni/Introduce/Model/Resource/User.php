<?php

class Toni_Introduce_Model_Resource_User extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct() {
        $this->_init('introduce/user', 'user_id');
    }

}