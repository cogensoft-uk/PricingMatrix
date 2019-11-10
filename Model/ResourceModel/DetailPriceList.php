<?php
namespace Cogensoft\PricingMatrix\Model\ResourceModel;

use Cogensoft\PricingMatrix\Traits\API\Validator;
use Cogensoft\PricingMatrix\Api\Data\DetailPriceListUpdateInterface;
use Cogensoft\PricingMatrix\Api\Data\DetailPriceListInterface;

class DetailPriceList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	use Validator;

	const TABLE = 'ml_pricing_price_detail';

	const CREATE_RULES = [
		'primary' => ['NotEmpty' => null, 'Int' => null]
	];

	const UPDATE_RULES = [
		'header' => ['NotEmpty' => null, 'Int' => null],
		'from' => ['Float' => null],
		'to' => ['Float' => null],
		'fixed' => ['Float' => null],
		'discount' => ['Float' => null],
		'type' => ['NotEmpty' => null, 'StringLength' => ['max' => 1]],
		'discount_cash' => ['Float' => null],
		'chain' => ['Float' => null],
		'ignore_discount' => ['Int' => null, 'LessThan' => ['max' => 1000000]]
	];
	/**
	 * Resource initialization
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init(self::TABLE, 'id');
	}

	/**
	 * Get id by primary
	 *
	 * @param string $primary
	 * @return int|false
	 */
	public function getIdByPrimary($primary)
	{
		$connection = $this->getConnection();

		$select = $connection->select()->from(self::TABLE, 'id')->where('price_detail_primary = :primary');

		$bind = [':primary' => (integer) $primary];

		return $connection->fetchOne($select, $bind);
	}

	/**
	 * Validate data.
	 *
	 * @param DetailPriceListInterface $customerPriceList
	 *
	 * @return DetailPriceListInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateCreate(DetailPriceListInterface $detailPriceList) {
		return $this->validate($detailPriceList, self::CREATE_RULES + self::UPDATE_RULES);
	}

	/**
	 * Validate data.
	 *
	 * @param DetailPriceListUpdateInterface $customerPriceListUpdate
	 *
	 * @return DetailPriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateUpdate(DetailPriceListUpdateInterface $detailPriceListUpdate) {
		return $this->validate($detailPriceListUpdate, self::UPDATE_RULES);
	}
}