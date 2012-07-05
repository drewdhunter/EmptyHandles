<?php

/**
 * EmptyHandles Handler Abstract
 *
 * Classes that extend this model should following naming convention based on the 
 * module, controller and action of the page being affected:
 * 
 * Dh_EmptyHandles_Model_Methods_Module_Controller_Aaction
 *
 * @category   Dh
 * @package    Dh_EmptyHandles
 * @author     Drew Hunter <drewdhunter@gmail.com>
 */
abstract class Dh_EmptyHandles_Model_Handler_Abstract extends Varien_Object
{
	/**
     * Each sub class will at least have an execute method.  This will
	 * be responsible for the logic behind adding the new handle.
     */
	protected abstract function execute(Varien_Event $event);
	
	/**
	 * Add the new handle to the layout update object
	 *
     * @param string $handle
     */
	protected function _addHandle($handle)
	{
		Mage::app()->getLayout()->getUpdate()
			->addHandle($handle);
		return $this;
	}
}