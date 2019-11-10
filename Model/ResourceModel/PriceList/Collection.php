<?php
namespace Cogensoft\PricingMatrix\Model\ResourceModel\PriceList;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Cogensoft\PricingMatrix\Model\PriceList', 'Cogensoft\PricingMatrix\Model\ResourceModel\PriceList');
	}
}