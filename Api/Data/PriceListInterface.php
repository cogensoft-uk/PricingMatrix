<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface PriceListInterface extends PriceListUpdateInterface {
	const ID = 'id';
	const PRIMARY = 'price_list_primary';

	/**
	 * @return $this
	 */
	public function setPrimary( $primary );

	/**
	 * @return integer
	 */
	public function getPrimary();
}