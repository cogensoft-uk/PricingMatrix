<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface AdvancedPriceListUpdateInterface {
	const PROD = 'price_advanced_prod';
	const TYPE = 'price_advanced_type';
	const DISCOUNT = 'price_advanced_discount';
	const FIXED = 'price_advanced_fixed';
	const PROD_TYPE = 'price_advanced_prod_type';
	const FIXED_OR_QTY = 'price_advanced_fixed_or_qty';
	const PARENT = 'price_advanced_parent';
	const EXCLUDE = 'price_advanced_exclude';
	const DISCOUNT_CASH = 'price_advanced_discount_cash';
	const BUY_QTY = 'price_advanced_buy_qty';
	const FREE_QTY = 'price_advanced_free_qty';
	const MAX_ALLOW = 'price_advanced_max_allow';
	const BOGOF_TYPE = 'price_advanced_bogof_type';
	const MIN_QTY = 'price_advanced_min_qty';
	const CHAIN = 'price_advanced_chain';
	const LOC1 = 'price_advanced_loc1';
	const LOC2 = 'price_advanced_loc2';
	const LOC3 = 'price_advanced_loc3';
	const LOC4 = 'price_advanced_loc4';
	const LOC5 = 'price_advanced_loc5';
	const LOC6 = 'price_advanced_loc6';
	const BGF_SAME_OR_DIF_PROD = 'price_advanced_bgf_same_or_dif_prod';
	const BGF_PROD_TYPE = 'price_advanced_bgf_prod_type';
	const BGF_PROD = 'price_advanced_bgf_prod';
	const BGF_APPLY_SPL = 'price_advanced_bgf_apply_spl';
	const IGNORE_DISCOUNT = 'price_advanced_ignore_discount';

	/**
	 * @return $this
	 */
	public function setProd( $prod );

	/**
	 * @return string
	 */
	public function getProd();

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
	public function setDiscount( $discount );

	/**
	 * @return float
	 */
	public function getDiscount();

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
	public function setProdType( $prodType );

	/**
	 * @return string
	 */
	public function getProdType();

	/**
	 * @return $this
	 */
	public function setFixedOrQty( $fixedOrQty );

	/**
	 * @return integer
	 */
	public function getFixedOrQty();

	/**
	 * @return $this
	 */
	public function setParent( $parent );

	/**
	 * @return integer
	 */
	public function getParent();

	/**
	 * @return $this
	 */
	public function setExclude( $exclude );

	/**
	 * @return integer
	 */
	public function getExclude();

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
	public function setBuyQty( $buyQty );

	/**
	 * @return float
	 */
	public function getBuyQty();

	/**
	 * @return $this
	 */
	public function setFreeQty( $freeQty );

	/**
	 * @return float
	 */
	public function getFreeQty();

	/**
	 * @return $this
	 */
	public function setMaxAllow( $maxAllow );

	/**
	 * @return float
	 */
	public function getMaxAllow();

	/**
	 * @return $this
	 */
	public function setBogofType( $bogofType );

	/**
	 * @return string
	 */
	public function getBogofType();

	/**
	 * @return $this
	 */
	public function setMinQty( $minQty );

	/**
	 * @return float
	 */
	public function getMinQty();

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
	public function setLoc1( $loc1 );

	/**
	 * @return string
	 */
	public function getLoc1();

	/**
	 * @return $this
	 */
	public function setLoc2( $loc2 );

	/**
	 * @return string
	 */
	public function getLoc2();

	/**
	 * @return $this
	 */
	public function setLoc3( $loc3 );

	/**
	 * @return string
	 */
	public function getLoc3();

	/**
	 * @return $this
	 */
	public function setLoc4( $loc4 );

	/**
	 * @return string
	 */
	public function getLoc4();

	/**
	 * @return $this
	 */
	public function setLoc5( $loc5 );

	/**
	 * @return string
	 */
	public function getLoc5();

	/**
	 * @return $this
	 */
	public function setLoc6( $loc6 );

	/**
	 * @return string
	 */
	public function getLoc6();

	/**
	 * @return $this
	 */
	public function setBgfSameOrDifProd( $bgfSameOrDifProd );

	/**
	 * @return integer
	 */
	public function getBgfSameOrDifProd();

	/**
	 * @return $this
	 */
	public function setBgfProdType( $bgfProdType );

	/**
	 * @return string
	 */
	public function getBgfProdType();

	/**
	 * @return $this
	 */
	public function setBgfProd( $bgfProd );

	/**
	 * @return string
	 */
	public function getBgfProd();

	/**
	 * @return $this
	 */
	public function setBgfApplySpl( $bgfApplySpl );

	/**
	 * @return integer
	 */
	public function getBgfApplySpl();

	/**
	 * @return $this
	 */
	public function setIgnoreDiscount( $ignoreDiscount );

	/**
	 * @return integer
	 */
	public function getIgnoreDiscount();
}