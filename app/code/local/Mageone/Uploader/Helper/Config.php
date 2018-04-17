<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magento.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magento.com for more information.
 *
 * @category    design
 * @package     base_default
 * @copyright   Copyright (c) 2006-2018 Magento, Inc. (http://www.magento.com)
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class Mageone_Uploader_Helper_Config extends Mage_Core_Helper_Abstract
{

    const MAGEONE_UPLOADER_GLOBAL_CONFIG_XML_PATH = 'global/mageone_uploader_config/uploads';

    /** @var array|bool */
    protected $_config = false;

    public function __construct()
    {
        $config = Mage::getConfig()
            ->getNode(self::MAGEONE_UPLOADER_GLOBAL_CONFIG_XML_PATH);

        if(!empty($config)) {
            $this->_config = $config->asCanonicalArray();
        }
    }

    /**
     * Checks if we have any global configuration,
     * that can be used for the file upload
     *
     * @return bool
     */
    public function hasConfig()
    {
        return (false !== $this->_config) ? true : false;
    }

    /**
     * Check if we have uploader config for model
     *
     * @param Mage_Core_Model_Abstract $object
     * @return bool
     */
    public function hasConfigForModel($object)
    {
        $className = get_class($object);
        return isset($this->_config[$className]) ? true : false;
    }

    /**
     * Get the model inputs config from the global configuration
     *
     * @param Mage_Core_Model_Abstract $object
     * @return array
     */
    public function getModelInputsConfigArray(Mage_Core_Model_Abstract $object)
    {
        $className = get_class($object);

        $inputsConfig = array();

        if(isset($this->_config[$className])) {
            foreach($this->_config[$className] as $inputConfig) {
                $inputsConfig[] = Mage::getModel('mageone_uploader/config', $inputConfig);
            }
        }

        return $inputsConfig;
    }

}