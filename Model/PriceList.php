<?php
namespace Cogensoft\PricingMatrix\Model;

class PriceList extends PricingMatrixAbstractModel implements \Cogensoft\PricingMatrix\Api\Data\PriceListInterface {

	protected static $PREFIX = 'price_list_';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct() {
		parent::_construct();
		$this->_init( 'Cogensoft\PricingMatrix\Model\ResourceModel\PriceList' );
	}

	/**
	 * @return integer
	 */
	public function getId() {
		return $this->_getData(self::ID);
	}

	/**
	 * @return $this
	 */
	public function setId( $id )
	{
		return $this->setData(self::ID, $id);
	}

	/**
	 * @return $this
	 */
	public function setPrimary( $primary )
	{
		return $this->setData(self::PRIMARY, $primary);
	}

	/**
	 * @return integer
	 */
	public function getPrimary()
	{
		return $this->_getData(self::PRIMARY);
	}

	/**
	 * @return $this
	 */
	public function setName( $name )
	{
		return $this->setData(self::NAME, $name);
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->_getData(self::NAME);
	}

	/**
	 * @return $this
	 */
	public function setEffective( $effective )
	{
		return $this->setData(self::EFFECTIVE, $effective);
	}

	/**
	 * @return string
	 */
	public function getEffective()
	{
		return $this->_getData(self::EFFECTIVE);
	}

	/**
	 * @return $this
	 */
	public function setNotes( $notes )
	{
		return $this->setData(self::NOTES, $notes);
	}

	/**
	 * @return string
	 */
	public function getNotes()
	{
		return $this->_getData(self::NOTES);
	}

	/**
	 * @return $this
	 */
	public function setActive( $active )
	{
		return $this->setData(self::ACTIVE, $active);
	}

	/**
	 * @return integer
	 */
	public function getActive()
	{
		return $this->_getData(self::ACTIVE);
	}

	/**
	 * @return $this
	 */
	public function setPriority( $priority )
	{
		return $this->setData(self::PRIORITY, $priority);
	}

	/**
	 * @return integer
	 */
	public function getPriority()
	{
		return $this->_getData(self::PRIORITY);
	}

	/**
	 * @return $this
	 */
	public function setCurrency( $currency )
	{
		return $this->setData(self::CURRENCY, $currency);
	}

	/**
	 * @return string
	 */
	public function getCurrency()
	{
		return $this->_getData(self::CURRENCY);
	}

	/**
	 * @return $this
	 */
	public function setEffectiveTo( $effectiveTo )
	{
		return $this->setData(self::EFFECTIVE_TO, $effectiveTo);
	}

	/**
	 * @return string
	 */
	public function getEffectiveTo()
	{
		return $this->_getData(self::EFFECTIVE_TO);
	}

	/**
	 * @return $this
	 */
	public function setCrystalRep( $crystalRep )
	{
		return $this->setData(self::CRYSTAL_REP, $crystalRep);
	}

	/**
	 * @return string
	 */
	public function getCrystalRep()
	{
		return $this->_getData(self::CRYSTAL_REP);
	}

	/**
	 * @return $this
	 */
	public function setType( $type )
	{
		return $this->setData(self::TYPE, $type);
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->_getData(self::TYPE);
	}

	/**
	 * @return $this
	 */
	public function setSubFilter( $subFilter )
	{
		return $this->setData(self::SUB_FILTER, $subFilter);
	}

	/**
	 * @return integer
	 */
	public function getSubFilter()
	{
		return $this->_getData(self::SUB_FILTER);
	}

	/**
	 * @return $this
	 */
	public function setOverride( $override )
	{
		return $this->setData(self::OVERRIDE, $override);
	}

	/**
	 * @return integer
	 */
	public function getOverride()
	{
		return $this->_getData(self::OVERRIDE);
	}

	/**
	 * @return $this
	 */
	public function setShowPrompt( $showPrompt )
	{
		return $this->setData(self::SHOW_PROMPT, $showPrompt);
	}

	/**
	 * @return integer
	 */
	public function getShowPrompt()
	{
		return $this->_getData(self::SHOW_PROMPT);
	}

	/**
	 * @return $this
	 */
	public function setUseSubMethods( $useSubMethods )
	{
		return $this->setData(self::USE_SUB_METHODS, $useSubMethods);
	}

	/**
	 * @return integer
	 */
	public function getUseSubMethods()
	{
		return $this->_getData(self::USE_SUB_METHODS);
	}

	/**
	 * @return $this
	 */
	public function setMatchAllCustomers( $matchAllCustomers )
	{
		return $this->setData(self::MATCH_ALL_CUSTOMERS, $matchAllCustomers);
	}

	/**
	 * @return integer
	 */
	public function getMatchAllCustomers()
	{
		return $this->_getData(self::MATCH_ALL_CUSTOMERS);
	}

	/**
	 * @return $this
	 */
	public function setMatchAllProducts( $matchAllProducts )
	{
		return $this->setData(self::MATCH_ALL_PRODUCTS, $matchAllProducts);
	}

	/**
	 * @return integer
	 */
	public function getMatchAllProducts()
	{
		return $this->_getData(self::MATCH_ALL_PRODUCTS);
	}
}