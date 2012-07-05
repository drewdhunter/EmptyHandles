<?php

/**
 * Handles helper
 *
 * @category   Dh
 * @package    Dh_EmptyHandles
 * @author     Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_EmptyHandles_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Paths to module config options
     */
    const XML_PATH_ENABLED = 'design/emptyhandles/enabled';

    /**
     * Check whether the module and module output are enabled in system config
     *
     * @return bool
     */
    public function isEnabled()
    {
        if (! Mage::getStoreConfigFlag(self::XML_PATH_ENABLED)) {
            return false;
        }
        if (! parent::isModuleOutputEnabled($this->_getModuleName())) {
            return false;
        }
        return true;
    }
    
    /**
     * Get the empty handles handler for any given request
     *
     * @param Mage_Core_Controller_Request_Http $request
     * @return string
     */
    public function getHandler(Mage_Core_Controller_Request_Http $request) 
    {
		$requestParts = array(
			$request->getModuleName(),
			$request->getControllerName(),
			$request->getActionName()
		);
		return 'emptyhandles/handler_' . implode('_', $requestParts);
    }
}