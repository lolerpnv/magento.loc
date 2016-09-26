<?php
/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */


$installer = $this;

$installer->startSetup();
    /*
     * Create Responses table
     */

    $table = $installer->getConnection()
        ->newTable($installer->getTable('ticket/response'))
        ->addColumn('response_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity'  => true,
                'unsigned'  => true,
                'nullable'  => false,
                'primary'   => true,), 'Id')
        ->addColumn('ticket_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER
            , null, array(
                'unsigned' => true,
                'nullable' => false))
        ->addForeignkey($installer->getFKName('ticket/response','ticket_id','ticket_ticket','entity_id'),
                'ticket_id',$installer->getTable('ticket/ticket'),'entity_id',
                Varien_Db_Ddl_Table::ACTION_CASCADE,
                Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->addColumn('creator',
            Varien_Db_Ddl_Table::TYPE_VARCHAR,
            null, array(
                'nullable' => false,
            ), 'Response')
        ->addColumn('response',
                Varien_Db_Ddl_Table::TYPE_TEXT,
                null, array(
                'nullable' => false,
                ), 'Response')
        ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
                25, array(
                'nullable' => false,
                'default'=> Varien_Db_Ddl_Table::TIMESTAMP_UPDATE
                ), 'Timestamp');

    $installer->getConnection()->createTable($table);

    /*
     * Create Tickets table
     */
    $table = $installer->getConnection()
        ->newTable($installer->getTable('ticket/ticket'))
        ->addColumn('entity_id',

            Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
                'identity'  => true,
                'unsigned'  => true,
                'nullable'  => false,
                'primary'   => true,), 'Id')
        ->addColumn('user_id',
            Varien_Db_Ddl_Table::TYPE_INTEGER
            , null, array(
                'unsigned' => true,
                'nullable' => false)
        )
        ->addForeignKey($installer->getFkName('ticket/ticket', 'user_id', 'customer_entity', 'entity_id'),
            'user_id', $installer->getTable('customer_entity'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE,
            Varien_Db_Ddl_Table::ACTION_CASCADE)
        ->addColumn('subject', Varien_Db_Ddl_Table::TYPE_VARCHAR,

            255, array(

                'nullable' => false,

            ), 'Subject')
        ->addColumn('message', Varien_Db_Ddl_Table::TYPE_TEXT,

            null, array(

                'nullable' => false,

            ), 'Message')
        ->addColumn('active', Varien_Db_Ddl_Table::TYPE_BOOLEAN,
            null, array(

                'default' => true,
                'nullable' => false,

            ), 'Message')
        ->addColumn('timestamp', Varien_Db_Ddl_Table::TYPE_TIMESTAMP,

            25, array(

                'nullable' => false,

            ), 'Timestamp');

    $installer->getConnection()->createTable($table);



$installer->endSetup();