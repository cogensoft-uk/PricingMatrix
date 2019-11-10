<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface CustomerPriceListInterface extends CustomerPriceListUpdateInterface {
	const ID = 'id';
	const PRIMARY = 'price_customer_primary';

	/**
	 * @return $this
	 */
	public function setPrimary( $primary );

	/**
	 * @return integer
	 */
	public function getPrimary();
}