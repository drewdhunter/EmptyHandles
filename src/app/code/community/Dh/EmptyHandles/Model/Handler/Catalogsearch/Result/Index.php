<?php

/**
 * Add layout handle to catalogsearch result index if the results are empty
 *
 * @category   Dh
 * @package    Dh_EmptyHandles
 * @author     Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_EmptyHandles_Model_Handler_Catalogsearch_Result_Index
	extends Dh_EmptyHandles_Model_Handler_Abstract
{
	/**
	 * Execute - If there are no search results in the cart 
	 * then apply a new layout handle: catalogsearch_result_index_empty
	 *
     * @param	Varien_Event $event
	 * @return	Dh_EmptyHandles_Model_Handler_Catalogsearch_Result_Index
     */
	public function execute(Varien_Event $event)
	{
		$helper = Mage::helper('catalogsearch');
		$numResults = (bool)$helper->getEngine()->getResultCollection()->addSearchFilter($helper->getQuery()->getQueryText())->getSize();
		if (! $numResults) {
			$this->_addHandle('catalogsearch_result_index_empty');
		}
		return $this;
	}
}