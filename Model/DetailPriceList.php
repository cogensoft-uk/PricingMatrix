<?php
namespace Cogensoft\PricingMatrix\Model;


class DetailPriceList extends PricingMatrixAbstractModel implements \Cogensoft\PricingMatrix\Api\Data\DetailPriceListInterface {

	protected static $PREFIX = 'price_detail_';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct() {
		parent::_construct();
		$this->_init( 'Cogensoft\PricingMatrix\Model\ResourceModel\DetailPriceList' );
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
	public function setHeader( $header )
	{
		return $this->setData(self::HEADER, $header);
	}

	/**
	 * @return integer
	 */
	public function getHeader()
	{
		return $this->_getData(self::HEADER);
	}

	/**
	 * @return $this
	 */
	public function setFrom( $from )
	{
		return $this->setData(self::FROM, $from);
	}

	/**
	 * @return float
	 */
	public function getFrom()
	{
		return $this->_getData(self::FROM);
	}

	/**
	 * @return $this
	 */
	public function setTo( $to )
	{
		return $this->setData(self::TO, $to);
	}

	/**
	 * @return float
	 */
	public function getTo()
	{
		return $this->_getData(self::TO);
	}

	/**
	 * @return $this
	 */
	public function setFixed( $fixed )
	{
		return $this->setData(self::FIXED, $fixed);
	}

	/**
	 * @return float
	 */
	public function getFixed()
	{
		return $this->_getData(self::FIXED);
	}

	/**
	 * @return $this
	 */
	public function setDiscount( $discount )
	{
		return $this->setData(self::DISCOUNT, $discount);
	}

	/**
	 * @return float
	 */
	public function getDiscount()
	{
		return $this->_getData(self::DISCOUNT);
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
	public function setDiscountCash( $discountCash )
	{
		return $this->setData(self::DISCOUNT_CASH, $discountCash);
	}

	/**
	 * @return float
	 */
	public function getDiscountCash()
	{
		return $this->_getData(self::DISCOUNT_CASH);
	}

	/**
	 * @return $this
	 */
	public function setChain( $chain )
	{
		return $this->setData(self::CHAIN, $chain);
	}

	/**
	 * @return float
	 */
	public function getChain()
	{
		return $this->_getData(self::CHAIN);
	}

	/**
	 * @return $this
	 */
	public function setIgnoreDiscount( $ignoreDiscount )
	{
		return $this->setData(self::IGNORE_DISCOUNT, $ignoreDiscount);
	}

	/**
	 * @return integer
	 */
	public function getIgnoreDiscount()
	{
		return $this->_getData(self::IGNORE_DISCOUNT);
	}
}