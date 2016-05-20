<?php
 
$installer = $this;
$connection = $installer->getConnection();
 
$installer->startSetup();

// Get status model
$status = Mage::getModel('sales/order_status');

// Delete some statuses
$status->setStatus('risk_accept')->delete();
$status->setStatus('risk_processing')->delete();
$status->setStatus('risk_accept')->delete();
$status->setStatus('risk_cancel')->delete();
$status->setStatus('risk_ignore')->delete();
$status->setStatus('risk_suspend')->delete();
$status->setStatus('risk_rejectpending')->delete();
$status->setStatus('risk_submitted')->delete();


//Add a new status
$status->setStatus('risk_accept')
       ->setLabel('Fraud Accepted')
       ->assignState(Mage_Sales_Model_Order::STATE_PROCESSING) 
       ->save();

//Add a new status
$status->setStatus('risk_submitted')
       ->setLabel('Order Submitted to Fraud System')
       ->assignState('pending')
       ->save();

//Add a new status
$status->setStatus('risk_processing')
       ->setLabel('Order Under Review for Fraud Detection')
       ->assignState('pending')
       ->save();

//Add a new status
$status->setStatus('risk_cancel')
       ->setLabel('Fraud Cancelled')
       ->assignState(Mage_Sales_Model_Order::STATE_CANCELED)
       ->save();

//Add a new status
$status->setStatus('risk_ignore')
       ->setLabel('Fraud Ignore')
       ->assignState(Mage_Sales_Model_Order::STATE_PROCESSING)
       ->save();

//Add a new status
$status->setStatus('risk_suspend')
       ->setLabel('Fraud Suspend')
       ->assignState(Mage_Sales_Model_Order::STATE_PROCESSING)
       ->save();

//Add a new status
$status->setStatus('risk_rejectpending')
       ->setLabel('Fraud Reject Pending')
       ->assignState(Mage_Sales_Model_Order::STATE_PROCESSING)
       ->save();

$installer->endSetup();
