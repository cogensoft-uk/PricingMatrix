<?php
namespace Cogensoft\PricingMatrix\Model\ResourceModel;

use Cogensoft\PricingMatrix\Traits\API\Validator;
use Cogensoft\PricingMatrix\Api\Data\CustomerPriceListUpdateInterface;
use Cogensoft\PricingMatrix\Api\Data\CustomerPriceListInterface;

class CustomerPriceList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	use Validator;

	const TABLE = 'ml_pricing_price_customer';

	const CREATE_RULES = [
		'primary' => ['NotEmpty' => null, 'Int' => null]
	];

	const UPDATE_RULES = [
		'parent' => ['NotEmpty' => null, 'Int' => null],
		'type' => ['NotEmpty' => null, 'StringLength' => ['max' => 1]],
		'char' => ['StringLength' => ['max' => 21]],
		'exclude' => ['Int' => null],
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

		$select = $connection->select()->from(self::TABLE, 'id')->where('price_customer_primary = :primary');

		$bind = [':primary' => (integer) $primary];

		return $connection->fetchOne($select, $bind);
	}

	/**
	 * Validate data.
	 *
	 * @param CustomerPriceListInterface $customerPriceList
	 *
	 * @return CustomerPriceListInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateCreate(CustomerPriceListInterface $customerPriceList) {
		return $this->validate($customerPriceList, self::CREATE_RULES + self::UPDATE_RULES);
	}

	/**
	 * Validate data.
	 *
	 * @param CustomerPriceListUpdateInterface $customerPriceListUpdate
	 *
	 * @return CustomerPriceListUpdateInterface
	 * @throws \Magento\Framework\Exception\InputException
	 * @throws \Zend_Validate_Exception
	 */
	public function validateUpdate(CustomerPriceListUpdateInterface $customerPriceListUpdate) {
		return $this->validate($customerPriceListUpdate, self::UPDATE_RULES);
	}
}