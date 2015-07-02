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
		$numResults = $this->_getLayer()->getProductCollection()->getSize();
		if (! $numResults) {
			$this->_addHandle('catalogsearch_result_index_empty');
		}
		return $this;
	}

    /**
     * Load the layer model with navigation layer filters applied on it
     *
     * @return Mage_Catalog_Model_Layer
     */
    protected function _getLayer()
    {
        $layer = Mage::registry('current_layer');
        $factory = $this->_getFilterModelFactory();
        foreach ($layer->getFilterableAttributes() as $attribute) {
            $filterModel = $factory->create($attribute);
            $filterModel
                ->setLayer($layer)
                ->setAttributeModel($attribute)
                ->apply(Mage::app()->getRequest(), null);
        }
        return $layer;
    }

    protected function _getFilterModelFactory()
    {
        return Mage::getModel('emptyhandles/handler_catalogsearch_result_filterFactory');
    }
}