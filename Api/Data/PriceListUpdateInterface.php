<?php

namespace Cogensoft\PricingMatrix\Api\Data;

interface PriceListUpdateInterface {
	const NAME = 'price_list_name';
	const EFFECTIVE = 'price_list_effective';
	const NOTES = 'price_list_notes';
	const ACTIVE = 'price_list_active';
	const PRIORITY = 'price_list_priority';
	const CURRENCY = 'price_list_currency';
	const EFFECTIVE_TO = 'price_list_effective_to';
	const CRYSTAL_REP = 'price_list_crystal_rep';
	const TYPE = 'price_list_type';
	const SUB_FILTER = 'price_list_sub_filter';
	const OVERRIDE = 'price_list_override';
	const SHOW_PROMPT = 'price_list_show_prompt';
	const USE_SUB_METHODS = 'price_list_use_sub_methods';
	const MATCH_ALL_CUSTOMERS = 'price_list_match_all_customers';
	const MATCH_ALL_PRODUCTS = 'price_list_match_all_products';

	/**
	 * @return $this
	 */
	public function setName( $name );

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @return $this
	 */
	public function setEffective( $effective );

	/**
	 * @return string
	 */
	public function getEffective();

	/**
	 * @return $this
	 */
	public function setNotes( $notes );

	/**
	 * @return string
	 */
	public function getNotes();

	/**
	 * @return $this
	 */
	public function setActive( $active );

	/**
	 * @return integer
	 */
	public function getActive();

	/**
	 * @return $this
	 */
	public function setPriority( $priority );

	/**
	 * @return integer
	 */
	public function getPriority();

	/**
	 * @return $this
	 */
	public function setCurrency( $currency );

	/**
	 * @return string
	 */
	public function getCurrency();

	/**
	 * @return $this
	 */
	public function setEffectiveTo( $effectiveTo );

	/**
	 * @return string
	 */
	public function getEffectiveTo();

	/**
	 * @return $this
	 */
	public function setCrystalRep( $crystalRep );

	/**
	 * @return string
	 */
	public function getCrystalRep();

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
	public function setSubFilter( $subFilter );

	/**
	 * @return integer
	 */
	public function getSubFilter();

	/**
	 * @return $this
	 */
	public function setOverride( $override );

	/**
	 * @return integer
	 */
	public function getOverride();

	/**
	 * @return $this
	 */
	public function setShowPrompt( $showPrompt );

	/**
	 * @return integer
	 */
	public function getShowPrompt();

	/**
	 * @return $this
	 */
	public function setUseSubMethods( $useSubMethods );

	/**
	 * @return integer
	 */
	public function getUseSubMethods();

	/**
	 * @return $this
	 */
	public function setMatchAllCustomers( $matchAllCustomers );

	/**
	 * @return integer
	 */
	public function getMatchAllCustomers();

	/**
	 * @return $this
	 */
	public function setMatchAllProducts( $matchAllProducts );

	/**
	 * @return integer
	 */
	public function getMatchAllProducts();
}