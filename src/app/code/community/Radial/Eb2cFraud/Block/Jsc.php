<?php
/**
 * Copyright (c) 2013-2016 Radial, Inc.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright   Copyright (c) 2013-2016 Radial, Inc. (http://www.radial.com/)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Class Radial_Eb2cFraud_Block_Jsc
 *
 * @method Radial_Eb2cFraud_Block_Jsc setCacheLifetime(int) Seconds to cache this block
 * @method Radial_Eb2cFraud_Block_Jsc setCollectors(array) JavaScript collector files to use
 * @method array getCollectors() If not supplied, will get from jsc.xml
 */
class Radial_Eb2cFraud_Block_Jsc extends Mage_Core_Block_Template
{
    const EB2C_FRAUD_COLLECTOR_PATH = 'default/radial_eb2cfraud/collectors';
    protected $_template = 'radial_eb2cfraud/jsc.phtml';
    /**
     * Upon construction, get a single, random JavaScript collector to add either
     * from an injected set of collectors or via the collectors configured in
     * the jsc.xml config file. Add collector url, JS call and form field
     * to populate to the block.
     */
    protected function _construct()
    {
        parent::_construct();
        // 41st Parameter needs a new random value at every page load.
        $this->setCacheLifetime(0);
        $collectors = $this->getCollectors() ?: json_decode(
            Mage::getConfig()
                ->loadModulesConfiguration('jsc.xml')
                ->getNode(static::EB2C_FRAUD_COLLECTOR_PATH),
            true
        );
        $collector = $collectors[array_rand($collectors)];
        $this->addData([
            'collector_url' => Mage::helper('radial_eb2cfraud/http')->getJscUrl() . '/' . $collector['filename'],
            'call' => sprintf(
                "%s('%s');",
                $collector['function'],
                $collector['formfield']
            ),
            'field' => sprintf(
                '<input type="hidden" name="%1$s" id="%1$s" />',
                $collector['formfield']
            ),
            'mapping_field' => sprintf(
                '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
                Radial_Eb2cFraud_Helper_Http::JSC_FIELD_NAME,
                $collector['formfield']
            ),
            'field_name' => $collector['formfield'],
            'mapping_field_name' => Radial_Eb2cFraud_Helper_Http::JSC_FIELD_NAME
        ]);
    }
}
