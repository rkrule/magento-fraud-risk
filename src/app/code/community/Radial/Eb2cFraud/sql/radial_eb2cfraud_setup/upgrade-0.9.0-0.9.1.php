<?php
 
$installer = $this;
$connection = $installer->getConnection();
 
$installer->startSetup();
 
// Required tables
$statusTable = $installer->getTable('sales/order_status');
$statusStateTable = $installer->getTable('sales/order_status_state');
 
// Insert statuses
$installer->getConnection()->insertArray(
    $statusTable,
    array(
        'status',
        'label'
    ),
    array(
        array('status' => 'risk_processing', 'label' => 'Order Under Review for Fraud Detection'),
        array('status' => 'risk_accept', 'label' => 'Fraud Accepted'),
        array('status' => 'risk_cancel', 'label' => 'Fraud Canceled'),
        array('status' => 'risk_ignore', 'label' => 'Fraud Ignore'),
	array('status' => 'risk_suspend', 'label' => 'Fraud Suspend'),
	array('status' => 'risk_rejectpending', 'label' => 'Fraud Reject Pending')
    )
);
 
// Insert states and mapping of statuses to states
$installer->getConnection()->insertArray(
    $statusStateTable,
    array(
        'status',
        'state',
        'is_default'
    ),
    array(
        array(
            'status' => 'risk_processing',
            'state' => 'payment_review',
            'is_default' => 1
        ),
        array(
            'status' => 'risk_accept',
            'state' => 'processing',
            'is_default' => 0
        ),
        array(
            'status' => 'risk_cancel',
            'state' => 'canceled',
            'is_default' => 0
        ),
        array(
            'status' => 'risk_ignore',
            'state' => 'holded',
            'is_default' => 0
        ),
	array(
            'status' => 'risk_suspend',
            'state' => 'holded',
            'is_default' => 0
        ),
	array(
            'status' => 'risk_rejectpending',
            'state' => 'holded',
            'is_default' => 0
        )
    )
);
 
$installer->endSetup();
