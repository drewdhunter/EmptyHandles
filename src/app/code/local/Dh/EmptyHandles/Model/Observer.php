<?php

/**
 * Handles Observer
 *
 * @category   Dh
 * @package    Dh_EmptyHandles
 * @author     Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_EmptyHandles_Model_Observer extends Varien_Object
{
    /**
     * Observes controller_action_layout_load_before
     *
	 * @param	Varien_Event $observer
     * @return	Dh_EmptyHandles_Model_Observer
     */
	public function controllerActionLayoutLoadBefore(Varien_Event_Observer $observer)
	{
        if (Mage::helper('emptyhandles')->isEnabled()) {
            $request = $observer->getEvent()->getAction()->getRequest();
            $handlerClass = Mage::helper('emptyhandles')->getHandler($request);
            if ($handler = @Mage::getModel($handlerClass)) {			
                $handler->execute($observer->getEvent());
            }
        }
		return $this;
	}
}