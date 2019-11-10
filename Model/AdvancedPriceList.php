<?php
namespace Cogensoft\PricingMatrix\Model;

class AdvancedPriceList extends PricingMatrixAbstractModel implements \Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListInterface {

	protected static $PREFIX = 'price_advanced_';

	/**
	 * Constructor
	 *
	 * @return void
	 */
	protected function _construct() {
		parent::_construct();
		$this->_init( 'Cogensoft\PricingMatrix\Model\ResourceModel\AdvancedPriceList' );
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
	public function setProd( $prod )
	{
		return $this->setData(self::PROD, $prod);
	}

	/**
	 * @return string
	 */
	public function getProd()
	{
		return $this->_getData(self::PROD);
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
	public function setProdType( $prodType )
	{
		return $this->setData(self::PROD_TYPE, $prodType);
	}

	/**
	 * @return string
	 */
	public function getProdType()
	{
		return $this->_getData(self::PROD_TYPE);
	}

	/**
	 * @return $this
	 */
	public function setFixedOrQty( $fixedOrQty )
	{
		return $this->setData(self::FIXED_OR_QTY, $fixedOrQty);
	}

	/**
	 * @return integer
	 */
	public function getFixedOrQty()
	{
		return $this->_getData(self::FIXED_OR_QTY);
	}

	/**
	 * @return $this
	 */
	public function setParent( $parent )
	{
		return $this->setData(self::PARENT, $parent);
	}

	/**
	 * @return integer
	 */
	public function getParent()
	{
		return $this->_getData(self::PARENT);
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
	public function setBuyQty( $buyQty )
	{
		return $this->setData(self::BUY_QTY, $buyQty);
	}

	/**
	 * @return float
	 */
	public function getBuyQty()
	{
		return $this->_getData(self::BUY_QTY);
	}

	/**
	 * @return $this
	 */
	public function setFreeQty( $freeQty )
	{
		return $this->setData(self::FREE_QTY, $freeQty);
	}

	/**
	 * @return float
	 */
	public function getFreeQty()
	{
		return $this->_getData(self::FREE_QTY);
	}

	/**
	 * @return $this
	 */
	public function setMaxAllow( $maxAllow )
	{
		return $this->setData(self::MAX_ALLOW, $maxAllow);
	}

	/**
	 * @return float
	 */
	public function getMaxAllow()
	{
		return $this->_getData(self::MAX_ALLOW);
	}

	/**
	 * @return $this
	 */
	public function setBogofType( $bogofType )
	{
		return $this->setData(self::BOGOF_TYPE, $bogofType);
	}

	/**
	 * @return string
	 */
	public function getBogofType()
	{
		return $this->_getData(self::BOGOF_TYPE);
	}

	/**
	 * @return $this
	 */
	public function setMinQty( $minQty )
	{
		return $this->setData(self::MIN_QTY, $minQty);
	}

	/**
	 * @return float
	 */
	public function getMinQty()
	{
		return $this->_getData(self::MIN_QTY);
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
	public function setLoc1( $loc1 )
	{
		return $this->setData(self::LOC1, $loc1);
	}

	/**
	 * @return string
	 */
	public function getLoc1()
	{
		return $this->_getData(self::LOC1);
	}

	/**
	 * @return $this
	 */
	public function setLoc2( $loc2 )
	{
		return $this->setData(self::LOC2, $loc2);
	}

	/**
	 * @return string
	 */
	public function getLoc2()
	{
		return $this->_getData(self::LOC2);
	}

	/**
	 * @return $this
	 */
	public function setLoc3( $loc3 )
	{
		return $this->setData(self::LOC3, $loc3);
	}

	/**
	 * @return string
	 */
	public function getLoc3()
	{
		return $this->_getData(self::LOC3);
	}

	/**
	 * @return $this
	 */
	public function setLoc4( $loc4 )
	{
		return $this->setData(self::LOC4, $loc4);
	}

	/**
	 * @return string
	 */
	public function getLoc4()
	{
		return $this->_getData(self::LOC4);
	}

	/**
	 * @return $this
	 */
	public function setLoc5( $loc5 )
	{
		return $this->setData(self::LOC5, $loc5);
	}

	/**
	 * @return string
	 */
	public function getLoc5()
	{
		return $this->_getData(self::LOC5);
	}

	/**
	 * @return $this
	 */
	public function setLoc6( $loc6 )
	{
		return $this->setData(self::LOC6, $loc6);
	}

	/**
	 * @return string
	 */
	public function getLoc6()
	{
		return $this->_getData(self::LOC6);
	}

	/**
	 * @return $this
	 */
	public function setBgfSameOrDifProd( $bgfSameOrDifProd )
	{
		return $this->setData(self::BGF_SAME_OR_DIF_PROD, $bgfSameOrDifProd);
	}

	/**
	 * @return integer
	 */
	public function getBgfSameOrDifProd()
	{
		return $this->_getData(self::BGF_SAME_OR_DIF_PROD);
	}

	/**
	 * @return $this
	 */
	public function setBgfProdType( $bgfProdType )
	{
		return $this->setData(self::BGF_PROD_TYPE, $bgfProdType);
	}

	/**
	 * @return string
	 */
	public function getBgfProdType()
	{
		return $this->_getData(self::BGF_PROD_TYPE);
	}

	/**
	 * @return $this
	 */
	public function setBgfProd( $bgfProd )
	{
		return $this->setData(self::BGF_PROD, $bgfProd);
	}

	/**
	 * @return string
	 */
	public function getBgfProd()
	{
		return $this->_getData(self::BGF_PROD);
	}

	/**
	 * @return $this
	 */
	public function setBgfApplySpl( $bgfApplySpl )
	{
		return $this->setData(self::BGF_APPLY_SPL, $bgfApplySpl);
	}

	/**
	 * @return integer
	 */
	public function getBgfApplySpl()
	{
		return $this->_getData(self::BGF_APPLY_SPL);
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