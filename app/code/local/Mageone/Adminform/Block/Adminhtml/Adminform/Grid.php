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
 * Adminhtml cms blocks grid
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mageone_Adminform_Block_Adminhtml_Adminform_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('adminformGrid');
        $this->setDefaultSort('adminform_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('adminform/adminform')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('adminform_title', array(
            'header'    => Mage::helper('adminform')->__('Title'),
            'align'     => 'left',
            'index'     => 'adminform_title',
        ));

        $this->addColumn('adminform_file', array(
            'header'    => Mage::helper('adminform')->__('Image'),
            'align'     => 'left',
            'index'     => 'adminform_file',
			'frame_callback' => array($this, 'callback_image')

        ));
		
		$this->addColumn('adminform_description', array(
            'header'    => Mage::helper('adminform')->__('Description'),
            'align'     => 'left',
            'index'     => 'adminform_description'
        ));
		
		
        if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('adminform')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }

        $this->addColumn('is_active', array(
            'header'    => Mage::helper('adminform')->__('Status'),
            'index'     => 'is_active',
            'type'      => 'options',
            'options'   => array(
                0 => Mage::helper('adminform')->__('Disabled'),
                1 => Mage::helper('adminform')->__('Enabled')
            ),
        ));
		
		$this->addColumn('action_edit', array(
			'header'   => $this->helper('adminform')->__('Action'),
			'width'    => 15,
			'sortable' => false,
			'filter'   => false,
			'type'     => 'action',
			'index' => 'stores',
			'is_system' => true,
			'getter' => 'getAdminformId',
			'actions'  => array(
				array(
					'caption' => $this->helper('adminform')->__('Edit'),
					'url'     => array('base'=> '*/*/edit'),
					'field' => 'adminform_id',
				),
			)
		));

        

        return parent::_prepareColumns();
    }

	public function callback_image($value)
	{
		$width = 70;
		$height = 70;
		return "<img src='".Mage::getBaseUrl('media').$value."' width=".$width." height=".$height."/>";
	}
	
    
    protected function _filterStoreCondition($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }
	
	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('adminform_id');
		$this->getMassactionBlock()->setFormFieldName('adminform_id');

		$this->getMassactionBlock()->addItem('delete', array(
			 'label'    => Mage::helper('adminform')->__('Delete'),
			 'url'      => $this->getUrl('*/*/massDelete'),
			 'confirm'  => Mage::helper('adminform')->__('Are you sure?')
		));

		return $this;
	}


    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('adminform_id' => $row->getId()));
    }

}
