<?php
namespace Cogensoft\PricingMatrix\Model\ResourceModel;

use Cogensoft\PricingMatrix\Traits\API\Validator;
use Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListUpdateInterface;
use Cogensoft\PricingMatrix\Api\Data\AdvancedPriceListInterface;

class AdvancedPriceList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	use Validator;

	const TABLE = 'ml_pricing_price_advanced';

	const CREATE_RULES = [
		'primary' => ['NotEmpty' => null, 'Int' => null]
	];

	const UPDATE_RULES = [
		'prod' => ['NotEmpty' => null, 'StringLength' => ['max' => 25]],
		'type' => ['NotEmpty' => null, 'StringLength' => ['max' => 1]],
		'discount' => ['Float' => null],
		'fixed' => ['Float' => null],
        'prod_type' => ['NotEmpty' => null, 'StringLength' => ['max' => 1]],
		'fixed_or_qty' => ['NotEmpty' => null, 'Int' => null],
		'parent' => ['Int' => null],
		'exclude' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'discount_cash' => ['Float' => null],
		'buy_qty' => ['Float' => null],
		'free_qty' => ['Float' => null],
		'max_allow' => ['Float' => null],
		'bogof_type' => ['StringLength' => ['max' => 1]],
		'min_qty' => ['Float' => null],
		'chain' => ['Float' => null],
		'loc1' => ['StringLength' => ['max' => 25]],
		'loc2' => ['StringLength' => ['max' => 25]],
		'loc3' => ['StringLength' => ['max' => 25]],
		'loc4' => ['StringLength' => ['max' => 25]],
		'loc5' => ['StringLength' => ['max' => 25]],
		'loc6' => ['StringLength' => ['max' => 25]],
		'bgf_same_or_dif_prod' => ['Int' => null],
		'bgf_prod_type' => ['StringLength' => ['max' => 1]],
		'bgf_prod' => ['StringLength' => ['max' => 25]],
		'bgf_apply_spl' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
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

		$select = $connection->select()->from(self::TABLE, 'id')->where('price_advanced_primary = :primary');

		$bind = [':primary' => (integer) $primary];

		return $connection->fetchOne($select, $bind);
	}

	/**
	 * Validate data.
	 *
	 * @param AdvancedPriceListInterface $customerPriceList
	 *
	 * @return AdvancedPriceListInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateCreate(AdvancedPriceListInterface $advancedPriceList) {
		return $this->validate($advancedPriceList, self::CREATE_RULES + self::UPDATE_RULES);
	}

	/**
	 * Validate data.
	 *
	 * @param AdvancedPriceListUpdateInterface $customerPriceListUpdate
	 *
	 * @return AdvancedPriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateUpdate(AdvancedPriceListUpdateInterface $advancedPriceListUpdate) {
		return $this->validate($advancedPriceListUpdate, self::UPDATE_RULES);
	}
}