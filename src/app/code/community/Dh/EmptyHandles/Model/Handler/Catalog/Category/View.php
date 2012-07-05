<?php

/**
 * Add layout handle to catalog category view if the product collection 
 * is empty
 *
 * @category   Dh
 * @package    Dh_EmptyHandles
 * @author     Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_EmptyHandles_Model_handler_Catalog_Category_View
	extends Dh_EmptyHandles_Model_Handler_Abstract
{
    /**
     *     
     * Execute - If there are no products in the current category
     * then apply a new layout handle: catalog_category_view_empty
     *
     * @param	Varien_Event $event
     * @return	Dh_EmptyHandles_Model_Handler_Catalogsearch_Result_Index
     */
	public function execute(Varien_Event $event)
	{
		$numProducts = (bool)Mage::helper('catalog')->getCategory()->getProductCollection()->count();
		if (! $numProducts) {
			$this->_addHandle('catalog_category_view_empty');
		}
		return $this;
	}
}