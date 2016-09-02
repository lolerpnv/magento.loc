<?php
/* @var $installer Mage_Core_Model_Resource_Setup */

echo "DONE";

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()

->newTable($installer->getTable('introduce/user'))

->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,

array(

'identity' => true,

'unsigned' => true,

'nullable' => false,

'primary' => true,

), 'Id')

->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,

array(

'nullable' => false,

), 'User first name')

->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_VARCHAR, null,

array(

'nullable' => false,

), 'User last name')

->setComment('Toni_Introduce User Entity');

$installer->getConnection()->createTable($table);

$installer->endSetup();