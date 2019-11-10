<?php
namespace Cogensoft\PricingMatrix\Model;

class CustomerPriceList extends PricingMatrixAbstractModel implements \Cogensoft\PricingMatrix\Api\Data\CustomerPriceListInterface {

	protected static $PREFIX = 'price_customer_';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct() {
		parent::_construct();
		$this->_init( 'Cogensoft\PricingMatrix\Model\ResourceModel\CustomerPriceList' );
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
	public function setParent( $parent )
	{
		return $this->setData(self::PARENT, $parent);
	}

	/**
	 * @return float
	 */
	public function getParent()
	{
		return $this->_getData(self::PARENT);
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
	public function setChar( $char )
	{
		return $this->setData(self::CHAR, $char);
	}

	/**
	 * @return string
	 */
	public function getChar()
	{
		return $this->_getData(self::CHAR);
	}

	/**
	 * @return $this
	 */
	public function setExclude( $exclude )
	{
		return $this->setData(self::EXCLUDE, $exclude);
	}

	/**
	 * @return integer
	 */
	public function getExclude()
	{
		return $this->_getData(self::EXCLUDE);
	}
}