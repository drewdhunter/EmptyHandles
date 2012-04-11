<?php

/**
 * Add layout handle to checkout cart index if there are no products
 *
 * @category   Dh
 * @package    Dh_EmptyHandles
 * @author     Drew Hunter <drewdhunter@gmail.com>
 */
class Dh_EmptyHandles_Model_Handler_Checkout_Cart_Index
	extends Dh_EmptyHandles_Model_Handler_Abstract
{
	/**
	 * Execute - If there are no items in the cart then apply 
	 * a new layout handle: checkout_cart_index_empty
	 *
     * @param	Varien_Event $event
	 * @return	Dh_Handles_Model_Handler_Checkout_Cart_Index
     */
	public function execute(Varien_Event $event)
	{
		$numCartItems = (bool)Mage::helper('checkout/cart')->getItemsCount();
		if (! $numCartItems) {
			$this->_addHandle('checkout_cart_index_empty');
		}
        
		return $this;
	}
}