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
class Mageone_Uploader_Model_Config
{

    protected $_inputConfig;

    /**
     * @param array $inputConfig
     * @return Mageone_Uploader_Model_Config
     */
    public function __construct($inputConfig)
    {
        $this->_inputConfig = $inputConfig;
    }

    /**
     * Gets the form input name
     *
     * @return string
     */
    public function getInputName()
    {
        return $this->_inputConfig['input_name'];
    }

    /**
     * Prepares the allowed extension configuration
     * for Varien_File_Uploader
     *
     * @return array
     */
    public function getAllowedExtensions()
    {
        if(isset($this->_inputConfig['allowed_extensions']) && '*' != $this->_inputConfig['allowed_extensions']) {
            return explode(',', $this->_inputConfig['allowed_extensions']);
        }

        return array();
    }

    /**
     * Gets the absolute upload path including the media folder
     *
     * @return string
     */
    public function getAbsoluteUploadPath()
    {
        return Mage::getBaseDir('media') . DS . $this->_inputConfig['upload_dir'];
    }

    /**
     * @return string
     */
    public function getRelativeUploadPath()
    {
        return $this->_inputConfig['upload_dir'];
    }

}