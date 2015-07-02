<?php

/**
 * Factory class for instantiating filter models
 *
 * @category Dh
 * @package Dh_EmptyHandles
 * @author Geza Buza <gbuza@sessiondigital.com>
 */
class Dh_EmptyHandles_Model_Handler_Catalogsearch_Result_FilterFactory
{
    /** @var array $_filterModels Attribute to class map used for MySQL fulltext search */
    protected $_filterModels = [
        'category' => 'catalog/layer_filter_category',
        'attribute' => 'catalog/layer_filter_attribute',
        'price' => 'catalog/layer_filter_price',
        'decimal' => 'catalog/layer_filter_decimal',
    ];

    /** @var array $_enterpriseFilterModels Attribute to class map used for Solr search */
    protected $_enterpriseFilterModels = [
        'category' => 'enterprise_search/catalog_layer_filter_category',
        'attribute' => 'enterprise_search/catalog_layer_filter_attribute',
        'price' => 'enterprise_search/catalog_layer_filter_price',
        'decimal' => 'enterprise_search/catalog_layer_filter_decimal',
    ];

    /**
     * Create a filter model for the given attribute
     *
     * @param Mage_Catalog_Model_Resource_Eav_Attribute $attribute
     * @throws RuntimeException Thrown when No filter model is defined for the given attribute
     *
     * @return Mage_Catalog_Model_Layer_Filter_Abstract
     */
    public function create(Mage_Catalog_Model_Resource_Eav_Attribute $attribute)
    {
        $keys = [$attribute->getAttributeCode(), $attribute->getBackendType(), 'attribute'];
        $classMap = $this->_getClassMap();

        foreach ($keys as $key) {
            if (isset($classMap[$key])) {
                return Mage::getModel($classMap[$key]);
            }
        }

        throw new RuntimeException(sprintf('Filter model is not defined for "%s" attribute', $attribute->getName()));
    }

    /**
     * @return array
     */
    protected function _getClassMap()
    {
        $hasEnterpriseSearchModule = Mage::helper('core')->isModuleEnabled('Enterprise_Search');
        return $hasEnterpriseSearchModule && Mage::helper('enterprise_search')->getIsEngineAvailableForNavigation()
            ? $this->_enterpriseFilterModels
            : $this->_filterModels;
    }
}