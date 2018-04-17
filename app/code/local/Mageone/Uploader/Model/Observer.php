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
 
class Mageone_Uploader_Model_Observer
{

    /**
     * Event handler of "model_save_before" event
     *
     * @param Varien_Event_Observer $observer
     * @return Mageone_Uploader_Model_Observer
     */
    public function processUploads(Varien_Event_Observer $observer)
    {
        $object = $observer->getEvent()->getData('object');

        /** @var Mageone_Uploader_Helper_Uploader $validatorHelper */
        $uploaderHelper = Mage::helper('mageone_uploader/uploader');

        if($uploaderHelper->canUpload($object)) {
            $uploaderHelper->processFiles($object);
        }

        return $this;
    }

}