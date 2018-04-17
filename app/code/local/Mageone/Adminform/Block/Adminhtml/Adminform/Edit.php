<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * CMS block edit form container
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mageone_Adminform_Block_Adminhtml_Adminform_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'adminform_id';
        $this->_controller = 'adminhtml_adminform';
		$this->_blockGroup = 'adminform';
		
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('adminform')->__('Save Details'));
        $this->_updateButton('delete', 'label', Mage::helper('adminform')->__('Delete Details'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminform')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('adminform_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'adminform_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'adminform_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Get edit form container header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        if (Mage::registry('adminform')->getId()) {
            return Mage::helper('adminform')->__("Edit Adminform '%s'", $this->escapeHtml(Mage::registry('adminform')->getAdminformTitle()));
        }
        else {
            return Mage::helper('adminform')->__('New Adminform');
        }
    }
	
	public function getSaveUrl()
    {
        return $this->getUrl('*/adminform/save');
    }

}
