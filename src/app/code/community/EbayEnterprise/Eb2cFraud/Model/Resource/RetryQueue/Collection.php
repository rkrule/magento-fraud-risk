<?php
/**
 * Created by PhpStorm.
 * User: rkrule
 * Date: 5/24/16
 * Time: 3:23 PM
 */ 
class EbayEnterprise_Eb2cFraud_Model_Resource_RetryQueue_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{

    protected function _construct()
    {
        $this->_init('ebayenterprise_eb2cfraud/retryQueue');
    }

}
