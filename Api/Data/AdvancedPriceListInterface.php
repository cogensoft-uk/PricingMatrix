<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface AdvancedPriceListInterface extends AdvancedPriceListUpdateInterface{
	const ID = 'id';
	const PRIMARY = 'price_advanced_primary';

	/**
	 * @return $this
	 */
	public function setPrimary( $primary );

	/**
	 * @return integer
	 */
	public function getPrimary();
}