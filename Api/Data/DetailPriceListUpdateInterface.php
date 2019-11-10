<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface DetailPriceListUpdateInterface {
	const HEADER = 'price_detail_header';
	const FROM = 'price_detail_from';
	const TO = 'price_detail_to';
	const FIXED = 'price_detail_fixed';
	const DISCOUNT = 'price_detail_discount';
	const TYPE = 'price_detail_type';
	const DISCOUNT_CASH = 'price_detail_discount_cash';
	const CHAIN = 'price_detail_chain';
	const IGNORE_DISCOUNT = 'price_detail_ignore_discount';

	/**
	 * @return $this
	 */
	public function setHeader( $header );

	/**
	 * @return integer
	 */
	public function getHeader();

	/**
	 * @return $this
	 */
	public function setFrom( $from );

	/**
	 * @return float
	 */
	public function getFrom();

	/**
	 * @return $this
	 */
	public function setTo( $to );

	/**
	 * @return float
	 */
	public function getTo();

	/**
	 * @return $this
	 */
	public function setFixed( $fixed );

	/**
	 * @return float
	 */
	public function getFixed();

	/**
	 * @return $this
	 */
	public function setDiscount( $discount );

	/**
	 * @return float
	 */
	public function getDiscount();

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
	public function setDiscountCash( $discountCash );

	/**
	 * @return float
	 */
	public function getDiscountCash();

	/**
	 * @return $this
	 */
	public function setChain( $chain );

	/**
	 * @return float
	 */
	public function getChain();

	/**
	 * @return $this
	 */
	public function setIgnoreDiscount( $ignoreDiscount );

	/**
	 * @return integer
	 */
	public function getIgnoreDiscount();
}