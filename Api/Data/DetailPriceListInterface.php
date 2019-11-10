<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface DetailPriceListInterface extends DetailPriceListUpdateInterface {
	const ID = 'id';
	const PRIMARY = 'price_detail_primary';

	/**
	 * @return $this
	 */
	public function setPrimary( $primary );

	/**
	 * @return integer
	 */
	public function getPrimary();
}