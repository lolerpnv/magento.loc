<?php

class Toni_Introduce_Model_Resource_User_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct() {
    $this->_init('introduce/user');
    }

}