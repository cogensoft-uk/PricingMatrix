<?php
namespace Cogensoft\PricingMatrix\Model\ResourceModel;

use Cogensoft\PricingMatrix\Traits\API\Validator;
use Cogensoft\PricingMatrix\Api\Data\PriceListUpdateInterface;
use Cogensoft\PricingMatrix\Api\Data\PriceListInterface;

class PriceList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	use Validator;

	const TABLE = 'ml_pricing_price_list';

	const CREATE_RULES = [
		'primary' => ['NotEmpty' => null, 'Int' => null]
	];

	const UPDATE_RULES = [
		'name' => ['NotEmpty' => null, 'StringLength' => ['max' => 50]],
		'effective' => ['NotEmpty' => null, 'Date' => null],
		'active' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'priority' => ['Int' => null],
		'currency' => ['StringLength' => ['max' => 5]],
		'effective_to' => ['Date' => null],
		'crystal_rep' => ['StringLength' => ['max' => 200]],
		'type' => ['NotEmpty' => null, 'StringLength' => ['max' => 10]],
		'sub_filter' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'override' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'show_prompt' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'use_sub_methods' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'match_all_customers' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
		'match_all_products' => ['Int' => null, 'LessThan' => ['max' => 1000000]],
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

		$select = $connection->select()->from(self::TABLE, 'id')->where('price_list_primary = :primary');

		$bind = [':primary' => (integer) $primary];

		return $connection->fetchOne($select, $bind);
	}

	/**
	 * Validate data.
	 *
	 * @param PriceListInterface $customerPriceList
	 *
	 * @return PriceListInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateCreate(PriceListInterface $priceList) {
		return $this->validate($priceList, self::CREATE_RULES + self::UPDATE_RULES);
	}

	/**
	 * Validate data.
	 *
	 * @param PriceListUpdateInterface $customerPriceListUpdate
	 *
	 * @return PriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateUpdate(PriceListUpdateInterface $priceListUpdate) {
		return $this->validate($priceListUpdate, self::UPDATE_RULES);
	}
}