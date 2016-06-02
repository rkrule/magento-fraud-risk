<?php
 
$installer = $this;
$connection = $installer->getConnection();
 
$installer->startSetup();

// Create Log Risk Table
$table = $installer->getConnection()
    ->newTable($installer->getTable('radial_eb2cfraud/retryqueue'))
    ->addColumn('retryqueue_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Answer Id')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
                'nullable' => false,
        ), 'Created At')
        ->addColumn('event_name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
    ), 'Event Name')
    ->addColumn('message_content', Varien_Db_Ddl_Table::TYPE_TEXT, 65536, array(
    ), 'Message Content')
    ->addColumn('delivery_status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Delivery Status')
    ->setComment('Risk Service Event Log Details');
$installer->getConnection()->createTable($table);

$installer->endSetup();
