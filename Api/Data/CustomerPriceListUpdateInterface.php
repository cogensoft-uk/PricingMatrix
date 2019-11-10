<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface CustomerPriceListUpdateInterface {
	const PARENT = 'price_customer_parent';
	const TYPE = 'price_customer_type';
	const CHAR = 'price_customer_char';
	const EXCLUDE = 'price_customer_exclude';

	/**
	 * @return $this
	 */
	public function setParent( $parent );

	/**
	 * @return float
	 */
	public function getParent();

	/**
	 * @return $this
	 */
	public function setType( $type );

	/**
	 * @return string
	 */
	public function getType();

	/**
	 * @return $this
	 */
	public function setChar( $char );

	/**
	 * @return string
	 */
	public function getChar();

	/**
	 * @return $this
	 */
	public function setExclude( $exclude );

	/**
	 * @return integer
	 */
	public function getExclude();
}